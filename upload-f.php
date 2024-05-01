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
        $filename = "uploads/$imageName.png";
        move_uploaded_file($file_to_upload, $filename);


$image_s = imagecreatefromstring(file_get_contents($filename));
$width = imagesx($image_s);
$height = imagesy($image_s);
$newwidth = 386;
$newheight = 386;
$image = imagecreatetruecolor($newwidth, $newheight);
imagealphablending($image, true);
imagecopyresampled($image, $image_s, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
//create masking
$mask = imagecreatetruecolor($newwidth, $newheight);
$transparent = imagecolorallocate($mask, 255, 0, 0);
imagecolortransparent($mask,$transparent);
imagefilledellipse($mask, $newwidth/2, $newheight/2, $newwidth, $newheight, $transparent);
$red = imagecolorallocate($mask, 0, 0, 0);
imagecopymerge($image, $mask, 0, 0, 0, 0, $newwidth, $newheight, 100);
imagecolortransparent($image,$red);
imagefill($image, 0, 0, $red);
imagepng($image);


 $stars = imagecreatefrompng("img/templ.png");
  $gradient = imagecreatefrompng("uploads/$imageName.png");
//$size = getimagesize("uploads/$imageName.png");

  imagecopymerge($stars, $image, 187, 222, 0, 0, 386, 386, 100);
 // header('Content-type: image/png');
  imagepng($stars, "uploads/adv/ad$imageName.png");
  imagedestroy($stars);
  imagedestroy($gradient);
/*$upd_res = updatePhotos($db, "$imageName.png", "ad$imageName.png", $networkId);
echo $upd_res['message']." - completed move";*/
$filename = "ad$imageName.png";
//$filename = "ad1585169169-404119460.png";
echo $filename;
//header("location: dowload.php?file=$filename");

?>