<?php

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    die("Unauthorized access");
}

// =========================
// GET FREELANCER
// =========================
$freelancer_q = mysqli_query($conn, "SELECT id FROM freelancer_profiles WHERE user_id = $user_id");
$freelancer = mysqli_fetch_assoc($freelancer_q);

if (!$freelancer) {
    die("You are not registered as a freelancer.");
}

$freelancer_id = $freelancer['id'];

// =========================
// CREATE / UPDATE
// =========================
if (isset($_POST['save_gig'])) {

    $gig_id = $_POST['gig_id'] ?? null;
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $description = mysqli_real_escape_string($conn, trim($_POST['description']));
    $category_id = (int) $_POST['category_id'];
    $price = (float) $_POST['price'];
    $delivery_time = (int) $_POST['delivery_time'];
    $revisions = (int) $_POST['revisions'];

    if (!$title || !$description || !$category_id || !$price || !$delivery_time) {
        die("Fill all required fields.");
    }

    if ($gig_id) {
        mysqli_query($conn, "
            UPDATE gigs SET
            title='$title',
            description='$description',
            category_id=$category_id,
            price=$price,
            delivery_time=$delivery_time,
            revisions=$revisions
            WHERE id=$gig_id AND freelancer_id=$freelancer_id
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO gigs
            (freelancer_id, category_id, title, description, price, delivery_time, revisions, status)
            VALUES
            ($freelancer_id, $category_id, '$title', '$description', $price, $delivery_time, $revisions, 'active')
        ");

        $gig_id = mysqli_insert_id($conn);
    }

    // =========================
    // IMAGE UPLOAD
    // =========================
    if (!empty($_FILES['gig_image']['name'])) {
        $upload_dir = __DIR__ . "/../uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $ext = strtolower(pathinfo($_FILES['gig_image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($ext, $allowed) && $_FILES['gig_image']['size'] <= 2 * 1024 * 1024) {
            $filename = time() . '_' . uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['gig_image']['tmp_name'], $upload_dir . $filename);
            $check = mysqli_query($conn, "SELECT id FROM gig_images WHERE gig_id=$gig_id");
            if (mysqli_num_rows($check)) {
                mysqli_query($conn, "UPDATE gig_images SET image_url='$filename' WHERE gig_id=$gig_id");
            } else {
                mysqli_query($conn, "INSERT INTO gig_images (gig_id, image_url) VALUES ($gig_id,'$filename')");
            }
        }
    }
}

// =========================
// ACTIONS
// =========================
if (isset($_POST['delete_gig'])) {
    $id = (int)$_POST['gig_id'];
    mysqli_query($conn, "DELETE FROM gig_images WHERE gig_id=$id");
    mysqli_query($conn, "DELETE FROM gigs WHERE id=$id");
}

if (isset($_POST['pause_gig'])) {
    mysqli_query($conn, "UPDATE gigs SET status='paused' WHERE id=" . $_POST['gig_id']);
}

if (isset($_POST['activate_gig'])) {
    mysqli_query($conn, "UPDATE gigs SET status='active' WHERE id=" . $_POST['gig_id']);
}

