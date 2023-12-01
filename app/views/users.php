<div class="container">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Имя</th>
			<th scope="col">Фамилия</th>
			<th scope="col">Отчество</th>
			<th scope="col">Телефон</th>
			<th scope="col">Логин</th>
			<th scope="col">Роль</th>
			<th scope="col">Действие</th>
		</tr>
		</thead>
		<tbody>
        <tr>
            <?foreach ($arResult['USERS']['data'] as $USER):?>
                <th scope="row"><?=$USER['iduser']?></th>
                <td><?=$USER['name']?></td>
                <td><?=$USER['surname']?></td>
                <td><?=$USER['lastname']?></td>
                <td><?=$USER['phone']?></td>
                <td><?=$USER['login']?></td>
                <td><?=$USER['permission'] == 1?'Администратор':'Пользователь'?></td>
                <td>
                    <a class="btn btn-danger delete-book" id="<?=$USER['iduser']?>" role="button">Удалить</a>
                    <a class="btn btn-primary edit-book" href="/users/edit/?id=<?=$USER['iduser']?>" role="button">Изменить</a>
                </td>
            <?endforeach;?>
        </tr>
		</tbody>
	</table>
</div>