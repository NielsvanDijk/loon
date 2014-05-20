<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Wijverdienenmeer.nl</title>
	
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
   	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
   	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700' rel='stylesheet' type='text/css'>
	
	<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
	<script src="assets/js/main.js"></script>
</head>
<body>

<header>
	<div class="container">
		<div class="utilities">
			<div class="entypo info"></div> <a href="#">Informatie</a>
			<div class="entypo text-doc"></div> <a href="#">Disclaimer</a>
		</div>
	
		<div id="logo">
			<a href="#">Wijverdienenmeer.nl</a>
		</div>
	
		<div class="language">

			{{ Form::open(['action' => 'LoonController@postChangeLanguage']) }}
			    {{Form::select('language',['nl'=>'nl','po'=>'po'], @$language,['onchange'=>'submit()'])}}
			{{ Form::close()}}


			<i class="NL"></i>
			<i class="PL"></i>
			<i class="DE"></i>
			<i class="GRB"></i>
		</div>
	</div>
</header>
<div id="bigfoto"></div>