(function(){
    const tags_input = document.querySelector('#tags_input');

    if(tags_input){

        const tagsdiv = document.querySelector('#tags');
        const tagsinputhidden = document.querySelector('[name="tags"]');

        let tags = [];

        //recuperar del input oculto
        if(tagsinputhidden.value !== ''){
            tags = tagsinputhidden.value.split(',');
            mostrartags();
        }
        //escuchar los cambios en el input
        tags_input.addEventListener('keypress', guardartag);

        function guardartag(e){
            if(e.keyCode === 44){

                if(e.target.value.trim() === '' || e.target.value < 1){
                    return;
                }
                e.preventDefault()
                tags = [...tags, e.target.value.trim()];
                tags_input.value = '';
                mostrartags();
            }
        }

        function mostrartags(){
            tagsdiv.textContent = '';
            tags.forEach(tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag
                tagsdiv.appendChild(etiqueta);
            })
            actualizarInputHidden();
        }

        function eliminarTag(e){
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            actualizarInputHidden();
            console.log(tags);
        }

        function actualizarInputHidden(){
            tagsinputhidden.value = tags.toString();
        }
    }
})();

