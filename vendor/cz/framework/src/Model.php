<?php

namespace cz\framework;

class Model
{
	protected $host;        //主机地址
	protected $user;        //用户名
	protected $pwd;         	//密码
	protected $dbName;      //数据库名
	protected $charset;     //字符集
	protected $prefix;      //表前缀
	protected $cacheDir;    //数据库缓存目录
	protected $cacheField;  //缓存字段
	protected $link;        	//数据库连接
	protected $sql;         //sql语句
	
	protected $table;

	protected $options;
	
    public function __construct(array $config=null)
    {
    	$config = include './config/database.php';
    	$this->host = $config['DB_HOST'];
    	$this->user =$config['DB_USER'];
    	$this->pwd = $config['DB_PWD'];
    	$this->dbName = $config['DB_NAME'];
    	$this->charset = $config['DB_CHARSET'];
    	$this->prefix = $config['DB_PREFIX'];

    	$this->table = $this->getTable();
    	$this->options = $this->initOptions();
    	$this->link = $this->sql_connect();

    	$cache= $config['DB_CACHE'];
    	if($this->checkDir($cache)){
    		$this->cacheDir = $cache;
    	}else{
    		exit('缓存目录不存在！');
    	}

    	$this->cacheField = $this->initCache();

    }
    //初始化参数数组
	protected function initOptions()
	{
		return [
				'field'=>'*',
				'table'=>$this->table,
				'where'=>'',
				'group'=>'',
				'order'=>'',
				'having'=>'',
				'limit'=>'',
				'values'=>''

				];	

	}
	protected function initCache()
	{
		//获取缓存的表字段文件路径
		$path = rtrim($this->cacheDir,'/').'/'.$this->table.'.php';
		if(file_exists($path)){
			return include $path;
		}
		//查表结构获取所有字段名
		$sql = ' desc '. $this->table;
		// $data = $this->query($sql,MYSQLI_ASSOC);
		$result = mysqli_query($this->link,$sql);
		
		while($rows = mysqli_fetch_assoc($result)){
			//把主键也添加到数组
			if($rows['Key'] == 'PRI'){
				$field['PRI'] = $rows['Field'];
			}
			$field[] = $rows['Field'];

		}
		//生成字段数组语法形式
		$str = "<?php \n return ".var_export($field,true).';';

		file_put_contents($path,$str);

		return $field;
	}
	/**
	 * 获取表名
	 * @return [type] [description]
	 */
	protected function getTable()
	{
		//判断是否有默认值
		if(!empty($this->table))
		{
			return $this->prefix.$this->table;
		}
		//从类名获得表名
		//获取当前对象的类名，并且转换为小写
		$className = strtolower(get_class($this));
		//app\index\UserModel
		//用反斜线分割类名
		$className = explode('\\',$className);
		$className= array_pop($className);
		if(stripos($className, 'model') === false){
			return $this->prefix.$className;
		}
		$table = substr($className,0,-5);
		return $this->prefix.$table;
	}
	/**
	 * 检查缓存目录，如果不存在就创建该目录
	 * @param  [type] $dir [description]
	 * @return [type]      [description]
	 */
	protected function checkDir($dir)
	{
		if(!is_dir($dir)){
			return mkdir($dir,0777,true);
		}
		if(!is_readable($dir) || !is_writable($dir))
		{
			return chmod($dir, 0777);
		}
		return true;
	}

