console.log('calling homepage')

document.addEventListener("DOMContentLoaded", function () {
	document.querySelectorAll('.shoe-pic img').forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = lightbox.querySelector('.lightbox-img');
            lightboxImg.src = img.src;
            lightbox.style.display = 'flex';
        });
    });

    const closeBtn = document.querySelector('.lightbox .close');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            document.getElementById('lightbox').style.display = 'none';
        });
    }

    const lightbox = document.getElementById('lightbox');
    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.style.display = 'none';
            }
        });
    }
});
