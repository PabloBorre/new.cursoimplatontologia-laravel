<footer class="main-footer">
    <div class="footer-container">

        <!-- Logo de fondo con transparencia -->
        <div class="footer-bg-logo">
            <img src="{{ asset('images/imagotipo-2.svg') }}" alt="">
        </div>

        <div class="footer-content">
            <!-- Columna izquierda: Contacto + Navegación -->
            <div class="footer-left">
                <!-- Contacto -->
                <div class="footer-contact">
                    <a href="tel:+17863827805" class="footer-phone">786 382 78 05</a>
                    <p class="footer-location">Miami, FL</p>
                    <a href="mailto:info@implantexacademy.com" class="footer-email">info@implantexacademy.com</a>
                </div>

                <!-- Navegación debajo del contacto -->
                <div class="footer-nav-columns">
                    <nav class="footer-nav footer-nav--main">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('instructors') }}">Instructors</a></li>
                            <li><a href="{{ url('courses') }}">Programs</a></li>
                            <li><a href="{{ url('testimonials') }}">Testimonials</a></li>
                        </ul>
                    </nav>

                    <nav class="footer-nav footer-nav--legal">
                        <ul>
                            <li><a href="{{ url('legal-notice') }}">Legal Notice</a></li>
                            <li><a href="{{ url('cookie-policy') }}">Cookie Policy</a></li>
                            <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Columna derecha: Logo -->
            <div class="footer-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/imagotipo-2.svg') }}" alt="Implantex Academy">
                </a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-copyright">
            <p>&copy;{{ date('Y') }} Implantex ||  <a href="https://capazero.es/" style="color:var(--color-clarity); text-decoration:none;">Diseñado y Desarrollado por Capazero</a></p>
        </div>
    </div>
</footer>

<!-- WhatsApp Float -->
<style>
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); }
}
</style>
<a id="whatsapp-float" href="https://api.whatsapp.com/send?phone=17863287805&text=" target="_blank" style="position:fixed;right:20px;bottom:20px;z-index:100000;display:flex;align-items:center;justify-content:center;animation:pulse 1.5s ease-in-out infinite;">
    <img src="{{ asset('icon/whatsapp.svg') }}" style="width:65px" alt="WhatsApp">
</a>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script src="{{ asset('js/testimonials.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var variants = ['reveal--up', 'reveal--left', 'reveal--right', 'reveal--scale'];
    var variantIndex = 0;

    var sections = document.querySelectorAll('main > section, main > .no-time, main > .location-section, main > .gallery-section, main > .courses-section, main > .calendar-section');

    sections.forEach(function(section) {
        if (section.classList.contains('docentes-row--2') ||
            section.classList.contains('docentes-row--3') ||
            section.classList.contains('docentes-row--4')) {
            return;
        }
        section.classList.add('reveal');
        section.classList.add(variants[variantIndex % variants.length]);
        variantIndex++;
    });

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.15
    });

    sections.forEach(function(section) {
        if (section.classList.contains('reveal')) {
            observer.observe(section);
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    function animateNumber(element, target, prefix, duration) {
        var startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var current = Math.floor(eased * target);
            element.textContent = prefix + current;
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                element.textContent = prefix + target;
            }
        }

        requestAnimationFrame(step);
    }

    var statsSection = document.querySelector('.stats');
    if (!statsSection) return;

    var triggered = false;

    window.addEventListener('scroll', function() {
        if (triggered) return;
        triggered = true;

        var numbers = statsSection.querySelectorAll('.stat-number');
        numbers.forEach(function(el) {
            var text = el.textContent.trim();
            var prefix = '';
            if (text.startsWith('+')) {
                prefix = '+';
                text = text.substring(1);
            }
            var target = parseInt(text, 10);
            el.textContent = prefix + '0';
            animateNumber(el, target, prefix, 800);
        });
    }, { once: true });
});
</script>