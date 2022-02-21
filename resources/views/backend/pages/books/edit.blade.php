@extends('backend.layouts.app')
@section('admin-content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Edit Book - {{ $book->title }}</h1>
	
</div>
@include('backend.layouts.partials.message')

<div class="row">
	<div class="col-md-12">
		<form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-sm-6">
					<label>Book Title</label>
					<input type="text" name="title" class="form-control" placeholder="Book Title" value="{{ $book->title }}">

				</div>

				<div class="col-sm-6">
					<label>Book URL</label>
					<input type="text" name="slug" class="form-control" placeholder="Book URL"value="{{ $book->slug }}">

				</div>
				<div class="col-sm-6">
					<br>
					<label>Book Category</label>
					<select name="category_id" id="category_id" class="form-control">
						<option value="">Select a Category</option>
						@foreach($categories as $category)
						<option value="{{$category->id}}"{{ $book->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
						@endforeach

					</select>

				</div>

				<div class="col-sm-6">
					<br>
					<label>Book Author</label>
					<select name="author_ids[]" id="author_id" class="form-control select2" multiple="">
						<option value="">Select a Author</option>
						@foreach($authors as $author)
						<option value="{{$author->id}}" {{ App\Models\Book::isAuthorSeleted($book->id,$author->id) ? 'selected' : '' }}>{{$author->name}}</option>
						@endforeach

					</select>

				</div>


				<div class="col-sm-6">
					<br>
					<label>Book ISBN</label>
					<input type="text" name="isbn" class="form-control" placeholder="Book ISBN" value="{{ $book->isbn }}">

				</div>




				<div class="col-sm-6">
					<br>
					<label>Book Publisher</label>
					<select name="publisher_id" id="publisher_id" class="form-control">
						<option value="">Select a Publisher</option>
						@foreach($publishers as $publisher)
						<option value="{{$publisher->id}}" {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>{{$publisher->name}}</option>
						@endforeach

					</select>

				</div>

				<div class="col-sm-6">
					<br>
					<label>Book Publication Year</label>
					<select name="publish_year" id="publish_year" class="form-control">
						<option value="">Select a Publication Year</option>
						@for($year =date('Y') ; $year >= 1900 ; $year--)
						<option value="{{ $year }}" {{ $book->publish_year == $year ? 'selected' : '' }}>{{ $year }}</option>
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
						@foreach($books as $tb)
						<option value="{{$book->id}}"{{ $tb->id == $book->translator_id ? 'selected':'' }}>{{$tb->title}}</option>
						@endforeach

					</select>

				</div>




				<div class="col-sm-12">
					<br>
					<label>Book Details</label>
					<textarea class="form-control" name="description" id="summernote" placeholder="Book Details" cols="4" rows="3">{!!$book->description !!}</textarea>

				</div>

			</div>
			<br>
			<br>
			<button type="submit" class="btn btn-primary">Save changes</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</form>


	</div>

</div>

@endsection