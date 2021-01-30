{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'en'  ) }}
<div class="row">
    <div class="col-md-12">
        <div class="card-header border-bottom">
            @if(empty($id))
                @php($action_text=__('admin.vehicletype.add'))
            @else
                @php($action_text=__('admin.vehicletype.edit'))
                
            @endif
            <h6 class="m-0"style="margin:10!important;">{{$action_text}}</h6>
        </div>
        <div class="popup-card-content">
        <div class="popup-card-content-in">
            <form class="validateForm">
                @if(!empty($id))
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="{{$id}}">
                @endif
                <div class="form-row">
                 <div class="form-group col-md-6">
					<label for="delivery_type_id" class="col-xs-2 col-form-label">@lang('delivery.admin.vehicletype.add')</label>
						<select name="delivery_type_id" class="form-control" id="delivery_type_id">
                            <option value="">Select</option>
						
						</select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="vehicle_name">{{ __('admin.vehicle.vehicle_name') }}</label>
                        <input type="text" class="form-control" id="vehicle_name" name="vehicle_name" placeholder="Vehicle Type Name" value="" autocomplete="off">
                    </div>
				</div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="vehicle_image">{{ __('admin.vehicle.vehicle_image') }}</label>
                        <div class="image-placeholder w-100">
                            <img width="100" height="100" />
                            <input type="file" name="vehicle_image" class="upload-btn picture_upload">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="vehicle_marker">{{ __('admin.vehicle.vehicle_marker') }}</label>
                        <div class="image-placeholder w-100">
                            <img width="100" height="100" />
                            <input type="file" name="vehicle_marker" class="upload-btn picture_upload">
                        </div>
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="weight">{{ __('delivery.admin.vehicle.weight') }}</label>
                        <input type="text" class="form-control numbers" id="weight" name="weight" placeholder="Weight" value="" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="length">{{ __('delivery.admin.vehicle.length') }}</label>
                        <input type="text" class="form-control numbers" id="length" name="length" placeholder="Length" value="" autocomplete="off">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="breadth">{{ __('delivery.admin.vehicle.breadth') }}</label>
                        <input type="text" class="form-control numbers" id="breadth" name="breadth" placeholder="Breadth" value="" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="height">{{ __('delivery.admin.vehicle.height') }}</label>
                        <input type="text" class="form-control numbers" id="height" name="height" placeholder="Height" value="" autocomplete="off">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
					<label for="notify_status" class="col-xs-2 col-form-label">@lang('admin.vehicle.vehicle_status')</label>
						<select name="status" class="form-control">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
                </div>

               
                <div class="form-row">
                <div class="form-group col-md-6">
                <button type="submit" class="btn btn-accent">{{$action_text}}</button>
                <button type="reset" class="btn btn-danger cancel">{{ __('Cancel') }}</button>
                <div>
              </div>
            </form>
        </div>
        </div>
    </div>
</div>


<script>

var image = '';
var imageName = '';
var marker = '';
var markerName = '';

$(document).ready(function()
{

    $('.picture_upload').on('change', function(e) {
      var files = e.target.files;
      var obj = $(this);
      if (files && files.length > 0) {
            if(obj.attr('name') == 'vehicle_image') {
                imageName = files[0].name;
            } else if(obj.attr('name') == 'vehicle_marker') {
                markerName = files[0].name;
            }
        
         cropImage(obj, files[0], obj.closest('.image-placeholder').find('img'), function(data) {
            image = data;
            if(obj.attr('name') == 'vehicle_image') {
                image = data;
            } else if(obj.attr('name') == 'vehicle_marker') {
                marker = data;
            }
         });
      }
   });

     basicFunctions();
     $.ajax({
        type:"GET",
        url: getBaseUrl() + "/admin/getdeliveryvehicletype",
        headers: {
            Authorization: "Bearer " + getToken("admin")
        },
        'beforeSend': function (request) { },
        success:function(response){
            var data = parseData(response);
            $("#delivery_type_id").empty();
            $("#delivery_type_id").append('<option value="">Select</option>');
            $.each(data.responseData.vehicle_type,function(key,item){
                $("#delivery_type_id").append('<option value="'+item.id+'">'+item.delivery_name+'</option>');
            }); 
        }
    });

     var id = "";
     if($("input[name=id]").length){

        id = "/"+ $("input[name=id]").val();
        var url = getBaseUrl() + "/admin/deliveryvehicle"+id;
        setData( url );
     }

    $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
            // vehicle_type: { required: true },
            vehicle_name: { required: true },
            //vehicle_image: { required: true},
            //vehicle_marker: { required: true },
            delivery_type_id:{required: true},
            capacity: { required: true },
		},

		messages: {
			// vehicle_type: { required: "Vehicle Type is required." },
			vehicle_name: { required: "Vehicle Name is required." },
			//vehicle_image: { required: "Image is required." },
            //vehicle_marker: { required: "Marker is required." },
            delivery_type_id:{required: "Type is required."},
			capacity: { required: "Capacity required." },
		},

		highlight: function(element)
		{
			$(element).closest('.form-group').addClass('has-error');
		},

		success: function(label) {
			label.closest('.form-group').removeClass('has-error');
			label.remove();
		},

		submitHandler: function(form) {

            var formGroup = $(".validateForm").serialize().split("&");

            var data = new FormData();

            if(image != "") data.append('vehicle_image', image, imageName);
            if(marker != "") data.append('vehicle_marker', marker, markerName);

            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append( params[0], decodeURIComponent(params[1]) );
            }

            var url = getBaseUrl() + "/admin/deliveryvehicle"+id;
            console.log(data);

            saveRow( url, table, data);

		}
    });

    $('.cancel').on('click', function(){
        $(".crud-modal").modal("hide");
    });

});
</script>
