# php_GD_image
[**image scale and mark**](http://mousebird.cn/blog/2016/11/23/9),mousebord.cn
##首先要制作一个文字水印   
准备的材料有两个：一个是要添加水印的图片，一个是添加到水印上的文字（我这里面使用微软雅黑字体【wryh.tif】）   
```php
//文字水印
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
//设置字体的路径
$font = "msyh.ttf"; 
//填写的水印内容
$content = "你好媳妇";
//设置字体的颜色和透明度 参数1 内存中的图片 参数2 red 参数3green 参数4blue
$col = imagecolorallocatealpha($image, 255, 255, 255, 10);
//写入文字
/*
图形处理函数库
ImageTTFText
写 TTF 文字到图中。
语法: array ImageTTFText(int im, int size, int angle, int x, int y, int col, string fontfile, string text);
返回值: 数组
函数种类: 图形处理
内容说明
本函数将 TTF (TrueType Fonts) 字型文字写入图片。参数 size 为字形的尺寸；angle 为字型的角度，顺时针计算，0 度为水平，也就是三点钟的方向 (由左到右)，90 度则为由下到上的文字；x,y 二参数为文字的坐标值 (原点为左上角)；参数 col 为字的颜色；fontfile 为字型文件名称，亦可是远端的文件；text 当然就是字符串内容了。返回值为数组，包括了八个元素，头二个分别为左下的 x、y 坐标，第三、四个为右下角的 x、y 坐标，第五、六及七、八二组分别为右上及左上的 x、y 坐标。治募注意的是欲使用本函数，系统要装妥 GD 及 Freetype 二个函数库。
*/
imagettftext($image, 14, 0, 10, 30, $col, $font , $content);
//把文字写入图片中
/**输出图片*/
//浏览器输出
header('Content-type:',$info['mime']);
$func = "image{$type}"; // imagepng;imagejpeg
$func($image);
$func($image,'images/cc.png');
imagedestroy($image);
```
##制作一个图片水印
准备一个水印图片，和一个要添加水印的图片
```php
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
```
##最后制作一个略缩图
略缩图只需要一张要略缩的图片即可
```php
//图片略缩图
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
```

以上就是图片加文字水印，图片加图片水印，图片略缩的过程代码   


