<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>No-Bullshit TFLN Mobile Scraper</title>
	</head>
	<body>
<?php

if ( $_REQUEST['page'] < 1 ) {
	$_REQUEST['page'] = 1;
}

//to make Seth happy
echo('<a href="index.php?page=' . ($_REQUEST['page']-1) . '">prev</a> page ' . ($_REQUEST['page']) . ' <a href="index.php?page=' . ($_REQUEST['page']+1) .'">next</a><br /><hr />');

$page = file_get_contents("http://www.textsfromlastnight.com/texts/page:" . addslashes($_REQUEST['page']));

$page = explode('<textarea readonly="readonly">',$page);
for ( $j = 1; $j < count($page); $j++ ) {
	$temp = explode('</textarea>',$page[$j]);
	$text = $temp[0];
	//now let's strip the stupid shit at the end to get just the text
	$text = explode('http',$text);
	for ( $k = 0; $k < count($text)-1; $k++ ) {
		echo(nl2br($text[$k]));
	}
	
	//voting and stuff
	$vote = explode("<div class='actions'>",$temp[1]);
	$vote = explode("</div>",$vote[1]);
	$vote = str_replace('href="','href="http://textsfromlastnight.com',$vote[0]);
	$vote = explode('<a class="tshirt"',$vote);
	echo($vote[0]);
	
	echo("<br /><hr />");
}

echo('<a href="index.php?page=' . ($_REQUEST['page']-1) . '">prev</a> page ' . ($_REQUEST['page']) . ' <a href="index.php?page=' . ($_REQUEST['page']+1) .'">next</a>');

?>
	</body>
</html>
