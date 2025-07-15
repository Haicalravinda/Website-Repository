<div class="sidebar">
    <div class="sidebar-header">
        <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Logo" class="sidebar-logo">
        <h4>Admin Panel</h4>
    </div>
    <div class="sidebar-menu">
        <a href="dashboard.php" class="menu-item">
            <div class="menu-icon">
                <i class="fas fa-home"></i>
            </div>
            <span>Dashboard</span>
        </a>
        <a href="data_pi.php" class="menu-item active">
            <div class="menu-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <span>Data PI</span>
        </a>
        <a href="data_mahasiswa.php" class="menu-item">
            <div class="menu-icon">
                <i class="fas fa-users"></i>
            </div>
            <span>Data Mahasiswa</span>
        </a>
        <a href="logout.php" class="menu-item">
            <div class="menu-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <span>Logout</span>
        </a>
    </div>
</div>

<style>
.sidebar {
    width: 250px;
    background: linear-gradient(180deg, #2C3E50 0%, #3498DB 100%);
    min-height: 100vh;
    padding: 20px;
    transition: all 0.3s ease;
}

.sidebar-header {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 20px;
}

.sidebar-logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 10px;
    border: 3px solid #fff;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.sidebar-header h4 {
    color: #fff;
    font-size: 1.2rem;
    margin: 10px 0;
}

.menu-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    color: #fff;
    text-decoration: none;
    border-radius: 10px;
    margin-bottom: 5px;
    transition: all 0.3s ease;
}

.menu-icon {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
    margin-right: 10px;
}

.menu-item i {
    font-size: 1.1rem;
}

.menu-item span {
    font-size: 0.9rem;
}

.menu-item:hover {
    background: rgba(255,255,255,0.1);
    transform: translateX(5px);
}

.menu-item.active {
    background: #fff;
    color: #2C3E50;
}

.menu-item.active .menu-icon {
    background: #2C3E50;
    color: #fff;
}
</style>