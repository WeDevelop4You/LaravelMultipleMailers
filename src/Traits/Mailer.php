<?php


namespace WeDevelop4You\LaravelMultipleMailers\Traits;

use Exception;

trait Mailer
{
	/**
	 * @return $this
	 * @throws Exception
	 */
	public function setMailer(): Mailer
	{
        $mailer = config("mailer.accounts.{$this->mailer}", false);

        if ($mailer) {
            $name = $mailer['name'] ?? env('MAIL_FROM_NAME');
            $this->from($mailer['username'], $name);
            $this->onQueue('mail');
        } else {
            throw new Exception('Mailer account not found in config file mailer');
        }

		return $this;
    }
}
