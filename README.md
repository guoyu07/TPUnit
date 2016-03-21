# TPUnit

ThinkPHP PHPUnit框架集成

## 1. 初始配置

为了减少学习成本，建议使用像Netbeans这样的IDE来设定PHPUnit的基本环境。

通过Netbeans的操作界面，可以直接了解PHPUnit使用过程的一些核心概念。

  * [基于Netbeans的PHPUnit环境配置](http://www.cnblogs.com/x3d/p/phpunit-in-netbeans8.html)
  * ```git clone git@github.com:web3d/TPUnit.git```  到ThinkPHP的Vendor目录下


## 2. 开始

将TPUnit中demo目录下的bootstrap.php文件复制到你的tests目录下。

在上一步的配置过程中，有一个“使用引导”的地方记得勾选并指定bootstrap.php文件所在目录。

由于ThinkPHP框架中坑爹的.class.php后缀名，导致NB中无法直接指定要测试的类文件自动生成测试方法骨架。

可以临时给文件改名去掉.class然后利用NB快速生成测试代码骨架。

## 3. 支持的特性

### 3.1 基本的Unit

最经典的例子：

参看上面的参考配置文档中：[基于Netbeans的PHPUnit环境配置](http://www.cnblogs.com/x3d/p/phpunit-in-netbeans8.html)

### 3.2 DBUnit

参看本项目demo目录 /demo/Application/Common/Model/UrlModelTest.php 文件。

DBUnit主要由四种断言构成，目前已支持TP对这四种断言的支持：

* 对表中数据行的数量作出断言
* 对表的状态作出断言
* 对查询的结果作出断言
* 对多个表的状态作出断言

具体请查看<https://github.com/web3d/TPUnit/blob/master/demo/Application/Common/Model/UrlModelTest.php>