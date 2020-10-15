@extends('admin.layout.main')

@section('content')

<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách cài đặt trang login</h3>
            <a href="{{route('admin.setting.template.add-login')}}" title="" id="add-new" class="fl-left">Thêm mới</a>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="{{route('admin.setting.template.login')}}">Tất cả <span class="count">({{$count_all}})</span></a> |</li>
                    <li class="publish"><a href="{{route('admin.setting.template.login-active')}}">Đang sử dụng <span class="count">({{$count_active}})</span></a> |</li>
                    <li class="pending"><a href="{{route('admin.setting.template.login-un-active')}}">Chưa sử dụng<span class="count">({{$count_unactive}})</span> |</a></li>
                </ul>
                <!-- <form method="GET" class="form-s fl-right">
                    <input type="text" name="s" id="s">
                    <input type="submit" name="sm_s" value="Tìm kiếm">
                </form> -->
            </div>
            <div class="actions">
                    <select name="actions" id="actions-action-active-form">
                        <option value="0">Tác vụ</option>
                        <option value="1">Sử dụng</option>
                        <option value="2">Xóa</option>
                    </select>
                    <input id="submit-action-active-form" type="submit" name="sm_action" value="Áp dụng">
            </div>
            <div class="actions">
                    <select name="actions-number" id="actions-action-active-number-form">
                        <option value="default">Số lượng hiển thị/Trang</option>
                        <option value="1">1</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="all">All</option>
                    </select>
                    <input id="submit-action-active-form" type="submit" name="sm_action" value="Áp dụng">
            </div>
            <div class="table-responsive">
                <table class="table list-table-wp">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Tên</span></td>
                            <td><span class="thead-text">Hình ảnh</span></td>
                            <td><span class="thead-text">Người tạo</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_setting_login as $detail_list_setting_login_page)
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem" id="{{$detail_list_setting_login_page->id}}"></td>
                            <td><span class="tbody-text">{{$loop->index}}</h3></span>
                            <td><span class="tbody-text">{{ $detail_list_setting_login_page->name }}</h3></span>
                            <td>
                                <span class="tbody-text">
                                    <div class="tbody-thumb" style="text-align: center;">
                                        <img style="text-align: center;" src="{{url('/')}}/upload/source/api/setting/page-login/thumbnail/{{$detail_list_setting_login_page->file}}" alt="{{$detail_list_setting_login_page->title}}">
                                    </div>
                                </span>
                            </td>
                            <td><span class="tbody-text">Admin</span></td>
                            <td><span class="tbody-text">{{$detail_list_setting_login_page->created_at}}</span></td>
                            @if($detail_list_setting_login_page->status == 1)
                                <td><span class="tbody-text">Bật</span></td>
                            @else
                                <td><span class="tbody-text">Tắt</span></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Tên</span></td>
                            <td><span class="thead-text">Hình ảnh</span></td>
                            <td><span class="thead-text">Người tạo</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
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
                {{$list_setting_login->links()}}
            </ul>
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
            $('.list-table-wp tbody tr td input[type="checkbox"]').addClass("setting-login-table-checked");
        });
        $('input[name="checkItem"]').click(function () {
            $(this).toggleClass("setting-login-table-checked");
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
jQuery(function($) {
    $('#submit-action-active-form').on('click',function (e) {
        var actions = $('#actions-action-active-form').val();
        e.preventDefault();
        for (var i = 0; i < $('.setting-login-table-checked').length; i++) {
            var id_setting = $($('.setting-login-table-checked')[i]).attr('id');
            $.ajax({
              url:"{{ route('source.api.admin.setting.template.edit-login') }}",
              method:"POST",
              data:{id:id_setting,status_relax:actions},
              success:function(data){
                console.log(data);
                if (data.message == "status_relax") {
                    pushNotify("validation",1,"Vui lòng chọn hành động");
                    $('#redirect-link').click();
                }else if(data.message == "update_success"){
                    pushNotify("success",1,"Cập nhật");
                    $('#redirect-link').click();
                }else if(data.message == "delete_success"){
                    $('#redirect-link').click();
                    pushNotify("success",1,"Đã xóa");
                }else if(data.message == "validation"){
                    pushNotify("validation",1,"Vui lòng nhập đầy đủ");
                }else{
                    pushNotify("error",1,"Có gĩ đó lỗi!");
                }
              },
              error:function(jqXHR, textStatus, errorThrown) {
                  pushNotify("validation",1,"Vui lòng nhập đầy đủ");
              }
            });
        }
    });
});    
</script>
<script type="text/javascript">
$('#actions-action-active-number-form').on('change', function() {
    console.log(this.value);
  $.ajax({
      url:"{{ route('source.api.admin.setting.template.setting-count-data-page-login') }}",
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
@endsection
