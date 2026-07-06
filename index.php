<?php 
$pageTitle = "Advert Resource Ltd | Cyber Security & Managed IT Services";
$pageDesc = "Advert Resource Ltd provides elite cyber security consulting, advanced threat detection, managed SOC, and compliance architecture to protect high-risk digital assets.";
$pageKeywords = "cyber security, managed IT services, SOC, zero trust, threat detection, Advert Resource Ltd, London cyber security";
$form_sent = isset($_GET['msg']) && $_GET['msg'] === 'sent';
include 'header.php'; 
?>
<?php if ($form_sent): ?>
<style>
.footer-toast {
    position: fixed; top: 80px; right: 20px; z-index: 99999;
    background: rgba(16,185,129,0.15);
    border: 1px solid rgba(16,185,129,0.4);
    border-radius: 14px;
    padding: 18px 28px;
    display: flex; align-items: center; gap: 14px;
    color: #10b981; font-weight: 700; font-size: 0.95rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    backdrop-filter: blur(10px);
    animation: toastIn 0.4s ease;
    max-width: 360px;
}
@keyframes toastIn {
    from { transform: translateX(120%); opacity: 0; }
    to   { transform: translateX(0);    opacity: 1; }
}
.footer-toast i { font-size: 1.4rem; }
</style>
<div class="footer-toast" id="successToast">
    <i class="fas fa-check-circle"></i>
    <span>Message sent! We'll get back to you soon.</span>
    <button onclick="document.getElementById('successToast').remove()" style="background:none;border:none;color:#10b981;font-size:1.2rem;cursor:pointer;margin-left:auto;"><i class="fas fa-times"></i></button>
