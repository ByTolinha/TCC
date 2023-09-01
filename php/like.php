<?php
include('conecta.php');
$id = $_GET['id'];
$script_noticia = $conn->prepare("SELECT * FROM tb_noticia where id ='$id'");
$script_noticia->execute();
$noticia = $script_noticia->fetch(PDO::FETCH_ASSOC);
$like = $noticia['nr_curtidas']+1;
try {
  $stmt = $conn->prepare("INSERT INTO tb_noticia (nr_curtidas) VALUES(:nr_curtidas) WHERE id ='$id'");
  $stmt->execute(array(
    ':nr_curtidas' => $like
  ));
  echo "<meta HTTP-EQUIV='refresh' CONTENT='1'>";
} catch(PDOException $e) {
    echo $e;
}
?>