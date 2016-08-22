<?php

$cat_nav = new Ad(null);
$cat_nav->showCats();
$cat_navitems = $cat_nav->return_data;

$state_nav = new Ad(null);
$state_nav->showStates();
$state_navitems = $state_nav->return_data;

$type = new Ad(null);
$type->showTypes();
$type_navitems = $type->return_data;

?>
