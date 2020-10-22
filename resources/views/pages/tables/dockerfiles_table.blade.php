<table class='table'>
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Options</th>
    </thead>
    <tbody>
        @foreach ($dockerfiles as $dockerfile)
        <tr>
            <td><i class="fab fa-docker card-header-info ml-auto"></i></td>
            <td>{{ $dockerfile->tag }}</td>
            <td width='550px'>{{ $dockerfile->file }}</td>
            <td> 
                <form action="{{ route('dockerfiles.build') }}" method="post">
                    @csrf
                    <input type="hidden" name="tag" value="{{ $dockerfile->tag }}">
                    <button type="submit" class="btn btn-info">
                        Build
                    </button>                    
                </form>
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
{{-- {!! $dockerfiles->links() !!} --}}
