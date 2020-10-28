@extends('admin.layout.main')

@section('content')

 <div id="content" class="fl-right">           
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách các chi tiết của sản phẩm</h3>
            <a href="{{route('admin.product.type.create')}}" title="" id="add-new" class="fl-left">Thêm mới</a>
        </div>
    </div>            
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="{{route('admin.product.type.list')}}">Tất cả <span class="count">({{$list_type->count()}})</span></a> |</li>
                </ul>
                <form method="POST" action="{{ route('admin.product.type.search') }}" id="form-add-search-product-type" class="form-s fl-right">
                {{csrf_field()}}
                    <input type="text" name="key" id="key_search">
                </form>
            </div>
            <div class="actions">
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
            </div>
            <table class="table list-table-wp">
                <thead>
                    <tr>
                        <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                        <td><span class="thead-text">STT</span></td>
                        <td><span class="thead-text">Tên</span></td>
                        <td><span class="thead-text">Miêu tả</span></td>
                        <td><span class="thead-text">Ảnh</span></td>
                        <td><span class="thead-text">Sản Phẩm</span></td>
                    </tr>
                </thead>
                <tbody id="body-search-append">
                    @foreach($list_type as $detail_type)
                    <tr>
                        <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
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
                </tbody>
                <tfoot>
                    <tr>
                        <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                        <td><span class="thead-text">STT</span></td>
                        <td><span class="thead-text">Tên</span></td>
                        <td><span class="thead-text">Miêu tả</span></td>
                        <td><span class="thead-text">Ảnh</span></td>
                        <td><span class="thead-text">Sản Phẩm</span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="section" id="paging-wp">
        <div class="section-detail clearfix">
            <ul id="list-paging" class="fl-right">
                <{{$list_type->links()}}
            </ul>
        </div>
    </div>
</div>
<a href="{{route('admin.product.type.list')}}" id="redirect-link"></a>
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
    jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ){
            this.addEventListener("touchstart", handle, { passive: true });
        }
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
    $('#actions-action-active-number-form').on('change', function() {
      $.ajax({
          url:"{{ route('source.api.admin.product.type.setting-count-data-page-product-type') }}",
          method:"POST",
          data:{number:this.value},
          success:function(data){
            console.log(data);
            if (data.message == "error") {
                pushNotify("validation",1,"Số lượng không họp lệ");
            }else if(data.message == "success"){
                pushNotify("success",1,"Đã thay đổi");
                $('#redirect-link').click();
            }else{
                pushNotify("error",1,"Có gĩ đó lỗi!");
            }
          },
          error:function(jqXHR, textStatus, errorThrown) {
              pushNotify("error",1,"Có gĩ đó lỗi!");
          }
        });
    });
    $('.button-delete-product-type').on('click',function () {
        $('#form-delete-product-type-'+$(this).attr('data-id')).submit();
    });
    $('.form-delete-product-type').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            url:"{{ route('source.api.admin.product.type.delete') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Đã xóa");
                  $('#redirect-link').click();
              }else{
                  pushNotify("error",1,"Sản phẩm này không tồn tại");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['id']) {
                    pushNotify("error",1,"Sản phẩm này không tồn tại");
                };
            }
          });
    });
    
</script>
<script type="text/javascript">
    $('#key_search').on('keyup', function() {
        $('#form-add-search-product-type').submit();
    });
    
    $('#form-add-search-product-type').on('submit', function(e) {
        var key = $('#key_search').val();
        // console.log(key);
        e.preventDefault();
        $.ajax({
          url:"{{ route('admin.product.type.search') }}",
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
@endsection
