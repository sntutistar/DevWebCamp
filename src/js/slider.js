import Swiper, {Navigation} from 'swiper';

import 'swiper/css';
import 'swiper/css/navigation';
import { FreeMode } from 'swiper/modules';

document.addEventListener('DOMContentLoaded',function(){
    if(document.querySelector('.slider')){
        const opciones = {
            slidesPerView: 1,
            spaceBetween: 15,
            FreeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1208:{
                    slidesPerView: 4
                }
            },
        }

        Swiper.use([Navigation])
        new Swiper('.slider', opciones)
    }
});