// =========================
// FETCH DATA
// =========================
$gigs = mysqli_query($conn, "SELECT * FROM gigs WHERE freelancer_id=$freelancer_id ORDER BY created_at DESC");
$categories = mysqli_query($conn, "SELECT * FROM categories");
?>
<div class="gigs-panel-layout">
    <div class="gig-form">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="gig_id" id="gig_id">
            <h3 id="formTitle">Create Gig</h3>
            <input type="text" id="title" name="title" placeholder="Gig Title" required>
            <select id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                <?php mysqli_data_seek($categories, 0);
                while ($c = mysqli_fetch_assoc($categories)): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                <?php endwhile; ?>
            </select>
            <input type="number" id="price" name="price" placeholder="Price" required step="0.01">
            <input type="number" id="delivery_time" name="delivery_time" placeholder="Delivery Days" required>
            <input type="number" id="revisions" name="revisions" placeholder="Revisions">

            <textarea id="description" name="description" placeholder="Description" required></textarea>

            <label class="upload-box">
                <input type="file" id="gigImage" name="gig_image" hidden accept="image/*">
                <div class="upload-content">
                    <p class="image-upload-btn"> 📷 Click to upload image (Max 2MB)</p>
                </div>
            </label>
            <div class="preview-box">
                <img id="previewImg" src="gig_default.png" alt="Preview">
            </div>
            <button name="save_gig" class="btn primary full">Publish Gig</button>
        </form>
    </div>

    <!-- ================= GIG LIST ================= -->
    <div class="gigs-grid">
        <?php while ($g = mysqli_fetch_assoc($gigs)):
            $img_q = mysqli_query($conn, "SELECT image_url FROM gig_images WHERE gig_id=" . $g['id'] . " LIMIT 1");
            $img = mysqli_fetch_assoc($img_q);
            $image = "gig_default.png";
            if ($img && $img['image_url']) {
                $image = "uploads/" . $img['image_url'];
            }

            // Truncate description
            $short_desc = strlen($g['description']) > 120 ? substr($g['description'], 0, 120) . '...' : $g['description'];
        ?>
            <div class="gig-card">
                <img src="<?= $image ?>" alt="<?= htmlspecialchars($g['title']) ?>">
                <div class="gig-body">
                    <div class="gig-header">
                        <h4><?= htmlspecialchars($g['title']) ?></h4>
                        <div class="gig-status status-<?= $g['status'] ?>">
                            <?= ucfirst($g['status']) ?>
                        </div>
                    </div>
                    <div class="gig-price">$<?= number_format($g['price'], 2) ?></div>
                    <p class="gig-description"><?= htmlspecialchars($short_desc) ?></p>
                    <div class="gig-meta">
                        <small>Delivery: <?= $g['delivery_time'] ?> days</small>
                        <small>Revisions: <?= $g['revisions'] ?></small>
                    </div>
                </div>
                <div class="gig-actions">
                    <button class="gig-btn edit"
                        onclick="editGig(
                        <?= $g['id'] ?>,
                        '<?= htmlspecialchars($g['title'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($g['description'], ENT_QUOTES) ?>',
                        <?= $g['category_id'] ?>,
                        <?= $g['price'] ?>,
                        <?= $g['delivery_time'] ?>,
                        <?= $g['revisions'] ?>,
                        '<?= $image ?>'
                        )">
                        Edit
                    </button>
                    <form method="POST" style="flex: 1;">
                        <input type="hidden" name="gig_id" value="<?= $g['id'] ?>">
                        <?php if ($g['status'] == 'active'): ?>
                            <button name="pause_gig" class="gig-btn pause">Pause</button>
                        <?php else: ?>
                            <button name="activate_gig" class="gig-btn success">Activate</button>
                        <?php endif; ?>
                    </form>
                    <form method="POST" style="flex: 1;">
                        <input type="hidden" name="gig_id" value="<?= $g['id'] ?>">
                        <button name="delete_gig" class="gig-btn danger">Delete</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
    // IMAGE PREVIEW
    document.getElementById("gigImage").onchange = function(e) {
        let file = e.target.files[0];
        if (file) {
            // Validate file size
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                this.value = '';
                return;
            }

            let reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById("previewImg").src = ev.target.result;
            }
            reader.readAsDataURL(file);
        }
    };

    // EDIT FUNCTION
    function editGig(id, title, desc, cat, price, delivery, rev, image) {
        document.getElementById("gig_id").value = id;
        document.getElementById("title").value = title;
        document.getElementById("description").value = desc;
        document.getElementById("category_id").value = cat;
        document.getElementById("price").value = price;
        document.getElementById("delivery_time").value = delivery;
        document.getElementById("revisions").value = rev;

        document.getElementById("previewImg").src = image;

        document.getElementById("formTitle").innerText = "Edit Gig";
        document.querySelector("[name='save_gig']").innerText = "Update Gig";

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
</script>