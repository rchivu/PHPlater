PHPlater
========

A simple PHP based templating engine.
The engine replaces portions of text defined as such: {{name:test}} with the content defined during runtime;
Example:

require_once('Template.class.php');
$template = new Template('test.tpl.html');
$template->title = "Template Test";
$template->content = "Testing templating engine";
$template->display();
