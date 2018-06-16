<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-05
 * Time: 오전 8:20
 */
?>
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">검색</div>

                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">지하철</label>

                                <div class="col-md-6">
                                    <input id="subway" type="text" class="form-control" name="subway" value="{{ Request::get('subway') }}">
                                </div>
                            </div>

 {{--                           <div class="form-group">
                                <label for="email" class="col-md-4 control-label">상태</label>

                                <div class="col-md-6">
                                    <label class="radio-inline"><input type="radio" name="place_state_id" id="state1" value="2" {{Request::get('place_state_id') == 2 ? 'checked':''}}>등록완료</label>
                                    <label class="radio-inline"><input type="radio" name="place_state_id" id="state2" value="1" {{Request::get('place_state_id') == 1 ? 'checked':''}}>등록중</label>
                                </div>
                            </div>--}}

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">플레이스명</label>

                                <div class="col-md-6">
                                    <input id="keyword" type="text" class="form-control" name="name" value="{{ Request::get('name') }}"  >
                                </div>
                            </div>
                            <div class="form-group">
                                <div style="text-align: center; width: 100%;" class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        검색
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>총 {{$places->total()}}개</b></div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>지하철</th>
                                <th>플레이스명</th>
                                <th>클래스 개수</th>
                                <th>조회수</th>
                            </tr>
                            </thead>
                            <tbody>

                            @each('admin.place.list_row', $places, 'place','admin.common.empty')

                            </tbody>
                        </table>
                        <div class="text-center">{{ $places->links() }}</div>

                        <a href="{{ url('admin/place') }}" class="btn btn-primary"> 콘텐츠 등록</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

