<?php

$links = $model['links'];

?>

<div class="sidebar" style="box-shadow:0 10px 20px rgb(0 0 0 / 19%), 0 6px 6px rgb(0 0 0 / 23%);position: relative;">

    <div class="col-sm-12" style="padding:0.5rem 1rem;line-height:2rem;font-size:1rem;background: #CCCCCC;text-transform: uppercase;height: 3rem;" >
        <?=$_ENV["ENVIRONMENT"]?>
    </div>
    <div class="col-sm-12" style="line-height:4rem;font-size:1rem;border-bottom:1px solid #CCCCCC;" >
        <a href="/admin/logout" >atsijungti</a>
    </div>

    <?php foreach( $links as $link ) { ?>
    <div class="col-sm-12" style="line-height:2rem;font-size:1rem;border-bottom:1px solid #CCCCCC;height: 3rem;" >
        <a href="<?=$link["href"]?>" ><?=$link["text"]?></a>
    </div>
    <?php } ?>
</div>