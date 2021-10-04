<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@foreach ($posts as $post)
<p> created at: {{ $post->created_at }} </p>
    @foreach ($users as $author) 
        @if ($post->user_id === $author->id) 
            <p>author: {{ $author->username }}</p>
        @endif
    @endforeach
<h3> {{ $post->title }}  </h3>
<p> {{ $post->body }}  </p>
<a href="/posts/{{ $user_id }}/view/{{ $post->id }}">view post</a>
</div>
<br>
@endforeach

</body>
</html>