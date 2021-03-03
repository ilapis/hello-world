<?php

$this->view("partial/header");

if ( App\Security\Access::PUBLIC !== App\Security\Authorization::getAccess() ) {

?>
    <div class="col-sm-2">
        <?php $this->view("sidebar"); ?>
    </div>
    <div class="col-sm-10">
        <?php $this->view("center"); ?>
    </div>
<?php

} else {

?>
    <div class="col-sm-12">
        <?php $this->view("center"); ?>
    </div>
<?php
}

$this->view("partial/footer");