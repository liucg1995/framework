<?php
/**
 * \View
 */
class View
{
    const VIEW_BASE_PATH = '/app/views/';
    const CACHE_PATH = BASE_PATH.'/cache';
    const VIEW_PATH = [BASE_PATH.'/app/views'];

    public $view;
    public $data;

    public function __construct($view)
    {
        $this->view = $view;
    }

    public static function make($viewName = null)
    {
        if ( ! $viewName ) {
            throw new InvalidArgumentException("视图名称不能为空！");
        } else {

            $viewFilePath = self::getFilePath($viewName);
            if ( is_file($viewFilePath) ) {
                return new View($viewFilePath);
            } else {
                throw new UnexpectedValueException("视图文件不存在！");
            }
        }
    }
    public static function getView(){
        $compiler = new \Xiaoler\Blade\Compilers\BladeCompiler(self::CACHE_PATH);
        $engine = new \Xiaoler\Blade\Engines\CompilerEngine($compiler);
        $finder = new \Xiaoler\Blade\FileViewFinder(self::VIEW_PATH);
        $factory = new \Xiaoler\Blade\Factory($engine,$finder);
        return $factory;
    }

    public function with($data)
    {
        foreach($data as $key => $value){
            $this->data[$key] = $value;
        }

        return $this;
    }

    private static function getFilePath($viewName)
    {
        $filePath = str_replace('.', '/', $viewName);
        return BASE_PATH.self::VIEW_BASE_PATH.$filePath.'.php';
    }

    public function __call($method, $parameters)
    {
        if (starts_with($method, 'with'))
        {
            return $this->with(snake_case(substr($method, 4)), $parameters[0]);
        }

        throw new BadMethodCallException("方法 [$method] 不存在！.");
    }
}