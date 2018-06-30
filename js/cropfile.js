$(function () {});

function itemcrop(content, logo, zoom, width, height) {
  $(content).cropit({
    imageState: {
      src: "http://localhost:8000" + logo
    },
    exportZoom: zoom,
    onFileChange: function (object) {
      var input = object.target;
      var reader = new FileReader();
      reader.onload = function () {
        var img = new Image();
        img.onload = function () {
          if (img.width < width || img.height < height) {
            alert("Selecione uma imagem com no minimo " + width + "px por " + height + "px");
            return false;
          }
        };
        img.src = reader.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  });

  $(content + " .rotate-cw").click(function () {
    $(content).cropit("rotateCW");
  });
  $(content + " .rotate-ccw").click(function () {
    $(content).cropit("rotateCCW");
  });
}