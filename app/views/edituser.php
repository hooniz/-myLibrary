<?
$user = $arResult['USERS']['data'][0];
?>
<div class="container">
	<form method="post" action="/users/edit/do/">
		<div class="form-group">
			<label for="bookName">Имя</label>
			<input type="text" class="form-control" id="userName" name="name" value="<?=$user['name']?>">
		</div>
        <div class="form-group">
            <label for="bookName">Фамилия</label>
            <input type="text" class="form-control" id="userSurname" name="surname" value="<?=$user['surname']?>">
        </div>
        <div class="form-group">
            <label for="bookName">Отчество</label>
            <input type="text" class="form-control" id="userLastname" name="lastname" value="<?=$user['lastname']?>">
        </div>
		<div class="form-group">
			<label for="year">Телефон</label>
			<input type="tel" class="form-control" id="inputPhone" name="phone" value="<?=$user['phone']?>">
		</div>
		<div class="form-group">
			<label for="pagesCount">Логин</label>
			<input type="text" class="form-control" id="login" name="login" value="<?=$user['login']?>">
		</div>
        <div class="form-group">
            <label for="lang">Роль</label>
            <select class="form-control" id="role" name="role">
				<option value="1" <?=$user['permission']==1?'selected':'';?>>Администратор</option>
				<option value="0" <?=$user['permission']==0?'selected':'';?>>Пользователь</option>
            </select>
        </div>
		<input type="hidden" name="userId" value="<?=$user['iduser']?>">
		<button class="btn btn-success row-m-t edit-book">Изменить</button>
	</form>
	<?
	if($_SESSION['REDIRECT']['MESSAGE_SUCCESS']):
		?>
		<div class="alert alert-success alert-dismissible fade show row-m-t" role="alert">
			<?=$_SESSION['REDIRECT']['MESSAGE_SUCCESS']?>
			<button type="button" class="btn-close alert-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?endif;?>
	<?
	if($_SESSION['REDIRECT']['MESSAGE_ALERT']):
		?>
		<div class="alert alert-warning alert-dismissible fade show row-m-t" role="alert">
			<?=$_SESSION['REDIRECT']['MESSAGE_ALERT']?>
			<button type="button" class="btn-close alert-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?endif;?>
	<script src="/scripts/edit_user.js?<?=time()?>"></script>
</div>