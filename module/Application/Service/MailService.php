<?php

namespace Service;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Smtp;
use Laminas\Mail\Transport\SmtpOptions;

class MailService
{
    private const CONNECTION_CLASS = 'login';

    public static function sendMail(string $to, string $subject, string $body, string $from = null): void
    {
        $options = new SmtpOptions([
            'host' => getenv('MAILER_HOST'),
            'port' => getenv('MAILER_PORT'),
            'connection_class' => self::CONNECTION_CLASS,
            'connection_config' => [
                'username' => getenv('MAILER_USERNAME'),
                'password' => getenv('MAILER_PASSWORD'),
            ],
        ]);

        $message = new Message();
        $message->addTo($to)
            ->addFrom($from ?: getenv('MAILER_FROM'))
            ->setSubject($subject)
            ->setBody($body);

        $transport = new Smtp($options);
        $transport->send($message);
    }
}