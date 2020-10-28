@foreach($list_account as $detail_account)
<tr>
<!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
<td><span class="tbody-text">{{$loop->index + 1}}</h3></span>
<td><span class="tbody-text">{{$detail_account->email}}</h3></span>
<td>
    <div class="tb-title fl-left">
        <a href="#">{{$detail_account->name}}</a>
    </div>
    <ul class="list-operation fl-right">
        <li><span title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
    </ul>
</td>
<td><span class="tbody-text">@if($detail_account->parent_verifi_email == 1) Đã xác thực @else Chưa xác thực @endif</span></td>
<td><span class="tbody-text">{{$detail_account->phone}} VNĐ</span></td>
<td><span class="tbody-text">{{$detail_account->address}}</span></td>
<td><span class="tbody-text">{{$detail_account->link}}</span></td>
<td><span class="tbody-text">{{$detail_account->created_at}}</span></td>
@endforeach
