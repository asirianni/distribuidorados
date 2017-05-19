
<html>
<head>
<title>Bienvenido a Distribuidorados</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="<?php echo base_url()?>recursos/css/style.css" rel="stylesheet" type="text/css" media="all">
<!-- //css files -->
<!-- Supportive-JavaScript --> 
<script type="text/javascript" src="<?php echo base_url()?>recursos/js/jquery-2.1.4.min.js"></script>
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&subset=latin-ext" rel="stylesheet"><body>
</head>
<body>
<!--header-->
	<div class="countdown-timer-w3laits">
		<div class="starts">
			<h2>ESTAMOS EN PREPARACION</h2>
			<p>En breve podra acceder al portal</p>
		</div>
	</div>
<!--//header-->

<!--newsletter-->
	<div class="newsletter w3l-agile">
		<p>Registrese y le avisamos !</p>
		<div class="email">
			<form action="#" method="post">
				<input placeholder="Ingrese su correo" name="email" class="mail" type="email" required="">
				<input type="submit" value="subscribe">
			</form>
		</div>
	</div>
<!--//newsletter-->

<!-- Countdown-timer -->

				<div class="examples">
					<div class="simply-countdown-losange" id="simply-countdown-losange"></div>
				</div>
		
			<div class="clear"></div>
	
<!-- //Countdown-timer -->

	<!-- Custom-JavaScript-File-Links -->
	<!-- Countdown-Timer-JavaScript -->
			<script src="<?php echo base_url()?>recursos/js/simplyCountdown.js"></script>
			<script>
				var d = new Date(new Date().getTime() + 348 * 120 * 120 * 2000);

				// default example
				simplyCountdown('.simply-countdown-one', {
					year: d.getFullYear(),
					month: d.getMonth() + 1,
					day: d.getDate()
				});

				// inline example
				simplyCountdown('.simply-countdown-inline', {
					year: d.getFullYear(),
					month: d.getMonth() + 1,
					day: d.getDate(),
					inline: true
				});

				//jQuery example
				$('#simply-countdown-losange').simplyCountdown({
					year: d.getFullYear(),
					month: d.getMonth() + 1,
					day: d.getDate(),
					enableUtc: false
				});
			</script>
		<!-- //Countdown-Timer-JavaScript -->
	<!-- //Custom-JavaScript-File-Links -->



<!--footer-->
<div class="footer-w3">
	<p>&copy; 2017 | Desarrollado por <a href="https://www.facebook.com/Ordene-su-negocio-737763829635258"/>Adrian Sirianni</a></p>
</div>
<!--//footer-->

</body>
</html>