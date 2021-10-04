@extends ('layouts.app')

@section ('header')

<ul>
    <li><a href="/posts/{{ $user_id }}/overview">overview</a></li>
    <li><a href="/posts/{{ $user_id }}/personal_overview">my posts</a></li>
    <li><a href="/posts/{{ $user_id }}/create">make post</a></li>
    <li><a href="/posts/{{ $user_id }}/premium">Get premium</a></li>
    <li><a href="/users/{{ $user_id }}/subscription">Get an email subscription</a></li>
    <li><a href="/">logout</a></li>
</ul>
@endsection    

@section ('body')

<h1>Get premium</h1>

@if($premium === TRUE)      
    <p>Beste {{ $username }},</p>   
    <p>Je bent al premium gebruiker. Wil je unsubscriben?</p>
    <p>Klik dan op de onderstaande knop.</p>
    <form action="/posts/{{ $user_id }}/premium" method="post">
        @csrf
        <input type="submit" value="Unsubscribe">
    </form> 
@endif

@if($premium === FALSE)         
    <p>Beste {{ $username }},</p>
    <p>Voor een nader te bepalen bedrag kan je meedoen met onze premium programma.</p>
    <p>Je kan dan posts zien die enkel bedoeld zijn voor premium gebruikers.</p>
    <p>Wil jij hier aan mee doen? klik dan op de volgende knop voor een GRATIS proefabbonement.</p>
    <form action="/posts/{{ $user_id }}/premium" method="post">
        @csrf
        <input type="submit" value="Subscribe">
    </form> 
@endif

@endsection