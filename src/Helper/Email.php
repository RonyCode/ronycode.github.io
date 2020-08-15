<?php

namespace App\Educar\Helper;

use App\Educar\Controller\HtmlRenderController;
use App\Educar\Model\Usuario;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email extends HtmlRenderController
{
    private PHPMailer $mail;
    private \stdClass $data;
    private \Exception $error;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->data = new \stdClass();

        $this->mail->isSMTP();
        $this->mail->isHTML(true);
        $this->mail->setLanguage('br');

        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->CharSet = PHPMailer::CHARSET_UTF8;
        $this->mail->SMTPAuth = true;

        $this->mail->Host = MAIL['host'];
        $this->mail->Port = MAIL['port'];
        $this->mail->Username = MAIL['user'];
        $this->mail->Password = MAIL['passwd'];
    }

    public function add(
        string $subject,
        string $body,
        string $recipient_email,
        string $recipient_name
    ) {
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipient_email = $recipient_email;
        $this->data->recipient_name = $recipient_name;
        return $this;
    }

    public function attach(string $filetPath, string $fileName): Email
    {
        $this->data->attach[$filetPath] = $fileName;
        return $this;
    }

    public function send(
        $fromEmail = MAIL['from_email'],
        $fromName = MAIL['from_name']
    ): bool {
        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->body);
            $this->mail->addAddress(
                $this->data->recipient_email,
                $this->data->recipient_name
            );
            $this->mail->setFrom($fromEmail, $fromName);

            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $path => $name) {
                    $this->mail->addAttachment($path, $name);
                }
            }
            $this->mail->send();
            return true;
        } catch (\Exception $e) {
            $this->error = $e;
            return false;
        }
    }

    public function error(): ?\Exception
    {
        return $this->error;
    }

    public function templateEmail(Usuario $usuario): string
    {
        $body = $this->renderHtml(
            'template/email.php',
            [
                'usuario' => $usuario,
            ]
        );
        return $body;
    }
}
