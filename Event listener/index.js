
var btn=document.getElementById("btn");
btn.addEventListener('click',function(){
	var inputBox=document.getElementById("inputBox");
	var h2=document.getElementById("h2");
	var inputValue=inputBox.value;
	h2.innerText=inputValue;
});