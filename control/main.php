<?php
    if($crud == 'select')
    {
        require_view(('view' . DIRECTORY_SEPARATOR . 'list_item.html'), 'list_item');
    }
    else if($crud == 'insert')
    {
        require_view(('view' . DIRECTORY_SEPARATOR . 'upsert.html'), 'insert');
    }
    else if($crud == 'update')
    {
        require_view(('view' . DIRECTORY_SEPARATOR . 'upsert.html'), 'update');
    }
?>