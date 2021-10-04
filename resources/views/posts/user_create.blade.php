@extends ('layouts.app')

@section ('header')

<ul>
    <li><a href="/">home</a></li>
    <li><a href="/users/login">login</a></li>
    <li><a href="/users/create">create new user</a></li>
</ul>
@endsection   

@section ('body')

<form action="/users/create" method="post">
    @csrf
    <div>
        <input class ="input" type="text" name="email" id="email" placeholder="email" value="{{ old('email') }}" required>
        <p class="help is-danger">{{ $errors->first('email') }}</p>
    </div>
    <div>
        <input class ="input" type="text" name="username" id="username" placeholder="username" value="{{ old('username') }}" required>
        <p class="help is-danger">{{ $errors->first('username') }}</p>
    </div>
    <div>
        <input class ="input" type="text" name="password" id="password" placeholder="password" value="{{ old('password') }}" required>
        <p class="help is-danger">{{ $errors->first('password') }}</p>
    </div>
  
    <input class ="input" type="submit" value="submit">
</form>

@endsection