<table class='table'>
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Baixar</th>

    </thead>
    <tbody>
        @foreach ($images as $image)
        <tr>
            <td><i class="fab fa-docker card-header-info ml-auto"></i></td>
            <td>{{ $image->name }}</td> 
            <td>
                <button class="btn btn-primary">Add</button>
            </td>           
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <div class="collapse" id="{{ $image->id }}">
                    @include('pages.images.images_show_form', ['image' => $image, 'isAdmin' => $isAdmin])
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $images->links() !!}
