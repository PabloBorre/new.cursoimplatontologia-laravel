<header class="main-header">
    <div class="header-container">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="header-logo">
            <img src="{{ asset('images/logo-implantex.png') }}" alt="Implantex Academy">
        </a>

        <!-- Navegación -->
        <nav class="header-nav" id="headerNav">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('docentes') }}">Instructors</a></li>
                <li><a href="{{ url('cursos') }}">Programs</a></li>
                <li><a href="{{ url('testimonios') }}">Testimonials</a></li>
                <li><a href="{{ url('contacto') }}">Contact</a></li>
            </ul>
            <!-- Teléfono dentro del nav (visible solo en mobile/tablet) -->
            <a href="tel:+17863287805" class="header-phone header-phone--nav">
                <img src="{{ asset('icon/bandera-eeuu.svg') }}" alt="US" class="phone-flag">
                <span>786 328 78 05</span>
            </a>
            <!-- Auth dentro del nav (visible solo en mobile/tablet) -->
            @auth
                <a href="{{ route('dashboard') }}" class="header-phone header-phone--nav">
                    <img src="{{ asset('icon/usuario.svg') }}" alt="" class="phone-flag">
                    <span>{{ auth()->user()->name }}</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="header-phone header-phone--nav">
                    <span>Register</span>
                </a>
            @endauth
        </nav>

        <!-- Botones desktop -->
        <div class="header-actions">
            <a href="tel:+17863287805" class="header-phone header-phone--desktop">
                <img src="{{ asset('icon/bandera-eeuu.svg') }}" alt="US" class="phone-flag">
                <span>786 328 78 05</span>
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="header-phone header-phone--desktop">
                <img src="{{ asset('icon/usuario.svg') }}" alt="" class="phone-flag">
                <span>{{ auth()->user()->name }}</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="header-phone header-phone--desktop">
                    <img src="{{ asset('icon/usuario.svg') }}" alt="" class="phone-flag">
                    <span>Register</span>
                </a>
            @endauth
        </div>

        <!-- Hamburger -->
        <button class="header-hamburger" id="menuToggle" aria-label="Abrir menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <!-- Overlay para cerrar menú -->
    <div class="nav-overlay" id="navOverlay"></div>
</header>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const headerNav = document.getElementById('headerNav');
    const navOverlay = document.getElementById('navOverlay');

    menuToggle.addEventListener('click', function() {
        this.classList.toggle('active');
        headerNav.classList.toggle('open');
        navOverlay.classList.toggle('active');
    });

    navOverlay.addEventListener('click', function() {
        menuToggle.classList.remove('active');
        headerNav.classList.remove('open');
        this.classList.remove('active');
    });
</script>