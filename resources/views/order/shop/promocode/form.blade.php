{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'en'  ) }}
<div class="row">
    <div class="col-md-12">
        <div class="card-header border-bottom">
            @if(empty($id))
                @php($action_text=__('admin.add'))
            @else
                @php($action_text=__('admin.edit'))

            @endif
            <h6 class="m-0"style="margin:10!important;"> {{$action_text}} {{ __('Promocode') }}</h6>
        </div>
        <div class="popup-card-content">
        <div class="popup-card-content-in">

            <form class="validateForm">
                @csrf()
                @if(!empty($id))
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="{{$id}}">
                @endif
                <input type="hidden" name="service" value="ORDER">
                <input type="hidden" name="eligibility" value="1">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="promo_code" class="col-xs-2 col-form-label">@lang('admin.promocode.promocode')</label>
                        <div class="col-xs-10">
                            <input class="form-control" autocomplete="off"  type="text" value="{{ old('promo_code') }}" name="promo_code" required id="promo_code" placeholder="Promocode">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="percentage" class="col-xs-2 col-form-label">@lang('admin.promocode.percentage')</label>
                        <div class="col-xs-10">
                            <input class="form-control numbers" type="text" value="{{ old('percentage') }}" name="percentage" required id="percentage" placeholder="Percentage" autocomplete="off">
                        </div>
                    </div>
				</div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="max_amount" class="col-xs-2 col-form-label">@lang('admin.promocode.min_amount')</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control numbers" name="min_amount" required id="min_amount" placeholder="Min Amount" value="{{old('min_amount')}}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="expiration" class="col-xs-2 col-form-label">@lang('admin.promocode.max_amount')</label>
                        <div class="col-xs-10">
                            <input class="form-control numbers" type="text" value="{{old('max_amount')}}" name="max_amount" autocomplete="off" required id="max_amount" placeholder="Max Amount">
                        </div>
                    </div>
                </div>
				<div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="promo_description" class="col-xs-2 col-form-label">@lang('admin.promocode.promo_description')</label>
                        <div class="col-xs-10">
                        <textarea id="promo_description" placeholder="Description" class="form-control" name="promo_description">0% off, Max discount is 0{{old('promo_description')}}</textarea>
                        </div>
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="expiration" class="col-xs-2 col-form-label">@lang('admin.promocode.expiration')</label>
                        <div class="col-xs-10">
                            <input class="form-control datetimepicker" type="text" value="{{old('expiration')}}" name="expiration" autocomplete="off" required id="expiration" placeholder="Expiration">
                        </div>
                    </div>
				</div>

				

                <div class="form-row">

                    <div class="form-group col-md-6">
                          <label for="max_amount" class="col-xs-2 col-form-label">@lang('admin.promocode.user_limit')</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control numbers" name="user_limit"  id="user_limit" placeholder="Maximum Usage" value="{{old('user_limit')}}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="picture">{{ __('admin.picture') }}</label>
                        <div class="image-placeholder w-100">
                            <img width="100" height="100" />
                            <input type="file" name="picture" class="upload-btn picture_upload">
                        </div>
                        <span style="color:red;font-size:15px;display:none" id="img_error" >Select Image less thaan 10MB Size</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-accent">{{$action_text}} {{ __('Promocode') }}</button>
                <button type="reset" class="btn btn-danger cancel">{{ __('Cancel') }}</button>

            </form>
        </div>
        </div>
    </div>
</div>


<script>

var blobImage = '';
var blobName = '';

$(document).ready(function()
{
    $('input[name=expiration]').datepicker({
            rtl: false,
            orientation: "left",
            todayHighlight: true,
            autoclose: true,
            startDate:new Date()
        });

    $('.picture_upload').on('change', function(e) {
      var files = e.target.files;
      var obj = $(this);
      var size = (files[0].size / 1024000);
      if(size > 10.0)
      {
        $('#img_error').css('display','block');
      }

      else if (files && files.length > 0) {
        $('#img_error').css('display','none');
        blobName = files[0].name;
         cropImage(obj, files[0], obj.closest('.image-placeholder').find('img'), function(data) {
            blobImage = data;
         });
      }
    });

     var id = "";

     if($("input[name=id]").length){
        id = "/"+ $("input[name=id]").val();
        var url = getBaseUrl() + "/shop/promocode"+id;
        setData( url,'shop');

        setTimeout(function(){
                var optionvalue = $("#startdate").val();
                if(optionvalue)
                {
                    $("#new_user" ).attr("checked",true);
                    $('.startdate').show();
                }
                  }, 800);  
     }

     $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
            promo_code: { required: true },
            percentage: { required: true },
            max_amount: { required: true },
            min_amount: { required: true },
            expiration: { required: true},
            service: { required: true},
		},

		messages: {
			promo_code: { required: "Promo Code is required." },
			percentage: { required: "Percentage is required." },
            max_amount: { required: "Max Amount is required." },
            min_amount: { required: "Min Amount is required." },
            expiration:  { required: "Expiration is required." },
            service:  { required: "Service is required." },
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

            if(blobImage != "") data.append('picture', blobImage, blobName);

            var url = getBaseUrl() + "/shop/promocode"+id;
            saveRow( url, table, data,'shop');


		}
    });

        $("#percentage").on('keyup', function(){
			var per=$(this).val()||0;
			var max=$("#max_amount").val()||0;
			$("#promo_description").val(per+'% off, Max discount is '+max);
		});

		$("#max_amount").on('keyup', function(){
			var max=$(this).val()||0;
			var per=$("#percentage").val()||0;
			$("#promo_description").val(per+'% off, Max discount is '+max);
		});



    $('.cancel').on('click', function(){
        $(".crud-modal").modal("hide");
    });
    $('.datetimepicker').datepicker();

});
</script>
