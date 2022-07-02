<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
 {{-- <script>
   tinymce.init({
     selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
     plugins: 'code table lists',
     toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
   });
 </script> --}}

<script>
    var dfreeBodyConfig = {
        selector: '.dfree-body',
        menubar: false,
        inline: true,
        plugins: [
            'autolink',
            'link',
            'lists',
            'media',
            'table',
            'image',
            'quickbars',
            'help'
        ],
        toolbar: false,
        quickbars_insert_toolbar: 'quicktable image media codesample',
        quickbars_selection_toolbar: 'bold italic underline | formatselect | blockquote quicklink',
        contextmenu: 'undo redo | inserttable | cell row column deletetable | help',
        powerpaste_word_import: 'propmt',
        powerpaste_html_import: 'propmt',
        images_upload_url: '{{ route("media.upload") }}',
        automatic_uploads: true,
        images_upload_credentials: true
    };

    tinymce.init(dfreeBodyConfig);
</script>
