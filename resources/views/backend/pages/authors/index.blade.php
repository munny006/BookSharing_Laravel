@extends('backend.layouts.app')
@section('admin-content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Manage Authors</h1>
	<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-toggle="modal" data-target="#addModal"><i
		class="fas fa-plus-circle fa-sm text-white-50"></i> Add Author </a>
	</div>
	@include('backend.layouts.partials.message')

	<!--add modal-->

	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add New Author</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('admin.authors.store') }}" method="post">
						@csrf
						<div class="row">
							<div class="col-sm-12">
								<label>Author Name</label>
								<input type="text" name="name" class="form-control" placeholder="Author Name">

							</div>


							<div class="col-sm-12">
								<br>
								<label>Author Description</label>
								<textarea class="form-control" name="description" placeholder="Message" cols="4" rows="3"></textarea>

							</div>

						</div>
						<br>
						<button type="submit" class="btn btn-primary">Save changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</form>
				</div>

			</div>
		</div>
	</div>

	<!--end modal-->


	<!-- Content Row -->

	<div class="row">
		<div class="col-sm-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Author Lists</h6>
				</div>
				<div class="card-body">
					<table class="table" id="dataTable">
						<thead>
							<tr>
								<th>SI</th>
								<th>Name</th>
								<th>Link</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($authors as $author)
							<tr>
								<td>{{ $author->id }}</td>
								<td>{{ $author->name }}</td>
								<td>{{ $author->link }}</td>
								<td>
									<a href="#editModal{{ $author->id }}" class="btn btn-success"data-toggle="modal"><i class="fa fa-edit"></i></a>
									<a href="#deleteModal{{ $author->id }}" class="btn btn-danger"data-toggle="modal"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<!--edit Modal-->
							<div class="modal fade" id="editModal{{ $author->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edit Author</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('admin.authors.update',$author->id) }}" method="post">
												@csrf
												<div class="row">
													<div class="col-sm-12">
														<label>Author Name</label>
														<input type="text" name="name" class="form-control" placeholder="Author Name" value="{{ $author->name}}">

													</div>


													<div class="col-sm-12">
														<br>
														<label>Author Description</label>
														<textarea class="form-control" name="description" placeholder="Message" cols="4" rows="3">{!! $author->description!!}</textarea>

													</div>

												</div>
												<br>
												<button type="submit" class="btn btn-primary">Update</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
											</form>
										</div>

									</div>
								</div>
							</div>

							<!--end Modal-->




							<!--delete Modal-->
							<div class="modal fade" id="deleteModal{{ $author->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete ?</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('admin.authors.delete',$author->id) }}" method="post">
												@csrf
												<div>
													{{ $author->name}} Will Be deleted  !!
													
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

	</div>
	@endsection