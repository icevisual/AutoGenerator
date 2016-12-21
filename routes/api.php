<?php
use Illuminate\Http\Request;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/sidebar', [
    'as' => 'api_sidebar',
    'uses' => function (Request $request) {
        $data = [
            [
                'group' => 'MAIN NAVIGATION',
                'menus' => [
                    [
                        'icon' => 'fa-dashboard',
                        'title' => 'Dashboard',
                        'submenus' => [
                            [
                                'href' => '../../index.html',
                                'icon' => 'fa-circle-o',
                                'title' => 'Dashboard v1'
                            ],
                            [
                                'href' => '../../index1.html',
                                'icon' => 'fa-circle-o',
                                'title' => 'Dashboard v2'
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
]);


