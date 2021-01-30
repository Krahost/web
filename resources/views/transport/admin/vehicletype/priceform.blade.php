{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'en'  ) }}
<link rel="stylesheet" href="{{ asset('assets/layout/css/transport_price.css')}}">


<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Price Settings</h4>
    <button type="button" class="close" data-dismiss="modal" style="display:inline-block;" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div>
    <input class="form-control" id="myInputList" type="text" placeholder="Search City..">
</div>


<div class="row p-2">

    <div class="col-md-4 box-card border-rightme myprice">

    </div>
    <div class="col-md-8 box-card price_lists_sty priceBody" style="height: 550px; overflow-y: scroll;">
        <form class="validateForm">
            <div class="col-xs-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="true">{{ __('Daily') }}</a>
                    </div>
                </nav>
                <div class="tab-content pricing-nav nav-wrapper" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="nav-daily-tab">

                        <!-- Pricing for Country -->
                        <div class="form-group col-md-12"></div>

                        <input type="hidden" id="countryId" value="" name="country_id">
                        <input type="hidden" id="cityId" value="" name="city_id">
                        <input type="hidden" id="vehicleId" value="" name="ride_delivery_vehicle_id">
                        <input type="hidden" id="ride_price_id" value="" name="ride_price_id">


                        <!-- Pricing for Country -->
                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label for="feFirstName">Pricing Logic</label>
                                <select class="form-control" name="calculator" id="calculator">
                                    <option value="MIN">Per Minute Pricing</option>
                                    <option value="HOUR">Per Hour Pricing</option>
                                    <option value="DISTANCE">Distance Pricing</option>
                                    <option value="DISTANCEMIN">Distance and Per Minute Pricing</option>
                                    <option value="DISTANCEHOUR">Distance and Per Hour Pricing</option>
                                </select>
                                <span class="txt_clr_4"><i id="changecal">Price Calculation: BP + (TM*PM)</i></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Hour Price (<span class="currency_value">$</span>0.00)</label>
                                <input class="form-control price" type="text" value="0.00" name="hour" id="hourly_price" placeholder="Set Hour Price( Only For DISTANCEHOUR )" min="0">
                                <span class="txt_clr_4"><i>PH (Per Hour), TH (Total Hours)</i></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Base Price (<span class="currency_value">$</span>0.00)</label>
                                <input class="form-control price" type="text" value="0.00" name="fixed" id="fixed" placeholder="Base Price" min="0">
                                <span class="txt_clr_4"><i>BP (Base Price)</i></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="feFirstName">Base Distance (0 <span class="distance_unit"></span>)</label>
                                <input class="form-control number" type="text" value="0.00" name="distance" id="distance" placeholder="Base Distance" min="0">
                                <span class="txt_clr_4"><i> BD (Base Distance)</i></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Unit Time Pricing (<span class="currency_value">$</span>0.00)</label>
                                <input class="form-control price" type="text" value="0.00" name="minute" id="minute" placeholder="Unit Time Pricing" min="0">
                                <span class="txt_clr_4"><i> PM (Per Minute), TM(Total Minutes)</i></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Unit Distance Pricing (0 <span class="distance_unit"></span>)</label>
                                <input class="form-control price" type="text" value="0.00" name="price" id="price" placeholder="Unit Distance Price" min="0">
                                <span class="txt_clr_4"><i> PKms (Per <span class="distance_unit"></span>), TKms (Total <span class="distance_unit"></span>)</i></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="feFirstName">Commission(%)</label>
                                <input class="form-control  decimal" type="text" value="0.00" name="commission" id="commission" placeholder="Commission" min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Fleet Commission(%)</label>
                                <input class="form-control  decimal" type="text" value="0.00" name="fleet_commission" id="fleet_commission" placeholder="Fleet Commission" min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Tax(%)</label>
                                <input class="form-control  decimal" type="text" value="0.00" name="tax" id="tax" placeholder="Tax" min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Peak Commission(%)</label>
                                <input class="form-control  decimal" type="text" value="0.00" name="peak_commission" id="peak_commission" placeholder="Peak Commission" min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Waiting Commission(%)</label>
                                <input class="form-control  decimal" type="text" value="0.00" name="waiting_commission" id="waiting_commission" placeholder="Waiting Commission" min="0">
                            </div>

                            <div class="custom-heading col-md-12 table-responsive">
                                <table id="country_serv_type" class="table table-hover table_width display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Time</th>
                                            <th>Peak Price(%) - Ride fare x Peak price(%)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="peak">

                                    </tbody>
                                </table>

                            </div>

                            <div class="custom-heading col-md-12">

                                <h4>Waiting Charges</h4>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="feFirstName">Waive off minutes</label>
                                <input class="form-control numbers" type="text" value="`+waiting_free_mins+`" name="waiting_free_mins" id="waiting_free_mins" placeholder="Waive off minutes" min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="feFirstName">Per Minute Fare</label>
                                <input class="form-control price" type="text" value="`+waiting_min_charge+`" name="waiting_min_charge" id="waiting_min_charge" placeholder="Per Minute Fare" min="0">
                            </div>

                            <div class="custom-heading col-md-12">

                                <h4>Geofence Area</h4>

                                <table id="country_serv_type" class="table table-hover table_width display" style="width:100%">
                                    <tbody class="geofence">

                                    </tbody>
                                </table>

                            </div>


                            <div class="form-group">
                                <div class="col-xs-10">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <button type="submit" class="btn btn-success ">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('common.admin.includes.redirect')
