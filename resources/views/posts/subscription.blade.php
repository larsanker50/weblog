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

<h1>Get email-subscription</h1>

@if($subscription === TRUE)      
    <p>Beste {{ $username }},</p>   
    <p>Je bent al subscribed op de email. Wil je unsubscriben?</p>
    <p>Klik dan op de onderstaande knop.</p>
    <form action="/users/{{ $user_id }}/subscribe" method="post">
        @csrf
        <input type="submit" value="Unsubscribe">
    </form> 
@endif

@if($subscription === FALSE)         
    <p>Beste {{ $username }},</p>
    <p>Door te subscriben zal je wekelijks een email ontvangen met een bundel van alle nieuwe posts.</p>
    <p>Wil jij dit? klik dan op de onderstaande knop</p>
    <form action="/users/{{ $user_id }}/subscribe" method="post">
        @csrf
        <input type="submit" value="Subscribe">
    </form> 
@endif

@endsection