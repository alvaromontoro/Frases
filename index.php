<?php 
require_once("./admin/__classes.php");
$LESSON_DIR = "./lessons/";

if (isset($_GET["lesson"])) {
	$lesson = new Lesson();
	$lesson->load("set" . $_GET["lesson"]);
}

$settings = Settings::load("./admin/settings");
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="Author" content="Alvaro Montoro" />
		<title>Completa la Frase</title>
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
		<link type="text/css" rel="stylesheet" href="./css/frases-styles.css" />
		<script>
			var sentences = <?php echo json_encode($lesson->sentences); ?>;
			var settings  = {
							<?php foreach($settings as $setting) { ?>"<?php echo $setting->code; ?>": "<?php echo $setting->text; ?>",<?php } ?>
							};
		</script>
	</head>
	<body>
		<div id="board">
			<div id="dropping_area"></div>
			<div id="button_game" class="palabra">
				<span>
					<script type="text/javascript">document.write(settings.buttonValue);</script>
				</span>
			</div>
		</div>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"></script>
		<script type="text/javascript" src="./js/frases-code.js"></script>
		
	</body>
</html>