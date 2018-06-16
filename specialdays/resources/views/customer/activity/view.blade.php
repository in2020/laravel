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
    <div class="s-top">
        <div class="navi">
            <a onclick="history.back();" class="back"><img src="/images/icon-back.svg" alt="back" height="20"/></a>
            <a href="#" class="share"><img src="/images/icon-share.svg" alt="share" height="22"/></a>
            <!-- <a href="#" class="like"><img src="images/icon-heart-off-2.svg" height="21"/></a>-->
        </div>
        <div class="sharepop">
            <div class="arrow"></div>
            <div class="sharein">
                <h3>공유하기</h3>
                <img src="/images/icon-close.svg" width="14" class="shareclose"/>
                <ul>
                    <li><img src="/images/btn-kakao.png" width="50" height="50"/></li>
                    <li><img src="/images/btn-facebook.png" width="50" height="50"/></li>
                    <li><img src="/images/btn-url.png" width="50" height="50"/></li>
                </ul>
            </div>
        </div>
        <ul class="bxslider">
            @if(count($activity->image) > 0)
                @foreach($activity->image as $image)
                <li>
                    <img src="{{asset('storage/'.$image->path)}}" onerror="this.src='{{ asset('images/no-image.png') }}'">
                </li>
                @endforeach
            @else
                <li>
                    <img src="{{ asset('images/no-image.png') }}" >
                </li>
            @endif
        </ul>
    </div>
    <div class="c-view view">
        <div class="titlefield">
            <div class="verticalcenter">
                <p class="placename">{{@$activity->place->name}}</p>
                <h2><img src="{{ @$typeIcon }}" alt="">{{@$activity->name}}</h2>
            </div>
        </div>
        <div>
            <div class="subtext">
                <div>
                    <h3>활동소개</h3>
                </div>
                <div class="desc">
                    <p>{!! nl2br($activity->introduce) !!}</p>
                </div>
                <div> <a href="#" class="more viewmore">더보기</a> </div>
            </div>
        </div>
        <div>
            <div class="subtext">
                <div>
                    <h3>활동안내 및 요금</h3>
                </div>
                <div class="desc">
                    <p>{!! nl2br($activity->description) !!}</p>
                </div>
                <div> <a href="#" class="more viewmore">더보기</a> </div>
            </div>
        </div>
        <div>
            <div class="subtext">
                <div>
                    <h3>필독사항</h3>
                </div>
                <div class="desc">
                    <p>{!! nl2br($activity->must_read) !!}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="maplink">
                <div class="map"><a href="{{ url("places/{$activity->place->id}/location") }}">
                        <h3>찾아오는 길 및 연락처</h3>
                    </a></div>
                <div class="arrow"><a ><img src="/images/icon-view-bold.png" alt=""></a></div>
                <div class="clear"></div>
            </div>
        </div>
        <div>
            <div class="place">
                <div class="profile">
                    @if($activity->place->profile)
                        <img src="{{asset('storage/'.$activity->place->profile->path)}}" onerror="this.src='{{ asset('images/no-image.png') }}'" alt="">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" >
                    @endif
                </div>
                <div class="placetext">
                    <a href="{{ url("places") }}/{{ $activity->place->id }}">
                        <h2>{{@$activity->place->name}}</h2>
                        <p>@foreach($activity->place->subway as $subway)
                                {{@$subway->name}}
                            @endforeach
                        </p>
                    </a>
                </div>
                <div class="arrow"><img src="/images/icon-view-bold.png" alt=""></div>
                <div class="clear"></div>
            </div>
            <div class="p-list">
                <!--구조를 간소화 했음-->
                <ul class="listleft">
                    @foreach($activity->place->activity as $key => $activity)
                        @if($key % 2 == 0)
                            <li class="classimg">
                                <a href="{{ url("activities") }}/{{ $activity->id }}">
                                    @if(is_array($activity->image))
                                        <img src="{{asset('storage/'.$activity->image[0]->path)}}">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    @endif
                                    <p class="class-list">{{$activity->name}}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <ul class="listright">
                    @foreach($activity->place->activity as $key => $activity)
                        @if($key % 2 == 1)
                            <li class="classimg">
                                <a href="{{ url("activities") }}/{{ $activity->id }}">
                                    @if(is_array($activity->image))
                                        <img src="{{asset('storage/'.$activity->image[0]->path)}}">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    @endif
                                    <p class="class-list">{{$activity->name}}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            {{--<div class="classmore"><a href="">더보기</a></div>--}}
        </div>
        <a class="phonebtn" href="tel:{{@$activity->place->phone}}">전화로 문의하기</a>
    </div>
@endsection
@push('scripts')

@endpush