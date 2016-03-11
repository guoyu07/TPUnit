<?php

/*
 * Created Datetime:2016-3-11 10:45:05
 * Creator:Jimmy Jaw <web3d@live.cn>
 * Copyright:TimeCheer Inc. 2016-3-11 
 * 
 */

namespace TimeCheer\Test;

/**
 * 用于将单元测试代码的命名空间注册到自动加载机制
 */
class Loader
{

    private $dir;

    const PREFIX = 'TimeCheer\OAO\UnitTest\\';

    /**
     * 构造函数
     * @param string $dir 手动指定起始目录
     */
    public function __construct($dir)
    {
        $this->dir = $dir;
    }

    /**
     * 向PHP注册SPL autoloader
     * @param string $dir 指定加载目录
     * @return void
     */
    public static function register($dir)
    {
        ini_set('unserialize_callback_func', 'spl_autoload_call');

        spl_autoload_register(array(new self($dir), 'autoload'), FALSE, TRUE);
    }

    /**
     * 系统自动注册
     *
     * @param string $class 类名
     *
     * @return boolean 正常加载返回true
     */
    public function autoload($class)
    {
        if (0 !== strpos($class, self::PREFIX)) {
            return false;
        }

        if (file_exists($file = $this->dir . '/' . str_replace('\\', '/', str_replace(self::PREFIX, '', $class)) . '.php')) {
            require_once $file;

            return true;
        }

        return false;
    }

}
