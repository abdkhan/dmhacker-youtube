<head>
    <base href="/">

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>YouTube Video Player</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>

    <!-- Angular -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular-cookies.min.js"></script>
    <script src="/static/js/app.js"></script>

    <style>
        html,
        body,
        .main-container {
            height: 100%;
        }

        body {
            background-color: whitesmoke;
        }
    </style>
</head>
<?php 
$curl = curl_init("http://youtube-scrape.herokuapp.com/api/search/?q=tera%20ghata");
curl_setopt($curl, CURLOPT_FAILONERROR, true); 
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   
$result = curl_exec($curl); 


$json = json_decode($result, true); // decode the JSON into an associative array
//echo '<pre>' . print_r($json, true) . '</pre>';




foreach ($json['results'] as $field => $value) {
    // Use $field and $value here
	echo $json['results'][$field]['video']['title'].'<br>';
	
	$pieces = explode("=", $json['results'][$field]['video']['url']);
	
		if (strpos($pieces[1], '&') !== false) 
			{
				$pie = explode("&", $pieces[1]);
				$link=$pie[0];
			}
			else
			{
				$link=$pieces[1];
			}
			
    echo '<form ng-submit="searchView()">';
    echo '<div class="row">';
    echo '<div class="input-field col s12">';
    echo '<input type="hidden" ng-model="ytSearch" id="ytSearch" class="validate" value='.$link.'>';
    echo '<label for="ytSearch">Search Query</label> </div></div>';
                        
    echo '<div class="row">';
    echo '<div class="input-field col s12">';
    echo '<button type="submit" class="waves-effect waves-light btn red">Go</button>';
    echo '</div>';
	
	echo '<a href="https://abdkhan.herokuapp.com/site/'.$link.'.mp4">'.$link.'</a><br>';
	echo $json['results'][$field]['video']['duration'].'<br>';
	echo $json['results'][$field]['video']['snippet'].'<br>';
	echo $json['results'][$field]['video']['upload_date'].'<br>';
	echo $json['results'][$field]['video']['thumbnail_src'].'<br>';
	echo $json['results'][$field]['video']['views'].'<br><br><br>';
	
	//echo  $json['results']['$value']['video']['title'];
}

//echo '<pre>' . print_r($json, true) . '</pre>';

//echo $json;
?>


