<x-head.tinymce-config/>
<div class="mb-4 dfree-body mce-content-body" id="mceContent" contenteditable="true" spellcheck="false">
    {!! $text !!}
</div>
<div class="flex justify-end">
    <x-button type="submit" id="sendContent" text="Enviar" />
</div>

<script>
    $('#sendContent').on('click', function() {
        const content = $('#mceContent');
        saveData(content.html());
    });

    function saveData(content) {
        $.ajax({
            url:'{{ $route }}',
            data:{'content':content},
            type:'PUT',
            success: function (response) {
                console.log(response);
                Toast.fire({
                    icon: 'success',
                    title: 'Guardado correctamente'
                });
            },
            statusCode: {
                404: function() {
                    console.log('web not found');
                },
                409: function(response) {
                    console.log(response.responseJSON.message)
                },
                500: function(response) {
                    console.log(response.responseJSON.message);
                }
            },
            error:function(response){
                Toast.fire({
                    icon: 'error',
                    title: response.responseJSON.message
                });
            }
        });
    }
</script>
