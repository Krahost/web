@extends('common.admin.layout.base')
{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'en'  ) }}

@section('title') {{ __('Tickets') }} @stop

@section('styles')
@parent
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/dataTables.bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet"  type='text/css' href="{{ asset('assets/plugins/cropper/css/cropper.css')}}" />
@stop

@section('content')

<div class="main-content-container container-fluid px-4">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">{{ __('Tickets') }}</span>
            <h3 class="page-title">{{ __('Tickets') }} {{ __('List') }}</h3>
        </div>
    </div>
    <div class="row mb-4 mt-20">
        <div class="col-md-12">
            <div class="card card-small">
               <div class="card-header border-bottom ">
                    <h6 class="m-0 pull-left">{{ __('Tickets') }}</h6>
                    <div class="slRight sortFilterBox">
                        <label class="sortFilter">Filter: </label>
                        <select class="form-control statuslist" name="statuslist" >           
                                <option value='0'>Open Tickets</option>
                                <option value='1'>Closed Tickets</option>
                                <option value='2'>Closed No Response</option>
                                <option value='ALL'>All Tickets</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="note_txt">
                        @if(Helper::getDemomode() == 1)
                        <p>** Demo Mode : {{ __('admin.demomode') }}</p>
                        <span class="pull-left">(*personal information hidden in demo)</span>
                        @endif
                    </div>
                </div>

                <table id="data-table" class="table table-hover table_width display">
                <thead>
                    <tr>
                            <th data-value="id">@lang('admin.id')</th>
                            <th data-value="ticket_id">@lang('admin.ticket_categories.type')</th>
                            <th data-value="ticket_id">@lang('admin.ticket_categories.ticket_id')</th>
                            <th data-value="admin_Services">@lang('admin.ticket_categories.admin_service')</th>
                            <th data-value="name">@lang('admin.ticket_categories.name')</th>
                            <th data-value="name">@lang('admin.ticket_categories.title')</th>
                            <th data-value="status">@lang('admin.ticket_categories.status')</th>
                            <th>@lang('admin.action')</th>
                    </tr>
                 </thead>


                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
@parent

