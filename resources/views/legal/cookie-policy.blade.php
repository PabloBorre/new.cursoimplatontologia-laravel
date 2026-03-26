@extends('layouts.public')

@section('title', 'Cookie Policy - Implantex Academy')
@section('meta_description', 'Cookie policy for the Implantex Academy website. Learn how we use cookies to improve your browsing experience.')
@section('robots', 'noindex, follow')

@section('content')
<main>
    <!-- HERO PÁGINA INTERIOR -->
    <section class="page-hero page-hero--small">
        <div class="page-hero__background">
            <div class="page-hero__overlay page-hero__overlay--solid"></div>
        </div>
        <div class="page-hero__content">
            <h1 class="page-hero__title">Cookie Policy</h1>
        </div>
    </section>

    <!-- CONTENIDO LEGAL -->
    <section class="legal-page">
        <div class="legal-page__container">

            <p class="legal-page__updated">Last updated: {{ date('F Y') }}</p>

            <h2>1. What Are Cookies?</h2>
            <p>
                Cookies are small text files that are stored on your device (computer, tablet, or mobile phone) when you visit a website. They allow the website to recognize your device and remember certain information about your visit, such as your preferences and past actions.
            </p>

            <h2>2. How We Use Cookies</h2>
            <p>
                Implantex Academy uses cookies to improve your browsing experience, ensure the proper functioning of our website, and understand how visitors interact with our content. Specifically, we use cookies for the following purposes:
            </p>

            <h3>2.1. Strictly Necessary Cookies</h3>
            <p>
                These cookies are essential for the operation of our website. They enable core functionality such as security, session management, and access to authenticated areas. Without these cookies, the website cannot function properly.
            </p>
            <ul class="legal-page__list">
                <li><strong>Session cookies:</strong> Used to maintain your login session and CSRF protection.</li>
                <li><strong>Security cookies:</strong> Help ensure the security of your interactions with the website.</li>
            </ul>

            <h3>2.2. Functional Cookies</h3>
            <p>
                These cookies allow the website to remember choices you make (such as your language preferences) and provide enhanced, more personalized features. They may also be used to provide services you have requested.
            </p>

            <h3>2.3. Analytics Cookies</h3>
            <p>
                We may use analytics cookies to collect information about how visitors use our website, including which pages are visited most often and whether users encounter error messages. This data helps us improve the performance and design of our website.
            </p>

            <h3>2.4. Payment Processing Cookies</h3>
            <p>
                When you make a purchase on our website, our payment processor (Stripe) may set cookies to process your transaction securely. These cookies are necessary for the payment process and are subject to Stripe's own privacy and cookie policies.
            </p>

            <h2>3. Types of Cookies by Duration</h2>
            <ul class="legal-page__list">
                <li><strong>Session cookies:</strong> These are temporary cookies that are deleted from your device when you close your browser.</li>
                <li><strong>Persistent cookies:</strong> These remain on your device for a set period of time or until you manually delete them.</li>
            </ul>

            <h2>4. Third-Party Cookies</h2>
            <p>
                Some cookies on our website are placed by third-party services that appear on our pages. We do not control the placement of these cookies. Third-party services that may set cookies include:
            </p>
            <ul class="legal-page__list">
                <li><strong>Stripe:</strong> For secure payment processing.</li>
                <li><strong>YouTube:</strong> For embedded video content on certain pages.</li>
            </ul>

            <h2>5. Managing Cookies</h2>
            <p>
                You can control and manage cookies in several ways. Most web browsers allow you to manage your cookie preferences through their settings. You can:
            </p>
            <ul class="legal-page__list">
                <li>Delete all cookies that are already stored on your device.</li>
                <li>Configure your browser to block cookies or to alert you before cookies are placed.</li>
                <li>Set your browser to accept cookies only from specific websites.</li>
            </ul>
            <p>
                Please note that if you choose to block or delete cookies, some features of our website may not function properly, and your user experience may be affected.
            </p>
            <p>
                For more information on how to manage cookies in your browser, please visit your browser's help page:
            </p>
            <ul class="legal-page__list">
                <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Google Chrome</a></li>
                <li><a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer" target="_blank" rel="noopener">Mozilla Firefox</a></li>
                <li><a href="https://support.apple.com/guide/safari/manage-cookies-sfri11471/mac" target="_blank" rel="noopener">Safari</a></li>
                <li><a href="https://support.microsoft.com/en-us/microsoft-edge/manage-cookies-in-microsoft-edge-view-allow-block-delete-and-use-168dab11-0753-043d-7c16-ede5947fc64d" target="_blank" rel="noopener">Microsoft Edge</a></li>
            </ul>

            <h2>6. Consent</h2>
            <p>
                By continuing to use our website, you consent to the use of cookies as described in this policy. You can withdraw your consent at any time by adjusting your browser settings to refuse cookies.
            </p>

            <h2>7. Changes to This Cookie Policy</h2>
            <p>
                Implantex Academy reserves the right to update this Cookie Policy at any time. Any changes will be published on this page with an updated effective date. We encourage you to review this policy periodically.
            </p>

            <h2>8. Contact</h2>
            <p>
                If you have any questions about our use of cookies, please contact us at:
            </p>
            <ul class="legal-page__list">
                <li><strong>Email:</strong> <a href="mailto:info@implantexacademy.com">info@implantexacademy.com</a></li>
                <li><strong>Phone:</strong> <a href="tel:+17863287805">+1 786 328 78 05</a></li>
            </ul>

        </div>
    </section>
</main>
@endsection