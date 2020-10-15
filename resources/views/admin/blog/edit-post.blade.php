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
            <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <form method="POST" id="form-edit-post-blog" action="" enctype="multipart/form-data">
                {{csrf_field()}}
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{$detail_post->title}}" style="width: 100%">

                <div style="margin-top: 20px">
                    <label for="desc-title-content-blog">Nội dung tóm tắt s</label>
                    <div style="margin-top: 20px">
                        <textarea id="desc-title-content-blog" class="ckeditor" style="margin-top: 20px">{!! $detail_post->title_content !!}</textarea>
                    </div>
                </div>
                
                <div style="margin-top: 20px">
                    <label for="desc-detail-content-blog">Nội dung</label>
                    <textarea id="desc-detail-content-blog" class="ckeditor" style="margin-top: 20px">{!! $detail_post->content !!}</textarea>
                </div>
                <label>Hình ảnh (<em>Nếu bạn không lưu, hình ảnh cũ sẽ được sử dụng</em>)</label>
                <div id="uploadFile">
                    <!-- <input type="file" name="file" id="upload-thumb"> -->
    <div class="images-cropper-area">
        <div class="">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="image-cropper-wp">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="image-crop">
                                    <img id="image-crop-gallery-post" src="{{url('/')}}/upload/source/api/blog/images/{{$detail_post->file}}" alt="">
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
                                    <div>
                                        <label>Ảnh cắt cũ</label>
                                        <span class="tbody-text"><img src="{{url('/')}}/upload/source/api/blog/thumbnail/{{$detail_post->file}}"></span>
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
                <label>Trạng thái</label>
                <select name="status">
                    <option value="">-- Chọn trạng thái --</option>
                    <option value="1" @if($detail_post->status == 1) selected @else @endif>Hiện</option>
                    <option value="0" @if($detail_post->status == 0) selected @else @endif>Ẩn</option>
                </select>
                <input type="text" name="image_title" id="file-image-title-gallery-post" style="display: none;">
                <input type="text" name="id" value="{{$detail_post->id}}" style="display: none;">
                <input type="text" name="style_file" id="styleImage" style="display: none;">
               <input type="text" name="style_file_x" id="styleImageX" style="display: none;">
               <input type="text" name="style_file_y" id="styleImageY" style="display: none;">
               <input type="text" name="style_file_w" id="styleImageW" style="display: none;">
               <input type="text" name="style_file_h" id="styleImageH" style="display: none;">
               <input type="text" name="title_content" id="title_content_input_blog_add_post" style="display: none;">
               <input type="text" name="content" id="content_input_blog_add_post" style="display: none;">
              <input type="file" accept="image/*" name="file" id="inputImage" class="hide" required="true">

                <p style="float: right;" class="btn btn-success" type="submit" name="btn-submit" id="btn-submit">Lưu</p>
                 
            </form>
        </div>
    </div>
</div>
<a style="display: none;" id="redirect-link" href="{{route('admin.blog.list')}}"></a>
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
    "{{url('/')}}/admin-default/fix/pages/iloveyou/blog/crop-image-post.js",
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
            CKEDITOR.replace("desc-detail-content-blog");
            CKEDITOR.replace("desc-title-content-blog"); 
       }
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
      console.log("All scripts loaded");
    });
    body_script("{{url('/')}}/admin/js/main.js");
</script>
<script type="text/javascript">
    jQuery(function($) {
      $('#form-edit-post-blog').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.blog.edit-post') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Sửa Thành Công");
                  $('#redirect-link').click();
              }else if(data.message == "file_error"){
                  pushNotify("error",1,"Ảnh định dạng không phù hợp, hoặc quá nhỏ");
              }else{
                  pushNotify("validation",1,"Vui lòng nhập đầy đủ");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['title']) {
                    console.log("title");
                    $('#form_blog_post').find( "#blog_post_input_title" ).css( "border-color", "red" );
                    $('#New_Post_nav_blog_new_post_style_mess').css('color','red');
                    var data_mess = "Bạn cần nhập tiêu đề cho bài viết !";
                    pushNotify("validation",1,data_mess);
                };
                

                if (jqXhr['responseJSON']['errors']['status']) {
                    $('#click_toggle_star_value_blog_new_post').css('background-color','red');
                    $('#New_Post_nav_blog_new_post_style_mess').css('color','red');
                    var data_mess = "Bạn cần chọn trạng thái !";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['content']) {
                    $('#content_blog_new_post_style_mess').css('color','red');
                    $('#New_Post_nav_blog_new_post_style_mess').css('color','red');
                    var data_mess = "Bạn quên nhập nội dung cho bài biết !";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['title_content']) {
                    $('#title_content_blog_new_post_style_mess').css('color','red');
                    $('#New_Post_nav_blog_new_post_style_mess').css('color','red');
                    var data_mess = "Bạn quên nhập nội dung tóm tắt cho bài biết !";
                    pushNotify("validation",1,data_mess);
                };

                if (jqXhr['responseJSON']['errors']['file']) {
                    $('#Gallery_nav_blog_new_post_style_mess').css('color','red');
                    var data_mess = "Bạn cần chọn một ảnh tải và cắt ảnh!";
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
<!-- <script type="text/javascript" src="http://book_shop.com/admin-default/js/cropper/cropper.min.js"></script> -->
<!-- <script type="text/javascript" src="http://book_shop.com/admin-default/fix/pages/iloveyou/blog/crop-image-post.js"></script> -->
<script type="text/javascript">
    $('#save-file-crop-gallery-post').on('click',function () {
        $('#set_x_y').click();
    });
    $('#btn-submit').on('click',function () {
        valueTextArea = CKEDITOR.instances['desc-detail-content-blog'].getData();
        valueTextArea1 = CKEDITOR.instances['desc-title-content-blog'].getData();
        $('#content_input_blog_add_post').val(valueTextArea);
        $('#title_content_input_blog_add_post').val(valueTextArea1);
        $('#form-edit-post-blog').submit();
    });
</script>
@endsection
