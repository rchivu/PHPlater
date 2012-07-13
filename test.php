<?php

require_once('Template.class.php');
$template = new Template('test.tpl.html');
$template->title = "Template Test";
$template->content = "Testing templating engine";
$template->display();

?>
