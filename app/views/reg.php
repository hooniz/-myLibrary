<div class="container col-md-5 row-m-t" style="">
	<form id="authForm">
		<div class="row mb-3">
			<label for="inputEmail3" class="col-sm-2 col-form-label">Логин</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="inputLogin">
			</div>
		</div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Фамилия</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputSurname">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Отчество</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputLastname">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Телефон</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPhone">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Улица</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputStreet">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Здание</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputBuilding">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Квартира</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputApartments">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Повторите пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPasswordRepeat">
                <div id="emailHelp" class="form-text">Никому не сообщайте свой пароль.</div>
            </div>
        </div>
		<p>Уже есть аккаунт?<a href="/auth/">Авторизируйтесь!</a></p>
		<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
		<div class="alert alert-danger row-m-t d-none" role="alert" id="alert">
		</div>
	</form>
</div>
<script src="/scripts/reg_script.js?<?=time()?>"></script>