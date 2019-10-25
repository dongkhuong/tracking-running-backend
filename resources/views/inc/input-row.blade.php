<div class="form-group {{ isset($class) ? $class : null }} {{ $errors->has($attr) ? 'has-error' : null }}">
    <label class="col-lg-{{ $labelCol }} control-label">{{ $label }}</label>
    <div class="col-lg-{{ $inputCol }}">
        <input type="{{ isset($type) ? $type : 'text' }}" class="form-control" name="{{ $attr }}" autocomplete="off" placeholder="{{ $placeHolder }}" value="{{ old($attr, isset($value) ? $value : (isset($model) ? $model->$attr : null)) }}">
    </div>
    <div class="col-lg-{{ $inputCol }} col-md-offset-{{ $labelCol }}">
        <p class="help-block help-block-error">{{ $errors->first($attr) }}</p>
    </div>
</div>
