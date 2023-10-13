
const slider = document.querySelector(".slider");
const menu = document.querySelector(".menu");
const circulo = document.querySelector(".circulo");


function moverAEscaner(seccion) {

    // Cambiar de color a la sección
    if (seccion.classList.contains("barraLateral__li")) {
        seccion.classList.add("barraLateral__li-activo");
        seccion.nextElementSibling.classList.remove("barraLateral__li-activo");
    } else {
        seccion.classList.add("header__seccion-activo");
        seccion.nextElementSibling.classList.remove("header__seccion-activo");
    }

    // Mover slider
    slider.style.marginLeft = "0%";

}

function moverAInventario(seccion) {

    // Cambiar de color a la sección
    if (seccion.classList.contains("barraLateral__li")) {
        seccion.classList.add("barraLateral__li-activo");
        seccion.previousElementSibling.classList.remove("barraLateral__li-activo");
    } else {
        seccion.classList.add("header__seccion-activo");
        seccion.previousElementSibling.classList.remove("header__seccion-activo");
    }

    // Mover slider
    slider.style.marginLeft = "-100%";
}


// ! Abrir más

if (circulo != null) {
    circulo.addEventListener("click", ()=> {
        if (circulo.classList.contains("circulo-activo")) {
            menu.style.opacity = "0";
            setTimeout(()=>{
                menu.style.display = "none";
            }, 300)
        } else {
            menu.style.display = "block";
            setTimeout(()=>{
                menu.style.opacity = "1";
            }, 300)
        }
        circulo.classList.toggle("circulo-activo")
    })
}

if (menu != null) {     
    menu.addEventListener("mousedown", ()=>{
        menu.style.opacity = "0";
        setTimeout(()=>{
            menu.style.display = "none";
        }, 300)
        circulo.classList.toggle("circulo-activo")
    })
}


// ! abrir el comboBox

let comboBox = [];
comboBox = document.querySelectorAll(".form__combobox-contenedor");

let opciones = [];
opciones = document.querySelectorAll(".form__combobox-opcion");



function abrirLosComboBox() {
    comboBox = document.querySelectorAll(".form__combobox-contenedor");

    for(let i=0; i<comboBox.length; i++) {
        let elemento = comboBox[i];
        elemento.addEventListener("click", function(){
            let opciones = elemento.nextElementSibling;
            
            if (!elemento.classList.contains("form__combobox-disabled")) {
                if (opciones.style.display == "block") {
                    opciones.style.display = "none";
                    setTimeout(() => {
                        opciones.style.opacity = "0";
                    }, 100);
                }
        
                else {
                    opciones.style.display = "block";
                    setTimeout(() => {
                        opciones.style.opacity = "1";
                    }, 100);
                }
            }
        })
    }
}

abrirLosComboBox();


// ! Cerrar el comboBox cuando se haga click fuera de él

function cerrarLosComboBox() {
    comboBox = document.querySelectorAll(".form__combobox-contenedor");

    document.addEventListener("mousedown", (event)=>{
        for(let i=0; i<comboBox.length; i++) {
    
            try {
                if(!comboBox[i].contains(event.target) && !comboBox[i].nextElementSibling.contains(event.target)){
                    let opciones = comboBox[i].nextElementSibling;
                    opciones.style.display = "none";
                    setTimeout(() => {
                        opciones.style.opacity = "0";
                    }, 100);
                }
            } catch (error) {
                // 
            }
        }
    });
}

cerrarLosComboBox();



// ! Escribir la opcion en el comboBox

function escribirLosComboBox() {
    opciones = document.querySelectorAll(".form__combobox-opcion");

    for(let i=0; i<opciones.length; i++) {
        let opcion = opciones[i];
        opcion.addEventListener("click", function(){

            let texto = opcion.innerHTML;
            let input = opcion.parentNode.previousElementSibling.querySelector(".form__combobox-input");
            let contenedor = opcion.parentNode;

            input.value = texto;

            contenedor.style.display = "none";
            setTimeout(() => {
                contenedor.style.opacity = "0";
            }, 100);
        })
    }
}

escribirLosComboBox();


// ! Cerrar el menu desktop

let menuDesktop = document.querySelector(".menuDesktop");

menuDesktop.addEventListener("mousedown", ()=>{
    menuDesktop.style.opacity = "0";
    setTimeout(()=>{
        menuDesktop.style.display = "none";
    }, 300)
})

// ! abrir el menu desktop

let mas = document.querySelector(".barraLateral__mas");

mas.addEventListener("click", ()=>{
    menuDesktop.style.display = "block";
    setTimeout(()=>{
        menuDesktop.style.opacity = "1";
    }, 300)
})