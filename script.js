function managerecord(){
    var record = document.getElementsByClassName("managerecord")[0];
    var show = document.getElementsByClassName("option");
    for (let i=0; i<show.length; i++) {
        var el = show[i];
        el.classList.add("disable");
    }
    record.classList.toggle("disable");
}
function showrecord(){
    var record = document.getElementsByClassName("showrecord")[0];
    var show = document.getElementsByClassName("option");
    for (let i=0; i<show.length; i++) {
        var el = show[i];
        el.classList.add("disable");
    }
    record.classList.toggle("disable");
}
function query(){
    var record = document.getElementsByClassName("query")[0];
    var show = document.getElementsByClassName("option");
    for (let i=0; i<show.length; i++) {
        var el = show[i];
        el.classList.add("disable");
    }
    record.classList.toggle("disable");
}
function managetable(){
    var record = document.getElementsByClassName("managetable")[0];
    var show = document.getElementsByClassName("option");
    for (let i=0; i<show.length; i++) {
        var el = show[i];
        el.classList.add("disable");
    }
    record.classList.toggle("disable");
}
function showtable(){
    var record = document.getElementsByClassName("showtable")[0];
    var show = document.getElementsByClassName("option");
    for (let i=0; i<show.length; i++) {
        var el = show[i];
        el.classList.add("disable");
    }
    record.classList.toggle("disable");
}
function base(){
    var record = document.getElementsByClassName("base")[0];
    var show = document.getElementsByClassName("option");
    for (let i=0; i<show.length; i++) {
        var el = show[i];
        el.classList.add("disable");
    }
    record.classList.toggle("disable");
}