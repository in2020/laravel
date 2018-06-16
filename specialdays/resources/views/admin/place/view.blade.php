<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-05
 * Time: 오전 8:21
 */
?>
@extends('layouts.admin')

@section('content')
    @empty($place)
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('admin/place') }}">
    @endempty

    @isset($place)
        <form name="frmPlace" id="frmPlace" class="form-horizontal" method="POST" onsubmit="return setDeletingImage('frmPlace');" enctype="multipart/form-data" action="{{ url('admin/place') }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$place->id}}">
    @endisset
            {{ csrf_field() }}

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">플레이스 등록</div>

                    <div class="panel-body">


                                <div class="form-group">
                                    <label for="region" class="col-md-4 control-label">가까운 지하철</label>

                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subwayModal">
                                            추가
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type" class="col-md-4 control-label">로고 이미지</label>

                                    <div class="col-md-6">
                                        @isset($profileImg)
                                            <img src="<?php echo asset("storage/$profileImg->path")?>" width="100"
                                                 height="100">
                                        @endisset
                                        <input type="file" name="profile_img">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">플레이스명</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="@if(old('name')){{ old('name') }}@else{{@$place->name}}@endif" maxlength="50" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="main_price" class="col-md-4 control-label">태그(최대4개)</label>

                                    <div class="col-md-6">
                                        <input id="tags" type="text" class="form-control" name="tags" value="@if(old('tags')){{ old('tags') }}@else{{@$tags}}@endif" title=""  maxlength="10" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="desc" class="col-md-4 control-label">특별한 소개</label>

                                    <div class="col-md-6">
                                        <textarea id="introduce" name="introduce" class="form-control" rows="10" maxlength="2000">@if(old('introduce')){{ old('introduce') }}@else{{@$place->introduce}}@endif</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="desc" class="col-md-4 control-label">이미지(최대30개)</label>

                                    <div class="col-md-6">
                                        <input type="file" name="imgs[]" accept="image/*" />
                                        <input type="file" name="imgs[]" accept="image/*" />
                                        <input type="file" name="imgs[]" accept="image/*" />
                                        <input type="file" name="imgs[]" accept="image/*" />
                                        <input type="file" name="imgs[]" accept="image/*" />
                                        <div id="div_more_imgs"></div>
                                        <br>
                                        <button type="button" onclick="addFileInputs();" class="btn btn-primary">이미지 필드 추가</button>
                                        <br>
                                        @foreach ($place->image as $img)
                                            @if($loop->index ==0)
                                                <br>
                                                <b>삭제할 이미지를 클릭 해주세요. <br>클릭한 이미지는 저장시 삭제됩니다.</b>
                                                <br>
                                            @endif
                                            <img src="<?php echo asset("storage/$img->path")?>"
                                                 onclick="toggleDeletingImg({{@$img->id}},$(this));" width="100"
                                                 height="100">

                                        @endforeach
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="homepage" class="col-md-4 control-label">홈페이지</label>

                                    <div class="col-md-6">
                                        <input id="homepage" type="text" class="form-control" name="homepage" value="@if(old('homepage')){{ old('homepage') }}@else{{@$place->homepage}}@endif" pattern="<?=$validation['url']['regex']?>" title="<?=$validation['url']['alert']?>" maxlength="100">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="blog" class="col-md-4 control-label">카페 또는 블로그</label>

                                    <div class="col-md-6">
                                        <input id="blog" type="text" class="form-control" name="blog" value="@if(old('blog')){{ old('blog') }}@else{{@$place->blog}}@endif" pattern="<?=$validation['url']['regex']?>" title="<?=$validation['url']['alert']?>" maxlength="100">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sns" class="col-md-4 control-label">SNS</label>

                                    <div class="col-md-6">
                                        <input id="sns" type="text" class="form-control" name="sns" value="@if(old('sns')){{ old('sns') }}@else{{@$place->sns}}@endif" pattern="<?=$validation['url']['regex']?>" title="<?=$validation['url']['alert']?>" maxlength="100">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-md-4 control-label">전화번호</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="phone" value="@if(old('phone')){{ old('phone') }}@else{{@$place->phone}}@endif" pattern="<?=$validation['phoneNumber']['regex']?>" title="<?=$validation['phoneNumber']['alert']?>" maxlength="30">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">이메일</label>

                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control" name="email" value="@if(old('email')){{ old('email') }}@else{{@$place->email}}@endif" pattern="<?=$validation['email']['regex']?>" title="<?=$validation['email']['alert']?>" maxlength="256">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kakao" class="col-md-4 control-label">카카오톡 아이디</label>

                                    <div class="col-md-6">
                                        <input id="kakao" type="text" class="form-control" name="kakao" value="@if(old('kakao')){{ old('kakao') }}@else{{@$place->kakao}}@endif" maxlength="256" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="col-md-4 control-label">주소</label>

                                    <input type="hidden" name="lat" id="lat">
                                    <input type="hidden" name="lng" id="lng">

                                    <div class="col-md-6">
                                        <input type="text" class="form-control"  name="address" id="address" value="@if(old('address')){{ old('address') }}@else{{@$place->address}}@endif" maxlength="100" >
                                        <div id="map" style="width:100%;height:400px;"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="location" class="col-md-4 control-label">찾아오는 방법</label>

                                    <div class="col-md-6">
                                        <textarea id="location" name="location" class="form-control" rows="10" maxlength="2000">@if(old('location')){{ old('location') }}@else{{@$place->location}}@endif</textarea>
                                    </div>
                                </div>

                                @isset($place)
                                <div class="form-group">
                                    <label for="location" class="col-md-4 control-label">클래스</label>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" onclick="document.frmActivity.submit();">
                                            등록
                                        </button>
                                        <br>
                                        @foreach ($activities as $activity)
                                            <a onclick="document.frmActivity.action='{{url('admin/activity/'.@$activity->id)}}'; document.frmActivity.submit();">
                                                <img src="{{@$activity->img_path}}">
                                                {{$activity->name}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endisset

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            저장
                                        </button>
                                        <button onclick="history.back();" class="btn btn-primary">
                                            목록
                                        </button>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subwayModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">지하철 선택</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $line = 0; ?>
                    @foreach($subways as $subway)
                        @if($subway->line != $line)
                            @if($line != 0)
                                <br>
                            @endif
                            <h4>{{@$subway->line}}</h4>
                        @endif
                        <input type="checkbox" name="subways[]" value="{{@$subway->id}}" <?= $placeSubways->contains('subway_id',$subway->id) ?  "checked":"";?>>{{@$subway->name}}
                        <?php $line = $subway->line; ?>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">저장</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <form name="frmActivity" method="get" action="{{url('admin/activity')}}">
        <input type="hidden" name="place_id" value="{{@$place->id}}">
    </form>
@endsection
@push('scripts')
    {{-- 파일처리 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
    <script src="{{asset('js/image.js')}}"></script>
    {{-- //파일처리 --}}

    {{-- 지도처리 --}}
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=AkexaYUpfrn3FtTOYuqY&submodules=geocoder"></script>
    <script id="code">
        var gMarkerList = [];
        function removeMarkers(){
            for (var i=0, ii=gMarkerList.length; i<ii; i++) {
                gMarkerList[i].setMap(null);
            }
            gMarkerList = [];
        }

        function showMarker(map,latlng){
            $('#lat').val(latlng._lat);
            $('#lng').val(latlng._lng);
            var marker = new naver.maps.Marker({
                position: latlng,
                map: map
            });
            gMarkerList.push(marker);
        }

                @if(old('lat'))
        var map = new naver.maps.Map('map', {
                center: new naver.maps.LatLng({{old('lat')}}, {{old('lng')}}),
                zoom: 10
            });
        showMarker(map, new naver.maps.LatLng({{@$place->lat}}, {{@$place->lng}}));
                @elseif(@$place->lat)
        var map = new naver.maps.Map('map', {
                center: new naver.maps.LatLng({{@$place->lat}}, {{@$place->lng}}),
                zoom: 10
            });
        showMarker(map, new naver.maps.LatLng({{@$place->lat}}, {{@$place->lng}}));
                @else
        var map = new naver.maps.Map('map', {
                zoom: 10,
                center: new naver.maps.LatLng(37.3614483, 127.1114883)
            });
                @endif



        var menuLayer = $('<div style="position:absolute;z-index:10000;background-color:#fff;border:solid 1px #333;padding:10px;display:none;"></div>');
        map.getPanes().floatPane.appendChild(menuLayer[0]);
        naver.maps.Event.addListener(map, 'click', function(e) {
            removeMarkers();
            showMarker(map,e.coord);
        });
        naver.maps.Event.addListener(map, 'keydown', function(e) {
            var keyboardEvent = e.keyboardEvent,
                keyCode = keyboardEvent.keyCode || keyboardEvent.which;
            var ESC = 27;
            if (keyCode === ESC) {
                keyboardEvent.preventDefault();
                removeMarkers();
                menuLayer.hide();
            }
        });
        /*
        naver.maps.Event.addListener(map, 'mousedown', function(e) {
            menuLayer.hide();
        });
        naver.maps.Event.addListener(map, 'rightclick', function(e) {
            var coordHtml = 'Coord: '+ e.coord +'<br />Point: '+ e.point +'<br />Offset: '+ e.offset;
            menuLayer.show().css({
                left: e.offset.x,
                top: e.offset.y
            }).html(coordHtml);
        });
        */

        function showSubwayModal(){

        }

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })

    </script>
    {{-- //지도처리 --}}
@endpush