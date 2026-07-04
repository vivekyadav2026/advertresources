<?php include 'header.php'; ?>
<!-- Include the custom premium CSS specifically for this page -->
<link rel="stylesheet" href="assets/css/premium-theme.css">

<!-- Wrap the entire contact page in the scoping class -->
<div class="premium-page">
    
    <!-- Cyber Backgrounds & Orbs -->
    <div class="cyber-grid"></div>
    <div class="glow-orb blue"></div>
    <div class="glow-orb purple"></div>
    <div class="glow-orb red"></div>

    <!-- HERO SECTION -->
    <section class="hero-premium fade-up">
        <div class="container position-relative z-index-common">
            <div class="sec-badge">
                <i class="fas fa-shield-alt"></i> Security Command
            </div>
            <h1>Contact Security Experts</h1>
            <p>Discuss your infrastructure, cloud, endpoint, SOC, compliance, or incident response requirements with our specialists.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="#contact-form" class="btn-cyber">Contact Security Team <i class="fas fa-arrow-right ms-2"></i></a>
                <a href="#contact-form" class="btn-cyber btn-cyber-outline">Schedule Consultation</a>
            </div>
        </div>
    </section>

    <!-- MAIN FORM & SIDEBAR SECTION -->
    <section style="padding: 20px 0;" id="contact-form">
        <div class="container position-relative z-index-common">
            <div class="row gy-4">
                <!-- Left 65% -->
                <div class="col-lg-7 col-xl-8">
                    <div class="glass-card premium-form-wrap fade-up delay-100">
                        <h2 class="mb-4">Secure Transmission</h2>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-md-6 form-floating-custom">
                                    <input type="text" name="name" id="name" placeholder=" " required>
                                    <label for="name">Full Name</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <input type="email" name="email" id="email" placeholder=" " required>
                                    <label for="email">Business Email</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <input type="text" name="company" id="company" placeholder=" " required>
                                    <label for="company">Company Name</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <input type="text" name="phone" id="phone" placeholder=" ">
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <input type="text" name="country" id="country" placeholder=" ">
                                    <label for="country">Country</label>
                                </div>
                                <div class="col-md-6 form-floating-custom">
                                    <select name="service" id="service" required>
                                        <option value="" disabled selected hidden></option>
                                        <option value="assessment">Security Assessment</option>
                                        <option value="pentest">Penetration Testing</option>
                                        <option value="soc">Managed SOC</option>
                                        <option value="cloud">Cloud Security</option>
                                        <option value="endpoint">Endpoint Security</option>
                                        <option value="ir">Incident Response</option>
                                        <option value="compliance">Compliance Consulting</option>
                                        <option value="zerotrust">Zero Trust</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label for="service">Service Needed</label>
                                </div>
                                <div class="col-12 form-floating-custom">
                                    <input type="text" name="budget" id="budget" placeholder=" ">
                                    <label for="budget">Budget (Optional)</label>
                                </div>
                                <div class="col-12 form-floating-custom">
                                    <textarea name="message" id="message" rows="4" placeholder=" " required></textarea>
                                    <label for="message">Message</label>
                                </div>
                                <div class="col-12">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" required>
                                        I agree to the privacy policy and data processing terms.
                                    </label>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn-cyber w-100">Send Secure Request <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Right 35% -->
                <div class="col-lg-5 col-xl-4 fade-up delay-200">
                    <div class="glass-card sidebar-card">
                        <h3 class="sidebar-card-title"><i class="fas fa-map-marker-alt" style="filter: drop-shadow(0 0 10px rgba(59,130,246,0.5));"></i> Headquarters</h3>
                        <p class="sidebar-text text-white fw-bold">London, United Kingdom</p>
                        <p class="sidebar-text">24/7 Security Operations Center</p>
                        <p class="sidebar-text">Tier IV Infrastructure</p>
                        <p class="sidebar-text">Global Monitoring</p>
                    </div>
                    
                    <div class="glass-card sidebar-card">
                        <h3 class="sidebar-card-title"><i class="fas fa-address-book"></i> Contact Details</h3>
                        <a href="mailto:info@advertresources.com" class="contact-link"><i class="fas fa-envelope"></i> Business: info@advertresources.com</a>
                        <a href="mailto:support@advertresources.com" class="contact-link"><i class="fas fa-life-ring"></i> Support: support@advertresources.com</a>
                        <a href="tel:+4402012345678" class="contact-link"><i class="fas fa-phone"></i> Phone: +44 (0) 20 1234 5678</a>
                    </div>
                    
                    <div class="glass-card sidebar-card">
                        <h3 class="sidebar-card-title"><i class="fas fa-clock"></i> Business Hours</h3>
                        <p class="sidebar-text">Monday–Friday<br>09:00–18:00 (GMT)</p>
                        <hr style="border-color: rgba(255,255,255,0.1);">
                        <p class="sidebar-text fw-bold text-white mb-0">24/7 Emergency Response Active</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TRUST SECTION -->
    <section class="trust-section">
        <div class="container position-relative z-index-common">
            <div class="row gy-4">
                <div class="col-md-6 col-lg-3 fade-up delay-100">
                    <div class="glass-card trust-card">
                        <div class="trust-icon"><i class="fas fa-bolt"></i></div>
                        <div class="trust-value">< 1 Hour</div>
                        <div class="trust-label">Response Time</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up delay-200">
                    <div class="glass-card trust-card">
                        <div class="trust-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="trust-value">24/7</div>
                        <div class="trust-label">SOC Availability</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up delay-300">
                    <div class="glass-card trust-card">
                        <div class="trust-icon"><i class="fas fa-lock"></i></div>
                        <div class="trust-value">AES-256</div>
                        <div class="trust-label">Encryption</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up delay-400">
                    <div class="glass-card trust-card">
                        <div class="trust-icon"><i class="fas fa-globe"></i></div>
                        <div class="trust-value">100+</div>
                        <div class="trust-label">Global Clients</div>
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
