<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>No-Bullshit TFLN Mobile Scraper</title>
	</head>
	<style type="text/css">
		/* http://puu.sh/30ge8.png */
		body {
			text-align:center;
			font-family:sans-serif;
			background-color:#1D2126;
		}
		#thegoddamnpage {
			max-width:35em;
			margin:0px auto;
			text-align:left;
			background-color:#8C232C;
			color:#F2F2F2;
			padding-left:16px;
			padding-right:16px;
			
			padding-top:5px;
			padding-bottom:5px;
			
			-webkit-border-radius: 45px;
			-moz-border-radius: 45px;
			border-radius: 45px;
		}
		.item {
			background-color:#F2F2F2;
			color:#1D2126;
			
			border-style:solid;
			-webkit-border-radius: 15px;
			-moz-border-radius: 15px;
			border-radius: 15px;
			
			padding-left:10px;
			padding-right:10px;
			
			border-color:#732735;
			
			padding-top:5px;
			padding-bottom:5px;
			
			margin-top:12px;
			margin-bottom:12px;
		}
		.actions {
			text-align:center;
		}
	</style>
	<body>
		<div id="thegoddamnpage">
<?php

if ( $_REQUEST['page'] < 1 ) {
	$_REQUEST['page'] = 1;
}

//to make Seth happy
echo('<div class="actions pager">');
include("_pager.php");
echo('</div><hr />');

$page = file_get_contents("http://www.textsfromlastnight.com/texts/page:" . addslashes($_REQUEST['page']));

$page = explode('<textarea readonly="readonly">',$page);
for ( $j = 1; $j < count($page); $j++ ) {
	echo("\n\n");
	echo('<div class="item">');
	$temp = explode('</textarea>',$page[$j]);
	$text = $temp[0];
	//now let's strip the stupid shit at the end to get just the text
	$text = explode('http',$text);
	echo('<div class="text">');
	for ( $k = 0; $k < count($text)-1; $k++ ) {
		echo(nl2br($text[$k]));
	}
	echo('</div>');
	
	//voting and stuff
	$vote = explode("<div class='actions'>",$temp[1]);
	$vote = explode("</div>",$vote[1]);
	$vote = str_replace('href="','href="http://textsfromlastnight.com',$vote[0]);
	$vote = str_replace('class="good-night" ','class="good-night" onclick="return count(this);" ',$vote);
	$vote = str_replace('class="bad-night" ','class="bad-night" onclick="return count(this);" ',$vote);
	$vote = explode('<a class="tshirt"',$vote);
	echo('<div class="actions">' . $vote[0] . '</div>');
	
	echo("</div>\n\n");
}

echo('<hr/><div class="actions pager">');
include("_pager.php");
echo('</div>');

?>
		</div>
		
		<script type="text/javascript">

			function count(theobject)
			{
				//alert(thelink);
				//alert("test");
				//alert(this.href);
			 
				var xmlhttp=false;
				try {
					xmlhttp=new XMLHttpRequest();
				} catch (e) {
					try {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (E) {
						xmlhttp = false;
					}
				}
				
				xmlhttp.open("GET","_proxy.php?uri=" + theobject.href);
				xmlhttp.onreadystatechange = gotresponse;
				function gotresponse() {
					if ( xmlhttp.readyState == 4 ) {
						//alert(xmlhttp.responseText);
						//json = eval('(' + xmlhttp.responseText + ')');
						//alert(json['message']);
						//var value = eval(xmlhttp.responseText);
						var myObject = eval('(' + xmlhttp.responseText + ')');
						//alert(value[0]);
						//theobject.style.display = "none";
						//alert(myObject.message);
						theobject.innerHTML = myObject.message;
						
						
					}
				}
				
				xmlhttp.send(null);
				if ( theobject.id.substring(0,1) == "P" ) {
					theotherone = document.getElementById("N" + theobject.id.substring(1));
				} else {
					theotherone = document.getElementById("P" + theobject.id.substring(1));
				}
				theotherone.style.display = "none";
				
				theobject.innerHTML = "Hold on...";
				
				theobject.style.color = "#777777";
				//theobject.style = "text-decoration:none;"
							
				//alert("whatever");
				return false;
			 
			}

			/*
			
			function addEvent(a,e,o)
			{
			 if(document.addEventListener)
			 {
			  a.removeEventListener(e,o,false);
			  a.addEventListener(e,o,false);
			 }
			 else
			 {
			  a.detachEvent('on'+e,o);
			  a.attachEvent('on'+e,o);
			 }
			}

			a=document.getElementsByTagName('A');
			for(i=0;i<a.length;i++)
			{
			 addEvent(a[i],'click',count);
			}
			
			*/

		</script>

		
	</body>
</html>
