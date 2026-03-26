@extends('layouts.public')

@section('title', 'Legal Notice - Implantex Academy')
@section('meta_description', 'Legal notice and terms of use for the Implantex Academy website. Company information, intellectual property rights, and conditions of use.')
@section('robots', 'noindex, follow')

@section('content')
<main>
    <!-- HERO PÁGINA INTERIOR -->
    <section class="page-hero page-hero--small">
        <div class="page-hero__background">
            <div class="page-hero__overlay page-hero__overlay--solid"></div>
        </div>
        <div class="page-hero__content">
            <h1 class="page-hero__title">Legal Notice</h1>
        </div>
    </section>

    <!-- CONTENIDO LEGAL -->
    <section class="legal-page">
        <div class="legal-page__container">

            <p class="legal-page__updated">Last updated: {{ date('F Y') }}</p>

            <h2>1. Company Information</h2>
            <p>
                This website is owned and operated by <strong>Implantex Academy</strong>, a dental implantology training institution.
            </p>
            <ul class="legal-page__list">
                <li><strong>Business Name:</strong> Implantex Academy</li>
                <li><strong>Location:</strong> Miami, FL, United States</li>
                <li><strong>Email:</strong> <a href="mailto:info@implantexacademy.com">info@implantexacademy.com</a></li>
                <li><strong>Phone:</strong> <a href="tel:+17863287805">+1 786 328 78 05</a></li>
                <li><strong>Website:</strong> <a href="{{ url('/') }}">{{ url('/') }}</a></li>
            </ul>

            <h2>2. Purpose of the Website</h2>
            <p>
                The purpose of this website is to provide information about Implantex Academy's dental implantology training programs, courses, events, and related educational services. Through this site, users may also register as students, enroll in courses, and make payments for educational services.
            </p>

            <h2>3. Intellectual Property</h2>
            <p>
                All content on this website — including but not limited to text, images, graphics, logos, icons, photographs, videos, design, and software — is the exclusive property of Implantex Academy or its licensors and is protected by applicable intellectual property laws.
            </p>
            <p>
                Reproduction, distribution, public communication, transformation, or any other use of the content on this website, in whole or in part, is strictly prohibited without the prior written authorization of Implantex Academy.
            </p>

            <h2>4. Conditions of Use</h2>
            <p>
                By accessing and using this website, you agree to comply with these terms and all applicable laws and regulations. If you do not agree with any of these terms, you should not use this website.
            </p>
            <p>Users agree to:</p>
            <ul class="legal-page__list">
                <li>Use the website only for lawful purposes and in accordance with these terms.</li>
                <li>Not attempt to gain unauthorized access to any part of the website, other accounts, or computer systems.</li>
                <li>Not use the website in any way that could damage, disable, or impair the site or interfere with other users' experience.</li>
                <li>Provide accurate and truthful information when registering or making purchases.</li>
            </ul>

            <h2>5. Limitation of Liability</h2>
            <p>
                Implantex Academy makes every effort to ensure the information on this website is accurate and up-to-date. However, we do not guarantee the completeness, accuracy, or reliability of any content. The website and its content are provided "as is" without warranties of any kind.
            </p>
            <p>
                Implantex Academy shall not be liable for any direct, indirect, incidental, consequential, or punitive damages arising from your access to, or use of, this website or its content.
            </p>

            <h2>6. Links to Third-Party Websites</h2>
            <p>
                This website may contain links to third-party websites for informational purposes. Implantex Academy is not responsible for the content, privacy practices, or availability of such external sites. The inclusion of any link does not imply endorsement by Implantex Academy.
            </p>

            <h2>7. Governing Law and Jurisdiction</h2>
            <p>
                These terms and conditions are governed by the laws of the State of Florida, United States. Any disputes arising from the use of this website shall be subject to the exclusive jurisdiction of the courts located in Miami-Dade County, Florida.
            </p>

            <h2>8. Modifications</h2>
            <p>
                Implantex Academy reserves the right to modify this Legal Notice at any time without prior notice. Any changes will be published on this page with an updated effective date. Continued use of the website after modifications constitutes acceptance of the updated terms.
            </p>

            <h2>9. Contact</h2>
            <p>
                If you have any questions regarding this Legal Notice, please contact us at:
            </p>
            <ul class="legal-page__list">
                <li><strong>Email:</strong> <a href="mailto:info@implantexacademy.com">info@implantexacademy.com</a></li>
                <li><strong>Phone:</strong> <a href="tel:+17863287805">+1 786 328 78 05</a></li>
            </ul>

        </div>
    </section>
</main>
@endsection