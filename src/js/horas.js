(function () {
    const horas = document.querySelector('#horas');

    if (horas) {



        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const hiddenDia = document.querySelector('[name="dia_id"]');
        const hiddenhora = document.querySelector('[name="hora_id"]');
        categoria.addEventListener('change', terminarBuasqueda);
        dias.forEach(dia => dia.addEventListener('change', terminarBuasqueda));

        let busqueda = {
            categoria_id: +categoria.value || '',
            dia: +hiddenDia.value || ''
        };

        if (!Object.values(busqueda).includes('')) {

            async function inciarapp() {
                await buscarEventos();
                const id = hiddenhora.value;
    
                //resaltar la hora actual
    
                const horaseleccionada = document.querySelector(`[data-hora-id="${id}"]`);
                horaseleccionada.classList.remove('horas__hora--deshabilitada');
                horaseleccionada.classList.add('horas__hora--seleccionada');

                horaseleccionada.onclick = seleccionarhora;
            }

            inciarapp();
        }

        function terminarBuasqueda(e) {
            busqueda[e.target.name] = e.target.value;
            //reiniciar los campo oculto y el selector de horas
            hiddenhora.value = '';
            hiddenDia.value = '';

            const horaprevia = document.querySelector('.horas__hora--seleccionada');
            if (horaprevia) {
                horaprevia.classList.remove('horas__hora--seleccionada');
            }

            if (Object.values(busqueda).includes('')) {
                return;
            }
            buscarEventos();
        }

        async function buscarEventos() {
            const { dia, categoria_id } = busqueda
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            const resultado = await fetch(url);
            const eventos = await resultado.json();

            obtenerHorasDisponibles(eventos);
        }

        function obtenerHorasDisponibles(eventos) {
            //reiniciar las horas
            const listadoHoras = document.querySelectorAll('#horas li');
            listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitada'))
            //comprobar eventos ya tomados y quitar la variable de deshabilitado
            const horastomadas = eventos.map(evento => evento.hora_id);

            const listadoHorasArray = Array.from(listadoHoras);
            const resultado = listadoHorasArray.filter(li => !horastomadas.includes(li.dataset.horaId));

            resultado.forEach(li => li.classList.remove('horas__hora--deshabilitada'));

            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');
            horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarhora))
        }

        function seleccionarhora(e) {
            //deshabilitar la hora previa
            const horaprevia = document.querySelector('.horas__hora--seleccionada');
            if (horaprevia) {
                horaprevia.classList.remove('horas__hora--seleccionada');
            }

            //agregar clase seleccionado
            e.target.classList.add('horas__hora--seleccionada');
            hiddenhora.value = e.target.dataset.horaId;

            //llenar el campo oculto de dia

            hiddenDia.value = document.querySelector('[name="dia"]:checked').value
        }
    }
})();