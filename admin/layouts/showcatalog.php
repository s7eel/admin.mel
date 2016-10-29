
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

<div class="container_bar_index">
	<h4>Добавление каталога</h4>
</div>

	<div class="header">
		<div class="logo">
			<a href="#"><img src="./images/logo1.png"  width="130px"></a>
		</div>
	</div>
	<footer>
		<div class="container_bar_index"><h4>Существующие каталоги</h4>
		</div>



		<table class="table table-bordered table-hover">
			<tr class="warning">
				<th>Титл</th>
				<th>Титл2</th>
				<th>Каталог</th>
				<th>Заглавный рисунок</th>
				<th>Высота Загл рисунка</th>
				<th>Действия</th>
			</tr>
			<?php
			include_once './functions.php';
			foreach ($catalogs as $key => $item):
				$class = getclassBYname($item['class']);
				$height = getheightOffoto($item['height']);
				?>


			<tr>
				<td class="info" style="width: 200px"><?=$item['title1']?></td>
				<td class="info" style="width: 200px"><?=$item['title2']?></td>
				<td class="info" style="width: 200px"><?=$class?></td>
				<td class="info" style="width: 180px"><img src="../assets/img/projects/images/<?=$item['link']?>"></td>
				<td class="info" style="width: 180px"><?=$height?></td>
				<td class="success">
					<form method="POST">
						<input type="hidden" value="<?=$item['id']?>" name="id">
						<input type="hidden" value="<?=$item['height']?>" name="height">
<!--						<select>-->
<!--							<option selected value="">Ничего не делать</option>-->
<!--							<option>Удалить Каталог</option>-->
<!--							<option>Изменить Фото в Каталоге</option>-->
<!--							<option>Изменить Титлы Каталога</option>-->
<!--							<option>Изменить исходный класс</option>-->
<!--							<option>Изменить категорию Каталога</option>-->
<!--						</select>-->
						<input type="submit" value="Удалить Каталог" formaction="<?= $_SERVER['PHP_SELF']?>?action=deletecatalog">
						<input type="submit" value="Изменить Фото в Каталоге" formaction="<?= $_SERVER['PHP_SELF']?>?action=changefoto">
						<input type="submit" value="Изменить Титлы Каталога" formaction="<?= $_SERVER['PHP_SELF']?>?action=changetitle">
						<input type="submit" value="Изменить высоту Каталога" formaction="<?= $_SERVER['PHP_SELF']?>?action=changeheight">
						<input type="submit" value="Изменить категорию Каталога" formaction="<?= $_SERVER['PHP_SELF']?>?action=changecategory">
					</form>
				</td>
			</tr>
<?php endforeach; ?>
		</table>
	</footer>



