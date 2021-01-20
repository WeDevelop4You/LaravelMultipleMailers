<?php

    return [
    	/*
    	 *
    	 */
        'accounts' => [
            'example' => [
                'username' => 'mailer@example.org',
                'password' => env('MAIL_PASSWORD'),
            ]
        ],

		/*
		 *
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
