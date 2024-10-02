<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">
    <div class="row justify-content-center">
        @foreach ($dataList as $data)
            <x-common.blocks.district :data="$data" :class="'col-md-3 col-sm-4'"></x-common.blocks.district>
        @endforeach
    </div>
</x-layouts.simple-layout>
