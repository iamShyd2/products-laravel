<div class="form-group">
    <label for="{{ $id ?? $name }}" class="form-label">{{ $label ?? ucfirst($name) }}</label>
    <input id="{{ $id ?? $name }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ $value ?? old($name) }}">
    @error($name)
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
</div>
