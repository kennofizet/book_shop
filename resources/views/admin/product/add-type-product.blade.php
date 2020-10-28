@extends('admin.layout.main')

@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Thêm thông tin phụ sản phẩm</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <form method="POST" id="form-add-new-product-type" action="" enctype="multipart/form-data">
                {{csrf_field()}}
                <label for="name">Tên</label>
                <input type="text" name="name" id="name">
                <label for="seri">Mã sản phẩm</label>
                <input type="text" name="seri" id="seri">
                <div style="margin-top: 10px">
                    <label for="description">Mô tả ngắn</label>
                    <textarea id="desc-detail-description-product-type" class="ckeditor"></textarea>
                </div>
                <label>Hình ảnh phụ của sản phẩm</label>
                <div id="uploadFile">
<div class="images-cropper-area">
    <div class="">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="image-cropper-wp">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="image-crop">
                                <img id="image-crop-gallery-post" src="{{url('/')}}/admin-default/img/cropper/1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="preview-img-pro-ad">
                                <div class="maincrop-img">
                                    <div class="image-crp-int">
                                        <!-- <h4>Preview image</h4> -->
                                        <div class="img-preview-custom" id="get-value-image-crop-gallery-post" style=""></div>
                                        <input type="text" id="get-value-name-image-crop-gallery-post" style="display: none;">
                                    </div>
                                    <div class="image-crp-img">
                                        <div class="btn-group images-cropper-pro" style="float: left;width: 100%;display: block;">
                                            <label style="float: left;width: 40%;" title="Upload image file" for="inputImage" class="btn btn-primary img-cropper-cp">
                                               Tải lên
                                                </label>
                                            <label style="float: left;width: 40%;margin-left: 10px;" title="Dowload image" id="save-file-crop-type-product" class="btn btn-primary">Lưu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="cp-img-anal" style="margin-top: 20px;">
                                    
                                    <div class="btn-group images-action-pro">
                                        <button class="btn btn-white" id="zoomIn" type="button">Phóng to</button>
                                        <button class="btn btn-white" id="zoomOut" type="button">Thu nhỏ</button>
                                        <button class="btn btn-white" id="rotateLeft" type="button">Xoay trái</button>
                                        <button class="btn btn-white" id="rotateRight" type="button">Xoay phải</button>
                                        <button class="btn btn-warning img-cropper-cp-t" id="setDrag" type="button">Reset</button>
                                        <button class="btn btn-warning img-cropper-cp-t" id="set_x_y" type="button" style="display: none;">set x y</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>
                <input type="text" name="image_title" id="file-image-title-gallery-post" style="display: none;">
                <input type="text" name="style_file" id="styleImage" style="display: none;">
               <input type="text" name="style_file_x" id="styleImageX" style="display: none;">
               <input type="text" name="style_file_y" id="styleImageY" style="display: none;">
               <input type="text" name="style_file_w" id="styleImageW" style="display: none;">
               <input type="text" name="style_file_h" id="styleImageH" style="display: none;">
               <input type="text" name="description" id="description_input_product_add" style="display: none;">
              <input type="file" accept="image/*" name="file" id="inputImage" class="hide" required="true">

                <button type="button" class="btn btn-success" style="float: right;" name="btn-submit" id="btn-submit">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
<a href="{{route('admin.product.type.list')}}" id="redirect-link" style="display: none;"></a>
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
    "{{url('/')}}/admin-default/js/cropper/cropper.min.js",
    "{{url('/')}}/admin-default/fix/pages/iloveyou/blog/crop-image-product.js",
  ]).done(function() {
    console.log("All scripts loaded1s");

  });

    // queue #2 - jquery cycle2 plugin and tile effect plugin
    var d2 = loadScripts([
        "//cdn.ckeditor.com/4.6.1/basic/ckeditor.js"
    ]).done(function() {
        console.log("All scripts loaded2");
        let configuration = {
          toolbar: "Basic",
        };
        if(document.getElementsByTagName('textarea').length > 0){
            CKEDITOR.replace("desc-detail-description-product-type");
       }
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
      console.log("All scripts loaded");
    });
    body_script("{{url('/')}}/admin/js/main.js");
</script>
<script type="text/javascript">
    $('#save-file-crop-type-product').on('click',function () {
        $('#set_x_y').click();
        pushNotify("success",1,"Đã áp dụng ảnh");
    });
    $('#btn-submit').on('click',function () {
        // console.log($('#desc-title-content-blog').val());
        valueTextArea = CKEDITOR.instances['desc-detail-description-product-type'].getData();
        // console.log(valueTextArea);
        // console.log(valueTextArea1);
        $('#description_input_product_add').val(valueTextArea);
        $('#form-add-new-product-type').submit();
    });
</script>
<script type="text/javascript">
    jQuery(function($) {
      $('#form-add-new-product-type').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.product.type.create') }}",
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
              }else if(data.message == "file_error"){
                  pushNotify("error",1,"Ảnh định dạng không phù hợp, hoặc quá nhỏ");
              }else if(data.message == "code_fail"){
                  pushNotify("error",1,"Mã sản phẩm không trùng khớp");
              }
              else{
                  pushNotify("validation",1,"Vui lòng nhập đầy đủ");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['name']) {
                    var data_mess = "Bạn quên đặt tên !";
                    pushNotify("validation",1,data_mess);
                };
                

                if (jqXhr['responseJSON']['errors']['description']) {
                    var data_mess = "Bạn quên miểu tả ngắn gọn !";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['file']) {
                    var data_mess = "Bạn cần chọn một ảnh tải và cắt ảnh!";
                    pushNotify("validation",1,data_mess);
                };
                if (jqXhr['responseJSON']['errors']['seri']) {
                    var data_mess = "Bạn cần nhập một mã sản phẩm !";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['image_title'] || jqXhr['responseJSON']['errors']['style_file_x'] || jqXhr['responseJSON']['errors']['style_file_y'] || jqXhr['responseJSON']['errors']['style_file_w'] || jqXhr['responseJSON']['errors']['style_file_h']) {
                    var data_mess = "Bạn chưa cắt ảnh  !";
                    pushNotify("validation",1,data_mess);
                };
            }
          });
      });
  });
</script>
@endsection
