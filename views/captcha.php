<?php
session_start();
header("Content-Type: image/png");

//Créer une image
$imgWidth=200;
$imgHeight=100;
$image = imagecreate($imgWidth, $imgHeight);


$randcolorback = imagecolorallocate($image, rand(0,100), rand(0,100), rand(0,100));



$fonts = glob("./fonts/*.ttf");
$x=rand(10,15);
$char = "abcdefghijklmonpqrstuvwxyz0123456789";
$char = str_shuffle($char);
$length = rand(-8,-6);
$captcha = substr($char, $length);
$_SESSION["captcha"]= $captcha;


for($i=0; $i<strlen($captcha);$i++){
  $size = rand(10, 20);
  $angle = rand(-20, 20);
  $y = (rand(40, $imgHeight-40));
  $color = imagecolorallocate($image, rand(150,250), rand(150,250), rand(150,250));
  imagettftext($image, $size, $angle, $x, $y, $color, $fonts[rand(0,
    count($fonts)-1)], $captcha[$i]);
  $x+=$size+rand(5,10);
}


for($j=0; $j<rand(2,5);$j++){

    $x1 = rand(0, $imgWidth);
    $x2 = rand(0, $imgWidth);
    $y1 = rand(0, $imgHeight);
    $y2 = rand(0, $imgHeight);
    $color= imagecolorallocate($image, rand(150,250), rand(150,250), rand(150,250));

  switch(rand(0,2)){

    case 0:
      imageline($image, $x1, $y1, $x2, $y2, $color);
      break;
    case 1:
      imagerectangle($image, $x1, $y1, $x2, $y2, $color);
      break;
    case 2:
      imageellipse($image, $x1, $y1, $x2, $y2, $color);
      break;
  }
}

//Afficher l'image (ou l'enregistrer)
imagepng($image);
