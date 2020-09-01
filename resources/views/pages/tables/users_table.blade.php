<table class='table'>
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Type</th>
        <th>Machines</th>
        <th>Containers</th>
        <th>Editar</th>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->user_type }}</td>
            <td>{{ $user->machines()->count()}}</td>
            <td>{{ $user->containers()->count() }}</td>
            <td>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal{{$user->id}}">
                    Editar
                </button>
                @component('components.modal_edit', ["titulo"=>"Editar", "user"=>$user ,"conteudo"=>$user->user_type, "target"=>'modal'.$user->id])
                @endcomponent   
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $users->links() !!}
