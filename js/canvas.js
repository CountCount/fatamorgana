// Drawing mode
$(document).ready(function() {
	var colorPurple = "#cb3594";
	var colorGreen = "#659b41";
	var colorYellow = "#ffcf33";
	var colorBrown = "#986928";

	var curColor = colorPurple;
	var clickColor = new Array();
	
	var clickSize = new Array();
	var curSize = "normal";
	
	var canvasDrawDiv = $('#canvasDrawDiv');
	var canvasDrawWidth = canvasDrawDiv.width();
	var canvasDrawHeight = canvasDrawDiv.height();
	var canvasDraw = document.createElement('canvas');
	canvasDraw.setAttribute('width', canvasDrawWidth);
	canvasDraw.setAttribute('height', canvasDrawHeight);
	canvasDraw.setAttribute('id', 'canvasDraw');
	canvasDrawDiv.append(canvasDraw);

	if(typeof G_vmlCanvasManager != 'undefined') {
		canvasDraw = G_vmlCanvasManager.initElement(canvasDraw);
	}
	var contextDraw = canvasDraw.getContext("2d");

	$('#canvasDraw').mousedown(function(e){
		var mouseX = e.pageX - this.offsetLeft - $('#map-wrapper').offset().left;
		var mouseY = e.pageY - this.offsetTop - $('#map-wrapper').offset().top;
			//alert(mouseX + ' | ' + mouseY);
		paint = true;
		addClick(mouseX, mouseY);
		redraw();
	});

	$('#canvasDraw').mousemove(function(e){
		if(paint){
			addClick(e.pageX - this.offsetLeft - $('#map-wrapper').offset().left, e.pageY - this.offsetTop - $('#map-wrapper').offset().top, true);
			redraw();
		}
	});

	$('#canvasDraw').mouseup(function(e){
		paint = false;
	});

	$('#canvasDraw').mouseleave(function(e){
		paint = false;
	});
	
	$('.canvas-tools #clear-canvasDraw').click(function(e) {
		e.preventDefault();
		contextDraw.clearRect(0,0,contextDraw.canvas.width,contextDraw.canvas.height);
		contextDraw.beginPath();
		clickColor = new Array();
		clickSize = new Array();
		clickX = new Array();
		clickY = new Array();
		clickDrag = new Array();
	});
	$('.canvas-tools .draw-color').click(function(e) {
		curColor = $(this).attr('ref');
		$('.canvas-tools .draw-color').removeClass('active');
		$(this).addClass('active');
	});
	$('.canvas-tools .draw-size').click(function(e) {
		curSize = $(this).attr('ref');
		$('.canvas-tools .draw-size').removeClass('active');
		$(this).addClass('active');
	});
	$('.canvas-tools #save-canvasDraw').click(function(e) {
		e.preventDefault();
		var oCanvas = document.getElementById("canvasDraw");  
		Canvas2Image.saveAsPNG(oCanvas); 
	});
	

	var clickX = new Array();
	var clickY = new Array();
	var clickDrag = new Array();
	var paint;

	function addClick(x, y, dragging)
	{
		clickX.push(x);
		clickY.push(y);
		clickDrag.push(dragging);
		clickColor.push(curColor);
		clickSize.push(curSize);
	}

	function redraw(){
		canvasDraw.width = canvasDraw.width; // Clears the canvas
		
		contextDraw.strokeStyle = "#cb3594";
		contextDraw.lineJoin = "round";
		/*context.lineWidth = 5;*/
				
		for(var i=0; i < clickX.length; i++)
		{		
			contextDraw.beginPath();
			if(clickDrag[i] && i){
				contextDraw.moveTo(clickX[i-1], clickY[i-1]);
			 }else{
				 contextDraw.moveTo(clickX[i]-1, clickY[i]);
			 }
			 contextDraw.lineTo(clickX[i], clickY[i]);
			 contextDraw.closePath();
			 contextDraw.strokeStyle = clickColor[i];
			 contextDraw.lineWidth = clickSize[i];
			 contextDraw.stroke();
		}
	}
});


