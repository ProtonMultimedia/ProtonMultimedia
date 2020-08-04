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