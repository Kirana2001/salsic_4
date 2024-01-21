@extends('layout')

@section('title', 'Atlet')

@section('css')

@endsection

@section('content')
    <!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><span class="font-weight-semibold">Detail</span> - Atlet</h4>
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
				<form id="submit-form" class="form-validate-jquery" action="{{url('atlets/'.$atlet->id.'/update-status')}}" method="get">
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Atlet</legend>

                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Foto</label>
                            <label class="col-form-label col-lg-2">
                                <img class="card-img img-fluid" id="preview_image"
                                src="{{asset($atlet->image)}}" alt="" style="height:150px;width:150px;object-fit: contain;">
                            </label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Nama</label>
                            <label class="col-form-label col-lg-10">{{$atlet->name}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">NIK</label>
                            <label class="col-form-label col-lg-10">{{$atlet->nik}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">No KK</label>
                            <label class="col-form-label col-lg-10">{{$atlet->no_kk}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Cabor</label>
                            <label class="col-form-label col-lg-10">{{$atlet->gender}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Cabor</label>
                            <label class="col-form-label col-lg-10">{{$atlet->cabor->name}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Tempat Lahir</label>
                            <label class="col-form-label col-lg-10">{{$atlet->birth_place}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Tanggl Lahir</label>
                            <label class="col-form-label col-lg-10">{{$atlet->birth_date}}</label>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Provinsi</label>
							<label class="col-form-label col-lg-10">{{$atlet->province}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Kota</label>
                            <label class="col-form-label col-lg-10">{{$atlet->city}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Asal Sekolah</label>
                            <label class="col-form-label col-lg-10">{{$atlet->school}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Email</label>
                            <label class="col-form-label col-lg-10">{{$atlet->email}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">No Rekening</label>
                            <label class="col-form-label col-lg-10">{{$atlet->no_rek}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Bank</label>
                            <label class="col-form-label col-lg-10">{{$atlet->bank}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Telepon</label>
                            <label class="col-form-label col-lg-10">{{$atlet->phone}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Lini</label>
                            <label class="col-form-label col-lg-10">{{$atlet->lini}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Klasifikasi</label>
                            <label class="col-form-label col-lg-10">{{$atlet->klasifikasi}}</label>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Status</label>
                            <label class="col-form-label col-lg-10">
                                <select name="status_id" id="status_id"
                                class="form-control form-control-select2" data-container-css-class="border-blue-700"
                                data-dropdown-css-class="border-blue-700" required>
                                @foreach ($statuses as $status)
                                    <option value="{{$status->id}}" {{$atlet->status_id == $status->id ? 'selected' : ''}}>{{$status->name}}</option>
                                @endforeach
                                </select>
                            </label>
						</div>

					</fieldset>
					<div class="text-right">
						<a href="{{ url('/atlets')}}" class="btn btn-light">Kembali <i class="icon-undo"></i></a>
						<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
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
    <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>

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
