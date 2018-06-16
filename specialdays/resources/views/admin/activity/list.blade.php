<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-06
 * Time: 오후 9:12
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
                                <label for="name" class="col-md-4 control-label">클래스명</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ Request::get('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">상태</label>

                                <div class="col-md-6">
                                    <label class="radio-inline"><input type="radio" name="activity_state_id" id="state1" value="2" {{Request::get('activity_state_id') == 2 ? 'checked':''}}>등록완료</label>
                                    <label class="radio-inline"><input type="radio" name="activity_state_id" id="state2" value="1" {{Request::get('activity_state_id') == 1 ? 'checked':''}}>등록중</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">활동</label>

                                <div class="col-md-6">
                                    <select name="activity_type_id">
                                        <option value="1" {{Request::get('activity_type_id') == 1 ? 'selected':''}}>미술</option>
                                        <option value="2" {{Request::get('activity_type_id') == 2 ? 'selected':''}}>공예</option>
                                        <option value="3" {{Request::get('activity_type_id') == 3 ? 'selected':''}}>보컬</option>
                                    </select>
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
                    <div class="panel-heading"><b>총 {{$activities->total()}}개</b></div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>클래스명</th>
                                <th>활동</th>
                                <th>상태</th>
                                <th>조회수</th>
                            </tr>
                            </thead>
                            <tbody>

                            @each('admin.activity.list_row', $activities, 'activity','admin.common.empty')

                            </tbody>
                        </table>
                        <div class="text-center">{{ $activities->links() }}</div>
                        <a href="{{ url('admin/activity') }}" class="btn btn-primary"> 콘텐츠 등록</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


