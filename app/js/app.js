window.addEventListener("scroll", function(){
    const header = document.getElementById("header");

    if (window.pageYOffset >= 50) {
        header.style.backgroundColor = "black";
    }

    else if (window.pageYOffset < 50) {
        header.style.backgroundColor = "rgba(0,0,0,0)";
    }

});