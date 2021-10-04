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

<form action="/posts/{{ $user_id }}/create" method="post" enctype="multipart/form-data">
    @csrf
    <p>title</p>
    <div>
        <input class ="input" type="text" name="title" id="title" placeholder="title" required>
    </div>
    <p>catagory</p>
    <div>        
        @foreach ($catagories as $catagory)
        
        <input type="checkbox" class ="input" id="{{ $catagory->name }}" name="catagories[]" value="{{ $catagory->name }}">
        <label for="{{ $catagory->name }}">{{ $catagory->name }}</label><br>
        @endforeach
        <input class ="input" type="text" name="catagories[]" class ="input" placeholder="Add a new catagory">

    </div>
    <p>post</p>
    <div>
        <textarea class ="input" type="text" name="post" id="post" placeholder="Write here your post."> </textarea>
    </div>
    <p>image</p>
    <div>
        <input class ="input" type="file" name="image" id="image" placeholder="image">
    </div>
    <p>premium post?</p>
    <div>
        <input class ="input" type="checkbox" name="premium" id="premium" placeholder="premium" value="true">
    </div>  
    <br>
    <input class ="input" type="submit" value="submit">
</form>

@endsection