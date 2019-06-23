<dl class="row m-t-md small">
    @foreach ($item['additional_info'] as $key => $value)
        <dd class="col-md-12"><strong>{{ $key }}: </strong> {{ $value }}</dd>
    @endforeach
</dl>
