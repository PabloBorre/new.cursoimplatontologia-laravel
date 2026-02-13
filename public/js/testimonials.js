/**
 * Testimonials Video Modal
 * Handles video playback in a modal overlay
 */

document.addEventListener('DOMContentLoaded', function() {
    initTestimonialsVideo();
});

function initTestimonialsVideo() {
    const testimonialCards = document.querySelectorAll('.testimonial-card[data-video]');
    const modal = document.getElementById('video-modal');
    const modalVideo = document.getElementById('modal-video');
    const modalOverlay = document.querySelector('.video-modal__overlay');
    const modalClose = document.querySelector('.video-modal__close');

    if (!modal || !modalVideo) return;

    // Open modal on card click
    testimonialCards.forEach(card => {
        card.addEventListener('click', function() {
            const videoPath = this.dataset.video;
            if (videoPath) {
                openVideoModal(videoPath);
            }
        });

        // Keyboard accessibility
        card.setAttribute('tabindex', '0');
        card.setAttribute('role', 'button');
        card.setAttribute('aria-label', 'Ver testimonio en video');
        
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const videoPath = this.dataset.video;
                if (videoPath) {
                    openVideoModal(videoPath);
                }
            }
        });
    });

    // Close modal events
    if (modalClose) {
        modalClose.addEventListener('click', closeVideoModal);
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', closeVideoModal);
    }

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display !== 'none') {
            closeVideoModal();
        }
    });

    function openVideoModal(videoPath) {
        const videoSource = modalVideo.querySelector('source');
        
        if (videoSource) {
            videoSource.src = videoPath;
        } else {
            modalVideo.src = videoPath;
        }
        
        modalVideo.load();
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Auto-play after a short delay
        setTimeout(() => {
            modalVideo.play().catch(err => {
                console.log('Auto-play prevented:', err);
            });
        }, 300);

        // Focus trap
        modalClose.focus();
    }

    function closeVideoModal() {
        modalVideo.pause();
        modalVideo.currentTime = 0;
        modal.style.display = 'none';
        document.body.style.overflow = '';
        
        // Clear video source
        const videoSource = modalVideo.querySelector('source');
        if (videoSource) {
            videoSource.src = '';
        } else {
            modalVideo.src = '';
        }
    }
}