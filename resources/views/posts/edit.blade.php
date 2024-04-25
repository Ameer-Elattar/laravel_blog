@extends("layouts.app")
@section("content")
  <section class="container ">
    <form action="/posts/{{ $post['id']}}" method="post" >
      @csrf
      @method("put")
      <div >
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{$post['title']}}" placeholder="title" id="title">
      </div>
      <div >
        <label for="Body">Body</label>
        <input type="text" name="body" class="form-control" value="{{$post['body']}}" placeholder="body" id="body">
      </div>
      <!-- <div >
        <label for="user_id">Posted By</label>
        <input type="text" name="user_id" class="form-control" value="{{$post['user_id']}}" placeholder="posted_by" id="posted_by">
      </div> -->
      <input type="submit" value="edit Post" class="btn btn-primary mt-3">
    </form>
    @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
  </section>
@endsection
