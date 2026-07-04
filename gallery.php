<?php include 'header.php'; ?>
<!-- Include the global premium CSS -->
<link rel="stylesheet" href="assets/css/premium-theme.css">

<!-- Wrap the entire page in the scoping class -->
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
                <i class="fas fa-radar"></i> Operational Telemetry
            </div>
            <h1>Visual Telemetry</h1>
            <p>A look into the structural topology and interfaces of our cybersecurity operations.</p>
        </div>
    </section>

    <!-- GALLERY GRID SECTION -->
    <section style="padding: 20px 0 40px;">
        <div class="container position-relative z-index-common">
            <div class="row gy-4">
                
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6 fade-up delay-100">
                    <div class="glass-card h-100 overflow-hidden d-flex flex-column" style="padding: 0; border: 1px solid rgba(255,255,255,0.05);">
                        <div class="gallery-img-wrapper" style="overflow: hidden; border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <img src="assets/topology.png" alt="Data Topology Diagram" class="w-100" style="object-fit: cover; height: 250px; filter: contrast(120%) brightness(80%) hue-rotate(180deg) sepia(20%) saturate(150%); transition: transform 0.4s ease;">
                        </div>
                        <div class="p-4 flex-grow-1">
                            <h3 class="box-title text-white mb-2" style="font-size: 1.25rem;">Network Topology Schema</h3>
                            <p class="sidebar-text mb-0" style="font-family: 'Space Grotesk', monospace; font-size: 0.85rem; color: #60a5fa;">DIAG // 01 - Zero-Trust Segmented Architecture</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6 fade-up delay-200">
                    <div class="glass-card h-100 overflow-hidden d-flex flex-column" style="padding: 0; border: 1px solid rgba(255,255,255,0.05);">
                        <div class="gallery-img-wrapper" style="overflow: hidden; border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <img src="assets/dashboard.png" alt="SOC Dashboard" class="w-100" style="object-fit: cover; height: 250px; filter: contrast(120%) brightness(80%) hue-rotate(180deg) sepia(20%) saturate(150%); transition: transform 0.4s ease;">
                        </div>
                        <div class="p-4 flex-grow-1">
                            <h3 class="box-title text-white mb-2" style="font-size: 1.25rem;">SOC Global Dashboard</h3>
                            <p class="sidebar-text mb-0" style="font-family: 'Space Grotesk', monospace; font-size: 0.85rem; color: #60a5fa;">DIAG // 02 - Real-Time Threat Hunting Interface</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6 fade-up delay-300">
                    <div class="glass-card h-100 overflow-hidden d-flex flex-column" style="padding: 0; border: 1px solid rgba(255,255,255,0.05);">
                        <div class="gallery-img-wrapper" style="overflow: hidden; border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <img src="assets/encryption.png" alt="Encrypted Data Stream" class="w-100" style="object-fit: cover; height: 250px; filter: contrast(120%) brightness(80%) hue-rotate(180deg) sepia(20%) saturate(150%); transition: transform 0.4s ease;">
                        </div>
                        <div class="p-4 flex-grow-1">
                            <h3 class="box-title text-white mb-2" style="font-size: 1.25rem;">Data Stream Encryption</h3>
                            <p class="sidebar-text mb-0" style="font-family: 'Space Grotesk', monospace; font-size: 0.85rem; color: #60a5fa;">DIAG // 03 - TLS 1.3 Payload Tunneling</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CLASSIFIED NOTICE BANNER -->
            <div class="mt-5 fade-up delay-400">
                <div class="emergency-card" style="padding: 30px; border-radius: 12px; text-align: center;">
                    <div class="mb-3">
                        <i class="fas fa-lock" style="font-size: 2rem; color: #ef4444; filter: drop-shadow(0 0 10px rgba(239,68,68,0.5));"></i>
                    </div>
                    <p class="mb-0 text-white" style="font-family: 'Space Grotesk', monospace; font-size: 0.95rem; letter-spacing: 1px; line-height: 1.6;">
                        <span class="fw-bold" style="color: #fca5a5;">CONFIDENTIALITY NOTICE:</span> All live operational telemetry and client data topologies are strictly classified. Images above represent sanitized structural models for demonstration purposes only.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
/* Add a smooth zoom on hover for the gallery images */
.glass-card:hover .gallery-img-wrapper img {
    transform: scale(1.05);
}
</style>

<?php include 'footer.php'; ?>
