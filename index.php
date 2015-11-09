<?php

function UploadImageResize($new_name, $file, $dir, $width){
	$vdir_upload = $dir;
	$vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];

	move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);

	$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	$dst_width = $width;
	$dst_height = ($dst_width/$src_width)*$src_height;

	$im = imagecreatetruecolor($dst_width, $dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	imagejpeg($im, $vdir_upload . $new_name, 100);

	imagedestroy($im_src);
	imagedestroy($im);
	$remove_small = unlink("$vfile_upload");

}


if(isset($_POST['upload'])){
	$new_name =time().'.jpg';
	$file='foto';
	$dir='image/';
	$width=400;
	$a = "azmi";
	UploadImageResize($new_name, $file, $dir, $width);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form Upload</title>
	<style type="text/css" media="screen">
		#content a {
			text-decoration: none;
			font-size: 2.25em;
			background-color: #b01c20;
			border-radius: 8px;
			color: white;
			padding: 3%;
			float: left;
			background: linear-gradient(90deg, #b01c20 0%, #f15c60 100%);
			margin-top: 30px;
			box-shadow: 5px 5px 5px hsla(0, 0%, 26.6667, 0.8);
			text-shadow: 0px 1px black;
			border: 1px solid #bfbfbf;
			-o-transition: all 1s ease 0s;
			-ms-transition: all 1s ease 0s;
			-moz-transition: all 1s ease 0s;
			-webkit-transition: all 1s ease 0s;
			transition: all 1s ease 0s;
		}

		#content a:hover{
			border: 1px solid #000000;
			color: #000000;
			text-shadow: 0px 1px white;
		}
	</style>
</head>
<body>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="foto" accept="image/JPEG">
		<input type="submit" name="upload" value="upload">
	</form>
	<div id="content">
		<a href="">Login</a>
	</div>
</body>
</html>