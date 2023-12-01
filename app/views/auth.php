<div class="container col-md-5 row-m-t" style="height: calc(100vh - 290px)">
    <form id="authForm">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Логин</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputLogin">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword">
                <div id="emailHelp" class="form-text">Никому не сообщайте свой пароль.</div>
            </div>
        </div>
        <p>Еще нет аккаунта?<a href="/reg/">Зарегистрируйтесь!</a></p>
        <button type="submit" class="btn btn-primary">Войти</button>
        <div class="alert alert-danger row-m-t d-none" role="alert" id="alert">
        </div>
    </form>
</div>
<script src="/scripts/auth_script.js?<?=time()?>"></script>