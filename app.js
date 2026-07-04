/*
  Advert Resource Ltd - App Logic
  Handles telemetry terminal simulation, tab logic, and intersection reveals.
*/

document.addEventListener('DOMContentLoaded', () => {

    // 1. Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    if(menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
            navLinks.style.flexDirection = 'column';
            navLinks.style.position = 'absolute';
            navLinks.style.top = '80px';
            navLinks.style.left = '0';
            navLinks.style.width = '100%';
            navLinks.style.background = 'var(--bg-surface)';
            navLinks.style.padding = '2rem';
            navLinks.style.borderBottom = '1px solid var(--border-color)';
        });
    }

    // 2. Intersection Observer for simple Fade-In (Not glowing tilt)
    const revealElements = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    revealElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        revealObserver.observe(el);
    });

    // 3. Tab Navigation Logic for Services Page (if applicable)
    const tabs = document.querySelectorAll('.service-tab');
    const panes = document.querySelectorAll('.service-pane');
    
    if(tabs.length > 0 && panes.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.getAttribute('data-target');
                
                tabs.forEach(t => t.classList.remove('active'));
                panes.forEach(p => p.classList.remove('active'));
                
                tab.classList.add('active');
                document.getElementById(target).classList.add('active');
            });
        });
    }

    // 4. Telemetry Terminal Simulation (Signature Element)
    const telBody = document.getElementById('telemetry-body');
    if(telBody) {
        const logs = [
            { text: "System initialized. Binding to port 443...", type: "normal" },
            { text: "Establishing secure connection to telemetry server...", type: "normal" },
            { text: "Connection verified. TLS 1.3 active.", type: "success" },
            { text: "Monitoring inbound traffic patterns across 4 nodes.", type: "normal" },
            { text: "Anomaly detected: outbound traffic spike — node UK-LDN-04", type: "alert" },
            { text: "Isolating node UK-LDN-04 in sandbox container.", type: "normal" },
            { text: "Running heuristic analysis on suspicious payload...", type: "normal" },
            { text: "Patch verified: CVE-2026-3849 — remediated.", type: "success" },
            { text: "Node restored. Traffic normalized.", type: "success" },
            { text: "Awaiting incoming connections...", type: "normal" }
        ];

        let currentLogIndex = 0;
        
        function addLogLine() {
            if(currentLogIndex >= logs.length) currentLogIndex = 0; // Loop logs
            
            const log = logs[currentLogIndex];
            const time = new Date().toISOString().split('T')[1].substring(0, 12);
            
            const line = document.createElement('div');
            line.className = 'log-line';
            
            let colorClass = '';
            if(log.type === 'alert') colorClass = 'log-alert';
            if(log.type === 'success') colorClass = 'log-success';
            
            line.innerHTML = `<span class="log-timestamp">[${time}]</span> <span class="${colorClass}">${log.text}</span>`;
            
            // Remove cursor from previous line if exists
            const prevCursor = telBody.querySelector('.cursor-blink');
            if(prevCursor) prevCursor.remove();
            
            // Add cursor to new line
            line.innerHTML += '<span class="cursor-blink"></span>';
            
            telBody.appendChild(line);
            
            // Auto scroll
            telBody.scrollTop = telBody.scrollHeight;
            
            // Keep only last 10 lines
            if(telBody.children.length > 10) {
                telBody.removeChild(telBody.firstChild);
            }
            
            currentLogIndex++;
            
            // Random delay for next line
            const delay = Math.random() * 2000 + 500; // 0.5s to 2.5s
            setTimeout(addLogLine, delay);
        }

        // Start terminal
        setTimeout(addLogLine, 1000);
    }
});
