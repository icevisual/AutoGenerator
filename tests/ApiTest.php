<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Exceptions\ServiceException;

class ApiTest extends TestRoutes
{

    public function testA()
    {
        $ret = $this->outer_api_save_form_component([
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
        
        // $this->assertCodeEqual($ret, \ErrorCode::STATUS_OK);
        // $this->assertEquals(count(array_get($ret, 'data')), 1);
    }
}
