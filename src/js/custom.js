Dropzone.autoDiscover = false;

jQuery(document).ready(function($) {
    // Initialize Dropzone
    var myDropzone = new Dropzone("#portfolio-image-dropzone", {
        url: MyPluginData.uploadUrl,
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        acceptedFiles: "image/*",
        dictDefaultMessage: "Drop files here or click to upload",
        init: function() {
            this.on("success", function(file, response) {
                let html = `<div class="col-md-3" id="image-row-${response.image_id}">
                <div class="card">
                    <input type="hidden" name="image_array[]" value="${response.image_id}">
                    <img src="${response.imagePath}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                    </div>
                </div>
                </div>`;
                $("#product-gallery").append(html);
            });
            this.on("error", function(file, errorMessage) {
                console.error("Error uploading file:", errorMessage);
                // Handle error response here, if needed
            });
            this.on("complete", function(file) {
                this.removeFile(file);
            });
        }
    });

    // JavaScript function to handle image deletion
    window.deleteImage = function(imageId) {
        $(`#image-row-${imageId}`).remove();
    };
});
