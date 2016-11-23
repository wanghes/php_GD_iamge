# php_GD_image
 >image scale and mark
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
