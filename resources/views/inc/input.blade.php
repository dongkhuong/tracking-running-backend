<div class="form-group {{ isset($class) ? $class : null }} {{ $errors->has($attr) ? 'has-error' : null }}">
	<label class="control-label">{{ $label }}</label>
	<input type="{{ isset($type) ? $type : 'text' }}" class="form-control {{ isset($inputClass) ? $inputClass : null }}" name="{{ $attr }}" placeholder="{{ $placeHolder }}" value="{{ old($attr, isset($value) ? $value : (isset($model) ? $model->$attr : null)) }}">

	<p class="help-block help-block-error">{{ $errors->first($attr) }}</p>
</div>
