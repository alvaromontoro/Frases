<?php 
	require_once("__classes.php"); 
	
	$lesson = new Lesson();
	
	if (isset($_GET["id"])) {
		$lesson->load("set" . $_GET["id"]);
	}
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
				Lesson
				<a class="btn btn-success pull-right" href="#"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
				<a class="btn btn-danger pull-right margin-right-5" href="./"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
			</h2>
		
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="col-xs-3">Setting</th>
						<th class="col-xs-9">Values</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Lesson Title</td>
						<td>
							<input type="text" name="title" value="<?php echo $lesson->title; ?>" class="form-control" />
						</td>
					</tr>
					<tr>
						<td>Visible</td>
						<td>
							<input type="checkbox" <?php if ($lesson->active) { ?>checked="checked" <?php } ?>name="active" />
						</td>
					</tr>
					<tr>
						<td>Latest</td>
						<td>
							<input type="checkbox" <?php if ($lesson->order) { ?>checked="checked" <?php } ?>name="order" /> (checking this box will make this the current lesson)
						</td>
					</tr>
					<tr>
						<td>Sentences</td>
						<td>
							<?php foreach($lesson->sentences as $sentence) { ?>
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove"></span></button>
								</span>
								<input type="text" value="<?php echo $sentence; ?>" name="sentence" class="form-control" placeholder="Write sentence here, and remember: conjugated|infinitive">
							</div>
							<?php } ?>
							<a id="add-sentence" class="btn btn-primary pull-right" href="#" style="margin-top:10px;"><span class="glyphicon glyphicon-plus"></span> Add one more sentence</a>
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove"></span></button>
								</span>
								<input type="text" name="sentence" class="form-control" placeholder="Write sentence here, and remember: conjugated|infinitive">
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			
		</section>
		
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script>
		$("#add-sentence").on("click", function() {
			$(this).before($(this).next().clone(true));
		});
		
		$(".input-group").on("click", "button", function() {
			if (confirm("Are you sure you want to delete this sentence?")) {
				$(this).closest(".input-group").remove();
			}
		});
		</script>
		
	</body>
	
</html>