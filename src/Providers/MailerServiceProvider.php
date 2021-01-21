<?php

namespace WeDevelop4You\LaravelMultipleMailers;

use Illuminate\Support\ServiceProvider;
use WeDevelop4You\LaravelMultipleMailers\Exceptions\MailerProviderNotFoundException;

class MailerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 * @throws MailerProviderNotFoundException
	 */
    public function boot()
    {
    	$this->publishes([
			__DIR__ . '/../config/mailer.php' => config_path('mailer.php'),
		]);

		self::setMailerConfig();
    }

	/**
	 * @throws MailerProviderNotFoundException
	 */
	private static function setMailerConfig()
	{
		$mailers = config("mailer.accounts", []);

		foreach ($mailers as $name => $mailer) {
			$providerName = $mailer['provider'] ?? 'default';
			$provider = config("mailer.provider.{$providerName}", false);

			if ($provider) {
				$newMailer = array_merge($provider, [
					'username' => $mailer['username'],
					'password' => $mailer['password'],
				]);

				config(["mail.mailers.{$name}" => $newMailer]);
			} else {
				throw new MailerProviderNotFoundException("The provider \"{$providerName}\" is not found in the config file mailer");
			}
		}
	}
}
