<?php include 'header.php'; ?>
<div class="space">

        <section class="page-header" style="background: var(--bg-surface);">
            <div class="container">
                <h1 class="page-title reveal">Engage Operations</h1>
                <p class="page-desc reveal" style="transition-delay: 0.1s;">Establish a secure communication channel with our deployment specialists to architect your zero-trust perimeter.</p>
            </div>
        </section>

        <section class="section">
            <div class="container contact-layout reveal">
                <!-- Form Side -->
                <div style="border: 1px solid var(--border-color); padding: 3rem; background: var(--bg-surface);">
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Secure Transmission</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 2rem;">All communications are end-to-end encrypted. We aim to respond within 1 hour during operational hours.</p>

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="name" class="form-label">FULL NAME / CLEARANCE</label>
                            <input type="text" id="name" name="name" class="form-input" required placeholder="Enter your full name">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">CORPORATE EMAIL ADDRESS</label>
                            <input type="email" id="email" name="email" class="form-input" required placeholder="Enter your corporate email">
                        </div>
                        
                        <div class="form-group">
                            <label for="service" class="form-label">REQUIRED CAPABILITY</label>
                            <select id="service" name="service" class="form-input" required>
                                <option value="">Select a capability</option>
                                <option value="application">Application Security Testing</option>
                                <option value="network">Network & Perimeter Security</option>
                                <option value="redteam">Red Team Assessment</option>
                                <option value="soc">Managed SOC Integration</option>
                                <option value="forensics">Digital Forensics / Incident Response</option>
                                <option value="compliance">Compliance & Data Privacy Audit</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">OPERATIONAL DETAILS</label>
                            <textarea id="message" name="message" class="form-input" required placeholder="Describe your current infrastructure and security requirements..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Transmit Request <i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                </div>

                <!-- Info Side -->
                <div>
                    <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 2rem; margin-bottom: 2rem;">
                        <h4 style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">GLOBAL HEADQUARTERS</h4>
                        <div style="font-size: 1.25rem; font-family: var(--font-heading);">London, United Kingdom</div>
                        <p style="color: var(--text-secondary); margin-top: 0.5rem;">Our primary Security Operations Center (SOC) is housed in a secure, Tier IV facility in London, monitoring global client telemetry 24/7/365.</p>
                    </div>

                    <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 2rem; margin-bottom: 2rem;">
                        <h4 style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">DIRECT COMMUNICATION</h4>
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <i class="fa-solid fa-envelope" style="color: var(--accent-primary);"></i>
                                <span style="font-family: var(--font-mono); color: var(--text-primary);">info@advertresources.com</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">INCIDENT RESPONSE (URGENT)</h4>
                        <p style="color: var(--text-secondary); margin-bottom: 1rem;">If you are currently experiencing an active breach or ransomware attack, use our emergency channel. Our IR team will deploy immediately.</p>
                        <a href="#" class="btn-secondary" style="border-color: var(--accent-alert); color: var(--accent-alert);">Declare Incident</a>
                    </div>
                </div>
            </div>
        </section>
    
</div>
<?php include 'footer.php'; ?>
