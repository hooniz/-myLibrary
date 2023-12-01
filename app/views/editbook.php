<?
$book = $arResult['BOOK']['data'][0];
?>
<div class="container">
	<form method="post" action="/books/edit/do/" enctype="multipart/form-data">
		<div class="form-group">
			<label for="bookName">Название</label>
			<input type="text" class="form-control" id="bookName" name="bookName" value="<?=$book['bookname']?>">
		</div>
        <div class="form-group row-m-t">
            <label for="previewPicture">Изображение</label>
            <img src="<?=$book['preview_picture']?>">
            <input type="file" class="form-control row-m-t" id="previewPicture" name="previewPicture">
        </div>
        <div class="form-group">
            <label for="year">Год</label>
            <input type="text" class="form-control" id="year" name="year" value="<?=$book['year']?>">
        </div>
        <div class="form-group">
            <label for="pagesCount">Кол-во страниц</label>
            <input type="text" class="form-control" id="pagesCount" name="pagesCount" value="<?=$book['pagesCount']?>">
        </div>
        <div class="form-group">
            <label for="rating">Рейтинг</label>
            <input type="text" class="form-control" id="rating" name="rating" value="<?=$book['rating']?>">
        </div>
        <div class="form-group">
            <label for="publisher">Издательство</label>
            <select class="form-control" id="publisher" name="publisher">
                <?foreach ($arResult['PUBLISHERS']['data'] as $PUBLISHER):?>
                    <option value="<?=$PUBLISHER['idpublisher']?>" <?=$PUBLISHER['idpublisher'] != $book['idpublisher']?:'selected'?>><?=$PUBLISHER['name']?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <select class="form-control" id="author" name="author">
	            <?foreach ($arResult['AUTHORS']['data'] as $AUTHOR):?>
                    <option value="<?=$AUTHOR['idauthor']?>" <?=$AUTHOR['idauthor'] != $book['idauthor']?:'selected'?>><?=$AUTHOR['name'] . ' ' . $AUTHOR['surname'] . ' ' . $AUTHOR['lastname']?></option>
	            <?endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="lang">Язык</label>
            <select class="form-control" id="lang" name="lang">
	            <?foreach ($arResult['LANGS']['data'] as $LANG):?>
                    <option value="<?=$LANG['idlang']?>" <?=$LANG['idlang'] != $book['idlang']?:'selected'?>><?=$LANG['name']?></option>
	            <?endforeach;?>
            </select>
        </div>
        <input type="hidden" name="bookId" value="<?=$book['idbook']?>">
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
    <script src="/scripts/edit_book.js?<?=time()?>"></script>
</div>