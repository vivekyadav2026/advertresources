<?php include 'header.php'; ?>

<!-- Scoped Premium Styles for the Services Page -->
<style>
.premium-services-page {
    background-color: #000916;
    color: #a9a9a9;
    font-family: "Kumbh Sans", sans-serif;
    position: relative;
    overflow: hidden;
}

.premium-services-page h1,
.premium-services-page h2,
.premium-services-page h3,
.premium-services-page h4,
.premium-services-page h5,
.premium-services-page h6 {
    color: #ffffff;
    font-weight: 700;
}

/* Background Cyber Mesh & glowing orbs */
.services-cyber-grid {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: 
        linear-gradient(rgba(37, 99, 235, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37, 99, 235, 0.05) 1px, transparent 1px);
    background-size: 50px 50px;
    z-index: 0;
    pointer-events: none;
}

.services-cyber-lines {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: 
      linear-gradient(to right, rgba(96, 165, 250, 0.02) 1px, transparent 1px) 0 0 / 120px 100%,
      linear-gradient(to bottom, rgba(96, 165, 250, 0.02) 1px, transparent 1px) 0 0 / 100% 120px;
    pointer-events: none;
    z-index: 0;
}

.services-glow-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(120px);
    z-index: 0;
    pointer-events: none;
    opacity: 0.4;
}
.services-glow-orb.blue { background: rgba(37, 99, 235, 0.3); width: 500px; height: 500px; top: -100px; left: -100px; }
.services-glow-orb.purple { background: rgba(147, 51, 234, 0.2); width: 600px; height: 600px; top: 40%; right: -200px; }
.services-glow-orb.magenta { background: rgba(224, 0, 155, 0.15); width: 400px; height: 400px; bottom: -100px; left: 10%; }

/* Particles */
.services-particles {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    overflow: hidden;
    pointer-events: none;
    z-index: 1;
}
.services-particle {
    position: absolute;
    background: radial-gradient(circle, rgba(96, 165, 250, 0.2) 0%, rgba(96, 165, 250, 0) 70%);
    border-radius: 50%;
    animation: floatServicesParticle 25s infinite linear;
}
.services-particle.p1 { width: 120px; height: 120px; top: 10%; left: 5%; }
.services-particle.p2 { width: 180px; height: 180px; top: 60%; right: 5%; animation-delay: -5s; }

@keyframes floatServicesParticle {
    0% { transform: translateY(0) scale(1); opacity: 0.3; }
    50% { transform: translateY(-30px) scale(1.05); opacity: 0.5; }
    100% { transform: translateY(0) scale(1); opacity: 0.3; }
}

/* Status badge pulse */
.services-status-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    background: rgba(224, 0, 155, 0.1);
    border: 1px solid rgba(224, 0, 155, 0.3);
    border-radius: 30px;
    color: #fff;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    box-shadow: 0 0 15px rgba(224, 0, 155, 0.2);
}

.services-pulse-dot {
    width: 8px;
    height: 8px;
    background-color: #069845;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 10px #069845;
    animation: activeServicesPulse 1.5s infinite;
}

@keyframes activeServicesPulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.3); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}

