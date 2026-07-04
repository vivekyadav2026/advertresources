<?php include 'header.php'; ?>
<!-- Include the custom premium CSS specifically for this page -->
<link rel="stylesheet" href="assets/css/premium-theme.css">

<style>
/* CSS Reset / Base Scoping Overrides */
.premium-page {
    position: relative;
    padding-bottom: 60px;
    background-color: #050B18;
}

.contact-layout-wrapper {
    padding: 120px 0 80px;
    position: relative;
    z-index: 2;
}

.contact-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    background: rgba(37, 99, 235, 0.08);
    border: 1px solid rgba(37, 99, 235, 0.25);
    border-radius: 30px;
    color: #60a5fa;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 24px;
    box-shadow: 0 0 20px rgba(37, 99, 235, 0.15);
}

.contact-heading {
    font-size: clamp(1.8rem, 4vw, 2.6rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 20px;
    color: #ffffff;
}

.gradient-text {
    background: linear-gradient(135deg, #60a5fa 30%, #c084fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.contact-desc {
    font-size: 1.05rem;
    line-height: 1.7;
    color: #94a3b8;
    margin-bottom: 30px;
}

/* Trust Badges */
.trust-badges-row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 40px;
}
.trust-badge-item {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.06);
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 0.85rem;
    color: #cbd5e1;
    backdrop-filter: blur(10px);
}
.trust-badge-item i {
    color: #E0009B;
    font-size: 0.95rem;
}

/* Premium Contact Cards Grid */
.contact-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.premium-contact-card {
    background: rgba(15, 23, 42, 0.45);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(59, 130, 246, 0.15);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
}

.premium-contact-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: radial-gradient(circle at 10% 10%, rgba(59, 130, 246, 0.08) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.premium-contact-card:hover {
    border-color: rgba(59, 130, 246, 0.4);
    box-shadow: 0 15px 40px -10px rgba(59, 130, 246, 0.25);
    transform: translateY(-5px);
}

.premium-contact-card:hover::before {
    opacity: 1;
}

.premium-contact-card .card-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 18px;
    font-size: 1.20rem;
    color: #60a5fa;
    box-shadow: 0 0 15px rgba(59, 130, 246, 0.15);
    transition: all 0.3s ease;
}

.premium-contact-card:hover .card-icon-wrap {
    background: rgba(59, 130, 246, 0.25);
    border-color: rgba(59, 130, 246, 0.5);
    box-shadow: 0 0 25px rgba(59, 130, 246, 0.35);
    transform: rotate(-10deg) scale(1.1);
}

.premium-contact-card h5 {
    font-size: 1.05rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 8px;
}

.premium-contact-card p,
.premium-contact-card a {
    color: #94a3b8;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
    text-decoration: none;
    word-break: break-all;
}

.premium-contact-card a:hover {
    color: #60a5fa;
}

/* Premium Form overrides */
.premium-form-glass-card {
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
    transition: all 0.4s ease;
}

.premium-form-glass-card:hover {
    border-color: rgba(96, 165, 250, 0.2);
    box-shadow: 0 25px 60px rgba(96, 165, 250, 0.08);
}

.form-floating-custom {
    position: relative;
    margin-bottom: 24px;
}

