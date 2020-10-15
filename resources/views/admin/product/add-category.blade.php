@extends('admin.layout.main')
@section('style')
<style type="text/css">
    .img-preview img{
        width: 200px!important;
        height: 150px!important;
        background-color: #3e3e3e;
        background-image: none;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }
</style>
@endsection
@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Thêm mới Danh mục sản phẩm</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <form method="POST" id="form-add-new-product-category" action="{{ route('source.api.admin.product.category.create') }}">
                {{csrf_field()}}
                <label for="title">Tên</label>
                <input type="text" name="title" id="title" style="width: 100%">

                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-6">
                        <div>
                            <label for="desc-title-content-blog">Danh mục cha (<em>Nếu không chọn sẽ là danh mục chính/Lưu ý nhầm lẫn danh mục con và cha</em>)</label>
                            <div style="margin-top: 20px">
                                <select name="parent">
                                    @if($list_category->count() > 0)
                                        <option value="">-- Chọn trạng thái --</option>
                                        @foreach($list_category as $detail_category)
                                            <option value="{{$detail_category->id}}">{{$detail_category->title}}</option>
                                        @endforeach
                                    @else
                                        <option value="">Bạn chưa có danh mục nào</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Trạng thái</label>
                        <select name="status" >
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                </div>
                <p style="float: right;" class="btn btn-success" type="submit" name="btn-submit" id="btn-submit">Thêm mới</p>
                 
            </form>
        </div>
    </div>
</div>
<a style="display: none;" id="redirect-link" href="{{route('admin.product.category')}}"></a>
@endsection
@section('script')
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
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
    console.log("All scripts loaded1s");

  });

    // queue #2 - jquery cycle2 plugin and tile effect plugin
    var d2 = loadScripts([
    ]).done(function() {
        console.log("All scripts loaded2");
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
      console.log("All scripts loaded");
    });
    body_script("{{url('/')}}/admin/js/main.js");
</script>
<script type="text/javascript">
    jQuery(function($) {
      $('#form-add-new-product-category').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.product.category.create') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Tạo Thành Công");
                  $('#redirect-link').click();
              }else{
                  pushNotify("validation",1,"Vui lòng nhập đầy đủ");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['title']) {
                    var data_mess = "Bạn cần nhập tên cho danh mục !";
                    pushNotify("validation",1,data_mess);
                };
                if (jqXhr['responseJSON']['errors']['status']) {
                    var data_mess = "Bạn cần chọn trạng thái !";
                    pushNotify("validation",1,data_mess);
                };
            }
          });
      });
  });
</script>
<script type="text/javascript">
    $('#btn-submit').on('click',function () {
        $('#form-add-new-product-category').submit();
    });
</script>
@endsection
