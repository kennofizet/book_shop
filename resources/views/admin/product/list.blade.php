@extends('admin.layout.main')

@section('content')

<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="{{route('admin.product.list')}}">Tất cả <span class="count">({{$count_all}})</span></a> |</li>
                    <li class="publish"><a href="{{route('admin.product.list-active')}}">Còn hàng <span class="count">({{$count_active}})</span></a> |</li>
                    <li class="pending"><a href="{{route('admin.product.list-hidden')}}">Hết hàng<span class="count">({{$count_hidden}})</span> |</a></li>
                </ul>
                <form method="POST" action="{{ route('admin.product.search') }}" id="form-add-search-product" class="form-s fl-right">
                {{csrf_field()}}
                    <input type="text" name="key" id="key_search">
                    <input type="submit" name="sm_s" value="Tìm kiếm">
                </form>
            </div>
           <!--  <div class="actions">
                <form method="GET" action="" class="form-actions">
                    <select name="actions">
                        <option value="0">Tác vụ</option>
                        <option value="1">Công khai</option>
                        <option value="1">Chờ duyệt</option>
                        <option value="2">Bỏ vào thủng rác</option>
                    </select>
                    <input type="submit" name="sm_action" value="Áp dụng">
                </form>
            </div> -->
            <div class="actions">
                    <select name="actions" id="actions-action-active-action-form">
                        <option value="">Tác vụ</option>
                        <option value="1">Sale</option>
                        <option value="2">Hết Sale</option>
                        <option value="3">Còn hàng</option>
                        <option value="4">Hết Hàng</option>
                        <input type="submit" class="btn btn-success" style="margin:0px 2px" id="actions-action-active-action-button" name="sm_action" value="Áp dụng">
                    </select>
                    <select name="actions-number" id="actions-action-active-number-form">
                        <option value="default" @if($count_rows_data_setting_new == 5) selected @endif>Số lượng hiển thị/Trang</option>
                        <option value="1" @if($count_rows_data_setting_new == 1) selected @endif>1</option>
                        <option value="10" @if($count_rows_data_setting_new == 10) selected @endif>10</option>
                        <option value="20" @if($count_rows_data_setting_new == 20) selected @endif>20</option>
                        <option value="30" @if($count_rows_data_setting_new == 30) selected @endif>30</option>
                        <option value="50" @if($count_rows_data_setting_new == 50) selected @endif>50</option>
                        <option value="100" @if($count_rows_data_setting_new == 100) selected @endif>100</option>
                        <option value="all" @if($count_rows_data_setting_new == $count_all) selected @endif>All</option>
                    </select>
                    <select name="actions-category" id="actions-action-active-category-form">
                        @if($list_category->count() > 0)
                            <option value="" @if($category_active == 0) selected @endif>-- Chọn danh mục --</option>
                            @foreach($list_category as $detail_category)
                                <option value="{{$detail_category->id}}" @if($category_active == $detail_category->id) selected @endif>{{$detail_category->title}}({{$detail_category->Product()->count()}})</option>
                                @if($detail_category->Child->first())
                                    @foreach($detail_category->Child as $category_child_1)
                                        <option value="{{$category_child_1->id}}" @if($category_active == $category_child_1->id) selected @endif>- {{$category_child_1->title}}({{$category_child_1->Product()->count()}})</option>
                                        @if($category_child_1->Child->first())
                                            @foreach($category_child_1->Child as $category_child_2)
                                                <option value="{{$category_child_2->id}}" @if($category_active == $category_child_2->id) selected @endif>- - {{$category_child_2->title}}({{$category_child_2->Product()->count()}})</option>
                                                @if($category_child_2->Child->first())
                                                    @foreach($category_child_2->Child as $category_child_3)
                                                        <option value="{{$category_child_3->id}}" @if($category_active == $category_child_3->id) selected @endif>- - - {{$category_child_3->title}}({{$category_child_3->Product()->count()}})</option>
                                                        @if($category_child_3->Child->first())
                                                            @foreach($category_child_3->Child as $category_child_4)
                                                                <option value="{{$category_child_4->id}}" @if($category_active == $category_child_4->id) selected @endif>- - - - {{$category_child_4->title}}({{$category_child_4->Product()->count()}})</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <option value="">Bạn cần tạo danh mục trước</option>
                        @endif
                    </select>
            </div>
            <div class="table-responsive">
                <table class="table list-table-wp">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="thead-text">ID</span></td>
                            <td><span class="thead-text">Hình ảnh</span></td>
                            <td><span class="thead-text">Tên sản phẩm</span></td>
                            <td><span class="thead-text">Giá</span></td>
                            <td><span class="thead-text">Sale</span></td>
                            <td><span class="thead-text">Danh mục</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                        </tr>
                    </thead>
                    <tbody id="body-search-append">
                        @foreach($list_product as $detail_product)
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem" data-id="{{$detail_product->id}}"></td>
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
                                    <li><a href="{{route('admin.product.edit',$detail_product->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><span data-id="{{$detail_product->id}}" title="Xóa" class="delete delete-product"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">{{$detail_product->price}}.vnd</span></td>
                            <td><span class="tbody-text">@if($detail_product->sale_price > 0) {{$detail_product->sale_price}}.vnd @else Không Sale @endif <span class="relife-sale-product" data-sale="
                                @if($detail_product->sale_price > 0)
                                1
                                @else
                                0
                                @endif
                                " data-id="{{$detail_product->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></span></span></td>
                            <td><span class="tbody-text">{{$detail_product->Category->title}}</span></td>
                            
                            <td><span class="tbody-text">@if($detail_product->status_count == 1) Còn hàng @else Hết hàng @endif <span class="relife-status-count-product" data-status-count="
                                @if($detail_product->status_count > 0)
                                1
                                @else
                                0
                                @endif
                                " data-id="{{$detail_product->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></span></span></td>
                            <td><span class="tbody-text">{{$detail_product->created_at}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="tfoot-text">ID</span></td>
                            <td><span class="tfoot-text">Hình ảnh</span></td>
                            <td><span class="tfoot-text">Tên sản phẩm</span></td>
                            <td><span class="tfoot-text">Giá</span></td>
                            <td><span class="tfoot-text">Sale</span></td>
                            <td><span class="tfoot-text">Danh mục</span></td>
                            <td><span class="tfoot-text">Trạng thái</span></td>
                            <td><span class="tfoot-text">Thời gian</span></td>
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
                {{$list_product->links()}}
            </ul>
        </div>
    </div>
</div>



<div class="modal fade" id="modalEditSaleProductToSale" tabindex="-1" role="dialog" aria-labelledby="modalEditSaleProductToSaleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POSt" id="form-edit-sale-product-to-sale">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditSaleProductToSaleLabel">Quản lý sale sản phẩm ID:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <input type="" name="id" id="id-edit-sale-product-to-sale" style="display: none;">
           <label>Sản phẩm này chưa Sale, bạn có muốn Sale sản phẩm này không ?</label>
           <label>Nhập 1 trong 3 loại</label>
           <div>
               <div style="margin-top: 10px">
                   <label>Giá sale mới : </label>
                   <input type="number" name="price_sale" placeholder="Nhập số tiền mới ví dụ : 100000000" style="width: 100%">
               </div>
               <div style="margin-top: 10px">
                   <label>Số tiền giảm : </label>
                   <input type="number" name="price_sale_price" placeholder="Nhập số tiền mới ví dụ : 100000000" style="width: 100%">
               </div>
               <div style="margin-top: 10px">
                   <label>Giá sale mới (theo %) : </label>
                   <input type="number" name="price_sale_check" placeholder="Nhập giá trị ví dụ : 10" style="width: 100%">
               </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Thực hiện</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="modalEditSaleProductToSaleSeries" tabindex="-1" role="dialog" aria-labelledby="modalEditSaleProductToSaleSeriesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POSt" id="form-edit-sale-product-to-sale-series">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditSaleProductToSaleSeriesLabel">Giảm giá đồng loạt các sản phẩm đã chọn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <input type="" name="id" id="id-edit-sale-product-to-sale-series" style="display: none;">
           <label>Sẽ áp dụng cho tất cả sản phẩm</label>
           <label>Nhập 1 trong 3 loại</label>
           <div>
               <div style="margin-top: 10px">
                   <label>Giá sale mới : </label>
                   <input type="number" name="price_sale" placeholder="Nhập số tiền mới ví dụ : 100000000" style="width: 100%">
               </div>
               <div style="margin-top: 10px">
                   <label>Số tiền giảm : </label>
                   <input type="number" name="price_sale_price" placeholder="Nhập số tiền mới ví dụ : 100000000" style="width: 100%">
               </div>
               <div style="margin-top: 10px">
                   <label>Giá sale mới (theo %) : </label>
                   <input type="number" name="price_sale_check" placeholder="Nhập giá trị ví dụ : 10" style="width: 100%">
               </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Thực hiện</button>
      </div>
      </form>
    </div>
  </div>
</div>




<div class="modal fade" id="modalEditSaleProductUnSaleSeries" tabindex="-1" role="dialog" aria-labelledby="modalEditSaleProductUnSaleSeriesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POSt" id="form-edit-sale-product-un-sale-series">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditSaleProductUnSaleSeriesLabel">Hủy giảm giá đồng loạt các sản phẩm đã chọn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <input type="" name="id" id="id-edit-sale-product-un-sale-series" style="display: none;">
           <label>Sẽ áp dụng cho tất cả sản phẩm</label>
           <label>Những sản phẩm sẽ được xóa giảm giá, vui lòng xác nhận</label>
           <input type="text" name="action" value="" style="display: none;" id="sale-product-button-series">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Thực hiện</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="modalEditSaleProductToUnSale" tabindex="-1" role="dialog" aria-labelledby="modalEditSaleProductToUnSaleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POSt" id="form-edit-sale-product-to-un-sale">
      {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditSaleProductToUnSaleLabel">Quản lý sale sản phẩm ID:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input type="" name="id" id="id-edit-sale-product-to-un-sale" style="display: none;">
            <label>Bạn có muốn hủy Sale của sản phẩm này không ?</label>
            <label>Bạn cũng có thể cập nhật sale tại đây : </label>

            <label>Nhập 1 trong 3 loại</label>
            <div>
               <div style="margin-top: 10px">
                   <label>Giá sale mới : </label>
                   <input type="number" name="price_sale" placeholder="Nhập số tiền mới ví dụ : 100000000" style="width: 100%">
               </div>
               <div style="margin-top: 10px">
                   <label>Số tiền giảm : </label>
                   <input type="number" name="price_sale_price" placeholder="Nhập số tiền mới ví dụ : 100000000" style="width: 100%">
               </div>
               <div style="margin-top: 10px">
                   <label>Giá sale mới (theo %) : </label>
                   <input type="number" name="price_sale_check" placeholder="Nhập giá trị ví dụ : 10" style="width: 100%">
               </div>
            </div>
            <input type="text" name="action" value="" style="display: none;" id="sale-product-button">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="un-sale-product-button">Hủy Sale</button>
        <button type="button" class="btn btn-primary" id="update-sale-product-button">Cập Nhật Sale</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalToHasStoreProduct" tabindex="-1" role="dialog" aria-labelledby="modalToHasStoreProductLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POSt" id="form-edit-store-product-to-has">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalToHasStoreProductLabel">Quản lý tồn kho hàng hóa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <label>Bạn đã có hàng hóa cho sản phẩm này ?</label>
           <input type="" name="id" id="id-edit-store-product-to-has" style="display: none;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Đúng</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalToHasStoreProductSeries" tabindex="-1" role="dialog" aria-labelledby="modalToHasStoreProductSeriesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POSt" id="form-edit-store-product-to-has-series">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalToHasStoreProductSeriesLabel">Quản lý tồn kho hàng hóa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <label>Bạn đã có hàng hóa cho những sản phẩm này ?</label>
           <input type="" name="id" id="id-edit-store-product-to-has-series" style="display: none;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Đúng</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="modalToNonStoreProduct" tabindex="-1" role="dialog" aria-labelledby="modalToNonStoreProductLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POSt" id="form-edit-store-product-to-non">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalToNonStoreProductLabel">Quản lý sale sản phẩm ID:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label>Bạn đã hết hàng hóa cho sản phẩm này ?</label>
            <input type="" name="id" id="id-edit-store-product-to-non" style="display: none;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Đúng</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="modalToNonStoreProductSeries" tabindex="-1" role="dialog" aria-labelledby="modalToNonStoreProductSeriesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POSt" id="form-edit-store-product-to-non-series">
        {{csrf_field()}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalToNonStoreProductSeriesLabel">Quản lý tồn kho sản phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label>Bạn đã hết hàng hóa cho những sản phẩm này ?</label>
            <input type="" name="id" id="id-edit-store-product-to-non-series" style="display: none;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary">Đúng</button>
      </div>
      </form>
    </div>
  </div>
</div>



<a href="{{url()->full()}}" id="redirect-link"></a>
<a href="{{url()->current()}}" id="redirect-link-default"></a>
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
            $('.list-table-wp tbody tr td input[type="checkbox"]').addClass("product-list-table-checked");
        });
        $('input[name="checkItem"]').click(function () {
            $(this).toggleClass("product-list-table-checked");
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
$('#actions-action-active-category-form').on('change', function() {
  $.ajax({
      url:"{{ route('source.api.admin.product.setting-category-data-page-product') }}",
      method:"POST",
      data:{category:this.value},
      success:function(data){
        console.log(data);
        if (data.message == "error") {
            pushNotify("validation",1,"Số lượng không họp lệ");
        }else if(data.message == "success"){
            pushNotify("success",1,"Đã thay đổi");
            $('#redirect-link-default').click();
        }else{
            pushNotify("error",1,"Có gĩ đó lỗi!");
        }
      },
      error:function(jqXHR, textStatus, errorThrown) {
          pushNotify("error",1,"Có gĩ đó lỗi!");
      }
    });
});
$('#actions-action-active-number-form').on('change', function() {
  $.ajax({
      url:"{{ route('source.api.admin.product.setting-count-data-page-product') }}",
      method:"POST",
      data:{number:this.value},
      success:function(data){
        console.log(data);
        if (data.message == "error") {
            pushNotify("validation",1,"Số lượng không họp lệ");
        }else if(data.message == "success"){
            pushNotify("success",1,"Đã thay đổi");
            $('#redirect-link-default').click();
        }else{
            pushNotify("error",1,"Có gĩ đó lỗi!");
        }
      },
      error:function(jqXHR, textStatus, errorThrown) {
          pushNotify("error",1,"Có gĩ đó lỗi!");
      }
    });
});
</script>
<script type="text/javascript">
    // $('#key_search').keyup(function(){ 
    //     $('#form-add-search-product').submit();
    // });
    $('#key_search').on('keyup', function() {
        $('#form-add-search-product').submit();
    });
    
    $('#form-add-search-product').on('submit', function(e) {
        var key = $('#key_search').val();
        // console.log(key);
        e.preventDefault();
        $.ajax({
          url:"{{ route('admin.product.search') }}",
          method:"POST",
          data:{key:key},
          success:function(data){
               $('#body-search-append').html(data.html);
          },
          error:function(jqXHR, textStatus, errorThrown) {
              pushNotify("error",1,"Có gĩ đó lỗi!");
          }
        });
    });
</script>
<script type="text/javascript">
    $('.relife-sale-product').on('click',function (e) {
        // alert("a");
        if ($(this).attr('data-sale') == 0) {
            $('#modalEditSaleProductToSaleLabel').html("Quản lý sản phẩm ID:" + $(this).attr('data-id'));
            $('#modalEditSaleProductToSale').modal('toggle');
            $('#id-edit-sale-product-to-sale').val($(this).attr('data-id'));
        }else{
            $('#modalEditSaleProductToUnSaleLabel').html("Quản lý sản phẩm ID:" + $(this).attr('data-id'));
            $('#modalEditSaleProductToUnSale').modal('toggle');
            $('#id-edit-sale-product-to-un-sale').val($(this).attr('data-id'));
        }
    });
    $('.relife-status-count-product').on('click',function (e) {
        // alert("a");
        if ($(this).attr('data-status-count') == 0) {
            $('#modalToHasStoreProductLabel').html("Quản lý trạng thái sản phẩm ID:" + $(this).attr('data-id'));
            $('#modalToHasStoreProduct').modal('toggle');
            $('#id-edit-store-product-to-has').val($(this).attr('data-id'));
        }else{
            $('#modalToNonStoreProductLabel').html("Quản lý trạng thái sản phẩm ID:" + $(this).attr('data-id'));
            $('#modalToNonStoreProduct').modal('toggle');
            $('#id-edit-store-product-to-non').val($(this).attr('data-id'));
        }
    });
</script>
<script type="text/javascript">
jQuery(function($) {
      $('#form-edit-sale-product-to-sale').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.product.sale.new') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Đã cập nhật!");
                  $('#modalEditSaleProductToSale').modal('toggle');
                  $('#redirect-link').click();
              }else if(data.message == "error"){
                    pushNotify("error",1,"Có gĩ đó lỗi!");
              }else if(data.message == "validator"){
                    pushNotify("validation",1,"Vui lòng nhập đầy đủ");
              }else if(data.message == "validator-price"){
                    pushNotify("validation",1,"Giá sale cần là số và nhỏ hơn giá gốc");
              }else if(data.message == "validator-price-sale"){
                    pushNotify("validation",1,"Số tiền sale cần là số và nhỏ hơn giá gốc");
              }else if(data.message == "validator-price-check"){
                    pushNotify("validation",1,"Sale theo % cần nhỏ hơn 100");
              }else{
                  pushNotify("error",1,"Có gĩ đó lỗi!");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['id']) {
                    pushNotify("error",1,"Có gĩ đó lỗi!");
                };
                if (jqXhr['responseJSON']['errors']['price_sale_check']) {
                    pushNotify("error",1,"Giá sale % nhập đúng định dạng!");
                };
                if (jqXhr['responseJSON']['errors']['price_sale']) {
                    pushNotify("error",1,"Giá sale nhập đúng định dạng!");
                };
            }
          });
      });
      $('#update-sale-product-button').on('click',function () {
          $('#sale-product-button').val('update');
          $('#form-edit-sale-product-to-un-sale').submit();
      });
      $('#un-sale-product-button').on('click',function () {
          $('#sale-product-button').val('sale');
          $('#form-edit-sale-product-to-un-sale').submit();
      });
      $('#form-edit-sale-product-to-un-sale').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.product.sale.un') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Đã cập nhật!");
                  $('#modalEditSaleProductToUnSale').modal('toggle');
                  $('#redirect-link').click();
              }else if(data.message == "error"){
                    pushNotify("error",1,"Có gĩ đó lỗi!");
              }else if(data.message == "validator"){
                    pushNotify("validation",1,"Vui lòng nhập đầy đủ");
              }else if(data.message == "validator-price"){
                    pushNotify("validation",1,"Giá sale cần là số và nhỏ hơn giá gốc");
              }else if(data.message == "validator-price-sale"){
                    pushNotify("validation",1,"Số tiền sale cần là số và nhỏ hơn giá gốc");
              }else if(data.message == "validator-price-check"){
                    pushNotify("validation",1,"Sale theo % cần nhỏ hơn 100");
              }else{
                  pushNotify("error",1,"Có gĩ đó lỗi!");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['id']) {
                    pushNotify("error",1,"Có gĩ đó lỗi!");
                };
                if (jqXhr['responseJSON']['errors']['price_sale_check']) {
                    pushNotify("error",1,"Giá sale % nhập đúng định dạng!");
                };
                if (jqXhr['responseJSON']['errors']['price_sale']) {
                    pushNotify("error",1,"Giá sale nhập đúng định dạng!");
                };
            }
          });
      });
      $('#form-edit-store-product-to-non').on('submit',function (e) {
          e.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.product.store.non') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Đã cập nhật!");
                  $('#modalToNonStoreProduct').modal('toggle');
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
      $('#form-edit-store-product-to-has').on('submit',function (e) {
          e.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.product.store.has') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Đã cập nhật!");
                  $('#modalToHasStoreProduct').modal('toggle');
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

  });
</script>
<script type="text/javascript">
    $('#actions-action-active-action-button').on('click',function () {
        // console.log($('#actions-action-active-action-form').val());
        if ($('#actions-action-active-action-form').val()) {
            var action = $('#actions-action-active-action-form').val();
            if (action == 1) {
                $('#modalEditSaleProductToSaleSeries').modal('toggle');
            }else if(action == 2){
                $('#modalEditSaleProductUnSaleSeries').modal('toggle');
            }else if(action == 3){
                $('#modalToHasStoreProductSeries').modal('toggle');
            }else if(action == 4){
                $('#modalToNonStoreProductSeries').modal('toggle');
            }else{

            }
        }else{
            
        }
    });
    $('#form-edit-sale-product-to-sale-series').on('submit',function(e){
          e.preventDefault();
          for (var i = 0; i < $('.product-list-table-checked').length; i++) {
            var id_product = $($('.product-list-table-checked')[i]).attr('data-id');
            $('#id-edit-sale-product-to-sale-series').val(id_product);
            if (i == $('.product-list-table-checked').length - 1) {
                $.ajax({
                url:"{{ route('source.api.admin.product.sale.new') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  if (data.message == "success") {
                      pushNotify("success",1,"Đã cập nhật!");
                      $('#modalEditSaleProductToSaleSeries').modal('toggle');
                        console.log("done");
                      $('#redirect-link').click();
                  }else if(data.message == "error"){
                        pushNotify("error",1,"Có gĩ đó lỗi!");
                  }else if(data.message == "validator"){
                        pushNotify("validation",1,"Vui lòng nhập đầy đủ");
                  }else if(data.message == "validator-price"){
                        pushNotify("validation",1,"Giá sale cần là số và nhỏ hơn giá gốc");
                  }else if(data.message == "validator-price-sale"){
                        pushNotify("validation",1,"Số tiền sale cần là số và nhỏ hơn giá gốc");
                  }else if(data.message == "validator-price-check"){
                        pushNotify("validation",1,"Sale theo % cần nhỏ hơn 100");
                  }else{
                      pushNotify("error",1,"Có gĩ đó lỗi!");
                  }
                },
                error: function(jqXhr, json, errorThrown){
                    if (jqXhr['responseJSON']['errors']['id']) {
                        pushNotify("error",1,"Có gĩ đó lỗi!");
                    };
                    if (jqXhr['responseJSON']['errors']['price_sale_check']) {
                        pushNotify("error",1,"Giá sale % nhập đúng định dạng!");
                    };
                    if (jqXhr['responseJSON']['errors']['price_sale']) {
                        pushNotify("error",1,"Giá sale nhập đúng định dạng!");
                    };
                }
              });
            }else{
                $.ajax({
                url:"{{ route('source.api.admin.product.sale.new') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  if (data.message == "success") {
                      pushNotify("success",1,"Đã cập nhật!");
                      // $('#modalEditSaleProductToSale').modal('toggle');
                        
                      // $('#redirect-link').click();
                  }else if(data.message == "error"){
                        pushNotify("error",1,"Có gĩ đó lỗi!");
                  }else if(data.message == "validator"){
                        pushNotify("validation",1,"Vui lòng nhập đầy đủ");
                  }else if(data.message == "validator-price"){
                        pushNotify("validation",1,"Giá sale cần là số và nhỏ hơn giá gốc");
                  }else if(data.message == "validator-price-sale"){
                        pushNotify("validation",1,"Số tiền sale cần là số và nhỏ hơn giá gốc");
                  }else if(data.message == "validator-price-check"){
                        pushNotify("validation",1,"Sale theo % cần nhỏ hơn 100");
                  }else{
                      pushNotify("error",1,"Có gĩ đó lỗi!");
                  }
                },
                error: function(jqXhr, json, errorThrown){
                    if (jqXhr['responseJSON']['errors']['id']) {
                        pushNotify("error",1,"Có gĩ đó lỗi!");
                    };
                    if (jqXhr['responseJSON']['errors']['price_sale_check']) {
                        pushNotify("error",1,"Giá sale % nhập đúng định dạng!");
                    };
                    if (jqXhr['responseJSON']['errors']['price_sale']) {
                        pushNotify("error",1,"Giá sale nhập đúng định dạng!");
                    };
                }
              });
            }
          }
      });
    $('#form-edit-sale-product-un-sale-series').on('submit',function(e){
        $('#sale-product-button-series').val("sale");
          e.preventDefault();
          for (var i = 0; i < $('.product-list-table-checked').length; i++) {
            var id_product = $($('.product-list-table-checked')[i]).attr('data-id');
            $('#id-edit-sale-product-un-sale-series').val(id_product);
            if (i == $('.product-list-table-checked').length - 1) {
                $.ajax({
                url:"{{ route('source.api.admin.product.sale.un') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  if (data.message == "success") {
                      pushNotify("success",1,"Đã cập nhật!");
                      $('#modalEditSaleProductUnSaleSeries').modal('toggle');
                        console.log("done");
                      $('#redirect-link').click();
                  }else if(data.message == "error"){
                        pushNotify("error",1,"Có gĩ đó lỗi!");
                  }else if(data.message == "validator"){
                        pushNotify("validation",1,"Vui lòng nhập đầy đủ");
                  }else if(data.message == "validator-price"){
                        pushNotify("validation",1,"Giá sale cần là số và nhỏ hơn giá gốc");
                  }else if(data.message == "validator-price-sale"){
                        pushNotify("validation",1,"Số tiền sale cần là số và nhỏ hơn giá gốc");
                  }else if(data.message == "validator-price-check"){
                        pushNotify("validation",1,"Sale theo % cần nhỏ hơn 100");
                  }else{
                      pushNotify("error",1,"Có gĩ đó lỗi!");
                  }
                },
                error: function(jqXhr, json, errorThrown){
                    if (jqXhr['responseJSON']['errors']['id']) {
                        pushNotify("error",1,"Có gĩ đó lỗi!");
                    };
                    if (jqXhr['responseJSON']['errors']['price_sale_check']) {
                        pushNotify("error",1,"Giá sale % nhập đúng định dạng!");
                    };
                    if (jqXhr['responseJSON']['errors']['price_sale']) {
                        pushNotify("error",1,"Giá sale nhập đúng định dạng!");
                    };
                }
              });
            }else{
                $.ajax({
                url:"{{ route('source.api.admin.product.sale.un') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  if (data.message == "success") {
                      pushNotify("success",1,"Đã cập nhật!");
                  }else if(data.message == "error"){
                        pushNotify("error",1,"Có gĩ đó lỗi!");
                  }else if(data.message == "validator"){
                        pushNotify("validation",1,"Vui lòng nhập đầy đủ");
                  }else if(data.message == "validator-price"){
                        pushNotify("validation",1,"Giá sale cần là số và nhỏ hơn giá gốc");
                  }else if(data.message == "validator-price-sale"){
                        pushNotify("validation",1,"Số tiền sale cần là số và nhỏ hơn giá gốc");
                  }else if(data.message == "validator-price-check"){
                        pushNotify("validation",1,"Sale theo % cần nhỏ hơn 100");
                  }else{
                      pushNotify("error",1,"Có gĩ đó lỗi!");
                  }
                },
                error: function(jqXhr, json, errorThrown){
                    if (jqXhr['responseJSON']['errors']['id']) {
                        pushNotify("error",1,"Có gĩ đó lỗi!");
                    };
                    if (jqXhr['responseJSON']['errors']['price_sale_check']) {
                        pushNotify("error",1,"Giá sale % nhập đúng định dạng!");
                    };
                    if (jqXhr['responseJSON']['errors']['price_sale']) {
                        pushNotify("error",1,"Giá sale nhập đúng định dạng!");
                    };
                }
              });
            }
          }
      });

    $('#form-edit-store-product-to-has-series').on('submit',function(e){
          e.preventDefault();
          for (var i = 0; i < $('.product-list-table-checked').length; i++) {
            var id_product = $($('.product-list-table-checked')[i]).attr('data-id');
            $('#id-edit-store-product-to-has-series').val(id_product);
            if (i == $('.product-list-table-checked').length - 1) {
                $.ajax({
                url:"{{ route('source.api.admin.product.store.has') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  if (data.message == "success") {
                      pushNotify("success",1,"Đã cập nhật!");
                      $('#modalToHasStoreProductSeries').modal('toggle');
                        console.log("done");
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
            }else{
                $.ajax({
                url:"{{ route('source.api.admin.product.store.has') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  if (data.message == "success") {
                      pushNotify("success",1,"Đã cập nhật!");
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
            }
          }
      });
    $('#form-edit-store-product-to-non-series').on('submit',function(e){
          e.preventDefault();
          for (var i = 0; i < $('.product-list-table-checked').length; i++) {
            var id_product = $($('.product-list-table-checked')[i]).attr('data-id');
            $('#id-edit-store-product-to-non-series').val(id_product);
            if (i == $('.product-list-table-checked').length - 1) {
                console.log('1');
                $.ajax({
                url:"{{ route('source.api.admin.product.store.non') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  if (data.message == "success") {
                      pushNotify("success",1,"Đã cập nhật!");
                      $('#modalToNonStoreProductSeries').modal('toggle');
                      console.log("done");
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
            }else{
                console.log('1');
                $.ajax({
                url:"{{ route('source.api.admin.product.store.non') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                  if (data.message == "success") {
                      pushNotify("success",1,"Đã cập nhật!");
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
            }
          }
      });
    $('.delete-product').on('click',function (e) {
        var id = $(this).attr('data-id');
        $.ajax({
            url:"{{ route('source.api.admin.product.delete') }}",
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
