
@extends('admin.layout.main')

@section('content')

<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách danh mục</h3>
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="table-responsive">
                <table class="table list-table-wp">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Tiêu đề</span></td>
                            <td><span class="thead-text">Thứ tự</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">Người tạo</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">1</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">Bóng đá</a>
                                </div> 
                                <ul class="list-operation fl-right">
                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">0</span></td>
                            <td><span class="tbody-text">Hoạt động</span></td>
                            <td><span class="tbody-text">Admin</span></td>
                            <td><span class="tbody-text">12-07-2016</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">2</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">--- Trong nước</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">1</span></td>
                            <td><span class="tbody-text">Hoạt động</span></td>
                            <td><span class="tbody-text">Admin</span></td>
                            <td><span class="tbody-text">12-07-2016</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">3</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">--- Bên lề</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">1</span></td>
                            <td><span class="tbody-text">Hoạt động</span></td>
                            <td><span class="tbody-text">Admin</span></td>
                            <td><span class="tbody-text">12-07-2016</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">4</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">Thế giới</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">0</span></td>
                            <td><span class="tbody-text">Hoạt động</span></td>
                            <td><span class="tbody-text">Admin</span></td>
                            <td><span class="tbody-text">12-07-2016</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">5</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">--- Trong nước</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">4</span></td>
                            <td><span class="tbody-text">Hoạt động</span></td>
                            <td><span class="tbody-text">Admin</span></td>
                            <td><span class="tbody-text">12-07-2016</span></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">6</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">--- Bên lề</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td><span class="tbody-text">4</span></td>
                            <td><span class="tbody-text">Hoạt động</span></td>
                            <td><span class="tbody-text">Admin</span></td>
                            <td><span class="tbody-text">12-07-2016</span></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="tfoot-text">STT</span></td>
                            <td><span class="tfoot-text-text">Tiêu đề</span></td>
                            <td><span class="tfoot-text">Thứ tự</span></td>
                            <td><span class="tfoot-text">Trạng thái</span></td>
                            <td><span class="tfoot-text">Người tạo</span></td>
                            <td><span class="tfoot-text">Thời gian</span></td>
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
                <li>
                    <a href="" title=""><</a>
                </li>
                <li>
                    <a href="" title="">1</a>
                </li>
                <li>
                    <a href="" title="">2</a>
                </li>
                <li>
                    <a href="" title="">3</a>
                </li>
                <li>
                    <a href="" title="">></a>
                </li>
            </ul>
        </div>
    </div>
</div>
    
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
@endsection