.form-floating-custom input,
.form-floating-custom select,
.form-floating-custom textarea {
    width: 100%;
    background: rgba(8, 14, 28, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    padding: 24px 20px 10px 48px;
    min-height: 56px;
    color: #fff;
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.form-floating-custom textarea {
    padding-top: 32px;
    min-height: 140px;
}

.form-floating-custom .input-icon {
    position: absolute;
    top: 28px;
    left: 20px;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
    pointer-events: none;
}
.form-floating-custom textarea ~ .input-icon {
    top: 32px;
}

.form-floating-custom label {
    position: absolute;
    top: 18px;
    left: 48px;
    color: #94a3b8;
    font-size: 1rem;
    pointer-events: none;
    transition: all 0.2s ease;
}

.form-floating-custom input:focus ~ label,
.form-floating-custom input:not(:placeholder-shown) ~ label,
.form-floating-custom textarea:focus ~ label,
.form-floating-custom textarea:not(:placeholder-shown) ~ label,
.form-floating-custom select:focus ~ label,
.form-floating-custom select:not([value=""]) ~ label {
    top: 6px;
    left: 48px;
    font-size: 0.75rem;
    color: #60a5fa;
    font-weight: 500;
}

.form-floating-custom input:focus,
.form-floating-custom select:focus,
.form-floating-custom textarea:focus {
    outline: none;
    border-color: #3b82f6;
    background: rgba(8, 14, 28, 0.7);
    box-shadow: 0 0 15px rgba(59, 130, 246, 0.25);
}

.form-floating-custom input:focus ~ .input-icon,
.form-floating-custom textarea:focus ~ .input-icon,
.form-floating-custom select:focus ~ .input-icon {
    color: #60a5fa;
    filter: drop-shadow(0 0 5px rgba(96, 165, 250, 0.5));
}

.form-floating-custom select ~ label {
    top: 6px;
    font-size: 0.75rem;
}
.form-floating-custom select {
    padding: 20px 20px 6px 48px;
}
.form-floating-custom select option {
    background: #0f172a;
    color: #fff;
}

/* CTA Gradient Button */
.btn-cyber-premium {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 16px 36px;
    min-height: 54px;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 700;
    font-size: 1.05rem;
    color: #fff;
    background: linear-gradient(135deg, #3C72FC 0%, #E0009B 100%);
    border: none;
    border-radius: 99px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    text-decoration: none;
    position: relative;
    overflow: hidden;
    z-index: 1;
    box-shadow: 0 0 25px rgba(224, 0, 155, 0.3);
}

.btn-cyber-premium::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, #4d82ff 0%, #f014ac 100%);
    opacity: 0;
    z-index: -1;
    transition: opacity 0.4s ease;
}

.btn-cyber-premium:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(224, 0, 155, 0.5);
}

.btn-cyber-premium:hover::before {
    opacity: 1;
}

.btn-cyber-premium i {
    transition: transform 0.3s ease;
}

.btn-cyber-premium:hover i {
    transform: translateX(5px);
}

/* Secure Submission Note */
.secure-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: #069845;
    font-size: 0.85rem;
    font-weight: 600;
    margin-top: 15px;
    opacity: 0.9;
    letter-spacing: 0.5px;
}

/* Floating Particle Elements */
.particles {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    overflow: hidden;
    pointer-events: none;
    z-index: 1;
}
.particle {
    position: absolute;
    background: radial-gradient(circle, rgba(96, 165, 250, 0.35) 0%, rgba(96, 165, 250, 0) 70%);
    border-radius: 50%;
    animation: floatParticle 24s infinite linear;
}
.particle.p1 { width: 150px; height: 150px; top: 10%; left: 8%; animation-duration: 20s; }
.particle.p2 { width: 220px; height: 220px; top: 35%; right: 4%; animation-duration: 32s; animation-delay: -6s; }
.particle.p3 { width: 120px; height: 120px; bottom: 15%; left: 22%; animation-duration: 26s; animation-delay: -12s; }
.particle.p4 { width: 170px; height: 170px; top: 75%; right: 25%; animation-duration: 29s; animation-delay: -18s; }

@keyframes floatParticle {
    0% { transform: translateY(0) scale(1); opacity: 0.3; }
    50% { transform: translateY(-40px) scale(1.1); opacity: 0.55; }
    100% { transform: translateY(0) scale(1); opacity: 0.3; }
}

