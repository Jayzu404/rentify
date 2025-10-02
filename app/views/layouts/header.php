<style>
    .navbar-brand {
        font-weight: bold;
        color: #ebac25ff;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#" onclick="showPage('home')">
            <i class="fas fa-exchange-alt"></i> Rentify
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showPage('home')" data-page="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showPage('browse')" data-page="browse">Browse Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showPage('dashboard')" data-page="dashboard">My Dashboard</a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center gap-3">
                <!-- <button class="btn btn-outline-primary" onclick="showAddItemModal()">
                    <i class="fas fa-plus"></i> List Item
                </button> -->
                <button class="btn btn-outline-primary btn-sm" onclick="window.location.href='/auth/signup'">
                    Signup
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="window.location.href='/auth/login'">
                    Login
                </button>
                <!-- <div class="user-avatar" onclick="showPage('profile')" title="Profile">
                    JD
                </div> -->
            </div>
        </div>
    </div>
</nav>