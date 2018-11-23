var btnexo1 = document.getElementById('btnexo1');
var exo1 = document.getElementById('exo1');
var s1 = 1;

exo1.style.display = "none";

btnexo1.addEventListener('click', function(){
    if(s1 == 1){
        exo1.style.display = "block";
        btnexo1.innerHTML = "Cacher";
    }
    else{
        exo1.style.display = "none";
        btnexo1.innerHTML = "Afficher";
    }
    s1 = s1*-1;
});

var btnexo2 = document.getElementById('btnexo2');
var exo2 = document.getElementById('exo2');
var s2 = 1;

exo2.style.display = "none";

btnexo2.addEventListener('click', function(){
    if(s2 == 1){
        exo2.style.display = "block";
        btnexo2.innerHTML = "Cacher";
    }
    else{
        exo2.style.display = "none";
        btnexo2.innerHTML = "Afficher";
    }
    s2 = s2*-1;
});

var btnexo3 = document.getElementById('btnexo3');
var exo3 = document.getElementById('exo3');
var s3 = 1;

exo3.style.display = "none";

btnexo3.addEventListener('click', function(){
    if(s3 == 1){
        exo3.style.display = "block";
        btnexo3.innerHTML = "Cacher";
    }
    else{
        exo3.style.display = "none";
        btnexo3.innerHTML = "Afficher";
    }
    s3 = s3*-1;
});

var btnexo4 = document.getElementById('btnexo4');
var exo4 = document.getElementById('exo4');
var s4 = 1;

exo4.style.display = "none";

btnexo4.addEventListener('click', function(){
    if(s4 == 1){
        exo4.style.display = "block";
        btnexo4.innerHTML = "Cacher";
    }
    else{
        exo4.style.display = "none";
        btnexo4.innerHTML = "Afficher";
    }
    s4 = s4*-1;
});