<div id="map-wrapper" class="clearfix">
	<div id="userInfoBox"></div>
	<div id="map" class="clearfix"></div>
	<div id="canvasDrawDiv" class="hideme"></div>
	<div id="canvasPlanDiv" class="hideme"></div>
</div>
<div id="box" style="display:none;" class="clearfix">
	<div id="box-protection" class="hideme"></div>
	<div id="box-content">
		<ul id="box-tabs" class="clearfix">
			<li id="tab-zone-info" ref="zone-info" class="box-tab active click" title="zona"></li>
			<li id="tab-item-info" ref="item-info" class="box-tab click" title="artículos"></li>
			<li id="tab-town-info" ref="town-info" class="box-tab click" title="pueblo"></li>
			<li id="tab-citizens" ref="citizens" class="box-tab click" title="habitante"></li>
			<li id="tab-storms" ref="storms" class="box-tab click" title="tormentas"></li>
			<li id="tab-ruins" ref="ruins" class="box-tab click" title="ruinas"></li>
			<li id="tab-expeditions" ref="expeditions" class="box-tab click" title="expediciones"></li>
			<li id="tab-options" ref="options" class="box-tab click" title="opciones"></li>
		</ul>
		
		<div id="zone-info" class="box-tab-content"></div>
		<div id="storms" class="box-tab-content hideme">Por favor espere...</div>
		<div id="expeditions" class="box-tab-content hideme">Por favor espere...</div>
		<div id="ruins" class="box-tab-content hideme">Por favor espere...</div>
		<div id="citizens" class="box-tab-content hideme">Por favor espere...</div>
		
		<div id="item-info" class="hideme box-tab-content">
			<p class="desc">Estos artículos se pueden encontrar en el Ultramundo. Haga clic en un elemento para mostrar sus posiciones.</p>
			<div id="item-info-Rsc" class="zone-item-cat clearfix click" state="0"><h3>Recursos</h3></div>
			<div id="item-info-Box" class="zone-item-cat clearfix click" state="0"><h3>Contenedores</h3></div>
			<div id="item-info-Furniture" class="zone-item-cat clearfix click" state="0"><h3>Objetos caseros</h3></div>
			<div id="item-info-Drug" class="zone-item-cat clearfix click" state="0"><h3>Farmacia</h3></div>
			<div id="item-info-Armor" class="zone-item-cat clearfix click" state="0"><h3>Defensas</h3></div>
			<div id="item-info-Food" class="zone-item-cat clearfix click" state="0"><h3>Provisiones</h3></div>
			<div id="item-info-Weapon" class="zone-item-cat clearfix click" state="0"><h3>Armería</h3></div>
			<div id="item-info-Misc" class="zone-item-cat clearfix click" state="0"><h3>Varios</h3></div>
		</div>
		
		<div id="town-info" class="hideme box-tab-content">
			<p class="desc">Estos artículos se pueden encontrar en el almacén. Haga clic en un elemento para mostrar sus posiciones en el Ultramundo.</p>
			<div id="town-info-Rsc" class="zone-item-cat clearfix click" state="0"><h3>Recursos</h3></div>
			<div id="town-info-Box" class="zone-item-cat clearfix click" state="0"><h3>Contenedores</h3></div>
			<div id="town-info-Furniture" class="zone-item-cat clearfix click" state="0"><h3>Objetos caseros</h3></div>
			<div id="town-info-Drug" class="zone-item-cat clearfix click" state="0"><h3>Farmacia</h3></div>
			<div id="town-info-Armor" class="zone-item-cat clearfix click" state="0"><h3>Defensas</h3></div>
			<div id="town-info-Food" class="zone-item-cat clearfix click" state="0"><h3>Provisiones</h3></div>
			<div id="town-info-Weapon" class="zone-item-cat clearfix click" state="0"><h3>Armería</h3></div>
			<div id="town-info-Misc" class="zone-item-cat clearfix click" state="0"><h3>Varios</h3></div>
		</div>
		
		<div id="options" class="hideme box-tab-content">
			<div id="options-radius" class="options-section">
				<p class="desc"><strong>Radios</strong><br/>Introduce una distancia, selecciona un color y haz click en "Indicar" para representar el radio en el mapa.</p>
				<div id="colorpicker"></div>
				<input class="hideme" type="text" id="opt-radius-color" name="opt-radius-color" value="#9999ff" />
				<input type="text" id="opt-radius-number" name="opt-radius-number" value="9" size="4" maxlength="2" /><input type="radio" id="opt-radius-ap" name="opt-radius-metric" value="ap" checked="checked" /> PA&nbsp;&nbsp;<input type="radio" id="opt-radius-km" name="opt-radius-metric" value="km" /> km&nbsp;&nbsp;<button id="opt-radius-submit">Indicar</button><br/><span class="hideme click interactive" onclick="removeRadius();">Eliminar todos los radios</span>
				<div id="radius-list"></div>
			</div>
			<div id="options-display" class="options-section">
				<p class="desc"><strong>Configuración</strong><br/>Haz click en una de las opciones de visualización de información para activarla o desactivarla.</p>
				<div id="options-display-zonehover" class="click options-display-switch active-option">rondan la zona</div>
				<div id="options-display-geodir" class="click options-display-switch">puntos cardinales</div>
				<div id="options-display-driedzone" class="click options-display-option" ref="zone-status-dried">las zonas agotadas</div>
				<div id="options-display-fullzone" class="click options-display-option active-option" ref="zone-status-full">las zonas regeneradas</div>
				<div id="options-display-citizens" class="click options-display-option active-option" ref="citizen">los residentes</div>
				<div id="options-display-zombies" class="click options-display-option" ref="zombies">zombies</div>
				<div id="options-display-uptodate" class="click options-display-option active-option" ref="zone-updated">estado de actualización</div>
			</div>
			<div id="options-qrcode" class="options-section">
				<p class="desc"><strong>Barra de marcadores</strong><br/>Para acceder directamente a Fata Morgana, pon este <a href="<?=$bookmark?>">enlace</a> en tu barra de marcadores.</p>
				<p class="desc"><strong>Código QR</strong><br/>Usa el código QR ​​para acceder a Fata Morgana con tu smartphone.<br><br><?=$qrcode?></p>
				<div id="options-qrcode-img-wrapper" class=""></div>
			</div>
		</div>
	</div>
