<?php include 'header.php'; ?>
<div class="space">

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
    
</div>
<?php include 'footer.php'; ?>
