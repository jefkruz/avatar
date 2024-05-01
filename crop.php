<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="A simple jQuery image cropping plugin.">
  <meta name="keywords" content="HTML, CSS, JS, JavaScript, jQuery plugin, image cropping, image crop, image move, image zoom, image rotate, image scale, front-end, frontend, web development">
  <meta name="author" content="Chen Fengyuan">
  <title>Prayer Conference - Crop Picture</title>
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/cropper.css">
  <link rel="stylesheet" href="dist/css/main.css">
    
</head>
<body >

    <!-- Start your project here-->
   <!-- Header -->
  <header class="navbar  bg-dark text-white navbar-expand-md mdb-skin">
    <div class="float-left">
            Canada Conference
        </div>
      <div class="breadcrumb-dn mr-auto">
          Conference
      </div>
      <div class="container">
       
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbar-collapse" role="navigation">
        <nav class="nav navbar-nav">
          <ul class="nav navbar-nav nav-flex-icons ml-auto">
             <li class="nav-item">
                <a href="index.php" class="nav-link"><i class="fa fa-home"></i> <span class="clearfix d-none d-sm-inline-block">Home</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Welcome
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    
                </div>
            </li>
        </ul>
        </nav>
      </div>
    </div>
  </header>
  <!--Main Layout-->
<main class="pb-0">
  <!-- Content -->
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <!-- <h3>Demo:</h3> -->
        <div class="img-container">
          <img id="image" src="<?php echo ($pic_name == "")?"dist/images/avatar.png":"uploads/$pic_name"; ?>" alt="Picture">
        </div>
      </div>
      <div class="col-md-3">
        <!-- <h3>Preview:</h3> -->
        <div class="docs-preview clearfix">
          <div class="img-preview preview-lg"></div>
          
        </div>

        <!-- <h3>Data:</h3> -->
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-9 docs-buttons">
        <!-- <h3>Toolbar:</h3> -->
        

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;reset&quot;)">
              <span class="fa fa-refresh"></span>
            </span>
          </button>
          <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
            <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
              <span class="fa fa-upload"> Select Photo</span>
            </span>
          </label>
          
        </div>

        <div class="btn-group btn-group-crop">
          <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
            <span class="docs-tooltip"  data-animation="false" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 224, height: 224 })">
             Crop and Save
            </span>
          </button>
          
        </div>

        <!-- Show the cropped image in modal -->
        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
               
                <a id="download" href="javascript:void(0);" download="cropped.jpg" ></a>
                  <button class="btn btn-success" type="submit" name="save" value="crop" id="crop" data-dismiss="modal">Save Image</button>
              </div>
            </div>
          </div>
        </div><!-- /.modal -->

       
      </div><!-- /.docs-buttons -->

      <div class="col-md-3 docs-toggles"> 
        <!-- <h3>Toggles:</h3> -->
        


      </div><!-- /.docs-toggles -->
    </div>
  </div>
    </main>
  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://fengyuanchen.github.io/js/common.js"></script>
  <script src="dist/js/cropper.js"></script>
  <script src="dist/js/main.js"></script>

    <script>
 

$('button#crop').on('click', function (event) {
    var cropcanvas = $('#image').cropper('getCroppedCanvas',{
  width: 223,
  height: 223
});
    var croppng = cropcanvas.toDataURL("image/png");
   var dataURL = cropcanvas.toDataURL( "image/png" );
var data = atob( dataURL.substring( "data:image/jpg;base64,".length ) ),
    asArray = new Uint8Array(data.length);

for( var i = 0, len = data.length; i < len; ++i ) {
    asArray[i] = data.charCodeAt(i);    
}

var blob = new Blob( [ asArray.buffer ], {type: "image/jpg"} );
    
  var formData = new FormData();

  formData.append('croppedImage', blob);
    formData.append('imageName', '<?= $img_name ?>');
    formData.append('id', '<?= $networkId ?>');

  $.ajax('upload.php', {
    method: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (data) {
      console.log(data);
       // alert(data);
        //window.location.href ="index.php#joinMePic";
    },
    error: function () {
      console.log('Upload error');
    }
  });
});
    </script>
</body>
</html>
