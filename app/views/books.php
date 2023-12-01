<div class="container">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Название</th>
			<th scope="col">Год</th>
			<th scope="col">Кол-во страниц</th>
			<th scope="col">Рейтинг</th>
			<th scope="col">Автор</th>
			<th scope="col">Язык</th>
			<th scope="col">Издательство</th>
			<th scope="col">Статус</th>
			<th scope="col">Действие</th>
		</tr>
		</thead>
		<tbody>
		<?foreach ($arResult['BOOKS']['data'] as $book):?>
			<tr>
				<th scope="row"><?=$book['idbook']?></th>
				<td><?=$book['bookname']?></td>
				<td><?=$book['year']?></td>
				<td><?=$book['pagesCount']?></td>
				<td><?=$book['rating']?></td>
				<td><?=$book['name'] . ' ' . $book['surname'] . ' ' . $book['lastname']?></td>
				<td><?=$book['lang']?></td>
				<td><?=$book['publisher']?></td>
				<td><?= isset($book['userId'])?'Пользователь ' . $book['userId']:'Свободна'?></td>
				<td>
					<a class="btn btn-danger delete-book" id="<?=$book['idbook']?>" role="button">Удалить</a>
					<a class="btn btn-primary edit-book" href="/books/edit/?id=<?=$book['idbook']?>" role="button">Изменить</a>
				</td>
			</tr>
		<?endforeach;?>
		</tbody>
	</table>
</div>