<script src="{{ asset('assets/plugins/data-tables/js/buttons.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/jszip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/buttons.html5.min.js')}}"></script>
<script>
var tableName = '#data-table';
var table = $(tableName);
$(document).ready(function() {

 $('body').on('click', '.edit', function() {

        $.get("{{ url('admin/view-tickets/') }}/"+$(this).data('id')+"", function(data) {
           
        });
    
    });
var statuslist = localStorage.getItem("statuslist");
if(statuslist == null) statuslist = $('.statuslist').val();
$('.statuslist option[value="'+statuslist+'"]').prop('selected',true);

$('.statuslist').change(function(){
    var statuslist=$('.statuslist').val();
    localStorage.setItem("statuslist", statuslist);
    showLoader();
    location.reload();
});
    table = table.DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": getBaseUrl() + "/admin/my_tickets?&status="+statuslist,
            "type": "GET",
            "headers": {
                "Authorization": "Bearer " + getToken("admin")
            },
            
            data: function(data){

                var info = $(tableName).DataTable().page.info();
                delete data.columns;
                data.page = info.page + 1;
                data.search_text = data.search['value'];
                data.order_by = $(tableName+' tr').eq(0).find('th').eq(data.order[0]['column']).data('value');
                data.order_direction = data.order[0]['dir'];



            },
            dataFilter: function(data){

                var json = parseData( data );

                json.recordsTotal = json.responseData.total;
                json.recordsFiltered = json.responseData.total;
                json.data = json.responseData.data;
                hideLoader();
                return JSON.stringify( json ); // return JSON string
            }
        },
        "columns": [
            { "data": "id" ,render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1;
              }
            },
            { "data": "type" },
            { "data": "ticket_id" },
            { "data": "admin_service" },
            { "data": "category" ,render: function (data, type, row) {
                
                    return row.ticket_category  ?  row.ticket_category.name : "OTHER";
                }
            },
            { "data": "title" },
            { "data": "status", render: function(data,type,row){
          
                if(data == 0){
                    return "<span class='badge badge-pill badge-info'>Open</span>";
                }else if(data == 1){
                    return "<span class='badge badge-pill badge-danger'>Closed</span>" ;
                }
                else
                {
                    return "<span class='badge badge-pill badge-info'>Closed No Response</span>";
                }
            } },
            { "data": "id", render: function (data, type, row) {
                var button='<div class="input-group-btn action_group"> <li class="action_icon"> <button type="button"class="btn btn-info btn-block "data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true" title="View"></i></button>'+
                   '<ul class="dropdown-menu">';

                   button +='<li><a href="{{ url('admin/view-tickets/') }}/'+data+'" data-id="'+data+'" class="dropdown-item edit"><i class="fa fa-edit"></i> Support</a> </li>';

                    button +='<li><a href="javascript:;" data-id="'+data+'" data-value="0" class="dropdown-item status_enable"><i class="fa fa-window-close" aria-hidden="true"></i> Closed</a> </li>';
                     button +='<li><a href="javascript:;" data-id="'+data+'" data-value="1" class="dropdown-item status_enable"><i class="fa fa-window-close" aria-hidden="true"></i> Closed No Response</a> </li>';

                    button +='</ul> </li></div>';
                 return  button;
            }}

        ],
        responsive: true,
        paging:true,
            info:true,
            lengthChange:false,
            dom: 'Bfrtip',
            buttons: [{
               extend: "copy",
               exportOptions: {
                   columns: [":visible :not(:last-child)"]
               }
            }, {
               extend: "csv",
               exportOptions: {
                   columns: [":visible :not(:last-child)"]
               }
            }, {
               extend: "excel",
               exportOptions: {
                   columns: [":visible :not(:last-child)"]
               }
            }, {
               extend: "pdf",
               exportOptions: {
                   columns: [":visible :not(:last-child)"]
               }
            }],"drawCallback": function () {

                var info = $(this).DataTable().page.info();
                if (info.pages<=1) {
                   $('.dataTables_paginate').hide();
                   $('.dataTables_info').hide();
                }else{
                    $('.dataTables_paginate').show();
                    $('.dataTables_info').show();
                }
            }
    } );
    $('body').on('click', '.status_enable', function() {
        var id = $(this).data('id');
        var value = $(this).data('value');

         $(".status-modal").modal("show");
            $(".status-modal-btn")
                .off()
                .on("click", function() {


                    var url = getBaseUrl() + "/admin/tickets/"+id+'/updateStatus?status='+value;

                    $.ajax({
                        type:"GET",
                        url: url,
                        headers: {
                            Authorization: "Bearer " + getToken("admin")
                        },
                        'beforeSend': function (request) {
                            showInlineLoader();
                        },
                        success:function(data){
                            $(".status-modal").modal("hide");

                            var info = $('#data-table').DataTable().page.info();
                            table.order([[ info.page, 'asc' ]] ).draw( false );
                            alertMessage("Success", "Status Changed", "success");
                            hideInlineLoader();
                        },
                        error:function(jqXHR, textStatus, errorThrown){
                            $(".status-modal").modal("hide");

                            if (jqXHR.status == 401 && getToken(guard) != null) {
                                refreshToken(guard);
                            } else if (jqXHR.status == 401) {
                                window.location.replace("/admin/login");
                            }

                            if (jqXHR.responseJSON) {
                                alertMessage(textStatus, jqXHR.responseJSON.message, "danger");
                            }
                            hideInlineLoader();
                        }
                    });
                });

    });


    $('body').on('click', '.delete', function() {
        var id = $(this).data('id');
        var url = getBaseUrl() + "/admin/ticketCategory/"+id;
        deleteRow(id, url, table);
    });

} );
</script>
@stop
