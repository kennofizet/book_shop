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
            <div id="main-content-wp" class="info-account-page">
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
                                <a href="{{route('admin.my-account.change-password')}}" title="">Đổi mật khẩu</a>
                            </li>
                            <li>
                                <a href="{{route('home')}}" title="">Thoát</a>
                            </li>
                        </ul>
                    </div>
                    <div id="content" class="fl-right">                       
                        <div class="section" id="detail-page">
                            <div class="section-detail">
                                <form method="POST" id="form-setting-my-account">
                                    {{csrf_field()}}
                                    <label for="display-name">Tên hiển thị</label>
                                    <input type="text" name="name" id="display-name" value="{{Auth::user()->name}}">
                                    <label for="email">Email</label>
                                    <input type="email" placeholder="{{Auth::user()->email}}" readonly="readonly">
                                    <label for="tel">Số điện thoại</label>
                                    <input type="tel" name="phone" id="tel" value="{{Auth::user()->phone}}">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" name="address" id="address" value="{{Auth::user()->address}}">
                                    <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                                    <label for="slug">Slug</label>
                                    <input type="text" placeholder="{{Auth::user()->link}}" readonly="readonly">
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
    $('#form-setting-my-account').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
        url:"{{ route('source.api.admin.account.my-account.update') }}",
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
            pushNotify("error",1,"Có gĩ đó lỗi!");
        }
      });
    });
</script>
@endsection
