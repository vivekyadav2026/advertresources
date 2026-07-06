<?php
try {
    $db = new PDO("sqlite:" . __DIR__ . "/database.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create Enquiries Table
    $db->exec("CREATE TABLE IF NOT EXISTS enquiries (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        company TEXT,
        phone TEXT,
        country TEXT,
        service TEXT,
        budget TEXT,
        message TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create Blogs Table
    $db->exec("CREATE TABLE IF NOT EXISTS blogs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        category TEXT,
        author TEXT,
        summary TEXT,
        content TEXT,
        image TEXT,
        date_created DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create Settings Table
    $db->exec("CREATE TABLE IF NOT EXISTS settings (
        key TEXT PRIMARY KEY,
        value TEXT
    )");
    
    // Create Gallery Table
    $db->exec("CREATE TABLE IF NOT EXISTS gallery (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        label TEXT,
        image TEXT,
        date_created DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create Careers Table
    $db->exec("CREATE TABLE IF NOT EXISTS careers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        department TEXT,
        location TEXT,
        type TEXT DEFAULT 'Full-Time',
        experience TEXT,
        description TEXT,
        requirements TEXT,
        is_active INTEGER DEFAULT 1,
        date_created DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Seed default settings if not exists
    $defaultSettings = [
        'address' => 'London, United Kingdom',
        'phone1' => '+165-5577-8749',
        'phone2' => '+165-3564-7488',
        'email1' => 'info@advertresources.com',
        'email2' => 'contact-us@advertresources.com',
        'hours' => 'Mon - Sat: 10.00 AM - 4.00 PM',
        'smtp_host' => 'smtp.gmail.com',
        'smtp_port' => '587',
        'smtp_user' => '',
        'smtp_pass' => '',
        'smtp_secure' => 'tls',
        'smtp_from_name' => 'Advert Resource Ltd'
    ];
    
    foreach ($defaultSettings as $key => $val) {
        $stmt = $db->prepare("INSERT OR IGNORE INTO settings (key, value) VALUES (:key, :val)");
        $stmt->execute([':key' => $key, ':val' => $val]);
    }
    
    // Seed default gallery if table is empty
    $galleryCount = $db->query("SELECT COUNT(*) FROM gallery")->fetchColumn();
    if ($galleryCount == 0) {
        $defaultGallery = [
            [
                'title' => 'Network Topology Schema',
                'label' => 'DIAG // 01 - Zero-Trust Segmented Architecture',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'SOC Global Dashboard',
                'label' => 'DIAG // 02 - Real-Time Threat Hunting Interface',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'Data Stream Encryption',
                'label' => 'DIAG // 03 - TLS 1.3 Payload Tunneling',
                'image' => 'https://images.unsplash.com/photo-1601597111158-2fceff270190?auto=format&fit=crop&q=80&w=800'
            ]
        ];
        
        foreach ($defaultGallery as $item) {
            $stmt = $db->prepare("INSERT INTO gallery (title, label, image) VALUES (:title, :label, :image)");
            $stmt->execute([
                ':title' => $item['title'],
                ':label' => $item['label'],
                ':image' => $item['image']
            ]);
        }
    }
    
    // Seed default blogs if table is empty
    $count = $db->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
    if ($count == 0) {
        $defaultBlogs = [
            [
                'title' => 'Zero-Trust Lifecycle: Orchestrating Perimeter Eviction',
                'category' => 'Threat Intel',
                'author' => 'Elias Vance',
                'summary' => 'An architectural breakdown of zero-trust verification pipelines, lateral movement containment, and automated eviction protocols.',
                'content' => 'The concept of network perimeters is dead. Modern enterprise defense relies entirely on continuous verification and automated response. This article details our framework for dividing traditional enterprise flat networks into cryptographically sealed zones, microsegmenting host groups, and setting up eviction event hooks that instantly terminate unauthorized user sessions.',
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'Heuristic Threat Modeling: Bypassing Legacy Blacklists',
                'category' => 'Cyber Defense',
                'author' => 'Sarah Croft',
                'summary' => 'Why static file hashes are failing to block zero-day payloads, and how behavioral analytics isolate malicious execution chains.',
                'content' => 'Static antivirus systems search for predefined patterns (signatures) to block malware. When an attacker modifies a single byte, the hash changes, bypassing legacy blacklists. Behavioral modeling solves this by analyzing live actions: if a spreadsheet process attempts to spawn PowerShell to download an executable, our heuristics intervene immediately, stopping lateral movement.',
                'image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'Ransomware Eviction: Automated Containment Playbook',
                'category' => 'Incident Response',
                'author' => 'Marcus Thorne',
                'summary' => 'A playbook detailing live containment protocols, credential revocation, and sandbox detonation under active compromise.',
                'content' => 'When a network experiences an active compromise, every second counts. Legacy response playbooks require manual analysis. Our Incident Response team automates key steps: instantly isolating affected hosts via software-defined firewalls, revoking active session keys in active directory, and executing memory forensics in cloud sandboxes to prevent ransomware encryption.',
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=800'
            ]
        ];
        
        foreach ($defaultBlogs as $blog) {
            $stmt = $db->prepare("INSERT INTO blogs (title, category, author, summary, content, image) VALUES (:title, :category, :author, :summary, :content, :image)");
            $stmt->execute([
                ':title' => $blog['title'],
                ':category' => $blog['category'],
                ':author' => $blog['author'],
                ':summary' => $blog['summary'],
                ':content' => $blog['content'],
                ':image' => $blog['image']
            ]);
        }
    }
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// Helper to get settings
function getSetting($key, $default = '') {
    global $db;
    try {
        $stmt = $db->prepare("SELECT value FROM settings WHERE key = :key");
        $stmt->execute([':key' => $key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['value'] : $default;
    } catch (Exception $e) {
        return $default;
    }
}
?>
