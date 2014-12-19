<html>
<head>
	<title>Javascript Box - OOP demo</title>
	<style>
	body {
		margin: 0px auto;
	}
	</style>
</head>
<body>

	<svg id="svg" xmlns="http://www.w3.org/2000/svg" style="height: 100%; width: 100%;"></svg>

	<script>

	// count time
	document.onclick = function(e) {
		playground.createNewCircle(e.x,e.y);
	}
	var mousedown_time;
		function getTime(){
			var date = new Date();
			return date.getTime();
		}
	document.onmousedown = function(e){ //technically we don't even need the mousedown variable but we're leaving it there for now..
			mousedown_time = getTime();
	}
	document.onmouseup = function(e){
		time_pressed = getTime() - mousedown_time;
		radius_rate = time_pressed*0.05;
		return radius_rate;
	}

	// set circle setting
	function Circle(cx, cy, html_id)
	{
		var new_radius = document.onmouseup();
		var html_id = html_id;
		this.info = { cx: cx,  cy: cy };
		
		//create random velocity
		var randomNumberBetween = function(min, max){
			return Math.random()*(max-min) + min;
		}
		this.initialize = function(){
			this.info.velocity = {
				x: randomNumberBetween(-3,3),
				y: randomNumberBetween(-3,3)
			}
			//create a circle 
			var circle = makeSVG('circle', 
				{ 	cx: this.info.cx,
				  	cy: this.info.cy,
				  	r:  new_radius,
				  	id: html_id,
				  	style: "fill: black"
				});
			document.getElementById('svg').appendChild(circle);
		}
		this.update = function(time){
			var el = document.getElementById(html_id);
			//see if the circle is going outside the browser. if it is, reverse the velocity
			// changed this.info.cx/y to be less than Circle.initizlize.circle[radius] for it to bounce off
			if( this.info.cx > document.body.clientWidth - new_radius || this.info.cx < new_radius)
			{
				this.info.velocity.x = this.info.velocity.x * -1;
			}
			if( this.info.cy > document.body.clientHeight - new_radius || this.info.cy < new_radius)
			{
				this.info.velocity.y = this.info.velocity.y * -1;
			}
			this.info.cx = this.info.cx + this.info.velocity.x*time;
			this.info.cy = this.info.cy + this.info.velocity.y*time;
			el.setAttribute("cx", this.info.cx);
			el.setAttribute("cy", this.info.cy);
		}
		//creates the SVG element and returns it
		var makeSVG = function(tag, attrs) {
	        var el= document.createElementNS('http://www.w3.org/2000/svg', tag);
	        for (var k in attrs)
	        {
	            el.setAttribute(k, attrs[k]);
	        }
	        return el;
	    }
	    this.initialize();
	}
	function PlayGround()
	{
		var counter = 0;  //counts the number of circles created
		var circles = [ ]; //array that will hold all the circles created in the app
		//a loop that updates the circle's position on the screen
		this.loop = function(){
			for(circle in circles)
			{
				circles[circle].update(1);
			}
		}
		this.createNewCircle = function(x,y){
			var new_circle = new Circle(x,y,counter++);
			circles.push(new_circle);
			// console.log('created a new circle!', new_circle);
		}
		//create one circle when the game starts
		this.createNewCircle(document.body.clientWidth/2, document.body.clientHeight/2);
	}
	var playground = new PlayGround();
	setInterval(playground.loop, 15);
	
	</script>

</body>
</html>