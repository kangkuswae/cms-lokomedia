function createRequestObject() {
    var ro;
	//Firfox, Opera, Safari, Chrome
	if(window.XMLHttpRequest)
		{
		ro=new XMLHttpRequest();

		}
	//IE
	else if(windows.ActiveXObject)
		{
		ro=new ActiveXObject("Microsoft.XMLHTTP");
		}
	else 
		{
		alert("browser suport ajax");
		return false;
		}
    return ro;
}
var xmlhttp = createRequestObject();

function ambilData()
{
	var post = "nama="+null;
	xmlhttp.open("post", "shoutbox.php?data="+Math.random(), true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
		document.getElementById("hasil").innerHTML= xmlhttp.responseText;
    }
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(post);
	setTimeout("ambilData()",4000);
}

function kirim()
{
	var post = "nama="+document.chat.nama.value;
	post=post+"&pesan="+document.chat.isiChat.value;
	xmlhttp.open("post", "simpanshoutbox.php?data="+Math.random(), true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
		document.getElementById("hasil").innerHTML= xmlhttp.responseText;
		document.getElementById("pesan").value=null;
    }
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(post); 
	setTimeout("ambilData()",4000);
}