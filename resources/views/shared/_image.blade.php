<div style="width: 470px;">
  <img id="image-view" src="{{ $product-> image ?? old('image') }}" class="img-responsive" />
</div>
<div class="form-group">
  <div style="position: relative;">
    <input onchange="setImage(event);" type="file" name="image" class="cover" />
    <button type="button" class="btn">
      Select image
    </button>
  </div>
  @error("image")
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