/* Hero Typography */
.services-hero-title {
    font-size: clamp(2.3rem, 5.5vw, 3.8rem);
    font-weight: 800;
    line-height: 1.15;
    background: linear-gradient(135deg, #ffffff 40%, #E0009B 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -1px;
}

/* Capability Glass Card Grid */
.services-grid-card {
    background: rgba(15, 23, 42, 0.55);
    border: 1px solid rgba(59, 130, 246, 0.12);
    border-radius: 20px;
    padding: 35px 25px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.services-grid-card:hover {
    border-color: rgba(59, 130, 246, 0.4);
    box-shadow: 0 20px 45px rgba(59, 130, 246, 0.15);
    transform: translateY(-5px);
}

.services-card-icon {
    width: 54px;
    height: 54px;
    border-radius: 12px;
    background: rgba(59, 130, 246, 0.08);
    border: 1px solid rgba(59, 130, 246, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    font-size: 1.4rem;
    color: #60a5fa;
    box-shadow: 0 0 15px rgba(59, 130, 246, 0.1);
    transition: all 0.3s ease;
}

.services-grid-card:hover .services-card-icon {
    background: rgba(59, 130, 246, 0.2);
    border-color: rgba(59, 130, 246, 0.5);
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    transform: scale(1.05);
}

.services-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 12px;
}

.services-card-text {
    font-size: 0.9rem;
    line-height: 1.6;
    color: #a9a9a9;
    flex-grow: 1;
    margin-bottom: 25px;
}

/* Service item line action button */
.services-action-btn {
    display: inline-flex;
    align-items: center;
    font-size: 0.85rem;
    font-weight: 700;
    color: #ffffff;
    gap: 8px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: color 0.3s ease;
    text-decoration: none !important;
}

.services-action-btn i {
    font-size: 0.9rem;
    color: #3C72FC;
    transition: transform 0.3s ease;
}

.services-grid-card:hover .services-action-btn {
    color: #60a5fa;
}

.services-grid-card:hover .services-action-btn i {
    transform: translateX(4px);
    color: #60a5fa;
}

@media (max-width: 767px) {
    .premium-services-page {
        text-align: center;
    }
    .banner-breadcrumbs {
        justify-content: center;
        display: flex;
    }
    .services-status-tag {
        margin: 0 auto 20px;
    }
    .services-card-icon {
        margin: 0 auto 24px;
    }
    .services-action-btn {
        justify-content: center;
    }
}
</style>

<div class="premium-services-page">

    <!-- Background Elements -->
    <div class="services-cyber-grid"></div>
    <div class="services-cyber-lines"></div>
    <div class="services-particles">
        <div class="services-particle p1"></div>
        <div class="services-particle p2"></div>
    </div>
    <div class="services-glow-orb blue"></div>
    <div class="services-glow-orb purple"></div>
    <div class="services-glow-orb magenta"></div>

    <!-- Hero Banner -->
    <div class="ot-hero-wrapper hero-2" style="padding: 100px 0 60px; position: relative; z-index: 2;">
        <div class="container">
            <div class="title-area text-center mb-0">
                <div class="banner-breadcrumbs mb-15" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: #a9a9a9;">
                    <a href="index.php" style="color: #ffffff; opacity: 0.7; transition: opacity 0.3s;">Home</a> 
                    <span style="margin: 0 10px; opacity: 0.5;">/</span> 
                    <span style="color: #E0009B; font-weight: 600;">Services</span>
                </div>
                
                <span class="services-status-tag mb-4">
                    <span class="services-pulse-dot"></span>
                    Command Level Verification
                </span>
                
                <h1 class="services-hero-title mb-3">Capabilities Architecture</h1>
                <p class="sec-text text-white-50 mx-auto" style="max-width: 700px; font-size: 1.1rem; line-height: 1.6;">
                    Comprehensive security layers designed for high-risk digital environments. We deploy proactive, intelligence-driven defense systems to shield your critical digital frontiers.
                </p>
            </div>
        </div>
    </div>

    <!-- Capabilities Grid -->
    <section class="space-bottom" style="padding: 40px 0 100px; position: relative; z-index: 2;">
        <div class="container">
            <div class="row gy-30">
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-code"></i></div>
                        <h3 class="services-card-title">Application Security</h3>
                        <p class="services-card-text">Secure code reviews, SAST/DAST integrations, and application hardening frameworks designed to evict critical payload bugs.</p>
                        <a href="services-application-security.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-shield-halved"></i></div>
                        <h3 class="services-card-title">Network Security</h3>
                        <p class="services-card-text">Perimeter protection schemas, multi-layered zero-trust network segments, and automated Deep Packet Inspections.</p>
                        <a href="services-network-security.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-mask"></i></div>
                        <h3 class="services-card-title">Red Team Assessment</h3>
                        <p class="services-card-text">Simulated advanced persistent threat (APT) attacks and infrastructure penetration audits designed to expose latent vectors.</p>
                        <a href="services-red-team.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-file-shield"></i></div>
                        <h3 class="services-card-title">Compliance & Data Privacy</h3>
                        <p class="services-card-text">Engineering compliance for ISO 27001, NIST CSF, GDPR, and HIPAA frameworks. Securing robust operational resilience.</p>
                        <a href="services-compliance-and-data-privacy.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-magnifying-glass-chart"></i></div>
                        <h3 class="services-card-title">Digital Forensics & IR</h3>
                        <p class="services-card-text">Rapid threat containment, chain-of-custody log extractions, active payload analysis, and post-breach mitigation.</p>
                        <a href="services-digital-forensics.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-radar"></i></div>
                        <h3 class="services-card-title">Managed Security (SOC)</h3>
                        <p class="services-card-text">24/7/365 active SIEM detection, log aggregation, real-time alert triage, and threat hunting governed by security specialists.</p>
                        <a href="services-managed-security.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-crosshairs"></i></div>
                        <h3 class="services-card-title">Advanced Threat Detection</h3>
                        <p class="services-card-text">Proactively identify and respond to emerging threats, safeguarding your critical assets from potential harm.</p>
                        <a href="advanced-threat-detection.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-lock"></i></div>
                        <h3 class="services-card-title">Robust Data Protection</h3>
                        <p class="services-card-text">Safeguard your sensitive data with robust encryption, secure access controls, and data loss prevention measures.</p>
                        <a href="robust-data-protection.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-desktop"></i></div>
                        <h3 class="services-card-title">Security Monitoring</h3>
                        <p class="services-card-text">Our team of security experts monitors your environment around the clock, detecting and responding to threats in real-time.</p>
                        <a href="security-monitoring.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-key"></i></div>
                        <h3 class="services-card-title">Access Broker Security</h3>
                        <p class="services-card-text">Control external identity vectors, IAM verification, and privileged access management (PAM) to stop credential harvesting.</p>
                        <a href="services-access-broker.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-cloud"></i></div>
                        <h3 class="services-card-title">Cloud Posture Control</h3>
                        <p class="services-card-text">Assess multi-cloud infrastructure configurations. Enforce CI/CD pipeline integrity and cloud container vulnerability checks.</p>
                        <a href="services-cloud-posture.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-laptop-medical"></i></div>
                        <h3 class="services-card-title">Endpoint Response</h3>
                        <p class="services-card-text">EDR deployments targeting malware execution, memory manipulation, and ransomware behaviors directly at the device edge.</p>
                        <a href="services-endpoint-response.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-grid-card">
                        <div class="services-card-icon"><i class="fas fa-server"></i></div>
                        <h3 class="services-card-title">Workload Protection</h3>
                        <p class="services-card-text">Securing serverless functions, Kubernetes clusters, and hypervisors against internal lateral movement and container breakouts.</p>
                        <a href="services-workload-protection.php" class="services-action-btn">View Spec <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php include 'footer.php'; ?>
