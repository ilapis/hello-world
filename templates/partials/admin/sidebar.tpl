<?php

$links = $model['links'];

?>

<div class="sidebar" style="border-right:1px solid #CCCCCC;">

    <div class="col-sm-12" style="padding:0.5rem 1rem;line-height:2rem;font-size:1rem;background: #CCCCCC;text-transform: uppercase;" >
        <?=$_ENV["ENVIRONMENT"]?>
    </div>
    <div class="col-sm-12" style="line-height:8rem;font-size:1rem;border-bottom:1px solid #CCCCCC;" >
        <a href="/admin/logout" >atsijungti</a>
    </div>

    <?php foreach( $links as $link ) { ?>
    <div class="col-sm-12" style="line-height:2rem;font-size:1rem;border-bottom:1px solid #CCCCCC;" >
        <a href="<?=$link["href"]?>" ><?=$link["text"]?></a>
    </div>
    <?php } ?>
</div>