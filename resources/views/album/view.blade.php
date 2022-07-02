<x-page-parts.center-rectangle-header page="album"/>
<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Album temporada {{ $temporada->nom_temporada }}</h1>
</div>
<div class="">
    <div id="adobe-dc-view" class="w-full" style="height: 600px"></div>
</div>

<script type="text/javascript">
    document.addEventListener("adobe_dc_view_sdk.ready", function()
    {
        var adobeDCView = new AdobeDC.View({clientId: "f6361a1af71a48e2a2f456065284816b", divId: "adobe-dc-view"});
        adobeDCView.previewFile(
       {
          content:   {location: {url: "{{ asset($album->filename) }}"}},
          metaData: {fileName: "{{ $album->original_filename }}"}
       }, {embedMode: "SIZED_CONTAINER", dockPageControls: false});
    });
 </script>

<x-page-parts.center-rectangle-footer />
