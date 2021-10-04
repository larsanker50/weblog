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



    <h1>Update post: '{{ $post->title }}'</h1>
    
    <form action="/posts/{{ $user_id }}/update/{{ $post->id }}" method="post" enctype="multipart/form-data">
    @csrf
    <p>title</p>
    <div>
        <input class ="input" type="text" name="title" id="title" placeholder="title" value="{{ old('title', $post->title) }}" required>
    </div>
    <p>catagory</p>
    <div>        
        <?php
            foreach ($catagories as $catagory) {
                $checked = false;

                foreach ($post->catagories as $post_catagory) {
                    if ($post_catagory->id == $catagory->id) {
                        $checked = true;
                    }
                }
                
                if ($checked == true) {
                    print '<input type="checkbox" class ="input" id="' . $catagory->name . '" name="catagories[]" value="' . $catagory->name . '" checked>';
                    print '<label for="' . $catagory->name . '">' . $catagory->name . '</label><br>';
                } else {
                    print '<input type="checkbox" class ="input" id="' . $catagory->name . '" name="catagories[]" value="' . $catagory->name . '">';
                    print '<label for="' . $catagory->name . '">' . $catagory->name . '</label><br>';
                }
            }

        ?>
        <input class ="input" type="text" name="catagories[]" class ="input" placeholder="Add a new catagory">

    </div>
    <p>post</p>
    <div>
        <textarea class ="input" type="text" name="post" id="post">{{ old('body', $post->body) }}</textarea>
    </div>
    <p>image</p>
    <div>
        <input class ="input" type="file" name="image" id="image">
    </div>
    <p>premium post?</p>
    <div>
        <input class ="input" type="checkbox" name="premium" id="premium" placeholder="premium" @if($premium_value) checked @endif>
    </div>  
    <br>
    <input class ="input" type="submit" value="submit">
    </form>

    @endsection