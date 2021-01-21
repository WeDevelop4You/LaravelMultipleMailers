<?php

    return [
    	/*
    	 * 	'Choose a name for your mail config' => [
         *		'username' => 'Your email address', (required)
         *     	'password' => 'Your email password', (required)
    	 * 		'name' => 'Your name send by the email' (The default name is MAIL_FROM_NAME in your .env file)
    	 * 		'provider' => 'Your provider' (The default provider is default)
         * 	]
    	 */
        'accounts' => [
            'example' => [
                'username' => 'mailer@example.org',
                'password' => env('MAIL_PASSWORD'),
            ]
        ],

		/*
		 *	The providers are the same as mailers in the mail config
		 */
        'provider' => [
            'default' => [
                'transport' => 'smtp',
                'host' => env('MAIL_HOST'),
                'port' => env('MAIL_PORT'),
                'encryption' => env('MAIL_ENCRYPTION'),
                'timeout' => null,
                'auth_mode' => null,
            ],
        ]
    ];
