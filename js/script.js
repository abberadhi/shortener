function myFunction() {
	var el = document.createElement('textarea');
	el.value = document.getElementById("link").innerHTML;
	el.setAttribute('readonly', '');
	el.style = {position: 'absolute', left: '-9999px'};
	document.body.appendChild(el);
	el.select();
	el.setSelectionRange(0, 99999); /*For mobile devices*/
	document.execCommand('copy');
	document.body.removeChild(el);
}