</div>
<div id="tools" class="clearfix hideme">
	<div id="tools-protection" class="hideme"></div>
	<div id="tools-content">
		<ul id="tools-tabs" class="clearfix">
			<li id="tab-tools-colors" ref="tools-colors" class="tools-tab active click" title="Colores"></li>
			<li id="tab-tools-options" ref="tools-options" class="hideme tools-tab click" title="Opciones"></li>
			<li id="tab-tools-planner" ref="tools-planner" class="tools-tab click" title="Planificador"></li>
		</ul>
		
		<div id="tools-colors" class="tools-tab-content">
			<ul class="canvas-tools">
				<li><a class="interactive click" id="clear-canvasDraw">borrar</a> el área de dibujo<br><a class="interactive click" id="save-canvasDraw">guardar</a> el área de dibujo</li>
			</ul>
			<ul class="canvas-tools">
				<li>Stiftfarbe</li>
				<li class="draw-color click active" id="choosePurple" ref="#ff00ff">púrpura</li>
				<li class="draw-color click" id="chooseGreen" ref="#00ff00">verde</li>
				<li class="draw-color click" id="chooseYellow" ref="#ffff00">amarillo</li>
				<li class="draw-color click" id="chooseBrown" ref="#cc9900">marrón</li>
			</ul>
			<ul class="canvas-tools">
				<li>Stiftgröße</li>
				<li class="draw-size click active" id="chooseS" ref="3">parvo</li>
				<li class="draw-size click" id="chooseM" ref="5">normal</li>
				<li class="draw-size click" id="chooseL" ref="8">magno</li>
				<li class="draw-size click" id="chooseX" ref="12">gigante</li>
      </ul>
		</div>
		
		<?php /* <div id="tools-options" class="hideme tools-tab-content">
			<div id="tools-options-colorwheel" class="options-section">
				<p class="desc"><strong>Farbrad</strong><br/>Wähle eine Farbe!</p>
				<div id="tools-colorpicker"></div>
				<input type="text" id="t-opt-radius-color" name="opt-radius-color" value="#9999ff" />
			</div>
		</div> */ ?>
		<div id="tools-planner" class="hideme tools-tab-content">
			<ul class="canvas-tools">
				<li><a class="interactive click" id="clear-canvasPlan">borrar</a> el área de dibujo<br><a class="interactive click" id="save-canvasPlan">guardar</a> el área de dibujo</li>
			</ul>
			<ul class="canvas-tools">
				<li>Route</li> 
				<li class="draw-route click active" id="chooseR1" ref="1">ruta 1 (team púrpura)</li>
				<li class="draw-route click" id="chooseR2" ref="2">ruta 2 (team verde)</li>
				<li class="draw-route click" id="chooseR3" ref="3">ruta 3 (team amarillo)</li>
				<li class="draw-route click" id="chooseR4" ref="4">ruta 4 (team turquesa)</li>
				<li class="draw-route click" id="chooseR5" ref="5">ruta 5 (team rojo)</li>
			</ul>
				
      </ul>
		</div>
	</div>
</div>
<div id="map-hover">
	<div id="map-hover-content">
		<div id="map-hover-coords"></div>
		<div id="map-hover-building"></div>
		<div id="map-hover-status"></div>
		<div id="map-hover-citizens"></div>
		<div id="map-hover-zombies"></div>
		<div id="map-hover-items"></div>
	</div>
</div>
<div id="item-selector" class="hideme">
	<div id="item-selector-Rsc" class="item-selector-cat clearfix"><h3>Recursos</h3></div>
	<div id="item-selector-Box" class="item-selector-cat clearfix"><h3>Contenedores</h3></div>
	<div id="item-selector-Furniture" class="item-selector-cat clearfix"><h3>Objetos caseros</h3></div>
	<div id="item-selector-Drug" class="item-selector-cat clearfix"><h3>Farmacia</h3></div>
	<div id="item-selector-Armor" class="item-selector-cat clearfix"><h3>Defensas</h3></div>
	<div id="item-selector-Food" class="item-selector-cat clearfix"><h3>Provisiones</h3></div>
	<div id="item-selector-Weapon" class="item-selector-cat clearfix"><h3>Armería</h3></div>
	<div id="item-selector-Misc" class="item-selector-cat clearfix"><h3>Varios</h3></div>
</div>
<script type="text/javascript"> 
var fm_url = 'http://dv.sindevel.com/fm/';
var secureKey = "<?=$secureKey?>";
var radiusCounter = 1;
var mapHoverActive = true;
var mapHoverMoved = false;
var data = <?=$gamemap?>;
</script>
