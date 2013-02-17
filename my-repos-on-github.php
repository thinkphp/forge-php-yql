 <?php
 $username = 'thinkphp';

//get time
$oldtime = microtime(true);

//your YQL statement
$yql = 'select * from json where url="http://thinkphp.ro/apps/php-hacks/forge-php-yql/github.repos.json.php"';

//start the URL by defining the API endpoint and encoding the query
$endpoint = 'http://query.yahooapis.com/v1/public/yql?q=';

$url = $endpoint . urlencode($yql);

//diagnostics - remove it if you don't need them
//$url .= '&diagnostics=true';

//format - (xml or JSON)
$url .= '&format=json';

$data = json_decode(get($url));

$repos = $data->query->results->json->json;

 $output = '';

 foreach($repos as $name) {

     $repo_name = $name->name;

     $repo_url = $name->url;

     $repo_desc = $name->description;

     $output .= "<a href='$repo_url' title='$repo_desc'>$repo_name</a>  ";
 }

 //function that uses cURL to load a resouce.
 function get($url) {
          $ch = curl_init();
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
          $data = curl_exec($ch);
          curl_close($ch); 
          if(empty($data)) {return 'Server Timeout. Try agai later!';}
                 else {return $data;}
 }//end function get

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>GitHub Repos</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <style type="text/css">   
                .cpojer-links{ font-size:14px; }
		.cpojer-links a	{
			display: inline-block;
			padding: 4px;
			outline: 0;
			color: #393;
			-webkit-transition-duration: 0.25s;
			-moz-transition-duration: 0.25s;
			-o-transition-duration: 0.25s;
			transition-duration: 0.25s;
			-webkit-transition-property: -webkit-transform;
			-moz-transition-property: -moz-transform;
			-o-transition-property: -o-transform;
			transition-property: transform;
			-webkit-transform: scale(1) rotate(0);
			-moz-transform: scale(1) rotate(0);
			-o-transform: scale(1) rotate(0);
			transform: scale(1) rotate(0);
		}
		.cpojer-links a:hover {
			background: #393;
			text-decoration: none;
			color: #fff;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			-o-border-radius: 4px;
			border-radius: 4px;
			-webkit-transform: scale(1.05) rotate(-1deg);
			-moz-transform: scale(1.05) rotate(-1deg);
			-o-transform: scale(1.05) rotate(-1deg);
			transform: scale(1.05) rotate(-1deg);
		}
		.cpojer-links a:nth-child(2n):hover {
		  -webkit-transform: scale(1.05) rotate(1deg);
		  -moz-transform: scale(1.05) rotate(1deg);
		  -o-transform: scale(1.05) rotate(1deg);
		  transform: scale(1.05) rotate(1deg);
		}

  #ft{margin-top: 40px;}
  #ft p a{color: #393}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>GitHub Repos</h1></div>
   <div id="bd" role="main">
	<div class="cpojer-links">
            <?php echo$output; ?>
	</div>
	</div>
   <div id="ft" role="contentinfo"><p>follow @<a href="http://twitter.com/thinkphp">thinkphp</a> on Twitter</p></div>
</div>
</body>
</html>