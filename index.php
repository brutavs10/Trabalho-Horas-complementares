<?php
require_once('control' . DIRECTORY_SEPARATOR . 'crud.php');
require_once('control' . DIRECTORY_SEPARATOR . 'function.php');

require_view(('view' . DIRECTORY_SEPARATOR . 'header.html'), 'header');

require_once('control' . DIRECTORY_SEPARATOR . 'main.php');

require_view(('view' . DIRECTORY_SEPARATOR . 'footer.html'), 'footer');