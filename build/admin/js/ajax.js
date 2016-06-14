// Documento JavaScript
 
// Función para recoger los datos de PHP según el navegador, se usa siempre.
function objetoAjax(){
  var xmlhttp=false;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
 
  try {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (E) {
    xmlhttp = false;
  }
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

function sendBrand(){ 
  //div donde se mostrará lo resultados
  divResult = document.getElementById('result_brand');
  //recogemos los valores de los inputs
  brand = document.new_brand.other_brand.value;
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "register_brand.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
    //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState==4) {
      //mostrar resultados en esta capa
    divResult.innerHTML = ajax.responseText
      //llamar a funcion para limpiar los inputs
    cleanBrand();
  }
 }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores a registro.php para que inserte los datos
  ajax.send("other_brand="+brand)
}

function sendCategory(){ 
  //div donde se mostrará lo resultados
  divResultCat = document.getElementById('result_category');
  //recogemos los valores de los inputs
  category = document.new_category.other_category.value;
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "register_category.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
    //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState==4) {
      //mostrar resultados en esta capa
    divResultCat.innerHTML = ajax.responseText
      //llamar a funcion para limpiar los inputs
    cleanCategory();
  }
 }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores a registro.php para que inserte los datos
  ajax.send("other_category="+category)
}

function sendCharacteristic(){ 
  //div donde se mostrará lo resultados
  divResultCat = document.getElementById('result_characteristic');
  //recogemos los valores de los inputs
  characteristic = document.new_characteristic.new_characteristic.value;
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "register_characteristic.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
    //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState==4) {
      //mostrar resultados en esta capa
    divResultCat.innerHTML = ajax.responseText
      //llamar a funcion para limpiar los inputs
    cleanCharacteristic();
  }
 }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores a registro.php para que inserte los datos
  ajax.send("characteristic="+characteristic)
}

//función para limpiar los campos
function cleanBrand(){
  document.new_brand.other_brand.value="";
}
function cleanCategory(){
  document.new_category.other_category.value="";
}
function cleanCharacteristic(){
  document.new_characteristic.characteristic.value="";
}