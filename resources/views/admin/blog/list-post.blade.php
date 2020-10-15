@extends('admin.layout.main')

@section('content')

<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách bài viết</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="{{route('admin.blog.list')}}">Tất cả <span class="count">({{$count_all}})</span></a> |</li>
                    <li class="publish"><a href="{{route('admin.blog.list-active')}}">Hiện <span class="count">({{$count_active}})</span></a> |</li>
                    <li class="pending"><a href="{{route('admin.blog.list-hidden')}}">Ẩn <span class="count">({{$count_hidden}})</span></a></li>
                </ul>
                <!-- <form method="GET" class="form-s fl-right">
                    <input type="text" name="s" id="s">
                    <input type="submit" name="sm_s" value="Tìm kiếm">
                </form> -->
            </div>
            <!-- <div class="actions">
                <form method="GET" action="" class="form-actions">
                    <select name="actions">
                        <option value="0">Tác vụ</option>
                        <option value="1">Chỉnh sửa</option>
                        <option value="2">Bỏ vào thủng rác</option>
                    </select>
                    <input type="submit" name="sm_action" value="Áp dụng">
                </form>
            </div> -->
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
                            <td><span class="thead-text">Tiêu đề</span></td>
                            <td><span class="thead-text">Ảnh</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">Like</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_post as $detail_post)
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">{{$loop->index}}</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">{{ $detail_post->title }}</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="{{route('admin.blog.edit-post',$detail_post->id)}}" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <button id="idModeDeleteBlogPost{{$detail_post->id}}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modeDeleteBlogPost{{$detail_post->id}}" style="display: none;">Modal Open</button>
                                    <div class="modal fade" id="modeDeleteBlogPost{{$detail_post->id}}" tabindex="-1" role="dialog" aria-labelledby="modeDeleteBlogPost{{$detail_post->id}}Label" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="modeDeleteBlogPost{{$detail_post->id}}Label">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            Việc xóa đồng nghĩa ảnh và những dữ liệu liên quan đến bài viết này sẽ bị xóa và không thể khôi phục, bạn có đồng ý không ?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                            <button type="button" data-id="{{$detail_post->id}}" class="btn btn-primary button-click-delete-post-action">Xác Nhận</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <li><i class="button-click-delete-post fa fa-trash" data-id="{{$detail_post->id}}" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text"><img src="{{url('/')}}/upload/source/api/blog/thumbnail/{{$detail_post->file}}"></span></td>
                            <td><span class="tbody-text">@if($detail_post->status == 1) Hiện @else Ẩn @endif</span></td>
                            <td><span class="tbody-text">@if($detail_post->countLikePost){{$detail_post->countLikePost->count}}@else 0 @endif</span></td>
                            <td><span class="tbody-text">{{$detail_post->created_at}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="tfoot-text">STT</span></td>
                            <td><span class="tfoot-text">Tiêu đề</span></td>
                            <td><span class="tfoot-text">Ảnh</span></td>
                            <td><span class="tfoot-text">Trạng thái</span></td>
                            <td><span class="tfoot-text">Lượt xem</span></td>
                            <td><span class="tfoot-text">Thời gian</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
    <div class="section" id="paging-wp">
        <div class="section-detail clearfix">
            <ul id="list-paging" class="fl-right">
               {{$list_post->links()}}
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
    // "{{url('/')}}/admin-default/js/cropper/cropper.min.js",
    // "{{url('/')}}/admin-default/fix/pages/iloveyou/blog/crop-image-post.js",
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
$('#actions-action-active-number-form').on('change', function() {
    console.log(this.value);
  $.ajax({
      url:"{{ route('source.api.admin.blog.setting-count-data-page-blog') }}",
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
<script type="text/javascript">
    $('.button-click-delete-post').on('click',function (e) {
        var id_post_action = $(this).attr('data-id');
        // console.log(id_post_action);
        $('#idModeDeleteBlogPost'+id_post_action).click();
    });
</script>
<script type="text/javascript">
    $('.button-click-delete-post-action').on('click',function (e) {
        var id_post_action = $(this).attr('data-id');
        $.ajax({
          url:"{{ route('source.api.admin.blog.delete-post') }}",
          method:"POST",
          data:{id:id_post_action},
          success:function(data){
            console.log(data);
            if (data.message == "error") {
                pushNotify("validation",1,"Bài viết bạn chọn không hợp lệ!");
            }else if(data.message == "success"){
                $('#modeDeleteBlogPost'+id_post_action).modal('toggle');
                pushNotify("success",1,"Đã xóa!");
                $('#redirect-link-default').click();
            }else{
                pushNotify("error",1,"Có gì đó lỗi!");
            }
          },
          error:function(jqXHR, textStatus, errorThrown) {
              pushNotify("error",1,"Có gĩ đó lỗi!");
          }
        });
    });
</script>
@endsection
