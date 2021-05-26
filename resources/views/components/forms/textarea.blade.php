<div>
    <label for="{{ $getId }}">{{ $label }}</label>
    <textarea
        id="{{ $getId }}" 
        name="{{ $name }}" 
        class="form-control @if($errors->has($name)) {{ 'is-invalid' }} @endif" 
        value="{{ old($name, $value) }}" 
        rows="3"
        placeholder="{{ $label }}"
    >
    </textarea>
    @if ($errors->has($name))
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
</div>