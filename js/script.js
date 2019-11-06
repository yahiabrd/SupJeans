//refresh cartlist
$(document).ready(function(){
 	refreshCartList();
});

function refreshCartList(){
    $('#cartList').load('cartList.php', function(){
       setTimeout(refreshTable, 5000);
    });
}

//slide
var t = 0;
var timer;

function slide(){
	t++;
	if (t==4) t=1;
	document.getElementById("img").setAttribute("src", "images/slides/img"+t+".jpg");
	timer = setTimeout("slide()", 2000);
}