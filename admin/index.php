<?php 
	require_once("__classes.php"); 
	
	$lessons  = Lesson::loadLessons();
	$settings = Settings::load("settings");
	
?>
<!doctype html>
<html>
	<head>
	
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Frases Admin</title>
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
		<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="./admin-styles.css" />
		
	</head>
	
	<body>
	
		<nav class="navbar navbar-inverse">
			<div class="container">
			<h1 class="navbar-brand">Frases Se&ntilde;ora Montoro</h1>
			</div>
		</nav>
		
		<section class="container">
			<h2>
				Messages
				<a class="btn btn-primary pull-right" href="#"><span class="glyphicon glyphicon-floppy-disk"></span> Save Messages</a>
			</h2>
			
			<table class="table table-stripped table-bordered table-hover">
				<thead>
					<tr>
						<th class="col-xs-3">Message</th>
						<th class="col-xs-9">Text</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($settings as $setting) { ?>
					<tr>
						<td><?php echo $setting->title; ?></td>
						<td>
							<input type="text" name="<?php echo $setting->code; ?>" value="<?php echo $setting->text; ?>" class="form-control" />
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>

		<section class="container">
		
			<h2>
				Lessons
				<a class="btn btn-primary pull-right" href="#"><span class="glyphicon glyphicon-plus"></span> Create new lesson</a>
			</h2>
		
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="col-xs-1">Order</th>
						<th class="col-xs-6">Lesson Name</th>
						<th class="col-xs-1">Active?</th>
						<th class="col-xs-2"># of Sentences</th>
						<th class="col-xs-2">Options</th>
					</tr>
				</thead>
				<tbody>
					<?php $x=0; foreach($lessons as $lesson) { $x++; ?>
					<tr<?php if (!$lesson->active) { echo ' class="not-active"'; } ?>>
						<td><?php echo $x; ?></td>
						<td><?php echo $lesson->title; ?></td>
						<td><?php echo ($lesson->active ? "Yes" : "No"); ?></td>
						<td><?php echo count($lesson->sentences); ?></td>
						<td>
							<a href="#"><span class="glyphicon glyphicon-pencil" title="Quick edit (only settings)"></span></a>
							<a href="#"><span class="glyphicon glyphicon-edit" title="Advanced edit (settings + sentences)"></span></a>
							<a href="#"><span class="glyphicon glyphicon-eye-<?php echo ($lesson->active ? "close" : "open"); ?>" title="<?php echo ($lesson->active ? "Hide to students" : "Show to students"); ?>"></span></a>
							<a href="#"><span class="glyphicon glyphicon-circle-arrow-up" title="Move lesson up"></span></a>
							<a href="#"><span class="glyphicon glyphicon-circle-arrow-down" title="Move lesson down"></span></a>
							<a href="#"><span class="glyphicon glyphicon-remove" title="Delete lesson"></span></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</section>
		
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
	</body>
	
</html>