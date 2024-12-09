<?php

namespace App\Services\Logger;

use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailLogger implements LoggerInterface
{
    private string $type = 'email';

    public function send(string $message): void
    {
        $recipient = config('logger.email');

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = env('MAIL_PORT');
            $mail->CharSet = 'UTF-8';
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), 'Mailer');
            $mail->addAddress($recipient);

            $mail->Subject = 'New log';
            $mail->Body    = $message;

            $mail->send();
            Log::info('Email has been sent successfully.');

        } catch (Exception $e) {
            Log::error('Email could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }
        echo "Email log sent to {$recipient}: {$message}\n";
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        $this->send($message);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
