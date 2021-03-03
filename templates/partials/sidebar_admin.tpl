<?php

$links = [];

$links[] = [
    "text" => "Article",
    "href" => "/admin/article/list",
];

$links[] = [
    "text" => "Category",
    "href" => "/admin/category/list",
];

?>

<div class="sidebar" style="border-right:1px solid #CCCCCC;">

    <div class="col-sm-12" style="padding:0.5rem 1rem;line-height:4.5rem;font-size:1rem;border-bottom:1px solid #CCCCCC;" >
        <a href="/admin/logout" >atsijungti</a>
    </div>

    <?php foreach( $links as $link ) { ?>
    <div class="col-sm-12" style="padding:0.5rem 1rem;line-height:1.5rem;font-size:1rem;border-bottom:1px solid #CCCCCC;" >
        <a href="<?=$link["href"]?>" ><?=$link["text"]?></a>
    </div>
    <?php } ?>
</div>