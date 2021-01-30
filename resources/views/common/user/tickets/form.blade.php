@extends('common.user.layout.base')
{{ App::setLocale(  isset($_COOKIE['user_language']) ? $_COOKIE['user_language'] : 'en'  ) }}
@section('styles')
@parent
<link rel='stylesheet' type='text/css' href="{{ asset('assets/input-file/style.css')}}"/>
<style type="text/css"> 
 header.topnav{
    /* position: relative;
    background: #fafafa; */
 }   
</style>
@stop
@section('content')
<section class="content-box" id="Contact">
    <div class="heading dis-column">
        <hr>
        <h1 class=""><span class="">{{ __('New Ticket') }}</span></h1>
    </div>
    <div class="container">
        <div id="toaster" class="toaster"></div>
        <div class="contact-form">
            <form class="validateForms"  id="validateForm">
                 @csrf()
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="fname" class="col-form-label">Category</label>
                            <div class="selectField">
                                <select name="admin_service" class="form-control" id="admin_service" autocomplete="off">
                                    <option value="">-- Choose Category --</option>
                                    @foreach(Helper::getServiceList() as $key => $service)
                                        <option value={{$service}}>{{$service}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="USER" id="type">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Sub Category</label>
                            <div class="selectField">
                                <select name="ticket_category" class="form-control" id="ticket_category" autocomplete="off">
                                    <option value="">-- Choose Sub Category --</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="message" class="col-form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required placeholder="Title" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="message" class="col-form-label">Message</label>
                            <textarea class="form-control" id="description" name="description" 
                                  rows="6" placeholder="Your message..." required autocomplete="off"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            
                          <input type="file" name="file" id="file"  class="input-file">
                          <label for="file" class="btn btn-tertiary js-labelFile">
                            <i class="icon fa fa-check"></i>
                            <span class="js-fileName">Choose a file</span>
                          </label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <img id="image_preview_container" class="d-none" src="{{ asset('public/image/image-preview.png') }}"
                            alt="preview image" style="max-height: 150px;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="contact-form-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                    <a href="{{ URL::previous() }}" role="button" class="btn btn-default">Back</a>
                                

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


@stop

@section('scripts')
@parent
<script type="text/javascript" src="{{ asset('assets/input-file/script.js')}}"></script>

<script>
$(document).ready(function()
{
var blobName = '';
$('#file').change(function(){
          
    let reader = new FileReader();
    reader.onload = (e) => { 
      $('#image_preview_container').attr('src', e.target.result).removeClass('d-none'); 
    }
    blobName = reader.readAsDataURL(this.files[0]); 
 });
    $('#validateForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            title: { required: true },
            admin_service: { required: true},
            ticket_category: { required: true},
            description: { required: true},
        },

       messages: {
            title: { required: "Title is required." },
            admin_service:  { required: "Category is required." },
            ticket_category:  { required: "Sub Category is required." },
            description:  { required: "Message is required." },
        },

        highlight: function(element)
        {
            $(element).closest('.form-group').addClass('has-error');
        },

        success: function(label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

         submitHandler: function (form) {
            
            var formGroup = $("#validateForm").serialize().split("&");
            var data = new FormData();
            data.append('picture', file.files[0]);
            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append( params[0], decodeURIComponent(params[1]) );
            }
            
            
            $.ajax({
                type:'POST',
                url: getBaseUrl() + "/user/new-ticket",
                data: data,
                processData: false,
                contentType: false,
                headers: {
                   Authorization: "Bearer " + getToken("user")
                },
                beforeSend: function (request) {
                    showInlineLoader();
                },
                success:function(data){
                    var data = parseData(data);
                    alertMessage("Success", data.message, "success");
                    hideInlineLoader();
                    setTimeout(function(){
                        window.location.replace("{{ url('/tickets') }}");
               
                    }, 1000);
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                        
                        if (jqXHR.status == 401 && getToken(guard) != null) {
                           refreshToken(guard);
                        } else if (jqXHR.status == 401) {
                           window.location.replace("/login");
                        }

                        if (jqXHR.responseJSON) {
                           alertMessage(textStatus, jqXHR.responseJSON.message, "danger");
                        }
                        hideInlineLoader();
                  } 
            });
        }
    });
});
    $('#admin_service').change(function(){

        var admin_service= $(this).val();
        if(admin_service !='')
        {
            $.ajax({
                url:  getBaseUrl() + "/user/ticket-category/"+admin_service,
                type: "GET",
                headers: {
                    Authorization: "Bearer " + getToken("user")
                    },
                    
                success: function(data) {
                    $("#ticket_category").empty().append('<option value="">-- Choose Sub Category --</option>');
                    $.each(data.responseData, function(key, item) {
                        $("#ticket_category").append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                    $("#ticket_category").append('<option value="OTHER">Other</option>');
                    
                }
            }); 
        }
    });
</script>
@stop

