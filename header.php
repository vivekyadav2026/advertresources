<?php require_once 'db.php'; 
// Default SEO values if not set by the page
$pageTitle = isset($pageTitle) ? $pageTitle : "Advert Resource Ltd | Elite Cyber Security Services";
$pageDesc = isset($pageDesc) ? $pageDesc : "Advert Resource Ltd provides advanced threat detection, incident response, network security, and compliance solutions for high-risk digital environments.";
$pageKeywords = isset($pageKeywords) ? $pageKeywords : "cyber security, network security, zero trust, advanced threat detection, SOC, penetration testing, compliance";
?>
<!doctype html>
<!-- saved from url=(0033)index.html -->
<html class="no-js" lang="zxx">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="author" content="Advert Resource Ltd" />
    <meta name="description" content="<?php echo htmlspecialchars($pageDesc); ?>" />
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords); ?>" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta
      name="viewport"
      content="width=device-width,initial-scale=1,shrink-to-fit=no"
    />
    <link
      rel="apple-touch-icon"
      sizes="57x57"
      href="index.htmlassets/img/favicons/apple-icon-57x57.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="60x60"
      href="index.htmlassets/img/favicons/apple-icon-60x60.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="72x72"
      href="index.htmlassets/img/favicons/apple-icon-72x72.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="index.htmlassets/img/favicons/apple-icon-76x76.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="114x114"
      href="index.htmlassets/img/favicons/apple-icon-114x114.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="120x120"
      href="index.htmlassets/img/favicons/apple-icon-120x120.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="144x144"
      href="index.htmlassets/img/favicons/apple-icon-144x144.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="152x152"
      href="index.htmlassets/img/favicons/apple-icon-152x152.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="index.htmlassets/img/favicons/apple-icon-180x180.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="192x192"
      href="index.htmlassets/img/favicons/android-icon-192x192.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="index.htmlassets/img/favicons/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="96x96"
      href="index.htmlassets/img/favicons/favicon-96x96.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="index.htmlassets/img/favicons/favicon-16x16.png"
    />
    <link rel="manifest" href="index.htmlassets/img/favicons/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta
      name="msapplication-TileImage"
      content="assets/img/favicons/ms-icon-144x144.png"
    />
    <meta name="theme-color" content="#ffffff" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link href="./index/css2" rel="stylesheet" />
    <link rel="stylesheet" href="./index/app.min.css" />
    <link rel="stylesheet" href="./index/fontawesome.min.css" />
    <link rel="stylesheet" href="./index/style.css" />
    <style>
      /* Services Dropdown 2-Column Layout Override */
      @media (min-width: 992px) {
          .main-menu ul li ul.sub-menu.services-two-column-menu {
              width: 580px !important;
              display: flex !important;
              flex-wrap: wrap !important;
              padding: 20px 10px !important;
              background: #090f1d !important;
              border: 1px solid rgba(224, 0, 155, 0.2) !important;
              box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6) !important;
              border-radius: 12px !important;
          }
          .main-menu ul li ul.sub-menu.services-two-column-menu li {
              width: 50% !important;
              float: none !important;
              display: inline-block !important;
              border: none !important;
          }
          .main-menu ul li ul.sub-menu.services-two-column-menu li a {
              padding: 8px 20px !important;
              font-weight: 500 !important;
              color: #cbd5e1 !important;
              font-size: 0.9rem !important;
              transition: all 0.3s !important;
              display: block !important;
          }
          .main-menu ul li ul.sub-menu.services-two-column-menu li a:hover {
              color: #E0009B !important;
              background: rgba(224, 0, 155, 0.05) !important;
              border-radius: 6px !important;
              padding-left: 25px !important;
          }
      }

      /* ==========================================================================
         MOBILE NATIVE APP-LIKE EXPERIENCE OVERRIDES
         ========================================================================== */
      @media (max-width: 767px) {
          /* 1. Reset Body for App Feel */
          body {
              overscroll-behavior-y: none !important;
              -webkit-tap-highlight-color: transparent !important;
              -webkit-touch-callout: none !important;
              /* Prevent horizontal scroll on mobile */
              overflow-x: hidden !important;
              width: 100vw !important;
              /* Pad bottom so the bottom nav doesn't cover content */
              padding-bottom: 70px !important;
          }

          /* 2. Fluid Typography for Mobile (App Scaling) */
          h1, .h1 { font-size: clamp(2rem, 8vw, 2.5rem) !important; line-height: 1.2 !important; }
          h2, .h2 { font-size: clamp(1.75rem, 6vw, 2.1rem) !important; line-height: 1.2 !important; }
          h3, .h3 { font-size: clamp(1.5rem, 5vw, 1.8rem) !important; line-height: 1.3 !important; }
          p, .sec-text { font-size: 1rem !important; line-height: 1.5 !important; }

          /* 3. Increase Touch Targets for Accessibility (Min 44px) */
          .ot-btn, .btn, button, .main-menu a, .footer-menu a, .sub-menu a, .app-bottom-nav a {
              min-height: 44px !important;
              display: flex !important;
              align-items: center !important;
              justify-content: center !important;
          }

          /* Keep normal inline links as is, but block-level links get touch targets */
          a.ot-btn {
              display: inline-flex !important;
          }

          /* 4. Remove excessive margins/paddings */
          .space, .space-top, .space-bottom {
              padding-top: 60px !important;
              padding-bottom: 60px !important;
          }
          
          .container {
              padding-left: 20px !important;
              padding-right: 20px !important;
          }

          /* 5. Hide elements not needed on Mobile App View */
          .popup-search-box { display: none !important; }
          
          /* Force hide default footer margins if they interfere with app bar */
          .footer-wrapper { margin-bottom: 0 !important; }
          
          /* 6. Homepage Banner & Section Tightening (App Feed Look) */
          .ot-hero-wrapper, .hero-2, .hero-premium {
              /* padding-top: 100px !important; give space for mobile header */
              padding-bottom: 40px !important;
              min-height: auto !important;
              overflow-x: hidden !important; /* contain the wide canvas */
              width: 100vw !important;
          }
          
          /* Force the giant wave canvas to scale down and not break the viewport */
          .waves canvas {
              width: 100% !important;
              height: auto !important;
              object-fit: cover !important;
              opacity: 0.5 !important;
          }
          
          .hero-bg-line1 {
              display: none !important; /* Disable wide background lines causing scroll */
          }
          
          .hero-title, .hero-style2 h1 {
              font-size: clamp(2.2rem, 8vw, 2.8rem) !important;
              margin-bottom: 12px !important;
              line-height: 1.1 !important;
          }
          
          .hero-text, .hero-style2 p {
              margin-bottom: 20px !important;
              font-size: 0.95rem !important;
          }
          
          /* Button stacking & refinement on banner */
          .btn-wrap {
              flex-direction: column !important;
              gap: 15px !important;
              width: 100% !important;
              padding: 0 20px !important;
          }
          
          .btn-wrap a.ot-btn {
              width: 100% !important;
              justify-content: center !important;
              border-radius: 12px !important;
              background: linear-gradient(135deg, #2563eb, #7c3aed) !important;
              border: none !important;
              box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3) !important;
          }
          
          .btn-wrap a.video-btn-wrap {
              width: 100% !important;
              justify-content: center !important;
              border-radius: 12px !important;
              background: rgba(255, 255, 255, 0.05) !important;
              border: 1px solid rgba(255, 255, 255, 0.1) !important;
              color: #ffffff !important;
              padding: 12px 20px !important;
              margin: 0 !important;
              backdrop-filter: blur(5px) !important;
          }
          
          .btn-wrap a.video-btn-wrap:hover {
              background: rgba(255, 255, 255, 0.1) !important;
          }
          
          .btn-wrap a.video-btn-wrap .play-btn {
              width: 32px !important;
              height: 32px !important;
              font-size: 0.8rem !important;
              margin-right: 12px !important;
              background: #fff !important;
              color: #2563eb !important;
              box-shadow: 0 0 15px rgba(255,255,255,0.3) !important;
          }
          
          /* Hero Background Polish */
          .hero-2 {
              background: linear-gradient(135deg, #050B18 0%, #0a1128 100%) !important;
              position: relative;
          }
          .hero-2::before {
              content: '';
              position: absolute;
              top: 0; left: 0; right: 0; bottom: 0;
              background: radial-gradient(circle at center, rgba(37,99,235,0.15) 0%, transparent 70%);
              pointer-events: none;
          }
          
          /* Feature Cards (App Card styling) */
          .feature-area-1 {
              padding-top: 20px !important;
              margin-top: -20px !important;
          }
          
          .feature-card {
              padding: 25px 20px !important;
              margin-bottom: 5px !important;
              border-radius: 20px !important;
              background: rgba(15, 23, 42, 0.7) !important;
              backdrop-filter: blur(10px) !important;
          }
          
          /* Tighten standard rows to reduce scrolling gaps */
          .row.gy-30, .row.gy-4, .row.gy-40 {
              --bs-gutter-y: 15px !important;
          }
      }
    </style>
  </head>
  <body>
    <div class="ot-menu-wrapper">
      <div class="ot-menu-area text-center">
        <button class="ot-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
          <a href="index.php"><img src="./index/logo.svg" alt="Advert Resource Ltd" style="max-height: 40px;" /></a>
        </div>
        <div class="ot-mobile-menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about-us.php">About us</a></li>
            <li class="menu-item-has-children ot-item-has-children">
              <a href="services.php">Services<span class="ot-mean-expand"></span></a>
              <ul class="sub-menu ot-submenu" style="display: none">
                <li><a href="services-application-security.php">Application Security</a></li>
                <li><a href="services-network-security.php">Network Security</a></li>
                <li><a href="services-compliance-and-data-privacy.php">Compliance & Privacy</a></li>
                <li><a href="services-red-team.php">Red Team Assessment</a></li>
                <li><a href="services-digital-forensics.php">Digital Forensics</a></li>
                <li><a href="services-managed-security.php">Managed Security (SOC)</a></li>
                <li><a href="advanced-threat-detection.php">Advanced Threat Detection</a></li>
                <li><a href="robust-data-protection.php">Robust Data Protection</a></li>
                <li><a href="security-monitoring.php">Security Monitoring</a></li>
                <li><a href="services-access-broker.php">Access Broker Security</a></li>
                <li><a href="services-cloud-posture.php">Cloud Posture Control</a></li>
                <li><a href="services-endpoint-response.php">Endpoint Response</a></li>
                <li><a href="services-workload-protection.php">Workload Protection</a></li>
              </ul>
            </li>
            <li><a href="careers.php">Careers</a></li>
            <li><a href="contact-us.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="sidemenu-wrapper sidemenu-info">
      <div class="sidemenu-content">
        <button class="closeButton sideMenuCls">
          <i class="far fa-times"></i>
        </button>
        <div class="widget">
          <div class="ot-widget-about">
            <div class="about-logo">
              <a href="index.php"
                ><img src="./index/logo.svg" alt="Advert Resource Ltd" style="max-height: 45px;"
              /></a>
            </div>
            <p class="about-text">
              An IT consultancy can help you assess your technology needs and
              develop a technology strategy that aligns with your business
            </p>

          </div>
        </div>
        <div
          class="widget widget_contact_info"
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
          <h3 class="widget_title">Need Any Help?</h3>
          <p></p>
          <div class="ot-widget-contact">
            <div class="info-box">
              <div class="box-icon"><i class="far fa-map-marker-alt"></i></div>
              <div class="media-body">
                <h3 class="box-title">Location</h3>
                <p class="box-text">
                  <?php echo htmlspecialchars(getSetting('address', 'London, United Kingdom')); ?>
                </p>
              </div>
            </div>
            <div class="info-box">
              <div class="box-icon"><i class="far fa-envelope"></i></div>
              <div class="media-body">
                <h3 class="box-title">Email</h3>
                <?php 
                $email1 = getSetting('email1');
                $email2 = getSetting('email2', 'contact-us@advertresources.com');
                if (!empty($email1)): 
                ?>
                <a class="box-link" href="mailto:<?php echo htmlspecialchars($email1); ?>"
                  ><?php echo htmlspecialchars($email1); ?>,</a
                >
                <?php endif; ?>
                <a class="box-link" href="mailto:<?php echo htmlspecialchars($email2); ?>"
                  ><?php echo htmlspecialchars($email2); ?></a
                >
              </div>
            </div>
          </div>
        </div>
        <div class="widget">
          <h3 class="widget_title">Newsletter</h3>
          <div class="newsletter-widget">
            <p class="footer-text">
              Sign up to searing weekly newsletter to get the latest updates
              from us.
            </p>
            <form action="index.php#" class="newsletter-form">
              <div class="form-group">
                <input
                  class="form-control"
                  type="email"
                  placeholder="Enter Email Address"
                  required=""
                />
              </div>
              <button type="submit" class="icon-btn">
                <i class="fal fa-paper-plane"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <header class="ot-header header-layout2">
      <div class="header-top">
        <div class="container">
          <div
            class="row justify-content-xl-between justify-content-center align-items-center gy-2"
          >
            <div class="col-auto">
              <div class="header-links">
                <ul>
                  <li>
                    <i class="far fa-home"></i>Welcome to
                    <a href="index.php">Advert Resource Ltd.</a> Need Help?
                    <a class="line-btn" href="contact-us.php">Get in Touch</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-auto d-none d-xl-block">
              <div class="header-links">
                <ul>
                  <li>
                    <i class="fal fa-envelope"></i>
                    <a href="mailto:<?php echo htmlspecialchars(getSetting('email2', 'contact-us@advertresources.com')); ?>"><?php echo htmlspecialchars(getSetting('email2', 'contact-us@advertresources.com')); ?></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="sticky-wrapper">
        <div class="menu-area">
          <div class="container">
            <div class="row align-items-center justify-content-between">
              <div class="col-auto">
                <div class="header-logo">
                  <a href="index.php"
                    ><img src="./index/logo.svg" alt="Advert Resource Ltd" style="max-height: 50px;"
                  /></a>
                </div>
              </div>
              <div class="col-auto">
                <nav class="main-menu d-none d-lg-inline-block">
                  <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about-us.php">About us</a></li>
                    <li class="menu-item-has-children">
                      <a href="services.php">Services</a>
                      <ul class="sub-menu services-two-column-menu">
                        <li><a href="services-application-security.php">Application Security</a></li>
                        <li><a href="services-network-security.php">Network Security</a></li>
                        <li><a href="services-compliance-and-data-privacy.php">Compliance & Privacy</a></li>
                        <li><a href="services-red-team.php">Red Team Assessment</a></li>
                        <li><a href="services-digital-forensics.php">Digital Forensics</a></li>
                        <li><a href="services-managed-security.php">Managed Security (SOC)</a></li>
                        <li><a href="advanced-threat-detection.php">Advanced Threat Detection</a></li>
                        <li><a href="robust-data-protection.php">Robust Data Protection</a></li>
                        <li><a href="security-monitoring.php">Security Monitoring</a></li>
                        <li><a href="services-access-broker.php">Access Broker Security</a></li>
                        <li><a href="services-cloud-posture.php">Cloud Posture Control</a></li>
                        <li><a href="services-endpoint-response.php">Endpoint Response</a></li>
                        <li><a href="services-workload-protection.php">Workload Protection</a></li>
                      </ul>
                    </li>
                    <li><a href="careers.php">Careers</a></li>
                    <li><a href="contact-us.php">Contact Us</a></li>
                  </ul>
                </nav>
              </div>
              <div class="col-auto">
                <div class="header-button">
                  <div class="dropdown-link">
                    <a
                      class="dropdown-toggle icon-btn"
                      href="index.php#"
                      role="button"
                      id="dropdownMenuLink1"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                      ><i class="fal fa-globe"></i
                    ></a>
                    <ul
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuLink1"
                    >
                      <li>
                        <a href="index.php#">German</a>
                        <a href="index.php#">French</a>
                        <a href="index.php#">Italian</a>
                        <a href="index.php#">Latvian</a>
                        <a href="index.php#">Spanish</a>
                        <a href="index.php#">Greek</a>
                      </li>
                    </ul>
                  </div>

                  <button
                    type="button"
                    class="ot-menu-toggle d-block d-lg-none"
                  >
                    <i class="far fa-bars"></i>
                  </button>
                  <a href="contact-us.php" class="ot-btn d-none d-xl-flex"
                    >Get Consultation<i class="far fa-long-arrow-right ms-2"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

