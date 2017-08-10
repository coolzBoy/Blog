<?php
namespace cz\framework;
class Upload
{
	protected $uploadDir = './upload';
	protected $isRandName = false;    //随机文件名
	protected $isdateDir  = false;    //日期目录
	protected $maxFileSize = 10*1024*1024; //最大文件大小为200K
	protected $uploadInfo;         //文件上传信息
	protected $errNo;   //错误号
	protected $uploadedPath;   //上传后的文件路径           
	protected $allowedSubfix = ['jpg','jpeg','bmp','png','gif'];//允许的文件后缀
	protected $allowedMIME = ['image/png','image/jpeg','image/bmp','image/gif'];

	//错误信息
	protected $error = [
		-1 => '没有上传信息',
		-2=>'上传目录不存在',
		-3 => '上传目录不具备读写权限',
		-4 =>'上传超过规定',
		-5 => '文件后缀不符合要求',
		-6 => '文件MIME类型不符合规定',
		-7 => '不是上传文件',
		0 => '上传成功',
		1 =>'上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值',
		2=>'上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值',
		3=>'文件只有部分被上传。',
		4=>'没有文件被上传。',
		6=>'找不到临时文件夹。PHP 4.3.10 和 PHP 5.0.3 引进',
		7=>'文件写入失败',

	];              
	//['uploadDir'=>'./upload/2017/06/14','isRandName'=>false]
	public function __construct(array $config = null)
	{
		if (!empty($config)) {
			foreach ($config as $key => $value) {
				//判断是否存在该属性
				if (property_exists(__CLASS__, $key)) {
					$this->$key = $value;
				}
			}
		}
		$this->uploadDir = $this->replaceSeperator($this->uploadDir);
	}

	/**
	 * [upload 文件上传]
	 * @param  [type] $key [表单中的input的name]
	 * @return [type]      [如果上传错误，返回false，
	 *         				如果成功，返回文件路径]
	 */
	public function upload($key)
	{
		// 1)、检查上传信息
		if (!$this->checkUploadInfo($key)) {
			return false;
		}

		// 2)、检查上传目录
		if (!$this->checkUploadDir($this->uploadDir)) {
			return false;
		}
		
		// 3)、检查标准上传错误
		if (!$this->checkSystemError()) {
			return false;
		}

		// 4)、检查自定义的错误(大小、后缀、MIME)
		if (!$this->checkCustomError()) {
			return false;
		}
		// 5)、判断是否是上传文件
		if (!$this->checkUploadedFile()) {
			return false;
		}
		// 6)、移动上传文件到指定目录
		if (!$this->checkMoveFile()) {
			return false;
		}
		return $this->uploadedPath;
	}

	protected function checkMoveFile()
	{
		//1 拼接目录
		$path = $this->uploadDir;
		if ($this->isdateDir) {
			$date = date('Y/m/d');//2017/06/14

			//如果不存在日期目录，则创建
			if (!is_dir($date)) {
				mkdir($date,0777,true);
			}
			
			//在上传目录下创建日期目录
			$path .= $date .'/';
		}

		//2 是否是随机文件名
		if ($this->isRandName) {
			$path .= uniqid() . '.'.$this->extName($this->uploadInfo['name']);
		} else {
			$path .= $this->uploadInfo['name'];
		}
		if (!move_uploaded_file($this->uploadInfo['tmp_name'], $path)) {
			$this->errNo = -8;
			return false;
		}
		$this->uploadedPath = $path;
		return true;

	}
	protected function extName($file)
	{
		return pathinfo($file)['extension'];
	}

	protected function checkUploadedFile()
	{
		if (!is_uploaded_file($this->uploadInfo['tmp_name'])) {
			$this->errNo = -7;
			return false;
		}
		return true;
	}

	protected function checkCustomError()
	{
		//1 检测文件大小是否超过规定
		if ($this->uploadInfo['size'] > $this->maxFileSize) {
			$this->errNo = -4;
			return false;
		}

		//检测文件后缀是否在规定范围内
		$extension = pathinfo($this->uploadInfo['name'])['extension'];
		if (!in_array($extension, $this->allowedSubfix)) {
			$this->errNo = -5;
			return false;
		}

		// mime类型检测
		if (!in_array($this->uploadInfo['type'], $this->allowedMIME)) {
			$this->errNo = -6;
			return false;
		}
		return true;
	}

	/**
	 * [checkSystemError 检测系统错误]
	 * @return [type] []
	 */
	protected function checkSystemError()
	{
		$this->errNo = $this->uploadInfo['error'];
		if ($this->errNo == 0) {
			return true;
		}
		return false;
	}

	/**
	 * [checkDir 检测目录]
	 * @param  [type] $dir [目录名]
	 * @return [type]      [description]
	 */
	protected function checkUploadDir($dir)
	{
		//不是目录则创建
		if (!is_dir($dir)) {
			if (!mkdir($dir,0777,true)) {
				$this->errNo = -2;
				return false;
			}
			return true;
		}
		//检测目录是否具有读写权限
		if (!is_readable($dir) || !is_writable($dir)) {
			if (!chmod($dir, 0777)) {
				$this->errNo = -3;
				return false;
			}
		}
		return true;
	}

	protected function checkUploadInfo($key)
	{
		//1 检测有没有上传信息
		if ($_FILES[$key]['error']) {
			$this->errNo = -1;
			return false;
		}
		//2 保存上传信息
		$this->uploadInfo = $_FILES[$key];
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