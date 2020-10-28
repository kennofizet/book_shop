
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
                            <td><span class="thead-text">Tiêu đề/Sản phẩm</span></td>
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
                                    <a href="" title="">{{$category_detail->title}}({{$category_detail->Product()->count()}})</a>
                                </div> 
                                <ul class="list-operation fl-right">
                                    <li><a href="{{route('admin.product.edit-category',$category_detail->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><span data-id="{{$category_detail->id}}" title="Xóa" class="delete delete-product-category"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
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
                                            <a href="" title="">{{$category_child_1->title}}({{$category_child_1->Product()->count()}})</a>
                                        </div> 
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{route('admin.product.edit-category',$category_child_1->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><span data-id="{{$category_child_1->id}}" title="Xóa" class="delete delete-product-category"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
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
                                                    <a href="" title="">{{$category_child_2->title}}({{$category_child_2->Product()->count()}})</a>
                                                </div> 
                                                <ul class="list-operation fl-right">
                                                    <li><a href="{{route('admin.product.edit-category',$category_child_2->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><span data-id="{{$category_child_2->id}}" title="Xóa" class="delete delete-product-category"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
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
                                                            <a href="" title="">{{$category_child_3->title}}({{$category_child_3->Product()->count()}})</a>
                                                        </div> 
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="{{route('admin.product.edit-category',$category_child_3->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><span data-id="{{$category_child_3->id}}" title="Xóa" class="delete delete-product-category"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
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
                                                                    <a href="" title="">{{$category_child_4->title}}({{$category_child_4->Product()->count()}})</a>
                                                                </div> 
                                                                <ul class="list-operation fl-right">
                                                                    <li><a href="{{route('admin.product.edit-category',$category_child_4->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><span data-id="{{$category_child_4->id}}" title="Xóa" class="delete delete-product-category"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
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
                            <td><span class="thead-text">Tiêu đề/Sản phẩm</span></td>
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
<a href="{{route('admin.product.category')}}" id="redirect-link"></a>
@endsection
@section('script')
<script type="text/javascript">
function loadScripts(scripts) {
var deferred = jQuery.Deferred();

function loadScript(i) {
  if (i < scripts.length) {
    jQuery.ajax({
      url: scripts[i],
      dataType: "script",
      cache: true,
      success: function() {
        loadScript(i + 1);
      }
    });
  } else {
    deferred.resolve();
  }
}
loadScript(0);

return deferred;
}

  var d1 = loadScripts([

  ]).done(function() {
    console.log("All scripts loaded1");

  });

    // queue #2 - jquery cycle2 plugin and tile effect plugin
    var d2 = loadScripts([
    ]).done(function() {
        console.log("All scripts loaded2");
        $('input[name="checkAll"]').click(function () {
            var status = $(this).prop('checked');
            $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
            $('.list-table-wp tbody tr td input[type="checkbox"]').addClass("product-type-list-table-checked");
        });
        $('input[name="checkItem"]').click(function () {
            $(this).toggleClass("product-type-list-table-checked");
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
      console.log("All scripts loaded");
      body_script("{{url('/')}}/admin/js/main.js");
    });
    
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
    $('.delete-product-category').on('click',function (e) {
        var id = $(this).attr('data-id');
        $.ajax({
            url:"{{ route('source.api.admin.product.category.delete') }}",
            method:"POST",
            data:{id:id},
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Đã xóa!");
                  $('#redirect-link').click();
              }else if(data.message == "error"){
                  pushNotify("error",1,"Có gĩ đó lỗi!");
              }else{
                  pushNotify("error",1,"Có gĩ đó lỗi!");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['id']) {
                    pushNotify("error",1,"Có gĩ đó lỗi!");
                };
            }
        });
    });
</script>
@endsection
