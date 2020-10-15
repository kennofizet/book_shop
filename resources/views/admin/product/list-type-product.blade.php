@extends('admin.layout.main')

@section('content')

 <div id="content" class="fl-right">           
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách các chi tiết của sản phẩm</h3>
            <a href="?page=add_page" title="" id="add-new" class="fl-left">Thêm mới</a>
        </div>
    </div>            
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="{{route('admin.product.type.list')}}">Tất cả <span class="count">({{$list_type->count()}})</span></a> |</li>
                </ul>
                <form method="GET" class="form-s fl-right">
                    <input type="text" name="s" id="s">
                    <input type="submit" name="sm_s" value="Tìm kiếm">
                </form>
            </div>
            <div class="actions">
                <form method="GET" action="" class="form-actions">
                    <select name="actions">
                        <option value="0">Tác vụ</option>
                        <option value="1">Chỉnh sửa</option>
                        <option value="2">Bỏ vào thủng rác</option>
                    </select>
                    <input type="submit" name="sm_action" value="Áp dụng">
                </form>
            </div>
            <div class="table-responsive">
                <table class="table list-table-wp">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Tên</span></td>
                            <td><span class="thead-text">Miêu tả</span></td>
                            <td><span class="thead-text">Ảnh</span></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_type as $detail_type)
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">1</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">{{$detail_type->name}}</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">{{$detail_type->description}</span></td>
                            <td><span class="tbody-text">{{$detail_type->image}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Tên</span></td>
                            <td><span class="thead-text">Miêu tả</span></td>
                            <td><span class="thead-text">Ảnh</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
    <div class="section" id="paging-wp">
        <div class="section-detail clearfix">
            <ul id="list-paging" class="fl-right">
                <li>
                    <a href="" title=""><</a>
                </li>
                <li>
                    <a href="" title="">1</a>
                </li>
                <li>
                    <a href="" title="">2</a>
                </li>
                <li>
                    <a href="" title="">3</a>
                </li>
                <li>
                    <a href="" title="">></a>
                </li>
            </ul>
        </div>
    </div>
</div>
    
@endsection
@section('script')
<script type="text/javascript">
    body_script("{{url('/')}}/admin/js/main.js");
</script>
@endsection
