<h1>Posts</h1>
@foreach ($posts as $post)
    <div>
        <h2>{{ $post->user->name }}</h2>
        <p>{{ $post->content }}</p>
    </div>
@endforeach
