@foreach($list_product as $detail_product)
<tr>
    <td><span class="tbody-text">{{$detail_product->id}}</h3></span>
    <td>
        <div class="tbody-thumb">
            <img src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_product->image}}" alt="">
        </div>
    </td>
    <td class="clearfix">
        <div class="tb-title fl-left">
            <a href="" title="">{{$detail_product->name}}</a>
        </div>
        <ul class="list-operation fl-right">
            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
        </ul>
    </td>
    <td><span class="tbody-text">{{$detail_product->price}}.vnd</span></td>
    <td><span class="tbody-text">@if($detail_product->sale_price > 0) {{$detail_product->sale_price}}.vnd @else Không Sale @endif</span></td>
    <td><span class="tbody-text">{{$detail_product->Category->title}}</span></td>
    
    <td><span class="tbody-text">@if($detail_product->status_count == 1) Còn hàng @else Hết hàng @endif</span></td>
    <td><span class="tbody-text">{{$detail_product->created_at}}</span></td>
</tr>
@endforeach
