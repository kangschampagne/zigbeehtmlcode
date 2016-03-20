//button
var y = 0;
function buFunction() {
	var x = document.getElementById("demo");
	if (y%2==0){
	    x.style.fontSize = "25px"; 
	    x.style.color = "red"; 
	    y++;
	}
	else{
		x.style.fontSize = "10px";
		x.style.color = "black";
		y++;
	}
}