<?php  
require'php/conecta.php';
$id = $_GET['id'];

	//Consulta Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id ='$id'");
$script_noticias->execute();
$noticia = $script_noticias->fetch(PDO::FETCH_ASSOC);

	//Consulta Comentarios
$script_comentarios = $conn->prepare("SELECT * FROM tb_comentario_noticia WHERE id_noticia ='$id'");
$script_comentarios->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>View Notícia</title>
</head>
<script src="./js/jquery-3.6.0.min.js"></script>
        <script>
$(document).ready(function(){
  $("button").click(function(){
    $.ajax({
    url: "./php/comentar.php",
    type: "POST",
    data: "comentario="+$("#comentario").val(),
    dataType: "html"

    }).done(function(resposta) {
        $("span").html(resposta);
        console.log(resposta);

    }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);

    }).always(function() {
        console.log("completou");
    });
  });
});
        </script>
<body>
	<img height="450" width="700" src="<?php echo $noticia['img_1'];?>"><br>
	<h2><?php echo $noticia['nm_noticia']; ?></h2><br>
	<p><?php echo $noticia['ds_noticia']; ?></p>
	<p><?php echo $noticia['nr_curtidas']; ?></p>
	<button onclick="window.location.href = 'php/like.php?id=<?= $noticia['id']?>'">Curtir</button><br>
<br>
<span></span>
	<input id="comentario" type="text" placeholder="Deixe um comentario"><button>Comentar</button><br>
<?php  
while ($comentario = $script_comentarios->fetch(PDO::FETCH_ASSOC)) {
	$id_user = $comentario['id_user'];
	$script_users = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_user'");
	$script_users->execute();	
	$user = $script_users->fetch(PDO::FETCH_ASSOC);
	?>
	<b><?php echo $user['nm_user'];?></b><p><i><?php echo $comentario['comentario']?></i></p><p><?php echo $comentario['data'];?></p>
	<hr>
<?php }?>
</body>
</html>