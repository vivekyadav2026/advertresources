<?php 
$pageTitle = "About Advert Resource Ltd | Advanced Cyber Security Pioneers";
$pageDesc = "Discover how Advert Resource Ltd secures the digital future with next-generation threat intelligence, Zero-Trust architectures, and expert security consulting.";
$pageKeywords = "about Advert Resource Ltd, cyber security experts, zero trust architecture, threat intelligence, cloud security";
include 'header.php'; 
?>

<!-- Scoped Premium Styles for the Redesigned About Us Page -->
<style>
/* CSS Reset & Core Theme Overrides */
.premium-about-page {
    background-color: #000916;
    color: #a9a9a9;
    font-family: "Kumbh Sans", sans-serif;
    overflow-hidden: hidden;
    position: relative;
}

.premium-about-page h1,
.premium-about-page h2,
.premium-about-page h3,
.premium-about-page h4,
.premium-about-page h5,
.premium-about-page h6 {
    color: #ffffff;
    font-weight: 700;
}

/* Background Cyber Mesh & glowing orbs */
.about-cyber-grid {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: 
        linear-gradient(rgba(37, 99, 235, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37, 99, 235, 0.05) 1px, transparent 1px);
    background-size: 50px 50px;
    z-index: 0;
    pointer-events: none;
}

.about-cyber-lines {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: 
      linear-gradient(to right, rgba(96, 165, 250, 0.02) 1px, transparent 1px) 0 0 / 120px 100%,
      linear-gradient(to bottom, rgba(96, 165, 250, 0.02) 1px, transparent 1px) 0 0 / 100% 120px;
    pointer-events: none;
    z-index: 0;
}

.about-glow-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(120px);
    z-index: 0;
    pointer-events: none;
    opacity: 0.45;
}
.about-glow-orb.blue { background: rgba(37, 99, 235, 0.35); width: 500px; height: 500px; top: -100px; left: -100px; }
.about-glow-orb.purple { background: rgba(147, 51, 234, 0.25); width: 600px; height: 600px; top: 30%; right: -200px; }
.about-glow-orb.magenta { background: rgba(224, 0, 155, 0.2); width: 400px; height: 400px; bottom: 10%; left: 10%; }

/* Particles */
.about-particles {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    overflow: hidden;
    pointer-events: none;
    z-index: 1;
}
.about-particle {
    position: absolute;
    background: radial-gradient(circle, rgba(96, 165, 250, 0.3) 0%, rgba(96, 165, 250, 0) 70%);
    border-radius: 50%;
    animation: floatParticle 28s infinite linear;
}
.about-particle.p1 { width: 120px; height: 120px; top: 15%; left: 5%; animation-duration: 22s; }
.about-particle.p2 { width: 200px; height: 200px; top: 45%; right: 3%; animation-duration: 35s; animation-delay: -7s; }
.about-particle.p3 { width: 100px; height: 100px; bottom: 20%; left: 15%; animation-duration: 28s; animation-delay: -14s; }

@keyframes floatParticle {
    0% { transform: translateY(0) scale(1); opacity: 0.3; }
    50% { transform: translateY(-40px) scale(1.1); opacity: 0.6; }
    100% { transform: translateY(0) scale(1); opacity: 0.3; }
}

/* Glassmorphism General Cards */
.about-glass-card {
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    z-index: 1;
}

.about-glass-card:hover {
    border-color: rgba(59, 130, 246, 0.35);
    box-shadow: 0 25px 55px rgba(59, 130, 246, 0.15);
    transform: translateY(-5px);
}

