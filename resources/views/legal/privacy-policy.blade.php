@extends('layouts.public')

@section('title', 'Privacy Policy - Implantex Academy')
@section('meta_description', 'Privacy policy for Implantex Academy. Learn how we collect, use, store, and protect your personal data when using our website and services.')
@section('robots', 'noindex, follow')

@section('content')
<main>
    <!-- HERO PÁGINA INTERIOR -->
    <section class="page-hero page-hero--small">
        <div class="page-hero__background">
            <div class="page-hero__overlay page-hero__overlay--solid"></div>
        </div>
        <div class="page-hero__content">
            <h1 class="page-hero__title">Privacy Policy</h1>
        </div>
    </section>

    <!-- CONTENIDO LEGAL -->
    <section class="legal-page">
        <div class="legal-page__container">

            <p class="legal-page__updated">Last updated: {{ date('F Y') }}</p>

            <h2>1. Introduction</h2>
            <p>
                Implantex Academy ("we," "us," or "our") is committed to protecting the privacy and security of your personal information. This Privacy Policy describes how we collect, use, store, and protect your personal data when you use our website and services.
            </p>
            <p>
                By using our website or registering for our services, you acknowledge that you have read and understood this Privacy Policy and agree to the collection and use of your information as described herein.
            </p>

            <h2>2. Information We Collect</h2>
            <p>We may collect the following types of personal information:</p>

            <h3>2.1. Information You Provide Directly</h3>
            <ul class="legal-page__list">
                <li><strong>Registration data:</strong> Full name, email address, phone number, and password when you create an account.</li>
                <li><strong>Professional information:</strong> Dental license number, professional credentials, and other documentation uploaded during registration.</li>
                <li><strong>Payment information:</strong> Payment details processed securely through Stripe. We do not store your credit card information on our servers.</li>
                <li><strong>Contact form submissions:</strong> Name, email, phone number, and message content when you use our contact form.</li>
            </ul>

            <h3>2.2. Information Collected Automatically</h3>
            <ul class="legal-page__list">
                <li><strong>Usage data:</strong> Pages visited, time spent on pages, and navigation patterns.</li>
                <li><strong>Device information:</strong> Browser type, operating system, screen resolution, and device type.</li>
                <li><strong>IP address:</strong> Your Internet Protocol address for security and analytics purposes.</li>
                <li><strong>Cookies:</strong> Information collected through cookies as described in our <a href="{{ url('cookie-policy') }}">Cookie Policy</a>.</li>
            </ul>

            <h2>3. How We Use Your Information</h2>
            <p>We use the personal information we collect for the following purposes:</p>
            <ul class="legal-page__list">
                <li>To create and manage your student account.</li>
                <li>To process course enrollments and payments.</li>
                <li>To communicate with you about your courses, enrollments, and account.</li>
                <li>To send important notifications, such as enrollment confirmations and payment receipts.</li>
                <li>To respond to your inquiries and provide customer support.</li>
                <li>To improve our website, courses, and services.</li>
                <li>To comply with legal obligations and protect our rights.</li>
            </ul>

            <h2>4. Legal Basis for Processing</h2>
            <p>We process your personal data based on the following legal grounds:</p>
            <ul class="legal-page__list">
                <li><strong>Contractual necessity:</strong> Processing required to fulfill our agreement to provide educational services.</li>
                <li><strong>Legitimate interest:</strong> Processing necessary for our legitimate business interests, such as improving our services and ensuring website security.</li>
                <li><strong>Consent:</strong> Where you have given explicit consent, such as for receiving marketing communications.</li>
                <li><strong>Legal obligation:</strong> Processing necessary to comply with applicable laws and regulations.</li>
            </ul>

            <h2>5. Data Sharing</h2>
            <p>
                We do not sell, rent, or trade your personal information to third parties. We may share your data with:
            </p>
            <ul class="legal-page__list">
                <li><strong>Payment processor (Stripe):</strong> To securely process your course payments. Stripe's handling of your data is governed by their own <a href="https://stripe.com/privacy" target="_blank" rel="noopener">Privacy Policy</a>.</li>
                <li><strong>Email service provider:</strong> To send transactional emails related to your account and enrollments.</li>
                <li><strong>Legal authorities:</strong> When required by law, regulation, or legal process.</li>
            </ul>

            <h2>6. Data Security</h2>
            <p>
                We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction. These measures include:
            </p>
            <ul class="legal-page__list">
                <li>Encrypted data transmission using SSL/TLS protocols.</li>
                <li>Secure password hashing and storage.</li>
                <li>Access controls limiting who can view your information.</li>
                <li>Regular security reviews of our systems and practices.</li>
            </ul>
            <p>
                However, no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to protect your personal data, we cannot guarantee its absolute security.
            </p>

            <h2>7. Data Retention</h2>
            <p>
                We retain your personal data for as long as necessary to fulfill the purposes described in this policy, or as required by law. Specifically:
            </p>
            <ul class="legal-page__list">
                <li><strong>Account data:</strong> Retained for the duration of your account and for a reasonable period thereafter.</li>
                <li><strong>Transaction records:</strong> Retained as required by applicable tax and accounting regulations.</li>
                <li><strong>Contact form submissions:</strong> Retained for the time necessary to respond to your inquiry.</li>
            </ul>

            <h2>8. Your Rights</h2>
            <p>
                Depending on your jurisdiction, you may have the following rights regarding your personal data:
            </p>
            <ul class="legal-page__list">
                <li><strong>Access:</strong> Request a copy of the personal data we hold about you.</li>
                <li><strong>Rectification:</strong> Request correction of inaccurate or incomplete data.</li>
                <li><strong>Deletion:</strong> Request deletion of your personal data, subject to legal obligations.</li>
                <li><strong>Restriction:</strong> Request that we limit the processing of your data in certain circumstances.</li>
                <li><strong>Portability:</strong> Request a copy of your data in a structured, commonly used, machine-readable format.</li>
                <li><strong>Objection:</strong> Object to the processing of your data for certain purposes.</li>
            </ul>
            <p>
                To exercise any of these rights, please contact us at <a href="mailto:info@cursodeimplantologia.com">info@cursodeimplantologia.com</a>. We will respond to your request within a reasonable timeframe and in accordance with applicable laws.
            </p>

            <h2>9. Children's Privacy</h2>
            <p>
                Our website and services are not directed to individuals under the age of 18. We do not knowingly collect personal information from children. If we become aware that we have collected personal data from a child without parental consent, we will take steps to delete that information promptly.
            </p>

            <h2>10. International Data Transfers</h2>
            <p>
                Your personal information may be processed and stored in the United States or other countries where our service providers operate. By using our website and services, you consent to the transfer of your information to countries that may have different data protection laws than your country of residence.
            </p>

            <h2>11. Changes to This Privacy Policy</h2>
            <p>
                We may update this Privacy Policy from time to time to reflect changes in our practices or for legal, regulatory, or operational reasons. Any changes will be posted on this page with an updated effective date. We encourage you to review this policy periodically.
            </p>

            <h2>12. Contact Us</h2>
            <p>
                If you have any questions, concerns, or requests regarding this Privacy Policy or how we handle your personal data, please contact us at:
            </p>
            <ul class="legal-page__list">
                <li><strong>Email:</strong> <a href="mailto:info@cursodeimplantologia.com">info@cursodeimplantologia.com</a></li>
                <li><strong>Phone:</strong> <a href="tel:+17863827805">786 382 78 05</a></li>
                <li><strong>Address:</strong> Miami, FL, United States</li>
            </ul>

        </div>
    </section>
</main>
@endsection