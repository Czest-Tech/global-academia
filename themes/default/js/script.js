var navOut = false;

function toggleNav(){
    if(navOut){
        document.querySelector(".navLinks8").style.display = "none"
        navOut = false
    }else{
        document.querySelector(".navLinks8").style.display = "flex"
        navOut = true
    }
}

var langOut = false
function toggleLang(){
    if(langOut){
        document.querySelector(".langDropTop").style.display = "none"
        langOut = false
    }else{
        document.querySelector(".langDropTop").style.display = "flex"
        langOut = true
    }
}

var filterOut = false
function toggleFiter(){
    if(filterOut){
        document.querySelector(".toggleFilter").innerHTML = `<i onclick="toggleFiter()" class="far fa-caret-square-down"></i>`
        document.querySelector(".filterBody8").style.display = "none"
        filterOut = false
    }else{
        document.querySelector(".toggleFilter").innerHTML = `<i onclick="toggleFiter()" class="far fa-caret-square-up"></i>`
        document.querySelector(".filterBody8").style.display = "block"
        filterOut = true
    }
}