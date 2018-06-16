<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 3. 5.
 * Time: PM 10:44
 */
?>

@extends('layouts.app')

@section('content')
    <div class="inquire sub2depth">
        <div class="header"> <img src="images/icon-backb.svg" height="25" class="back" alt=""/>
            <p class="title">문의하기</p>
        </div>
        <div class="incont">
            <h1>특별활동 서비스에 <br>
                관심가져주셔서 <br>
                감사합니다. </h1>
            <div class="block">
                <p>이용에 불편을 겪으셨다거나</p>
                <p>문의/제안 사항이 있으시다면,</p>
                <p class="link-text"><a href="mailto:help@speciallife.co.kr">help@speciallife.co.kr </a></p>
                <div class="btn-write"><a href="">글남기기</a></div>
            </div>
            <div class="block">
                <p>특별활동과 사업제휴, 광고 등의  </p>
                <p>문의/제안 사항이 있으시다면,</p>
                <p class="link-text"><a href="mailto:help@speciallife.co.kr">help@speciallife.co.kr </a></p>
                <div class="btn-write"><a href="">글남기기</a></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')



@endpush
