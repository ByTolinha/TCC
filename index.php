<?php  
include('php/conecta.php');

		//Consulta Categoria
	$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
	$script_categoria->execute();
if(isset($_GET['categoria'])){
	$id_categoria = $_GET['categoria'];
		//Consulta Notícia Filtro Categoria
	$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id_categoria = '$id_categoria'");
	$script_noticias->execute();
}else{
		//Consulta Notícia
	$script_noticias = $conn->prepare("SELECT * FROM tb_noticia");
	$script_noticias->execute();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Listagem Notícias</title>
</head>
<body>
<?php  while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
	<button onclick="window.location.href = 'index.php?categoria=<?= $categoria['id']?>'"><?php echo $categoria['nm_categoria']; ?></button>
<?php } ?>

	<br><br>
<?php  while ($noticia = $script_noticias->fetch(PDO::FETCH_ASSOC)) { ?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia['id']?>'">
			<img height="150" width="200" src="<?php echo $noticia['img_1']; ?>">	
			<p><?php echo $noticia['nm_noticia']."<br>"; ?></p>
  		</div>
<?php } ?>
</body>
</html>