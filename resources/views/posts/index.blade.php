@extends('layouts.app')

@section('content')
<a href="/posts/create" class="btn btn-primary mb-3">Create</a>
    <div class=" row gap-3 justify-content-center  ">
      

        @foreach ($posts as $post )
      <div class="card" style="width: 18rem;">
        @if($post->image)
        <img src="{{ Storage::url('public/images/' . $post->image) }}" class="card-img-top" alt="Post Image">
        @endif
        <div class="card-body">
        <h5 class="card-title">title: {{ $post['title']}}</h5>
        <p class="card-text">body: {{ $post['body']}}</p>
        <p class="card-text">posted By: {{ $post->user->name}}</p>
        <p class="card-text">slug: {{ $post->slug}}</p>
        </div>
        <div class="card-footer d-flex justify-content-evenly ">
        <a href="/posts/{{ $post['id']}}" class="btn btn-primary">show</a>
        <a href="/posts/{{ $post['id']}}/edit" class="btn btn-warning">edit</a>
        <form action="/posts/{{ $post['id']}}" method="post">
        @csrf
        @method("delete")
        <input type="submit" value="delete" class="btn btn-danger">
        </form>
        </div>
      </div>
        @endforeach
        {{ $posts->links('pagination::bootstrap-4')}}
      
      
    </div>
    
  @endsection




  <!-- <table class="table table-striped  mt-4">
      <thead>
        <tr>
          <td>ID</td>
          <td>Title</td>
          <td>Body</td>
          <td>Posted By</td>
          <td>show</td>
          <td>edit</td>
          <td>delete</td>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post )
          <tr>
            <td>{{ $post['id']}}</td>
            <td>{{ $post['title']}}</td>
            <td>{{ $post['body']}}</td>
            <td>{{ $post->user->name}}</td>
            <td><a href="/posts/{{ $post['id']}}" class="btn btn-primary">show</a></td>
            <td><a href="/posts/{{ $post['id']}}/edit" class="btn btn-warning">edit</a></td>
            <td>
              <form action="/posts/{{ $post['id']}}" method="post">
                @csrf
                @method("delete")
                <input type="submit" value="delete" class="btn btn-danger">
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
      </table> -->