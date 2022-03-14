@extends('frontend.layouts.app')
@section('styles')
<link href="{{ asset('admin-asset/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-asset/css/summernote.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="main-content">

  <div class="book-show-area">
    <div class="container"> 
      <h3>
        Upload Your Book
      </h3>
      @if(Auth::check())
       <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <label>Book Title</label>
            <input type="text" name="title" class="form-control" placeholder="Book Title">

          </div>

          <div class="col-sm-6">
            <label>Book URL</label>
            <input type="text" name="slug" class="form-control" placeholder="Book URL">

          </div>
        </div>
        <div class="row">

          <div class="col-sm-6">
            <br>
            <label>Book Category</label>
            <select name="category_id" id="category_id" class="form-control">
              <option value="">Select a Category</option>
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach

            </select>

          </div>

          <div class="col-sm-6">
            <br>
            <label>Book Author</label>
            <select name="author_ids[]" id="author_id" class="form-control select2" multiple="">
              <option value="">Select a Author</option>
              @foreach($authors as $author)
              <option value="{{$author->id}}">{{$author->name}}</option>
              @endforeach

            </select>

          </div>

        </div>
        <div class="row">

          <div class="col-sm-6">
            <br>
            <label>Book ISBN</label>
            <input type="text" name="isbn" class="form-control" placeholder="Book ISBN">

          </div>
          <div class="col-sm-6">
            <br>
            <label>Book Publisher</label>
            <select name="publisher_id" id="publisher_id" class="form-control">
              <option value="">Select a Publisher</option>
              @foreach($publishers as $publisher)
              <option value="{{$publisher->id}}">{{$publisher->name}}</option>
              @endforeach

            </select>

          </div>

        </div>

        <div class="row">
          <div class="col-sm-6">
            <br>
            <label>Book Publication Year</label>
            <select name="publish_year" id="publish_year" class="form-control">
              <option value="">Select a Publication Year</option>
              @for($year =date('Y') ; $year >= 1900 ; $year--)
              <option value="{{ $year }}">{{ $year }}</option>
              @endfor
            </select>

          </div>

          <div class="col-sm-6">
            <br>
            <label>Book Image</label>
            <input type="file" name="image" class="form-control" required="">
          </div>


          <div class="col-sm-6">
            <br>
            <label>Book Translator</label>
            <select name="translator_id" id="translator_id" class="form-control select2">
              <option value="">Select a Translator Book</option>
              @foreach($books as $book)
              <option value="{{$book->id}}">{{$book->title}}</option>
              @endforeach

            </select>

          </div>


          <div class="col-sm-12">
            <br>
            <label>Book Details</label>
            <textarea class="form-control" name="description" id="summernote" placeholder="Book Details" cols="4" rows="3"></textarea>

          </div>
        </div>



        <br>
        <br>
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <br>
      </form>
      @else
      <div class="card card-body">
       <p>
          <a href="{{ route('login') }}" class="btn btn-primary">Please Login To Uload your book</a>
       </p>
        
      </div>
      @endif
     
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('admin-asset/js/select2.min.js') }}"></script>
<script src="{{ asset('admin-asset/js/summernote.js') }}"></script>
<script>
  $(document).ready( function () {
    
    $('.select2').select2();
    $('#summernote').summernote();
  } );
</script>
@endsection