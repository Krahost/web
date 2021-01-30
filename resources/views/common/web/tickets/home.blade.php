@extends('common.web.layout.base')
{{ App::setLocale(Request::route('lang') !== null ? Request::route('lang') : 'en') }}
@section('styles')
@parent
<link rel='stylesheet' type='text/css' href="{{ asset('assets/input-file/style.css')}}"/>
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
        <h1 class=""><span class="">{{ __('Gox Enquiry') }}</span></h1>
    </div>
    <div class="container">
        <div class="contact-form">
            <form>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="fname" class="col-form-label">Category</label>
                            <div class="selectField">
                                <select name="" class="form-control" >
                                    <option value="">Choose Category</option>
                                    <option value="">Category One</option>
                                    <option value="">Category Two</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Sub Category</label>
                            <div class="selectField">
                                <select name="" class="form-control" >
                                    <option value="">Choose Sub Category</option>
                                    <option value="">Sub Category One</option>
                                    <option value="">Sub Category Two</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="message" class="col-form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" 
                                  rows="6" placeholder="Your message..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <!-- <label for="message" class="col-form-label">Upload File</label> -->
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


    // jQuery(document).ready(function ($) {
    //    "use strict";

    // $('#rides').owlCarousel({

    //    items: 3,
    //    margin: 10,
    //    nav: true,
    //    autoplay: true,
    //    dots: true,
    //    autoplayTimeout: 5000,
    //    navText: ['<span class="icon ion-ios-arrow-left"></span>', '<span class="icon ion-ios-arrow-right"></span>'],
    //    smartSpeed: 450,
    //    responsive: {
    //       0: {
    //          items: 1
    //       },
    //       768: {
    //          items: 2
    //       },
    //       1170: {
    //          items: 4
    //       }
    //    }
    // });

    // $('#deliveries').owlCarousel({

    //    items: 3,
    //    margin: 10,
    //    nav: true,
    //    autoplay: true,
    //    dots: true,
    //    autoplayTimeout: 5000,
    //    navText: ['<span class="icon ion-ios-arrow-left"></span>', '<span class="icon ion-ios-arrow-right"></span>'],
    //    smartSpeed: 450,
    //    responsive: {
    //       0: {
    //          items: 1
    //       },
    //       375: {
    //          items: 1
    //       },
    //       768: {
    //          items: 2
    //       },
    //       1170: {
    //          items: 4
    //       }
    //    }
    // });

    // $('#other-services').owlCarousel({
    //    items: 3,
    //    margin: 10,
    //    nav: true,
    //    autoplay: true,
    //    dots: true,
    //    autoplayTimeout: 5000,
    //    navText: ['<span class="icon ion-ios-arrow-left"></span>', '<span class="icon ion-ios-arrow-right"></span>'],
    //    smartSpeed: 450,
    //    responsive: {
    //       0: {
    //          items: 1
    //       },
    //       375: {
    //          items: 1
    //       },
    //       768: {
    //          items: 2
    //       },
    //       1170: {
    //          items: 4
    //       }
    //    }
    // });
</script>


<script type="text/javascript">
    $(document).ready(function(){
       $("#mySidenav a").click(function(){
         $("#mySidenav").css("width", "0");
        });
});
</script>
@stop

