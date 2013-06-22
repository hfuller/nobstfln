<?php

//echo($_REQUEST['uri']);

if ( substr($_REQUEST['uri'],0,30) == "http://textsfromlastnight.com/" ) {
	
	echo(file_get_contents($_REQUEST['uri']));
	
}

?>