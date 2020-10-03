@extends('admin.layout.main')

@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <form method="POST">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" id="title">
                <label for="title">Slug ( Friendly_url )</label>
                <input type="text" name="slug" id="slug">
                <label for="desc">Mô tả</label>
                <textarea name="desc" id="desc" class="ckeditor"></textarea>
                <label>Hình ảnh</label>
                <div id="uploadFile">
                    <input type="file" name="file" id="upload-thumb">
                    <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                    <img src="public/images/img-thumb.png">
                </div>
                <label>Danh mục cha</label>
                <select name="parent-Cat">
                    <option value="">-- Chọn danh mục --</option>
                    <option value="1">Thể thao</option>
                    <option value="2">Xã hội</option>
                    <option value="3">Tài chính</option>
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