    /**
     * 连接数据库
     * @return [type] [description]
     */
    public function sql_connect()
    {
    	$link = mysqli_connect($this->host,$this->user,$this->pwd);
    	if(!$link){
    		exit('连接数据库失败！');
    	}
    	if(!mysqli_select_db($link,$this->dbName)){
    		mysqli_close($link);
    		exit('选择数据库失败！');
    	}
    	if(!mysqli_set_charset($link,$this->charset))
    	{
    		mysqli_close($link);
    		exit('设置字符集失败！');
    	}
    	return $link;

    }
    //联表查询
    public function table(string $table)
    {
    	//"user,php_blog"
    	$tables = explode(',',$table);
    	foreach ($tables as $key => $value) {
    		$tbName = ltrim($value,$this->prefix);
    		$tbName = $this->prefix.$tbName;
    		$tables[$key] = $tbName;
    	}
    	$this->options['table'] = join(',',$tables);
    	return $this;
    }
    /**
	 * 获取查询条件
	 * @param  [type] $where [查询条件]
	 * @return [type]        [返回查询条件]
	 */
	public function where($where)
	{
		//['uid=0','name=aa']
		if(is_string($where))
		{
			$this->options['where'] = ' where '.$where;
		}else if(is_array($where)){
			$this->options['where'] = ' where '.join(' and ',$where);
		}
		return $this;
	}
	/**
	 * 获取分组条件
	 * @param  [type] $group [分组条件]
	 * @return [type]        [返回分组条件]
	 */
	public function group($group)
	{
		if(is_string($group))
		{
			$this->options['group'] = ' group by '.$group;
		}else if(is_array($group)){
			$this->options['group'] = ' group by '.join(',',$group);
		} 
		return $this;
	}
	/**
	 * 获取排序条件
	 * @param  [type] $order [排序条件]
	 * @return [type]        [返回排序条件]
	 */
	public function order($order)
	{
		if(is_string($order))
		{
			$this->options['order'] = ' order by '.$order;
		}else if(is_array($order)){
			$this->options['order'] = ' order by '.join(',',$order);
		} 
		return $this;
	}
	/**
	 * 获取分组过滤条件
	 * @param  [type] $having [分组过滤条件]
	 * @return [type]         [返回分组过滤条件]
	 */
	public function having($having)
	{
		if(is_string($having))
		{
			$this->options['having'] = ' having '.$having;
		}else if(is_array($having)){
			$this->options['having'] = ' having '.join(' and ',$having);
		}
		return $this;
	}
	/**
	 * 获取limit条件
	 * @param  [type] $limit [limit条件]
	 * @return [type]        [返回limit条件]
	 */
	public function limit($limit)
	{
		if(is_string($limit))
		{
			$this->options['limit'] = ' limit '.$limit;
		}else if(is_array($limit)){
			$this->options['limit'] = ' limit '.join(',',$limit);
		} 
		return $this;
	}
	/**
	 * 获取字段列表
	 * @param  [type] $field [字段列表]
	 * @return [type]        [返回字段列表]
	 */
	public function field($field)
	{
		if(is_string($field))
		{
			$this->options['field'] = $field;
		}else if(is_array($field)){
			$this->options['field'] = join(',',$field);
		} 
		return $this;
	}

