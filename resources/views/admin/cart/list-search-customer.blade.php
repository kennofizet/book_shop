@foreach($list_customer as $customer_detail)
<tr>
    <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
    <td><span class="tbody-text">{{$loop->index + 1}}</h3></span>
    <td>
        <div class="tb-title fl-left">
            <span>{{$customer_detail->name}}</span>
        </div>
        <ul class="list-operation fl-right">
            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
        </ul>
    </td>
    <td><span class="tbody-text">{{$customer_detail->phone}}</span></td>
    <td><span class="tbody-text">{{$customer_detail->email}}</span></td>
    <td><span class="tbody-text">{{$customer_detail->address}}</span></td>
    <td><span class="tbody-text">{{$customer_detail->Bill->code}}</span></td>
    <td><span class="tbody-text">{{$customer_detail->created_at}}</span></td>
</tr>
@endforeach
