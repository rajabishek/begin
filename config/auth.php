<?php

return [
	
	'defaults' => [
        'guard' => 'api',
        'provider' => 'users'
    ],

	'guards' => [
	    'api' => [
	        'driver' => 'jwt-auth',
	        'provider' => 'users'
	    ],
	],

	'providers' => [
	    'users' => [
	        'driver' => 'eloquent',
	        'model'  => Begin\User::class,
	    ],
	],
];