<!DOCTYPE HTML> 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/fm.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/canvas.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/canvas2image.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/base64.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/farbtastic.js"></script>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/canvas.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/farbtastic.css" />
		<link rel="icon" type="image/x-icon" href="<?=base_url()?>img/favicon.ico" size="16x16" /> 
		
		<title>Fata Morgana</title> 
		
		<!--[if IE]><script type="text/javascript" src="<?=base_url()?>js/excanvas.js"></script><![endif]-->
	</head>
	<body>
		<div id="modeBar" class="clearfix">
			<h1 class="fatafont">fata morgana</h1>
			<h5>iniciado como <span id="owner-name"></span></h5>
			<div class="mode-switch click active-mode" id="mode-normal">modo mapa</div>
			<div class="mode-switch click" id="mode-draw">modo pintura</div>
			<div class="mode-switch click" id="mode-planner">modo plano</div>
			<div class="help-switch click" id="mode-help">preguntas más frecuentes</div>
		</div>
		<div id="townBar" class="clearfix hideme"><h2 id="townInfo"><span id="townDay"></span><span id="townName"></span><span id="townID"></span><span id="townSpy"><a href="#" target="_new">Enlace de espionaje</a></span></h2></div>
		<div id="help-section" class="hidefaq">
			<h2>preguntas más frecuentes</h2>
			<p>Actualmente disponible en español</p>
			<!--<ul>
				<li><h4>What is the Fata Morgana?</h4><p><em>Fata Morgana</em> is a map tool for the browser game <strong>Zombinoia</strong>.</p></li>
				<li><h4>Where does the name come from?</h4><p>The name <em>Fata Morgana</em> arose from frustration. Often enough, I wanted to get some item from the desert only to find it were gone already, a Fata Morgana so to say.</p></li>
				<li><h4>What is the map mode?</h4><p>By default, <em>Fata Morgan</em> opens in map mode. This works, well, like a map. You can see at a glance where your fellow citiens are and you can search for items in the world beyond. You can investigate individual zones and also edit the respective data.</p></li>
        <li><h4>Wait, how can you search for items?</h4><p>While in map mode click on the second tab of the info box to the right (marked with a lens). You'll see a list of all items that are currently known to the Fata Morgana and (this is the cool stuff) are present in your town's desert. Just click on any item to highlight zones where this item is on the ground. You can click several items at a time and you can even click on the category name to get all items of that category.</p></li>
        <li><h4>What is the drawing mode?</h4><p>The drawing mode can be used to illustrate the map, you can literally draw on the map. This will be important as soon as the camping feature is enabled in Zombinoia. When you are finished drawing, you can save your drawing to your hard drive.</p></li>
        <li><h4>How is the storm observation working?</h4><p>The XML data does not contain information about the last night's storm, but here you have the possibility to keep track of all storms. This inly works if you have the search tower built in your town.</p></li>
				<li><h4>When I save the drawing, why is there this funky file name?</h4><p>Currently, it's not possible to set a defined name for auto-generated downloads from HTML5 canvas. Each browser handles this differently, e.g. Google Chrome just names it "download". But if you rename the file to "whatever.png" it will open as an image file (PNG).</p></li>
				<li><h4>What is the planning mode?</h4><p>Planning mode is very similar to drawing mode, however you can only draw in straight lines, just like the way you move in the world beyond. That way you can sketch a path for any group of ypur town.</p></li>
        <li><h4>What is the spy link for?</h4><p>Only you and your town mates can see your map under normal conditions. However, by sharing the spy link, ANYONE with that link can take a look at your town. Of course, they can not change any data. So, you want to boast of how you cleared the map of zombies? You want to show the world that you lasted for more than two weeks? Well, this link is for you: just copy&paste it to any forum.</p></li>
				<li><h4>I found an error, what shall I do?</h4><p>Since I am also the creator of the Oval Office, you could post something there. Or you just send me (SinSniper) a message through the Twinoid system. Please keep in mind, that my Spanish is awful, if you are capable of English or German it would make things easier for me.</p></li>
				<li><h4>My malware blocker says your site is calling external files?</h4><p>Various images (i.e. item icons) are coming from the official Zombinoia server. The libraries jQuery and jQuery UI are loaded from Google's code repository. The QR code is generated by a Google API. Statistical data is only tracked on this server, <strong>no external services</strong> (like Google Analytics) are used.</p></li>
			</ul>-->
