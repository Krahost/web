@extends('common.provider.layout.base')
{{ App::setLocale(  isset($_COOKIE['user_language']) ? $_COOKIE['user_language'] : 'en'  ) }}
@section('styles')
@parent

<link rel="stylesheet" href="{{ asset('assets/DataTables/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/DataTables/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/DataTables/css/style.css')}}">

<!-- <link rel='stylesheet' type='text/css' href="{{ asset('assets/input-file/style.css')}}"/> -->
<style type="text/css">
 header.topnav{
    /* position: relative;
    background: #fafafa; */
 }   
 .ticketContentBox{
    border-radius: 4px;
    background: #ffffff;
    box-shadow: 0px 1px 15px 1px rgba(81, 77, 92, 0.08);
    padding: 30px 30px 50px 30px !important;
    margin: 50px 30px 40px 130px;
 }
</style>
@stop
@section('content')
<section class="content-box ticketContentBox" id="Contact">
    <div class="heading dis-column">
        <hr>
        <h1 class=""><span class="">{{ __('My Tickets') }}</span></h1>
    </div>
    <div class="container">
        <div class="ticketMenu">
            <ul>
                <li><a  href="{{ url('provider/tickets') }}">Open Tickets</a></li>
                <li><a class="active" href="{{ url('provider/closed-tickets') }}">Closed Tickets</a></li>
                <li class="createBtn"><a class="btn btn-primary" href="{{ url('provider/new-tickets') }}">Create New Ticket</a></li>
            </ul>
        </div>
        <div class="ticketContent">
            <div class="ticketListTable">
                <table class="table table-striped cus-table" id="cus-table" width="100%">
                    <thead>
                      <tr>
                        <th>Ticket ID</th>
                        <th >Name</th>
                        <th >Created</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                   
                  </table>
            </div> <!-- ticketListTable -->
        </div> <!-- ticketContent --> 
    </div>
</section>


@stop

@section('scripts')
@parent
<script src="{{ asset('assets/plugins/data-tables/js/jquery.dataTables.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/DataTables/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/DataTables/js/dataTables.responsive-new.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/DataTables/js/responsive.bootstrap4-new.min.js')}}"></script>

<script>

var tableName = '#cus-table';
var table = $(tableName);
$(document).ready(function() {
    table = table.DataTable( {
        "processing": true,
        "serverSide": true,
        language: {
            searchPlaceholder: "Search"
        },
        "ajax": {
            "url": getBaseUrl() + "/provider/closed_tickets?&type=PROVIDER",
            "type": "GET",
            'beforeSend': function (request) {
                showLoader();
            },
            "headers": {
                "Authorization": "Bearer " + getToken("provider")
            },data: function(data){

                var info = $(tableName).DataTable().page.info();
                delete data.columns;

                data.page = info.page + 1;
                data.search_text = data.search['value'];
                data.order_by = $(tableName+' tr').eq(0).find('th').eq(data.order[0]['column']).data('value');
                data.order_direction = data.order[0]['dir'];
            },
            dataFilter: function(data){

                var json = parseData( data );
                console.log(json);
                json.recordsTotal = json.responseData.total;
                json.recordsFiltered = json.responseData.total;
                json.data = json.responseData.data;
                hideLoader();
                return JSON.stringify( json ); // return JSON string
            }
        },
        "columns": [
            { "data": "ticket_id" },
            { "data": "title" ,render: function (data, type, row) {
               return `<a href="{{ url('provider/view-tickets/`+row.id+`') }}"><p class="ticName"> [#`+row.ticket_id+`] ` +row.title+`</p></a>`;
               }
            },
            { "data": "created_at" },
            
            { "data": "status" ,render: function (data, type, row) {
                if(row.status == 0){
                        return "Open";
                }else if(row.status == 1){
                        return "Closed";
                }
                else{
                    return "Closed No Response";
                }
            }
            }

        ],
        "drawCallback": function () {

                var info = $(this).DataTable().page.info();
                if (info.pages<=1) {
                   $('.dataTables_paginate').hide();
                   $('.dataTables_info').hide();
                }else{
                    $('.dataTables_paginate').show();
                    $('.dataTables_info').show();
                }

            },
        dom: 'Bfrtip',
   // buttons: [
   //     'copyHtml5',
   //     'excelHtml5',
   //     'csvHtml5',
   //     'pdfHtml5'
   // ],
   //"scrollX": true,
   "pageLength": 10,
   "bPaginate": true,
   "info":     false,
   "ordering": true,
   "bFilter": true 
}), $( "#cus-table_wrapper .dt-buttons" ).prepend( "<span class='export-label'>Export to</span>" ).addClass('exportBtns'), $('#cus-table_wrapper .dataTables_filter').addClass('filterSearchBox'), $("#cus-table_wrapper .dataTables_filter").after("<div class='clearfix'></div>"), $('#cus-table_wrapper .dataTables_paginate').addClass('customDatatablePagenation'), $('#cus-table_wrapper').removeClass('form-inline');
       
           
    } );

</script>



@stop

