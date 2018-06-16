<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 3. 5.
 * Time: PM 10:18
 */
?>

@extends('layouts.app')

@section('content')
    <div class="s-top">
        <div class="navi"> <a href="index.html" class="back"><img src="/images/icon-back.svg" alt="back" height="20"/></a> <a href="#" class="share"><img src="/images/icon-share.svg" alt="share" height="22"/></a><!-- <a href="#" class="like"><img src="/images/icon-heart-off-2.svg" height="21"/></a>--> </div>
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
        <div class="bxslider">
            @if(count($place->image) > 0)
                @foreach($place->image as $image)
                    <li>
                        <img src="{{asset('storage/'.$image->path)}}" onerror="this.src='{{ asset('images/no-image.png') }}'">
                    </li>
                @endforeach
            @else
                <li>
                    <img src="{{ asset('images/no-image.png') }}" >
                </li>
            @endif
        </div>
    </div>
    <div class="p-view view">
        <div class="titlefield">
            <div>
                <h2>{{@$place->name}}</h2>
                @if(count($place->subway) > 0)
                <p class="location">
                    @foreach($place->subway as $subway)
                        {{ $subway->name }}
                    @endforeach
                </p>
                @endif
                <div class="p-info">
                    <p>{!! nl2br($place->introduce) !!}</p>
                </div>
            </div>
            @if(count($place->tag) > 0)
            <div class="tag">
                @foreach($place->tag as $tag)
                    <a href="#">#{{ $tag->tag }}</a>
                @endforeach
            </div>
            @endif
        </div>
        <div>
            <div class="maplink">
                <div class="map"><a href="{{ url("places/{$place->id}/location") }}">
                        <h3>찾아오는 길 및 연락처</h3>
                    </a></div>
                <div class="arrow"><img src="/images/icon-view-bold.png" alt=""></div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="p-list">
            <!--구조를 간소화 했음-->
            <ul class="listleft">
                @foreach($place->activity as $key => $activity)
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
                @foreach($place->activity as $key => $activity)
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
        <a class="phonebtn" href="tel:{{@$activity->place->phone}}">전화로 문의하기</a>
    </div>
@endsection
@push('scripts')



@endpush