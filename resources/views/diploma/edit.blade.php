<x-page-parts.center-rectangle-header page="premios" />
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Galeria de la {{ $temporada->nom_temporada }}</h1>
</div>

<div id="lightgallery" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
    @foreach ($temporada->ligas()->groupBy('liga_id')->get()
    as $liga)
        <div class="mt-4 col-span-full">
            <h2 class="text-3xl font-medium leading-tight align-baseline">{{ $liga->name }}</h2>
        </div>
        <div class="col-span-full">
            <form method="post" action="{{ route('temporada.diploma.store', ['temporada' => $temporada]) }}"
                enctype="multipart/form-data"
                class="flex flex-wrap items-center justify-center w-full border-2 border-dashed rounded min-h-32 dropzone"
                id="dropzone-{{ $liga->id }}">
                @csrf
                <input type="hidden" name="liga_id" value="{{ $liga->id }}">
            </form>
            <script type="text/javascript">
                $(function() {
                    Dropzone.options.dropzone{{ $liga->id }} = {
                        maxFilesize: 12,
                        renameFile: function(file) {
                            var dt = new Date();
                            var time = dt.getTime();
                            var fileType = file.name.split('.');
                            var num = Math.floor(Math.random() * 1000) + 100;
                            fileType = fileType[fileType.length - 1]
                            return time + "-" + num + "-diploma." + fileType;
                        },
                        acceptedFiles: ".jpeg,.jpg,.png,.gif",
                        addRemoveLinks: true,
                        timeout: 5000,
                        removedfile: function(file) {
                            var name = file.upload.filename;
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },
                                type: 'DELETE',
                                url: '{{ route('temporada.diploma.delete', ['temporada' => $temporada]) }}',
                                data: {
                                    filename: name
                                },
                                success: function(data) {
                                    console.error("File has been successfully removed!!");
                                },
                                error: function(e) {
                                    console.error(e);
                                }
                            });
                            var fileRef;
                            return (fileRef = file.previewElement) != null ?
                                fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        },
                        success: function(file, response) {
                            console.log(response);
                        },
                        error: function(file, response) {
                            return false;
                        },
                        init: function() {
                            const mockFile = @json(
    $liga
        ->diplomas()
        ->where('temporada_id', '=', $temporada->id)
        ->get(),
).map(el => {
                                return {
                                    file: {
                                        name: el.original_filename,
                                        size: 12345,
                                        type: 'image/jpeg',
                                        upload: {
                                            filename: el.original_filename
                                        }
                                    },
                                    url: "https://{{ request()->getHost() }}/" + el.filename
                                }
                            })
                            mockFile.forEach(file => {
                                this.options.addedfile.call(this, file.file);
                                this.options.thumbnail.call(this, file.file, file.url);
                                file.file.previewElement.classList.add('dz-success');
                                file.file.previewElement.classList.add('dz-complete');
                            })
                        }
                    };
                });
            </script>
        </div>
    @endforeach

</div>

<script>
    $(function() {
        Dropzone.discover()
    })
</script>

<x-page-parts.center-rectangle-footer />
