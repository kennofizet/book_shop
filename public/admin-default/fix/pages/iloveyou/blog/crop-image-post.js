(function ($) {
 "use strict";
 
 
		var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.5,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
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

            $("#download").on('click', function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").on('click', function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").on('click', function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").on('click', function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").on('click', function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").on('click', function() {
                $image.cropper("setDragMode", "crop");
            });

            $("#set_x_y").on('click', function() {
                $image.cropper("getData");
                var x_image_croped = $image.cropper("getData")["x"];
                var y_image_croped = $image.cropper("getData")["y"];
                var w_image_croped = $image.cropper("getData")["width"];
                var h_image_croped = $image.cropper("getData")["height"];

                $('#styleImageX').val(x_image_croped);
                $('#styleImageY').val(y_image_croped);
                $('#styleImageW').val(w_image_croped);
                $('#styleImageH').val(h_image_croped);

                // console.log( $('#styleImageX').val());
                // console.log( $('#styleImageY').val());
                // console.log( $('#styleImageW').val());
                // console.log( $('#styleImageH').val());
            });	
 
})(jQuery); 
