<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-05
 * Time: 오전 8:19
 */
?>
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">특별활동 관리자</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul>
                            <li><a href="{{url('/admin/places')}}">플레이스 목록</a></li>
                            {{--<li><a href="{{url('/admin/activities')}}">클래스 목록</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

