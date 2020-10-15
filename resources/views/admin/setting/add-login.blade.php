@extends('admin.layout.main')

@section('content')

<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <form id="form-setting-login-add-1" accept="" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <label for="product-name">Tên</label>
                <input type="text" name="name" id="product-name">
                <div style="margin-top: 10px;width: 100%;display: block;">
                    <label for="desc" style="">Mô tả ngắn</label>
                    <textarea name="title" id="desc" class="ckeditor"></textarea>
                </div>
                <label>Nền</label>
                <div id="uploadFile">
                    <input type="file" name="file" id="file-img-load-preview-setting-login-add-1">
                    <img id="img-load-preview-setting-login-add-1" style="display: none;" src="{{url('/')}}/admin/images/img-thumb.png">
                </div>
                <label>Trạng thái</label>
                <select name="status">
                    <option>-- Chọn danh mục --</option>
                    <option value="1">Sử dụng</option>
                    <option value="0">Hàng chờ</option>
                </select>
                <button class="btn btn-success" style="float: right;">Hoàn Thành</button>
            </form>
            
            <iframe id="iframe-load-preview-setting-login-add-1" style="width: 100%;height: 600px;overflow: hidden;display: none; margin-top: 10px" src="{{route('admin.preview.setting.add-login')}}">
                
            </iframe>
        </div>
    </div>
</div>
<a id="redirect-link" style="display: none;" href="{{route('admin.setting.template.login')}}"></a>
<!-- <button type="button" id="test">aaa</button> -->
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
    function readURFileImgLoadPreviewSettingLoginAdd1(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            console.log(e.target.result);
          $($('#iframe-load-preview-setting-login-add-1').contents().find(".main")[0]).css('background', "url('"+e.target.result+"') no-repeat center");
          $('#iframe-load-preview-setting-login-add-1').css('display','block');
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
  

    $("#file-img-load-preview-setting-login-add-1").change(function() {
        console.log("change");
      readURFileImgLoadPreviewSettingLoginAdd1(this);
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
    console.log("All scripts loaded1");

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
            // CKEDITOR.replace("desc-detail", configuration);
            CKEDITOR.replace("desc", configuration); 
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
      $('#form-setting-login-add-1').on('submit',function(){
          event.preventDefault();
          $.ajax({
            url:"{{ route('source.api.admin.setting.template.add-login') }}",
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
              }else{
                  pushNotify("validation",1,"Vui lòng nhập đầy đủ");
              }
            },
            error:function(jqXHR, textStatus, errorThrown) {
                pushNotify("validation",1,"Vui lòng nhập đầy đủ");
            }
          });
      });
  });
</script>
<!-- <script type="text/javascript">
    $('#test').on('click',function () {
        pushNotify("success",1,"Tạo Thành Công");
    });
</script> -->
@endsection
