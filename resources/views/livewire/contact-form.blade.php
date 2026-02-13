<div>
    @if($sent)
        <div class="contact-form__success">Message sent successfully!</div>
    @endif

    <form wire:submit="enviar" class="contact-form" id="contactForm">
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
        <button type="submit" class="contact-form__submit" wire:loading.attr="disabled">
            <span wire:loading.remove>Send</span>
            <span wire:loading>Sending...</span>
        </button>
    </form>
</div>