// Planning mode
$(document).ready(function() {
	var colorR1 = "#ff00ff";
	var colorR2 = "#00ff00";
	var colorR3 = "#ffff00";
	var colorR4 = "#00ffff";
	var colorR5 = "#ff0000";

	var curRColor = colorR1;
	var clickRColor = new Array();
	
	var curRoute = 1;
	var routeOffset = new Array(16,12,20,8,24);
	
	var canvasPlanDiv = $('#canvasPlanDiv');
	var canvasPlanWidth = canvasPlanDiv.width();
	var canvasPlanHeight = canvasPlanDiv.height();
	var canvasPlan = document.createElement('canvas');
	canvasPlan.setAttribute('width', canvasPlanWidth);
	canvasPlan.setAttribute('height', canvasPlanHeight);
	canvasPlan.setAttribute('id', 'canvasPlan');
	canvasPlanDiv.append(canvasPlan);

	if(typeof G_vmlCanvasManager != 'undefined') {
		canvasPlan = G_vmlCanvasManager.initElement(canvasPlan);
	}
	var contextPlan = canvasPlan.getContext("2d");

	$('#canvasPlan').mousedown(function(e){		
		//paint = true;
		//addRClick(mouseX, mouseY);
		//replan();
	});

	$('#canvasPlan').mousemove(function(e){

	});

	$('#canvasPlan').mouseup(function(e){
		//paint = false;
		var mouseX = e.pageX - this.offsetLeft - $('#map-wrapper').offset().left;
		var mouseY = e.pageY - this.offsetTop - $('#map-wrapper').offset().top;
		var msg = mouseX + '|' + mouseY;
		if ( data.tx != undefined ) {
			var cx = Math.floor(mouseX / 32);
			var cy = Math.floor(mouseY / 32);
			
			eval('var clickRX = clickRX'+curRoute+';');
			eval('var clickRY = clickRY'+curRoute+';');
			
			if ( clickRX.length == 0 ) {
				if ( (cx == data.tx || cy == data.ty) && !(cx == data.tx && cy == data.ty) ) {
					addRoutePoint(data.tx,data.ty);
					addRoutePoint(cx,cy);
				}
				else {
					ajaxInfo('Das erste Kontrollfeld muss auf einer der Stadtachsen liegen.');
					//alert('Das erste Kontrollfeld muss auf einer der Stadtachsen liegen.');
				}
			}
			else {
				if ( (cx == clickRX[clickRX.length - 1] || cy == clickRY[clickRY.length - 1]) && !(cx == clickRX[clickRX.length - 1] && cy == clickRY[clickRY.length - 1]) ) {
					addRoutePoint(cx,cy);
				}
				else {
					ajaxInfo('Das nächste Feld muss in gerader Laufrichtung liegen.');
					//alert('Das nächste Feld muss in gerader Laufrichtung liegen.');
				}
				
			}
			msg += ' - Koordinaten: ' + cx + '|' + cy + ' - Relativ: ' + (cx - data.tx) + '|' + (data.ty - cy);
		}
		else {
			msg += ' - data not in scope.';
		}
		//alert(msg);

	});

	$('#canvasPlan').mouseleave(function(e){
		//paint = false;
	});
	
	$('.canvas-tools #clear-canvasPlan').click(function(e) {
		contextPlan.clearRect(0,0,contextPlan.canvas.width,contextPlan.canvas.height);
		contextPlan.beginPath();
		clickRX1 = new Array();
		clickRY1 = new Array();
		clickRX2 = new Array();
		clickRY2 = new Array();
		clickRX3 = new Array();
		clickRY3 = new Array();
		clickRX4 = new Array();
		clickRY4 = new Array();
		clickRX5 = new Array();
		clickRY5 = new Array();
		clickRX = new Array();
		clickRY = new Array();
	});
	$('.canvas-tools .draw-route').click(function(e) {
		curRoute = $(this).attr('ref');
		$('.canvas-tools .draw-route').removeClass('active');
		$(this).addClass('active');
	});	
	$('.canvas-tools #save-canvasPlan').click(function(e) {
		e.preventDefault();
		var oCanvas = document.getElementById("canvasPlan");  
		Canvas2Image.saveAsPNG(oCanvas); 
	});

	var clickRX1 = new Array();
	var clickRY1 = new Array();
	var clickRX2 = new Array();
	var clickRY2 = new Array();
	var clickRX3 = new Array();
	var clickRY3 = new Array();
	var clickRX4 = new Array();
	var clickRY4 = new Array();
	var clickRX5 = new Array();
	var clickRY5 = new Array();

	function addRoutePoint(x,y) {
		if ( curRoute == 1 ) {
			clickRX1.push(x);
			clickRY1.push(y);
		}
		else if ( curRoute == 2 ) {
			clickRX2.push(x);
			clickRY2.push(y);
		}
		else if ( curRoute == 3 ) {
			clickRX3.push(x);
			clickRY3.push(y);
		}		
		else if ( curRoute == 4 ) {
			clickRX4.push(x);
			clickRY4.push(y);
		}
		else if ( curRoute == 5 ) {
			clickRX5.push(x);
			clickRY5.push(y);
		}
		drawRoutes();
	}
	function drawRoutes() {
		canvasPlan.width = canvasPlan.width; // Clears the canvas
		
		contextPlan.lineJoin = "round";
		contextPlan.lineWidth = 5;
		for (var r = 1; r < 6; r++) {
			var curOffset = routeOffset[r-1];
			eval('var clickRX = clickRX'+r+';');
			eval('var clickRY = clickRY'+r+';');
			eval('contextPlan.strokeStyle = colorR'+r+';');
			for (var i = 0; i < clickRX.length; i++) {
				contextPlan.beginPath();
				if (i > 0) {
					contextPlan.moveTo(clickRX[i-1]*32+curOffset, clickRY[i-1]*32+curOffset);
				}
				else {
					contextPlan.moveTo((clickRX[i])*32+curOffset-1, clickRY[i]*32+curOffset);
				}
				contextPlan.lineTo(clickRX[i]*32+curOffset,clickRY[i]*32+curOffset);
				contextPlan.closePath();
				contextPlan.stroke();
			}
		}
	}
	function drawRouteConnection(x,y) {
		canvasPlan.width = canvasPlan.width; // Clears the canvas
		contextPlan.strokeStyle = curRColor;
		contextPlan.lineJoin = "round";
		contextPlan.lineWidth = 5;
		for(var i=0; i < clickRX.length; i++) {
			contextPlan.beginPath();
			if(i>0){
				contextPlan.moveTo(clickRX[i-1]*32+routeOffset[clickRR[i]-1], clickRY[i-1]*32+routeOffset[i-1]);
			 }else{
				 contextPlan.moveTo((clickRX[i])*32+routeOffset[i-1]-1, clickRY[i]*32+routeOffset[i-1]);
			 }
			contextPlan.lineTo(clickRX[i]*32+routeOffset[i-1],clickRY[i]*32+routeOffset[i-1]);
			contextPlan.closePath();
			contextPlan.stroke();
		}
	}
});