/* Cyber pulses on grid */
.cyber-lines {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: 
      linear-gradient(to right, rgba(96, 165, 250, 0.02) 1px, transparent 1px) 0 0 / 120px 100%,
      linear-gradient(to bottom, rgba(96, 165, 250, 0.02) 1px, transparent 1px) 0 0 / 100% 120px;
    pointer-events: none;
    z-index: 0;
}
.cyber-line-pulse {
    position: absolute;
    width: 2px;
    height: 100px;
    background: linear-gradient(to bottom, transparent, #3b82f6, transparent);
    animation: linePulse 8s infinite linear;
    opacity: 0.4;
    left: 20%;
}
.cyber-line-pulse.h {
    width: 100px;
    height: 2px;
    background: linear-gradient(to right, transparent, #E0009B, transparent);
    animation: linePulseH 12s infinite linear;
    top: 45%;
}
@keyframes linePulse {
    0% { top: -10%; }
    100% { top: 110%; }
}
@keyframes linePulseH {
    0% { left: -10%; }
    100% { left: 110%; }
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.3); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}

@media (max-width: 991px) {
    .premium-form-glass-card {
        padding: 30px;
        margin-top: 30px;
    }
}
@media (max-width: 767px) {
    .contact-layout-wrapper {
        text-align: center;
    }
    .trust-badges-row {
        justify-content: center;
    }
    .contact-label {
        margin: 0 auto 24px;
    }
    .premium-form-glass-card {
        padding: 24px 16px;
    }
}
</style>

<!-- Wrap the entire contact page in the scoping class -->
<div class="premium-page">
    
    <!-- Cyber Backgrounds & Orbs -->
    <div class="cyber-grid"></div>
    <div class="cyber-lines">
        <div class="cyber-line-pulse"></div>
        <div class="cyber-line-pulse h"></div>
    </div>
    <div class="particles">
        <div class="particle p1"></div>
        <div class="particle p2"></div>
        <div class="particle p3"></div>
        <div class="particle p4"></div>
    </div>
    <div class="glow-orb blue"></div>
    <div class="glow-orb purple"></div>
    <div class="glow-orb red"></div>

    <!-- MAIN REDESIGNED 2-COLUMN CONTACT SECTION -->
    <section class="contact-layout-wrapper">
        <div class="container position-relative z-index-common">
            <div class="row align-items-stretch gy-5">
                
                <!-- Left Column: Branding, Badges & Premium Cards -->
                <div class="col-lg-6 align-self-stretch fade-up">
                    <div class="d-flex flex-column justify-content-between h-100 pe-lg-4">
                        <div>
                            <!-- Badge/Small Label -->
                            <div class="contact-label">
                                <span style="width: 8px; height: 8px; background-color: #069845; border-radius: 50%; display: inline-block; box-shadow: 0 0 10px #069845; animation: pulse 1.5s infinite;"></span>
                                SECURE GATEWAY // PORT 443 ACTIVE
                            </div>
                            
                            <!-- Large Bold Heading with Gradient Highlight -->
                            <h1 class="contact-heading">
                                Connect with our <span class="gradient-text">Elite Cyber Command</span>
                            </h1>
                            
                            <!-- Short Supporting Paragraph with high readability -->
                            <p class="contact-desc">
                                Discuss threat modeling, infrastructure vulnerability mitigation, cloud security perimeters, or compliance frameworks. Our emergency response team operates 24/7/365 to safeguard critical environments.
                            </p>
                            
                            <!-- Three Trust Badges -->
                            <div class="trust-badges-row">
                                <div class="trust-badge-item">
                                    <i class="fas fa-shield-halved"></i>
                                    <span>24/7 Security Support</span>
                                </div>
                                <div class="trust-badge-item">
                                    <i class="fas fa-bolt-lightning"></i>
                                    <span>Response Within 30 Mins</span>
                                </div>
                                <div class="trust-badge-item">
                                    <i class="fas fa-globe"></i>
                                    <span>Trusted by Global Enterprises</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Cards (2x2 grid layout) -->
                        <div class="contact-cards-grid">
                            <div class="premium-contact-card">
                                <div class="card-icon-wrap">
                                    <i class="fas fa-map-location-dot"></i>
                                </div>
                                <h5>Office Location</h5>
                                <p>London, United Kingdom</p>
                            </div>
                            <div class="premium-contact-card">
                                <div class="card-icon-wrap">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <h5>Business Email</h5>
                                <a href="mailto:info@advertresources.com">info@advertresources.com</a>
                            </div>
                            <div class="premium-contact-card">
                                <div class="card-icon-wrap">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <h5>Phone Number</h5>
                                <a href="tel:+4402012345678">+44 (0) 20 1234 5678</a>
                            </div>
                            <div class="premium-contact-card">
                                <div class="card-icon-wrap">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h5>Working Hours</h5>
                                <p>Mon - Fri, 09:00 - 18:00 (GMT)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Frosted Glass Form Card -->
                <div class="col-lg-6 align-self-stretch fade-up delay-100">
                    <div class="premium-form-glass-card">
                        <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; color: #ffffff; margin-bottom: 24px;">Secure Transmission Protocol</h3>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-md-6 form-floating-custom">
                                    <i class="far fa-user input-icon"></i>
                                    <input type="text" name="name" id="name" placeholder=" " required>
                                    <label for="name">Full Name</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <i class="far fa-envelope input-icon"></i>
                                    <input type="email" name="email" id="email" placeholder=" " required>
                                    <label for="email">Business Email</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <i class="far fa-building input-icon"></i>
                                    <input type="text" name="company" id="company" placeholder=" " required>
                                    <label for="company">Company Name</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <i class="far fa-phone input-icon"></i>
                                    <input type="text" name="phone" id="phone" placeholder=" ">
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <i class="far fa-globe input-icon"></i>
                                    <input type="text" name="country" id="country" placeholder=" ">
                                    <label for="country">Country</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <i class="far fa-sliders input-icon"></i>
                                    <select name="service" id="service" required>
                                        <option value="" disabled selected hidden></option>
                                        <option value="assessment">Security Assessment</option>
                                        <option value="pentest">Penetration Testing</option>
                                        <option value="soc">Managed SOC</option>
                                        <option value="cloud">Cloud Security</option>
                                        <option value="endpoint">Endpoint Security</option>
                                        <option value="ir">Incident Response</option>
                                        <option value="compliance">Compliance Consulting</option>
                                        <option value="zerotrust">Zero Trust Security</option>
                                        <option value="other">Other Inquiry</option>
                                    </select>
                                    <label for="service">Service Needed</label>
                                </div>
                                <div class="col-12 form-floating-custom">
                                    <i class="far fa-money-bill-1 input-icon"></i>
                                    <input type="text" name="budget" id="budget" placeholder=" ">
                                    <label for="budget">Project Budget (Optional)</label>
                                </div>
                                <div class="col-12 form-floating-custom">
                                    <i class="far fa-message input-icon"></i>
                                    <textarea name="message" id="message" rows="5" placeholder=" " required></textarea>
                                    <label for="message">Detailed Scope / Message</label>
                                </div>
                                <div class="col-12">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" required>
                                        <span>I agree to the encryption transmission & privacy terms.</span>
                                    </label>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn-cyber-premium w-100">
                                        Initiate Secure Connection
                                        <i class="far fa-long-arrow-right ms-2"></i>
                                    </button>
                                    <div class="secure-note">
                                        <i class="fas fa-lock"></i>
                                        <span>✔ Secure & Encrypted SSL Submission</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- MAP SECTION -->
    <section class="map-section">
        <div class="container position-relative z-index-common">
            <div class="row gy-4">
                <div class="col-lg-5 fade-up delay-100">
                    <div class="map-card">
                        <h2 class="mb-4">Global Command Center</h2>
                        <p class="sidebar-text mb-4">Our London headquarters houses our primary Tier IV data infrastructure and elite intelligence analysts.</p>
                        
                        <h4 class="text-white mb-2">Address</h4>
                        <p class="sidebar-text mb-4">123 Cyber Avenue, Silicon Roundabout<br>London, EC1V 9XX<br>United Kingdom</p>
                        
                        <h4 class="text-white mb-2">Visitor Access</h4>
                        <p class="sidebar-text mb-4">Strictly by appointment only. Secure underground parking available for authorized client vehicles.</p>
                        
                        <h4 class="text-white mb-2">Meeting Availability</h4>
                        <p class="sidebar-text">In-person consultations require 48 hours notice and pre-clearance.</p>
                    </div>
                </div>
                <div class="col-lg-7 fade-up delay-200">
                    <!-- Google Map Embed with CSS filters applied via premium-contact.css -->
                    <iframe class="map-embed w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.18237072596!2d-0.10159865000000001!3d51.52864165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2sus!4v1690000000000!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section">
        <div class="container position-relative z-index-common fade-up delay-100">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion accordion-custom" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How quickly do you respond?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    For standard inquiries, our team responds within 1 hour during business hours. For emergency incidents, our rapid response team engages within 15 minutes of declaration, operating 24/7/365.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Can we request emergency support?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes. If you are experiencing an active breach, ransomware deployment, or critical data exfiltration, use our Emergency Incident button to bypass standard queues and immediately connect with our IR commanders.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Do you sign NDAs?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutely. We operate under strict confidentiality. Mutual Non-Disclosure Agreements (MNDAs) are executed prior to any detailed architectural discussions or intelligence sharing.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Which industries do you support?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We protect critical infrastructure, financial institutions, healthcare providers, defense contractors, and large-scale SaaS enterprises globally. Our solutions scale to meet the highest regulatory compliance standards.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Is the consultation free?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, the initial security architecture consultation is fully complimentary. It allows our specialists to understand your threat model and propose targeted capabilities without any initial obligation.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>
