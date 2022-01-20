const Elements = [ "titre","soustitre","apropos","text1","offre","Services","3offre","partenaires","galeries","contacte","blog"]
let request = new XMLHttpRequest();




request.open('GET', "https://raw.githubusercontent.com/BlueFalcon64/website-digital-consultant/main/Json.Json");


request.responseType = 'json';
request.send();



