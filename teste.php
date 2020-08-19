<?php

session_start();
if (!isset($_SESSION['email_recover'])) { // se não tiver pego tempo que logou
    $_SESSION['email_recover'] = time(); //pega tempo que logou
    // adiciona 30 segundos ao tempo e grava em outra variável de sessão
    $_SESSION['logout_time'] = $_SESSION['email_recover'] + 30;
}

// se o tempo atual for maior que o tempo de logout
if (time() >= $_SESSION['logout_time']) {
    header("location:logout.php"); //vai para logout
    session_destroy();
} else {
    $red = $_SESSION['logout_time'] - time(); // tempo que falta
    echo "Início de sessão: " . $_SESSION['email_recover'] . "<br>";
    echo "Redirecionando em " . $red . " segundos.<br>";
}

?>