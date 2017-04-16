<?php

return [
    'adminEmail' => 'admin@example.com',
    'pageSize' => [
    	'category'=>3,
    	'citys'=>3,
    	'bis'=>3,
        'bis_location'=>3,
        'deal'=>3,
        'bis_account'=>3,
        'deal'=>3,
        'featured'=>3,
        'user'=>3,
        'lists'=>10,
        'order'=>3,
    ],
    'map' =>[
    	'url'=> 'http://api.map.baidu.com/',
    	'staticimage'=>'staticimage/v2',
    	'ak'=>'kij4hsGAOj7yFzNTBbGQWfY4hL3Z7Yu8',
    	'geocoder'=>'geocoder/v2/',
    ],
    'featured_type'=>[
        0=>'首页推荐大图',
        1=>'首页右侧广告'
    ],
    //需要显示在首页的类别的商品
    'deal'=>[
        1,2
    ],
];
