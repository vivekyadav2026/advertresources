<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Security | Advert Resource Ltd</title>
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
                    <li class="nav-item"><a href="index.php" class="nav-link">Platform</a></li>
                    <li class="nav-item active">
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
        <section class="page-header" style="background: var(--bg-surface);">
            <div class="container">
                <p style="font-family: var(--font-mono); color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1rem;">CAPABILITY // 01</p>
                <h1 class="page-title reveal">Application Security</h1>
                <p class="page-desc reveal" style="transition-delay: 0.1s;">Harden your internal and external software infrastructure against injection, XSS, and critical logic flaws.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="service-detail-layout reveal">
                    <div class="service-content">
                        <h2>Secure Code Architecture</h2>
                        <p>Modern applications are the primary vector for advanced persistent threats. Our application security protocols dive deep into the source code and runtime environments of your software, identifying vulnerabilities before they can be exploited in production.</p>
                        
                        <p>We deploy a hybrid approach of automated SAST/DAST tools alongside manual penetration testing by elite code auditors, ensuring comprehensive coverage against the OWASP Top 10 and zero-day vulnerabilities.</p>

                        <div class="content-box">
                            <h3>Deployment Scope</h3>
                            <ul class="detail-list">
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div>
                                        <strong style="color: var(--text-primary);">Static Analysis (SAST)</strong><br>
                                        Automated source code scanning integrated directly into your CI/CD pipeline.
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div>
                                        <strong style="color: var(--text-primary);">Dynamic Analysis (DAST)</strong><br>
                                        Runtime vulnerability assessment mimicking real-world attacker behavior.
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div>
                                        <strong style="color: var(--text-primary);">API & Microservices Security</strong><br>
                                        Rigorous authentication and data authorization checks across interconnected systems.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <div style="border: 1px solid var(--border-color); background: var(--bg-surface); padding: 2rem;">
                            <h3 style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--text-muted); margin-bottom: 1.5rem;">ENGAGE THIS CAPABILITY</h3>
                            <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 1.5rem;">Speak with an deployment architect to integrate app-sec into your development lifecycle.</p>
                            <a href="contact-us.php" class="btn-primary" style="width: 100%; justify-content: center;">Deploy Capability <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div style="margin-top: 2rem; border-top: 1px solid var(--border-color); padding-top: 2rem;">
                            <a href="services.php" style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--text-secondary);"><i class="fa-solid fa-arrow-left"></i> Return to Capabilities</a>
                        </div>
                    </div>
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

