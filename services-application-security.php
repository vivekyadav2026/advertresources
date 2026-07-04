<?php include 'header.php'; ?>
<div class="space">

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
    
</div>
<?php include 'footer.php'; ?>
