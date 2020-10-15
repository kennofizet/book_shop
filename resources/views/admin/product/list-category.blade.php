
@extends('admin.layout.main')

@section('content')

<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách danh mục (<em>Hiện tại chỉ hỗ trợ 5 cấp, nếu hơn sẽ không được hiển thị</em>)</h3>
            <a href="{{route('admin.product.create-category')}}" title="" id="add-new" class="fl-left">Thêm mới</a>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="table-responsive">
                <table class="table list-table-wp">
                    <thead>
                        <tr>
                            <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Tiêu đề</span></td>
                            <td><span class="thead-text">Thực trạng</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">Người tạo</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0 ?>
                        @foreach($list_category as $category_detail)
                        <?php $stt = $stt + 1 ?>
                        <tr>
                            <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                            <td><span class="tbody-text">{{$stt}}</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">{{$category_detail->title}}</a>
                                </div> 
                                <ul class="list-operation fl-right">
                                    <li><a href="{{route('admin.product.edit-category',$category_detail->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">
                                @if($category_detail->parent == 0)
                                <!-- không có danh mục cha -->
                                    -
                                @else
                                    <!-- nếu có danh mục cha -->
                                    @if($category_detail->Parent)
                                        - -
                                        @if($category_detail->Parent->Parent)
                                            -
                                            @if($category_detail->Parent->Parent->Parent)
                                                -
                                                @if($category_detail->Parent->Parent->Parent->Parent)
                                                    -
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            </span></td>
                            <td><span class="tbody-text">@if($category_detail->status == 1) Hiện @else Ẩn @endif</span></td>
                            <td><span class="tbody-text">{{$category_detail->User->name}}</span></td>
                            <td><span class="tbody-text">{{$category_detail->created_at}}</span></td>
                        </tr>
                            @if($category_detail->Child)
                                @foreach($category_detail->Child as $category_child_1)
                                <?php $stt = $stt + 1 ?>
                                <tr>
                                    <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                                    <td><span class="tbody-text">{{$stt}}</h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{$category_child_1->title}}</a>
                                        </div> 
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{route('admin.product.edit-category',$category_child_1->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">
                                        @if($category_child_1->parent == 0)
                                        <!-- không có danh mục cha -->
                                            -
                                        @else
                                            <!-- nếu có danh mục cha -->
                                            @if($category_child_1->Parent)
                                                - -
                                                @if($category_child_1->Parent->Parent)
                                                    -
                                                    @if($category_child_1->Parent->Parent->Parent)
                                                        -
                                                        @if($category_child_1->Parent->Parent->Parent->Parent)
                                                            -
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    </span></td>
                                    <td><span class="tbody-text">@if($category_child_1->status == 1) Hiện @else Ẩn @endif</span></td>
                                    <td><span class="tbody-text">{{$category_child_1->User->name}}</span></td>
                                    <td><span class="tbody-text">{{$category_child_1->created_at}}</span></td>
                                </tr>
                                    @if($category_child_1->Child)
                                        @foreach($category_child_1->Child as $category_child_2)
                                        <?php $stt = $stt + 1 ?>
                                        <tr>
                                            <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                                            <td><span class="tbody-text">{{$stt}}</h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title="">{{$category_child_2->title}}</a>
                                                </div> 
                                                <ul class="list-operation fl-right">
                                                    <li><a href="{{route('admin.product.edit-category',$category_child_2->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text">
                                                @if($category_child_2->parent == 0)
                                                <!-- không có danh mục cha -->
                                                    -
                                                @else
                                                    <!-- nếu có danh mục cha -->
                                                    @if($category_child_2->Parent)
                                                        - -
                                                        @if($category_child_2->Parent->Parent)
                                                            -
                                                            @if($category_child_2->Parent->Parent->Parent)
                                                                -
                                                                @if($category_child_2->Parent->Parent->Parent->Parent)
                                                                    -
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </span></td>
                                            <td><span class="tbody-text">@if($category_child_2->status == 1) Hiện @else Ẩn @endif</span></td>
                                            <td><span class="tbody-text">{{$category_child_2->User->name}}</span></td>
                                            <td><span class="tbody-text">{{$category_child_2->created_at}}</span></td>
                                        </tr>
                                            @if($category_child_2->Child)
                                                @foreach($category_child_2->Child as $category_child_3)
                                                <?php $stt = $stt + 1 ?>
                                                <tr>
                                                    <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                                                    <td><span class="tbody-text">{{$stt}}</h3></span>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title="">{{$category_child_3->title}}</a>
                                                        </div> 
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="{{route('admin.product.edit-category',$category_child_3->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text">
                                                        @if($category_child_3->parent == 0)
                                                        <!-- không có danh mục cha -->
                                                            -
                                                        @else
                                                            <!-- nếu có danh mục cha -->
                                                            @if($category_child_3->Parent)
                                                                - -
                                                                @if($category_child_3->Parent->Parent)
                                                                    -
                                                                    @if($category_child_3->Parent->Parent->Parent)
                                                                        -
                                                                        @if($category_child_3->Parent->Parent->Parent->Parent)
                                                                            -
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </span></td>
                                                    <td><span class="tbody-text">@if($category_child_3->status == 1) Hiện @else Ẩn @endif</span></td>
                                                    <td><span class="tbody-text">{{$category_child_3->User->name}}</span></td>
                                                    <td><span class="tbody-text">{{$category_child_3->created_at}}</span></td>
                                                </tr>
                                                    @if($category_child_3->Child)
                                                        @foreach($category_child_3->Child as $category_child_4)
                                                        <?php $stt = $stt + 1 ?>
                                                        <tr>
                                                            <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                                                            <td><span class="tbody-text">{{$stt}}</h3></span>
                                                            <td class="clearfix">
                                                                <div class="tb-title fl-left">
                                                                    <a href="" title="">{{$category_child_4->title}}</a>
                                                                </div> 
                                                                <ul class="list-operation fl-right">
                                                                    <li><a href="{{route('admin.product.edit-category',$category_child_4->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </td>
                                                            <td><span class="tbody-text">
                                                                @if($category_child_4->parent == 0)
                                                                <!-- không có danh mục cha -->
                                                                    -
                                                                @else
                                                                    <!-- nếu có danh mục cha -->
                                                                    @if($category_child_4->Parent)
                                                                        - -
                                                                        @if($category_child_4->Parent->Parent)
                                                                            -
                                                                            @if($category_child_4->Parent->Parent->Parent)
                                                                                -
                                                                                @if($category_child_4->Parent->Parent->Parent->Parent)
                                                                                    -
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </span></td>
                                                            <td><span class="tbody-text">@if($category_child_4->status == 1) Hiện @else Ẩn @endif</span></td>
                                                            <td><span class="tbody-text">{{$category_child_4->User->name}}</span></td>
                                                            <td><span class="tbody-text">{{$category_child_4->created_at}}</span></td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Tiêu đề</span></td>
                            <td><span class="thead-text">Thực trạng</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">Người tạo</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="section" id="paging-wp">
        <div class="section-detail clearfix">
            <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
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
