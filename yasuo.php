<?php
//图片水印
/*打开图片*/
//1、配置图片路径
$src="pic_02.png";
//2、获取图片信息
$info = getimagesize($src);
//3、通过图片的编码号获取图片的类型
$type = image_type_to_extension($info[2],false);
//4、在内存中创建一个和我们图像类型一样的图像
$fun = "imagecreatefrom{$type}";
//5、把图片复制到内存中
$image = $fun($src);

/*操作图片*/
//1、设置水印的图片路径
$imageThumb = imagecreatetruecolor(120, 60);
imagecopyresampled($imageThumb, $image, 0, 0, 0, 0, 120, 60, $info[0], $info[1]);
//2、获取水印图片的基本信息
imagedestroy($image);

header('Content-type:',$info['mime']);
$func = "image{$type}";
$func($imageThumb);

$func($imageThumb,'images/yasuo.png');

imagedestroy($imageThumb);


 // imagepng;imagejpeg

?>