<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 2. 25.
 * Time: PM 10:57
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 2. 25.
 * Time: PM 2:54
 */
?>

@extends('layouts.app')

@section('content')
    <div class="contact sub2depth">
        <div class="header">
            <div id="map" style="width:100%;height:200px;" class="back"></div>
            <p class="title">찾아오는 길 및 연락처</p>
        </div>
        <div>
            <!--li class="onoff">앱 푸시 알림 <div class="right_area"><div class="switch"><div class="toggle"></div></div></div></li-->
            <div class="map_img" style="background-image: url(/images/map.png)"><a href="#"></a></div>
            <p class="address">{{ @$place->address }}</p>
        </div>
        <div class="phon_box">
            <h2 class="title">연락처</h2>
            <p class="body_text">전화번호 : {{ @$place->phone }}<br>
                이메일 : {{ @$place->email }}<br>
                카카오톡 : {{ @$place->kakao }}</p>
        </div>
        <div class="homepage_box">
            <h2 class="title">홈페이지</h2>
            <p class="body_text">{{ @$place->homepage }}<br>
                {{ @$place->blog }}<br>
                {{ @$place->sns }}</p>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=AkexaYUpfrn3FtTOYuqY&submodules=geocoder"></script>
    <script id="code">

        function showMarker(map,latlng){

            var marker = new naver.maps.Marker({
                position: latlng,
                map: map
            });

        }

        var map = new naver.maps.Map('map', {
            center: new naver.maps.LatLng({{@$place->lat}}, {{@$place->lng}}),
            zoom: 10
        });
        showMarker(map, new naver.maps.LatLng({{@$place->lat}}, {{@$place->lng}}));

    </script>
@endpush
