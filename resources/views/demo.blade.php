<table border="1">
    <thead>
        <td>#</td>
        <td>Name</td>
        <td>Created At</td>
        <td>Updated At</td>
        <td>Detail</td>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->created_at }}</td>
            <td>{{ $category->updated_at }}</td>
            <td>
                <a href="{{ url('category/detail/' . $category->id) }}">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
