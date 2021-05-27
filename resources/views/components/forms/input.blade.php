<div>
    <label for="{{ $getId }}">{{ $label }}</label>
    <input 
        type="{{ $type }}" 
        id="{{ $getId }}" 
        name="{{ $name }}" 
        class="form-control @if($errors->has($name)) {{ 'is-invalid' }} @endif {{ $attributes['class'] }}" 
        value="{{ old($name, $value) }}" 
        placeholder="{{ $label }}"
        {{ $attributes }}
    >
    @if ($errors->has($name))
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
</div>