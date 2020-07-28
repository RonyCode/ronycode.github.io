<?php

use App\Educar\Infrastructure\Persistence\ConnectionFactory;
use App\Educar\Infrastructure\Repository\PdoRepoUsers;

require 'vendor/autoload.php';

$pdo = ConnectionFactory::createConnection();
$repoUsers = new PdoRepoUsers($pdo);

$id = $_POST['id'];
//$idHash = password_hash($id, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE senha=:senha;');
$stmt->bindValue(':senha', $id);
$stmt->execute();
$result = $stmt->fetch();

var_dump($id);
var_dump($result['senha']);

?>
<form action="" method="post">
    <input type="text" name="id">
    <button type="submit">enviar</button>
</form>
