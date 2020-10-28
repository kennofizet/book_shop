@extends('admin.layout.main')

@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách tài khoản</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="{{route('admin.account.list')}}">Tất cả <span class="count">({{$count_all_account}})</span></a> |</li>
                    <li class="publish"><a href="{{route('admin.account.list-active')}}">Đã khích hoạt <span class="count">({{$count_active_account}})</span></a> |</li>
                    <li class="publish"><a href="{{route('admin.account.list-wait')}}">Chưa kích hoạt <span class="count">({{$count_wait_account}})</span></a> |</li>
                </ul>
                <form method="POST" action="{{ route('admin.account.search') }}" id="form-add-search-account-list" class="form-s fl-right">
                {{csrf_field()}}
                    <input type="text" name="key" id="key_search">
                    <input type="submit" name="sm_s" value="Tìm kiếm">
                </form>
            </div>
           
            <div class="table-responsive">
                <table class="table list-table-wp">
                    <thead>
                        <tr>
                            <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Email</span></td>
                            <td><span class="thead-text">Họ và tên / Xóa và khóa tài khoản</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">SĐT</span></td>
                            <td><span class="thead-text">Địa chỉ</span></td>
                            <td><span class="thead-text">Slug</span></td>
                            <td><span class="thead-text">Thời gian tạo</span></td>
                        </tr>
                    </thead>
                    <tbody id="body-search-append">
                        @foreach($list_account as $detail_account)
                        <tr>
                            <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                            <td><span class="tbody-text">{{$loop->index + 1}}</h3></span>
                            <td><span class="tbody-text">{{$detail_account->email}}</h3></span>
                            <td>
                                <div class="tb-title fl-left">
                                    <a href="#">{{$detail_account->name}}</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><span style="display: block;padding: 0px 5px;" title="Xóa" class="delete delete-account" data-id="{{$detail_account->id}}"><i class="fa fa-trash" aria-hidden="true"></i></span></li>
                                    @if($detail_account->lock_check == 1) 
                                    <li><span style="display: block;padding: 0px 5px;" title="Khóa" class="lock unlock-account" data-id="{{$detail_account->id}}"><i class="fa fa-unlock"></i></span></li>
                                    @else 
                                    <li><span style="display: block;padding: 0px 5px;" title="Khóa" class="lock lock-account" data-id="{{$detail_account->id}}"><i class="fa fa-lock"></i></span></li>
                                    @endif
                                </ul>
                            </td>
                            <td><span class="tbody-text">@if($detail_account->parent_verifi_email == 1) Đã xác thực @else Chưa xác thực @endif / @if($detail_account->lock_check == 1) Khóa @else Mở @endif</span></td>
                            <td><span class="tbody-text">{{$detail_account->phone}}</span></td>
                            <td><span class="tbody-text">{{$detail_account->address}}</span></td>
                            <td><span class="tbody-text">{{$detail_account->link}}</span></td>
                            <td><span class="tbody-text">{{$detail_account->created_at}}</span></td>
                            @endforeach
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Email</span></td>
                            <td><span class="thead-text">Họ và tên</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">SĐT</span></td>
                            <td><span class="thead-text">Địa chỉ</span></td>
                            <td><span class="thead-text">Slug</span></td>
                            <td><span class="thead-text">Thời gian tạo</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="section" id="paging-wp">
        <div class="section-detail clearfix">
            <ul id="list-paging" class="fl-right">
                {{$list_account->links()}}
            </ul>
        </div>
    </div>
</div>
<a href="{{route('admin.account.list')}}" id="link-redirect"></a>
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
    $('#key_search').on('keyup', function() {
        $('#form-add-search-account-list').submit();
    });
    
    $('#form-add-search-account-list').on('submit', function(e) {
        var key = $('#key_search').val();
        e.preventDefault();
        $.ajax({
          url:"{{ route('admin.account.search') }}",
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
    $('.lock-account').on('click',function (e) {
        var id = $(this).attr('data-id');
        e.preventDefault();
        $.ajax({
          url:"{{ route('source.api.admin.account.lock') }}",
          method:"POST",
          data:{id:id},
          success:function(data){
               if (data.message === "success") {
                    pushNotify("success",1,"Đã khóa tài khoản");
                   $('#link-redirect').click();
                }else if (data.message === "admin") {
                    pushNotify("error",1,"Admin không thể khóa!");
                }
          },
          error:function(jqXHR, textStatus, errorThrown) {
              pushNotify("error",1,"Có gĩ đó lỗi!");
          }
        });
    });
    $('.delete-account').on('click',function (e) {
        var id = $(this).attr('data-id');
        e.preventDefault();
        $.ajax({
          url:"{{ route('source.api.admin.account.delete') }}",
          method:"POST",
          data:{id:id},
          success:function(data){
               if (data.message === "success") {
                    pushNotify("success",1,"Đã xóa tài khoản");
                   $('#link-redirect').click();
                }else if (data.message === "admin") {
                    pushNotify("error",1,"Admin không thể xóa!");
                }
          },
          error:function(jqXHR, textStatus, errorThrown) {
              pushNotify("error",1,"Có gĩ đó lỗi!");
          }
        });
    });
    $('.unlock-account').on('click',function (e) {
        var id = $(this).attr('data-id');
        e.preventDefault();
        $.ajax({
          url:"{{ route('source.api.admin.account.unlock') }}",
          method:"POST",
          data:{id:id},
          success:function(data){
            if (data.message === "success") {
                pushNotify("success",1,"Đã mở khóa tài khoản");
               $('#link-redirect').click();
            }
          },
          error:function(jqXHR, textStatus, errorThrown) {
              pushNotify("error",1,"Có gĩ đó lỗi!");
          }
        });
    });
</script>
@endsection
