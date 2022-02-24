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
            'codesample',
            'link',
            'lists',
            'media',
            'table',
            'image',
            'quickbars',
            'codesample',
            'help'
        ],
        toolbar: false,
        quickbars_insert_toolbar: 'quicktable image media codesample',
        quickbars_selection_toolbar: 'bold italic underline | formatselect | blockquote quicklink',
        contextmenu: 'undo redo | inserttable | cell row column deletetable | help',
        powerpaste_word_import: 'clean',
        powerpaste_html_import: 'clean',
        images_upload_url: 'postAcceptor.php',
    };

    tinymce.init(dfreeBodyConfig);
</script>
