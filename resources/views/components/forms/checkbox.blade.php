<div class="form-check">
    <input 
        id="{{ $getId }}"
        name="{{ $name }}" 
        class="form-check-input @if($errors->has($name)) {{ 'is-invalid' }} @endif" 
        type="checkbox"
        value="{{ old($name, $value) }}"
        {{ $checked ? 'checked' : '' }}
    >
    <label class="form-check-label" for="{{ $getId }}">
        {{ $label }}
    </label>

    @if ($errors->has($name))
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
</div>

