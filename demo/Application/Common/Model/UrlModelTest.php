<?php

/* 
 * Created Datetime:2016-3-11 11:01:24
 * Creator:Jimmy Jaw <web3d@live.cn>
 * Copyright:TimeCheer Inc. 2016-3-11 
 * 
 */

namespace TimeCheer\OAO\UnitTest;

use TimeCheer\Test\Database\TestCase;
use TimeCheer\Test\Database\ArrayDataSet;

/**
 * Demo 演示Model的功能操作的测试
 */
class UrlModelTest extends TestCase
{
    protected function getDataSet()
    {
        return new ArrayDataSet([
            'url' => [
                ['url' => 'http://www.baidu.com', 'create_time' => time()],
                ['url' => 'http://www.baidux.com', 'create_time' => time()],
            ],
        ]);
    }
    
    /**
     * 对表中数据行的数量作出断言
     */
    public function testAddEntry()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('url'), "Pre-Condition");

        $model = M('url');
        $model->add(['url' => 'http://www.163.com', 'create_time' => time()]);

        $this->assertEquals(3, $model->count(), "Inserting failed");
    }
    
    /**
     * 对表的状态作出断言
     */
    public function testAddEntryFully()
    {
        
        $model = M('url');
        $model->add(['url' => 'http://www.163.com', 'create_time' => time()]);
        
        $queryTable = $this->getConnection()->createQueryTable(
                'url', 'SELECT id, url FROM wp_url'
        );

        $expectedTable = $this->createFlatXmlDataSet(TEST_ROOT . "/data/expected_url.xml")
                              ->getTable("url");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }
    
    /**
     * 对查询的结果作出断言
     */
    public function testComplexQuery()
    {
        $queryTable = $this->getConnection()->createQueryTable(
            'myComplexQuery', 'SELECT complexQuery...'
        );
        $expectedTable = $this->createFlatXmlDataSet("complexQueryAssertion.xml")
                              ->getTable("myComplexQuery");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }
    
    /**
     * 对多个表的状态作出断言
     * 从数据库连接建立数据库数据集，并将其与基于文件的数据集进行比较
     */
    public function testCreateDataSetAssertion()
    {
        $dataSet = $this->getConnection()->createDataSet(array('guestbook'));
        $expectedDataSet = $this->createFlatXmlDataSet('guestbook.xml');
        $this->assertDataSetsEqual($expectedDataSet, $dataSet);
    }
    
    /**
     * 对多个表的状态作出断言
     * 自行构造数据集
     */
    public function testManualDataSetAssertion()
    {
        $dataSet = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet();
        $dataSet->addTable('guestbook', 'SELECT id, content, user FROM guestbook'); // additional tables
        $expectedDataSet = $this->createFlatXmlDataSet('guestbook.xml');

        $this->assertDataSetsEqual($expectedDataSet, $dataSet);
    }

}