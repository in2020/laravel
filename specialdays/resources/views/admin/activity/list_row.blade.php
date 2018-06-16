<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-22
 * Time: 오후 11:50
 */
?>
<tr>
    <td align="center">{{$activity->id}}</td>
    <td align="center"><a href="{{url('admin/activity')}}/{{$activity->id}}">{{$activity->name}}</a></td>
    <td align="center">{{$activity->type->name}}</td>
    <td align="center">{{$activity->state->name}}</td>
    <td align="center">{{$activity->hit}}</td>
</tr>

