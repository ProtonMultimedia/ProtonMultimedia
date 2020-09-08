import Vue from 'vue';
import BanerSlider from '../vue/baner-slider.vue';
import RealizationSlider from '../vue/realization-slider.vue';
import RealizationAlternativeSlider from '../vue/realization-alternative-slider.vue';
import SideHeading from '../vue/side-heading.vue';
import TagFilter from '../vue/filter.vue';
import OnScroll from '../vue/on-scroll.vue';
import MainNavigation from '../vue/main-navigation.vue';
import VueAwesomeSwiper from "vue-awesome-swiper/dist/ssr";

Vue.use(VueAwesomeSwiper);

Vue.component('baner-slider', BanerSlider);
Vue.component('realization-slider', RealizationSlider);
Vue.component('realization-alternative-slider', RealizationAlternativeSlider);
Vue.component('side-heading', SideHeading);
Vue.component('tag-filter', TagFilter);
Vue.component('on-scroll', OnScroll);
Vue.component('main-navigation', MainNavigation);

document.addEventListener('DOMContentLoaded', function() {
    new Vue({ 
        el: '#page',
        components: {
            BanerSlider,
            RealizationSlider,
            SideHeading,
            TagFilter,
            OnScroll,
            MainNavigation
        },
    });
});

const heroswiper = new Swiper('.pm-swiper--hero-swiper__container', {
    // Disable preloading of all images
    preloadImages: false,
    pagination: {
        el: '.pm-swiper--hero-swiper__swiper-pagination',
        clickable: true,
    }
});

const FrameGenerator = {
    sel: {
        frames: '.pm-text-frame',
        frameDrop: 'pm-text-frame__drop',
    },

    addDropToFrame() {
        const textFrames = document.querySelectorAll(FrameGenerator.sel.frames);
        textFrames.forEach(frame => {
            const frameBuilding = document.createElement('span');
            frameBuilding.classList.add(FrameGenerator.sel.frameDrop);
            frame.appendChild(frameBuilding);
        })
    }
}

document.addEventListener('DOMContentLoaded', function() {
    FrameGenerator.addDropToFrame();
})