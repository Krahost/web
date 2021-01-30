{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'en'  ) }}
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-header border-bottom">
        @if(empty($id))
                @php($action_text=__('delivery.admin.deliverytype.add'))
            @else
                @php($action_text=__('delivery.admin.deliverytype.edit'))
            @endif
            <h6 class="m-0">{{$action_text}}</h6>
        </div>
        <div class="popup-card-content">
        <div class="popup-card-content-in">
            <form class="validateForm">
                @csrf()
                @if(!empty($id))
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="{{$id}}">
                @endif
            
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="delivery_name">{{ __('delivery.admin.deliverytype.delivery_name') }}</label>
                        <input type="text" class="form-control" id="delivery_name" name="delivery_name" placeholder="Delivery Type name" value="" autocomplete="off">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="delivery_category">{{ __('delivery.admin.deliverytype.delivery_category') }}</label>
                        <select class="form-control" id="delivery_category_id" name="delivery_category_id" required="" autocomplete="off">
                            <option value="">select</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                @if(!empty($id))    
                    <div class="form-group col-md-12">
    					<label for="notify_status" class="col-xs-2 col-form-label">@lang('admin.status')</label>
    						<select name="status" class="form-control">
                            <option value="">select</option>
    							<option value="1">Active</option>
    							<option value="0">Inactive</option>
    						</select>
    					</div>
    				</div>
                @endif    
             
                <button type="submit" class="btn btn-accent">{{$action_text}}</button>
                <button type="reset" class="btn btn-danger cancel">Cancel</button>

            </form>
        </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function()
{
     basicFunctions();

     var id = "";

     if($("input[name=id]").length){
        id = "/"+$("input[name=id]").val();
        var url = getBaseUrl() + "/admin/deliverytype"+id;
        setData( url );
     }

     $.ajax({
        url:  getBaseUrl() + "/admin/delivery_type",
        type: "GET",
        headers: {
            Authorization: "Bearer " + getToken("admin")
            },
        
        success: function(data) {
            $("#delivery_category_id").empty()
            .append('<option value="">Select</option>');
            $.each(data.responseData, function(key, item) {
                $("#delivery_category_id").append('<option value="' + item.id + '">' + item.delivery_name+ '</option>');
            });
            
        }
    }); 

     $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
            delivery_name: { required: true },
            delivery_category_id: { required: true },
            status: { required: true },
		},

		messages: {
			delivery_name: { required: "Delivery Name is required." },
            delivery_category_id: { required: "Delivery Category is required." },
            status: { required: "Status is required." },

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
            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append( params[0], decodeURIComponent(params[1]) );
            }
            var url = getBaseUrl() + "/admin/deliverytype"+id;
            saveRow( url, table, data);
		}
    });

    $('.cancel').on('click', function(){
        $(".crud-modal").modal("hide");
    });

});
</script>
