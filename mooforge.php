<?php

 //set up endpoint API YQL
 $endpoint = "http://query.yahooapis.com/v1/public/yql?q="; 

 $yqlforge = 'select * from html where url="http://mootools.net/forge/" and xpath="//div[@class=\'block\']" limit 2';

 $url = $endpoint  . urlencode($yqlforge) . '&diagnostics=false&format=xml';

 $data = get($url);

 function get($url) {
          $ch = curl_init();
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
          $data = curl_exec($ch);
          $data = preg_replace('/<\?.*?>/','',$data);
          $data = preg_replace('/<\!--.*-->/','',$data);
          $data = preg_replace('/.*?<results>/','',$data);
          $data = preg_replace('/<\/results>.*/','',$data);
          $data = preg_replace('/ href="/',' href="http://mootools.net',$data);
          $data = preg_replace('/ src="/',' src="http://mootools.net',$data);
          curl_close($ch); 
          if(empty($data)) {return 'Server Timeout. Try agai later!';}
                 else {return $data;}
 }//end function get

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Grab Forge using PHP</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <link  href="http://fonts.googleapis.com/css?family=Vollkorn:regular,italic,bold,bolditalic&subset=latin" rel="stylesheet" type="text/css" >
   <style type="text/css">
html,body{  font-family: 'Vollkorn', serif;background: #fff;font-size: 14px}
ul.projects {width: 700px;position: relative}
.projects li{
float:left;
list-style-type:none;
margin-bottom:15px;
margin-right:52px;
margin-top: 20px;
position:relative;
height:100px;
width:187px;
border: 1px solid #ccc;
}

.block {clear: both}
ul, ol {margin:0 1.5em 1.5em;}
.projects li span.downloads {font-size:30px;position:absolute;top:0;right:3px;color: orange}

.projects li .name {
color: #393;
display:block;
font-weight:bold;
margin-bottom:5px;
}

li a {text-decoration: none}
.blue {color: orange}

a{color: #393}

#ft{margin-top: 20px}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>/ MooTools / <a href="http://mootools.net/forge">Forge</a></h1></div>
   <div id="bd" role="main">
	<div class="yui-g">

          <?php echo$data; ?>

	</div>
	</div>
   <div id="ft" role="contentinfo"><p>Created by @<a href="http://twitter.com/thinkphp">thinkphp</a> using YUI, YQL and Xpath</p></div>
</div>
</body>
</html>

