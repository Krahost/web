@extends('common.provider.layout.base')
{{ App::setLocale(  isset($_COOKIE['user_language']) ? $_COOKIE['user_language'] : 'en'  ) }}
@section('styles')
@parent
<link rel='stylesheet' type='text/css' href="{{ asset('assets/input-file/style.css')}}"/>

<!-- <link rel='stylesheet' type='text/css' href="{{ asset('assets/input-file/style.css')}}"/> -->
<style type="text/css">
 header.topnav{
   /*  position: relative;
    background: #fafafa; */
 }   
</style>
@stop
@section('content')
<section class="content-box" id="Contact">
    <div class="heading dis-column">
        <hr>
        <h1 class=""><span class="">{{ __('My Tickets') }}</span></h1>
    </div>
    <div class="container">
        <div id="toaster" class="toaster"></div>
        <div class="mt-4 supportChatContent">
            <div class="row">
                <div class="col-md-8">
                    <div class="chatContentLeft">
                        <h4 class="ticketTitle"></h4>
                       <div class="chatHistory">
                            <div class="ch-listBox" id="ticketComment">
     
                              
                            </div> 

                            <div class="ch-commentBox closedticket">
                                <div class="contact-form">
                                    <form id="validateForm">
                                        @csrf()
                                        @if(!empty($id))
                                       <input type="hidden" name="id" value="{{$id}}">
                                        @endif
                                        <input type="hidden" name="type" value="PROVIDER" id="type">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="description" name="description" rows="6" placeholder="Your message..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                  <input type="file" name="file" id="file" class="input-file" accept = 'image/jpeg , image/jpg, image/gif, image/png'>
                                                  <label for="file" class="btn btn-tertiary js-labelFile">
                                                    <i class="icon fa fa-check"></i>
                                                    <span class="js-fileName">Choose a file</span>
                                                  </label>
                                                </div>
                                            </div>
                                             <div class="col-md-12 mb-2">
                                                <img id="image_preview_container" src="{{ asset('public/image/image-preview.png') }}"
                                                    alt="" style="max-height: 150px;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="contact-form-footer">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <button type="submit" class="btn btn-green">Submit</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- ch-commentBox -->                                  
                       </div> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chatContentRight">
                        <div class="ticketStatus">
                             <a href="{{ URL::previous() }}" role="button" class="btn btn-default pull-right">Back</a>
                             <br>
                            <span class="st-tl">Status</span>
                            <span class="current" id="status"></span>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- supportChatContent --> 
    </div>
</section>


@stop

@section('scripts')
@parent
<script type="text/javascript" src="{{ asset('assets/input-file/script.js')}}"></script>


