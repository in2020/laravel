@extends('layouts.app')

@section('content')
{{--    <div class="filterWindow">
        <div class="header"> <img src="{{ asset('images/icon-close.svg') }}" width="25" class="close" alt=""/>
            <p class="title">필터</p>
            <p class="reset"><a href="#">초기화</a></p>
        </div>
        <div class="checkList">
            <ul>
                <h3>활동</h3>
                <li>
                    <input type="checkbox" id="act1">
                    <label for="act1">미술반</label>
                </li>
                <li>
                    <input type="checkbox" id="act2">
                    <label for="act2">목공반</label>
                </li>
                <li>
                    <input type="checkbox" id="act3">
                    <label for="act3">음악반</label>
                </li>
                <li>
                    <input type="checkbox" id="act4">
                    <label for="act4">공예반</label>
                </li>
                <li>
                    <input type="checkbox" id="act5">
                    <label for="act5">도예반</label>
                </li>
            </ul>
            <ul>
                <h3>요금/월기준</h3>
                <li>
                    <input type="checkbox" id="price1">
                    <label for="price1">~5만원</label>
                </li>
                <li>
                    <input type="checkbox" id="price2">
                    <label for="price2">6만원~10만원</label>
                </li>
                <li>
                    <input type="checkbox" id="price3">
                    <label for="price3">11만원~15만원</label>
                </li>
                <li>
                    <input type="checkbox" id="price4">
                    <label for="price4">16만원~20만원</label>
                </li>
                <li>
                    <input type="checkbox" id="price5">
                    <label for="price5">21만원 이상</label>
                </li>
            </ul>
            <ul>
                <h3>활동</h3>
                <li>
                    <input type="checkbox" id="range1">
                    <label for="range1">레슨</label>
                </li>
                <li>
                    <input type="checkbox" id="range2">
                    <label for="range2">작업실</label>
                </li>
            </ul>
        </div>
        <a href="#" class="apply">필터적용</a> </div>
    <div class="filter"></div>--}}
    <div class="main">
        <div class="top">
            <div class="location">
                <div class="spot">
                    <p class="now">선택한 지하철역은</p>
                    <p class="selectbox">
                        <label for="here">전체</label>
                        <select name="subway_id" id="here">
                            <option value="">전체</option>
                            @foreach($subways as $subway)
                                <option value="{{ $subway->id }}">{{ $subway->name }}</option>
                            @endforeach
                        </select>
                    </p>
                </div>
                <div class="setting"><a href="{{ url("setting") }}"><img src="{{ asset('images/icon-setting.svg') }}" width="25" alt=""></a></div>
            </div>
            <div class="category"  id="bx-pager"> <a href="#" class="active" data-slide-index="0">전체</a> <a href="#" data-slide-index="1">미술</a> <a href="#" data-slide-index="2">공예</a> <a href="#" data-slide-index="3">도예</a> <a href="#" data-slide-index="4">목공</a> <a href="#" data-slide-index="5">노래</a> </div>
        </div>
        <ul class="listSlider">
            <li class="all">
                <ul class="list"></ul>
            </li>
            <li class="art">
                <ul class="list"></ul>
            </li>
            <li class="craft">
                <ul class="list"></ul>
            </li>
            <li class="pottery">
                <ul class="list"></ul>
            </li>
            <li class="woodwork">
                <ul class="list"></ul>
            </li>
            <li class="sing">
                <ul class="list"></ul>
            </li>
        </ul>

    </div>
@endsection
@push('scripts')
    <script id="hbs_activity" type="text/x-handlebars-template">
        <li>
            <a href="{{ url("activities") }}/@{{ id }}" target="_blank">
                <img class="imgsize" src="/storage/@{{ image.0.path }}" onerror="this.src='{{ asset('images/no-image.png') }}'">
                <div class="class-name">
                    <div class="name">
                        <p>@{{ place.name }}</p>
                    </div>
                    <div class="money">
                        <p>@{{ main_price }}</p>
                    </div>
                    <h2><img src="@{{ typeIcon activity_type_id }}" alt="">@{{ name }}</h2>
                </div>
            </a>
        </li>

    </script>

    <script src="{{asset('js/customer/index.js?v=7')}}"></script>
@endpush