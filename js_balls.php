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
	// set circle setting
//5
	function Circle(cx, cy, r, html_id)
	{
		var html_id = html_id;
		this.info = { cx: cx,  cy: cy, r: r};
		
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
				  	r:  this.info.r,
				  	id: html_id,
				  	style: "fill: black"
				});
			document.getElementById('svg').appendChild(circle);
		} 
// 3 update each circle in array's property
		this.update = function(time){
			var el = document.getElementById(html_id);
			//see if the circle is going outside the browser. if it is, reverse the velocity
			// changed this.info.cx/y to be less than Circle.initizlize.circle[radius] for it to bounce off
			if( this.info.cx > document.body.clientWidth - this.info.r || this.info.cx < this.info.r)
			{
				this.info.velocity.x = this.info.velocity.x * -1;
			}
			if( this.info.cy > document.body.clientHeight - this.info.r || this.info.cy < this.info.r)
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
	        var el = document.createElementNS('http://www.w3.org/2000/svg', tag);
	        for (var k in attrs)
	        {
	            el.setAttribute(k, attrs[k]);
	        }
	        return el;
	    }
//6
	    this.initialize();
	}


	function PlayGround()
	{
		var counter = 0;  //counts the number of circles created
		var circles = [ ]; //array that will hold all the circles created in the app
		//a loop that updates the circle's position on the screen
// 2 
		this.loop = function(){
			for(circle in circles)
			{
				circles[circle].update(1);
			}
// 4
		}
		this.createNewCircle = function(x,y,r){
			var new_circle = new Circle(x,y,r,counter++);
			circles.push(new_circle);
			// console.log('created a new circle!', new_circle);
		}
		//create first circle when the game starts (OF ZERO PIXELS)
		this.createNewCircle(document.body.clientWidth/2, document.body.clientHeight/2, 10);
		console.log(circles); //first Obj created
	}


// 1 - Program Runs
	var playground = new PlayGround();
	setInterval(playground.loop, 15);
	
	// count time
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
		new_radius = time_pressed*0.05;
		playground.createNewCircle(e.x, e.y, new_radius);
	}

	</script>

</body>
</html>