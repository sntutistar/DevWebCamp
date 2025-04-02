(function () {
    const inputponentes = document.querySelector('#ponentes');

    if (inputponentes) {
        let ponentes = [];
        let ponentesFiltrados = [];
        const ponentehidden = document.querySelector('[name="ponente_id"]');
        const listadoPonentes = document.querySelector('#listado-ponentes')

        obtenerPonentes();

        inputponentes.addEventListener('input', buscarponentes)

        if(ponentehidden.value) {
            (async () => {
                const ponente = await obtenerponente(ponentehidden.value);

                //insertar en el html
                const ponentedom = document.createElement('li');
                ponentedom.classList.add('listado-ponentes__ponente','listado-ponentes__ponente--selccionado');
                ponentedom.textContent = `${ponente.nombre} ${ponente.apellido}`;
                listadoPonentes.appendChild(ponentedom);
            })()
        }

        async function obtenerPonentes() {
            const url = `/api/ponentes`;

            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearPonentes(resultado);
        }

        async function obtenerponente(id) {
            const url = `/api/ponente?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }

        function formatearPonentes(arrayPonentes = []) {
            ponentes = arrayPonentes.map(ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            })
        }

        function buscarponentes(e) {
            const busqueda = e.target.value;
            if (busqueda.length > 1) {
                const expresion = new RegExp(busqueda.normalize('NFD').replace(/[\u0300-\u036f]/g, ""), "i");
                ponentesFiltrados = ponentes.filter(ponente => {
                    if (ponente.nombre.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase().search(expresion) != -1) {
                        return ponente
                    }
                })
            } else {
                ponentesFiltrados = []
            }

            mostrarPonentes();
        }

        function mostrarPonentes() {

            while (listadoPonentes.firstChild) {
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if (ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHtml = document.createElement('li');
                    ponenteHtml.classList.add('listado-ponentes__ponente');
                    ponenteHtml.textContent = ponente.nombre;
                    ponenteHtml.dataset.ponenteId = ponente.id;
                    ponenteHtml.onclick = seleccionarponente;

                    listadoPonentes.appendChild(ponenteHtml);

                })
            } else{
                const noresultados = document.createElement('p');
                noresultados.classList.add('listado-ponentes__noresultados');
                noresultados.textContent = 'No hay resultados para tu busqueda';
                listadoPonentes.appendChild(noresultados);
            }
        }

        function seleccionarponente(e){
            const ponente = e.target;

            //remover class
            const ponenteprevio = document.querySelector('.listado-ponentes__ponente--selccionado');
            if(ponenteprevio){
                ponenteprevio.classList.remove('listado-ponentes__ponente--selccionado');
            }
            ponente.classList.add('listado-ponentes__ponente--selccionado');

            ponentehidden.value = ponente.dataset.ponenteId 
        }
    }
})();