<?php 
require_once 'db.php'; 
include 'header.php'; 

// Fetch all blogs
try {
    $stmt = $db->query("SELECT * FROM blogs ORDER BY date_created DESC");
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $blogs = [];
}
?>

<!-- Scoped CSS for Blog Page -->
<style>
.premium-blog-page {
    background-color: #050B18;
    color: #a9a9a9;
    font-family: 'Kumbh Sans', sans-serif;
    position: relative;
    overflow: hidden;
    padding-bottom: 120px;
}

/* Background Cyber Mesh */
.blog-cyber-grid {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: 
        linear-gradient(rgba(37, 99, 235, 0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37, 99, 235, 0.04) 1px, transparent 1px);
    background-size: 50px 50px;
    z-index: 0;
    pointer-events: none;
}

/* Hero Section */
.blog-hero {
    position: relative;
    padding: 120px 0 60px;
    z-index: 2;
    text-align: center;
}

.blog-hero .title-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    background: rgba(224, 0, 155, 0.08);
    border: 1px solid rgba(224, 0, 155, 0.25);
    border-radius: 30px;
    color: #E0009B;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 24px;
}

.blog-grid-sec {
    position: relative;
    z-index: 2;
}

/* Frosted Blog Card */
.blog-glass-card {
    background: rgba(15, 23, 42, 0.55);
    border: 1px solid rgba(255, 255, 255, 0.06);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(12px);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-glass-card:hover {
    transform: translateY(-8px);
    border-color: rgba(224, 0, 155, 0.35);
    box-shadow: 0 20px 45px rgba(224, 0, 155, 0.12);
}

.blog-img-wrap {
    height: 220px;
    overflow: hidden;
    position: relative;
}

.blog-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-glass-card:hover .blog-img-wrap img {
    transform: scale(1.08);
}

.blog-cat-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 4px 12px;
    background: rgba(5, 11, 24, 0.85);
    border: 1px solid rgba(224, 0, 155, 0.4);
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 6px;
    backdrop-filter: blur(5px);
}

.blog-body {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.blog-meta {
    font-size: 0.8rem;
    color: #8a99ad;
    margin-bottom: 12px;
    display: flex;
    gap: 15px;
}

.blog-meta span i {
    color: #E0009B;
    margin-right: 5px;
}

.blog-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.4;
    margin-bottom: 12px;
    font-family: 'Space Grotesk', sans-serif;
    transition: color 0.3s;
}

.blog-glass-card:hover .blog-title {
    color: #E0009B;
}

.blog-text {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #94a3b8;
    margin-bottom: 20px;
    flex-grow: 1;
}

