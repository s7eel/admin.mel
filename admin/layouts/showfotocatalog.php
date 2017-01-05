<div class="header">
	<div class="logo">
		<a href="#"><img src="./images/logo1.png" width="130px">

		</a>
	</div>
	<div class="link">
		<p> Перейти на сайт</p>
		<a href='#'><img src="./images/site.png" alt="Перейти на сайт"/></a>
	</div>
</div>
<footer>
	<?php
	foreach ($arr_foto as $key=>$value): ?>
		<div class="delete_foto">

			<a href="<?= $_SERVER['PHP_SELF']?>?action=deletefotobyID&id=<?= $value['id']?>"><img src="../../assets/img/del.png" alt="Удалить"></a>
			<img  width=250px  src="../../assets/img/projects/images/<?= $value['link']?>">

		</div>

	<?php endforeach;?>
	<?php var_dump($arr_foto); ?>
	<form>
		<div class="col-4">
			<h4>Добавить фото в каталог</h4><br>
			<input type='file' name="main_foto" accept="image/jpeg"><br>
			<div>(фото должно быть не более 2МБ)</div>
		</div>
	</form>


</footer>