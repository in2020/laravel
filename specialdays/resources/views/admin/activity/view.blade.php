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
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">클래스 등록</div>

                    <div class="panel-body">
                        @empty($activity)
                            <form class="form-horizontal" id="frmActivity" method="POST" enctype="multipart/form-data" action="{{ url('admin/activity') }}">
                        @endempty

                        @isset($activity)
                            <form name="frmActivity" id="frmActivity" class="form-horizontal" method="POST" onsubmit="return setDeletingImage('frmActivity');" enctype="multipart/form-data" action="{{ url('admin/activity') }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{$activity->id}}">
                         @endisset
                            {{ csrf_field() }}
                         @isset($place)
                            <div class="form-group">
                                <label for="region" class="col-md-4 control-label">플레이스명</label>

                                <div class="col-md-6">
                                    <input type="hidden" name="place_id" value="{{@$place->id}}">
                                    {{@$place->name}}
                                </div>
                            </div>
                         @endisset

                            <div class="form-group">
                                <label for="activity_type_id" class="col-md-4 control-label">활동</label>

                                <div class="col-md-6">
                                    <select id="activity_type_id" name="activity_type_id">
                                        @foreach($activityType as $type)
                                        <option value="{{@$type->id}}" @if($activity && $type->id == $activity->activity_type_id) selected @endif>{{@$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">클래스명</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="@if(old('name')){{ old('name') }}@else{{@$activity->name}}@endif" maxlength="50" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="main_price" class="col-md-4 control-label">월 요금(대표)</label>

                                <div class="col-md-6">
                                    <input id="main_price" type="text" class="form-control" name="main_price" value="@if(old('main_price')){{ old('main_price') }}@else{{@$activity->main_price}}@endif" title=""  maxlength="10" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">이미지(최대30개)</label>

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
                                    @foreach ($activity->image as $img)
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
                                <label for="introduce" class="col-md-4 control-label">활동 소개</label>

                                <div class="col-md-6">
                                    <textarea id="introduce" name="introduce" class="form-control" rows="10" maxlength="2000">@if(old('introduce')){{ old('introduce') }}@else{{@$activity->introduce}}@endif</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">활동안내 및 요금</label>

                                <div class="col-md-6">
                                    <textarea id="description" name="description" class="form-control" rows="10" maxlength="2000">@if(old('description')){{ old('description') }}@else{{@$activity->description}}@endif</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="must_read" class="col-md-4 control-label">필독사항</label>

                                <div class="col-md-6">
                                    <textarea id="must_read" name="must_read" class="form-control" rows="10" maxlength="2000">@if(old('must_read')){{ old('must_read') }}@else{{@$activity->must_read}}@endif</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        저장
                                    </button>
                                    <button type="button" onclick="history.back();" class="btn btn-primary">
                                        뒤로
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- 파일처리 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
    <script src="{{asset('js/image.js')}}"></script>
    {{-- //파일처리 --}}
@endpush