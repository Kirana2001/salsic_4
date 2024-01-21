@extends('layout')

@section('title', 'Pemuda')

@section('css')
<style type="text/css">
	.datatable-column-width{
		overflow: hidden; text-overflow: ellipsis; max-width: 200px;
	}
</style>
@endsection

@section('content')
    <!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><span class="font-weight-semibold">Indeks</span> - Pemuda</h4>
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
				<a href="{{url('/pemudas/create')}}"><button type="button" class="btn btn-success rounded-round"><i class="icon-add mr-2"></i> Tambah</button></a>
			</div>

			<table class="table datatable-basic table-hover">
				<thead>
					<tr>
						<th style="width:5%;">No</th>
						<th>Organisasi</th>
						<th>Cabor</th>
                        {{-- <th>Tanggal Didirikan</th> --}}
						<th>Pendiri</th>
						<th>Ketua</th>
                        <th>Alamat</th>
                        {{-- <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Kota</th>
                        <th>Provinsi</th>
                        <th>Total Anggota</th> --}}
                        <th>Anggota Pria</th>
                        <th>Anggota Wanita</th>
                        {{-- <th>Dokumen</th> --}}
						<th style="text-align: center">Actions</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<!-- /hover rows -->

	</div>
	<!-- /content area -->

    <!-- Danger modal -->
	<div id="modal_theme_danger" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger" align="center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form action="" method="post" id="delform">
				    @csrf
				    @method('DELETE')
					<div class="modal-body" align="center">
						<h2> Hapus Data? </h2>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn bg-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /default modal -->
@endsection

@section('js')
    <script src="{{asset('global_assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/notifications/bootbox.min.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/buttons/spin.min.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/buttons/ladda.min.js')}}"></script>

    <script>
		//modal delete
		$(document).on("click", ".delbutton", function () {
		     var url = $(this).data('uri');
		     $("#delform").attr("action", url);
		});

		var DatatableBasic = function() {

		    // Basic Datatable examples
		    var _componentDatatableBasic = function() {
		        if (!$().DataTable) {
		            console.warn('Warning - datatables.min.js is not loaded.');
		            return;
		        }

		        // Setting datatable defaults
		        $.extend( $.fn.dataTable.defaults, {
		            autoWidth: false,
                    scrollX: true,
		            columnDefs: [{
		                orderable: false,
		                width: 100,
		                targets: [ 7 ]
		            }],
		            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
		            language: {
		                search: '<span>Search:</span> _INPUT_',
		                searchPlaceholder: 'Type to search...',
		                lengthMenu: '<span>Show:</span> _MENU_',
		                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
		            }
		        });

                let datas = [
                    {data:'DT_RowIndex', name:'no'},
                    {data: 'organization_name'},
                    {data: 'cabor_string'},
                    // {data: 'founding_date'},
                    {data: 'founder'},
                    {data: 'leader'},
                    {data: 'address'},
                    // {data: 'village'},
                    // {data: 'district'},
                    // {data: 'city'},
                    // {data: 'province'},
                    // {data: 'all_member'},
                    {data: 'male_member'},
                    {data: 'female_member'},
					// {data:null, render:function(data, type, row){
                    //     let html = '';
                    //     html += `
                    //     <div style="text-align:center">
                    //         <a href="{{ url('${data.document}')}}" target="_blank"><button type="button" class="btn btn-warning btn-icon"><i class="icon-eye" title="File"></i></button></a>
                    //     </div>
                    //     `;
                    //     return html
                    // }},
                    {data:null, render:function(data, type, row){
                        let html = '';
                        html += `
                        <div style="text-align:center">
                            <a href="{{ url('pemudas/${data.id}')}}"><button type="button" class="btn btn-success btn-icon"><i class="icon-file-text" title="Detail"></i></button></a>
                            <a href="{{ url('pemudas/${data.id}/edit')}}"><button type="button" class="btn btn-primary btn-icon"><i class="icon-pencil7" title="Edit"></i></button></a>
                            <a class="delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="{{ url('pemudas/${data.id}') }}"><button type="button" class="btn btn-danger btn-icon"><i class="icon-x" title="Delete"></i></button></a>
                        </div>
                        `;
                        return html
                    }}
                ];

		        // Basic datatable
		        $('.datatable-basic').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
                            url: "{{url('/pemudas-datatable')}}",
                            type: "GET",
                        },
					columns: datas,
					"order": [[ 0, "desc" ]],
				});

		        // Alternative pagination
		        $('.datatable-pagination').DataTable({
		            pagingType: "simple",
		            language: {
		                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
		            }
		        });

		        // Datatable with saving state
		        $('.datatable-save-state').DataTable({
		            stateSave: true
		        });

		        // Scrollable datatable
		        var table = $('.datatable-scroll-y').DataTable({
		            autoWidth: true,
		            scrollY: 300
		        });

		        // Resize scrollable table when sidebar width changes
		        $('.sidebar-control').on('click', function() {
		            table.columns.adjust().draw();
		        });
		    };


		    //
		    // Return objects assigned to module
		    //

		    return {
		        init: function() {
		            _componentDatatableBasic();
		        }
		    }
		}();

		// Initialize module
		// ------------------------------

		document.addEventListener('DOMContentLoaded', function() {
		    DatatableBasic.init();
		});
	</script>

	<script type="text/javascript">
		$( document ).ready(function() {
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