<?php


namespace App\Service;

use App\Service\MessageGenerator;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SiteUpdateManager
{
    private $adminEmail;
	private $messageGenerator;
	private $mailer;

	public function __construct(MessageGenerator $messageGenerator, MailerInterface $mailer, string $adminEmail)
	{
		$this->messageGenerator = $messageGenerator;
		$this->mailer = $mailer;
		$this->adminEmail = $adminEmail;
	}

	public function notifyOfSiteUpdate(): bool
	{
		$happyMessage = $this->messageGenerator->getHappyMessage();

		$email = (new Email())
			->from('aid405060@gmail.com')
			->to($this->adminEmail)
			->subject('Site update just happened!')
			->text('Someone just updated the site. We told them: '.$happyMessage);

		$this->mailer->send($email);


		return true;
	}
}