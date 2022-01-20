const Elements = [ "titre","soustitre","about-title","text1","service","SousService"]
let request = new XMLHttpRequest();




request.open('GET', "https://raw.githubusercontent.com/BlueFalcon64/website-digital-consultant/main/Json.Json");


request.responseType = 'json';
request.send();



