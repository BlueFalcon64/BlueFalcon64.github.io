const Elements = [ "titre","soustitre","about-title","text1","service","SousService"]
let request = new XMLHttpRequest();




request.open('GET', "");


request.responseType = 'json';
request.send();



