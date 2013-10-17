
function countDown(){
		 if (count <=0){
		  	document.clipForm.submit();
		 }else{
			  count--;
			  document.getElementById("timer").innerHTML = " Il reste : "+count+" secondes. ";
			  setTimeout("countDown()", 1000);
		 }
	}