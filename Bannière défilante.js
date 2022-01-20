const Elements = [ "titre","soustitre","about-title","text1","service","SousService"]
let request = new XMLHttpRequest();




request.open('GET', "https://github.com/BlueFalcon64/website-digital-consultant/blob/main/Json.Json");


request.responseType = 'json';
request.send();



