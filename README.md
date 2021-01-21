# Laravel Multiple Mailers

I made this package because I wanted to use multiple mails. It is a small simple package to use multiple mails in Laravel. I'm not really going to expand it any further. Only if I want to add functions myself. You are free to use the package and here is a little explanation of how to use it.

## Installation
PHP 7.0 or higher and Laravel 7 are required.

> Its only tested on Laravel 7

Require this package with composer.

```
composer require wedevelop4you/laravel-multiple-mailers
```

Publish the config file by running:

```
php artisan vendor:publish --provider="WeDevelop4You\LaravelMultipleMailers\MailerServiceProvider" --tag=config
```

## Config

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
| name | string | false  | MAIL_FROM_NAME .env |
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

## How to use it

When sending an email you need to set the mailer. The mailer name is the name you set in the `mailer` config.

```php
Mail::mailer('example');
```

Example:
```php
Mail::mailer('example')->to('test@example.org')->send(new ExampleMail());
```

Now import `Mailer` in your mail class.
```php
use Queueable, SerializesModels, Mailer;
```

Finally set the mailer in your mail class in the `__construct` or in `build`. You need to give it the same name as above
```php
$this->setMailer('example');
```

Examples:
```php
    public function __construct()
    {
        $this->setMailer('example');
    }
```
```php
    public function build()
    {
        $this->setMailer('example')->view('mail.example');
    }
```

You can also use queue with a queue name. The default queue name is: mail. To use queue replace `setMailer` with `setMailerWithQueue` 
> Note to use `setMailerWithQueue` you need to implement `ShouldQueue` in your mail class
```php
$this->setMailerWithQueue('example');
```

You can also specify your own queue name.
```php
$this->setMailerWithQueue('example', 'queue name');
```
