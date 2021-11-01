<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAcess;
use Exception;
use App\Models\Image;
use App\Models\Maquina;
use App\Models\Container;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckQtd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BasicController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAcess::class)->except(['index' ]);
        $this->middleware(CheckQtd::class)->only(['containerStore' ]);
    }

    public function index()
    {
    	$images = Image::where('user_type', 'basic')->get();
    	try {
            $url = env('DOCKER_HOST');
            $info = Http::get("$url/system/df");
        } catch (Exception $e) {
            return  $e->getMessage();
        }

        $url = env('DOCKER_HOST');

        $imagesDocker = Http::get("$url/images/json");
        $imagesDocker = json_decode($imagesDocker, true);

    	$params = [
            'mycontainers' => Container::where('user_id', Auth::user()->id)->paginate(10),
            'dockerHost' => env('DOCKER_HOST'),
            'title' => 'My Containers',
            'info'  => $info->json()['Containers']

        ];

        $socketParams = json_encode([
                'dockerHost' => env('DOCKER_HOST_WS'),
                'container_id' => null,
            ]);

    	return view('pages.student.basic.index', compact('params','images','imagesDocker', 'socketParams'));
    }

    public function containers()
    {
    	try {
            $url = env('DOCKER_HOST');
            $info = Http::get("$url/containers/json?all=true");
        } catch (Exception $e) {
            return  $e->getMessage();
        }

        $params = [
            'mycontainers' => Container::where('user_id', Auth::user()->id)->get(),
            'info' => $info->json(),
            'dockerHost' => env('DOCKER_HOST'),
            'title' => 'My Containers',
            'user' => auth()->user(),
            'image_names' => Image::all(['fromImage', 'tag', 'photo', 'name'])

        ];

        $containers_exists = [];
        $containers = Container::where('user_id', Auth::user()->id)->get();
        foreach ($params['info'] as $key => $value) {
            if($containers->contains('docker_id', $value['Id'])) {
                array_push($containers_exists, $value);
            }
        }
        $params['info'] = $containers_exists;

        return view('pages.student.basic.containers', $params);
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

        return redirect()->route('aluno.basic.index', ['params' => $params]);
    }

    public function containerStore(Request $request)
    {
        $user = Auth()->user();
        try {

            // if ($user->containers()->count() > $user->containers) {
            //     return redirect()->route('aluno.basic.index')->with('error', 'Quantidade de máxima containers criados atingido!');
            // }
            $url = env('DOCKER_HOST');
            $data = $this->setDefaultDockerParams($request->all());
            // dd($data);
            $this->pullImage($url, Image::find($data['image_id']));
            $this->createContainer($url, $data);

            return redirect()->route('aluno.basic.containers');
            // return redirect()->route('aluno.basic.index')->with('success', 'Container creation is running!');
        } catch (Exception $e) {
            return  $e->getMessage();
        }
    }

    private function setDefaultDockerParams(array $data)
    {
        $image = Image::find($data['image_id']);
        $data['Image'] = $image->fromImage .':'.$image->tag;
        $data['Memory'] = $data['Memory'] ? intval($data['Memory']) : 0;
        // dd();
        $inicias = auth()->user()->user_name;
        $data['Env'] = $data['envVariables'] ? explode(';', $data['envVariables']) : [];
        array_pop($data['Env']); // Para remover string vazia no ultimo item do array, evitando erro na criação do container.

        $data['AttachStdin'] = true;
        $data['AttachStdout'] = true;
        $data['AttachStderr'] = true;
        $data['OpenStdin'] = true;
        $data['StdinOnce'] = false;
        $data['Tty'] = true;

        $data['ExposedPorts'] = json_decode('{"80/tcp": { }}');

        // $data['Shell'] = [
        //     '/bin/bash'
        // ];
        //  $data['Shell'] = [
        //     'service;apache2;start;service;mysql;start;'
        // ];
        $data['Entrypoint'] = [
            "/script.sh", "{$inicias}"
        ];
        // $data['Cmd'] = [
        //     "chmod", "+x", "script.sh"
        // ];
        // $data['Cmd'] = [
        //     'service;apache2;start;service;mysql;start;'
        // ];
        // $data['Cmd'] = [
        //     'service', 'apache2', 'start', '&&', 'service','mysql','start',
        // ];
        // $data['Cmd'] = [
        //     'sh', '-c', 'service', 'apache2', 'start', '&&', 'service', 'mysql', 'start'
        // ];
        $data['Cmd'] = [
            ''
        ];
        // $data['Cmd'] = [
        //     "", "{$inicias}"
        // ];


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
             'PortBindings' => json_decode('{"80/tcp": [{"HostPort":"8080"}]}')

        ];
        // dd($data);

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
    // $response = Http::asJson()->post("$url/containers/create", $data);
    // if ($response->getStatusCode() == 201) {
    //     $container_id = $response->json()['Id'];
    //     $response = Http::asJson()->post("$url/containers/$container_id/start");
    //     if ($response->getStatusCode() == 201) {
    //         $container = Http::asJson()->post("$url/containers/$container_id/json");
    //         $container = json_decode($container);
    //         $data['hashcode_maquina'] = Maquina::first()->hashcode;
    //         $data['docker_id'] = $container_id;
    //         $data['status'] = $container->State->Status;
    //         $data['user_id'] = Auth::user()->id;
    //         $data['dataHora_instanciado'] = now();
    //         $data['dataHora_finalizado'] = $response->getStatusCode() == 204 ? null : now();

    //         Container::create($data);
    //     }else{
    //         dd($response);

    //     }
    // } else {
    //     dd($response->json());
    // }
    private function createContainer($url, $data)
    {

        $response = Http::asJson()->post("$url/containers/create", $data);
        if ($response->getStatusCode() == 201) {
            $container_id = $response->json()['Id'];
            $response = Http::asJson()->post("$url/containers/$container_id/start");
            // dd($response->json());
            $container = Http::asJson()->get("$url/containers/$container_id/json");
            // dd($container);
            $container = json_decode($container);
            $data['hashcode_maquina'] = Maquina::first()->hashcode;
            $data['docker_id'] = $container_id;
            $data['status'] = $container->State->Status;
            $data['user_id'] = Auth::user()->id;
            $data['dataHora_instanciado'] = now();
            $data['dataHora_finalizado'] = $response->getStatusCode() == 204 ? null : now();

            Container::create($data);
        } else {
            dd($response->json());
        }
    }



    public function playStop($container_id)
    {
        $instancia = Container::where('docker_id', $container_id)->first();
        $url = env('DOCKER_HOST');

        if ($instancia->dataHora_finalizado) {
            $host = "$url/containers/$container_id/start";
            $dataHora_fim = null;


        } else {
            $host = "$url/containers/$container_id/pause";
            $dataHora_fim = now();
        }

        try {
            Http::post($host);

            $instancia->dataHora_finalizado = $dataHora_fim;
            $instancia->save();
            // dd($instancia);
            return redirect()->route('aluno.basic.index')->with('success', 'Container created with sucess!');
        } catch (Exception $e) {
            return redirect()->route('aluno.basic.index')->with('error', "Fail to stop the container! $e");
        }
    }

    public function destroy($id)
    {
        $url = env('DOCKER_HOST');
        //dd($id);
        $responseStop = Http::post("$url/containers/$id/stop");
        if ($responseStop->getStatusCode() == 204 || $responseStop->getStatusCode() == 304) {
            $responseDelete = Http::delete("$url/containers/$id");
            if ($responseDelete->getStatusCode() == 204) {
                $instancia = Container::firstWhere('docker_id', $id);

                $instancia->delete();

                return redirect()->route('aluno.basic.index')->with('success', 'Container deleted with sucess!');
            } else {
                dd($responseDelete->json());

                return redirect()->route('aluno.basic.index')->with('error', 'Fail, Container not delete!');
            }
        } else {
            dd($responseStop->json());
        }
    }

}
