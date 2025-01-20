<!-- sidebar.php -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar">
                <div class="list-group">
                    <h3 class="list-group-item active">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </h3>
                    <a href="admin_profile.php" class="list-group-item list-group-item-action">
                        <i class="bi bi-person-circle me-2"></i>Edit Profile
                    </a>
                    <a href="admin_book.php" class="list-group-item list-group-item-action">
                        <i class="bi bi-book me-2"></i>Manage Books
                    </a>
                    <a href="admin_publisher.php" class="list-group-item list-group-item-action">
                        <i class="bi bi-building me-2"></i>Manage Publisher
                    </a>
                    <a href="admin_user.php" class="list-group-item list-group-item-action">
                        <i class="bi bi-people me-2"></i>Manage Users
                    </a>
                    <a href="admin_role.php" class="list-group-item list-group-item-action">
                        <i class="bi bi-person-badge me-2"></i>Manage Roles
                    </a>
                    <a href="logout.php" class="list-group-item list-group-item-action text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">

<style>
.sidebar {
    padding: 20px 0;
}

.sidebar .list-group {
    margin-bottom: 20px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.sidebar .list-group-item.active {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.sidebar .list-group-item {
    border-left: none;
    border-right: none;
    padding: 12px 20px;
    transition: all 0.3s ease;
}

.sidebar .list-group-item:hover {
    background-color: #f8f9fa;
}

.sidebar .list-group-item:first-child {
    border-top: none;
}

.sidebar .list-group-item:last-child {
    border-bottom: none;
}

.text-danger:hover {
    background-color: #dc3545 !important;
    color: white !important;
}

@media (max-width: 768px) {
    .sidebar {
        margin-bottom: 20px;
    }
}
</style>