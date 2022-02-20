@extends('backend.layouts.app')
@section('admin-content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Manage Category</h1>
	<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-toggle="modal" data-target="#addModal"><i
		class="fas fa-plus-circle fa-sm text-white-50"></i> Add Category </a>
	</div>
	@include('backend.layouts.partials.message')

	<!--add modal-->

	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('admin.categories.store') }}" method="post">
						@csrf
						<div class="row">
							<div class="col-sm-6">
								<label>Category Name</label>
								<input type="text" name="name" class="form-control" placeholder="Category Name">

							</div>
							<div class="col-sm-6">
								<label>Category Url</label>
								<input type="text" name="slug" class="form-control" placeholder="Category Slug">

							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<br>
								<label for="parent_id">Parent Category</label>
								<select name="parent_id" id="parent_id" class="form-control">
									<option value="">Select a Category</option>
									@foreach($parent_categories as $parent)
									<option value="{{$parent->id}}">{{$parent->name}}</option>
									@endforeach
									
								</select>

							</div>
							
							<div class="col-sm-12">
								<br>
								<label>Category Description</label>
								<textarea class="form-control" name="description" placeholder="Message" cols="4" rows="3"></textarea>

							</div></div>


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
						<h6 class="m-0 font-weight-bold text-primary">Category Lists</h6>
					</div>
					<div class="card-body">
						<table class="table" id="dataTable">
							<thead>
								<tr>
									<th>SI</th>
									<th>Name</th>
									<th>Slug</th>
									<th>Parent_Category</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<td>{{ $category->id }}</td>
									<td>{{ $category->name }}</td>
									<td>
										<a href="{{ route('categories.show',$category->slug) }}">
											{{ route('categories.show',$category->slug) }}
										</a>
									</td>
									<td>
										@if(!is_null($category->parent_category($category->parent_id)))
										
											{{  $category->parent_category($category->parent_id)->name }}
									
										@else
										--
										@endif
										</td>
									
									<td>
										<a href="#editModal{{ $category->id }}" class="btn btn-success"data-toggle="modal"><i class="fa fa-edit"></i></a>
										<a href="#deleteModal{{ $category->id }}" class="btn btn-danger"data-toggle="modal"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<!--edit Modal-->
								<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="{{ route('admin.categories.update',$category->id) }}" method="post">
													@csrf
													<div class="row">
														<div class="col-sm-6">
															<label>Category Name</label>
															<input type="text" name="name" class="form-control" placeholder="Category Name" value="{{$category->name}}">

														</div>
														<div class="col-sm-6">
															<label>Category Url</label>
															<input type="text" name="link" class="form-control" placeholder="Category Url"value="{{$category->slug}}">

														</div>
													</div>

													<div class="row">
														<div class="col-sm-6">
															<br>
															<label for="parent_id">Parent Category</label>
															<select name="parent_id" id="parent_id" class="form-control">
																<option value="">Select a Category</option>
																@foreach($parent_categories as $parent)
																<option value="{{$parent->id}}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
																	{{ $parent->name }}
																</option>
																@endforeach

															</select>

														</div>
														

														<div class="col-sm-12">
															<br>
															<label>Category Description</label>
															<textarea class="form-control" name="description" placeholder="Message" cols="4" rows="3">{!!$category->description!!}</textarea>

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
								<div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete ?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="{{ route('admin.categories.delete',$category->id) }}" method="post">
													@csrf
													<div>
														{{ $category->name}} Will Be deleted  !!

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