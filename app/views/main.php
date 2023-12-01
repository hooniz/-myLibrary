<div class="container">
    <div class="head">
        <p class="lead">
            Полный список книг нашей библиотеки
        </p>
        <div class="card row-m-t">
            <h5 class="card-header">Фильтр</h5>
            <div class="container">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="year" class="form-label">Год написания</label>
                        <input type="text" class="form-control" id="year" placeholder="Например... 2002" <?if(isset($_GET['year'])):?>value="<?=$_GET['year']?>"<?endif;?>>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" id="publisher">
                            <option selected value="0">Выберите Издательство</option>
                            <?foreach ($arResult['smartFilter']['publishers'] as $publisher):?>
                                <option value="<?=$publisher['idpublisher']?>" <?if($_GET['publisher_id'] && $_GET['publisher_id'] == $publisher['idpublisher']):?>selected<?endif;?>><?=$publisher['name']?></option>
                            <?endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" id="author">
                            <option selected value="0">Выберите автора</option>
	                        <?foreach ($arResult['smartFilter']['authors'] as $author):?>
                                <option value="<?=$author['idauthor']?>" <?if($_GET['author_id'] && $_GET['author_id'] == $author['idauthor']):?>selected<?endif;?>><?=$author['name'] . " " . $author['surname'] . " " . $author['lastname']?></option>
	                        <?endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Рейтинг от</label>
                        <input type="email" class="form-control" id="rating" placeholder="Например... 9.1" <?if(isset($_GET['rating'])):?>value="<?=$_GET['rating']?>"<?endif;?>>
                    </div>
                    <a id="accept_filter" class="btn btn-success">Применить фильтр</a>
                </div>
            </div>
        </div>
    </div>
    <div id="books">
        <?foreach ($arResult['data'] as $book):?>
            <div class="card row-m-t">
                <h5 class="card-header">Книга №<?=$book['idbook']?></h5>
                <div class="container d-flex flex-row align-items-center">
                    <div class="image-inner">
                        <img src="<?=$book['preview_picture']?>" class="rounded" alt="image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?=$book['bookname']?></h5>
                        <p class="card-text">Год написания: <?=$book['year']?></p>
                        <p class="card-text">Издательство: <?=$book['publisher']?></p>
                        <p class="card-text">Автор: <a href="#"><?="{$book['name']} {$book['surname']} {$book['lastname']}"?></a></p>
                        <p class="card-text">Рейтинг: <?=$book['rating']?></p>
                        <p class="card-text">Описание: <?=$book['preview']?:"Отсутствует."?></p>
                        <a id="<?=$book['idbook']?>" class="btn book_add">Переход куда-нибудь</a>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>
<?
$jsParams = json_encode($arResult['data']);
?>
<script>
    var jsParams = <?=$jsParams?>
</script>
<script src="/scripts/book_catalog_script.js?<?=time()?>"></script>