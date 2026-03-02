<form action="{{ url('/category/update/' . $category->id) }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <label for="name">Name</label>
    <input type="text" name="name" value="{{ $category->name }}">
    <br>
    <label for="created_at">Created At: {{ $category->created_at }}</label>
    <br>
    <label for="updated_at">Updated At: {{ $category->updated_at }}</label>
    <br>
    <input type="submit" value="Cap nhat">
</form>
<br>
<a href="{{ url('/category/destroy/' . $category->id) }}">Xoa danh muc</a>