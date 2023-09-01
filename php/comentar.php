<?php
$datetime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
include('conecta.php');
try {
  $stmt = $conn->prepare('INSERT INTO tb_comentario_noticia (id_user, comentario, data, id_noticia) VALUES(:id_user, :comentario, :data, :id_noticia)');
  $stmt->execute(array(
    ':id_user' => 1,
    ':comentario' => $_POST['comentario'],
    ':data' => $datetime->format('Y-m-d'),
    ':id_noticia' => 1
  ));
  echo "<meta HTTP-EQUIV='refresh' CONTENT='1'>";
} catch(PDOException $e) {
    echo $e;
}
?>