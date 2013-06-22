<?php
if ( $_REQUEST['page'] > 1 ) echo('<a href="index.php?page=' . ($_REQUEST['page']-1) . '">prev</a> ');

echo('(page ' . ($_REQUEST['page']) . ') <a href="index.php?page=' . ($_REQUEST['page']+1) .'">next</a>');
?>
