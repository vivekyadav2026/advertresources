<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advert Resource Ltd | Advanced Cybersecurity Solutions</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <i class="fa-solid fa-shield-halved logo-icon"></i>
                ADVERT RESOURCE LTD
            </div>
            
            <nav>
                <ul class="nav-links">
                    <li class="nav-item active"><a href="index.php" class="nav-link">Platform</a></li>
                    <li class="nav-item">
                        <a href="services.php" class="nav-link">Capabilities <i class="fa-solid fa-chevron-down" style="font-size: 0.7em;"></i></a>
                        <div class="dropdown-menu">
                            <a href="services-application-security.php" class="dropdown-item">Application Security</a>
                            <a href="services-network-security.php" class="dropdown-item">Network Security</a>
                            <a href="services-compliance-and-data-privacy.php" class="dropdown-item">Compliance & Privacy</a>
                            <a href="services-red-team.php" class="dropdown-item">Red Team Assessment</a>
                            <a href="services-digital-forensics.php" class="dropdown-item">Digital Forensics</a>
                            <a href="services-managed-security.php" class="dropdown-item">Managed Security (SOC)</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="about-us.php" class="nav-link">Company</a></li>
                    <li class="nav-item"><a href="gallery.php" class="nav-link">Telemetry</a></li>
                    <li class="nav-item"><a href="contact-us.php" class="nav-btn">Engage Team</a></li>
                </ul>
                <button class="menu-toggle" aria-label="Toggle Navigation">
                    <span></span><span></span><span></span>
                </button>
            </nav>
        </div>
    </header>

    <main>
        <!-- Asymmetric Hero -->
        <section class="hero">
            <div class="container hero-grid">
                <div class="hero-content reveal">
                    <span class="hero-badge"><i class="fa-solid fa-circle" style="font-size: 0.5rem; color: var(--accent-alert);"></i> SYSTEM SECURE</span>
                    <h1 class="hero-title">Zero-Trust Architecture for the Modern Enterprise.</h1>
                    <p class="hero-description">Empowering Your Digital Future with Advanced Cybersecurity Solutions & Services. Stop breaches, defend perimeters, and secure operations with Advert Resource Ltd.</p>
                    <div class="hero-btns">
                        <a href="contact-us.php" class="btn-primary">Deploy Protection <i class="fa-solid fa-arrow-right"></i></a>
                        <a href="services.php" class="btn-secondary">View Architecture</a>
                    </div>
                </div>
                
                <!-- Signature Element -->
                <div class="telemetry-widget reveal">
                    <div class="tel-header">
                        <span>LIVE THREAT TELEMETRY // UK-LDN-01</span>
                        <span>STS: ACTIVE</span>
                    </div>
                    <div class="tel-body" id="telemetry-body">
                        <!-- Populated by app.js -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Commitment Spec Strip -->
        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Operational Excellence</h2>
                    <p class="section-desc">Why enterprise leaders trust our architecture.</p>
                </div>
                
                <div class="spec-strip reveal">
                    <div class="spec-item">
                        <span class="spec-num">01 / CAPABILITY</span>
                        <h3 class="spec-title">Proactive Defense</h3>
                        <p class="spec-desc">Utilizing real-time heuristic analysis to identify and neutralize zero-day threats before they reach the perimeter.</p>
                    </div>
                    <div class="spec-item">
                        <span class="spec-num">02 / COMPLIANCE</span>
                        <h3 class="spec-title">Global Standards</h3>
                        <p class="spec-desc">Strict adherence to ISO 27001, GDPR, and NIST frameworks, ensuring legal and operational resilience.</p>
                    </div>
                    <div class="spec-item">
                        <span class="spec-num">03 / CONTINUITY</span>
                        <h3 class="spec-title">24/7 SOC Operations</h3>
                        <p class="spec-desc">Continuous monitoring and rapid incident response protocols governed by elite security analysts.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Tabbed Grid -->
        <section class="section" style="background: var(--bg-surface);">
            <div class="container">
                <div class="section-header offset">
                    <h2 class="section-title">Core Capabilities</h2>
                    <p class="section-desc">Comprehensive security layers designed for high-risk digital environments.</p>
                </div>

                <div class="services-layout reveal">
                    <div class="services-nav">
                        <div class="service-tab active" data-target="pane-app">Application Security</div>
                        <div class="service-tab" data-target="pane-net">Network Security</div>
                        <div class="service-tab" data-target="pane-red">Red Team Assessment</div>
                        <div class="service-tab" data-target="pane-soc">Managed Security (SOC)</div>
                    </div>
                    
                    <div class="services-content-wrapper" style="background: var(--bg-base);">
                        <!-- Pane 1 -->
                        <div class="service-pane active" id="pane-app">
                            <h3 class="pane-title">Application Security</h3>
                            <p class="pane-desc">Secure code reviews and architecture analysis to harden your internal and external software infrastructure against injection, XSS, and logic flaws.</p>
                            <ul class="pane-list">
                                <li>Static App Security Testing (SAST)</li>
                                <li>Dynamic App Security Testing (DAST)</li>
                                <li>API Security Audits</li>
                                <li>DevSecOps Integration</li>
                            </ul>
                            <a href="services-application-security.php" class="pane-link">View Documentation</a>
                        </div>
                        
                        <!-- Pane 2 -->
                        <div class="service-pane" id="pane-net">
                            <h3 class="pane-title">Network Security</h3>
                            <p class="pane-desc">Perimeter defense and internal segmentation protocols designed to halt lateral movement and secure sensitive traffic.</p>
                            <ul class="pane-list">
                                <li>Zero-Trust Network Access</li>
                                <li>Firewall Configuration</li>
                                <li>Intrusion Prevention (IPS)</li>
                                <li>Traffic Encryption Protocols</li>
                            </ul>
                            <a href="services-network-security.php" class="pane-link">View Documentation</a>
                        </div>
                        
                        <!-- Pane 3 -->
                        <div class="service-pane" id="pane-red">
                            <h3 class="pane-title">Red Team Assessment</h3>
                            <p class="pane-desc">Simulated advanced persistent threat (APT) attacks to test your organization's detection and response capabilities in real-world scenarios.</p>
                            <ul class="pane-list">
                                <li>Full-Scope Penetration Testing</li>
                                <li>Social Engineering Tactics</li>
                                <li>Physical Security Breach Sims</li>
                                <li>Evasion Technique Modeling</li>
                            </ul>
                            <a href="services-red-team.php" class="pane-link">View Documentation</a>
                        </div>

                        <!-- Pane 4 -->
                        <div class="service-pane" id="pane-soc">
                            <h3 class="pane-title">Managed Security (SOC)</h3>
                            <p class="pane-desc">Outsource your threat hunting and incident response to our 24/7 Security Operations Center.</p>
                            <ul class="pane-list">
                                <li>Continuous Monitoring</li>
                                <li>Log Aggregation & SIEM</li>
                                <li>Automated Playbooks</li>
                                <li>Incident Triage</li>
                            </ul>
                            <a href="services-managed-security.php" class="pane-link">View Documentation</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Data Strip -->
        <section class="section">
            <div class="container">
                <div class="data-strip reveal">
                    <div class="data-item">
                        <div class="data-num">99.9%</div>
                        <div class="data-label">UPTIME GUARANTEE</div>
                    </div>
                    <div class="data-item">
                        <div class="data-num">1.2M+</div>
                        <div class="data-label">THREATS NEUTRALIZED / MONTH</div>
                    </div>
                    <div class="data-item">
                        <div class="data-num">&lt;15m</div>
                        <div class="data-label">CRITICAL RESPONSE TIME</div>
                    </div>
                    <div class="data-item">
                        <div class="data-num">24/7</div>
                        <div class="data-label">SOC OPERATIONS</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Editorial Style -->
        <section class="section" style="background: var(--bg-surface);">
            <div class="container">
                <div class="testimonial-container reveal">
                    <div class="pull-quote">"Advert Resource Ltd fundamentally transformed our perimeter defense. Their zero-trust implementation blocked a massive APT campaign before it could execute."</div>
                    <div class="quote-author">CHIEF INFORMATION SECURITY OFFICER, GLOBAL FINTECH INC.</div>
                </div>
            </div>
        </section>

        <!-- Certifications Strip -->
        <section class="section">
            <div class="container">
                <h3 style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--text-muted); margin-bottom: 2rem;">COMPLIANCE & STANDARDS</h3>
                <div class="cert-strip reveal">
                    <div class="cert-badge">ISO/IEC 27001 ALIGNED</div>
                    <div class="cert-badge">NIST CSF COMPLIANT</div>
                    <div class="cert-badge">GDPR DATA PRIVACY</div>
                    <div class="cert-badge">PCI-DSS COMPLIANT</div>
                    <div class="cert-badge">SOC 2 TYPE II</div>
                </div>
            </div>
        </section>
    </main>

    <!-- Technical Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="logo" style="margin-bottom: 1.5rem;">
                        <i class="fa-solid fa-shield-halved logo-icon"></i>
                        ADVERT RESOURCE LTD
                    </div>
                    <p style="color: var(--text-secondary); max-width: 300px; font-size: 0.9rem;">
                        Empowering Your Digital Future with Advanced Cybersecurity Solutions. Based in London, UK.
                    </p>
                </div>
                <div>
                    <div class="footer-col-title">PLATFORM</div>
                    <ul class="footer-links">
                        <li><a href="index.php">Overview</a></li>
                        <li><a href="services.php">Architecture</a></li>
                        <li><a href="gallery.php">Telemetry</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">CAPABILITIES</div>
                    <ul class="footer-links">
                        <li><a href="services-application-security.php">App Security</a></li>
                        <li><a href="services-network-security.php">Net Security</a></li>
                        <li><a href="services-red-team.php">Red Team</a></li>
                        <li><a href="services-managed-security.php">SOC Ops</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">COMPANY</div>
                    <ul class="footer-links">
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a href="contact-us.php">Engage</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div>&copy; 2026 Advert Resource Ltd. All rights reserved.</div>
                <div style="display: flex; gap: 2rem;">
                    <a href="#" style="color: inherit;">Privacy Policy</a>
                    <a href="#" style="color: inherit;">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="app.js"></script>
</body>
</html>

