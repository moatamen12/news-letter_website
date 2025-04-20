<?php 
  $page_tatile= "New Post";
  // require "../newPFE/includes/header.php"; 
?>
 <script src="tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>  <!--tinymce script -->

<div class="container p-4">
  <textarea id="tiny"></textarea>
</div>






<script>
  tinymce.init({
    selector: 'textarea#tiny',
    license_key: 'gpl',
    promotion: false,

    menubar: true, 
    plugins: 'image autolink link lists table code wordcount fullscreen preview ',
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | link image | preview',
    // for the image blugin 
    image_title: true, // Enable the title field in the Image dialog
    file_picker_types: 'image', // Enable the ability to upload images
    file_picker_callback: function (cb, value, meta) {
      var input = document.createElement('input');
      
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');

      input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {
          var id = 'blobid' + (new Date()).getTime();
          var blobCache = tinymce.activeEditor.editorUpload.blobCache;
          var base64 = reader.result.split(',')[1];
          var blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);

          // call the callback and populate the Title field with the file name
          cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
      };

      input.click();
    },
  
    height: 500,
    max_height: 1000,
    statusbar: false
  });
  document.addEventListener('focusin', (e) => {
  if (e.target.closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
    e.stopImmediatePropagation();
  }
});
</script>


