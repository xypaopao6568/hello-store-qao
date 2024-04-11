@extends('pages.layouts.app')
@section('title', 'Trang Chủ')
@section('css')
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
@endsection
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('user_/image/breadcrumb.jpg') }} ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us With Winshop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+84399999</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>Nam Sơn - Linh Sơn - Thái Nguyên</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>10:00 am to 23:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>support@winshop.vn</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <div>
            <div class="leaflet-map" id="userLocation"></div>
        </div>
    </div>
    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message"></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->
@endsection
@section('script')
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
    <script>
        const userLocationVar = document.getElementById('userLocation');
        if (userLocationVar) {
            const userLocation = L.map('userLocation').setView([42.35, -71.08], 10);
            userLocation.locate({
                setView: true,
                maxZoom: 16
            });

            function onLocationFound(e) {
                const radius = e.accuracy;
                L.marker(e.latlng)
                    .addTo(userLocation)
                    .bindPopup('You are somewhere around ' + radius + ' meters from this point')
                    .openPopup();
                L.circle(e.latlng, radius).addTo(userLocation);
            }
            userLocation.on('locationfound', onLocationFound);
            L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
                maxZoom: 18
            }).addTo(userLocation);
        }
    </script>
@endsection
