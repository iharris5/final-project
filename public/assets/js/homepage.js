console.log('calling homepage');

document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById('shoe-container');

    fetch('/api/images')
        .then(res => res.json())
        .then(images => {
            images.forEach(img => {
                const div = document.createElement('div');
                div.className = 'shoe-pic';
                const image = document.createElement('img');
                image.src = img.image_url;
                image.alt = 'NicoShoe';
                div.appendChild(image);
                container.appendChild(div);
            });

            setupLightbox();
        })
        .catch(err => {
            console.error('Error loading images:', err);
        });

    function setupLightbox() {
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
    }
});

