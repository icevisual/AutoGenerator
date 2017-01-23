<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Exceptions\ServiceException;

class ApiTest extends TestRoutes
{

    public function testA()
    {
        
        $ret = $this->api_auto_attrs_create([
            'attr_name' => 'asdad', //Varchar 属性名字
            'attr_name_cn' => 'safsadf', //Varchar 显示中文名
            'attr_type' => 'asdf', //Varchar 属性类别
            'form_type' => 'asdfadfs', //Varchar 表单控件类别
        ]);
        
        $this->output($ret);
        
        $ret = $this->api_auto_attrs_delete([
            'attr_name' => 'asdad', //Varchar 属性名字
            'attr_name_cn' => 'safsadf', //Varchar 显示中文名
            'attr_type' => 'asdf', //Varchar 属性类别
            'form_type' => 'asdfadfs', //Varchar 表单控件类别
        ]);
        
        $this->output($ret);
        
        exit;
        $ret = $this->outer_api_save_form_component([
            'name' => 'ddddd',
            'components' => [
                [
                    'id' => '12',
                    'attrs' => [
                        [
                            'attrId' => '132',
                            'defaultValue' => 'ad'
                        ],
                        [
                            'attrId' => '123',
                            'defaultValue' => ''
                        ]
                    ]
                ]
            ]
        ]);
        
        $this->output($ret);
        
        $ret = $this->outer_api_query_forms();
        $this->output($ret);
        
        $ret = $this->outer_api_forms_detail([
            'id' => '2', //String 属性名称-中文
        ]);
        $this->output($ret);
        
        // $this->assertCodeEqual($ret, \ErrorCode::STATUS_OK);
        // $this->assertEquals(count(array_get($ret, 'data')), 1);
    }
    
    
    
    
}
