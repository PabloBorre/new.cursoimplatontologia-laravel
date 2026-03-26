<div>
    @if($sent)
        <div class="contact-form__success">Message sent successfully!</div>
    @endif

    <form wire:submit="enviar" class="contact-form" id="contactForm">
        {{-- campo oculto donde JS depositará el token --}}
        <input type="hidden" wire:model="recaptchaToken" id="recaptchaToken">

        <div class="contact-form__group">
            <input type="text" wire:model="nombre" class="contact-form__input" placeholder="Name">
            @error('nombre') <span class="contact-form__error">{{ $message }}</span> @enderror
        </div>
        <div class="contact-form__group">
            <input type="email" wire:model="email" class="contact-form__input" placeholder="Email">
            @error('email') <span class="contact-form__error">{{ $message }}</span> @enderror
        </div>
        <div class="contact-form__group">
            <input type="tel" wire:model="telefono" class="contact-form__input" placeholder="Phone">
            @error('telefono') <span class="contact-form__error">{{ $message }}</span> @enderror
        </div>
        <div class="contact-form__group">
            <textarea wire:model="mensaje" class="contact-form__textarea" placeholder="Message" rows="6"></textarea>
            @error('mensaje') <span class="contact-form__error">{{ $message }}</span> @enderror
        </div>

        @error('recaptchaToken')
            <span class="contact-form__error">{{ $message }}</span>
        @enderror

        <button type="submit" class="contact-form__submit" wire:loading.attr="disabled">
            <span wire:loading.remove>Send</span>
            <span wire:loading>Sending...</span>
        </button>
    </form>
</div>

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
    document.addEventListener('livewire:initialized', function () {
        Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
            if (component.name !== 'contact-form') return;

            // Generar token justo antes de enviar
            const calls = commit.calls ?? [];
            const isEnviar = calls.some(c => c.method === 'enviar');
            if (!isEnviar) return;

            respond(({ commit }) => {
                // noop
            });
        });
    });

    // Forma más simple: interceptar al hacer submit
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('contactForm');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            grecaptcha.ready(function () {
                grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'contact' })
                    .then(function (token) {
                        document.getElementById('recaptchaToken').value = token;
                        // Despachar el evento de Livewire manualmente
                        window.livewire.find(
                            form.closest('[wire\\:id]').getAttribute('wire:id')
                        ).call('enviar');
                    });
            });
        }, true); // capture phase para interceptar antes de Livewire
    });
</script>
@endpush