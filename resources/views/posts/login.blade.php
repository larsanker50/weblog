@extends ('layouts.app')

    @section ('header')

    <ul>
        <li><a href="/">home</a></li>
        <li><a href="/users/login">login</a></li>
        <li><a href="/users/create">create new user</a></li>
    </ul>
    @endsection   

    @section ('body')

    <?php if (request('username')) {
        echo 'Username or password incorrect';
    } ?>
    
    <form action="/posts/overview" method="post">
        @csrf
        <div>
            <input class ="input" type="text" name="username" id="username" placeholder="username" value="{{ request('username') }}" required>
        </div>
        <div>
            <input class ="input" type="text" name="password" id="password" placeholder="password" required>
        </div>
      
        <input class ="input" type="submit" value="submit">
    </form>

    @endsection