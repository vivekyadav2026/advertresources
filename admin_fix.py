with open(r'c:\xampp\htdocs\advertresources\admin\index.php', 'r', encoding='utf-8') as f:
    content = f.read()

target_php = """    $edit_career = null;
    if (isset($_GET['edit_career'])) {
        $eid = intval($_GET['edit_career']);
        $stmt = $db->prepare("SELECT * FROM careers WHERE id = :id");
        $stmt->execute([':id' => $eid]);
        $edit_career = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    $enquiries = []; $careers = []; $applications = []; $blogs = []; $gallery = []; $edit_career = null;
}"""

replacement_php = """} catch (Exception $e) {
    $enquiries = []; $careers = []; $applications = []; $blogs = []; $gallery = [];
}"""

content = content.replace(target_php, replacement_php)

target_html = """        <!-- SECTION 3: MANAGE CAREERS -->
        <div id="tab-careers" class="tab-section">
            <!-- Add / Edit Form -->
            <div class="row gy-4 mb-4">
                <div class="col-lg-5">
                    <div class="glass-panel">
                        <div class="panel-header">
                            <h2 id="careerFormTitle"><?= $edit_career ? 'Edit Job Listing' : 'Post New Job' ?></h2>
                        </div>
                        <form action="" method="POST" id="careerForm">
                            <input type="hidden" name="save_career" value="1">
                            <input type="hidden" name="career_id" id="career_id" value="<?= $edit_career ? $edit_career['id'] : 0 ?>">

                            <div class="form-group mb-3">
                                <label>Job Title *</label>
                                <input type="text" name="career_title" id="career_title" required placeholder="Senior Security Analyst" value="<?= $edit_career ? htmlspecialchars($edit_career['title']) : '' ?>">
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group">
                                    <label>Department</label>
                                    <input type="text" name="department" id="career_dept" placeholder="SOC / Red Team / Engineering" value="<?= $edit_career ? htmlspecialchars($edit_career['department']) : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" name="location" id="career_loc" placeholder="London / Remote" value="<?= $edit_career ? htmlspecialchars($edit_career['location']) : '' ?>">
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group">
                                    <label>Job Type</label>
                                    <select name="job_type" id="career_type" style="width:100%; padding:10px 14px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-size:0.9rem;">
                                        <option value="Full-Time" <?= ($edit_career && $edit_career['type']=='Full-Time') ? 'selected' : '' ?>>Full-Time</option>
                                        <option value="Part-Time" <?= ($edit_career && $edit_career['type']=='Part-Time') ? 'selected' : '' ?>>Part-Time</option>
                                        <option value="Contract" <?= ($edit_career && $edit_career['type']=='Contract') ? 'selected' : '' ?>>Contract</option>
                                        <option value="Remote" <?= ($edit_career && $edit_career['type']=='Remote') ? 'selected' : '' ?>>Remote</option>
                                        <option value="Internship" <?= ($edit_career && $edit_career['type']=='Internship') ? 'selected' : '' ?>>Internship</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Experience Level</label>
                                    <input type="text" name="experience" id="career_exp" placeholder="3+ Years / Senior / Mid" value="<?= $edit_career ? htmlspecialchars($edit_career['experience']) : '' ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Job Description *</label>
                                <textarea name="description" id="career_desc" rows="4" placeholder="Describe the role, responsibilities and goals..."><?= $edit_career ? htmlspecialchars($edit_career['description']) : '' ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Requirements</label>
                                <textarea name="requirements" id="career_req" rows="3" placeholder="Certifications, skills, qualifications..."><?= $edit_career ? htmlspecialchars($edit_career['requirements']) : '' ?></textarea>
                            </div>
                            <div class="form-group mb-4" style="display:flex; align-items:center; gap:12px;">
                                <input type="checkbox" name="is_active" id="is_active" value="1" <?= (!$edit_career || $edit_career['is_active']) ? 'checked' : '' ?> style="width:18px;height:18px;accent-color:#3C72FC;">
                                <label for="is_active" style="margin:0; font-size:0.85rem; color:#94a3b8;">Published (visible on careers page)</label>
                            </div>
                            <div style="display:flex; gap:10px;">
                                <button type="submit" class="btn-action" id="careerSubmitBtn"><?= $edit_career ? 'UPDATE JOB <i class="far fa-shield-check"></i>' : 'PUBLISH JOB <i class="far fa-paper-plane"></i>' ?></button>
                                <?php if ($edit_career): ?>
                                <a href="?" class="btn-action" style="background:rgba(255,255,255,0.05); box-shadow:none;">CANCEL</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Jobs List -->
                <div class="col-lg-7">
                    <div class="glass-panel">
                        <div class="panel-header">
                            <h2>Job Listings (<?= count($careers) ?>)</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="cyber-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($careers)): ?>
                                        <tr><td colspan="5" style="text-align:center;">No job listings yet. Post your first job!</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($careers as $job): ?>
                                        <tr>
                                            <td style="font-weight:700; color:#fff;"><?= htmlspecialchars($job['title']) ?></td>
                                            <td><?= htmlspecialchars($job['department'] ?: '-') ?></td>
                                            <td><span class="badge-tag"><?= htmlspecialchars($job['type']) ?></span></td>
                                            <td>
                                                <?php if ($job['is_active']): ?>
                                                    <span class="badge-tag" style="background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.3);color:#10b981;">Live</span>
                                                <?php else: ?>
                                                    <span class="badge-tag" style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.3);color:#ef4444;">Draft</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="?edit_career=<?= $job['id'] ?>" class="btn-view">Edit</a>
                                                <a href="?delete_career=<?= $job['id'] ?>" class="btn-delete" onclick="return confirm('Delete this job listing?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="glass-panel">
                <div class="panel-header">
                    <h2>Job Applications (<?= count($applications) ?>)</h2>
                </div>
                <div class="table-responsive">
                    <table class="cyber-table">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Applied For</th>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($applications)): ?>
                                <tr><td colspan="7" style="text-align:center;">No applications received yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($applications as $app): ?>
                                <tr>
                                    <td style="font-weight:700;color:#fff;"><?= htmlspecialchars($app['name']) ?></td>
                                    <td><?= htmlspecialchars($app['email']) ?></td>
                                    <td><?= htmlspecialchars($app['phone'] ?: '-') ?></td>
                                    <td><span class="badge-tag"><?= htmlspecialchars($app['job_title'] ?: 'Unknown') ?></span></td>
                                    <td><?= date('M d, Y', strtotime($app['applied_at'])) ?></td>
                                    <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($app['cover_message']) ?>"><?= htmlspecialchars(substr($app['cover_message'] ?: '-', 0, 60)) ?>...</td>
                                    <td><a href="?delete_application=<?= $app['id'] ?>" class="btn-delete" onclick="return confirm('Remove this application?')">Delete</a></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>"""

