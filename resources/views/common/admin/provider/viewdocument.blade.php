{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'en'  ) }}
<div class="row">
    <div class="col-md-12">
        <div class="card-header border-bottom">
            <h6 class="m-0"style="margin:10!important;">{{ __('Document Details') }}</h6>
        </div>
        <div class="popup-card-content">
        <div class="popup-card-content-in">
                <form class="validateForm">
                    @csrf()
                    @if(!empty($id))
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" id="document_id" name="id" value="{{$id}}">
                     
                    <input type="hidden" id="document_type" name="document_type" value="">
                    <input type="hidden" id="document_service" name="document_service" value="">
                                    
                                   
                    @endif
                    <div style="display: none;" id="documents_reject">
                        <div class="form-row" >
                            <div class="form-group col-md-6">
                                <label for="reason" class="col-xs-2 col-form-label"><b style ="font-weight:bold">{{ __('Cancel Reason') }} :</b> </label>
                                    <textarea class="form-control" id="document_reason" name="document_reason"></textarea>
                            </div>
                        </div>
                        <a  class="btn btn-success btn-large document_rejects ">Submit </a>
                        <a  class="btn btn-danger btn-large  vechileCancel pull-right documentcancel">Cancel </a>
                    </div>
                </form>
            <div class="form-row documentlist">
                <div class="form-group col-md-6">
                    <label><b style ="font-weight:bold">{{ __('Provider Name') }}:</b> <span class="m-0 provider_name"></label>
                </div>
                <div class="form-group col-md-6">
                    <label><b style ="font-weight:bold">{{ __('Document Name') }}:</b> <span class="m-0 document_name"></label>
                </div>
            </div>

            <div class="form-row documentlist">
                <div class="form-group col-md-6">
                    <div class=" m-0 front_image" style =margin-left:100px;>
                    <p>{{ __('FrontSide Image') }}</p>    
                        <img src = "" class ="img" height ="200px;" width ="200px;" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class=" m-0 backend_iamge" style =margin-left:100px;>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="documentlist" id="approve_btn"></div>
        <div class="documentlist" id="delete_btn"></div> 
        <div class="documentlist" id="cancel_btn"></div> 
           
    </div>

</div>

@include('common.admin.includes.redirect')
<script>
var table = $('#data-table');
$(document).ready(function()
{
     basicFunctions();
     var id = "";
     var id =$('#document_id').val();
     $.ajax({
            type:"GET",
            url: getBaseUrl() + "/admin/provider/"+id+"/view_document",
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            success:function(data){
                var result = data.responseData;
                $.each(result,function(key,item){
                    var str1 =item.url[0].url;
                    var str2 = ".pdf";
                    if(str1.indexOf(str2) != -1){
                        $(".front_image").empty().append(`<p>FrontSide  PDF</p><a target="blank" href=`+item.url[0].url+`><img class="pdf" src="{{ asset('assets/layout/images/common/svg/pdf-file.svg') }}" style="width:30%" alt="add_document"></a>`);   
                    }else{
                    $('.img').attr('src', item.url[0].url);
                    }
                    $('.document_name').text(item.document.name);
                    $('.provider_name').text(item.provider.first_name);
                    
                    if(item.document.is_backside && str1.indexOf(str2) == -1){
                    $(".backend_iamge").empty().append(`<p>BackSide Image</p><img src = "`+item.url[1].url+`" class ="img" height ="200px;" width ="200px;" /> `);    
                    }else if(item.document.is_backside){
                    $(".backend_iamge").empty().append(`<p>BackSide PDF</p><a target="blank" href=`+item.url[1].url+`><img class="pdf" src="{{ asset('assets/layout/images/common/svg/pdf-file.svg') }}" style="width:30%" alt="add_document" /></a> `);       
                    }
                    $("#approve_btn").empty()
                    if(item.status =='ASSESSING'){
                        $("#approve_btn").html(`<button class="btn btn-success btn-large  document_approve pull-left"  style = "margin-right:20px;">Approve</button>`);
                        $("#cancel_btn").html(` <button class="btn btn-danger btn-large doc-delete pull-left documentcancel"   style = "margin-right:20px;">Close</button>`);
                        $("#delete_btn").html(`<button data-id=`+item.id+` data-value=`+item.document.type+` data-type=`+item.document.name+` class='btn btn-danger btn-large doc-delete pull-left documentreject_reason' style = "margin-right:20px;">Rejected</button>`);
                        
                    }  else{
                        $("#approve_btn").html(` <button class="btn btn-danger btn-large doc-delete pull-right documentcancel"   style = "margin-right:20px;">Close</button>`);
                    }
                });


            }
        }); 
    
	

    $(document).on('click', '.documentcancel', function(){
        $(".documentdetails").modal("hide");
        $('.crud-modal').css({'overflow-y': 'auto',"overflow-x": "hidden"});
    });
});
</script>
