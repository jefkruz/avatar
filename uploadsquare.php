<?php
//echo "about to move file";
  $file_to_upload = $_FILES['croppedImage']['tmp_name'];
/* Process image with GD library */
    $verifyimg = getimagesize($_FILES['croppedImage']['tmp_name']);
    if(!$verifyimg){
        die("Only image files are allowed!");
    }
    /* Make sure the MIME type is an image */
    $pattern = "#^(image/)[^\s\n<]+$#i";

    if(!preg_match($pattern, $verifyimg['mime'])){
        die("Only image files are allowed!");
    }
       
$imageName = $_POST['imageName'];
$networkId = $_POST['id'];
        $file_name = "uploads/$imageName.png";
        move_uploaded_file($file_to_upload, $file_name);
 $stars = imagecreatefrompng("img/templ.png");
  $gradient = imagecreatefrompng("uploads/$imageName.png");
//$size = getimagesize("uploads/$imageName.png");

  imagecopymerge($stars, $gradient, 247, 263, 0, 0, 252, 240, 100);
  header('Content-type: image/png');
  imagepng($stars, "uploads/adv/ad$imageName.png");
  imagedestroy($stars);
  imagedestroy($gradient);
/*$upd_res = updatePhotos($db, "$imageName.png", "ad$imageName.png", $networkId);
echo $upd_res['message']." - completed move";*/
$filename = "ad$imageName.png";
echo $filename;
//header("location: dowload.php?file=$filename");

?>