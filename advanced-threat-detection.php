<?php include 'header.php'; ?>

<!-- Scoped Premium Styles for the Service Detail Page -->
<style>
.premium-detail-page {
    background-color: #000916;
    color: #a9a9a9;
    font-family: "Kumbh Sans", sans-serif;
    position: relative;
    overflow: hidden;
}

.premium-detail-page h1,
.premium-detail-page h2,
.premium-detail-page h3,
.premium-detail-page h4,
.premium-detail-page h5,
.premium-detail-page h6 {
    color: #ffffff;
    font-weight: 700;
}

/* Background Cyber Mesh & glowing orbs */
.detail-cyber-grid {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: 
        linear-gradient(rgba(37, 99, 235, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37, 99, 235, 0.05) 1px, transparent 1px);
    background-size: 50px 50px;
    z-index: 0;
    pointer-events: none;
}

.detail-cyber-lines {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: 
      linear-gradient(to right, rgba(96, 165, 250, 0.02) 1px, transparent 1px) 0 0 / 120px 100%,
      linear-gradient(to bottom, rgba(96, 165, 250, 0.02) 1px, transparent 1px) 0 0 / 100% 120px;
    pointer-events: none;
    z-index: 0;
}

.detail-glow-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(120px);
    z-index: 0;
    pointer-events: none;
    opacity: 0.45;
}
.detail-glow-orb.blue { background: rgba(37, 99, 235, 0.3); width: 500px; height: 500px; top: -100px; left: -100px; }
.detail-glow-orb.purple { background: rgba(147, 51, 234, 0.25); width: 600px; height: 600px; top: 30%; right: -200px; }

/* Status tag indicators */
.detail-status-tag {
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

.detail-pulse-dot {
    width: 8px;
    height: 8px;
    background-color: #069845;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 10px #069845;
    animation: activeDetailPulse 1.5s infinite;
}

@keyframes activeDetailPulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.3); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}

/* Glassmorphism card container */
.detail-content-card {
    background: rgba(15, 23, 42, 0.55);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 45px 40px;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(15px);
}

/* Sidebar command widget */
.detail-sidebar-card {
    background: rgba(15, 23, 42, 0.65);
    border: 1px solid rgba(224, 0, 155, 0.25);
    border-radius: 20px;
    padding: 35px 25px;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6), inset 0 0 20px rgba(224, 0, 155, 0.05);
    backdrop-filter: blur(15px);
    position: relative;
    overflow: hidden;
}

.detail-sidebar-card:hover {
    border-color: rgba(224, 0, 155, 0.4);
    box-shadow: 0 25px 55px rgba(224, 0, 155, 0.15);
}

/* List details */
.detail-check-list ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.detail-check-list li {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.detail-check-list li:hover {
    background: rgba(255, 255, 255, 0.04);
    border-color: rgba(59, 130, 246, 0.25);
    transform: translateX(4px);
}

.detail-check-icon {
    font-size: 1.25rem;
    color: #60a5fa;
    margin-top: 3px;
    filter: drop-shadow(0 0 8px rgba(96, 165, 250, 0.4));
}

/* Back Link button */
.detail-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #a9a9a9;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none !important;
    transition: color 0.3s ease;
}

.detail-back-link:hover {
    color: #ffffff;
}

.detail-back-link i {
    transition: transform 0.3s ease;
}

.detail-back-link:hover i {
    transform: translateX(-4px);
}

@media (max-width: 767px) {
    .premium-detail-page {
        text-align: center;
    }
    .banner-breadcrumbs {
        justify-content: center;
        display: flex;
    }
    .detail-status-tag {
        margin: 0 auto 20px;
    }
    .detail-content-card {
        padding: 30px 20px;
    }
    .detail-check-list li {
        text-align: left;
    }
}
</style>

