/*function SetCookie(cookie_name,cookie_value,cookie_time){

	var exdate = new Date()

	exdate.setDate(exdate.getDate()+expiredays)

	document.cookie=c_name+'='+escape(value)+((expiredays==null) ? "" : "expires="+exdate.toGMTString())

	location.reload()

}*/

function SetCookie(cookie_name,cookie_value,cookie_time){ 
	var d = new Date();
    d.setTime(d.getTime() + (cookie_time*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cookie_name + "=" + cookie_value + "; " + expires;
}
