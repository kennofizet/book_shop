(function ($) {
 "use strict";
 
 
		var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.39,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#support_blog_post_gallery_category_inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    console.log('change');
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#support_blog_post_gallery_category_download").on('click', function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#support_blog_post_gallery_category_zoomIn").on('click', function() {
                $image.cropper("zoom", 0.1);
            });

            $("#support_blog_post_gallery_category_zoomOut").on('click', function() {
                $image.cropper("zoom", -0.1);
            });

            $("#support_blog_post_gallery_category_rotateLeft").on('click', function() {
                $image.cropper("rotate", 45);
            });

            $("#support_blog_post_gallery_category_rotateRight").on('click', function() {
                $image.cropper("rotate", -45);
            });

            $("#support_blog_post_gallery_category_setDrag").on('click', function() {
                $image.cropper("setDragMode", "crop");
            });

            $("#support_blog_post_gallery_category_set_x_y").on('click', function() {
                $image.cropper("getData");
                var x_image_croped = $image.cropper("getData")["x"];
                var y_image_croped = $image.cropper("getData")["y"];
                var w_image_croped = $image.cropper("getData")["width"];
                var h_image_croped = $image.cropper("getData")["height"];

                $('#support_blog_post_gallery_category_styleImageX').val(x_image_croped);
                $('#support_blog_post_gallery_category_styleImageY').val(y_image_croped);
                $('#support_blog_post_gallery_category_styleImageW').val(w_image_croped);
                $('#support_blog_post_gallery_category_styleImageH').val(h_image_croped);
            });	
 
})(jQuery); 