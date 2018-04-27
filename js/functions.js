function miaData(){
	var data = new Date();	
	var h = data.getHours();
	var m = data.getMinutes();
	var s = data.getSeconds();

	if(h <= 9){
		h = "0"+h;
	}
	if(s <= 9){
		s = "0"+s;
	}
	if(m <= 9){
		m = "0"+m;
	}
	return(data.getDate()+"/"+(data.getMonth()+1)+"/"+data.getFullYear()+" - "+h+":"+m+":"+s);
}