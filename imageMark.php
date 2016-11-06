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
$imageMark = "huo.png";
//2、获取水印图片的基本信息
$info2 = getimagesize($imageMark);
//3、通过水印图片的编码号获取图片的类型
$type2 = image_type_to_extension($info2[2],false);
//4、在内存中创建一个和我们水印图像类型一样的图像
$fun = "imagecreatefrom{$type2}";
//5、把图片复制到内存中
$water = $fun($imageMark);
//6、合并图片
imagecopymerge($image, $water, 10, 30, 0, 0, $info2[0], $info2[1], 100);
//7、销毁水印图片（因为它在内存中）
imagedestroy($water);
/**输出图片*/
//浏览器输出
header('Content-type:',$info['mime']);
$func = "image{$type}"; // imagepng;imagejpeg

$func($image);

$func($image,'images/cc2.png');

imagedestroy($image);

?>