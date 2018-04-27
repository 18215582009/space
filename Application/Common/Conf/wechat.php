<?php
return array(
    'WECHAT' => array(
//         'token'          => TOKEN,
//         'encodingaeskey' => '',
//         'appid'          => 'wx7774b85f3ad548ab',
//         'appsecret'      => 'ce8704d751d45a58456a7a188b0acb3c',
        'token'          => TOKEN,
        'encodingaeskey' => '',
        'appid'          => 'wx6696fa86035df672',
        'appsecret'      => '593b33ad5595e7d721685a26b06e221f',
        'audit' => array(
            'success' => array(
                'touser'      => '',
                'template_id' => 'ksAXyX5mJyGqYn-l29fbA6AFxDulR79fMhAD8gIiWBk',
                'url'         => '',
                'topcolor'    => '',
                'data' => array(
                    'first'   => array(
                        'value' => '您分享的文章已审核', 
                        'color' => '',
                    ),
                    'keyword1'   => array(
                        'value' => '成功(文人空间)', 
                        'color' => '#173177',
                    ),
                    'keyword2'   => array(
                        'value' => '符合规范', 
                        'color' => '#173177',
                    ),
                    'remark' => array(
                        'value' => '',
                        'color' => '',
                    ),   
                ),
            ),
            'error' => array(
                'touser'      => '',
                'template_id' => 'ksAXyX5mJyGqYn-l29fbA6AFxDulR79fMhAD8gIiWBk',
                'url'         => '',
                'topcolor'    => '',
                'data' => array(
                    'first'   => array(
                        'value' => '您分享的文章已审核',
                        'color' => '',
                    ),
                    'keyword1'   => array(
                        'value' => '审核未过,期待您更改的作品(文人空间)',
                        'color' => '#173177',
                    ),
                    'keyword2'   => array(
                        'value' => '不符合规范',
                        'color' => '#173177',
                    ),
                    'remark' => array(
                        'value' => '',
                        'color' => '',
                    ),                    
                ),        
            ),
        ),
    ),
);