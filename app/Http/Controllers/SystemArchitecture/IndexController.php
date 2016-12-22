<?php
namespace App\Http\Controllers\SystemArchitecture;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class IndexController extends Controller
{

    public function formConfig()
    {
        $data = [
            'formConfig' => [
                'accessKey' => [
                    'name' => '开发者 AccessKey',
                    'validate' => [
                        'rules' => 'required|max:20',
                        'message' => [
                            'require' => '请填写 开发者 AccessKey'
                        ]
                    ],
                    'type' => 'input',
                    'attrs' => [
                        'type' => 'text',
                        'placeholder' => '开发者 AccessKey'
                    ],
                    'value' => ''
                ],
                'accessSecret' => [
                    'name' => '开发者 AccessSecret',
                    'validate' => [
                        'rules' => 'required|max:20',
                        'message' => [
                            'require' => '请填写 开发者 AccessSecret'
                        ]
                    ],
                    'type' => 'input',
                    'attrs' => [
                        'type' => 'text'
                    ],
                    'value' => 'POVX1lgIvo8q1KHYpoD9'
                ],
                'logLevel' => [
                    'name' => '日志级别',
                    'type' => 'select',
                    'value' => 'debug',
                    'attrs' => [
                        'multiple' => 'multiple'
                    ],
                    'data' => [
                        '0' => [
                            'value' => 'debug',
                            'text' => 'debug'
                        ],
                        '1' => [
                            'value' => 'info',
                            'text' => 'info'
                        ],
                        '2' => [
                            'value' => 'notice',
                            'text' => 'notice'
                        ],
                        '3' => [
                            'value' => 'warning',
                            'text' => 'warning'
                        ],
                        '4' => [
                            'value' => 'error',
                            'text' => 'error'
                        ]
                    ]
                ],
                'env' => [
                    'name' => '环境',
                    'type' => 'select',
                    'value' => 'local',
                    'data' => [
                        '0' => [
                            'value' => 'local',
                            'text' => '本地(192.168.5.61:8083)'
                        ],
                        '1' => [
                            'value' => 'test',
                            'text' => '测试(121.41.33.141:8083)'
                        ],
                        '2' => [
                            'value' => 'production',
                            'text' => '正式(120.26.109.169:8083)'
                        ]
                    ]
                ]
            ]
        ];
        
        return \Response::json([
            'code' => 1,
            'msg' => 'ok',
            'data' => $data
        ]);
        
    }

    public function sidebarMenu()
    {
        $data = [
            [
                'group' => 'MAIN NAVIGATION',
                'menus' => [
                    [
                        'icon' => 'fa-dashboard',
                        'title' => 'Dashboard',
                        'active' => true,
                        'submenus' => [
                            [
                                'active' => true,
                                'href' => '/list',
                                'icon' => 'fa-circle-o',
                                'title' => 'List Demo'
                            ],
                            [
                                'href' => '/form',
                                'icon' => 'fa-circle-o',
                                'title' => 'Form Demo'
                            ]
                        ]
                    ],
                    [
                        'icon' => 'fa-files-o',
                        'title' => 'Layout Options',
                        'submenus' => [
                            [
                                'href' => '../../index.html',
                                'icon' => 'fa-circle-o',
                                'title' => 'Top Navigation'
                            ],
                            [
                                'href' => '../../index1.html',
                                'icon' => 'fa-circle-o',
                                'title' => 'Boxed'
                            ],
                            [
                                'href' => '../../index1.html',
                                'icon' => 'fa-circle-o',
                                'title' => 'Fixed'
                            ],
                            [
                                'href' => '../../index1.html',
                                'icon' => 'fa-circle-o',
                                'title' => 'Collapsed Sidebar'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        $aa = [
            'icon' => 'fa-files-o',
            'title' => 'Layout Options',
            'submenus' => [
                [
                    'href' => '../../index.html',
                    'icon' => 'fa-circle-o',
                    'title' => 'Top Navigation'
                ],
                [
                    'href' => '../../index1.html',
                    'icon' => 'fa-circle-o',
                    'title' => 'Boxed'
                ],
                [
                    'href' => '../../index1.html',
                    'icon' => 'fa-circle-o',
                    'title' => 'Fixed'
                ],
                [
                    'href' => '../../index1.html',
                    'icon' => 'fa-circle-o',
                    'title' => 'Collapsed Sidebar'
                ]
            ]
        ];
        for ($i = 0; $i < 10; $i ++) {
            $data[0]['menus'][] = $aa;
        }
        return \Response::json([
            'code' => 1,
            'msg' => 'ok',
            'data' => $data
        ]);
    }
}


