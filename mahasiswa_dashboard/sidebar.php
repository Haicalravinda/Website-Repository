<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-purple sidebar collapse">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link" href="directory_ta.php">
                    <span data-feather="file"></span>
                    Directory Tugas Akhir(Skripsi)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="directory_pi.php">
                    <span data-feather="file"></span>
                    Directory Penelitian Ilmiah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <span data-feather="log-out"></span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
    /* Sidebar Styling */
    #sidebarMenu {
        background-color: #5f2c82; /* Purple color */
        color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    #sidebarMenu .nav-link {
        color: white;
        text-decoration: none;
        padding: 12px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #sidebarMenu .nav-link:hover {
        background-color: #4a1f6b; /* Darker purple on hover */
    }

    #sidebarMenu .nav-link.active {
        background-color: #4a1f6b;
        font-weight: bold;
    }

    #sidebarMenu .nav-item + .nav-item {
        margin-top: 10px;
    }

    /* Feather icon styling */
    #sidebarMenu .nav-link span {
        margin-right: 8px;
    }

    /* Animations for sliding in sidebar */
    @keyframes slideIn {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(0);
        }
    }

    #sidebarMenu {
        animation: slideIn 0.5s ease-out;
    }
</style>
