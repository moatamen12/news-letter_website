// Title editor configuration
tinymce.init({
selector: '#title_editor',
inline: false,
menubar: false,
toolbar: 'bold italic underline',
plugins: '',
height: 200,
max_height: 300,
statusbar: false,
forced_root_block: 'h1',  // Forces content to be wrapped in h1
});
  


//Content editor configuration
tinymce.init({
selector: '#content_editor',
license_key: 'gpl',
promotion: false,
branding: false, 
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

// Editor appearance
height: 500,
max_height: 1000,
// statusbar: false

// preview cosmization
content_css:'/newsLetter/newPFE/assets/css/tiny.css',
});








// Preventing the editor from losing focus when clicking on the editor
document.addEventListener('focusin', (e) => {
    if (e.target.closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
    e.stopImmediatePropagation();
    }
});