import Swal from "sweetalert2";

(function () {
    let eventos = [];

    const resumen = document.querySelector('#registro-resumen');
    if (resumen) {
        const eventosboton = document.querySelectorAll('.evento__agregar');
        eventosboton.forEach(boton => boton.addEventListener('click', seleccionarEvento))

        const formularioRegistro = document.querySelector("#registro");
        formularioRegistro.addEventListener('submit', submitFomrulario);

        mostrarEventos();

        function seleccionarEvento({ target }) {

            if (eventos.length < 5) {
                target.disabled = true;
                eventos = [...eventos, {
                    id: target.dataset.id,
                    titulo: target.parentElement.querySelector('.evento__nombre').textContent.trim()
                }]


                mostrarEventos();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Maximo 5 eventos por registro"
                });
            }


        }

        function mostrarEventos() {

            limpiarEventos();

            if (eventos.length > 0) {
                eventos.forEach(evento => {
                    const eventoDom = document.createElement('DIV');
                    eventoDom.classList.add('registro__evento');

                    const titulo = document.createElement('H4');
                    titulo.classList.add('registro__nombre');
                    titulo.textContent = evento.titulo;

                    const botonEliminar = document.createElement('button');
                    botonEliminar.classList.add('registro__eliminar');
                    botonEliminar.innerHTML = '<i class="fa-solid fa-trash"></i>';
                    botonEliminar.onclick = function () {
                        eliminarEvento(evento.id);
                    }

                    eventoDom.appendChild(titulo);
                    eventoDom.appendChild(botonEliminar);
                    resumen.appendChild(eventoDom);

                })
            } else {
                const noRegistros = document.createElement('P');
                noRegistros.textContent = 'No hay eventos añade 5 de la lista';
                noRegistros.classList.add('registro__texto');
                resumen.appendChild(noRegistros);
            }
        }

        function eliminarEvento(id) {
            eventos = eventos.filter(evento => evento.id !== id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;
            mostrarEventos();
        }

        function limpiarEventos() {
            while (resumen.firstChild) {
                resumen.removeChild(resumen.firstChild);
            }
        }

        async function submitFomrulario(e){
            e.preventDefault();
            
            const regaloID = document.querySelector('#regalo').value;
            const eventosID = eventos.map(evento => evento.id);
            
            if(eventosID.length === 0 || regaloID === ''){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Debes seleccionar al menos un evento y un regalo"
                });
                return;
            }

            const datos = new FormData();
            datos.append('eventos', eventosID);
            datos.append('regalo', regaloID);

            const url = '/finalizar-registro/conferencias'
            const respuesta = await fetch(url, {
                method:'POST',
                body: datos
            })

            const resultado = await respuesta.json();
            
            if(resultado.resultado){
                Swal.fire(
                    'Registro Exitoso',
                    'Tus conferencias se han almacenado y añadido correctamente',
                    'success'
                ).then( () => location.href = `/boleto?id=${resultado.token}`)
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Hubo un error"
                }).then( () => location.reload);
            }
        }
    }
})();