function cargarEventos() {

    document.getElementById("Pais").addEventListener("change", function () {
        getProvincias(document.getElementById("Pais").value);
    });

    document.getElementById("Provincia").addEventListener("change", function () {
        getLocalidades(document.getElementById("Pais").value, document.getElementById("Provincia").value);
    });


}

function getProvincias(idPais) {

    if (idPais !== "-1") {

        // creo el objeto que realizara la llamada
        let llamada = new XMLHttpRequest();

        // url del php a llamar
        let url = "load-data.php";

        // Creo los parámetros que voy a insertar
        let parametros = {
            "metodo": "provincias",
            "idpais": idPais
        };

        // Indico los parámetros que voy a mandar
        let params = "data=" + JSON.stringify(parametros);

        // Función que se ejecutará al recibir la respuesta
        llamada.onreadystatechange = function () {
            // si todo está bien
            if (this.readyState === 4 && this.status === 200) {

                let datos = JSON.parse(this.responseText);

                let selectProvincia = document.getElementById("Provincia");
                selectProvincia.innerHTML = ""; // Limpiar
                datos.forEach(dato => {
                    let option = document.createElement("option");
                    option.setAttribute("value", dato.IdPro);
                    let contoption = document.createTextNode(dato.Nombre);

                    option.appendChild(contoption);
                    selectProvincia.appendChild(option);


                });

                getLocalidades(datos[0].IdPais, datos[0].IdPro);

            }
        }

        // Indico que es una petición POST
        llamada.open("POST", url, true);
        // Esta línea es necesaria en una petición POST
        llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        llamada.send(params); // Le paso los parámetros
    }else{
        let selectProvincia = document.getElementById("Provincia");
        selectProvincia.innerHTML = ""; // Limpiar
        let selectLocalidad = document.getElementById("Localidad");
        selectLocalidad.innerHTML = ""; // Limpiar
    }

}


function getLocalidades(idPais, idProvincia) {

    // creo el objeto que realizara la llamada
    let llamada = new XMLHttpRequest();

    // url del php a llamar
    let url = "load-data.php";

    // Creo los parámetros que voy a insertar
    let parametros = {
        "metodo": "localidades",
        "idpais": idPais,
        "idprovincia": idProvincia
    };

    // Indico los parámetros que voy a mandar
    let params = "data=" + JSON.stringify(parametros);

    // Función que se ejecutará al recibir la respuesta
    llamada.onreadystatechange = function () {
        // si todo está bien
        if (this.readyState === 4 && this.status === 200) {

            let datos = JSON.parse(this.responseText);

            let selectLocalidad = document.getElementById("Localidad");
            selectLocalidad.innerHTML = ""; // Limpiar
            datos.forEach(dato => {
                let option = document.createElement("option");
                option.setAttribute("value", dato.IdLoc);
                let contoption = document.createTextNode(dato.Nombre);

                option.appendChild(contoption);
                selectLocalidad.appendChild(option);


            });

        }
    }

    // Indico que es una petición POST
    llamada.open("POST", url, true);
    // Esta línea es necesaria en una petición POST
    llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    llamada.send(params); // Le paso los parámetros


}

window.onload = cargarEventos;