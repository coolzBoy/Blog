<?php

namespace cz\framework;

class Template
{
	protected  $tplDir = './view';    //模板文件目录
	protected  $cacheDir ='./cache';  //缓存路径
	protected  $vars   =[];//变量数组
	protected $expireTime = 3600*24;

	public function __construct($cacheDir='./cache',$tplDir='./view',$expireTime = 3600)
	{
		$this->tplDir = $this->checkDir($tplDir);
		$this->cacheDir = $this->checkDir($cacheDir);
		$this->expireTime = $expireTime;
	}

	/**
	 * [assign 分配变量]
	 * @param  [type] $name  [变量名]
	 * @param  [type] $value [变量值]
	 * @return [type]        [没有]
	 */
	public function assign($name,$value)
	{
		$this->vars[$name] = $value;
	}


	/**
	 * [display 编译模板文件，加载缓存文件，显示]
	 * @param  [type] $viewFile  [模板文件名]
	 * @param  [type] $isExtract [是否还原变量]
	 * @return [type]            [无]
	 */
	public function display($viewFile,$isExtract=true)
	{
		//1 拼接模板文件和缓存文件的路径
		$tplFile = $this->tplDir . $viewFile;
		$cacheFile = $this->joinCachePath($viewFile);
		//2 检测模板文件是否存在
		if (!file_exists($tplFile)) {
			exit('模板文件不存在！');
		}

		//3 编译模板文件
		//3.1模板文件不存在或者模板文件修改时间晚于缓存文件创建时间
		if(!file_exists($cacheFile)||
			filectime($cacheFile) < filemtime($tplFile)||
			filectime($cacheFile) + $this->expireTime < time()
			)
		{
			// index/index.html
			$this->checkDir(dirname($cacheFile));
			$content =  $this->compile($tplFile);
			file_put_contents($cacheFile, $content);
		} else {
			$this->updateInclude($tplFile);
		}
		

		//4 分配变量。加载缓存
		if ($isExtract) {
			extract($this->vars);
			include $cacheFile;
		}

	}

	protected function updateInclude($tplFile)
	{
		//读取模板文件内容
		$content = file_get_contents($tplFile);
		$pattern = '/\{include (.+)\}/';
		preg_match_all($pattern, $content, $matches);
		foreach ($matches[1] as $key => $value) {
			$value = trim($value ,'\'"');
			$this->display($value,false);
		}
	}

	protected function compile($fileName)
	{
		//读文件内容
		$content = file_get_contents($fileName);
		$rule = [
				'{$%%}' => '<?=$\1; ?>',
				'{if %%}' => '<?php if \1: ?>',
				'{else}' => '<?php else: ?>',
				'{elseif %%}'   	=> '<?php elseif(\1):?>',
				'{else if %%}'  	=> '<?php elseif(\1):?>',
				'{/if}' => '<?php endif; ?>',
				'{include %%}' => '<?php include "\1"; ?>',
				'{switch %%}' => '<?php switch \1: ?>',
				'{case %%}' => '<?php case \1: ?>',
				'{break}' => '<?php break; ?>',
				'{default}' => '<?php default; ?>',
				'{/switch}' => '<?php endswitch; ?>',
				'{foreach %%}' => '<?php foreach (\1): ?>',
				'{/foreach}'   	=> 	'<?php endforeach; ?>',
				'{for %%}' => '<?php for \1: ?>',
				'{/for}' => '<?php endfor; ?>',
				'__%%__' 	 => '<?=\1;?>',
				'{while %%}'		=> '<?php while(\1):?>',
				'{/while}'			=> '<?php endwhile;?>',
				'{continue}'		=> '<?php continue;?>',
				'{$%%++}'			=> '<?php $\1++;?>',
				'{$%%--}'			=> '<?php $\1--;?>',
				'{/*}'				=> '<?php /*',
				'{*/}'				=> '*/?>',
				'{section}'			=> '<?php ',
				'{/section}'		=> '?>',
				'{$%% = $%%}'		=> '<?php $\1 = $\2;?>',
		];
	
		foreach ($rule as $key => $value) {
			$key = preg_quote($key,'/');
			$pattern = '/'.str_replace('%%', '(.+)', $key) . '/U';
			if (stripos($key,'include')) {
				$content = preg_replace_callback($pattern, [$this,'parseInclude'], $content);
			} else {
				$content = preg_replace($pattern, $value, $content);
			}
		}
		return $content;
	}

	protected function parseInclude($data)
	{
		$file = trim($data[1],'\'"');
		
		$this->display($file,false);//编译模板文件，不还原变量
		$cacheFile = $this->joinCachePath($file);//缓存文件的路径
		return "<?php include '$cacheFile';?>";
	}

	//index.html  index_html.php
	protected function joinCachePath($viewFile)
	{
		return $this->cacheDir . str_replace('.', '_', $viewFile).'.php';
	}
	protected function checkDir($dir)
	{
		$dir = str_replace('\\','/', $dir);
		$dir = rtrim($dir,'/') . '/';
		$flag = true;
		if (!is_dir($dir)) {
			$flag =  mkdir($dir,0777,true);
		} else if (!is_readable($dir) || !is_writable($dir)) {
			$flag =  chmod($dir, 0777);
		}
		if (!$flag) {
			exit('目录不存在或不可写');
		}
		return $dir;
	}

}