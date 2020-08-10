<?php

use App\Educar\Helper\Email;
use App\Educar\Model\Usuario;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/config.php';

$user = new Usuario(null, 'ronyandersonpc@gmail.com', '');


$email = new Email();
$body = $email->templateEmail($user);
$email->add(
    'Solicitação de troca de senha',
    $body,
    $user->getEmail(),
    'Rony Anderson'

)->send();

if (!$email->error()) {
    var_dump(true);
} else {
    echo $email->error()->getMessage();
}