<script>
    basicFunctions();
    var id = '{{ $id }}';
    var currency_value = '';
    var distance_unit = '';

    $('body').on('click', '#calculator', function(event) {
        cal=$(this).val();
        priceInputs(cal);
    });

    function priceInputs(cal){
        if(cal=='MIN'){
            $("#hourly_price,#distance,#price").attr('value','');
            $("#minute").prop('disabled', false);
            $("#minute").prop('required', true);
            $("#hourly_price,#distance,#price").prop('disabled', true);
            $("#hourly_price,#distance,#price").prop('required', false);
            $("#changecal").text('BP + (TM*PM)');
        }
        else if(cal=='HOUR'){
            $("#minute,#distance,#price").attr('value','');
            $("#hourly_price").prop('disabled', false);
            $("#hourly_price").prop('required', true);
            $("#minute,#distance,#price").prop('disabled', true);
            $("#minute,#distance,#price").prop('required', false);
            $("#changecal").text('BP + (TH*PH)');
        }
        else if(cal=='DISTANCE'){
            $("#minute,#hourly_price").attr('value','');
            $("#price,#distance").prop('disabled', false);
            $("#price,#distance").prop('required', true);
            $("#minute,#hourly_price").prop('disabled', true);
            $("#minute,#hourly_price").prop('required', false);
            $("#changecal").text('BP + (T{{__("transport.admin.vehicletype.distance")}}-BD*P{{__("transport.admin.vehicletype.distance")}})');
        }
        else if(cal=='DISTANCEMIN'){
            $("#hourly_price").attr('value','');
            $("#price,#distance,#minute").prop('disabled', false);
            $("#price,#distance,#minute").prop('required', true);
            $("#hourly_price").prop('disabled', true);
            $("#hourly_price").prop('required', false);
            $("#changecal").text('BP + (T{{__("transport.admin.vehicletype.distance")}}-BD*P{{__("transport.admin.vehicletype.distance")}}) + (TM*PM)');
        }
        else if(cal=='DISTANCEHOUR'){
            $("#minute").attr('value','');
            $("#price,#distance,#hourly_price").prop('disabled', false);
            $("#price,#distance,#hourly_price").prop('required', true);
            $("#minute").prop('disabled', true);
            $("#minute").prop('required', false);
            $("#changecal").text('BP + ((T{{__("transport.admin.vehicletype.distance")}}-BD)*P{{__("transport.admin.vehicletype.distance")}}) + (TH*PH)');
        }
        else{
            $("#minute,#hourly_price").attr('value','');
            $("#price,#distance").prop('disabled', false);
            $("#price,#distance").prop('required', true);
            $("#minute,#hourly_price").prop('disabled', true);
            $("#minute,#hourly_price").prop('required', false);
            $("#changecal").text('BP + (T{{__("transport.admin.vehicletype.distance")}}-BD*P{{__("transport.admin.vehicletype.distance")}})');
        }
    }

    $('body').on('change', '.different_pricing', function() {
        if($(this).is(':checked')) {
            $(this).closest('tr').find('.form_container').show();
        } else {
            $(this).closest('tr').find('.form_container').hide();
        }
    });

    $.ajax({
        url: getBaseUrl() + "/admin/transport/price/get/" + id,
        type: "GET",
        async: false,
        headers: {
            Authorization: "Bearer " + getToken("admin")
        },
        beforeSend: function(request) {
            showInlineLoader();
        },
        success: function(data) {
            var countryCityList = '';
            var data = parseData(data);
            $.each(data.responseData, function(key, country) {

                countryCityList += `<label class="country_list_style">` + country.country_name + `<span class="pull-right"><i class="fa fa-files-o fa-lg" aria-hidden="true"></i></span></label>`;
                $.each(country.city, function(key1, city) {

                    if (key == 0 && key1 == 0) {
                        var cityActiveClass = "active";
                        getData(id, city.id, country.id);
                        $('.currency_value').text(country.country_symbol);
                        $('.distance_unit').text(country.distance_unit);
                        currency_value = country.country_symbol;
                        distance_unit = country.distance_unit;
                    } else {
                        var cityActiveClass = '';
                    }

                    countryCityList += `<a href="#" class="list-group-item cityActiveClass  ` + cityActiveClass + `" data-value="` + country.country_symbol + `" onclick="getData(` + id + `,` + city.id + `,` + country.id + `)" id="` + city.id + `"><span>` + city.city_name + `</span></a>`;

                });

            });

            $('.myprice').empty().append(`<div class="form-group">
                        <div class="select_city nav-wrapper"><div class="list-group">` + countryCityList + `</div> </div>
                    </div>
                `);
            hideInlineLoader();
        }
    });

    function getData(vehicleId, cityId, countryId) {

        $('.cityActiveClass').removeClass("active");
        $('#' + cityId).addClass(" active");
        $("#cityId").val(cityId);
        $("#countryId").val(countryId);
        $('#vehicleId').val(vehicleId);
        $('#calculator, #hourly_price, #fixed, #distance, #minute, #price, #commission, #tax, #peak_commission, #fleet_commission, #waiting_commission, #waiting_free_mins, #waiting_min_charge').val("");

        var url = getBaseUrl() + "/admin/rideprice/" + vehicleId + "/" + cityId;
        $.ajax({
            url: url,
            type: "GET",
            async: false,
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            'beforeSend': function(request) {
                showLoader();
            },
            success: function(data) {
                var data = parseData(data);
                var geofence = ``;
                $('.geofence').empty();
                $('.peak').empty();

                if (data.responseData.price.length != 0) {

                    var priceData = data.responseData.price;

                    $('#calculator').val(priceData.calculator);
                    $('#hourly_price').val(priceData.hour);
                    $('#fixed').val(priceData.fixed);
                    $('#distance').val(priceData.distance);
                    $('#minute').val(priceData.minute);
                    $('#price').val(priceData.price);
                    $('#commission').val(priceData.commission);
                    $('#tax').val(priceData.tax);
                    $('#peak_commission').val(priceData.fleet_commission);
                    $('#fleet_commission').val(priceData.waiting_commission);
                    $('#waiting_commission').val(priceData.waiting_commission);
                    $('#waiting_free_mins').val(priceData.waiting_free_mins);
                    $('#waiting_min_charge').val(priceData.waiting_min_charge);
                    $('#countryId').val(countryId);
                    $('#cityId').val(cityId);
                    
                    $('#ride_price_id').val(priceData.id);
                    priceInputs(priceData.calculator);

                }
                priceList = data.responseData.priceList;

                $.each(data.responseData.peakHour, function(key, value) {
                    if (typeof value.ridePeakhour !== 'undefined') {
                        peak_price = value.ridePeakhour.peak_price;
                        peak_price_id = value.ridePeakhour.id;

                    }
                    var sNo = key + 1;
                    $('.peak').append(`<tr>
                                            <td>` + sNo + `</td>
                                            <td>` + value.started_time + ` - ` + value.ended_time + `</td>
                                            <td>
                                            <input type="hidden" id="peak_price_id" name="peak_price[` + value.id + `][id]" value="` + peak_price_id + `" min="1">
                                                <input type="text" id="peak_price" name="peak_price[` + value.id + `][value]" value="` + peak_price + `" min="1">
                                            </td>
                                        </tr>`);
                });

                $.each(data.responseData.geofence, function(key, value) {
                    var price_list = priceList.find(price => price.geofence_id == value.id);
                    geofence += `<tr><td><label style="float:left; margin-bottom: 0; text-style: bold;" for='` + value.id + `'>
                            <input type='hidden' id='` + value.id + `' name='geofence_id[]' value='` + value.id + `' /><p style='float:right; font-weight: bold; padding-right:10px;'>
                            ` + value.location_name + `</p></label>`;

                    if (data.responseData.geofence.length > 1) {
                        geofence += `<label style="float:left; margin-bottom: 0;" >
                                <input class="different_pricing" type='checkbox' name="` + value.id + `_different_pricing" `;

                        var formContentText = ``;
                        var styleformText = "float:left; width: 100%; display: none;";

                        if (price_list != undefined ) {
                            if(price_list.pricing_differs == 1) {
                                styleformText = "float:left; width: 100%;";
                                geofence += ` checked="checked" `;
                            } 

                            var current_fixed = price_list.fixed;
                            var current_price = price_list.price;
                            var current_minute = price_list.minute;
                            var current_hour = price_list.hour;
                            var current_calculator = price_list.calculator;
                            var current_distance = price_list.distance;
                            var current_waiting_free_mins = price_list.waiting_free_mins;
                            var current_waiting_min_charge = price_list.waiting_min_charge;
                            var current_commission = price_list.commission;
                            var current_fleet_commission = price_list.fleet_commission;
                            var current_peak_commission = price_list.peak_commission;
                            var current_waiting_commission = price_list.waiting_commission;
                            var current_tax = price_list.tax;
                            var current_peak = '';
                            var current_peak_price = '';
                            var current_peak_price_id = '';

                            $.each(price_list.ridePeakhour, function(key, value) {
                                var sNo = key + 1;
                                current_peak += `<tr>
                                                        <td>` + sNo + `</td>
                                                        <td>` + value.started_time + ` - ` + value.ended_time + `</td>
                                                        <td>
                                                        <input type="hidden" id="peak_price_id" name="peak_price[` + value.id + `][id]" value="` + value.id + `" min="1">
                                                            <input type="text" id="peak_price" name="peak_price[` + value.id + `][value]" value="` + value.peak_price + `" min="1">
                                                        </td>
                                                    </tr>`;
                            });


                            formContentText = `
                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label for="feFirstName">Pricing Logic</label>
                                        <select class="form-control" name="` + value.id + `_calculator" id="calculator">
                                            <option value="MIN"  ` + (current_calculator == "MIN" ? 'selected' : '') + ` >Per Minute Pricing</option>
                                            <option value="HOUR"  ` + (current_calculator == "HOUR" ? 'selected' : '') + `>Per Hour Pricing</option>
                                            <option value="DISTANCE"  ` + (current_calculator == "DISTANCE" ? 'selected' : '') + `>Distance Pricing</option>
                                            <option value="DISTANCEMIN"  ` + (current_calculator == "DISTANCEMIN" ? 'selected' : '') + `>Distance and Per Minute Pricing</option>
                                            <option value="DISTANCEHOUR"  ` + (current_calculator == "DISTANCEHOUR" ? 'selected' : '') + `>Distance and Per Hour Pricing</option>
                                        </select>
                                        <span class="txt_clr_4"><i id="changecal">Price Calculation: BP + (TM*PM)</i></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Hour Price (` + currency_value + `0.00)</label>
                                        <input class="form-control" type="number" value="` + current_hour + `" name="` + value.id + `_hour" id="hourly_price" placeholder="Set Hour Price( Only For DISTANCEHOUR )" min="0">
                                        <span class="txt_clr_4"><i>PH (Per Hour), TH (Total Hours)</i></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Base Price (` + currency_value + `0.00)</label>
                                        <input class="form-control" type="number" value="` + current_fixed + `" name="` + value.id + `_fixed" id="fixed" placeholder="Base Price" min="0">
                                    <span class="txt_clr_4"><i>BP (Base Price)</i></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Base Distance (0 ` + distance_unit + `)</label>
                                        <input class="form-control" type="number" value="` + current_distance + `" name="` + value.id + `_distance" id="distance" placeholder="Base Distance" min="0">
                                        <span class="txt_clr_4"><i> BD (Base Distance)</i></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Unit Time Pricing (` + currency_value + `0.00)</label>
                                        <input class="form-control" type="number" value="` + current_minute + `" name="` + value.id + `_minute" id="minute" placeholder="Unit Time Pricing" min="0">
                                        <span class="txt_clr_4"><i> PM (Per Minute), TM(Total Minutes)</i></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Unit Distance Pricing (0 ` + distance_unit + `)</label>
                                        <input class="form-control" type="number" value="` + current_price + `" name="` + value.id + `_price" id="price" placeholder="Unit Distance Price" min="0">
                                        <span class="txt_clr_4"><i> PKms (Per ` + distance_unit + `), TKms (Total ` + distance_unit + `)</i></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Commission(%)</label>
                                        <input class="form-control decimal" type="text" value="` + (current_commission ? current_commission : 0) + `" name="commission" id="commission" placeholder="Commission" min="0">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Fleet Commission(%)</label>
                                        <input class="form-control decimal" type="text" value="` + current_fleet_commission + `" name="` + value.id + `_fleet_commission" id="fleet_commission" placeholder="Fleet Commission" min="0">
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label for="feFirstName">Tax(%)</label>
                                        <input class="form-control decimal" type="text" value="` + current_tax + `" name="` + value.id + `_tax" id="tax" placeholder="Tax" min="0">
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label for="feFirstName">Peak Commission(%)</label>
                                        <input class="form-control decimal" type="text" value="` + current_peak_commission + `" name="` + value.id + `_peak_commission" id="peak_commission" placeholder="Peak Commission" min="0">
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label for="feFirstName">Waiting Commission(%)</label>
                                        <input class="form-control decimal" type="text" value="` + current_waiting_commission + `" name="` + value.id + `_waiting_commission" id="waiting_commission" placeholder="Waiting Commission" min="0">
                                     </div>

                                     <div class="custom-heading col-md-12 table-responsive">
                                       <table id="country_serv_type" class="table table-hover table_width display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Time</th>
                                                    <th>Peak Price(%) - Ride fare x Peak price(%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            ` + current_peak + `

                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="custom-heading col-md-12">

                                        <h4>Waiting Charges</h4>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Waive off minutes</label>
                                        <input class="form-control numbers" type="number" value="` + current_waiting_free_mins + `" name="` + value.id + `_waiting_free_mins" id="waiting_free_mins" placeholder="Waive off minutes" min="0">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="feFirstName">Per Minute Fare</label>
                                        <input class="form-control price" type="number" value="` + current_waiting_min_charge + `" name="` + value.id + `_waiting_min_charge" id="waiting_min_charge" placeholder="Per Minute Fare" min="0">
                                    </div>`;

                        }

                        geofence += ` value='` + value.id + `' /><p style='float:right; padding-right:10px;'>
                                Pricing logic differs</p></label><div style="`+ styleformText +`" class="form_container" >` + formContentText + `</div>`;
                    }


                    geofence += `</td></tr>`;
                });

                $('.geofence').append(geofence);

                hideLoader();

            }

        });
    }

    $('.validateForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            calculator: {
                required: true
            },
            hour: {
                required: true
            },
            fixed: {
                required: true
            },
            distance: {
                required: true
            },
            minute: {
                required: true
            },
            price: {
                required: true
            },
            commission: {
                required: true
            },
            fleet_commission: {
                required: true
            },
            tax: {
                required: true
            },
            peak_commission: {
                required: true
            },
            waiting_commission: {
                required: true
            }
        },

        messages: {
            // vehicle_type: { required: "Vehicle Type is required." },
            calculator: {
                required: "Pricing Logic is required."
            },
            hour: {
                required: "Hour Price is required."
            },
            fixed: {
                required: "Base Price is required."
            },
            distance: {
                required: "Base Distance is required."
            },
            minute: {
                required: "Unit Time Price is required."
            },
            price: {
                required: "Unit Distance Price is required."
            },
            commission: {
                required: "Commission is required."
            },
            fleet_commission: {
                required: "Fleet Commission is required."
            },
            tax: {
                required: "Tax is required."
            },
            peak_commission: {
                required: "Peak Commission is required."
            },
            waiting_commission: {
                required: "Waiting Commission is required."
            }
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },

        success: function(label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        submitHandler: function(form) {

            var formGroup = $(".validateForm").serialize().split("&");

            var data = new FormData();

            for (var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append(decodeURIComponent(params[0]), decodeURIComponent(params[1]));
            }
            var url = getBaseUrl() + "/admin/rideprice";
            saveRow(url, table, data);

        }
    });

    $('.cancel').on('click', function() {
        $(".crud-modal").modal("hide");
    });
</script>