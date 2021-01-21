<?php


namespace WeDevelop4You\LaravelMultipleMailers;

use WeDevelop4You\LaravelMultipleMailers\Exceptions\MailerAccountNotFoundException;

trait Mailer
{
	/**
	 * @param string $mailer
	 * @return $this
	 * @throws MailerAccountNotFoundException
	 */
	private function setMailer(string $mailer)
	{
        $mailer = config("mailer.accounts.{$mailer}", false);

        if ($mailer) {
            $name = $mailer['name'] ?? env('MAIL_FROM_NAME');
            $this->from($mailer['username'], $name);
        } else {
            throw new MailerAccountNotFoundException("Mailer account \"{$mailer}\" is not found in config file mailer");
        }

		return $this;
    }

	/**
	 * @param string $mailer
	 * @param string $queue
	 * @return $this
	 * @throws MailerAccountNotFoundException
	 */
	private function setMailerWithQueue(string $mailer, string $queue = 'mail')
	{
		$this->onQueue($queue);
		return $this->setMailer($mailer);
	}
}