replacement_html = """        <!-- SECTION 3: MANAGE CAREERS -->
        <div id="tab-careers" class="tab-section">
            
            <!-- LIST VIEW -->
            <div id="career-list-view" style="display:block;">
                <div class="welcome-header mb-4" style="margin-bottom: 20px;">
                    <div class="welcome-title">
                        <h2 style="font-size:1.6rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">Careers Management</h2>
                        <p style="color:#94a3b8; font-size:0.9rem;">Manage job listings and view applications.</p>
                    </div>
                    <div>
                        <button type="button" onclick="showCareerForm()" class="btn-action">POST NEW JOB <i class="fas fa-plus ms-2"></i></button>
                    </div>
                </div>

                <div class="glass-panel mb-4">
                    <div class="panel-header">
                        <h2>Job Listings (<?= count($careers) ?>)</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="cyber-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Department</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($careers)): ?>
                                    <tr><td colspan="5" style="text-align:center;">No job listings yet. Post your first job!</td></tr>
                                <?php else: ?>
                                    <?php foreach ($careers as $job): ?>
                                    <tr>
                                        <td style="font-weight:700; color:#fff;"><?= htmlspecialchars($job['title']) ?></td>
                                        <td><?= htmlspecialchars($job['department'] ?: '-') ?></td>
                                        <td><span class="badge-tag"><?= htmlspecialchars($job['type']) ?></span></td>
                                        <td>
                                            <?php if ($job['is_active']): ?>
                                                <span class="badge-tag" style="background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.3);color:#10b981;">Live</span>
                                            <?php else: ?>
                                                <span class="badge-tag" style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.3);color:#ef4444;">Draft</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-view" onclick='editCareer(<?= json_encode($job, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>Edit</button>
                                            <a href="?delete_career=<?= $job['id'] ?>" class="btn-delete" onclick="return confirm('Delete this job listing?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Applications Table -->
                <div class="glass-panel">
                    <div class="panel-header">
                        <h2>Job Applications (<?= count($applications) ?>)</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="cyber-table">
                            <thead>
                                <tr>
                                    <th>Applicant</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Applied For</th>
                                    <th>Date</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($applications)): ?>
                                    <tr><td colspan="7" style="text-align:center;">No applications received yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($applications as $app): ?>
                                    <tr>
                                        <td style="font-weight:700;color:#fff;"><?= htmlspecialchars($app['name']) ?></td>
                                        <td><?= htmlspecialchars($app['email']) ?></td>
                                        <td><?= htmlspecialchars($app['phone'] ?: '-') ?></td>
                                        <td><span class="badge-tag"><?= htmlspecialchars($app['job_title'] ?: 'Unknown') ?></span></td>
                                        <td><?= date('M d, Y', strtotime($app['applied_at'])) ?></td>
                                        <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($app['cover_message']) ?>"><?= htmlspecialchars(substr($app['cover_message'] ?: '-', 0, 60)) ?>...</td>
                                        <td><a href="?delete_application=<?= $app['id'] ?>" class="btn-delete" onclick="return confirm('Remove this application?')">Delete</a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- FORM VIEW -->
            <div id="career-form-view" style="display:none;">
                <div class="welcome-header mb-4" style="margin-bottom: 20px;">
                    <div class="welcome-title">
                        <h2 id="careerFormTitle" style="font-size:1.6rem; color:#fff; font-weight:800; font-family: 'Space Grotesk', sans-serif;">Post New Job</h2>
                        <p style="color:#94a3b8; font-size:0.9rem;">Fill in the details for the new position.</p>
                    </div>
                    <div>
                        <button type="button" onclick="showCareerList()" class="btn-action" style="background:rgba(255,255,255,0.05); box-shadow:none; border:1px solid rgba(255,255,255,0.1);">&larr; BACK TO LIST</button>
                    </div>
                </div>

                <div class="glass-panel">
                    <form action="" method="POST" id="careerForm">
                        <input type="hidden" name="save_career" value="1">
                        <input type="hidden" name="career_id" id="career_id" value="0">

                        <div class="form-group mb-3">
                            <label>Job Title *</label>
                            <input type="text" name="career_title" id="career_title" required placeholder="Senior Security Analyst">
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" name="department" id="career_dept" placeholder="SOC / Red Team / Engineering">
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name="location" id="career_loc" placeholder="London / Remote">
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group">
                                <label>Job Type</label>
                                <select name="job_type" id="career_type" style="width:100%; padding:10px 14px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:8px; color:#fff; font-size:0.9rem;">
                                    <option value="Full-Time">Full-Time</option>
                                    <option value="Part-Time">Part-Time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Experience Level</label>
                                <input type="text" name="experience" id="career_exp" placeholder="3+ Years / Senior / Mid">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Job Description *</label>
                            <textarea name="description" id="career_desc" rows="4" placeholder="Describe the role, responsibilities and goals..."></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Requirements</label>
                            <textarea name="requirements" id="career_req" rows="3" placeholder="Certifications, skills, qualifications..."></textarea>
                        </div>
                        <div class="form-group mb-4" style="display:flex; align-items:center; gap:12px;">
                            <input type="checkbox" name="is_active" id="is_active" value="1" checked style="width:18px;height:18px;accent-color:#3C72FC;">
                            <label for="is_active" style="margin:0; font-size:0.85rem; color:#94a3b8;">Published (visible on careers page)</label>
                        </div>
                        <button type="submit" class="btn-action" id="careerSubmitBtn">PUBLISH JOB <i class="far fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>"""

