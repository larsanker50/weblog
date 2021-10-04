@extends ('layouts.app')

    @section ('header')

    <ul>
        <li><a href="/">home</a></li>
        <li><a href="/users/login">login</a></li>
        <li><a href="/users/create">create new user</a></li>
    </ul>
    @endsection    
    
    @section ('body')
    
    <p>welkom op de site</p>
    <a href="/users/login">klik hier voor login</a>

    @endsection

