<?php 
require_once 'db.php'; 

// Fetch specific blog details
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$blog = null;

if ($id > 0) {
    try {
        $stmt = $db->prepare("SELECT * FROM blogs WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $blog = null;
    }
}

// Redirect if blog doesn't exist
if (!$blog) {
    header("Location: blog.php");
    exit;
}

$pageTitle = htmlspecialchars($blog['title']) . " | Threat Intelligence | Advert Resource Ltd";
$pageDesc = "Read our latest cyber security insights on " . htmlspecialchars($blog['title']) . " by Advert Resource Ltd.";
$pageKeywords = "cyber security blog, threat intelligence, security updates, Advert Resource Ltd";
include 'header.php'; 
?>

<!-- Scoped CSS for Blog Details Page -->
<style>
.blog-detail-layout {
    background-color: #050B18;
    color: #cbd5e1;
    font-family: 'Kumbh Sans', sans-serif;
    position: relative;
    padding-bottom: 120px;
    overflow: hidden;
}

.blog-detail-cyber-grid {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: 
        linear-gradient(rgba(37, 99, 235, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37, 99, 235, 0.03) 1px, transparent 1px);
    background-size: 50px 50px;
    z-index: 0;
    pointer-events: none;
}

.detail-container {
    position: relative;
    z-index: 2;
    padding-top: 140px;
}

/* Back Link Button */
.back-to-blogs {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 30px;
    transition: color 0.3s;
}

.back-to-blogs:hover {
    color: #E0009B;
}

/* Article Hero Banner */
.article-banner-wrap {
    height: 450px;
    border-radius: 24px;
    overflow: hidden;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
    margin-bottom: 40px;
}

.article-banner-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.article-category {
    position: absolute;
    top: 25px;
    left: 25px;
    padding: 6px 16px;
    background: rgba(5, 11, 24, 0.85);
    border: 1px solid rgba(224, 0, 155, 0.5);
    color: #ffffff;
    font-size: 0.8rem;
    font-weight: 700;
    border-radius: 8px;
    text-transform: uppercase;
    backdrop-filter: blur(5px);
}

/* Glass Article Container */
.article-glass-body {
    background: rgba(15, 23, 42, 0.55);
    border: 1px solid rgba(255, 255, 255, 0.06);
    border-radius: 24px;
    padding: 50px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(12px);
}

.article-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 2.6rem;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.3;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #ffffff 40%, #E0009B 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.article-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    padding-bottom: 25px;
    margin-bottom: 35px;
    font-size: 0.9rem;
    color: #94a3b8;
}

.article-meta span i {
    color: #E0009B;
    margin-right: 8px;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.9;
    color: #cbd5e1;
}

.article-content p {
    margin-bottom: 24px;
}

/* Responsive Scaling */
@media (max-width: 768px) {
    .article-glass-body {
        padding: 30px 20px;
    }
    .article-title {
        font-size: 1.8rem;
    }
    .article-banner-wrap {
        height: 280px;
    }
}
</style>

<div class="blog-detail-layout">
    <div class="blog-detail-cyber-grid"></div>
    
    <div class="container detail-container">
        <!-- Back Navigation -->
        <a href="blog.php" class="back-to-blogs">
            <i class="far fa-arrow-left"></i> Return to Intelligence Center
        </a>
        
        <!-- Large Banner Image -->
        <div class="article-banner-wrap">
            <img src="<?php echo htmlspecialchars($blog['image'] ?: 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&q=80&w=800'); ?>" alt="Cover">
            <span class="article-category"><?php echo htmlspecialchars($blog['category'] ?: 'Security'); ?></span>
        </div>
        
        <!-- Glass Article Body -->
        <div class="article-glass-body">
            <h1 class="article-title"><?php echo htmlspecialchars($blog['title']); ?></h1>
            
            <div class="article-meta">
                <span><i class="far fa-user-shield"></i> Published by: <strong><?php echo htmlspecialchars($blog['author'] ?: 'IR Command'); ?></strong></span>
                <span><i class="far fa-calendar-alt"></i> Date: <strong><?php echo date('F d, Y', strtotime($blog['date_created'])); ?></strong></span>
                <span><i class="far fa-folder-open"></i> Classification: <strong>CONFIDENTIAL / UNRESTRICTED</strong></span>
            </div>
            
            <div class="article-content">
                <?php echo '<p>' . str_replace("\n", '</p><p>', htmlspecialchars($blog['content'])) . '</p>'; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
