<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],
    
        'google'   => [
              'client_id'     => '851608474462-eotov7nplp3olc5san1v61bhc9nsangd.apps.googleusercontent.com',
              'client_secret' => 'xVieUc0rP0xbgbEL8S_xdnz2',
              'redirect'      => 'http://cuongthuy.com/login/google',
          ],
         'facebook'   => [
              'client_id'     => '1632899020301830',
              'client_secret' => '7c0e03398b1bd71f1abaeebe9c4bee84',
              'redirect'      => 'http://cuongthuy.com/login/facebook',
              'scopes'         => 'name,email',
          ],
];
