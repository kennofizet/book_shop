@extends('admin.layout.main')

@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Sửa sản phẩm</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <form method="POST" id="form-edit-post-product" action="" enctype="multipart/form-data">
                {{csrf_field()}}
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" id="name" value="{{$product_detail->name}}">
                <label for="price">Giá sản phẩm</label>
                <input type="text" name="price" id="price" value="{{$product_detail->price}}">
                <div style="margin-top: 10px">
                    <label for="description">Mô tả ngắn</label>
                    <textarea id="desc-detail-description-product" class="ckeditor">{!! $product_detail->description !!}</textarea>
                </div>
                <label for="content">Chi tiết</label>
                <textarea id="desc-detail-content-product" class="ckeditor">{!! $product_detail->content !!}</textarea>
                <label>Hình ảnh chính</label>
                <div id="uploadFile">
<div class="images-cropper-area">
    <div class="">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="image-cropper-wp">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="image-crop">
                                <img id="image-crop-gallery-post" src="{{url('/')}}/upload/source/api/product/images/{{$product_detail->image}}" alt="">
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
                                            <label style="float: left;width: 40%;margin-left: 10px;" title="Dowload image" id="save-file-crop-gallery-post" class="btn btn-primary">Lưu</label>
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
                <div style="margin-top: 10px">
                    <label>Danh mục sản phẩm</label>
                    <select name="parent">
                        @if($list_category->count() > 0)
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($list_category as $detail_category)
                                <option value="{{$detail_category->id}}" @if($detail_category->id == $product_detail->parent) selected @endif>{{$detail_category->title}}</option>
                                @if($detail_category->Child->first())
                                    @foreach($detail_category->Child as $category_child_1)
                                        <option value="{{$category_child_1->id}}" @if($category_child_1->id == $product_detail->parent) selected @endif>- {{$category_child_1->title}}</option>
                                        @if($category_child_1->Child->first())
                                            @foreach($category_child_1->Child as $category_child_2)
                                                <option value="{{$category_child_2->id}}" @if($category_child_2->id == $product_detail->parent) selected @endif>- - {{$category_child_2->title}}</option>
                                                @if($category_child_2->Child->first())
                                                    @foreach($category_child_2->Child as $category_child_3)
                                                        <option value="{{$category_child_3->id}}" @if($category_child_3->id == $product_detail->parent) selected @endif>- - - {{$category_child_3->title}}</option>
                                                        @if($category_child_3->Child->first())
                                                            @foreach($category_child_3->Child as $category_child_4)
                                                                <option value="{{$category_child_4->id}}" @if($category_child_4->id == $product_detail->parent) selected @endif>- - - - {{$category_child_4->title}}</option>
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
                <input type="text" name="image_title" id="file-image-title-gallery-post" style="display: none;">
                <input type="text" name="style_file" id="styleImage" style="display: none;">
               <input type="text" name="style_file_x" id="styleImageX" style="display: none;">
               <input type="text" name="style_file_y" id="styleImageY" style="display: none;">
               <input type="text" name="style_file_w" id="styleImageW" style="display: none;">
               <input type="text" name="style_file_h" id="styleImageH" style="display: none;">
               <input type="text" name="description" id="description_input_product_add" style="display: none;">
               <input type="text" name="content" id="content_input_product_add" style="display: none;">
               <input type="text" name="id" value="{{$product_detail->id}}" style="display: none;">
              <input type="file" accept="image/*" name="file" id="inputImage" class="hide" required="true">

                <button type="button" class="btn btn-success" style="float: right;" name="btn-submit" id="btn-submit">Lưu</button>
            </form>
        </div>
    </div>
</div>
<a href="{{route('admin.product.list')}}" id="redirect-link" style="display: none;"></a>
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
            CKEDITOR.replace("desc-detail-description-product");
            CKEDITOR.replace("desc-detail-content-product"); 
       }
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
      console.log("All scripts loaded");
    });
    body_script("{{url('/')}}/admin/js/main.js");
</script>
<script type="text/javascript">
    $('#save-file-crop-gallery-post').on('click',function () {
        $('#set_x_y').click();
        pushNotify("success",1,"Đã áp dụng ảnh");
    });
    $('#btn-submit').on('click',function () {
        // console.log($('#desc-title-content-blog').val());
        valueTextArea = CKEDITOR.instances['desc-detail-description-product'].getData();
        valueTextArea1 = CKEDITOR.instances['desc-detail-content-product'].getData();
        // console.log(valueTextArea);
        // console.log(valueTextArea1);
        $('#description_input_product_add').val(valueTextArea);
        $('#content_input_product_add').val(valueTextArea1);
        $('#form-edit-post-product').submit();
    });
</script>
<script type="text/javascript">
    jQuery(function($) {
      $('#form-edit-post-product').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.product.edit') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Cập nhật Thành Công");
                  $('#redirect-link').click();
              }else if(data.message == "file_error"){
                  pushNotify("error",1,"Ảnh định dạng không phù hợp, hoặc quá nhỏ");
              }else{
                  pushNotify("validation",1,"Vui lòng nhập đầy đủ");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['name']) {
                    var data_mess = "Bạn tên cho sản phẩm !";
                    pushNotify("validation",1,data_mess);
                };
                

                if (jqXhr['responseJSON']['errors']['price']) {
                    var data_mess = "Bạn cần nhập giá cho sản phẩm !";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['description']) {
                    var data_mess = "Bạn quên miểu tả ngắn gọn !";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['content']) {
                    var data_mess = "Bạn quên nhập nội dung cho sản phẩm !";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['file']) {
                    var data_mess = "Bạn cần chọn một ảnh tải và cắt ảnh!";
                    pushNotify("validation",1,data_mess);
                };
                if (jqXhr['responseJSON']['errors']['parent']) {
                    var data_mess = "Bạn cần chọn một danh mục cha!";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['image_title'] || jqXhr['responseJSON']['errors']['style_file_x'] || jqXhr['responseJSON']['errors']['style_file_y'] || jqXhr['responseJSON']['errors']['style_file_w'] || jqXhr['responseJSON']['errors']['style_file_h']) {
                    $('#Gallery_nav_blog_new_post_style_mess').css('color','red');
                    var data_mess = "Bạn chưa cắt ảnh  !";
                    pushNotify("validation",1,data_mess);
                };
            }
          });
      });
  });
</script>
@endsection
