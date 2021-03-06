	<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
			
				<div class="sidebar-brand-text mx-3">Admin panel</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="{{ route('admin.index') }}">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Interface
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
					aria-expanded="true" aria-controls="collapseTwo">
					<i class="fas fa-fw fa-file"></i>
					<span>Books</span>
				</a>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Manage Books & All </h6>
						<a class="collapse-item" href="{{ route('admin.books.index') }}">Books</a>
						<a class="collapse-item" href="{{ route('admin.categories.index') }}">Categories</a>
						<a class="collapse-item" href="{{ route('admin.authors.index') }}">Authors</a>
						<a class="collapse-item" href="{{ route('admin.publishers.index') }}">Publishers</a>
					</div>
				</div>
			</li>

		

		</ul>