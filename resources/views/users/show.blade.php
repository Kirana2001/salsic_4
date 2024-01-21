@extends('layout')

@section('title', 'User')

@section('css')

@endsection

@section('content')
    <!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><span class="font-weight-semibold">Detail</span> - User</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>
	</div>
	<!-- /page header -->

    <!-- Content area -->
	<div class="content">

		<!-- Hover rows -->
		<div class="card">
			<div class="card-header header-elements-inline">
			</div>
			<div class="card-body">
				<form id="submit-form" class="form-validate-jquery" action="{{url('users/'.$user->id.'/edit')}}" method="get">
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data User</legend>

                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Foto</label>
                            <label class="col-form-label col-lg-10">
                                <img class="card-img img-fluid" id="preview_image"
                                src="{{asset($user->image)}}" alt=""
                                style="height:150px;width:150px;object-fit: contain;">
                            </label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Nama</label>
                            <label class="col-form-label col-lg-10">{{$user->name}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Username</label>
                            <label class="col-form-label col-lg-10">{{$user->username}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Email</label>
                            <label class="col-form-label col-lg-10">{{$user->email}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Telepon</label>
                            <label class="col-form-label col-lg-10">{{$user->phone}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Role</label>
                            <label class="col-form-label col-lg-10">{{$user->role->name}}</label>
						</div>

					</fieldset>
					<div class="text-right">
						<a href="{{ url('/users')}}" class="btn btn-light">Kembali <i class="icon-undo"></i></a>
						<button type="submit" class="btn btn-primary">Edit <i class="icon-pencil7 ml-2"></i></button>
					</div>
				</form>
			</div>

		</div>
		<!-- /hover rows -->

	</div>
	<!-- /content area -->
@endsection

@section('js')
    <script src="{{asset('global_assets/js/plugins/notifications/pnotify.min.js')}}"></script>

	<script type="text/javascript">
		$( document ).ready(function() {
            // Select2
            var $select = $('.form-control-select2').select2();

	        // Default style
	        @if(session('error'))
	            new PNotify({
	                title: 'Error',
	                text: '{{ session('error') }}.',
	                icon: 'icon-blocked',
	                type: 'error'
	            });
            @endif
            @if ( session('success'))
	            new PNotify({
	                title: 'Success',
	                text: '{{ session('success') }}.',
	                icon: 'icon-checkmark3',
	                type: 'success'
	            });
            @endif

		});
	</script>
@endsection
