<?php


header('Content-type: /src/Style/Images/error404.jpg ');
$image = imagecreatefromjpeg('error404.jpg');
imagejpg($image);
echo $image;


