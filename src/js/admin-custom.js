jQuery(document).ready(function($) {
  // Initialize Dropzone
  var myDropzone = new Dropzone("#image", {
      url: "/file-upload", // Set the URL for your upload script
      maxFilesize: 2, // Set the maximum file size to 2 MB
      addRemoveLinks: true,
      success: function(file, response) {
          // Handle successful uploads here
          // For example, you can append the uploaded image to the gallery
          var gallery = $('#product-gallery');
          var img = $('<img>').attr('src', response.fileUrl).addClass('img-thumbnail');
          gallery.append(img);
      },
      error: function(file, response) {
          // Handle errors here
          alert(response);
      }
  });
});
