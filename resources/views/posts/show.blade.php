@extends("layouts.app")
@section("content")
  <div class="d-flex justify-content-center ">
    <div class="card" >
          @if($post->image)
          <img src="{{ Storage::url('public/images/' . $post->image) }}" class="card-img-top" alt="Post Image">
          @endif
          <div class="card-body">
            <h5 class="card-title">Title: {{ $post['title']}}</h5>
            <p class="card-text">Body: {{ $post['body']}}</p>
            <p class="card-text">Posted By:  {{ $post->user->name}}</p>
          </div>
    </div>
  </div>

    <div class="container">
    <div class="card mt-3">
                <div class="card-header">
                    Comments
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($post->comments as $comment)
                        <li class="list-group-item">{{$comment['pivot']['content']}}</li>
                        @endforeach
                    </ul>
                </div>
    </div>
            <div class="card mt-3">
                <div class="card-header">
                    Write a Comment
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            <label for="content">Comment:</label>
                            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
    </div>
@endsection
