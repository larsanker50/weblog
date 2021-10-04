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

<h2>Welkom {{  $username  }}</h2>

<h1>Overview</h1>

<p>Catagory-filter:
    @if ($catagory_filter == 'all')
        all catagories
    @else
     {{$catagory_filter}}
    @endif
</p>

<form action="/catagories/{{ $user_id }}/overview" method="post">
        @csrf
        <div>
            <select name="catagory" id="catagory">
                <option value="all">all</option>
                <?php
                    foreach ($catagories as $catagory) {
                     print '<option value="' . $catagory->name . '">' . $catagory->name . '</option>';   
                    }
                ?>
            </select>
        </div>
        <input class ="input" type="submit" value="filter on this catagory">
    </form>
<br>

@if(empty($posts))
    <p>No posts with this catagory.</p>
@endif

@foreach ($posts as $post)

@if ($post->premium === 0 || $user->premium === 1 || $post->user_id == $user_id)
<div id="overview_post">
@if ($post->premium === 1)
    <p class="premium"><strong>PREMIUM POST</strong></p>
@endif
<p> created at: {{ $post->created_at }} </p>
    @foreach ($users as $author) 
        @if ($post->user_id === $author->id) 
            <p>author: {{ $author->username }}</p>
        @endif
    @endforeach

<p> catagories:
    @foreach ($post->catagories as $catagory)

    {{ $catagory->name }};

    @endforeach

</p>
<h3> {{ $post->title }}  </h3>
<p> {{ $post->body }}  </p>

@foreach ($images as $image)
@if ($image->id === $post->image_id)
<img class="post_image" src="{{url( $image->path )}}" alt="Image"/>
@endif
@endforeach

<p><sub>{{ $post->feedbacks->count() }} comments</sub></p>

<a href="/posts/{{ $user_id }}/view/{{ $post->id }}">view post</a>
</div>
<br>
@endif
@endforeach

@endsection