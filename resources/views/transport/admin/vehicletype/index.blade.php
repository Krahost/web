@extends('common.admin.layout.base')
{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'en'  ) }}

@section('title') {{ __('transport.admin.vehicletype.title') }} @stop

@section('styles')
@parent
<link rel="stylesheet" type='text/css' href="{{ asset('assets/plugins/cropper/css/cropper.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/dataTables.bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/responsive.bootstrap.min.css')}}">

@stop

@section('content')
@include('common.admin.includes.image-modal')
<div class="main-content-container container-fluid px-4">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">{{ __('transport.admin.vehicletype.title') }}</span>
            <h3 class="page-title">{{ __('transport.admin.vehicletype.title') }} </h3>
        </div>
    </div>
    <div class="row mb-4 mt-20">
        <div class="col-md-12">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0 pull-left">{{ __('transport.admin.vehicletype.title') }}</h6>
                    @permission('add-vehicle-type')
                    <a href="javascript:;" class="btn btn-success pull-right add"><i class="fa fa-plus"></i> {{ __('transport.admin.vehicletype.add') }}</a>
                    @endpermission

                </div>

                <div class="col-md-12v">
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
                            <!-- <th>{{ __('transport.admin.vehicle.type') }}</th> -->
                            <th data-value="vehicle_name">{{ __('transport.admin.vehicle.name') }}</th>
                            <th data-value="vehicle_image">{{ __('transport.admin.vehicle.image') }}</th>
                            <th data-value="vehicle_marker">{{ __('transport.admin.vehicle.marker') }}</th>
                            <th data-value="vehicle_marker">{{ __('transport.admin.vehicle.type') }}</th>
                            <th data-value="capacity">{{ __('transport.admin.vehicle.capacity') }}</th>
                            <th data-value="status">@lang('admin.status')</th>
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
<script src="{{ asset('assets/plugins/cropper/js/cropper.js')}}"> </script>
<script src="{{ asset('assets/layout/js/crop.js')}}"> </script>
<script>

    function CryptoJSAesDecrypt(passphrase, encrypted_json_string) {
        var obj_json = encrypted_json_string;
        var encrypted = obj_json.ciphertext;
        var salt = CryptoJS.enc.Hex.parse(obj_json.salt);
        var iv = CryptoJS.enc.Hex.parse(obj_json.iv);

        var key = CryptoJS.PBKDF2(passphrase, salt, {
            hasher: CryptoJS.algo.SHA1,
            keySize: 32 / 8,
            iterations: 999
        });

        //var decrypted = CryptoJS.AES.decrypt(encrypted, key, { iv: iv});

        var decrypted = CryptoJS.AES.decrypt(encrypted, key, {
            iv: iv,
            padding: CryptoJS.pad.Pkcs7,
            mode: CryptoJS.mode.CBC

        });

        //console.log(decrypted);

        return decrypted.toString(CryptoJS.enc.Utf8);
    }


    var tableName = '#data-table';
    var table = $(tableName);
    $(document).ready(function() {

        $("#myInputList").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".list-group a").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.add').on('click', function(e) {
            e.preventDefault();
            $.get("{{ url('admin/vehicletype/create') }}", function(data) {
                $('.crud-modal .modal-container').html("");
                $('.crud-modal .modal-container').html(data);
            });
            $('.crud-modal').modal('show');
        });

        $('body').on('click', '.edit', function(e) {
            e.preventDefault();
            $.get("{{ url('admin/vehicletype/') }}/" + $(this).data('id') + "/edit", function(data) {
                $('.crud-modal .modal-container').html("");
                $('.crud-modal .modal-container').html(data);
            });
            $('.crud-modal').modal('show');
        });

        $('body').on('click', '.price_btn', function(e) {
            e.preventDefault();
            $.get("{{ url('admin/vehicletype/priceform') }}/" + $(this).data('id'), function(data) {
                $('.crud-modal .modal-container').html("");
                $('.crud-modal .modal-container').html(data);
            });
            $('.crud-modal').modal('show');
        });


        table = table.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": getBaseUrl() + "/admin/vehicle",
                "type": "GET",
                'beforeSend': function(request) {
                    showLoader();
                },
                "headers": {
                    "Authorization": "Bearer " + getToken("admin")
                },
                data: function(data) {

                    var info = $(tableName).DataTable().page.info();
                    delete data.columns;

                    data.page = info.page + 1;
                    data.search_text = data.search['value'];
                    data.order_by = $(tableName + ' tr').eq(0).find('th').eq(data.order[0]['column']).data('value');
                    data.order_direction = data.order[0]['dir'];
                },
                dataFilter: function(data) {
                    var json = parseData(data);
                    var encdata = CryptoJSAesDecrypt('FbcCY2yCFBwVCUE9R+6kJ4fAL4BJxxjd', json.responseData);
                    var pdata = parseData(encdata);
                    var sdata = {};
                    sdata.recordsTotal = pdata.total;
                    sdata.recordsFiltered = pdata.total;
                    sdata.data = pdata.data;
                    hideLoader();
                    return JSON.stringify(sdata);
                }
            },
            "columns": [{
                    "data": "id",
                    render: function(data, type, row, meta) {

                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                // { "data": "vehicle_type" },
                {
                    "data": "vehicle_name"
                },
                {
                    "data": "vehicle_image",
                    render: function(data, type, row) {
                        return "<img src='" + data + "' style='height: 50px; width: 60px '>";
                    }
                },
                {
                    "data": "vehicle_marker",
                    render: function(data, type, row) {
                        return "<img src='" + data + "' style='height: 50px'>";
                    }
                },
                {
                    "data": "ride_type",
                    render: function(data, type, row) {
                        return data.ride_name;
                    }
                },
                {
                    "data": "capacity"
                },
                {
                    "data": "status",
                    render: function(data, type, row) {

                        if (data == 1) {
                            return "@permission('vehicle-type-status')<label class='switch'><input type='checkbox' class='status_enable switch-warning' checked data-id='" + row.id + "' data-value='" + row.status + "'> <span class='slider round'></span></label>@endpermission"

                        } else {
                            return "@permission('vehicle-type-status')<label class='switch'><input type='checkbox' class='status_enable'  data-id='" + row.id + "' data-value='" + row.status + "'> <span class='slider round'></span></label>@endpermission"
                        }
                    }
                },
                {
                    "data": function(data, type, row) {

                        if (data.status == 1) {
                            var status = "Disable";
                        } else {
                            var status = "Enable";
                        }
                        if ('{{ Helper::getDemomode() }}' != 1) {

                            var button = `<div class="input-group-btn action_group"> <li class="action_icon">
                    <button type="button"class="btn btn-info btn-block "data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true" title="View"></i></button>
                    <ul class="dropdown-menu">
                    <li>@permission("vehicle-type-price")<a href="javascript:;" data-id="` + data.id + `" class="dropdown-item price_btn"><i class="fa fa-money"></i> Price</a>@endpermission </li>
                    <li>@permission("edit-vehicle-type")<a href="javascript:;" data-id="` + data.id + `" class="dropdown-item edit"><i class="fa fa-edit"></i> Edit</a>@endpermission </li>
                    </ul> </li></div>`;
                            return button;
                        } else {
                            return '<h6 style="text-align: center;">-</h6>';
                        }
                    }
                }

            ],
            responsive: true,
            paging: true,
            info: true,
            lengthChange: false,
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
            }],
            "drawCallback": function() {

                var info = $(this).DataTable().page.info();
                if (info.pages <= 1) {
                    $('.dataTables_paginate').hide();
                    $('.dataTables_info').hide();
                } else {
                    $('.dataTables_paginate').show();
                    $('.dataTables_info').show();
                }
            }
        });

        $('body').on('click', '.status_enable', function() {
            var id = $(this).data('id');
            var value = $(this).data('value');

            $(".status-modal").modal("show");
            $(".status-modal-btn")
                .off()
                .on("click", function() {


                    var url = getBaseUrl() + "/admin/vehicle/" + id + '/updateStatus?status=' + value;

                    $.ajax({
                        type: "GET",
                        url: url,
                        headers: {
                            Authorization: "Bearer " + getToken("admin")
                        },
                        'beforeSend': function(request) {
                            showInlineLoader();
                        },
                        success: function(data) {
                            $(".status-modal").modal("hide");

                            var info = $('#data-table').DataTable().page.info();
                            table.order([
                                [info.page, 'asc']
                            ]).draw(false);
                            alertMessage("Success", data.message, "success");
                            hideInlineLoader();
                        }
                    });
                });

        });

    });

$('body').on('click', '.addService', function(event) {
        event.preventDefault();
        $.ajax({
            url: getBaseUrl() + "/admin/comission",
            type: 'POST',
            data: $('#' + this.id).serialize(),
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            success: function(response, textStatus, xhr) {
                alert(xhr.responseJSON.message);
                $(".modal").modal("hide");

            },
            error: function(xhr, textStatus) {
                alert(xhr.responseJSON.message);
            }
        });
    });


</script>
@stop