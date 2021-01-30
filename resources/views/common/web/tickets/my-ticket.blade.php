@extends('common.web.layout.base')
{{ App::setLocale(Request::route('lang') !== null ? Request::route('lang') : 'en') }}
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('assets/DataTables/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/DataTables/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/DataTables/css/style.css')}}">

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
        <div class="ticketMenu">
            <ul>
                <li><a class="active" href="">Open Tickets</a></li>
                <li><a href="">Closed Tickets</a></li>
                <li class="createBtn"><a class="btn btn-primary" href="">Create New Ticket</a></li>
            </ul>
        </div>
        <div class="ticketContent">
            <div class="ticketListTable">
                <table class="table table-striped cus-table" id="cus-table" width="100%">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Last Activity</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                      <tr>
                        <td>
                        <p class="ticName">
                            [#03034138] Notice of Phishing Content hosted on a Droplet in Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada sem vitae enim faucibus, ut rutrum risus porta. Vestibulum dolor magna, vulputate at mauris ac, vestibulum dignissim purus. 
                        </p>
                        </td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>October 29, 2019 12:57 PM</td>
                        <td>Open</td>
                      </tr>
                     
                    </tbody>
                  </table>
            </div> <!-- ticketListTable -->
        </div> <!-- ticketContent --> 
    </div>
</section>


@stop

@section('scripts')
@parent


<script type="text/javascript" src="{{ asset('assets/DataTables/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/DataTables/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/DataTables/js/dataTables.responsive-new.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/DataTables/js/responsive.bootstrap4-new.min.js')}}"></script>

<script  src="{{ asset('assets/DataTables/js/script.js')}}"></script>

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

