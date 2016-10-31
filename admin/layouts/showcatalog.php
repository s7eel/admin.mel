
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
<main>

	<form method="post" action="<?= $_SERVER['PHP_SELF']?>?action=addcatalog">
		<h4>Добавление каталога</h4>
		<div class="col-4">
			<h4 >Проект</4h><br>
			<input type="text" size="20" name="title1" placeholder="Название"><br>
			<input type="text" size="20" name="title2" placeholder="Дата"><br>

			<h4>размер титулього листа</h4>
			<input type="radio"  name="height" value="1">Низкий 270х260 <br>
			<input type="radio"  name="height" value="2">Высокий 270х405 <br>
		</div>

		<div class="col-4">
			<h4>Категории</h4>
			<input type="checkbox" name="interio_work" value="interio_work">Общественные интерьеры<br>
			<input type="checkbox" name="interio_life" value="interio_life">Жилые интерьеры<br>
			<input type="checkbox" name="furniture" value="furniture">Дизайн мебели<br>
			<input type="checkbox" name="landscape" value="landscape">Ландшафтный дизайн<br>
			<input type='submit' value="Создать проект">
		</div>
	</form>

</main>
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
//			echo '<pre>';
//			var_dump($catalogs);
//			echo '</pre>';
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



