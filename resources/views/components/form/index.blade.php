<form method="POST" action="{{ $attributes->get('action') }}">
    @csrf
    @if ($attributes->get('method') !== 'POST')
        @method($attributes->get('method'))
    @endif

    <div {!! $attributes->only('class')->merge(['class' => 'space-y-4']) !!}>
        {{ $slot }}
    </div>
</form>
