function toogle(a){
    var record = document.getElementsByClassName(a)[0];
    var show = document.getElementsByClassName("option");
    for (let i=0; i<show.length; i++) {
        var el = show[i];
        el.classList.add("disable");
    }
    record.classList.toggle("disable");
}

function logout(){
    window.location.href="index.php";
}