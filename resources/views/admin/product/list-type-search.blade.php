@foreach($list_type as $detail_type)
<tr>
    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
    <td><span class="tbody-text">{{$loop->index + 1}}</h3></span>
    <td class="clearfix">
        <div class="tb-title fl-left">
            <a href="" title="">{{$detail_type->name}}</a>
        </div>
        <ul class="list-operation fl-right">
            <li><span class="button-delete-product-type" data-id="{{$detail_type->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                <form style="display: none;" action="" method="POST" id="form-delete-product-type-{{$detail_type->id}}" class="form-delete-product-type">
                    <input type="text" name="id" value="{{$detail_type->id}}">
                </form>
            </span></li>
        </ul>
    </td>
    <td><span class="tbody-text">{!! $detail_type->description !!}</span></td>
    <td><span class="tbody-text"><img src="{{url('/')}}/upload/source/api/product/type/thumbnail/{{$detail_type->image}}" style="width: 10em"></span></td>
    <td><span class="tbody-text">{{$detail_type->Product->name}}</span></td>
</tr>
@endforeach
