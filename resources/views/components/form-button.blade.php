<div class="d-inline-block">
    <form action="{{ $actionUrl }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}">
        @csrf
        @if (! in_array($method, ['GET', 'POST']))
            @method($method)
        @endif

        <button type="submit" class="btn btn-{{ $style }}" {{ $attributes }}>
            {{ $slot }} <i class="{{ $icon }}"></i>
        </button>
    </form>
</div>