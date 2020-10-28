@foreach($list_bill as $detail_bill)
<tr>
    <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
    <td><span class="tbody-text">{{$loop->index + 1}}</h3></span>
    <td><span class="tbody-text">{{$detail_bill->code}}</h3></span>
    <td>
        <div class="tb-title fl-left">
            <a href="{{route('admin.cart.customer-by-id',$detail_bill->Customer->id)}}" title="Khác hàng">{{$detail_bill->Customer->name}}</a>
        </div>
        <ul class="list-operation fl-right">
            <li><span title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
        </ul>
    </td>
    <td><span class="tbody-text">@if($detail_bill->status == 1) Chưa hoàn thành @elseif($detail_bill->status == 2) Đang vận chuyển @else Đã hoàn thành @endif</span></td>
    <td><span class="tbody-text">{{$detail_bill->total}} VNĐ</span></td>
    <td><span class="tbody-text">{{$detail_bill->note}}</span></td>
    <td><span class="tbody-text">{{$detail_bill->created_at}}</span></td>
    <td><a href="{{route('admin.cart.list-detail',$detail_bill->id)}}" title="" class="tbody-text">Chi tiết</a></td>
    @endforeach
