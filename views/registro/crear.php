<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elije tu plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
                <li class="paquete__elemento paquete__elemento--negado">Pase por 2 dias</li>
                <li class="paquete__elemento paquete__elemento--negado">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento paquete__elemento--negado">Acceso a la grabaciones</li>
                <li class="paquete__elemento paquete__elemento--negado">Camisa del evento</li>
                <li class="paquete__elemento paquete__elemento--negado">Comida y bebida</li>
            </ul>
            <p class="paquete__precio">$0</p>

            <form method="POST" action="/finalizar-registro/gratis">
                <input class="paquetes__submit" type="submit" value="Inscripcion gratis">
            </form>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 dias</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a la grabaciones</li>
                <li class="paquete__elemento">Camisa del evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>
            <p class="paquete__precio">$199</p>

            <div class="paquete__pagar">
                <div id="smart-button-container">
                    <div style="text-align: center;">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 dias</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a la grabaciones</li>
                <li class="paquete__elemento paquete__elemento--negado">Camisa del evento</li>
                <li class="paquete__elemento paquete__elemento--negado">Comida y bebida</li>
            </ul>
            <p class="paquete__precio">$49</p>

            <div class="paquete__pagar">
                <div id="smart-button-container">
                    <div style="text-align: center;">
                        <div id="paypal-button-container-virtual"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=AaDZpbOBf3W4Y_RxXLbuWnuq46s3KGyUttdtWvkgIjCOlRndHcc9icOacksz-S68vtMHyNe_HgeSd5CK&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
 
<script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'blue',
                layout: 'vertical',
                label: 'pay',
                
            },
 
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":199}}]
            });
        },
 
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
            const datos = new FormData();
            datos.append('paquete_id', orderData.purchase_units[0].description);
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

            fetch('/finalizar-registro/pagar',{
                method: 'POST',
                body: datos
            }).then( respuesta => respuesta.json())
            .then( resultado => {
                if(resultado.resultado){
                    actions.redirect('http://localhost:3000/finalizar-registro/conferencias');
                }
            })
                
            });
        },
 
        onError: function(err) {
            console.log(err);
        }
        }).render('#paypal-button-container');



        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'blue',
                layout: 'vertical',
                label: 'pay',
                
            },
 
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{"description":"2","amount":{"currency_code":"USD","value":49}}]
            });
        },
 
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
            const datos = new FormData();
            datos.append('paquete_id', orderData.purchase_units[0].description);
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

            fetch('/finalizar-registro/pagar',{
                method: 'POST',
                body: datos
            }).then( respuesta => respuesta.json())
            .then( resultado => {
                if(resultado.resultado){
                    actions.redirect('http://localhost:3000/finalizar-registro/conferencias');
                }
            })
                
            });
        },
 
        onError: function(err) {
            console.log(err);
        }
        }).render('#paypal-button-container-virtual');
    }
 
    initPayPalButton();
</script>