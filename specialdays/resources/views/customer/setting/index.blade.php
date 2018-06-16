<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 3. 5.
 * Time: PM 10:40
 */
?>

@extends('layouts.app')

@section('content')
    <div class="setting sub2depth">
        <div class="header">
            <img src="images/icon-backb.svg" height="25" class="back" alt=""/>
            <p class="title">설정</p>
        </div>
        <ul>
            <!--li class="onoff">앱 푸시 알림 <div class="right_area"><div class="switch"><div class="toggle"></div></div></div></li-->
            <li><a href="https://www.facebook.com/%ED%8A%B9%EB%B3%84%ED%99%9C%EB%8F%99-2008618839421235/" target="_blank">페이스북</a></li>
            <li><a href="" target="_blank">인스타그램</a></li>
            <li><a href="{{ url("company") }}">회사소개</a></li>
            <li><a href="{{ url("inquire") }}">문의하기</a></li>
        </ul>
        <footer>
            © 2017 specialdays Co.,Ltd. All rights reserved.
        </footer>
    </div>
@endsection
@push('scripts')

@endpush