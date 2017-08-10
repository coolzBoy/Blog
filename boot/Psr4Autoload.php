<?php

class Psr4Autoload
{
	protected $maps = [];
	public function __construct(array $config=null)
	{
		if(!empty($config)){
			$this->maps=$config;
		}
		//向系统注册自己自动加载方法
		spl_autoload_register([$this,'loadClass']);
	}

	protected function loadClass($className)
	{
		//取出类名
		$arr = explode('\\', $className);
		$className = array_pop($arr);
		//取出命名空间
		$namespace = join('\\',$arr);
		//加载映射关系
		
		$this->loadMap($namespace,$className);

	}
	/**
	 * 把命名空间变成目录，加载类文件
	 * @param  [type] $namespace [命名空间]
	 * @param  [type] $realClass [类名]
	 * @return [type]            [无]
	 */
	protected function loadMap($namespace,$className)
	{
		//如果命名空间存在在映射表中，直接取得目录
		if(array_key_exists($namespace, $this->maps))
		{
			$path = $this->maps[$namespace];
		}else{//如果不存在，直接把命名空间当做目录名
			$path = str_replace('\\','/',$namespace);
		}
		$path = rtrim($path,'/').'/';
		$path.=$className.'.php';
		if(file_exists($path)){
			include $path;
		}else{
			exit($path.'文件不存在！');
		}

	}

	public function addNamespace($namespace,$className)
	{
		$namespace = trim(str_replace('/','\\',$namespace),'\\');
		$className = trim(str_replace('\\','/',$className),'/');
		if (array_key_exists($namespace, $this->maps)) {
			exit("命名空间已经存在映射表中");
		}
		$this->maps[$namespace] = $realPath;

	}


}