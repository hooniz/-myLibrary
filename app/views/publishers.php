<div class="container">
    <ul class="list-group">
		<?foreach ($arResult['PUBLISHERS']['data'] as $PUBLISHER):?>
            <li class="list-group-item"><?=$PUBLISHER['name'] . ' ул. ' . $PUBLISHER['street'] . ', ' . $PUBLISHER['building']?></li>
		<?endforeach;?>
    </ul>
</div>