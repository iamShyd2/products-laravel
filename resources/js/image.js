window.setImage = function (e){
  const imgEl = document.getElementById("image-view");
  const {name, files} = e.target;
  const reader = new FileReader();
  reader.onload = function(){
    imgEl.src = reader.result;
  };
  reader.readAsDataURL(files[0]);
}
