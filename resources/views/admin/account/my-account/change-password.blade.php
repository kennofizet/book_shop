@extends('admin.layout.main')
@section('style')
@endsection
@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <!-- <h3 id="index" class="fl-left">Thêm mới tài khoản (người dùng/just for test - skip confirmation mail)</h3> -->
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div id="main-content-wp" class="change-pass-page">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <!-- <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a> -->
                        <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
                    </div>
                </div>
                <div class="wrap clearfix">
                    <div id="sidebar" class="fl-left">
                        <ul id="list-cat">
                            <li>
                                <a href="{{route('admin.my-account.info')}}" title="">Cập nhật thông tin</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}" title="">Thoát</a>
                            </li>
                        </ul>
                    </div>
                    <div id="content" class="fl-right">                       
                        <div class="section" id="detail-page">
                            <div class="section-detail">
                                <form method="POST" id="form-setting-my-account-change-password">
                                  {{csrf_field()}}
                                    <label for="old-pass">Mật khẩu cũ</label>
                                    <input type="password" name="current_password" id="pass-old">
                                    <label for="new_password">Mật khẩu mới</label>
                                    <input type="password" name="new_password" id="new_password">
                                    <label for="new_password_confirmation">Xác nhận mật khẩu</label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation">
                                    <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a style="display: none;" id="redirect-link" href="{{route('admin.my-account.info')}}"></a>
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
    $('#form-setting-my-account-change-password').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
        url:"{{ route('source.api.admin.account.my-account.change-password') }}",
        method:"POST",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
          if (data.message == "success") {
              pushNotify("success",1,"Đã cập nhật!");
              $('#redirect-link').click();   
          }else{
              pushNotify("error",1,"Có gĩ đó lỗi!");
          }
        },
        error: function(jqXhr, json, errorThrown){
              if (jqXhr['responseJSON']['errors']['current_password']) {
                  pushNotify("error",1,"Mật khẩu không chính xác!");
              };
              if (jqXhr['responseJSON']['errors']['new_password']) {
                  pushNotify("error",1,"Mật khẩu mới không trùng khớp với nhau!");
              };
        }
      });
    });
</script>
@endsection
