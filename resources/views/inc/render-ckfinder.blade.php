<script>
if ( typeof CKEDITOR !== 'undefined' ) {
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.addCss( 'img {max-width:100%; height: auto;}' );
    var editor = CKEDITOR.replace("{{isset($textareaId) ? $textareaId : ''}}", {
        filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
        height: {{isset($height) ? $height : 250}}
    });
    CKFinder.setupCKEditor( editor );
}
</script>