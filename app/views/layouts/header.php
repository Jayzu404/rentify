<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Normalize current page path
$current_page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<style>
  /* ========= Rentify Navbar Styles ========= */
  .navbar {
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
  }

  .navbar-brand {
      font-weight: 700;
      color: #ebac25 !important; /* Rentify brand gold */
      letter-spacing: 0.5px;
      font-size: 1.45rem;
      display: flex;
      align-items: center;
  }

  .navbar-brand i {
      margin-right: 6px;
      color: #ebac25;
  }

  .nav-link {
      position: relative;
      font-weight: 500;
      color: #1e40af !important;
      margin: 0 10px;
      transition: color 0.3s ease, transform 0.2s ease;
  }

  .nav-link::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -5px;
      width: 0%;
      height: 2px;
      background-color: #1e40af;
      transition: width 0.3s ease;
      border-radius: 1px;
  }

  .nav-link:hover::after {
      width: 100%;
  }

  .nav-link:hover {
      color: #0f2167 !important;
      transform: translateY(-2px);
  }

  .nav-link.active {
      color: #0f2167 !important;
      font-weight: 600;
  }

  .nav-link.active::after {
      width: 100%;
  }

  .btn-outline-primary {
      border-color: #1e40af;
      color: #1e40af;
      font-weight: 500;
      transition: all 0.3s ease;
  }

  .btn-outline-primary:hover {
      background-color: #1e40af;
      color: #ffffff;
      transform: translateY(-2px);
  }

  .user-avatar img {
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #1e40af;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .user-avatar img:hover {
      transform: scale(1.08);
      box-shadow: 0 4px 10px rgba(30, 64, 175, 0.3);
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-3 shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="/home">
      <i class="fas fa-exchange-alt"></i> Rentify
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $current_page === '/home' || $current_page === '/' ? 'active' : '' ?>" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page === '/item/browse' ? 'active' : '' ?>" href="/item/browse">Browse Items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page === '/home/about' ? 'active' : '' ?>" href="/home/about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page === '/dashboard' ? 'active' : '' ?>" href="/dashboard">Dashboard</a>
        </li>
      </ul>

      <div class="d-flex align-items-center gap-2">
        <?php if (!empty($_SESSION['isLoggedIn'])): ?>
            <?php if ($current_page === '/home' || $current_page === '/'): ?>
                <button type="button" class="btn btn-outline-primary btn-md" onclick="window.location.href='/item/create'">
                <i class="bi bi-plus-circle"></i> List Item
                </button>
            <?php endif; ?>  

            <button type="button" class="btn btn-danger d-none d-md-block btn-md" data-bs-toggle="modal" data-bs-target="#rentifyModal" onclick="window.location.href='/auth/logout'">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
            <button type="button" class="btn btn-danger d-block d-md-none btn-sm" data-bs-toggle="modal" data-bs-target="#rentifyModal" onclick="window.location.href='/auth/logout'">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>

            <div class="user-avatar ms-3" title="Profile" onclick="window.location.href='/user/profile'">
              <img src="/assets/images/cat-pfp.jpg" alt="User" width="45" height="45">
            </div>
        <?php else: ?>    
          <button class="btn btn-outline-primary btn-sm me-2" onclick="window.location.href='/auth/signup'">Signup</button>
          <button class="btn btn-outline-primary btn-sm" onclick="window.location.href='/auth/login'">Login</button>
        <?php endif; ?>    
      </div>
    </div>
  </div>
</nav>