content = content.replace(target_html, replacement_html)

js_code = """
        function showCareerList() {
            document.getElementById('career-list-view').style.display = 'block';
            document.getElementById('career-form-view').style.display = 'none';
        }
        
        function showCareerForm() {
            document.getElementById('career-list-view').style.display = 'none';
            document.getElementById('career-form-view').style.display = 'block';
            
            document.getElementById('career_id').value = "0";
            document.getElementById('careerForm').reset();
            document.getElementById('careerFormTitle').innerText = "Post New Job";
            document.getElementById('careerSubmitBtn').innerHTML = "PUBLISH JOB <i class='far fa-paper-plane'></i>";
        }
        
        function editCareer(job) {
            document.getElementById('career_id').value = job.id;
            document.getElementById('career_title').value = job.title;
            document.getElementById('career_dept').value = job.department || '';
            document.getElementById('career_loc').value = job.location || '';
            document.getElementById('career_type').value = job.type || 'Full-Time';
            document.getElementById('career_exp').value = job.experience || '';
            document.getElementById('career_desc').value = job.description || '';
            document.getElementById('career_req').value = job.requirements || '';
            document.getElementById('is_active').checked = job.is_active == 1;

            document.getElementById('careerFormTitle').innerText = "Edit Job Listing";
            document.getElementById('careerSubmitBtn').innerHTML = "UPDATE JOB <i class='far fa-shield-check'></i>";
            
            document.getElementById('career-list-view').style.display = 'none';
            document.getElementById('career-form-view').style.display = 'block';
        }
"""
content = content.replace("function switchTab(tabId, el) {", js_code + "\n        function switchTab(tabId, el) {")

with open(r'c:\xampp\htdocs\advertresources\admin\index.php', 'w', encoding='utf-8') as f:
    f.write(content)
print("Update successful!")
