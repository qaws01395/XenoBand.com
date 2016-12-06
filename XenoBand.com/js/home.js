$(function() {
    indexPager("intro")
});

function highlight(clicked_id){
    $('li').removeClass('active').addClass('null');
    $('#'+clicked_id).removeClass('null').addClass('active');

    // Scroll
    // var div = $('#'+clicked_id).offset();
    // $('html, body').animate({
    //     scrollTop: div.left,
    //     scrollLeft: div.top
    // }, 1000);
}

function indexPager(page) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("switch-page").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", page+".html", true);
    xhttp.send();
}

function indexPager2php(page) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("switch-page").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", page+".php", true);
    xhttp.send();
}
