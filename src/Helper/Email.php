<?php


namespace App\Educar\Helper;


use App\Educar\Model\Usuario;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
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

        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
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
        $userHtml = $usuario->getemail();
        echo $userHtml;
        $body = '<header>
    <nav class="navbar" style="
            width: 960px;
            height: 50px;
            background-image: linear-gradient(to right top,
                    #d5d5d5,
                    #d0d2d3,
                    #c9cfd0,
                    #c5ccc9,
                    #c5c8c0);
            margin-left: auto;
            margin-right: auto;">

        <a href=""></a>
        <a href=""></a>
        <a href=""></a>
    </nav>

    <div style=" width: 960px;
            height: 150px;
            background: white;
            display: flex;
            align-content: space-between;
            margin-left: auto;
            margin-right: auto;" class="header">
        <div style="  width: 150px;
            border-right: solid grey 2px;" class="logo1">
            <img src="https://i.ibb.co/bBkyW9q/ic-school-128-28729.png" alt="logo2" width="128" height="150">
        </div>
        <div class="titulo">
            <h1 style="  width: 660px;
            height: 150px;
            text-align: center;
            font-size: 3.5em;
            font-family: Arial, Helvetica, sans-serif;">Centro Educacional Espaço Educar
            </h1>

        </div>

        <div style=" width: 150px;
            border-left: solid grey 2px;" class="logo2">
            <img src="https://i.ibb.co/ykDZ8My/1490886282-18-school-building-82486.png" alt="logo1" alt="logo1"
                 width="128" height="150">
        </div>
    </div>

</header>
<div style="     position: relative;
            width: 960px;
            height: 520px;
            margin-left: auto;
            margin-right: auto;
            text-align: justify;
            font-family: cursive;
            background-color: ghostwhite;
            font-size: 1.2em;" class="content">
    <H1 style="  padding-top: 50px;" align="center">Solicitação de troca de senha</H1>
    <p style="  padding: 25px 120px;
            text-align: justify;">Caro <?php echo $userHtml;?>, foi solicitado a troca se sua senha em nosso sistema,
        se vc solicitou a recuperação da sua
        senha acesse o link abaixo:</p>

    <a style=" padding-left: 120px;" href="http://localhost/recupera-senha"> clique aqui </a>
    <p style="  padding: 25px 120px;
            text-align: justify;"> A equipe Espaço Educar orienta que nenhum e-mail, SMS, ou ligação é
        realizado aos nosso clientes pedindo informações a respeito de sua senha.
        Para mais informações entre em contato conosco</p>
</div>
<div style="    position: relative;

            width: 960px;
            height: 130px;
            margin-left: auto;
            margin-right: auto;" class="footer">
    <img src="https://i.ibb.co/dML6YXK/banner-contato1.jpg" alt="contato" width="960" height="130">
</div>
<p style=" text-align: center;
            width: 960px;
            height: 60px;
            background-color: grey;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: auto;
            margin-right: auto;
            padding-top: 60px;" class="footerCop"> ©Ronycode. Todos os direitos
    reservados</p>';

        return $body;
    }

}