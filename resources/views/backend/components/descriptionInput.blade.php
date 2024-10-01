<div class="mb-3">
    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
    <textarea name="description" id="editor" class="form-control" rows="5" required> {{isset($category->description)?$category->description:''}}</textarea>
</div>
@push('script')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        // Initialize CKEditor for the description fiel
        let _initCkEditor = function(editorName, startupFocus = false, editorHeight = false) {
            CKEDITOR.replace(editorName, {
                // filebrowserUploadUrl: 'ck_upload.php', //Later
                filebrowserUploadMethod: 'form',
                height: editorHeight ? editorHeight : '',
                startupFocus: startupFocus == 1 ? true : false,
                removePlugins: 'exportpdf',
                toolbar: [
                    ['Format', 'Font', 'FontSize', '-'],
                    ['Bold', 'Italic', 'Underline', 'Table', '-', 'NumberedList', 'BulletedList', '-'],
                    ["JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock"],
                    ['Link', 'Blockquote', 'Maximize', 'Image', 'TextColor', '-', 'Source']
                ]
            });
        }
    </script>
@endpush
