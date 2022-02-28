<a href="{{$link}}" aria-id="{{$id}}" aria-name="Temporada 2021/22" class="relative grid content-between p-6 max-w-sm bg-white rounded-lg border border-gray-100 shadow-md hover:bg-gray-100">
    <div>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$title}}</h5>
        <p class="font-normal text-gray-700">{{$subtitle}}</p>
    </div>
    <div class="flex -space-x-3 self-end font-mono text-white text-sm font-bold leading-6 my-4">
        <div class="w-12 h-12 rounded-full flex items-center justify-center bg-purple-500 shadow-lg ring-2 ring-white z-20">R</div>
        <div class="w-12 h-12 rounded-full flex items-center justify-center bg-pink-500 shadow-lg ring-2 ring-white z-10">F</div>
        <div class="w-12 h-12 rounded-full flex items-center justify-center bg-blue-500 shadow-lg ring-2 ring-white z-0">I</div>
    </div>
    <x-button.card-delete />
</a>
