<x-page-parts.center-rectangle-header page="premios" />

<div class="flex flex-wrap items-baseline gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">{{ $premio->title }}</h1>
    <h4 class="text-xl font-medium text-gray-500 align-baseline">Última actualización
        {{ $premio->updated_at->locale('es')->diffForHumans() }}</h4>
</div>
@if (session()->get('user')->role != 'player')
    <div>
        <x-forms.tinymce-editor :text="$premio->content" :route="route('premio.update', ['premio' => $premio->id])" />
    </div>
    <div id="lightgallery" class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-4">
        <div class="col-span-full">
            <form method="post" action="{{ route('temporada.premi-diploma.store', ['premio' => $premio]) }}"
                enctype="multipart/form-data"
                class="flex flex-wrap items-center justify-center w-full border-2 border-dashed rounded min-h-32 dropzone"
                id="dropzone">
                @csrf
            </form>
        </div>
        <script type="text/javascript">
            $(function() {
                // access Dropzone here
                Dropzone.options.dropzone = {
                    maxFilesize: 12,
                    renameFile: function(file) {
                        var dt = new Date();
                        var time = dt.getTime();
                        var fileType = file.name.split('.');
                        var num = Math.floor(Math.random() * 1000) + 100;
                        fileType = fileType[fileType.length - 1]
                        return time + "-" + num + "-premi-diploma." + fileType;
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
                            url: "{{ route('temporada.premi-diploma.delete', ['premio' => $premio]) }}",
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
                        const mockFile = @json($images).map(el => {
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
                Dropzone.discover();
            });
        </script>
    </div>
@else
    {!! $premio->content !!}
@endif


<x-page-parts.center-rectangle-footer />
