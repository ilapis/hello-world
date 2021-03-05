<?php


if ( App\Security\Access::PUBLIC !== App\Security\Authorization::getAccess() ) {

    $this->view("partial/admin/header");
?>
    <div class="col-sm-2">
        <?php $this->view("sidebar"); ?>
    </div>
    <div class="col-sm-10">
        <?php $this->view("center"); ?>
    </div>
<?php
    $this->view("partial/admin/footer");

} else {
    $this->view("partial/admin/header");
?>
    <div class="col-sm-12">
        <?php $this->view("center"); ?>
    </div>
<?php
    $this->view("partial/admin/footer");
}
