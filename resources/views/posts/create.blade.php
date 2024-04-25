@extends("layouts.app")
@section("content")
  <section class="container ">
    <form action="/posts" method="post" enctype="multipart/form-data">
      @csrf
      <div >
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" placeholder="title" id="title">
      </div>
      <div >
        <label for="Body">Body</label>
        <input type="text" name="body" class="form-control" placeholder="body" id="body">
      </div>
      <!-- <div >
        <label for="user_id">Posted By</label>
        <input type="text" name="user_id" class="form-control" placeholder="posted_by" id="user_id">
      </div> -->
      <div>
        <input type="file" name="image">
      </div>
      <input type="submit" value="Add Post" class="btn btn-primary mt-3">
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
