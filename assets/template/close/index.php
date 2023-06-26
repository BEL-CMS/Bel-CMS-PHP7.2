<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=CMS_WEBSITE_NAME?> | Coming Soon</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="assets/template/close/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/assets/template/close/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/fassets/template/close/onts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/template/close/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="/assets/template/close/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/template/close/css/util.css">
	<link rel="stylesheet" type="text/css" href="/assets/template/close/css/main.css">
</head>
<body>
	<div class="simpleslide100">
		<div class="simpleslide100-item bg-img1" style="background-image: url('/assets/template/close/images/bg01.jpg');"></div>
		<div class="simpleslide100-item bg-img1" style="background-image: url('/assets/template/close/images/bg02.jpg');"></div>
		<div class="simpleslide100-item bg-img1" style="background-image: url('/assets/template/close/images/bg03.jpg');"></div>
	</div>
	<div class="size1 overlay1">
		<div class="size1 flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-50">
			<h3 class="l1-txt1 txt-center p-b-25">
				<?=$mtance["title"]?>
			</h3>

			<p class="m2-txt1 txt-center p-b-48">
				<?=$mtance["description"]?>
			</p>

			<p class="m2-txt1 txt-center p-b-20">
				<a href="/user/login&echo">Connexion</a>
			</p>
		</div>
	</div>
	<footer>Popuslé par <a href="https://bel-cms.dev">Bel-CMS</a></footer>
	<script src="assets/template/close/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="assets/template/close/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/template/close/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/template/close/vendor/select2/select2.min.js"></script>
	<script src="assets/template/close/vendor/countdowntime/moment.min.js"></script>
	<script src="assets/template/close/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="assets/template/close/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="assets/template/close/vendor/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 2019,
			endtimeMonth: 12,
			endtimeDate: 10,
			endtimeHours: 10,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "Europe/Brussels" 
		});
	</script>
	<script src="assets/template/close/endor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="assets/template/close/js/main.js"></script>

</body>
</html>