<script>
$(document).ready(function() {

var blobName = '';
$('#file').change(function(){
          
    let reader = new FileReader();
    reader.onload = (e) => { 
      $('#image_preview_container').attr('src', e.target.result); 
    }
    blobName = reader.readAsDataURL(this.files[0]); 
 });

    var id = "/"+ $("input[name=id]").val();
    $.ajax({
        url: getBaseUrl() + "/provider/ticketComments"+id,
        type: "GET",
        headers: {
            Authorization: "Bearer " + getToken("provider")
        },
        'beforeSend': function(request) {
            showInlineLoader();
            
        },
        success: (data, textStatus, jqXHR) => { 
            var response = data.responseData;
            console.log(response);
            $('.ticketTitle').html(`[Ticket #`+response.ticket_id+`] `+response.title+``);
            var status = '';
            if(response.status ==0)
                status = `<button  class="btn btn-red status_enable" data-id=`+response.id+` data-value=`+response.status+`>Ticket Closed</button>`;
            else if(response.status ==1)
            {
                status = 'Closed';
                $('.closedticket').hide();
            }
            else
            {
                status = 'Closed No Response';
                $('.closedticket').hide();
            }

            $('#status').html(status);

            var html = '';
            for (var i in response.ticket_comments){
              
                if (response.ticket_comments[i].type == 'ADMIN') {
                   
                        html += `<div class="ch-message-box adminMsg">
                                    <div class="ch-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="userInfo">
                                                    <span class="ui-icon"><img class="img-fluid" src="{{asset('assets/img/user.png')}}"></span>
                                                    <span class="ui-name">Admin Support</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="chatDate">
                                                    <span>`+response.ticket_comments[i].created_date+`</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ch-body">
                                        <div class="ch-content">
                                        <pre><code>`+response.ticket_comments[i].comment+`</code></pre>
                                            
                                        </div>`;
                                        if(response.ticket_comments[i].picture)
                                        {
                                            html += `<div class="attachment"><span><a href=`+response.ticket_comments[i].picture+` download target=”_blank”>ref:View File</a></span></div>`;
                                        }

                                    html +=`</div>
                                    <div class="ch-foot"></div>
                                </div>`;
                    
                } else {
                        
                        html += `<div class="ch-message-box userMsg">
                                    <div class="ch-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="userInfo">
                                                    <span class="ui-icon">`;
                                            if(response.ticket_comments[i].type == 'USER') 
                                            {
                                                if(response.user.picture)
                                                {
                                                    html +=`<img class="img-fluid" src=`+response.user.picture+`>`  
                                                }else{
                                                    html +=`<img class="img-fluid" src="{{asset('assets/img/user.png')}}">`
                                                }
                                                     
                                                    html +=`</span>
                                                    <span class="ui-name">`+response.user.email+`</span>`
                                            }
                                            else{
                                                if(response.provider.picture)
                                                {
                                                    html +=`<img class="img-fluid" src=`+response.provider.picture+`>`  
                                                }else{
                                                    html +=`<img class="img-fluid" src="{{asset('assets/img/user.png')}}">`
                                                }
                                                     
                                                    html +=`</span>
                                                    <span class="ui-name">`+response.provider.email+`</span>`
                                            }
                                               html +=` </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="chatDate">
                                                    <span>`+response.ticket_comments[i].created_date+`</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ch-body">
                                        <div class="ch-content">
                                            <pre><code>`+response.ticket_comments[i].comment+`</code></pre>
                                        </div>`;
                                        if(response.ticket_comments[i].picture)
                                        {
                                            html += `<div class="attachment"><span><a href=`+response.ticket_comments[i].picture+` download target=”_blank”>ref:View File</a></span></div>`;
                                        }

                                    html +=`</div>
                                    <div class="ch-foot"></div>
                                </div>`;
                    
                }

            }

          
            $('#ticketComment').html(html);

            hideInlineLoader();

        }
    });

    $('body').on('click', '.status_enable', function() {
     
        var id = $(this).data('id');
        var value = $(this).data('value');

     
        var url = getBaseUrl() + "/provider/tickets/"+id+'/updateStatus?status='+value;

        $.ajax({
            type:"GET",
            url: url,
            headers: {
                Authorization: "Bearer " + getToken("provider")
            },
            'beforeSend': function (request) {
                showInlineLoader();
            },
            success:function(data){
                $(".status-modal").modal("hide");
                alertMessage("Success", "Status Changed", "success");
                hideInlineLoader();
                setTimeout(function(){
                window.location.replace("{{ url('provider/view-tickets/') }}/"+id);
                }, 1000);
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

$('#validateForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            description: { required: true},
        },

       messages: {

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
            $("pre code").text($("textarea").val());
            var formGroup = $("#validateForm").serialize().split("&");
            var data = new FormData();
            
            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append( params[0], decodeURIComponent(params[1]) );
            }
            data.append('picture', file.files[0]);
            
            $.ajax({
                url: getBaseUrl() + "/provider/newcomment",
                type: "post",
                data: data,
                processData: false,
                contentType: false,
                headers: {
                   Authorization: "Bearer " + getToken("provider")
                },
                beforeSend: function (request) {
                    showInlineLoader();
                },
                success:function(data){
                    var data = parseData(data);
                    alertMessage("Success", data.message, "success");
                    hideInlineLoader();
    
                    setTimeout(function(){
                        window.location.replace("{{ url('provider/view-tickets/') }}"+id);
               
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
</script>


@stop

