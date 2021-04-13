<?php


namespace WeDevelop4You\LaravelMultipleMailers;

use Illuminate\Contracts\Queue\ShouldQueue;
use WeDevelop4You\LaravelMultipleMailers\Exceptions\MailerAccountNotFoundException;

trait MultipleMailer
{
	/**
	 * @return $this
	 * @throws MailerAccountNotFoundException
	 */
	private function setMultipleMailerName(string $mailerName): MultipleMailer
    {
        $mailer = (object) config("multiple-mailers.accounts.{$mailerName}", false);

        if ($mailer) {
            $name = $mailer->name ?? env('MAIL_FROM_NAME');
            $this->from($mailer->username, $name);

            if ($this instanceof ShouldQueue && config("multiple-mailers.queue.default", false) && empty($this->queue)) {
                $this->onQueue(config('multiple-mailers.queue.worker', ''));
            }
        } else {
            throw new MailerAccountNotFoundException("Mailer account \"{$mailer}\" is not found in config file mailer");
        }

        return $this;
    }
}
