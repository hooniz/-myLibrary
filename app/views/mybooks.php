<div class="container">
	<?foreach ($arResult['BOOKS']['data'] as $book):?>
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
                    <div class="alert alert-danger" role="alert">
                        Следует вернуть до <?=$book['dateEnd']?>
                    </div>
                </div>
            </div>
        </div>
	<?endforeach;?>
</div>