.blog-read-btn {
    align-self: flex-start;
    color: #ffffff;
    background: linear-gradient(135deg, rgba(60, 114, 252, 0.1), rgba(224, 0, 155, 0.15));
    border: 1px solid rgba(224, 0, 155, 0.25);
    padding: 8px 18px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.blog-read-btn:hover {
    background: linear-gradient(135deg, #3C72FC, #E0009B);
    border-color: transparent;
    box-shadow: 0 5px 15px rgba(224, 0, 155, 0.4);
}

/* Modal Drawer Styling */
.blog-modal {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    z-index: 10000;
    background: rgba(5, 11, 24, 0.85);
    backdrop-filter: blur(15px);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.blog-modal-content {
    background: rgba(15, 23, 42, 0.95);
    border: 1px solid rgba(224, 0, 155, 0.3);
    border-radius: 24px;
    max-width: 800px;
    width: 100%;
    max-height: 85vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.8), 0 0 40px rgba(224, 0, 155, 0.15);
    position: relative;
}

.blog-modal-content::-webkit-scrollbar {
    width: 6px;
}
.blog-modal-content::-webkit-scrollbar-thumb {
    background: #E0009B;
    border-radius: 10px;
}

.modal-close-btn {
    position: absolute;
    top: 20px; right: 20px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #ffffff;
    width: 40px; height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 5;
}

.modal-close-btn:hover {
    background: #E0009B;
    border-color: transparent;
}

.modal-banner {
    height: 350px;
    width: 100%;
    position: relative;
}

.modal-banner img {
    width: 100%; height: 100%;
    object-fit: cover;
}

.modal-body {
    padding: 40px;
}

.modal-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 2rem;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 20px;
}

.modal-text {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #cbd5e1;
}
</style>

<div class="premium-blog-page">
    <div class="blog-cyber-grid"></div>
    
    <!-- Hero Area -->
    <div class="blog-hero">
        <div class="container">
            <span class="title-badge">
                <i class="fas fa-radar"></i> Threat intelligence
            </span>
            <h1 class="text-white" style="font-family: 'Space Grotesk', sans-serif; font-size: clamp(2rem, 6vw, 3.8rem); font-weight: 800; background: linear-gradient(135deg, #ffffff 40%, #E0009B 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Cyber Security Insights</h1>
            <p class="text-white-50 mx-auto" style="max-width: 600px; font-size: 1.15rem;">
                Stay updated with the latest threat briefs, security playbooks, and architectural updates governed by our Incident Response command.
            </p>
        </div>
    </div>

    <!-- Blog Grid -->
    <section class="blog-grid-sec">
        <div class="container">
            <div class="row gy-4">
                <?php if (empty($blogs)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-database fa-3x mb-3 text-white-50"></i>
                        <p class="text-white-50">No intelligence briefs indexed at this time. Check back later.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($blogs as $blog): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-glass-card">
                                <div class="blog-img-wrap">
                                    <img src="<?php echo htmlspecialchars($blog['image'] ?: 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&q=80&w=800'); ?>" alt="Cover">
                                    <span class="blog-cat-badge"><?php echo htmlspecialchars($blog['category'] ?: 'Security'); ?></span>
                                </div>
                                <div class="blog-body">
                                    <div class="blog-meta">
                                        <span><i class="far fa-user"></i> By <?php echo htmlspecialchars($blog['author'] ?: 'IR Team'); ?></span>
                                        <span><i class="far fa-calendar"></i> <?php echo date('M d, Y', strtotime($blog['date_created'])); ?></span>
                                    </div>
                                    <h4 class="blog-title"><?php echo htmlspecialchars($blog['title']); ?></h4>
                                    <p class="blog-text"><?php echo htmlspecialchars($blog['summary']); ?></p>
                                    
                                    <div class="d-flex gap-2">
                                        <button class="blog-read-btn" onclick="openBlogModal(<?php echo $blog['id']; ?>)">
                                            Quick View 
                                            <i class="far fa-eye"></i>
                                        </button>
                                        <a href="blog-details.php?id=<?php echo $blog['id']; ?>" class="blog-read-btn" style="background: rgba(224, 0, 155, 0.05); border-color: rgba(224, 0, 155, 0.25);">
                                            Read Page
                                            <i class="far fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<!-- Modal Overlay -->
<div id="blogDetailModal" class="blog-modal" onclick="closeBlogModalOnOverlay(event)">
    <div class="blog-modal-content">
        <button class="modal-close-btn" onclick="closeBlogModal()"><i class="fal fa-times"></i></button>
        <div class="modal-banner">
            <img id="modalImg" src="" alt="Banner">
        </div>
        <div class="modal-body">
            <span id="modalCat" style="color: #E0009B; text-transform: uppercase; font-size: 0.8rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 10px; display: inline-block;">Category</span>
            <h2 id="modalTitle" class="modal-title">Blog Title Here</h2>
            <div id="modalMeta" class="blog-meta mb-4" style="font-size: 0.85rem;">
                <span id="modalAuthor"><i class="far fa-user"></i> Author</span>
                <span id="modalDate"><i class="far fa-calendar"></i> Date</span>
            </div>
            <div id="modalContent" class="modal-text">
                Content goes here...
            </div>
        </div>
    </div>
</div>

<script>
// Pass php blogs array directly to javascript for fast client-side modal indexing
const indexedBlogs = <?php echo json_encode($blogs); ?>;

function openBlogModal(id) {
    const blog = indexedBlogs.find(b => b.id == id);
    if (!blog) return;
    
    document.getElementById('modalImg').src = blog.image || 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&q=80&w=800';
    document.getElementById('modalCat').innerText = blog.category || 'Security';
    document.getElementById('modalTitle').innerText = blog.title;
    document.getElementById('modalAuthor').innerHTML = '<i class="far fa-user"></i> By ' + (blog.author || 'IR Team');
    
    // Parse MySQL datetime format into local readable date
    const date = new Date(blog.date_created);
    const formattedDate = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    document.getElementById('modalDate').innerHTML = '<i class="far fa-calendar"></i> ' + formattedDate;
    
    document.getElementById('modalContent').innerHTML = '<p>' + blog.content.replace(/\n/g, '</p><p>') + '</p>';
    
    const modal = document.getElementById('blogDetailModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden'; // Lock background scrolling
}

function closeBlogModal() {
    const modal = document.getElementById('blogDetailModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto'; // Unlock background scrolling
}

function closeBlogModalOnOverlay(event) {
    if (event.target.id === 'blogDetailModal') {
        closeBlogModal();
    }
}
</script>

<?php include 'footer.php'; ?>
