@extends('common.web.layout.base')
{{ App::setLocale(Request::route('lang') !== null ? Request::route('lang') : 'en') }}
@section('styles')
@parent
<link rel='stylesheet' type='text/css' href="{{ asset('assets/input-file/style.css')}}"/>

<!-- <link rel='stylesheet' type='text/css' href="{{ asset('assets/input-file/style.css')}}"/> -->
<style type="text/css">
 header.topnav{
    position: relative;
    background: #fafafa;
 }   
</style>
@stop
@section('content')
<section class="contact-sec" id="Contact">
    <div class="heading dis-column">
        <hr>
        <h1 class=""><span class="">{{ __('My Tickets') }}</span></h1>
    </div>
    <div class="container">
        <div class="mt-4 supportChatContent">
            <div class="row">
                <div class="col-md-8">
                    <div class="chatContentLeft">
                        <h4 class="ticketTitle">[Ticket #3709577] Server Disconnect Frequently</h4>
                       <div class="chatHistory">
                            <div class="ch-listBox">
                                <div class="ch-message-box adminMsg">
                                    <div class="ch-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="userInfo">
                                                    <span class="ui-icon"><img class="img-fluid" src="{{asset('assets/img/user.png')}}"></span>
                                                    <span class="ui-name">dev@appdube.com</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="chatDate">
                                                    <span>Thursday, November 05, 2020 10:55 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ch-body">
                                        <div class="ch-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dictum pulvinar justo, et ullamcorper risus ullamcorper sit amet. In hac habitasse platea dictumst. Donec ullamcorper tellus turpis, id suscipit nisl tincidunt vel. Maecenas consectetur convallis ipsum quis feugiat. In tristique sem sodales pellentesque fermentum.</p>
                                        </div>
                                        <div class="attachment"><span>ref:_00Df218t5m._5004P1KHkM9:ref</span></div>
                                    </div>
                                    <div class="ch-foot"></div>
                                </div>
                                <div class="ch-message-box userMsg">
                                    <div class="ch-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="userInfo">
                                                    <span class="ui-icon"><img class="img-fluid" src="{{asset('assets/img/user.png')}}"></span>
                                                    <span class="ui-name">dev@appdube.com</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="chatDate">
                                                    <span>Thursday, November 05, 2020 10:55 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ch-body">
                                        <div class="ch-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dictum pulvinar justo, et ullamcorper risus ullamcorper sit amet. In hac habitasse platea dictumst. Donec ullamcorper tellus turpis, id suscipit nisl tincidunt vel. Maecenas consectetur convallis ipsum quis feugiat. In tristique sem sodales pellentesque fermentum.</p>
                                        </div>
                                        <div class="attachment"><span>ref:_00Df218t5m._5004P1KHkM9:ref</span></div>
                                    </div>
                                    <div class="ch-foot"></div>
                                </div>
                                <div class="ch-message-box adminMsg">
                                    <div class="ch-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="userInfo">
                                                    <span class="ui-icon"><img class="img-fluid" src="{{asset('assets/img/user.png')}}"></span>
                                                    <span class="ui-name">dev@appdube.com</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="chatDate">
                                                    <span>Thursday, November 05, 2020 10:55 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ch-body">
                                        <div class="ch-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dictum pulvinar justo, et ullamcorper risus ullamcorper sit amet. In hac habitasse platea dictumst. Donec ullamcorper tellus turpis, id suscipit nisl tincidunt vel. Maecenas consectetur convallis ipsum quis feugiat. In tristique sem sodales pellentesque fermentum.</p>
                                        </div>
                                        <div class="attachment"><span>ref:_00Df218t5m._5004P1KHkM9:ref</span></div>
                                    </div>
                                    <div class="ch-foot"></div>
                                </div>
                                <div class="ch-message-box adminMsg">
                                    <div class="ch-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="userInfo">
                                                    <span class="ui-icon"><img class="img-fluid" src="{{asset('assets/img/user.png')}}"></span>
                                                    <span class="ui-name">dev@appdube.com</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="chatDate">
                                                    <span>Thursday, November 05, 2020 10:55 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ch-body">
                                        <div class="ch-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dictum pulvinar justo, et ullamcorper risus ullamcorper sit amet. In hac habitasse platea dictumst. Donec ullamcorper tellus turpis, id suscipit nisl tincidunt vel. Maecenas consectetur convallis ipsum quis feugiat. In tristique sem sodales pellentesque fermentum.</p>
                                        </div>
                                        <div class="attachment"><span>ref:_00Df218t5m._5004P1KHkM9:ref</span></div>
                                    </div>
                                    <div class="ch-foot"></div>
                                </div>
                                <div class="ch-message-box userMsg">
                                    <div class="ch-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="userInfo">
                                                    <span class="ui-icon"><img class="img-fluid" src="{{asset('assets/img/user.png')}}"></span>
                                                    <span class="ui-name">dev@appdube.com</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="chatDate">
                                                    <span>Thursday, November 05, 2020 10:55 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ch-body">
                                        <div class="ch-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dictum pulvinar justo, et ullamcorper risus ullamcorper sit amet. In hac habitasse platea dictumst. Donec ullamcorper tellus turpis, id suscipit nisl tincidunt vel. Maecenas consectetur convallis ipsum quis feugiat. In tristique sem sodales pellentesque fermentum.</p>
                                        </div>
                                        <div class="attachment"><span>ref:_00Df218t5m._5004P1KHkM9:ref</span></div>
                                    </div>
                                    <div class="ch-foot"></div>
                                </div>
                                <div class="ch-message-box userMsg">
                                    <div class="ch-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="userInfo">
                                                    <span class="ui-icon"><img class="img-fluid" src="{{asset('assets/img/user.png')}}"></span>
                                                    <span class="ui-name">dev@appdube.com</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="chatDate">
                                                    <span>Thursday, November 05, 2020 10:55 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ch-body">
                                        <div class="ch-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dictum pulvinar justo, et ullamcorper risus ullamcorper sit amet. In hac habitasse platea dictumst. Donec ullamcorper tellus turpis, id suscipit nisl tincidunt vel. Maecenas consectetur convallis ipsum quis feugiat. In tristique sem sodales pellentesque fermentum.</p>
                                        </div>
                                        <div class="attachment"><span>ref:_00Df218t5m._5004P1KHkM9:ref</span></div>
                                    </div>
                                    <div class="ch-foot"></div>
                                </div>
                            </div>                       
                            <div class="ch-commentBox">
                                <div class="contact-form">
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="message" name="message" rows="6" placeholder="Your message..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                  <input type="file" name="file" id="file" class="input-file">
                                                  <label for="file" class="btn btn-tertiary js-labelFile">
                                                    <i class="icon fa fa-check"></i>
                                                    <span class="js-fileName">Choose a file</span>
                                                  </label>
                                                </div>
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
                            <span class="st-tl">Status</span>
                            <span class="current">Open</span>
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
        $('.nav-tabs li:first a').trigger('click');
    });

    $.getJSON('http://gd.geobytes.com/GetCityDetails?callback=?', function(data) {
        $.getJSON('http://www.geoplugin.net/json.gp?ip=' + data.geobytesremoteip, function(response) {
            if (response.geoplugin_countryCode == 'AE') {
                if (!(window.location.href).includes('/ar')) {
                    location.replace('/ar');
                }
            }
        });
    });

    if(getUserDetails() && getUserDetails().id != 0) {
        $('.user_login').remove();
        $('.user_app').show();
    } else {
        $('.user_app').remove();
    }

    if(getProviderDetails() && getProviderDetails().id != 0) {
        $('.provider_login').remove();
        $('.provider_app').show();
    } else {
        $('.provider_app').remove();
    }

    if(getShopDetails() && getShopDetails().id != 0) {
        $('.shop_login').remove();
        $('.shop_app').show();
    } else {
        $('.shop_app').remove();
    }


    
</script>


<script type="text/javascript">
    $(document).ready(function(){
       $("#mySidenav a").click(function(){
         $("#mySidenav").css("width", "0");
        });
});
</script>
@stop

