<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telemetry & Architecture | Advert Resource Ltd</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <header>
        <div class="nav-container">
            <div class="logo">
                <i class="fa-solid fa-shield-halved logo-icon"></i>
                ADVERT RESOURCE LTD
            </div>
            
            <nav>
                <ul class="nav-links">
                    <li class="nav-item"><a href="index.php" class="nav-link">Platform</a></li>
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
                    <li class="nav-item active"><a href="gallery.php" class="nav-link">Telemetry</a></li>
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
                <h1 class="page-title reveal">Visual Telemetry</h1>
                <p class="page-desc reveal" style="transition-delay: 0.1s;">A look into the structural topology and interfaces of our cybersecurity operations.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="gallery-grid reveal">
                    
                    <!-- Item 1 -->
                    <div class="gallery-item">
                        <img src="assets/topology.png" alt="Data Topology Diagram" class="gallery-img">
                        <div class="gallery-caption">
                            <h4>Network Topology Schema</h4>
                            <p>DIAG // 01 - Zero-Trust Segmented Architecture</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="gallery-item">
                        <img src="assets/dashboard.png" alt="SOC Dashboard" class="gallery-img">
                        <div class="gallery-caption">
                            <h4>SOC Global Dashboard</h4>
                            <p>DIAG // 02 - Real-Time Threat Hunting Interface</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="gallery-item">
                        <img src="assets/encryption.png" alt="Encrypted Data Stream" class="gallery-img">
                        <div class="gallery-caption">
                            <h4>Data Stream Encryption</h4>
                            <p>DIAG // 03 - TLS 1.3 Payload Tunneling</p>
                        </div>
                    </div>
                    
                </div>
                
                <div style="margin-top: 4rem; padding: 2rem; border: 1px solid var(--border-color); background: var(--bg-surface); text-align: center;" class="reveal">
                    <p style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--text-secondary);">CONFIDENTIALITY NOTICE: All live operational telemetry and client data topologies are strictly classified. Images above represent sanitized structural models.</p>
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

