<?php
namespace cz\framework;
class Image
{
	protected $saveDir 		= './image'; //图片保存目录
	protected $imageType 	= 'png' ;  //图片保存类型
	protected $isRandFile	= true; //是否是随机文件名
	

	public function __construct($saveDir,$imageType,bool $isRandFile = true)
	{
		//将目录中反斜线替换为正斜线
		$saveDir = $this->replaceSeperator($saveDir);
		$this->saveDir = $saveDir;
		if (!$this->checkDir($saveDir)) {
			exit('目录不存在或不可读写');
		}

		$this->imageType = $this->getImageType($imageType);
		$this->isRandFile = $isRandFile;
	}

	public function watermark(string $dest,string $source,int $pos = 5,float $alpha = 100)
	{
		// 1)、路径检测
		if (!file_exists($dest) || !file_exists($source)) {
			exit('源文件或目标文件不存在！');
		}

		// 2)、计算图片尺寸
		list($destWidth,$destHeight) = getimagesize($dest);
		list($sourceWidth,$sourceHeight) = getimagesize($source);
		if ($sourceWidth > $destWidth || $sourceHeight > $destHeight) {
			exit('水印图片比目标图片大！');
		}

		// 3)、计算水印位置
		$position = $this->getPosition($destWidth,$destHeight,$sourceWidth,$sourceHeight,$pos);

		// 4)、合并图片
		$destImage = $this->openImage($dest);
		$sourceImage = $this->openImage($source);
		if (!$destImage || !$sourceImage) {
			exit('无法打开图片文件！');
		}
		imagecopymerge($destImage, $sourceImage, $position['x'], $position['y'], 0, 0, $sourceWidth, $sourceHeight, $alpha);

		// 5)、保存图片
		$this->saveFile($destImage,$dest);

		// 6)、释放资源
		imagedestroy($sourceImage);
		imagedestroy($destImage);
	}


	public function zoom($imageFile,$width,$height)
	{
		// 1)、路径检测
		if (!file_exists($imageFile)) {
			exit('图片文件不存在!');
		}

		// 2)、计算缩放尺寸
		list($oldWidth,$oldHeight) = getimagesize($imageFile);
		$size = $this->computeScale($oldWidth,$oldHeight,$width,$height);

		// 3)、合并图片
		$oldImage = $this->openImage($imageFile);
		$destImage = imagecreatetruecolor($width, $height);
		$this->merageImage($destImage,$oldImage,$size,$oldWidth, $oldHeight);
		

		// 4)、保存图片
		$this->saveFile($destImage,$imageFile);
		// 5)、释放资源
		imagedestroy($oldImage);
		imagedestroy($destImage);

	}

	protected function merageImage($destImage,$oldImage,$size,$oldWidth, $oldHeight)
	{
		//获取原图片的透明色
		$alphaColor = imagecolortransparent($oldImage);
		 // var_dump($alphaColor);
		if ($alphaColor < 0) {
			//指定目标图片中黑色是透明色
			$alphaColor = imagecolorallocate($destImage, 0, 0, 0);
		}
		 // var_dump($alphaColor);
		imagefill($destImage, 0, 0, $alphaColor);
		imagecolortransparent($destImage,$alphaColor);

		imagecopyresampled($destImage, $oldImage, $size['x'], $size['y'], 0, 0, $size['newWidth'], $size['newHeight'], $oldWidth, $oldHeight);
	}

	protected function computeScale($oldWidth,$oldHeight,$width,$height)
	{
		$widthScale = $width / $oldWidth;
		$heightScale = $height / $oldHeight;

		$minScale = min($widthScale,$heightScale);
		$newWidth  = $oldWidth * $minScale;
		$newHeight = $oldHeight * $minScale;

		if ($widthScale < $heightScale) {
			$y = ($height - $newHeight) / 2;
			$x = 0;
		} else {
			$y = 0;
			$x = ($width - $newWidth)/2;
		}
		return ['newWidth'=>$newWidth,'newHeight'=>$newHeight,'x'=>$x,'y'=>$y];

	}
	protected function saveFile($image,$originFile)
	{
		if ($this->isRandFile) {
			$path = $this->saveDir . uniqid() .'.'. $this->imageType;
		} else {
			$path = $this->saveDir . pathinfo($originFile)['filename'].'.'.$this->imageType;
		}
		$funcName = 'image' . $this->imageType;
		// var_dump($path,$funcName);die;
		if (function_exists($funcName)) {
			$funcName($image,$path);
		} else {
			exit('图片无法保存！');
		}
	}

	protected function openImage($imageFile)
	{
		//image
		$type = exif_imagetype($imageFile);

		$types = [0,'gif','jpeg','png','swf','psd','wbmp'];
		
		$funcName = 'imagecreatefrom'. $types[$type];

		if (function_exists($funcName)) {
			return $funcName($imageFile);
		}
		return false;
	}
	protected function getPosition($destWidth,$destHeight,$sourceWidth,$sourceHeight,$pos)
	{
		if ($pos < 1 || $pos > 9) {
			$x = rand(0,$destWidth-$sourceWidth);
			$y = rand(0,$destHeight-$sourceHeight);
		} else {
			$x = ($pos -1)%3 * ($destWidth - $sourceWidth) / 2;
			$y = (int)(($pos-1)/3) * ($destHeight - $sourceHeight) / 2;
		}
		return ['x' => $x,'y' => $y];
	}

	/**
	 * 转换图片格式
	 *
	 * @param      <type>  $imageType  用户给的图片格式
	 */
	protected function getImageType($imageType)
	{
		$types = [
			'jpg' => 'jpeg',
			'pjpeg' => 'jpeg',
			'bmp' => 'wbmp'
		];
		if (array_key_exists($imageType, $types)) {
			$imageType = $types[$imageType];
		}
		return $imageType;
	}

	/**
	 * [checkDir 检测目录]
	 * @param  [type] $dir [目录名]
	 * @return [type]      [description]
	 */
	protected function checkDir($dir)
	{
		//不是目录则创建
		if (!is_dir($dir)) {
			return mkdir($dir,0777,true);
		}
		//检测目录是否具有读写权限
		if (!is_readable($dir) || !is_writable($dir)) {
			chmod($dir, 0777);
		}
		return true;
	}

	/**
	 * [replaceSeperator 替换目录中的反斜线为正斜线]
	 * @param  [type] $dir [目录名]
	 * @return [type]      [返回替换后的目录名]
	 */
	protected function replaceSeperator($dir)
	{
		// 4/demo/  4\demo  4\demo\
		$dir = str_replace('\\', '/', $dir);
		$dir = rtrim($dir,'/') .'/';
		return $dir;
	}
}