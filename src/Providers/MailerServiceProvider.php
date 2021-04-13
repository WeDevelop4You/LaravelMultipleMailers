<?php

namespace WeDevelop4You\LaravelMultipleMailers\Providers;

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
		$this->mergeConfigFrom(__DIR__.'/../../config/multiple-mailers.php', 'multiple-mailers');
    }

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 * @throws MailerProviderNotFoundException
	 */
    public function boot()
    {
        $this->publishes([__DIR__.'/../../config/multiple-mailers.php' => config_path('multiple-mailers.php')], 'config');

        $mailers = config("multiple-mailers.accounts", []);

        foreach ($mailers as $name => $mailer) {
            $mailer = (object) $mailer;

            $providerName = $mailer->provider ?? 'default';
            $provider = config("multiple-mailers.provider.{$providerName}", false);

            if ($provider) {
                $newMailer = array_merge($provider, [
                    'username' => $mailer->username,
                    'password' => $mailer->password,
                ]);

                config(["mail.mailers.{$name}" => $newMailer]);
            } else {
                throw new MailerProviderNotFoundException("The provider \"{$providerName}\" is not found in the config file mailer");
            }
        }
    }
}
