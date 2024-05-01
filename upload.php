<?php
/*require("init.inc.php");
require("funcs.inc.php");*/
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
//$filename = "images/".$_GET['image'].".jpg";
$image_s = imagecreatefromstring(file_get_contents($filename));
$width = imagesx($image_s);
$height = imagesy($image_s);

// adjust this to the image size of the 
$newwidth = 266;
$newheight = 266;



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
/*
imagepng($image)*/;


        
 $destination = imagecreatefrompng("img/templ.png");

  $gradient = imagecreatefrompng("uploads/$imageName.png");
//$size = getimagesize("uploads/$imageName.png");

/**
 * destination --> the avatar template
 * $image --> uploaded picture
 * 231 - x -axis
 * 231 - y-axis
 * 100 -- transparency
 */

  imagecopymerge($destination, $image, 395, 375, 0, 0, $newwidth, $newheight, 100);

  $newImageName = uniqid();

  imagepng($destination, "uploads/adv/ad$newImageName.png");
  imagedestroy($destination);
  imagedestroy($gradient);
    imagedestroy($image);
$filename = "ad$newImageName.png";
echo $filename;
?>