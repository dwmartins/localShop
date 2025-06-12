<button 
    @if($id)
        id="{{ $id }}"   
    @endif

    @if ($onclick)
        onclick="{{ $onclick }}"
    @endif
    
    class="btn btn-primary d-flex align-items-center justify-content-center {{ $size ? "btn-$size" : "" }} {{ $class }}"
    data-trans-loading="{{ $text_loading }}"
    type="{{ $type }}">

    <x-loader 
        class="d-none spinner-loader"
        color="bg-white"
        size="{{ $size }}"
    />

    <span class="btn-text ms-1">{{ $text }}</span>
</button>