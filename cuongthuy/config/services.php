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
              'client_id'     => '162082679789-pnipgiqu9p4f0cko0fpjd6610j9r94no.apps.googleusercontent.com',
              'client_secret' => 'fhq8gyhtAeL8L1oFvBAQ68sa',
              'redirect'      => 'http://cuongthuy.pe.hu/login/google',
          ],
         'facebook'   => [
              'client_id'     => '1086178621393432',
              'client_secret' => '8f4fa10513d9d66c3454657eebcf4932',
              'redirect'      => 'http://cuongthuy.pe.hu/login/facebook',
              'scopes'         => 'name,email',
          ],
];
