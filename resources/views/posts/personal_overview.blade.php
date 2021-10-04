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

<h1>Your personal posts</h1>

@foreach ($posts as $post)
<div id="overview_post">
@if ($post->premium === 1)
    <p><strong>PREMIUM POST</strong></p>
@endif
<p> created at: {{ $post->created_at }} </p>
<p> catagories:
    @foreach ($post->catagories as $catagory)

    {{ $catagory->name }};

    @endforeach

</p>
<p> author: {{ $user->username }} </p>
<h3> {{ $post->title }}  </h3>
<p> {{ $post->body }}  </p>

@foreach ($images as $image)
@if ($image->id === $post->image_id)
<img class="post_image" src="{{url( $image->path )}}" alt="Image"/>
@endif
@endforeach
<br>
<a href="/posts/{{ $user_id }}/view/{{ $post->id }}">view post</a>
</div>
<br>
@endforeach


@endsection