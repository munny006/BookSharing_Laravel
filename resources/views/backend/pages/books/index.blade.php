@extends('backend.layouts.app')
@section('admin-content')
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Manage Book</h1>
	<a href="{{ route('admin.books.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
		class="fas fa-plus-circle fa-sm text-white-50"></i> Add Book </a>
	</div>
	@include('backend.layouts.partials.message')

	<!-- Content Row -->

	<div class="row">
		<div class="col-sm-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Book Lists</h6>
				</div>
				<div class="card-body">
					<table class="table" id="dataTable">
						<thead>
							<tr>
								<th>SI</th>
								<th>Name</th>
								<th>Slug</th>
								<th>Category</th>
								<th>Publisher</th>
								<th>Statistics</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($books as $book)
							<tr>
								<td>{{ $book->id }}</td>
								<td>{{ $book->title }}</td>
								<td>
									<a href="{{ route('books.show',$book->slug) }}">
										{{ route('categories.show',$book->slug) }}
									</a>
								</td>
								<td>
									{{ $book->category->name }}
								</td>
								<td>
									{{ $book->publisher->name }}
								</td>
									<td>
									<i class="fa fa-eye"></i>{{ $book->total_view }}
									<br>
									<i class="fa fa-search"></i>{{ $book->total_search}}
								</td>
								<td>
									@if($book->is_approved)
									<span class="badge badge-success">
										<i class="fa fa-check"></i> Approved
									</span>
									@else
									<span class="badge badge-danger">
										<i class="fa fa-times"></i> not Approved
									</span>
									@endif
								</td>
								<td>
									<a href="{{ route('admin.books.edit',$book->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
									<a href="#deleteModal{{ $book->id }}" class="btn btn-danger"data-toggle="modal"><i class="fa fa-trash"></i></a>
								</td>
							</tr>




							<!--delete Modal-->
								<div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete ?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="{{ route('admin.books.delete',$book->id) }}" method="post">
													@csrf
													<div>
														{{ $book->name}} Will Be deleted  !!

													</div>
													<br>
													<button type="submit" class="btn btn-danger">Ok, Confirm</button>
													<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>

												</form>
											</div>

										</div>
									</div>
								</div>

								<!--end Modal-->
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			

		</div>
		@endsection