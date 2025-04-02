if(document.querySelector('#mapa')){

    const lat = 1.2195586
    const lon = -77.2685029
    const zoom =15

    const map = L.map('mapa').setView([lat,lon], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    L.marker([lat, lon]).addTo(map)
        .bindPopup(`
            <h2 class="mapa__heading">DevWebCamp</h2>           
            <p class="mapa__texto">Sede de Pasto-Nariño</p>    
        `)
        .openPopup();
}