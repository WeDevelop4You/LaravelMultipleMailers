# Laravel Multiple Mailers

I made this package because I wanted to use multiple mails. It is a small simple package to use multiple mails in Laravel. I'm not really going to expand it any further. Only if I want to add functions myself. You are free to use the package and here is a little explanation of how to use it.

## Installation
PHP 7.0 or higher and Laravel 7 or higher are required.

Require this package with composer.

```
composer require wedevelop4you/laravel-multiple-mailers
```

Publish the config file by running:

```
php artisan vendor:publish --provider="WeDevelop4You\LaravelMultipleMailers\Providers\MailerServiceProvider" --tag=config
```

## Config

config the mailers in: `multiple-mailer`

### Accounts config:

```php
    /*
     *  'Choose a name for your mail config' => [
     *	    'username' => 'Your email address', (required)
     *      'password' => 'Your email password', (required)
     * 	    'name' => 'Your name send by the email' (The default name is MAIL_FROM_NAME in your .env file)
     * 	    'provider' => 'Your provider' (The default provider is default)
     *  ]
     */
    'accounts' => [
        'example' => [
            'username' => 'mailer@example.org',
            'password' => env('MAIL_PASSWORD'),
        ]
    ]
```


| name  | type | required | default |
| ----- | ---- | -------- | ------- |
| name mail config | object | true  | null |
| username | string | true  | null |
| password | string | true | null |
| name | string | false  | MAIL_FROM_NAME in your .env file|
| produces | string | false  | default |

### Providers config:

```php
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
```

### Queue config:

```php
     /*
     *  'worker' => The name of the queue worker. (The default name of the worker is 'default')
     *  'default' => Always use the queue worker name on mail classes with ShouldQueue.
     */
    'queue' => [
        'worker' => '',
        'default' => false,
    ]
```

If you want to queue all the mail on the same worker name but except one or more, Than you can set `onQueue` in your mail class. The code will not override the queue name.

## How to use it

When sending an email you need to set the mailer. The mailer name is the name you set in the `mailer` config.

```php
Mail::mailer('example');
```

Example:
```php
Mail::mailer('example')->to('test@example.org')->send(new ExampleMail());
```

Now import `MultipleMailer` in your mail class.
```php
use Queueable, SerializesModels, MultipleMailer;
```

Finally set the mailer name in your mail class in the `__construct` or in your own function. You need to give it the same name as above
```php
$this->setMultipleMailerName('example');
```

Examples:
```php
    public function __construct()
    {
        $this->setMultipleMailerName('example');
    }
```

## Exceptions

### `MailerAccountNotFoundException`

throws when the mailer name doesn't exist in the config file.

### `MailerProviderNotFoundException`

throws when the provider name doesn't exist in the config file.
