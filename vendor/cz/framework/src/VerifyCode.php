<?php

namespace cz\framework;
 
class VerifyCode
{
	protected $width = 100;
	protected $height = 40;
	protected $code;//验证码字符串内容
	protected $length=4;//字符个数
	protected $canvas;//画布
	protected $imageType = 'png';//图片类型

	public function __construct($width=100,$height=40,$length=4,$imageType='png')
	{
		$this->width = $width <= 0?$this->width:$width;
		$this->height = $height <= 0?$this->height:$height;
		$this->length = ($length <3 || $length>6)?$this->length:$length;
		$this->imageType = $this->getImageType($imageType);

	}
	/**
	 * 获取验证码上的内容
	 * @return [type] [description]
	 */
	public function getCode()
	{
		return $this->code;
	}
	/**
	 * 产生一个验证码
	 */
	public function outputCode()
	{
		// 1)、创建画布
		$this->createCanvas();

		// 2)、生成验证码字符串
		$this->createString();
		// 3)、将验证码字符串画到画布上
		$this->drawCode();
		// 4)、画干扰元素
		$this->drawDisturb();
		// 5)、发送验证码
		$this->sendCode();
		// 6)、释放资源
		$this->destory();
	}
	/**
	 * 销毁画布
	 * @return [type] [description]
	 */
	protected function destory()
	{
		imagedestroy($this->canvas);
	}
	/**
	 * 画干扰项
	 * @return [type] [description]
	 */
	protected function drawDisturb()
	{
		for ($i=0; $i <200 ; $i++) { 
			$x= rand(1,$this->width-1);
			$y= rand(1,$this->height-1);
			imagesetpixel($this->canvas, $x, $y,$this->randColor(1,127));
		}
	}
	/**
	 * 画字符串
	 * @return [type] [description]
	 */
	protected function drawCode()
	{
		for ($i=0; $i <$this->length ; $i++) { 
			$x= 10+$i*(int)(($this->width-5)/$this->length);
			$y =rand(5,$this->height-20);
			//水平地画一个字符
			imagechar($this->canvas,5,$x,$y,$this->code[$i],$this->randColor(0,127));
		}
	}
	/**
	 * 随机生成指定长度的字符串
	 * @return [type] [description]
	 */
	protected function createString()
	{
		$str = '';
		for ($i=0; $i <$this->length ; $i++) { 
			$str.=rand(0,9);
		}
		$this->code=$str;
	}
	/**
	 * 在浏览器显示画布
	 * @return [type] [description]
	 */
	protected function sendCode()
	{
		header("content-type:image/".$this->imageType);
		$funcName ='image'.$this->imageType;
		// var_dump($funcName,$this);exit;
		if(function_exists($funcName)){
			$funcName($this->canvas);
		}else{
			exit('不支持该图片类型！');
		}
	}
	/**
	 * 创建画布
	 * @return [type] [description]
	 */
	protected function createCanvas()
	{
		//创建画布
		$this->canvas = imagecreatetruecolor($this->width, $this->height);
		$color = $this->randColor(127,254);
		//区域填充
		imagefill($this->canvas,0,0,$color);

	}
	/**
	 * 产生一个随机颜色
	 * @param  [type] $low  [颜色上界]
	 * @param  [type] $high [颜色下界]
	 * @return [type]       [description]
	 */
	protected function randColor($low,$high)
	{
		//为一幅图像分配颜色
		return imagecolorallocate($this->canvas,rand($low,$high), rand($low,$high), rand($low,$high));

	}
	/**
	 * 获取图片颜色
	 * @param  [type] $imageType [description]
	 * @return [type]            [description]
	 */
	protected function getImageType($imageType)
	{
		$arr = [
				'jpg' => 'jpeg',
				'pjpeg' => 'jpeg',
				'bmp' => 'wbmp'
				];
		if(array_key_exists($imageType,$arr)){
			$imageType = $arr[$imageType];
		}
		return $imageType;
	}
}