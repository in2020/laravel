<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-06
 * Time: 오후 11:42
 */
?>
<tr>
    <td align="center">{{$place->id}}</td>
    <td align="center">
        @foreach($place->subway as $subway)
        {{$subway->name}}
            @if (!$loop->last)
                ,
            @endif
        @endforeach
    </td>
    <td align="center"><a href="{{url('admin/place')}}/{{$place->id}}">{{$place->name}}</a></td>
    <td align="center">{{$place->activity_count}}</td>
    <td align="center">{{$place->hit}}</td>
</tr>
