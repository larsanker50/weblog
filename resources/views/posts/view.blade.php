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
<?php
// dd();
?>
@section ('body')

<h1>Single post view</h1>

<div id="overview_post">
@if ($post->premium === 1)
    <p class="premium"><strong>PREMIUM POST</strong></p>
@endif
<p> created at: {{ $post->created_at }} </p>
<p>catagories:
    @foreach ($post->catagories as $catagory)
    {{ $catagory->name }};
    @endforeach
</p>
    @foreach ($users as $author) 
        @if ($post->user_id === $author->id) 
            <p>author: {{ $author->username }}</p>
        @endif
    @endforeach
<h3> {{ $post->title }}  </h3>
<p> {{ $post->body }}  </p>
@if ($image)
<img class="post_image" src="{{url( $image->path )}}" alt="Image"/>
@endif
    @if($user_id == $post->user_id)         
        <div id="delete_div">
                <form action="/posts/{{ $user_id }}/delete/{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="delete post">
                </form>
            </div>
            <form action="/posts/{{ $user_id }}/edit/{{ $post->id }}" method="get">
            <input type="submit" value="edit">
            </form>     
        @endif
</div>
<br>
<h2>make comment:</h2>
<form action="/posts/{{ $user_id }}/view/{{ $post->id }}" method="post">
        @csrf
        <div>
        <textarea class ="input" type="text" name="body" id="body" placeholder="Write here your comment."> </textarea>
    </div>
      
        <input class ="input" type="submit" value="submit">
    </form>
    <h2>comments:</h2>

    @foreach ($post->feedbacks as $feedback) 
    <div id="comment">
        <p><b> created at: {{ $feedback->created_at }} </b></p>
        @foreach ($users as $commenter) 
        @if ($feedback->user_id === $commenter->id) 
            <p><b>commenter: {{ $commenter->username }}</b></p>
        @endif
    @endforeach
        <p> {{ $feedback->body }}  </p>
        
        @if($user_id == $feedback->user_id)         
        <div id="delete_div">
                <form action="/posts/{{ $user_id }}/view/{{ $post->id }}/{{ $feedback->id }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="delete feedback">
                </form>
            </div>       
        @endif
    </div>
    <br>
    @endforeach

@endsection