<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\Image;
use App\Models\Maquina;
use App\Models\Container;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckQtd;
use App\Http\Middleware\CheckAcess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdvancedController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAcess::class)->except(['painel' ]);
        $this->middleware(CheckQtd::class)->only(['containerStore' ]);
    }

    public function painel()
    {
    	$images = Image::where('user_type', 'advanced')->get();
    	try {
            $url = env('DOCKER_HOST');
            $info = Http::get("$url/containers/json");
        } catch (Exception $e) {
            return  $e->getMessage();
        }

    	$params = [
            'mycontainers' => Container::where('user_id', Auth::user()->id)->paginate(10),
            'dockerHost' => env('DOCKER_HOST'),
            'title' => 'My Containers',
            'info'  => $info->json()

        ];

        $socketParams = json_encode([
                'dockerHost' => env('DOCKER_HOST_WS'),
                'container_id' => null,
        ]);

        $containers_exists = [];
        $containers = Container::where('user_id', Auth::user()->id)->get();
        foreach ($params['info'] as $key => $value) {
            if($containers->contains('docker_id', $value['Id'])) {
                array_push($containers_exists, $value);
            }
        }
        $params['info'] = $containers_exists;

    	return view('pages.student.advanced.index', compact('params','images', 'socketParams'));
    }

    public function addContainer($id)
    {
        $container = Container::firstWhere('docker_id', $id);

        $params = [
            'mycontainer' => $container,
            'socketParams' => json_encode([
                'dockerHost' => env('DOCKER_HOST_WS'),
                'container_id' => $id,
            ]),
        ];
        // dd($params);
        return redirect()->route('aluno.advanced.index', ['params' => $params]);
    }

    public function containerStore(Request $request)
    {
        try {
            $url = env('DOCKER_HOST');
            $data = $this->setDefaultDockerParams($request->all());
            $this->pullImage($url, Image::find($data['image_id']));
            $this->createContainer($url, $data);

            return redirect()->route('aluno.advanced.index')->with('success', 'Container creation is running!');
        } catch (Exception $e) {
            return  $e->getMessage();
        }
    }

    private function setDefaultDockerParams(array $data)
    {

        $data['Image'] = Image::find($data['image_id'])->fromImage;
        $data['Memory'] = $data['Memory'] ? intval($data['Memory']) : 0;

        $data['Env'] = $data['envVariables'] ? explode(';', $data['envVariables']) : [];
        array_pop($data['Env']); // Para remover string vazia no ultimo item do array, evitando erro na criação do container.

        $data['AttachStdin'] = true;
        $data['AttachStdout'] = true;
        $data['AttachStderr'] = true;
        $data['OpenStdin'] = true;
        $data['StdinOnce'] = false;
        $data['Tty'] = true;

        $data['Entrypoint'] = [
            '/bin/bash',
        ];

        $data['HostConfig'] = [
            'PublishAllPorts' => true,
            'Privileged' => true,
            'RestartPolicy' => [
                'name' => 'always',
            ],
            'Binds' => [
                '/var/run/docker.sock:/var/run/docker.sock',
                '/tmp:/tmp',
             ],
        ];

        return $data;
    }

    private function pullImage($url, Image $image)
    {
        $uri = "images/create?fromImage=$image->fromImage&tag=$image->tag";
        $image->fromSrc ? $uri .= "&fromSrc=$image->fromSrc" : $uri;
        $image->repo ? $uri .= "&repo=$image->repo" : $uri;
        $image->message ? $uri .= "&message=$image->message" : $uri;

        $response = Http::post("$url/$uri");

        if ($response->getStatusCode() != 200) {
            dd($response->json());
        }
    }

    private function createContainer($url, $data)
    {
        $response = Http::asJson()->post("$url/containers/create", $data);
        //dd($response->getStatusCode());
        //dd($data);
        if ($response->getStatusCode() == 201) {
            $container_id = $response->json()['Id'];
            $response = Http::asJson()->post("$url/containers/$container_id/start");

            $data['hashcode_maquina'] = Maquina::first()->hashcode;
            $data['docker_id'] = $container_id;
            $data['dataHora_instanciado'] = now();
            $data['dataHora_finalizado'] = $response->getStatusCode() == 204 ? null : now();

            Container::create($data);
        } else {
            dd($response->json());
        }
    }

    public function terminal($id)
    {
    	$images = Image::all();
    	$container = Container::firstWhere('docker_id', $id);

        try {
            $url = env('DOCKER_HOST');
            $info = Http::get("$url/containers/json");
        } catch (Exception $e) {
            return  $e->getMessage();
        }

        $params = [
            'mycontainers' => Container::where('user_id', Auth::user()->id)->paginate(10),
            'dockerHost' => env('DOCKER_HOST'),
            'title' => 'My Containers',
            'info'  => $info->json()

        ];
        $socketParams = json_encode([
            'dockerHost' => env('DOCKER_HOST_WS'),
            'container_id' => $id,
        ]);



        return view('pages.student.advanced.index',compact('params','images', 'socketParams'));
    }
}
