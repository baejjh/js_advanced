<!DOCTYPE html>
<html>
<head>
	<title>Understanding Closures</title>
</head>
<body>

<script>

function MathSample() {
  	this.storage = [];
  	for(var i=0; i<10; i++) {
   		this.storage[i] = function() {
      	console.log(i);
    	}
  	}
}

var math = new MathSample();

for(var j=0; j<10; j++) {
  	math.storage[j]();
}

// What actually happens is that inside the storage variable, it stores 10 functions,
// each function containing instructions to log the value of i to the console. 
// When this function is executed through math.storage[j](),
// it logs the value of i to the console, which at the time is 10
// (because when the for loop is done, var i is 10).

function MathSample2() {
	this.storage = [];
	  	for(var i=0; i<10; i++) {
	    this.storage[i] = function() {
	      console.log(i);
	    }
  	}
  	i = 50;
}

var math = new MathSample2();

for(var j=0; j<10; j++) {
  	math.storage[j]();
}

// A good analogy to understand what's happening may be to think this way:
// MathSample2 is the business owner.
// MathSample2 hires 10 workers and says whenever you are called
// you are to report on the value of i (say that's the total # of customers we have)
// MathSample2 calls worker 2 and says "report to me the value of i". 
// The worker looks and finds that i is 50 and says 'You have 50!!!"
// Time goes by and now i is 25.
// MathSample2 calls worker 5 and says "report to me the value of i".
// The worker looks and finds that is 25 and says "You have 25!"

// The key is that the MathSample2 did not tell the worker to just report
// on the value of i at the time that the owner gave the worker the instruction,
// the instruction was to report on the current value of i
// whenever you are called.
</script>


</body>
</html>