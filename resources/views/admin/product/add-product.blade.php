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
            <form method="POST">
                <label for="product-name">Tên sản phẩm</label>
                <input type="text" name="product_name" id="product-name">
                <label for="product-code">Mã sản phẩm</label>
                <input type="text" name="product_code" id="product-code">
                <label for="price">Giá sản phẩm</label>
                <input type="text" name="price" id="price">
                <label for="desc">Mô tả ngắn</label>
                <textarea name="desc" id="desc"></textarea>
                <label for="desc">Chi tiết</label>
                <textarea name="desc" id="desc-detail" class="ckeditor"></textarea>
                <label>Hình ảnh</label>
                <div id="uploadFile">
                    <input type="file" name="file" id="upload-thumb">
                    <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                    <img src="public/images/img-thumb.png">
                </div>
                <label>Danh mục sản phẩm</label>
                <select name="parent_id">
                    <option value="">-- Chọn danh mục --</option>
                    <option value="1">Thể thao</option>
                    <option value="2">Xã hội</option>
                    <option value="3">Tài chính</option>
                </select>
                <label>Trạng thái</label>
                <select name="status">
                    <option value="0">-- Chọn danh mục --</option>
                    <option value="1">Chờ duyệt</option>
                    <option value="2">Đã đăng</option>
                </select>
                <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    body_script("{{url('/')}}/admin/js/plugins/ckeditor/ckeditor.js",loadCkeditor);
    body_script("{{url('/')}}/admin/js/main.js");
</script>
@endsection