/* Hero Title details */
.about-hero-title {
    font-size: clamp(2rem, 4.5vw, 3rem);
    font-weight: 800;
    line-height: 1.2;
    background: linear-gradient(135deg, #ffffff 40%, #E0009B 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.5px;
}

.about-gradient-text {
    background: linear-gradient(135deg, #60a5fa 30%, #c084fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Active status tag pulse */
.about-status-tag {
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

.about-pulse-dot {
    width: 8px;
    height: 8px;
    background-color: #069845;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 10px #069845;
    animation: activePulse 1.5s infinite;
}

@keyframes activePulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.3); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}

/* CTA Gradient Button */
.btn-premium-grad {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 32px;
    min-height: 52px;
    font-weight: 600;
    font-size: 1rem;
    color: #fff;
    background: linear-gradient(135deg, #3C72FC 0%, #E0009B 100%);
    border: none;
    border-radius: 99px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none !important;
    box-shadow: 0 0 20px rgba(224, 0, 155, 0.3);
}

.btn-premium-grad:hover {
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(224, 0, 155, 0.5);
}

.btn-premium-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 32px;
    min-height: 52px;
    font-weight: 600;
    font-size: 1rem;
    color: #fff;
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 99px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none !important;
}

.btn-premium-outline:hover {
    color: #fff;
    border-color: #3C72FC;
    background: rgba(60, 114, 252, 0.1);
    box-shadow: 0 0 15px rgba(60, 114, 252, 0.2);
}

.about-hero-btns {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.about-hero-governed {
    display: flex;
    align-items: center;
    gap: 15px;
}

@media (max-width: 767px) {
    .about-banner {
        text-align: center !important;
        padding: 60px 0 40px !important;
    }
    .about-banner .text-start {
        text-align: center !important;
    }
    .banner-breadcrumbs {
        justify-content: center;
        display: flex;
    }
    .about-status-tag {
        margin: 0 auto 20px !important;
    }
    .about-hero-title {
        font-size: 2.1rem !important;
        line-height: 1.25 !important;
    }
    .about-hero-btns {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 12px !important;
        max-width: 320px;
        margin: 0 auto 24px !important;
    }
    .about-hero-btns .btn-premium-grad,
    .about-hero-btns .btn-premium-outline {
        width: 100% !important;
        text-align: center;
        justify-content: center;
    }
    .about-hero-governed {
        justify-content: center !important;
        flex-wrap: wrap !important;
    }
}

/* Live Cyber Dashboard */
.cyber-dashboard-card {
    background: rgba(15, 23, 42, 0.7);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
    overflow: hidden;
    font-family: monospace;
}

.cyber-dash-header {
    background: rgba(255, 255, 255, 0.02);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cyber-dash-body {
    padding: 20px;
}

/* SVG Threat Map Animation */
.dash-svg-map {
    width: 100%;
    height: 140px;
    background: rgba(0,0,0,0.2);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 10px;
    margin-bottom: 20px;
}

.threat-pulse {
    animation: threatRadar 2.5s infinite ease-out;
    transform-origin: center;
}

.threat-line {
    stroke-dasharray: 8;
    animation: threatFlow 3s infinite linear;
}

@keyframes threatRadar {
    0% { r: 1px; opacity: 1; }
    100% { r: 18px; opacity: 0; }
}

@keyframes threatFlow {
    to { stroke-dashoffset: -20; }
}

/* Live stats dial */
.dash-progress-circle {
    transform: rotate(-90deg);
}
.dash-progress-bar {
    stroke-dasharray: 251.2;
    stroke-dashoffset: 251.2;
    animation: dialFill 2s forwards ease-in-out;
}

@keyframes dialFill {
    to { stroke-dashoffset: 30; } /* Risk level: 12% (lower score is secure) */
}

/* Redesigned 3D Layered stack */
.layered-3d-wrapper {
    position: relative;
    width: 100%;
    height: 380px;
    display: flex;
    align-items: center;
    justify-content: center;
    perspective: 1000px;
}

.layered-card {
    position: absolute;
    width: 280px;
    height: 180px;
    border-radius: 16px;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    transition: all 0.5s ease;
    transform: rotateY(-20deg) rotateX(15deg);
}

.layered-card.layer1 {
    transform: translateZ(-80px) rotateY(-20deg) rotateX(15deg);
    border-color: rgba(224, 0, 155, 0.15);
    background: rgba(224, 0, 155, 0.03);
}

.layered-card.layer2 {
    transform: translateZ(0px) rotateY(-20deg) rotateX(15deg) translateY(-20px) translateX(20px);
    border-color: rgba(60, 114, 252, 0.2);
}

.layered-card.layer3 {
    transform: translateZ(80px) rotateY(-20deg) rotateX(15deg) translateY(-40px) translateX(40px);
    border-color: rgba(255, 255, 255, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
}

.layered-3d-wrapper:hover .layered-card.layer1 { transform: translateZ(-110px) rotateY(-20deg) rotateX(15deg); }
.layered-3d-wrapper:hover .layered-card.layer2 { transform: translateZ(-10px) rotateY(-20deg) rotateX(15deg) translateY(-20px) translateX(20px); }
.layered-3d-wrapper:hover .layered-card.layer3 { transform: translateZ(90px) rotateY(-20deg) rotateX(15deg) translateY(-40px) translateX(40px); }

/* Floating Badge Indicators */
.floating-badge {
    position: absolute;
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(60, 114, 252, 0.3);
    border-radius: 30px;
    padding: 8px 18px;
    font-size: 0.8rem;
    color: #ffffff;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    animation: floatBadge 4s ease-in-out infinite;
}

.floating-badge.b1 { top: 5%; left: 0%; animation-delay: 0s; }
.floating-badge.b2 { bottom: 10%; left: 10%; animation-delay: -1s; }
.floating-badge.b3 { top: 30%; right: 0%; animation-delay: -2s; }
.floating-badge.b4 { bottom: 40%; left: -10%; animation-delay: -3s; }

@keyframes floatBadge {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
}

/* Animated statistics grid */
.stat-cards-row {
    margin-top: 60px;
    margin-bottom: 60px;
}

.stat-glow-card {
    padding: 30px 20px;
    text-align: center;
    background: rgba(15, 23, 42, 0.45);
    border: 1px solid rgba(255, 255, 255, 0.06);
    border-radius: 18px;
    transition: all 0.4s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
}

.stat-glow-card:hover {
    border-color: rgba(224, 0, 155, 0.3);
    box-shadow: 0 15px 35px rgba(224, 0, 155, 0.15);
    transform: translateY(-5px);
}

.stat-num {
    font-size: 2.8rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 40%, #E0009B 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 8px;
    font-family: 'Space Grotesk', sans-serif;
}

/* Feature capabilities list (6 items) */
.why-features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.feature-glass-card {
    background: rgba(15, 23, 42, 0.5);
    border: 1px solid rgba(59, 130, 246, 0.12);
    border-radius: 20px;
    padding: 35px 25px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.feature-glass-card:hover {
    border-color: rgba(59, 130, 246, 0.4);
    box-shadow: 0 20px 45px rgba(59, 130, 246, 0.15);
    transform: translateY(-5px);
}

.feature-card-icon {
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

.feature-glass-card:hover .feature-card-icon {
    background: rgba(59, 130, 246, 0.2);
    border-color: rgba(59, 130, 246, 0.5);
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    transform: scale(1.05);
}

/* Horizontal process timeline */
.process-timeline-wrapper {
    position: relative;
    padding: 60px 0;
    margin-top: 40px;
}

.process-line-back {
    position: absolute;
    top: 50px; left: 5%; width: 90%; height: 2px;
    background: rgba(255, 255, 255, 0.08);
    z-index: 0;
}

.process-line-progress {
    position: absolute;
    top: 50px; left: 5%; width: 65%; height: 2px;
    background: linear-gradient(to right, #3C72FC, #E0009B);
    z-index: 1;
    box-shadow: 0 0 10px rgba(224, 0, 155, 0.5);
}

.process-timeline-row {
    display: flex;
    justify-content: space-between;
    position: relative;
    z-index: 2;
    flex-wrap: wrap;
    gap: 30px;
}

.process-step-node {
    flex: 1;
    min-width: 140px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.process-step-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #0f172a;
    border: 2px solid rgba(255, 255, 255, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 0.95rem;
    font-weight: 700;
    color: #cbd5e1;
    transition: all 0.3s ease;
}

.process-step-node.active .process-step-circle {
    border-color: #E0009B;
    background: #E0009B;
    color: #ffffff;
    box-shadow: 0 0 15px rgba(224, 0, 155, 0.6);
}

.process-step-node.completed .process-step-circle {
    border-color: #3C72FC;
    background: #3C72FC;
    color: #ffffff;
    box-shadow: 0 0 15px rgba(60, 114, 252, 0.6);
}

@media (max-width: 991px) {
    .process-line-back, .process-line-progress { display: none; }
    .process-timeline-row { flex-direction: column; align-items: flex-start; gap: 40px; padding-left: 20px; border-left: 2px solid rgba(255, 255, 255, 0.08); }
    .process-step-node { flex-direction: row; text-align: left; gap: 20px; align-items: flex-start; }
    .process-step-circle { margin-bottom: 0; }
}

/* FAQ/Accordions override */
.faq-title {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.2rem;
}

/* Animations */
.about-fade-up {
    opacity: 0;
    transform: translateY(20px);
    animation: aboutFadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.about-delay-100 { animation-delay: 100ms; }
.about-delay-200 { animation-delay: 200ms; }
.about-delay-300 { animation-delay: 300ms; }

@keyframes aboutFadeUp {
    to { opacity: 1; transform: translateY(0); }
}
</style>

<!-- Main Scope Container -->
<div class="premium-about-page">
    
    <!-- Background elements -->
    <div class="about-cyber-grid"></div>
    <div class="about-cyber-lines"></div>
    <div class="about-particles">
        <div class="about-particle p1"></div>
        <div class="about-particle p2"></div>
        <div class="about-particle p3"></div>
    </div>
    <div class="about-glow-orb blue"></div>
    <div class="about-glow-orb purple"></div>
    <div class="about-glow-orb magenta"></div>

    <!-- 1. OVERHAULED HERO SECTION -->
    <section class="about-banner" style="padding: 60px 0 80px; position: relative;">
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row align-items-center gy-50">
                <!-- Left: Content Column -->
                <div class="col-lg-7 text-start about-fade-up">
                    <div class="banner-breadcrumbs mb-15" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: #a9a9a9;">
                        <a href="index.php" style="color: #ffffff; opacity: 0.7; transition: opacity 0.3s;">Home</a> 
                        <span style="margin: 0 10px; opacity: 0.5;">/</span> 
                        <span style="color: #E0009B; font-weight: 600;">About Us</span>
                    </div>
                    
                    <span class="about-status-tag mb-4">
                        <span class="about-pulse-dot"></span>
                        SECURE CORE ACTIVE
                    </span>
                    
                    <h1 class="about-hero-title mb-4">
                        Our Corporate Identity & <span class="about-gradient-text">Zero-Trust Mandate</span>
                    </h1>
                    
                    <p class="sec-text text-white-50 mb-4" style="font-size: 1.15rem; line-height: 1.7; opacity: 0.85;">
                        Based in London, Advert Resource Ltd architects military-grade cybersecurity perimeters for global enterprises. We protect complex enterprise assets by enforcing constant verification and threat eviction.
                    </p>
                    
                    <div class="about-hero-btns mb-4">
                        <a href="services.php" class="btn-premium-grad">
                            Explore Capabilities <i class="far fa-long-arrow-right ms-2"></i>
                        </a>
                        <a href="contact-us.php" class="btn-premium-outline">
                            Connect Command
                        </a>
                    </div>
                    
                    <!-- Trust indicators -->
                    <!-- <div class="about-hero-governed pt-3" style="border-top: 1px solid rgba(255,255,255,0.06);">
                        <span style="font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,0.4);">Aligned With:</span>
                        <div class="d-flex align-items-center gap-2 text-white" style="font-size: 0.85rem; font-weight: 700;">
                            <i class="fas fa-lock" style="color: #E0009B;"></i> ISO 27001 Framework
                        </div>
                    </div> -->
                </div>

                <!-- Right: Large Live Cyber Dashboard -->
                <div class="col-lg-5 about-fade-up about-delay-100">
                    <div class="cyber-dashboard-card">
                        <div class="cyber-dash-header">
                            <div class="d-flex gap-2">
                                <span style="width: 8px; height: 8px; background-color: #ff5f56; border-radius: 50%;"></span>
                                <span style="width: 8px; height: 8px; background-color: #ffbd2e; border-radius: 50%;"></span>
                                <span style="width: 8px; height: 8px; background-color: #27c93f; border-radius: 50%;"></span>
                            </div>
                            <span style="color: #60a5fa; font-size: 0.75rem; letter-spacing: 1.5px;">MONITOR // UK-LDN-01</span>
                        </div>
                        <div class="cyber-dash-body">
                            <!-- Visual threat map block -->
                            <svg class="dash-svg-map" viewBox="0 0 100 50">
                                <circle cx="20" cy="20" r="1.5" fill="#3C72FC"/>
                                <circle cx="50" cy="15" r="1.5" fill="#3C72FC"/>
                                <circle cx="80" cy="35" r="1.5" fill="#3C72FC"/>
                                
                                <path d="M 20 20 Q 50 5 80 35" fill="none" stroke="rgba(224, 0, 155, 0.4)" stroke-width="0.5" class="threat-line"/>
                                <circle cx="80" cy="35" r="4" fill="none" stroke="#E0009B" stroke-width="0.5" class="threat-pulse"/>
                            </svg>
                            
                            <!-- Risk Dial & Protection status grid -->
                            <div class="row align-items-center mb-3">
                                <div class="col-6 d-flex align-items-center gap-3">
                                    <svg width="60" height="60" viewBox="0 0 100 100" class="dash-progress-circle">
                                        <circle cx="50" cy="50" r="40" stroke="rgba(255,255,255,0.05)" stroke-width="8" fill="transparent" />
                                        <circle cx="50" cy="50" r="40" stroke="#069845" stroke-width="8" fill="transparent" class="dash-progress-bar" />
                                        <text x="50" y="55" font-size="16" fill="#fff" text-anchor="middle" font-weight="bold" transform="rotate(90 50 50)">12%</text>
                                    </svg>
                                    <div>
                                        <div style="font-size: 0.75rem; color: #a9a9a9;">Risk Index</div>
                                        <div style="font-size: 0.85rem; font-weight: 700; color: #069845;">V. Low</div>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <div style="font-size: 0.75rem; color: #a9a9a9;">Firewall</div>
                                    <div style="font-size: 0.85rem; font-weight: 700; color: #069845;"><i class="fas fa-check-circle"></i> ACTIVE</div>
                                </div>
                            </div>
                            
                            <!-- Logs terminal feed -->
                            <div id="about-telemetry" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px; padding: 12px; height: 120px; overflow-y: auto; font-size: 0.75rem; line-height: 1.5; color: #60a5fa; text-align: left;">
                                <div><span style="color: #666;">[00:09:40]</span> System monitoring active.</div>
                                <div><span style="color: #666;">[00:09:42]</span> Zero-Trust handshake completed.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. REDESIGNED ABOUT SECTION -->
    <section class="about-sec2 position-relative overflow-hidden space" id="about-sec" style="padding: 100px 0; border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="container">
            <div class="row gy-50 align-items-center">
                <!-- Left: Layered 3D Illustration -->
                <div class="col-lg-6 about-fade-up">
                    <div class="layered-3d-wrapper">
                        <!-- Layer 1: background grid block -->
                        <div class="layered-card layer1"></div>
                        <!-- Layer 2: Node lines design -->
                        <div class="layered-card layer2" style="display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-network-wired fa-3x" style="color: rgba(60, 114, 252, 0.4);"></i>
                        </div>
                        <!-- Layer 3: Main shield orb -->
                        <div class="layered-card layer3">
                            <i class="fas fa-shield-alt fa-4x" style="color: #E0009B; filter: drop-shadow(0 0 20px rgba(224,0,155,0.5));"></i>
                        </div>
                        
                        <!-- Floating certifications -->
                        <div class="floating-badge b1"><i class="fas fa-check-circle text-success"></i> ISO 27001 Aligned</div>
                        <div class="floating-badge b2"><i class="fas fa-lock text-primary"></i> Zero Trust</div>
                        <div class="floating-badge b3"><i class="fas fa-eye text-warning"></i> 24/7 SOC</div>
                        <div class="floating-badge b4"><i class="fas fa-brain text-info"></i> AI Defense</div>
                    </div>
                </div>

                <!-- Right: Content Directive -->
                <div class="col-lg-6 about-fade-up about-delay-100">
                    <div class="about-wrap2">
                        <div class="title-area mb-25">
                            <span class="sub-title style2" style="font-size: 0.85rem; letter-spacing: 2px; color: #E0009B;">Our Directive</span>
                            <h2 class="sec-title text-white mt-2 mb-3" style="font-size: 2.3rem; font-weight: 800; line-height: 1.25;">
                                The Paradigm of Absolute Defense
                            </h2>
                            <p class="sec-text text-white-50 mb-3" style="font-size: 1.05rem; line-height: 1.75;">
                                In an era defined by sophisticated advanced persistent threats (APTs) and state-sponsored cyber espionage, legacy security perimeters are obsolete. Advert Resource Ltd was founded in London to engineer zero-trust architecture that operates on the assumption of constant breach.
                            </p>
                            <p class="sec-text text-white-50 mb-4" style="font-size: 1.05rem; line-height: 1.75;">
                                Our methodology shifts defensive paradigms from reactive patching to proactive neutralization. By combining deep packet inspection, heuristics, and dedicated Red Team modeling, we dismantle threats before they execute payload.
                            </p>
                        </div>
                        <div class="check-list style-grid mb-4">
                            <ul class="row gy-2 list-unstyled p-0 m-0">
                                <li class="col-sm-6 text-white" style="font-weight: 600;"><i class="fas fa-check-circle text-success me-2"></i> 24/7 Active SOC</li>
                                <li class="col-sm-6 text-white" style="font-weight: 600;"><i class="fas fa-check-circle text-success me-2"></i> ISO 27001 Aligned</li>
                                <li class="col-sm-6 text-white" style="font-weight: 600;"><i class="fas fa-check-circle text-success me-2"></i> Zero-Trust Architecture</li>
                                <li class="col-sm-6 text-white" style="font-weight: 600;"><i class="fas fa-check-circle text-success me-2"></i> Red Team Modeling</li>
                            </ul>
                        </div>
                        <div class="btn-wrap mt-35 d-flex align-items-center gap-4 flex-wrap">
                            <a href="contact-us.php" class="btn-premium-grad">Contact Command <i class="far fa-long-arrow-right ms-2"></i></a>
                            <div class="about-profile d-flex align-items-center gap-3">
                                <div class="avater" style="width: 44px; height: 44px; border-radius: 50%; overflow: hidden; border: 1px solid rgba(255,255,255,0.2);">
                                    <img src="./index/about-profile1-1.png" alt="avatar" class="w-100 h-100" />
                                </div>
                                <div class="media-body">
                                    <h6 class="about-profile-name text-white m-0" style="font-size: 0.95rem; font-weight: 700;">Advert Resource Ltd</h6>
                                    <p class="desig m-0" style="font-size: 0.75rem; color: #a9a9a9;">London, United Kingdom</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. ADDED COMPANY STATS SECTION -->
    <section class="space-bottom" style="padding: 60px 0; border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="container">
            <div class="row gy-30 justify-content-center">
                <div class="col-lg col-md-4 col-sm-6">
                    <div class="stat-glow-card">
                        <div class="stat-num">20+</div>
                        <div class="stat-label" style="font-size: 0.85rem; letter-spacing: 1px; color: #a9a9a9;">Years Experience</div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-6">
                    <div class="stat-glow-card">
                        <div class="stat-num">500+</div>
                        <div class="stat-label" style="font-size: 0.85rem; letter-spacing: 1px; color: #a9a9a9;">Enterprise Clients</div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-6">
                    <div class="stat-glow-card">
                        <div class="stat-num">99.99%</div>
                        <div class="stat-label" style="font-size: 0.85rem; letter-spacing: 1px; color: #a9a9a9;">Threat Detection</div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-6">
                    <div class="stat-glow-card">
                        <div class="stat-num">40+</div>
                        <div class="stat-label" style="font-size: 0.85rem; letter-spacing: 1px; color: #a9a9a9;">Countries Served</div>
                    </div>
                </div>
                <div class="col-lg col-md-4 col-sm-6">
                    <div class="stat-glow-card">
                        <div class="stat-num">24/7</div>
                        <div class="stat-label" style="font-size: 0.85rem; letter-spacing: 1px; color: #a9a9a9;">SOC Monitoring</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. WHY CHOOSE US FEATURE CARDS -->
    <section class="space" style="padding: 100px 0; border-top: 1px solid rgba(255,255,255,0.05); background: rgba(15, 23, 42, 0.2);">
        <div class="container">
            <div class="title-area text-center mb-50">
                <span class="sub-title style2" style="font-size: 0.85rem; letter-spacing: 2px; color: #E0009B;">Why Choose Us</span>
                <h2 class="sec-title text-white mt-2" style="font-size: 2.3rem; font-weight: 800;">Elite Defensive Architecture</h2>
            </div>
            
            <div class="why-features-grid">
                <div class="feature-glass-card">
                    <div class="feature-card-icon"><i class="fas fa-shield-alt"></i></div>
                    <h4 class="text-white mb-2">Zero Trust Architecture</h4>
                    <p class="m-0" style="font-size: 0.9rem; line-height: 1.6;">Continuous authorization and strict validation protocol applied across every node, asset, and request.</p>
                </div>
                <div class="feature-glass-card">
                    <div class="feature-card-icon"><i class="fas fa-brain"></i></div>
                    <h4 class="text-white mb-2">AI Threat Intelligence</h4>
                    <p class="m-0" style="font-size: 0.9rem; line-height: 1.6;">Integrated machine learning algorithms capable of predicting, classifying, and isolating mutating malware vectors.</p>
                </div>
                <div class="feature-glass-card">
                    <div class="feature-card-icon"><i class="fas fa-cloud"></i></div>
                    <h4 class="text-white mb-2">Cloud Security</h4>
                    <p class="m-0" style="font-size: 0.9rem; line-height: 1.6;">Safeguarding Kubernetes instances, container workflows, and distributed APIs in hybrid cloud structures.</p>
                </div>
                <div class="feature-glass-card">
                    <div class="feature-card-icon"><i class="fas fa-user-shield"></i></div>
                    <h4 class="text-white mb-2">Managed SOC (24/7)</h4>
                    <p class="m-0" style="font-size: 0.9rem; line-height: 1.6;">Elite cyber analysts governing alert triage, network telemetry monitoring, and patch remediation.</p>
                </div>
                <div class="feature-glass-card">
                    <div class="feature-card-icon"><i class="fas fa-ambulance"></i></div>
                    <h4 class="text-white mb-2">Incident Response</h4>
                    <p class="m-0" style="font-size: 0.9rem; line-height: 1.6;">Rapid isolation protocol triggered within 15 minutes of an incident declaration to secure systems.</p>
                </div>
                <div class="feature-glass-card">
                    <div class="feature-card-icon"><i class="fas fa-file-contract"></i></div>
                    <h4 class="text-white mb-2">Compliance Solutions</h4>
                    <p class="m-0" style="font-size: 0.9rem; line-height: 1.6;">Audit-ready engineering architectures complying with ISO 27001, GDPR, HIPAA, and NIST CSF.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. MISSION & VISION SECTION -->
    <section class="space" style="padding: 80px 0; border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="about-glass-card" style="padding: 40px; border-left: 4px solid #3C72FC;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <i class="fas fa-bullseye fa-2x" style="color: #3C72FC;"></i>
                            <h3 class="m-0" style="font-size: 1.5rem;">Our Mission</h3>
                        </div>
                        <p class="m-0 text-white-50" style="font-size: 1rem; line-height: 1.7;">
                            To engineer unbreachable digital perimeters. We are committed to shifting defensive paradigms from reactive patching to proactive, AI-driven neutralization, ensuring absolute data sovereignty for global leaders.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-glass-card" style="padding: 40px; border-left: 4px solid #E0009B;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <i class="fas fa-eye fa-2x" style="color: #E0009B;"></i>
                            <h3 class="m-0" style="font-size: 1.5rem;">Our Vision</h3>
                        </div>
                        <p class="m-0 text-white-50" style="font-size: 1rem; line-height: 1.7;">
                            To define the next generation of zero-trust architecture. We visualize a secure web ecosystem where enterprise networks, remote workflows, and global transactions run autonomously and shielded from hostile entities.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. OUR PROCESS TIMELINE -->
    <section class="space" style="padding: 100px 0; border-top: 1px solid rgba(255,255,255,0.05); background: rgba(15, 23, 42, 0.2);">
        <div class="container">
            <div class="title-area text-center mb-50">
                <span class="sub-title style2" style="font-size: 0.85rem; letter-spacing: 2px; color: #E0009B;">Our Methodology</span>
                <h2 class="sec-title text-white mt-2" style="font-size: 2.3rem; font-weight: 800;">Defense Implementation Pipeline</h2>
            </div>
            
            <div class="process-timeline-wrapper">
                <div class="process-line-back"></div>
                <div class="process-line-progress"></div>
                
                <div class="process-timeline-row">
                    <div class="process-step-node completed">
                        <div class="process-step-circle"><i class="fas fa-search"></i></div>
                        <h5 class="text-white mb-2" style="font-size: 1rem;">Assessment</h5>
                        <p class="m-0 text-white-50" style="font-size: 0.8rem; max-width: 160px; margin: 0 auto; line-height: 1.4;">Infrastructure mapping & threat vector scanning.</p>
                    </div>
                    <div class="process-step-node completed">
                        <div class="process-step-circle"><i class="fas fa-chess"></i></div>
                        <h5 class="text-white mb-2" style="font-size: 1rem;">Planning</h5>
                        <p class="m-0 text-white-50" style="font-size: 0.8rem; max-width: 160px; margin: 0 auto; line-height: 1.4;">Zero-Trust policies design & sandbox blueprinting.</p>
                    </div>
                    <div class="process-step-node completed">
                        <div class="process-step-circle"><i class="fas fa-lock"></i></div>
                        <h5 class="text-white mb-2" style="font-size: 1rem;">Protection</h5>
                        <p class="m-0 text-white-50" style="font-size: 0.8rem; max-width: 160px; margin: 0 auto; line-height: 1.4;">Perimeter locking, data encryption & API hardening.</p>
                    </div>
                    <div class="process-step-node active">
                        <div class="process-step-circle"><i class="fas fa-broadcast-tower"></i></div>
                        <h5 class="text-white mb-2" style="font-size: 1rem;">Monitoring</h5>
                        <p class="m-0 text-white-50" style="font-size: 0.8rem; max-width: 160px; margin: 0 auto; line-height: 1.4;">24/7 SIEM ingestion & heuristic analysis.</p>
                    </div>
                    <div class="process-step-node">
                        <div class="process-step-circle"><i class="fas fa-bolt"></i></div>
                        <h5 class="text-white mb-2" style="font-size: 1rem;">Response</h5>
                        <p class="m-0 text-white-50" style="font-size: 0.8rem; max-width: 160px; margin: 0 auto; line-height: 1.4;">Automated playbooks isolation & incident triage.</p>
                    </div>
                    <div class="process-step-node">
                        <div class="process-step-circle"><i class="fas fa-sync-alt"></i></div>
                        <h5 class="text-white mb-2" style="font-size: 1rem;">Recovery</h5>
                        <p class="m-0 text-white-50" style="font-size: 0.8rem; max-width: 160px; margin: 0 auto; line-height: 1.4;">Clean system restoral & security post-mortems.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. CLIENT TRUST SECTION -->
    <section class="space" style="padding: 60px 0; border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="container text-center">
            <h3 style="font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 40px;">COMPLIANCE & ENTERPRISE TRUST</h3>
            <div class="row align-items-center justify-content-center gy-30 gx-50">
                <div class="col-6 col-md-3 col-lg-2">
                    <div style="font-weight: 700; color: rgba(255,255,255,0.25); font-size: 1rem; border: 1px solid rgba(255,255,255,0.05); padding: 15px; border-radius: 8px;">ISO 27001</div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div style="font-weight: 700; color: rgba(255,255,255,0.25); font-size: 1rem; border: 1px solid rgba(255,255,255,0.05); padding: 15px; border-radius: 8px;">SOC 2 TYPE II</div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div style="font-weight: 700; color: rgba(255,255,255,0.25); font-size: 1rem; border: 1px solid rgba(255,255,255,0.05); padding: 15px; border-radius: 8px;">NIST CSF</div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div style="font-weight: 700; color: rgba(255,255,255,0.25); font-size: 1rem; border: 1px solid rgba(255,255,255,0.05); padding: 15px; border-radius: 8px;">GDPR COMPLIANT</div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div style="font-weight: 700; color: rgba(255,255,255,0.25); font-size: 1rem; border: 1px solid rgba(255,255,255,0.05); padding: 15px; border-radius: 8px;">HIPAA SOC</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. PREMIUM CTA SECTION -->
    <section class="space-bottom" style="padding: 100px 0; border-top: 1px solid rgba(255,255,255,0.05); background: linear-gradient(180deg, transparent, rgba(224, 0, 155, 0.03));">
        <div class="container text-center">
            <div class="about-glass-card" style="padding: 60px 40px; max-width: 800px; margin: 0 auto; border: 1px solid rgba(224,0,155,0.2); box-shadow: 0 0 35px rgba(224,0,155,0.1);">
                <i class="fas fa-lock fa-3x mb-3" style="color: #E0009B; filter: drop-shadow(0 0 10px rgba(224,0,155,0.5));"></i>
                <h2 class="text-white mb-3" style="font-size: 2.3rem; font-weight: 800;">Deploy Proactive Architecture</h2>
                <p class="text-white-50 mb-4" style="max-width: 600px; margin: 0 auto 30px; font-size: 1.05rem; line-height: 1.6;">
                    Discuss how zero-trust perimeters and 24/7 SOC integration can secure your company's critical networks. Connect with our command specialists.
                </p>
                <a href="contact-us.php" class="btn-premium-grad">
                    Engage Cyber Command <i class="far fa-long-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

</div>

<script src="./index/wave.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const term = document.getElementById('about-telemetry');
    if(term) {
        const events = [
            { txt: "System initialized. Binding to port 443...", clr: "#3C72FC" },
            { txt: "London node UK-LDN-01 connection established.", clr: "#069845" },
            { txt: "TLS 1.3 protocol Handshake completed.", clr: "#069845" },
            { txt: "Ingesting global threat indicators...", clr: "#3C72FC" },
            { txt: "CVE check: scanning system vulnerabilities...", clr: "#FC800A" },
            { txt: "Zero-day heuristics loaded successfully.", clr: "#069845" },
            { txt: "ALERT: Brute force vector isolated on IP 192.168.1.104", clr: "#E0009B" },
            { txt: "Securing entry points. Deploying virtual sandbox.", clr: "#3C72FC" },
            { txt: "Threat neutralized. Audit logs compiled.", clr: "#069845" },
            { txt: "Node integrity: 100% operational.", clr: "#069845" }
        ];
        let idx = 0;
        function pushLog() {
            if(idx >= events.length) idx = 0;
            const log = events[idx];
            const time = new Date().toTimeString().split(' ')[0];
            const p = document.createElement('div');
            p.style.marginBottom = "8px";
            p.innerHTML = `<span style="color: #666;">[${time}]</span> <span style="color: ${log.clr};">${log.txt}</span>`;
            term.appendChild(p);
            term.scrollTop = term.scrollHeight;
            if(term.children.length > 5) term.removeChild(term.firstChild);
            idx++;
            setTimeout(pushLog, Math.random() * 2000 + 1000);
        }
        pushLog();
    }
});
</script>

<?php include 'footer.php'; ?>