<div class="premium-detail-page">

    <!-- Background Elements -->
    <div class="detail-cyber-grid"></div>
    <div class="detail-cyber-lines"></div>
    <div class="detail-glow-orb blue"></div>
    <div class="detail-glow-orb purple"></div>

    <!-- Hero Section -->
    <div class="ot-hero-wrapper hero-2" style="padding: 100px 0 60px; position: relative; z-index: 2;">
        <div class="container">
            <div class="title-area text-center mb-0">
                <div class="banner-breadcrumbs mb-15" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: #a9a9a9;">
                    <a href="index.php" style="color: #ffffff; opacity: 0.7; transition: opacity 0.3s;">Home</a> 
                    <span style="margin: 0 10px; opacity: 0.5;">/</span> 
                    <span style="color: #E0009B; font-weight: 600;">Advanced Threat Detection</span>
                </div>
                
                <h1 class="sec-title text-white mb-3" style="font-size: clamp(2rem, 5vw, 3.2rem); font-weight: 800; background: linear-gradient(135deg, #ffffff 40%, #E0009B 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Advanced Threat Detection</h1>
                <p class="sec-text text-white-50 mx-auto" style="max-width: 700px; font-size: 1.1rem; line-height: 1.6;">
                    Proactively identify and respond to emerging threats, safeguarding your critical assets from potential harm.
                </p>
            </div>
        </div>
    </div>

    <!-- Detail Content -->
    <section class="space-bottom" style="padding: 40px 0 100px; position: relative; z-index: 2;">
        <div class="container">
            <div class="row gy-40">
                <!-- Left: Content Card -->
                <div class="col-lg-8">
                    <div class="detail-content-card">
                        <h2 class="sec-title mb-4" style="font-size: 1.8rem; font-weight: 800;">AI-Powered Heuristics & Adaptive Threat Prevention</h2>
                        <p class="sec-text text-white-50 mb-3" style="font-size: 1.05rem; line-height: 1.75;">
                            Traditional signature-based threat detection is no longer sufficient to stop modern cyber attacks. Advert Resource Ltd deploys next-generation heuristic engine frameworks that monitor behavioral indicators rather than relying solely on static blacklists.
                        </p>
                        <p class="sec-text text-white-50 mb-5" style="font-size: 1.05rem; line-height: 1.75;">
                            By modeling baseline user behavior and system activity across all endpoints, databases, and networks, our platform flags deviations in real-time, shutting down zero-day payloads before they execute.
                        </p>

                        <h3 class="sec-title mb-4" style="font-size: 1.4rem; font-weight: 800;">Deployment Scope</h3>
                        <div class="detail-check-list">
                            <ul>
                                <li class="d-flex align-items-start gap-3">
                                    <div class="detail-check-icon"><i class="fas fa-brain"></i></div>
                                    <div>
                                        <h5 class="text-white mb-1" style="font-size: 1.05rem; font-weight: 700;">AI-Driven Threat Modeling</h5>
                                        <p class="m-0 text-white-50" style="font-size: 0.9rem; line-height: 1.5;">Building predictive threat graphs that isolate execution paths before exploitation.</p>
                                    </div>
                                </li>
                                <li class="d-flex align-items-start gap-3">
                                    <div class="detail-check-icon"><i class="fas fa-microscope"></i></div>
                                    <div>
                                        <h5 class="text-white mb-1" style="font-size: 1.05rem; font-weight: 700;">Next-Gen Endpoint Antivirus (NGAV)</h5>
                                        <p class="m-0 text-white-50" style="font-size: 0.9rem; line-height: 1.5;">Behavioral heuristics blocking lateral movement and credential harvesting.</p>
                                    </div>
                                </li>
                                <li class="d-flex align-items-start gap-3">
                                    <div class="detail-check-icon"><i class="fas fa-shield-virus"></i></div>
                                    <div>
                                        <h5 class="text-white mb-1" style="font-size: 1.05rem; font-weight: 700;">Proactive Sandbox Isolation</h5>
                                        <p class="m-0 text-white-50" style="font-size: 0.9rem; line-height: 1.5;">Detonating suspicious files in isolated virtual environments to identify zero-day threats.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right: Sidebar -->
                <div class="col-lg-4">
                    <div class="detail-sidebar-card text-center">
                        <i class="fas fa-shield-check fa-3x mb-3" style="color: #E0009B; filter: drop-shadow(0 0 10px rgba(224,0,155,0.5));"></i>
                        <h3 class="text-white mb-3" style="font-size: 1.3rem; font-weight: 800; letter-spacing: 0.5px;">ENGAGE THIS CAPABILITY</h3>
                        <p class="text-white-50 mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                            Speak with a deployment architect to integrate this capability into your lifecycle.
                        </p>
                        <a href="contact-us.php" class="ot-btn w-100 justify-content-center" style="min-height: 48px;">
                            Deploy Capability <i class="far fa-long-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="index.php" class="detail-back-link">
                            <i class="far fa-arrow-left"></i> Return Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php include 'footer.php'; ?>
