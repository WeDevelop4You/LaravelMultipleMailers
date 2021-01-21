<?php


namespace WeDevelop4You\LaravelMultipleMailers;

use WeDevelop4You\LaravelMultipleMailers\Exceptions\MailerAccountNotFoundException;

trait Mailer
{
	/**
	 * @return $this
	 * @throws MailerAccountNotFoundException
	 */
	private function setMailer(): Mailer
	{
        $mailer = config("mailer.accounts.{$this->mailer}", false);

        if ($mailer) {
            $name = $mailer['name'] ?? env('MAIL_FROM_NAME');
            $this->from($mailer['username'], $name);
        } else {
            throw new MailerAccountNotFoundException("Mailer account \"{$this->mailer}\" is not found in config file mailer");
        }

		return $this;
    }

	/**
	 * @param string $queue
	 * @return Mailer
	 * @throws MailerAccountNotFoundException
	 */
	private function setMailerWithQueue(string $queue = 'mail'): Mailer
	{
		$this->onQueue($queue);
		return $this->setMailer();
	}
}
