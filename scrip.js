/*
* Функция считывает введенные данные
* проверяет на наличие введенных данных
* 
* подключает php файл, и отправляет в него str
* при получении результата выводит его
* 
*/

$("#complite").click( function() { 
var str = document.getElementById("str").value; 
if(str != "") {
	$.ajax({ 
	type: "POST", 
	url: "script.php", 
	data: {str: str}, 
		success: function(res) { 
			document.getElementById("out").innerHTML = res; 
		} 
	});
} else {
	document.getElementById("out").innerHTML = "Введите хотябы 1-ну пару"; 
}
}); 	