</div>
<script>setTimeout(()=>{ const t=document.getElementById('successToast'); if(t) t.style.animation='toastIn 0.4s ease reverse'; setTimeout(()=>{ if(t) t.remove(); },400); }, 5000);</script>
<?php endif; ?>

    <div class="ot-hero-wrapper hero-2" id="hero2">
      <div class="waves">
        <canvas
          width="1896"
          height="1394"
          style="width: 1405px; height: 1033px"
        ></canvas>
      </div>
      <div class="hero-bg-line1">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line d-sm-block d-none"></div>
        <div class="line d-sm-block d-none"></div>
        <div class="line d-sm-block d-none"></div>
        <div class="line d-sm-block d-none"></div>
        <div class="line d-sm-block d-none"></div>
      </div>
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-12">
            <div class="hero-style2">
              <h1 class="hero-title">
                <span
                  class="title1"
                  data-cue="slideInUp"
                  data-delay="100"
                  data-show="true"
                  style="
                    animation-name: slideInUp;
                    animation-duration: 900ms;
                    animation-timing-function: ease;
                    animation-delay: 100ms;
                    animation-direction: normal;
                    animation-fill-mode: both;
                  "
                  >Securing Your Digital World,</span
                >
                <span
                  class="title2"
                  data-cue="slideInUp"
                  data-delay="200"
                  data-show="true"
                  style="
                    animation-name: slideInUp;
                    animation-duration: 900ms;
                    animation-timing-function: ease;
                    animation-delay: 200ms;
                    animation-direction: normal;
                    animation-fill-mode: both;
                  "
                  >One Click at a Time</span
                >
              </h1>
              <p
                class="hero-text"
                data-cue="slideInUp"
                data-delay="300"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 300ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                Advert Resource Ltd is an innovative cybersecurity startup securing digital landscapes. Our next-generation cloud
                security solutions protect your data and applications from emerging zero-day
                threats. Fortify your future with Advert Resource Ltd.
              </p>
              <div
                class="btn-wrap justify-content-center"
                data-cue="slideInUp"
                data-delay="200"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 200ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                <a href="contact-us.php" class="ot-btn"
                  >Learn More <i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./index/wave.js"></script>
    <section class="feature-area-1 position-relative z-index-common">
      <div class="container">
        <div class="row gy-30">
          <div
            class="col-lg-4"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <style>
            .feature-card-link {
                text-decoration: none;
                display: block;
                height: 100%;
            }
            .feature-card-link:hover .feature-card {
                transform: translateY(-5px);
                border-color: rgba(60, 114, 252, 0.3) !important;
                box-shadow: 0 10px 25px rgba(60, 114, 252, 0.15) !important;
            }
            </style>
            <a href="advanced-threat-detection.php" class="feature-card-link">
              <div class="feature-card h-100" style="transition: all 0.3s ease;">
                <div class="box-icon">
                  <img src="./index/feature-icon1-1.svg" alt="icon" />
                </div>
                <h3 class="box-title text-white">Advanced Threat Detection</h3>
                <p class="box-text text-white-50">
                  Proactively identify and respond to emerging threats,
                  safeguarding your critical assets from potential harm.
                </p>
              </div>
            </a>
          </div>
          <div
            class="col-lg-4"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 270ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <a href="robust-data-protection.php" class="feature-card-link">
              <div class="feature-card h-100" style="transition: all 0.3s ease;">
                <div class="box-icon">
                  <img src="./index/feature-icon1-2.svg" alt="icon" />
                </div>
                <h3 class="box-title text-white">Robust Data Protection</h3>
                <p class="box-text text-white-50">
                  Safeguard your sensitive data with robust encryption, secure
                  access controls, and data loss prevention measures.
                </p>
              </div>
            </a>
          </div>
          <div
            class="col-lg-4"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 540ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <a href="security-monitoring.php" class="feature-card-link">
              <div class="feature-card h-100" style="transition: all 0.3s ease;">
                <div class="box-icon">
                  <img src="./index/feature-icon1-3.svg" alt="icon" />
                </div>
                <h3 class="box-title text-white">24/7 Security Monitoring</h3>
                <p class="box-text text-white-50">
                  Our team of security experts monitors your environment around
                  the clock, detecting and responding to threats in real-time.
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <div
      class="about-sec2 position-relative overflow-hidden space shape-mockup-wrap"
      id="about-sec"
    >
      <div
        class="shape-mockup bg-gradient-shape1"
        style="inset: auto 0px 0px auto"
      ></div>
      <div class="container">
        <div class="row gy-40">
          <div class="col-xl-6">
            <div
              class="img-box2"
              data-cue="slideInLeft"
              data-show="true"
              style="
                animation-name: slideInLeft;
                animation-duration: 900ms;
                animation-timing-function: ease;
                animation-delay: 0ms;
                animation-direction: normal;
                animation-fill-mode: both;
              "
            >
              <div class="img1">
                <div class="img-box2-shape1"></div>
                <img src="./index/about2-1.png" alt="About" />
              </div>
              <div class="about-experience-wrap jump">
                <div class="box-icon">
                  <img src="./index/about-icon2-1.svg" alt="icon" />
                </div>
                <div class="about-counter-wrap">Next-Gen Security Experts</div>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="about-wrap2">
              <div class="title-area mb-25">
                <span
                  class="sub-title style2"
                  data-cue="slideInUp"
                  data-show="true"
                  style="
                    animation-name: slideInUp;
                    animation-duration: 900ms;
                    animation-timing-function: ease;
                    animation-delay: 0ms;
                    animation-direction: normal;
                    animation-fill-mode: both;
                  "
                  >About Our Company</span
                >
                <h2
                  class="sec-title"
                  data-cue="slideInUp"
                  data-delay="100"
                  data-show="true"
                  style="
                    animation-name: slideInUp;
                    animation-duration: 900ms;
                    animation-timing-function: ease;
                    animation-delay: 100ms;
                    animation-direction: normal;
                    animation-fill-mode: both;
                  "
                >
                  Innovation at the Core Driving the Future of Security
                </h2>
                <p
                  class="sec-text"
                  data-cue="slideInUp"
                  data-delay="200"
                  data-show="true"
                  style="
                    animation-name: slideInUp;
                    animation-duration: 900ms;
                    animation-timing-function: ease;
                    animation-delay: 200ms;
                    animation-direction: normal;
                    animation-fill-mode: both;
                  "
                >
                  Advert Resource Ltd is a pioneering cybersecurity firm dedicated to
                  safeguarding your digital assets. With bleeding-edge next-generation technology,
                  we've been at the forefront of innovation, providing comprehensive network protection..
                </p>
              </div>
              <div
                class="check-list style-grid"
                data-cue="slideInUp"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 0ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                <ul>
                  <li>
                    <i class="fas fa-check-circle"></i> Expert Cybersecurity
                    Consulting
                  </li>
                  <li>
                    <i class="fas fa-check-circle"></i> Vulnerability Assessment
                  </li>
                  <li>
                    <i class="fas fa-check-circle"></i> Advanced Threat
                    Detection
                  </li>
                  <li>
                    <i class="fas fa-check-circle"></i> Incident Response and
                    Recovery
                  </li>
                  <li>
                    <i class="fas fa-check-circle"></i> Data Privacy and
                    Compliance
                  </li>
                  <li>
                    <i class="fas fa-check-circle"></i> Customized Security
                    Solutions
                  </li>
                </ul>
              </div>
              <div
                class="btn-wrap mt-35"
                data-cue="slideInUp"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 0ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                <a href="about-us.php" class="ot-btn"
                  >More About Us<i class="far fa-long-arrow-right ms-2"></i
                ></a>
                <!-- <div class="about-profile">
                  <div class="avater">
                    <img src="./index/about-profile1-1.png" alt="avater" />
                  </div>
             
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section
      class="bg-top-center bg-smoke space overflow-hidden background-image"
      id="service-sec"
      style="
        background-image: url(&quot;assets/img/bg/bg-wave-shape1.png&quot;);
      "
    >
      <!-- Mobile Layout & Click Override Styles -->
      <style>
      @media (max-width: 991px) {
          #service-sec {
              background: #000916 !important;
              padding: 60px 0 !important;
          }
          #service-sec .service-list-wrap {
              margin-bottom: 20px;
          }
          #service-sec .service-list {
              display: block !important;
              background: rgba(15, 23, 42, 0.55) !important;
              border: 1px solid rgba(255, 255, 255, 0.08) !important;
              border-radius: 16px !important;
              padding: 24px !important;
              margin: 0 !important;
              text-align: left !important;
              position: relative !important;
              box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
          }
          #service-sec .service-list .box-img {
              display: none !important; /* Hide massive images on mobile for a clean layout */
          }
          #service-sec .service-list .box-number {
              font-size: 1.1rem !important;
              color: #E0009B !important;
              font-weight: 700 !important;
              margin-bottom: 10px !important;
              display: inline-block !important;
              order: unset !important;
          }
          #service-sec .service-list .box-content {
              max-width: 100% !important;
              margin: 0 0 15px 0 !important;
              order: unset !important;
          }
          #service-sec .service-list .box-title {
              font-size: 1.3rem !important;
              font-weight: 800 !important;
              margin-bottom: 10px !important;
              line-height: 1.3 !important;
          }
          #service-sec .service-list .box-title a {
              color: #ffffff !important;
              text-decoration: none !important;
          }
          #service-sec .service-list .box-text {
              font-size: 0.95rem !important;
              line-height: 1.6 !important;
              color: #a9a9a9 !important;
              margin: 0 !important;
          }
          #service-sec .service-list .btn-wrap {
              display: block !important;
              margin-top: 15px !important;
              text-align: left !important;
              order: unset !important;
              align-self: unset !important;
          }
          #service-sec .service-list .btn-wrap .ot-btn {
              width: auto !important;
              display: inline-flex !important;
              padding: 10px 20px !important;
              font-size: 0.85rem !important;
              min-height: auto !important;
              background: linear-gradient(135deg, #3C72FC 0%, #E0009B 100%) !important;
              border: none !important;
              color: #ffffff !important;
              -webkit-background-clip: border-box !important;
              -webkit-text-fill-color: #ffffff !important;
              border-radius: 30px !important;
          }
      }
      </style>
      <div class="container">
        <div class="title-area text-center">
          <span
            class="sub-title style2"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
            >What We Offer</span
          >
          <h2
            class="sec-title"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            All-In-One Cyber Security Services
          </h2>
        </div>
        <div class="row justify-content-center">
          <!-- 01: CSPM -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">01</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-cloud-posture.php"
                    >Cloud Security Posture Management</a
                  >
                </h3>
                <p class="box-text">
                  Continuously assess your cloud environments for misconfigurations, vulnerabilities, and compliance drifts.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-1.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-cloud-posture.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 02: CWPP -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">02</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-workload-protection.php"
                    >Cloud Workload Protection Platform</a
                  >
                </h3>
                <p class="box-text">
                  Safeguard your cloud-based workloads, containers, and serverless architectures from advanced runtime threat vectors.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-2.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-workload-protection.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 03: CASB -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">03</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-access-broker.php"
                    >Cloud Access Security Broker</a
                  >
                </h3>
                <p class="box-text">
                  Enforce secure data sovereignty policies across SaaS cloud infrastructure through real-time inspection.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-3.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-access-broker.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 04: EDR -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">04</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-endpoint-response.php"
                    >Endpoint Detection and Response</a
                  >
                </h3>
                <p class="box-text">
                  Detect, isolate, and evict advanced malware, ransomware, and fileless exploits targeting corporate endpoint systems.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-4.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-endpoint-response.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 05: App Sec -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">05</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-application-security.php"
                    >Application Security Assessment</a
                  >
                </h3>
                <p class="box-text">
                  Audit source code repositories, secure active API endpoints, and mitigate runtime logic vulnerabilities.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-1.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-application-security.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 06: Net Sec -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">06</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-network-security.php"
                    >Network & Perimeter Security</a
                  >
                </h3>
                <p class="box-text">
                  Deploy edge firewalls, configure intrusion prevention systems, and orchestrate encrypted VPN tunnels.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-2.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-network-security.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 07: Red Team -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">07</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-red-team.php"
                    >Red Team Operations & Pentesting</a
                  >
                </h3>
                <p class="box-text">
                  Simulate adversary tactics, run automated compromise scripts, and test physical security perimeters.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-3.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-red-team.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 08: Compliance -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">08</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-compliance-and-data-privacy.php"
                    >Regulatory Compliance & Privacy</a
                  >
                </h3>
                <p class="box-text">
                  Establish ISMS systems for ISO 27001, model security standards for NIST, and enforce GDPR compliance.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-4.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-compliance-and-data-privacy.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 09: Forensics -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">09</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-digital-forensics.php"
                    >Digital Forensics & Incident Response</a
                  >
                </h3>
                <p class="box-text">
                  Contain active network ransomware incursions, rebuild data logs, and recover lost file blocks.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-1.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-digital-forensics.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- 10: Managed Security -->
          <div
            class="col-12 service-list-wrap"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div class="service-list hover-item">
              <div class="box-number">10</div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="services-managed-security.php"
                    >Managed Security Services (SOC)</a
                  >
                </h3>
                <p class="box-text">
                  Continuous 24/7/365 operational surveillance and automated triage managed by security architects.
                </p>
              </div>
              <div class="box-img">
                <img src="./index/service2-2.jpg" alt="img" />
              </div>
              <div class="btn-wrap">
                <a
                  href="services-managed-security.php"
                  class="ot-btn style-border"
                  >Read More<i class="far fa-long-arrow-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- <div class="space">
      <div class="container ot-container">
        <div
          class="swiper ot-slider swiper-initialized swiper-horizontal swiper-backface-hidden"
          data-cue="slideInUp"
          id="blogSlider1"
          data-slider-options='{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"5"},"1400":{"slidesPerView":"5"}}}'
          data-show="true"
          style="
            animation-name: slideInUp;
            animation-duration: 900ms;
            animation-timing-function: ease;
            animation-delay: 0ms;
            animation-direction: normal;
            animation-fill-mode: both;
          "
        >
          <div
            class="swiper-wrapper"
            id="swiper-wrapper-3b1179a969f10f88a"
            aria-live="off"
            style="
              transition-duration: 0ms;
              transform: translate3d(-1124px, 0px, 0px);
              transition-delay: 0ms;
            "
          >
            <div
              class="swiper-slide"
              role="group"
              aria-label="4 / 10"
              data-swiper-slide-index="3"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_4.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide"
              role="group"
              aria-label="5 / 10"
              data-swiper-slide-index="4"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_5.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide"
              role="group"
              aria-label="6 / 10"
              data-swiper-slide-index="5"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_1.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide swiper-slide-prev"
              role="group"
              aria-label="7 / 10"
              data-swiper-slide-index="6"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_2.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide swiper-slide-active"
              role="group"
              aria-label="8 / 10"
              data-swiper-slide-index="7"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_3.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide swiper-slide-next"
              role="group"
              aria-label="9 / 10"
              data-swiper-slide-index="8"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_4.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide"
              role="group"
              aria-label="10 / 10"
              data-swiper-slide-index="9"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_5.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide"
              role="group"
              aria-label="1 / 10"
              data-swiper-slide-index="0"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_1.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide"
              role="group"
              aria-label="2 / 10"
              data-swiper-slide-index="1"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_2.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
            <div
              class="swiper-slide"
              role="group"
              aria-label="3 / 10"
              data-swiper-slide-index="2"
              style="width: 251px; margin-right: 30px"
            >
              <div class="brand-card">
                <a target="_blank" href="index.php#"
                  ><img src="./index/brand_1_3.svg" alt="Brand Logo"
                /></a>
              </div>
            </div>
          </div>
          <span
            class="swiper-notification"
            aria-live="assertive"
            aria-atomic="true"
          ></span
          ><span
            class="swiper-notification"
            aria-live="assertive"
            aria-atomic="true"
          ></span>
        </div>
      </div>
    </div> -->
    <div class="space-bottom overflow-hidden shape-mockup-wrap">
      <div
        class="shape-mockup bg-gradient-shape1 why-bg-gradient1"
        style="inset: auto 0px 30% auto"
      ></div>
      <div
        class="shape-mockup bg-gradient-shape1 why-bg-gradient2"
        style="top: 20%; left: 3%"
      ></div>
      <div class="container">
        <div class="title-area mb-40 text-center">
          <span
            class="sub-title style2"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
            >How it Works</span
          >
          <h2
            class="sec-title"
            data-cue="slideInUp"
            data-delay="100"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 100ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            Securing Your Digital Future, Step by Step
          </h2>
        </div>
        <div class="row">
          <div class="col-12">
            <ul class="work-process-list">
              <li
                class="work-process-single-list"
                data-cue="slideInUp"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 0ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                <div class="single-work-process">
                  <div class="box-number" style="--theme-color: #069845">
                    <span
                      class="box-number-bg"
                      style="--theme-color: #011e1d"
                    ></span>
                    01
                  </div>
                  <div class="box-content">
                    <h4 class="box-title">Comprehensive Assessment</h4>
                    <p class="box-text">
                      Evaluate the severity of threats, their potential impact
                      on your business, and the likelihood of occurrence.Ensure
                      adherence to industry standards and regulations, such as
                      GDPR, HIPAA, and PCI DSS.
                    </p>
                  </div>
                </div>
              </li>
              <li
                class="work-process-single-list"
                data-cue="slideInUp"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 0ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                <div class="single-work-process">
                  <div class="box-number" style="--theme-color: #f0a230">
                    <span
                      class="box-number-bg"
                      style="--theme-color: #24201a"
                    ></span>
                    02
                  </div>
                  <div class="box-content">
                    <h4 class="box-title">Advanced Threat Detection</h4>
                    <p class="box-text">
                      Detect and prevent sophisticated cyberattacks. Data
                      Encryption: Safeguard sensitive information with strong
                      encryption.Protect web applications from attacks.Monitor
                      network traffic .
                    </p>
                  </div>
                </div>
              </li>
              <li
                class="work-process-single-list"
                data-cue="slideInUp"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 0ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                <div class="single-work-process">
                  <div class="box-number" style="--theme-color: #e0009b">
                    <span
                      class="box-number-bg"
                      style="--theme-color: #22082a"
                    ></span>
                    03
                  </div>
                  <div class="box-content">
                    <h4 class="box-title">Incident Response</h4>
                    <p class="box-text">
                      When a threat is detected, our automated response systems
                      spring into action. We swiftly contain the incident,
                      minimize damage, and restore your systems to normal
                      operation. Our expert security analysts monitor.
                    </p>
                  </div>
                </div>
              </li>
              <li
                class="work-process-single-list"
                data-cue="slideInUp"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 0ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                <div class="single-work-process">
                  <div class="box-number" style="--theme-color: #8f54ff">
                    <span
                      class="box-number-bg"
                      style="--theme-color: #151439"
                    ></span>
                    04
                  </div>
                  <div class="box-content">
                    <h4 class="box-title">Continuous Monitoring</h4>
                    <p class="box-text">
                      We maintain 24/7 vigilance over your cloud environment,
                      ensuring ongoing protection. Our security systems are
                      constantly learning and adapting to the ever-evolving
                      threat landscape. We proactively identify.
                    </p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Scoped Style Overrides for Global Network Section -->
    <style>
    #global-network-sec {
        background-color: #000916 !important;
        padding: 80px 0 !important;
        position: relative;
    }
    #global-network-sec::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(37, 99, 235, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(37, 99, 235, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }
    
    .edge-metric-item {
        margin-bottom: 22px;
    }
    .edge-metric-item:last-child {
        margin-bottom: 0;
    }
    .edge-metric-item .metric-lbl {
        font-family: "Space Grotesk", monospace;
        font-size: 0.75rem;
        color: #94a3b8;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 6px;
    }
    .edge-metric-item .metric-val {
        font-family: "Space Grotesk", monospace;
        font-size: 1.25rem;
        font-weight: 700;
        display: block;
        margin-bottom: 8px;
    }
    .edge-metric-item .metric-bar {
        height: 6px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 3px;
        overflow: hidden;
    }
    .edge-metric-item .metric-bar .bar-fill {
        height: 100%;
        border-radius: 3px;
    }
    
    .globe-vector-wrap {
        position: relative;
        margin: 0 auto;
        display: inline-block;
    }
    
    .edge-nodes-list {
        background: rgba(15, 23, 42, 0.55);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 24px 20px;
        backdrop-filter: blur(10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        text-align: left;
    }
    .edge-nodes-list .nodes-hdr {
        font-family: "Space Grotesk", monospace;
        font-size: 0.75rem;
        color: #60a5fa;
        font-weight: 700;
        letter-spacing: 1.5px;
        display: block;
        margin-bottom: 18px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        padding-bottom: 10px;
    }
    .node-status-card {
        margin-bottom: 16px;
    }
    .node-status-card:last-child {
        margin-bottom: 0;
    }
    .node-status-card .node-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #ffffff;
        display: block;
        margin-bottom: 4px;
    }
    .node-status-card .node-status {
        font-family: "Space Grotesk", monospace;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .node-status-card .node-status i {
        font-size: 0.65rem;
    }
    </style>

    <!-- <section class="overflow-hidden shape-mockup-wrap" id="global-network-sec">
      <div
        class="shape-mockup bg-gradient-shape1"
        style="top: 20%; right: -3%; left: auto"
      ></div>
      <div class="container">
        <div class="row justify-content-center align-items-center mb-50">
          <div class="col-xl-10">
            <div class="title-area text-center">
              <span class="sub-title style2">Global Network</span>
              <h2
                class="sec-title text-white"
                style="font-size: clamp(2rem, 4vw, 2.5rem); font-weight: 800;"
              >
                A Global Network of Cloud Security
              </h2>
              <p class="sec-text">
                Advert Resource Ltd is an innovative cybersecurity firm dedicated to safeguarding your digital assets. Operating at the cutting-edge of network defense, we provide modern, comprehensive protection.
              </p>
            </div>
          </div>
        </div>
        
      
      </div>
    </section> -->

    <!-- ============================================ -->
    <!-- HOW WE WORK - PROCESS SECTION -->
    <!-- ============================================ -->
    <style>
    #process-sec {
        background: linear-gradient(180deg, #050B18 0%, #000916 100%);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(255,255,255,0.05);
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    #process-sec::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(37,99,235,0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(37,99,235,0.04) 1px, transparent 1px);
        background-size: 55px 55px;
        pointer-events: none;
    }
    /* Glow orbs */
    .process-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(130px);
        pointer-events: none;
        z-index: 0;
    }
    .process-orb-blue { background: rgba(37,99,235,0.18); width: 500px; height: 500px; top: -100px; left: -100px; }
    .process-orb-pink { background: rgba(224,0,155,0.12); width: 400px; height: 400px; bottom: -50px; right: -80px; }
    #process-sec .container { position: relative; z-index: 2; }
    /* Badge */
    .process-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        background: rgba(37,99,235,0.1);
        border: 1px solid rgba(37,99,235,0.3);
        border-radius: 30px;
        color: #60a5fa;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }
    /* Step Cards */
    .process-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 60px;
        position: relative;
    }
    /* Connector line between cards */
    .process-grid::before {
        content: '';
        position: absolute;
        top: 52px;
        left: calc(12.5% + 12px);
        right: calc(12.5% + 12px);
        height: 2px;
        background: linear-gradient(90deg, #3C72FC, #E0009B);
        z-index: 0;
        opacity: 0.4;
    }
    .process-card {
        background: rgba(15,23,42,0.6);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 20px;
        padding: 36px 24px 30px;
        text-align: center;
        position: relative;
        transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
        backdrop-filter: blur(10px);
        z-index: 1;
    }
    .process-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 20px;
        padding: 1px;
        background: linear-gradient(135deg, rgba(60,114,252,0.15), rgba(224,0,155,0.1));
        -webkit-mask: linear-gradient(white 0 0) content-box, linear-gradient(white 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .process-card:hover { transform: translateY(-10px); border-color: rgba(60,114,252,0.25); box-shadow: 0 20px 50px rgba(0,0,0,0.4); }
    .process-card:hover::before { opacity: 1; }
    .process-step-num {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Space Grotesk', monospace;
        font-size: 1.3rem;
        font-weight: 800;
        margin: 0 auto 24px;
        position: relative;
        z-index: 1;
    }
    .step-num-1 { background: rgba(37,99,235,0.15); border: 2px solid rgba(37,99,235,0.4); color: #60a5fa; box-shadow: 0 0 20px rgba(37,99,235,0.2); }
    .step-num-2 { background: rgba(124,58,237,0.15); border: 2px solid rgba(124,58,237,0.4); color: #a78bfa; box-shadow: 0 0 20px rgba(124,58,237,0.2); }
    .step-num-3 { background: rgba(224,0,155,0.12); border: 2px solid rgba(224,0,155,0.4); color: #e879b2; box-shadow: 0 0 20px rgba(224,0,155,0.2); }
    .step-num-4 { background: rgba(16,185,129,0.12); border: 2px solid rgba(16,185,129,0.4); color: #10b981; box-shadow: 0 0 20px rgba(16,185,129,0.2); }
    .process-icon {
        font-size: 2rem;
        margin-bottom: 18px;
        display: block;
    }
    .step-icon-1 { color: #60a5fa; }
    .step-icon-2 { color: #a78bfa; }
    .step-icon-3 { color: #e879b2; }
    .step-icon-4 { color: #10b981; }
    .process-card h4 {
        font-size: 1.1rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 12px;
        letter-spacing: -0.3px;
    }
    .process-card p {
        font-size: 0.88rem;
        line-height: 1.65;
        color: #94a3b8;
        margin: 0;
    }
    .process-card .step-tag {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 20px;
        margin-bottom: 14px;
    }
    .tag-1 { background: rgba(37,99,235,0.1); color: #60a5fa; }
    .tag-2 { background: rgba(124,58,237,0.1); color: #a78bfa; }
    .tag-3 { background: rgba(224,0,155,0.1); color: #e879b2; }
    .tag-4 { background: rgba(16,185,129,0.1); color: #10b981; }
    /* Stats row */
    .process-stats {
        display: flex;
        justify-content: center;
        gap: 60px;
        flex-wrap: wrap;
        margin-top: 70px;
        padding-top: 50px;
        border-top: 1px solid rgba(255,255,255,0.06);
    }
    .process-stat { text-align: center; }
    .process-stat-num {
        font-family: 'Space Grotesk', monospace;
        font-size: 2.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #fff 40%, #E0009B 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 8px;
    }
    .process-stat-label { font-size: 0.8rem; color: #64748b; letter-spacing: 1.5px; text-transform: uppercase; }
    @media (max-width: 991px) {
        .process-grid { grid-template-columns: repeat(2, 1fr); }
        .process-grid::before { display: none; }
    }
    @media (max-width: 575px) {
        .process-grid { grid-template-columns: 1fr; }
        .process-stats { gap: 30px; }
    }
    </style>

    <section id="process-sec">
        <div class="process-orb process-orb-blue"></div>
        <div class="process-orb process-orb-pink"></div>
        <div class="container">
            <!-- Header -->
            <div class="text-center mb-2">
                <span class="process-badge"><i class="fas fa-shield-alt me-1"></i> Our Methodology</span>
                <h2 class="sec-title text-white mt-2" style="font-size:clamp(2rem,4vw,2.8rem); font-weight:800; line-height:1.2;">
                    How We Secure<br><span style="background:linear-gradient(135deg,#3C72FC,#E0009B); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">Your Business</span>
                </h2>
                <p style="font-size:1rem; color:#94a3b8; max-width:580px; margin:16px auto 0; line-height:1.7;">
                    A proven 4-phase security framework — from threat assessment to continuous monitoring — designed to eliminate vulnerabilities before adversaries exploit them.
                </p>
            </div>

            <!-- Process Steps -->
            <div class="process-grid">
                <!-- Step 1 -->
                <div class="process-card">
                    <div class="process-step-num step-num-1">01</div>
                    <span class="step-tag tag-1">Discovery</span>
                    <i class="fas fa-chart-line process-icon step-icon-1"></i>
                    <h4>Threat Assessment &amp; Audit</h4>
                    <p>We begin with a comprehensive audit of your existing infrastructure — identifying attack surfaces, misconfigurations, and vulnerabilities across all endpoints, cloud assets, and networks.</p>
                </div>
                <!-- Step 2 -->
                <div class="process-card">
                    <div class="process-step-num step-num-2">02</div>
                    <span class="step-tag tag-2">Strategy</span>
                    <i class="fas fa-chess-knight process-icon step-icon-2"></i>
                    <h4>Custom Security Blueprint</h4>
                    <p>Our architects design a tailored zero-trust security strategy — including firewall rules, access policies, encryption protocols, and incident response playbooks specific to your risk profile.</p>
                </div>
                <!-- Step 3 -->
                <div class="process-card">
                    <div class="process-step-num step-num-3">03</div>
                    <span class="step-tag tag-3">Deploy</span>
                    <i class="fas fa-rocket process-icon step-icon-3"></i>
                    <h4>Implementation &amp; Hardening</h4>
                    <p>Our red team operatives deploy defenses, harden systems, run controlled penetration tests, and validate every layer of security with real-world adversarial simulation techniques.</p>
                </div>
                <!-- Step 4 -->
                <div class="process-card">
                    <div class="process-step-num step-num-4">04</div>
                    <span class="step-tag tag-4">Monitor</span>
                    <i class="fas fa-broadcast-tower process-icon step-icon-4"></i>
                    <h4>24/7 Continuous Monitoring</h4>
                    <p>Post-deployment, our SOC analysts provide round-the-clock threat hunting, anomaly detection, and real-time incident response — ensuring your defenses evolve faster than emerging threats.</p>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="process-stats">
                <div class="process-stat">
                    <div class="process-stat-num">100%</div>
                    <div class="process-stat-label">Secured Systems</div>
                </div>
                <div class="process-stat">
                    <div class="process-stat-num">99.8%</div>
                    <div class="process-stat-label">Threat Neutralization Rate</div>
                </div>
                <div class="process-stat">
                    <div class="process-stat-num">&lt;15min</div>
                    <div class="process-stat-label">Avg. Response Time</div>
                </div>
                <div class="process-stat">
                    <div class="process-stat-num">24/7</div>
                    <div class="process-stat-label">SOC Coverage</div>
                </div>
            </div>
        </div>
    </section>
    <!-- Scoped Premium Why Choose Us Style Overrides -->
    <style>
    .premium-why-sec {
        background-color: #000916 !important;
        position: relative;
        overflow: hidden;
        padding: 100px 0 !important;
    }
    .premium-why-sec::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: 
            linear-gradient(rgba(37, 99, 235, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(37, 99, 235, 0.04) 1px, transparent 1px);
        background-size: 60px 60px;
        z-index: 0;
        pointer-events: none;
    }
    .premium-why-sec .container {
        position: relative;
        z-index: 1;
    }
    
    /* Counter Glass Cards */
    .why-counter-card {
        background: rgba(15, 23, 42, 0.55) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-radius: 18px !important;
        padding: 24px 20px !important;
        margin-bottom: 24px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
        text-align: left !important;
        display: flex !important;
        align-items: center !important;
        gap: 16px !important;
        backdrop-filter: blur(12px) !important;
    }
    .why-counter-card:hover {
        transform: translateY(-5px) !important;
        border-color: rgba(96, 165, 250, 0.3) !important;
        box-shadow: 0 15px 35px rgba(96, 165, 250, 0.1) !important;
    }
    .why-card-icon {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        transition: all 0.3s ease;
    }
    .why-counter-card:hover .why-card-icon {
        background: rgba(96, 165, 250, 0.1);
        border-color: rgba(96, 165, 250, 0.3);
        color: #ffffff !important;
        filter: drop-shadow(0 0 8px rgba(96, 165, 250, 0.5));
    }
    .why-counter-card .box-number {
        font-size: 2rem !important;
        font-weight: 800 !important;
        line-height: 1.1 !important;
        margin: 0 !important;
        background: linear-gradient(135deg, #ffffff 40%, #a5b4fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-family: "Space Grotesk", sans-serif;
    }
    .why-counter-card .box-text {
        font-size: 0.85rem !important;
        font-weight: 700 !important;
        letter-spacing: 1px !important;
        text-transform: uppercase !important;
        margin-top: 4px !important;
        display: block !important;
    }

    /* Radar Animations */
    @keyframes rotateCW {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    @keyframes rotateCCW {
        from { transform: rotate(0deg); }
        to { transform: rotate(-360deg); }
    }
    @keyframes pulseNode {
        0% { transform: scale(1); opacity: 0.4; }
        50% { transform: scale(1.5); opacity: 1; }
        100% { transform: scale(1); opacity: 0.4; }
    }
    </style>

    <div class="space-bottom overflow-hidden premium-why-sec">
      <div class="container">
        <div class="title-area mb-40 text-center">
          <span
            class="sub-title style2"
            data-cue="slideInUp"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
            >Why Choose Us</span
          >
          <h2
            class="sec-title text-white"
            data-cue="slideInUp"
            data-delay="100"
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 100ms;
              animation-direction: normal;
              animation-fill-mode: both;
              font-size: clamp(2rem, 4vw, 2.5rem);
              font-weight: 800;
            "
          >
            Forging a Path to Cybersecurity Leadership
          </h2>
        </div>
        <div class="row gy-40 justify-content-center align-items-center">
          <!-- Left Column: 2 Cards -->
          <div class="col-lg-4 col-md-6 order-lg-1">
            <div class="why-counter-card">
              <div class="why-card-icon" style="color: #60a5fa;"><i class="fas fa-layer-group"></i></div>
              <div>
                <h2 class="box-number"><span class="counter-number">100</span>%</h2>
                <span class="box-text" style="color: #60a5fa;">Active Defense Architecture</span>
              </div>
            </div>
            <div class="why-counter-card">
              <div class="why-card-icon" style="color: #E0009B;"><i class="fas fa-globe"></i></div>
              <div>
                <h2 class="box-number"><span class="counter-number">1</span>st</h2>
                <span class="box-text" style="color: #E0009B;">Zero-Day Protection</span>
              </div>
            </div>
          </div>
          
          <!-- Middle Column: Animated SVG Radar -->
          <div class="col-lg-4 col-md-8 text-center order-lg-2">
            <div class="radar-container" style="position: relative; width: 280px; height: 280px; margin: 0 auto;">
                <svg width="280" height="280" viewBox="0 0 280 280" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Outer rotating grid -->
                    <circle cx="140" cy="140" r="130" stroke="rgba(96, 165, 250, 0.15)" stroke-width="1.5" stroke-dasharray="10 10" style="animation: rotateCW 30s linear infinite;" />
                    <!-- Middle circle -->
                    <circle cx="140" cy="140" r="100" stroke="rgba(224, 0, 155, 0.2)" stroke-width="1.5" />
                    <!-- Inner radar sweeping circle -->
                    <circle cx="140" cy="140" r="70" stroke="rgba(96, 165, 250, 0.3)" stroke-width="1" stroke-dasharray="5 5" style="animation: rotateCCW 15s linear infinite;" />
                    <circle cx="140" cy="140" r="40" stroke="rgba(224, 0, 155, 0.4)" stroke-width="2" />
                    
                    <!-- Radar line sweep -->
                    <line x1="140" y1="140" x2="140" y2="10" stroke="url(#radarSweepGrad)" stroke-width="2" style="transform-origin: 140px 140px; animation: rotateCW 4s linear infinite;" />
                    
                    <!-- Target nodes -->
                    <circle cx="90" cy="80" r="5" fill="#ef4444" style="animation: pulseNode 2s infinite;" />
                    <circle cx="190" cy="200" r="4" fill="#10b981" style="animation: pulseNode 2s infinite 0.7s;" />
                    <circle cx="70" cy="180" r="4" fill="#60a5fa" style="animation: pulseNode 2s infinite 1.4s;" />
                    
                    <!-- Central glowing core -->
                    <circle cx="140" cy="140" r="10" fill="url(#coreGlow)" />
                    
                    <defs>
                        <linearGradient id="radarSweepGrad" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#E0009B" stop-opacity="1" />
                            <stop offset="100%" stop-color="#E0009B" stop-opacity="0" />
                        </linearGradient>
                        <radialGradient id="coreGlow" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" stop-color="#60a5fa" stop-opacity="1" />
                            <stop offset="100%" stop-color="#60a5fa" stop-opacity="0" />
                        </radialGradient>
                    </defs>
                </svg>
                
                <!-- Text overlays inside the radar -->
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; font-family: 'Space Grotesk', monospace; z-index: 2;">
                    <span style="font-size: 0.75rem; color: #fff; font-weight: 700; letter-spacing: 2px; text-shadow: 0 0 10px rgba(96,165,250,0.8);">SECURE</span>
                    <br>
                    <span style="font-size: 0.65rem; color: #069845; font-weight: 700; letter-spacing: 1px;">ONLINE</span>
                </div>
            </div>
          </div>
          
          <!-- Right Column: 2 Cards -->
          <div class="col-lg-4 col-md-6 order-lg-3">
            <div class="why-counter-card">
              <div class="why-card-icon" style="color: #f0a230;"><i class="fas fa-users-gear"></i></div>
              <div>
                <h2 class="box-number"><span class="counter-number">24</span>/7</h2>
                <span class="box-text" style="color: #f0a230;">Threat Hunting</span>
              </div>
            </div>
            <div class="why-counter-card">
              <div class="why-card-icon" style="color: #8f54ff;"><i class="fas fa-award"></i></div>
              <div>
                <h2 class="box-number"><span class="counter-number">3.0</span></h2>
                <span class="box-text" style="color: #8f54ff;">Next-Gen AI SOC</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Scoped Premium Get in Touch Style Overrides -->
    <style>
    .premium-cta-sec {
        background-color: #000814 !important;
        position: relative;
        overflow: hidden;
        padding: 120px 0 !important;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .premium-cta-sec::before {
        content: '';
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(60, 114, 252, 0.08) 0%, transparent 70%);
        top: -150px;
        left: -150px;
        pointer-events: none;
    }
    .premium-cta-sec::after {
        content: '';
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(224, 0, 155, 0.06) 0%, transparent 70%);
        bottom: -150px;
        right: -150px;
        pointer-events: none;
    }
    
    .cta-channel-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: rgba(60, 114, 252, 0.1);
        border: 1px solid rgba(60, 114, 252, 0.3);
        border-radius: 30px;
        color: #fff;
        font-size: 0.8rem;
        font-family: "Space Grotesk", monospace;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 25px;
        box-shadow: 0 0 15px rgba(60, 114, 252, 0.15);
    }
    .cta-channel-badge .pulse-dot {
        width: 8px;
        height: 8px;
        background-color: #3c72fc;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 10px #3c72fc;
        animation: activePulse 1.5s infinite;
    }
    
    .cta-desc {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #94a3b8;
        margin-top: 20px;
        margin-bottom: 40px;
    }
    
    /* Dual button structure */
    .cta-btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: flex-start;
    }
    @media (max-width: 575px) {
        .cta-btn-group {
            justify-content: center;
        }
    }
    .cta-btn-primary {
        background: linear-gradient(135deg, #3C72FC 0%, #E0009B 100%) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 30px !important;
        padding: 14px 32px !important;
        font-size: 0.95rem !important;
        font-weight: 700 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        box-shadow: 0 5px 20px rgba(60, 114, 252, 0.3) !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
    }
    .cta-btn-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(224, 0, 155, 0.5) !important;
        color: #ffffff !important;
    }
    .cta-btn-secondary {
        background: rgba(255, 255, 255, 0.03) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
        border-radius: 30px !important;
        padding: 14px 32px !important;
        font-size: 0.95rem !important;
        font-weight: 700 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
    }
    .cta-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.08) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
        transform: translateY(-2px) !important;
        color: #ffffff !important;
    }
    
    @keyframes shieldPulse {
        0% { filter: drop-shadow(0 0 5px rgba(60,114,252,0.4)); }
        50% { filter: drop-shadow(0 0 15px rgba(60,114,252,0.8)) drop-shadow(0 0 25px rgba(224,0,155,0.4)); }
        100% { filter: drop-shadow(0 0 5px rgba(60,114,252,0.4)); }
    }
    </style>

    <section
      class="premium-cta-sec"
      id="cta-sec"
    >
      <div class="container">
        <div class="row gy-50 justify-content-center align-items-center">
          <div class="col-xl-6 col-lg-7 text-xl-start text-center">
            <div class="title-area mb-0">
              <span class="cta-channel-badge">
                <span class="pulse-dot"></span>
                SECURE ACCESS CHANNEL
              </span>
              <h2
                class="sec-title text-white"
                style="font-size: clamp(2rem, 4.5vw, 2.8rem); line-height: 1.2; font-weight: 800;"
              >
                Securing Your Digital World With Advanced Defense
              </h2>
              <p class="cta-desc">
                Advert Resource Ltd is a pioneering cybersecurity firm dedicated to safeguarding enterprise infrastructure. Connect with an expert today to deploy threat intelligence, establish boundaries, and isolate vulnerabilities before they materialize.
              </p>
              
              <div class="cta-btn-group">
                <a href="contact-us.php" class="cta-btn-primary">
                  Speak with an Expert <i class="fas fa-arrow-right"></i>
                </a>
                <a href="contact-us.php" class="cta-btn-secondary">
                  Schedule Audit
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-5 text-center">
            <!-- Glowing Interactive Shield Hub -->
            <div class="cyber-hub-container" style="position: relative; width: 320px; height: 320px; margin: 0 auto;">
                <svg width="320" height="320" viewBox="0 0 320 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Rotating Outer Hexagon Grid -->
                    <polygon points="160,20 280,90 280,230 160,300 40,230 40,90" stroke="rgba(96, 165, 250, 0.15)" stroke-width="1.5" stroke-dasharray="12 6" style="transform-origin: 160px 160px; animation: rotateCW 40s linear infinite;" />
                    <!-- Inner Static Hexagon Grid -->
                    <polygon points="160,50 255,105 255,215 160,270 65,215 65,105" stroke="rgba(224, 0, 155, 0.15)" stroke-width="1" />
                    
                    <!-- Animated Concentric Rings -->
                    <circle cx="160" cy="160" r="100" stroke="rgba(96, 165, 250, 0.1)" stroke-dasharray="20 40" stroke-width="2" style="transform-origin: 160px 160px; animation: rotateCCW 20s linear infinite;" />
                    <circle cx="160" cy="160" r="75" stroke="rgba(224, 0, 155, 0.25)" stroke-width="1.5" />
                    <circle cx="160" cy="160" r="45" stroke="rgba(96, 165, 250, 0.3)" stroke-width="1" stroke-dasharray="5 5" style="transform-origin: 160px 160px; animation: rotateCW 12s linear infinite;" />
                    
                    <!-- Pulsing Defense Rays -->
                    <path d="M160,20 L160,300 M20,160 L300,160" stroke="rgba(255,255,255,0.04)" stroke-width="1" />
                    
                    <!-- Center Cyber Shield Shape -->
                    <path d="M160,110 C175,110 190,100 195,95 C195,145 190,195 160,215 C130,195 125,145 125,95 C130,100 145,110 160,110 Z" fill="url(#shieldGlow)" stroke="#3C72FC" stroke-width="2.5" style="animation: shieldPulse 3s infinite;" />
                    
                    <!-- Blinking Node Connections -->
                    <circle cx="255" cy="105" r="4" fill="#3C72FC" style="animation: pulseNode 1.5s infinite;" />
                    <circle cx="65" cy="215" r="4" fill="#E0009B" style="animation: pulseNode 1.5s infinite 0.5s;" />
                    <circle cx="160" cy="50" r="4.5" fill="#10b981" style="animation: pulseNode 1.5s infinite 1s;" />
                    
                    <defs>
                        <linearGradient id="shieldGlow" x1="160" y1="95" x2="160" y2="215">
                            <stop offset="0%" stop-color="#3C72FC" stop-opacity="0.6" />
                            <stop offset="100%" stop-color="#E0009B" stop-opacity="0.1" />
                        </linearGradient>
                    </defs>
                </svg>
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                    <i class="fas fa-shield-alt" style="font-size: 2.2rem; color: #ffffff; text-shadow: 0 0 15px rgba(60,114,252,0.8);"></i>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="space overflow-hidden arrow-wrap shape-mockup-wrap">
      <div
        class="shape-mockup bg-gradient-shape1"
        style="top: 10%; left: 3%"
      ></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="title-area text-center">
              <span
                class="sub-title style2"
                data-cue="slideInUp"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 0ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
                ></span
              >
              <h2
                class="sec-title"
                data-cue="slideInUp"
                data-show="true"
                style="
                  animation-name: slideInUp;
                  animation-duration: 900ms;
                  animation-timing-function: ease;
                  animation-delay: 0ms;
                  animation-direction: normal;
                  animation-fill-mode: both;
                "
              >
                What Our Customers Say
              </h2>
            </div>
          </div>
        </div>
        <div class="slider-area testi-slider2">
          <div
            class="swiper ot-slider swiper-initialized swiper-horizontal swiper-autoheight swiper-backface-hidden"
            data-cue="slideInUp"
            id="testiSlider2"
            data-slider-options='{"loop":false,"autoHeight": true,"breakpoints":{"0":{"slidesPerView":1},"768":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}'
            data-show="true"
            style="
              animation-name: slideInUp;
              animation-duration: 900ms;
              animation-timing-function: ease;
              animation-delay: 0ms;
              animation-direction: normal;
              animation-fill-mode: both;
            "
          >
            <div
              class="swiper-wrapper"
              id="swiper-wrapper-ef1e588c7790d791"
              aria-live="off"
              style="
                height: 465px;
                transition-duration: 0ms;
                transform: translate3d(-1200px, 0px, 0px);
                transition-delay: 0ms;
              "
            >
              <div
                class="swiper-slide"
                role="group"
                aria-label="1 / 6"
                style="width: 370px; margin-right: 30px"
              >
                <div class="testi-card style2">
                  <div class="box-thumb">
                    <img src="./index/1-3.png" alt="img" />
                  </div>
                  <h3 class="box-title">Sarah Rahman</h3>
                  <div class="testi-card-content">
                    <p class="box-text">
                      "We were struggling to manage our growing cloud
                      infrastructure and protect our sensitive data. Securs
                      expert team provided us with a comprehensive security
                      solution that not only met our needs but exceeded our
                      expectations. Their proactive detection."
                    </p>
                  </div>
                  <div
                    class="star-rating"
                    role="img"
                    aria-label="Rated 5.00 out of 5"
                  >
                    <span
                      >Rated <strong class="rating">5.00</strong> out of 5 based
                      on <span class="rating">1</span> customer rating</span
                    >
                  </div>
                </div>
              </div>
              <div
                class="swiper-slide"
                role="group"
                aria-label="2 / 6"
                style="width: 370px; margin-right: 30px"
              >
                <div class="testi-card style2">
                  <div class="box-thumb">
                    <img src="./index/1-2.png" alt="img" />
                  </div>
                  <h3 class="box-title">Mr. Michel Phelops</h3>
                  <div class="testi-card-content">
                    <p class="box-text">
                      "Before partnering with Advert Resource Ltd, we were constantly worried
                      about potential data breaches. With their robust data loss
                      prevention solution, Their team stays ahead of the latest
                      threats.we have significantly reduced our risk and can now
                      focus on business."
                    </p>
                  </div>
                  <div
                    class="star-rating"
                    role="img"
                    aria-label="Rated 5.00 out of 5"
                  >
                    <span
                      >Rated <strong class="rating">5.00</strong> out of 5 based
                      on <span class="rating">1</span> customer rating</span
                    >
                  </div>
                </div>
              </div>
              <div
                class="swiper-slide swiper-slide-prev"
                role="group"
                aria-label="3 / 6"
                style="width: 370px; margin-right: 30px"
              >
                <div class="testi-card style2">
                  <div class="box-thumb">
                    <img src="./index/1-1.png" alt="img" />
                  </div>
                  <h3 class="box-title">Andy Dufren</h3>
                  <div class="testi-card-content">
                    <p class="box-text">
                      "The Advert Resource Ltd team is incredibly responsive and always
                      willing to go the extra mile to address our concerns.
                      Their customer support is top-notch, response plan, we
                      were able to mitigateand we are confident in their ability
                      to protect our cloud environment."
                    </p>
                  </div>
                  <div
                    class="star-rating"
                    role="img"
                    aria-label="Rated 5.00 out of 5"
                  >
                    <span
                      >Rated <strong class="rating">5.00</strong> out of 5 based
                      on <span class="rating">1</span> customer rating</span
                    >
                  </div>
                </div>
              </div>
              <div
                class="swiper-slide swiper-slide-active"
                role="group"
                aria-label="4 / 6"
                style="width: 370px; margin-right: 30px"
              >
                <div class="testi-card style2">
                  <div class="box-thumb">
                    <img src="./index/1-4.png" alt="img" />
                  </div>
                  <h3 class="box-title">Pinakee Aveter</h3>
                  <div class="testi-card-content">
                    <p class="box-text">
                      "We were struggling to manage our growing cloud
                      infrastructure and protect our sensitive data. Securs
                      expert team provided us with a comprehensive security
                      solution that not only met our needs but exceeded our
                      expectations. Their proactive detection."
                    </p>
                  </div>
                  <div
                    class="star-rating"
                    role="img"
                    aria-label="Rated 5.00 out of 5"
                  >
                    <span
                      >Rated <strong class="rating">5.00</strong> out of 5 based
                      on <span class="rating">1</span> customer rating</span
                    >
                  </div>
                </div>
              </div>
              <div
                class="swiper-slide swiper-slide-next"
                role="group"
                aria-label="5 / 6"
                style="width: 370px; margin-right: 30px"
              >
                <div class="testi-card style2">
                  <div class="box-thumb">
                    <img src="./index/1-5.png" alt="img" />
                  </div>
                  <h3 class="box-title">Arif Rahman</h3>
                  <div class="testi-card-content">
                    <p class="box-text">
                      "Before partnering with Advert Resource Ltd, we were constantly worried
                      about potential data breaches. With their robust data loss
                      prevention solution, Their team stays ahead of the latest
                      threats.we have significantly reduced our risk and can now
                      focus on business."
                    </p>
                  </div>
                  <div
                    class="star-rating"
                    role="img"
                    aria-label="Rated 5.00 out of 5"
                  >
                    <span
                      >Rated <strong class="rating">5.00</strong> out of 5 based
                      on <span class="rating">1</span> customer rating</span
                    >
                  </div>
                </div>
              </div>
              <div
                class="swiper-slide"
                role="group"
                aria-label="6 / 6"
                style="width: 370px; margin-right: 30px"
              >
                <div class="testi-card style2">
                  <div class="box-thumb">
                    <img src="./index/1-6.png" alt="img" />
                  </div>
                  <h3 class="box-title">Emily Chowhan</h3>
                  <div class="testi-card-content">
                    <p class="box-text">
                      "The Advert Resource Ltd team is incredibly responsive and always
                      willing to go the extra mile to address our concerns.
                      Their customer support is top-notch, response plan, we
                      were able to mitigateand we are confident in their ability
                      to protect our cloud environment."
                    </p>
                  </div>
                  <div
                    class="star-rating"
                    role="img"
                    aria-label="Rated 5.00 out of 5"
                  >
                    <span
                      >Rated <strong class="rating">5.00</strong> out of 5 based
                      on <span class="rating">1</span> customer rating</span
                    >
                  </div>
                </div>
              </div>
            </div>
            <div
              class="slider-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"
            >
              <span
                class="swiper-pagination-bullet"
                aria-label="Go to Slide 1"
                tabindex="0"
              ></span
              ><span
                class="swiper-pagination-bullet"
                aria-label="Go to Slide 2"
                tabindex="0"
              ></span
              ><span
                class="swiper-pagination-bullet"
                aria-label="Go to Slide 3"
                tabindex="0"
              ></span
              ><span
                class="swiper-pagination-bullet swiper-pagination-bullet-active"
                aria-label="Go to Slide 4"
                tabindex="0"
                aria-current="true"
              ></span>
            </div>
            <span
              class="swiper-notification"
              aria-live="assertive"
              aria-atomic="true"
            ></span
            ><span
              class="swiper-notification"
              aria-live="assertive"
              aria-atomic="true"
            ></span>
          </div>
        </div>
      </div>
    </section>
    <!-- Tighten Layout Spacing & Title Alignment: Global Overrides -->
    <style>
    .space, .space-top, .space-bottom, 
    #service-sec, #team-sec, #global-network-sec, 
    .premium-why-sec, .premium-cta-sec, #blog-sec {
        padding-top: 50px !important;
        padding-bottom: 50px !important;
    }
    
    /* Unified Title Area Alignment & Styling */
    .title-area {
        text-align: left !important;
        position: relative !important;
        padding-left: 24px !important;
        border-left: 3px solid transparent !important;
        border-image: linear-gradient(180deg, #3C72FC 0%, #E0009B 100%) 1 !important;
        margin-bottom: 40px !important;
    }
    .title-area.text-center, .title-area.text-xl-start, .title-area.text-center.mb-40 {
        text-align: left !important;
    }
    .title-area .sub-title {
        margin-left: 0 !important;
        margin-right: auto !important;
        display: inline-flex !important;
    }
    </style>

<?php include 'footer.php'; ?>
