<form action="{{ url('/login')}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="email" name="email">
    <br>
    <input type="password" name="password">
    <input type="submit" value="Login">
</form>