<ul>
  <li><h4>¿Qué es Fata Morgana?</h4><p><em>Fata Morgana</em> es una herramienta de mapa para el juego de navegador <strong>Zombinoia</strong>.</p></li>
  <li><h4>¿De dónde viene el nombre?</h4><p>El nombre <em>Fata Morgana</em> surgió de la frustración. Bastante a menudo, yo quería recoger algún objeto del desierto, pero descubría que ya lo habían recogido, una Fata Morgana por así decirlo.</p></li>
  <li><h4>¿Qué es el modo mapa?</h4><p>Por defecto, <em>Fata Morgan</em> se abre en modo mapa. Esto funciona, bueno, como un mapa. Puedes ver de un vistazo dónde están tus compañeros habitantes y puedes buscar objetos en el Ultramundo. Puedes investigar zonas individuales y también editar los datos respectivos.</p></li>
  <li><h4>Espera, ¿cómo puedes buscar objetos?</h4><p>Mientras estés en modo mapa, haz click en la segunda pestaña de la ventana de información de la derecha (marcada con una lupa). Verás una lista de todos los objetos que Fata Morgana conoce actualmente y (esto es lo mejor) están presentes en el desierto de tu pueblo. Sólo clicka en cualquier objeto para resaltar las zonas donde este objeto está en el suelo. Puedes hacer click a varios objetos a la vez e incluso puedes hacer click en el nombre de la categoría para ver todos los objetos de esa categoría.</p></li>
  <li><h4>¿Qué es el modo pintura?</h4><p>El modo pintura se puede usar para ilustrar el mapa, literalmente puedes dibujar en él. ESto será importante en cuanto se habilite el modo acampada en Zombinoia. Cuando hayas terminado de dibujar, puedes guardar tu dibujo en tu disco duro.</p></li>
  <li><h4>¿Cómo funciona la observación de tormentas?</h4><p>Los datos XML no contienen información sobre las tormentas de la pasada noche, pero aquí tienes la posibilidad de realizar un seguimiento de todas las tormentas. Esto sólo funciona si tienes la torre de vigilancia construida en tu pueblo.</p></li>
  <li><h4>Cuando guardo el dibujo, ¿por qué se descarga con ese nombre?</h4><p>Actualmente no es posible escribir un nombre definido para descargas auto-generadas desde un lienzo HTML5. Cada navegador lo hace de una forma distinta, por ejemplo: Google Chrome simplemente llama al archivo "descarga". Pero si renombras el archivo a "loquesea.png" se abrirá como un archivo de imagen (PNG).</p></li>
  <li><h4>¿Qué es el modo plano?</h4><p>El modo plano es muy similar al modo pintura, sin embargo sólo puedes dibujar con líneas rectas, tal y como te mueves en el Ultramundo. De esta forma puedes trazar una ruta para cada grupo de tu pueblo.</p></li>
  <li><h4>¿Para qué es el enlace de espionaje?</h4><p>Sólo tú y tus compañeros de pueblo podéis ver vuestro mapa bajo condiciones normales. No obstante, compartiendo el enlace de espionaje, CUALQUIERA que posea el enlace puede echar un vistazo a tu pueblo. Por supuesto, no podrán cambiar ningún dato. Entonces, ¿quieres presumir de cómo limpiaste el mapa de zombies? ¿Quieres mostrar al mundo que duraste más de dos semanas? Bueno, este enlace es para ti: sólo cópialo y pégalo en cualquier foro.</p></li>
  <li><h4>Encontré un error, ¿qué debo hacer?</h4><p>Como también soy el creador del Oval Office, podrías postear algo allí. O sólo envíame (SinSniper) un mensaje a través del sistema de Twinoid. Por favor, ten en cuenta que mi español es horrible, si sabes hablar inglés o alemán las cosas serían más fáciles para mí.</p></li>
  <li><h4>Mi bloqueador de malware dice que tu sitio está llamando a archivos externos.</h4><p>Varias imágenes (por ejemplo: los iconos de los objetos) vienen del servidor oficial de Zombinoia. Las libraries jQuery y jQuery UI son cargadas desde el código repositorio de Google. El código QR es generado por una API de Google. Los datos estadísticos sólo son rastreados en este servidor, <strong>ningunos servicios externos</strong> (como Google Analytics) son usados.</p></li>
</ul>
		</div>
		<div id="fm-container" class="clearfix tl">
			<div id="fm-content" class="clearfix">