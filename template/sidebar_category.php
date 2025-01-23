<?php
// Database connection (adjust these values according to your configuration)
$conn = db_connect();
$result = getCategoryWithBookCount($conn);

?>

<!-- Category Sidebar -->
<div class="col-md-3">
    <div class="sidebar">
        <div class="list-group">
            <h3 class="list-group-item active">Book Categories</h3>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<a href="bookPerCate.php?catname=' . urlencode($row['category']) . '" 
                             class="list-group-item d-flex justify-content-between align-items-center">';
                    echo '<span><i class="fas fa-book me-2"></i>' . htmlspecialchars($row['category']) . '</span>';
                    echo '<span class="badge bg-primary rounded-pill">' . $row['book_count'] . '</span>';
                    echo '</a>';
                }
            } else {
                echo '<div class="list-group-item">No categories found</div>';
            }
            ?>
        </div>
    </div>
</div>

<style>
.sidebar {
    padding: 20px 0;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.sidebar .list-group {
    margin-bottom: 0;
}

.sidebar .list-group-item.active {
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-weight: 600;
}

.sidebar .list-group-item {
    border-left: none;
    border-right: none;
    padding: 12px 20px;
    transition: all 0.3s ease;
}

.sidebar .list-group-item:first-child {
    border-top: none;
}

.sidebar .list-group-item:last-child {
    border-bottom: none;
}

.sidebar .list-group-item:hover {
    background-color: #e9ecef;
    transform: translateX(5px);
}

.badge {
    transition: all 0.3s ease;
}

.list-group-item:hover .badge {
    transform: scale(1.1);
}

@media (max-width: 768px) {
    .sidebar {
        margin-bottom: 20px;
    }
}
</style>