	/**
	 * 查询数据库
	 * @param  [type] $resultType [查询结果类型]
	 * @return [type]             [返回查询结果集]
	 */
	public function select($resultType= MYSQLI_BOTH)
	{
		//select uid,username from bbs_user where uid<100 group by uid having uid>0 order by uid limit 5";
		$sql = 'SELECT  %FIELD%  FROM  %TABLE%  %WHERE%  %GROUP%  %HAVING%  %ORDER%  %LIMIT%';

		$sql = str_replace(
							['%FIELD%','%TABLE%','%WHERE%','%GROUP%','%HAVING%','%ORDER%','%LIMIT%'], 

							[ $this->options['field'],
							  $this->options['table'],
							  $this->options['where'],
							  $this->options['group'],
							  $this->options['having'],
							  $this->options['order'],
							  $this->options['limit'],
							  
							],$sql);
		return $this->query($sql,$resultType);	
	}
	/**
	 * 执行sql语句，并返回查询结果
	 * @param  [type] $sql        [sql语句]
	 * @param  [type] $resultType [查询结果类型]
	 * @return [type]             []
	 */
	public function query($sql,$resultType)
	{
		//给sql赋值
		$this->sql = $sql;
		//清空参数数组
		$this->options=$this->initOptions();
		//执行sql语句
		$result = mysqli_query($this->link,$sql);
		if($result && mysqli_affected_rows($this->link)>0){
			return mysqli_fetch_all($result,$resultType);
		}
		return false;
		
	}
	public function delete()
	{
		$sql = "DELETE FROM %TABLE% %WHERE%  %ORDER%  %LIMIT%";
		$sql = str_replace(['%TABLE%','%WHERE%','%ORDER%','%LIMIT%'],
						   [
						   	  $this->options['table'],
							  $this->options['where'],
							  $this->options['order'],
							  $this->options['limit']

						   ],$sql);
		// var_dump($sql);die;
		return $this->exec($sql);

	}
	/**
	 * 更新数据库
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function update(array $data)
	{
		//给字符数据添加单引号
		$data = $this->addQuote($data);
		
		//过滤无效字段
		$data = $this->validField($data);
		//拼接修改字段数组值为字符串
		$data = $this->setString($data);
		$this->options['values'] = $data;
		$sql = "UPDATE  %TABLE% SET  %VALUES%  %WHERE%  %ORDER%  %LIMIT% ";

		$sql = str_replace( ['%TABLE%','%VALUES%','%WHERE%','%ORDER%','%LIMIT%'], 
							[
							  $this->options['table'],
							  $this->options['values'],
							  $this->options['where'],
							  $this->options['order'],
							  $this->options['limit']

							],$sql);

		return $this->exec($sql);

	}
	//拼接修改字段数组值为字符串
	protected function setString($data)
	{
		$str = '';
		foreach ($data as $k => $v) {
			$str .= $k.'='.$v.',';
		}
		return rtrim($str,',');
	}
	/**
	 * 向数据库插入数据
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function insert(array $data,$isInsertId = false)
	{
		//给字符数据添加单引号
		$data = $this->addQuote($data);
		
		//过滤无效字段
		$data = $this->validField($data);
		//拼接插入的字段
		$this->options['field']= join(',',array_keys($data));
		//拼接插入的值
		$this->options['values'] = join(',',array_values($data));
		$sql = 'INSERT INTO %TABLE%(%FIELD%) VALUES(%VALUES%)';

		$sql = str_replace(
							['%TABLE%','%FIELD%','%VALUES%'],

							[
							  $this->options['table'],
							  $this->options['field'],
							  $this->options['values'],

							], $sql);
		return $this->exec($sql,$isInsertId);

	}

	//给字符数据添加单引号
	protected function addQuote($data)
	{
		if(is_array($data)){
			foreach ($data as $key => $value) {
				if(is_string($value))
				{
					$data[$key] = "'$value'";
				}
			}
		}
		return $data;
	}
	//过滤无效的字段
	protected function validField($data)
	{
		//['id' =>1,'username' => 'aa']
  		//0 => 'id',1 => 'username',
  		//将缓存的表字段键值对调
		$field = array_flip($this->cacheField);
		
		//使用键名比较计算数组的交集
		$data = array_intersect_key($data, $field);
		return $data;
	}
	/**
	 * 执行增删改语句
	 * @param  [type]  $sql        [sql语句]
	 * @param  boolean $isInsertId [是否返回自增主键的值]
	 * @return [type]              [如果执行成功，isInsertId为真，返回主键值，否则返回true，失败返回false]
	 */
	public function exec($sql,$isInsertId= false)
	{
		//给sql赋值
		$this->sql = $sql;
		//清空参数数组
		$this->options=$this->initOptions();
		//执行sql语句
		$result = mysqli_query($this->link,$sql);
		if($result && $isInsertId){
			//返回插入位置的主键id的值
			return mysqli_insert_id($this->link);
		}
		return $result;
	}
	/**
	 * 魔术方法实现不可访问方法getBy__
	 * @param  [type] $name  [方法名]
	 * @param  [type] $value [参数值]
	 * @return [type]        [description]
	 */
	public function __call($name,$value)
	{	
		if(substr($name,0,5) == 'getBy'){
			$name = substr($name, 5);
			return $this->getBy($name,$value);
		}

	}
	/**
	 * [根据字段获取记录]
	 * @param  [type] $name  [字段名]
	 * @param  [type] $value [字段值]
	 * @return [type]        [记录的关联数组]
	 */
	protected function getBy($name,$value)
	{
		$name = strtolower($name);
		if(count($value)>0){
			if(is_string($value[0])){
				$this->options['where'] = 'where '.$name.'='."'".$value[0]."'";
			}else{
				$this->options['where'] = 'where '.$name.'='.$value[0];
			}

			return $this->select(MYSQLI_ASSOC);	
		}

	}
	 /**
     * 获取最后执行的sql
     * @param  [type] $name [属性名]
     * @return [type]       [返回sql]
     */
    public function __get($name)
    {
    	if ('sql' ==$name) {
    		return $this->sql;
    	}
    }

    // 1 实现find方法，只返回查询结果的第一条语句
	public function find()
	{
		return $this->order('id')->limit('1')->select(MYSQLI_ASSOC);
	}
	
	// 2 实现setField(字段名,字段值),更新特定记录的指定字段的值
	public function setField($fieldName,$value)
	{
		if(is_string($value)){

			$this->options['values'] = $fieldName.'='."'".$value."'";
		}else{

			$this->options['values'] = $fieldName.'='.$value;		
		}
		$sql = "UPDATE  %TABLE% SET  %VALUES%  %WHERE%  %ORDER%  %LIMIT% ";

		$sql = str_replace( ['%TABLE%','%VALUES%','%WHERE%','%ORDER%','%LIMIT%'], 
							[
							  $this->options['table'],
							  $this->options['values'],
							  $this->options['where'],
							  $this->options['order'],
							  $this->options['limit']

							],$sql);

		return $this->exec($sql);
	}

}
