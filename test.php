<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Rental Hub</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ebac25ff;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f53a0bff;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--primary-color) !important;
        }

        .hero-section {
            background: linear-gradient(110deg, var(--primary-color), #1e40af);
            min-height: 100vh;
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
        }

        .search-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .category-card {
            background: white;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            height: 100%;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .category-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .item-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            height: 100%;
            cursor: pointer;
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .item-image {
            height: 200px;
            background-color: #e2e8f0;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .price-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .rating {
            color: #fbbf24;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 10px 20px;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-available { background: #dcfce7; color: #166534; }
        .status-rented { background: #fef3c7; color: #92400e; }
        .status-pending { background: #dbeafe; color: #1e40af; }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .page-section {
            display: none;
        }

        .page-section.active {
            display: block;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .activity-item {
            padding: 15px;
            border-left: 4px solid var(--primary-color);
            margin-bottom: 10px;
            background: #f8fafc;
            border-radius: 0 8px 8px 0;
        }

        .footer {
            background-color: #1e293b;
            color: white;
            padding: 40px 0;
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
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
                    <button class="btn btn-outline-primary" onclick="showAddItemModal()">
                        <i class="fas fa-plus"></i> List Item
                    </button>
                    <div class="user-avatar" onclick="showPage('profile')" title="Profile">
                        JD
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main id="main-content">
        <!-- Home Page -->
        <section id="home-page" class="page-section active">
            <!-- Hero Section -->
            <div class="hero-section d-flex align-items-center justify-content-center">
                <div class="container-sm">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h1 class="display-4 fw-bold mb-4">Rent and Save.</h1>
                            <p class="lead mb-4">Your community marketplace for renting everyday items. Why buy when you can rent?</p>
                        </div>
                        <div class="col-lg-6">
                            <div class="search-box">
                                <h4 class="mb-3 text-dark">What are you looking for?</h4>
                                <div class="row g-2">
                                    <div class="col-8">
                                        <input type="text" class="form-control" placeholder="Search items..." id="searchInput">
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm btn-primary w-100" onclick="RentalApp.search.performSearch()">
                                            <i class="fas fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="container mb-5">
                <h2 class="text-center mb-4">Browse by Category</h2>
                <div class="row col-12 g-4" id="categories-container">
                    <!-- Categories will be loaded here -->
                </div>
            </div>

            <!-- Featured Items -->
            <div class="container mb-5">
                <h2 class="mb-4">Recently Added</h2>
                <div class="row g-4" id="featured-items">
                    <!-- Featured items will be loaded here -->
                </div>
            </div>
        </section>

        <!-- Browse Page -->
        <section id="browse-page" class="page-section">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3>Browse Items</h3>
                        </div>
                        <div class="row g-4" id="browse-items">
                            <!-- Browse items will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dashboard Page -->
        <section id="dashboard-page" class="page-section">
            <div class="container mt-4">
                <h2 class="mb-4">My Dashboard</h2>
                
                <!-- Stats Overview -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value" id="total-earnings">$0</div>
                        <div class="text-muted">Total Earnings</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="active-rentals">0</div>
                        <div class="text-muted">Active Rentals</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="listed-items">0</div>
                        <div class="text-muted">Listed Items</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="user-rating">4.8</div>
                        <div class="text-muted">Your Rating</div>
                    </div>
                </div>

                <div class="row">
                    <!-- My Items -->
                    <div class="col-lg-6">
                        <div class="dashboard-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">My Listed Items</h5>
                                <button class="btn btn-sm btn-primary" onclick="showAddItemModal()">
                                    <i class="fas fa-plus"></i> Add Item
                                </button>
                            </div>
                            <div id="my-items-list">
                                <!-- User's items will be loaded here -->
                            </div>
                        </div>
                    </div>

                    <!-- My Rentals -->
                    <div class="col-lg-6">
                        <div class="dashboard-card">
                            <h5 class="mb-3">My Current Rentals</h5>
                            <div id="my-rentals-list">
                                <!-- User's rentals will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="dashboard-card">
                    <h5 class="mb-3">Recent Activity</h5>
                    <div id="recent-activity">
                        <!-- Recent activity will be loaded here -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Profile Page -->
        <section id="profile-page" class="page-section">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="user-avatar mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                                    JD
                                </div>
                                <h4>John Doe</h4>
                                <p class="text-muted">Member since Jan 2024</p>
                                <div class="d-flex justify-content-center gap-4 mb-3">
                                    <div class="text-center">
                                        <div class="h4 text-primary mb-0">4.8</div>
                                        <small class="text-muted">Rating</small>
                                    </div>
                                    <div class="text-center">
                                        <div class="h4 text-success mb-0">23</div>
                                        <small class="text-muted">Items Rented</small>
                                    </div>
                                    <div class="text-center">
                                        <div class="h4 text-info mb-0">8</div>
                                        <small class="text-muted">Items Listed</small>
                                    </div>
                                </div>
                                <button class="btn btn-primary" onclick="RentalApp.profile.editProfile()">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Profile Information</h5>
                            </div>
                            <div class="card-body" id="profile-form-container">
                                <!-- Profile form will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addItemForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Item Name *</label>
                                <input type="text" class="form-control" name="itemName" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category *</label>
                                <select class="form-select" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="tools">Tools</option>
                                    <option value="sports">Sports</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Daily Rate ($) *</label>
                                <input type="number" class="form-control" name="dailyRate" min="1" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description *</label>
                                <textarea class="form-control" name="description" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Photos</label>
                                <input type="file" class="form-control" name="photos" multiple accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Condition *</label>
                                <select class="form-select" name="condition" required>
                                    <option value="">Select Condition</option>
                                    <option value="excellent">Excellent</option>
                                    <option value="good">Good</option>
                                    <option value="fair">Fair</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Availability *</label>
                                <select class="form-select" name="availability" required>
                                    <option value="">Select Availability</option>
                                    <option value="now">Available Now</option>
                                    <option value="date">Available from Date</option>
                                    <option value="request">On Request</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="RentalApp.items.addItem()">List Item</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-exchange-alt"></i> Rentify</h5>
                    <p>Building stronger communities through sharing.</p>
                </div>
                <div class="col-md-6 text-lg-end">
                    <p>&copy; 2025 Rentify. Made for our community with ❤️</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Main Application Object
        const RentalApp = {
            // Application data
            data: {
                currentUser: {
                    id: 1,
                    name: "John Doe",
                    email: "john.doe@email.com",
                    avatar: "JD",
                    rating: 4.8,
                    itemsRented: 23,
                    itemsListed: 8
                },
                categories: [
                    { id: 'Customes', name: 'Customes', icon: 'fa-solid fa-shirt', description: 'PE customes, formal attire, sports attire etc.' },
                    { id: 'Books', name: 'Books', icon: 'fa-solid fa-book', description: 'Notes, module, novels etc.' },
                    { id: 'sports', name: 'Sports', icon: 'fas fa-football-ball', description: 'Equipment, gear, shoes etc.' },
                    { id: 'tools', name: 'Tools', icon: 'fas fa-tools', description: 'repair tools, utility tools, drafting tools etc.' }
                ],
                items: [
                    {
                        id: 1,
                        name: "Barong Tagalog",
                        category: "PE custome",
                        price: 50,
                        location: 'Naval',
                        rating: 4.8,
                        owner: "Juan.",
                        status: "available",
                        description: "lorem ipsum"
                    },
                    {
                        id: 2,
                        name: "Discrete module",
                        category: "Book",
                        price: 50,
                        location: 'Calumpang',
                        rating: 4.9,
                        owner: "Maria.",
                        status: "available",
                        description: "lorem ipsum"
                    },
                    {
                        id: 3,
                        name: "Frisbee disc",
                        category: "sports",
                        price: 30,
                        location: 'Almeria',
                        rating: 4.7,
                        owner: "Jafar.",
                        status: "rented",
                        description: "lorem ipsum"
                    }
                ],
                userItems: [
                    { id: 101, name: "Frisbee disc", status: "available", dailyRate: 20, listedDate: "3 days ago" },
                    { id: 102, name: "Barong tagalog", status: "rented", dailyRate: 5, listedDate: "1 week ago" }
                ],
                userRentals: [
                    { id: 201, itemName: "Discrete module", owner: "Mike T.", status: "active", dailyRate: 15, startDate: "2024-01-15" }
                ],
                activities: [
                    { type: "rental_request", message: "New rental request for your Frisbee disc", time: "2 hours ago", icon: "fas fa-bell", class: "border-primary" },
                    { type: "rental_completed", message: "Rental completed - Barong tagalog returned", time: "1 day ago", icon: "fas fa-check", class: "border-success" }
                ]
            },

            // Initialize the application
            init() {
                this.navigation.init();
                this.home.init();
                this.dashboard.init();
                this.profile.init();
                
                // Set up event listeners
                document.getElementById('searchInput').addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.search.performSearch();
                    }
                });
            },

            // Navigation module
            navigation: {
                init() {
                    // Set initial active nav
                    document.querySelector('[data-page="home"]').classList.add('active');
                },
                
                showPage(pageId) {
                    // Hide all pages
                    document.querySelectorAll('.page-section').forEach(page => {
                        page.classList.remove('active');
                    });
                    
                    // Show selected page
                    document.getElementById(pageId + '-page').classList.add('active');
                    
                    // Update navigation
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                    });
                    document.querySelector(`[data-page="${pageId}"]`)?.classList.add('active');
                    
                    // Load page-specific content
                    switch(pageId) {
                        case 'browse':
                            RentalApp.browse.loadItems();
                            break;
                        case 'dashboard':
                            RentalApp.dashboard.loadContent();
                            break;
                        case 'profile':
                            RentalApp.profile.loadProfile();
                            break;
                    }
                }
            },

            // Home page module
            home: {
                init() {
                    this.loadCategories();
                    this.loadFeaturedItems();
                },
                
                loadCategories() {
                    const container = document.getElementById('categories-container');
                    container.innerHTML = RentalApp.data.categories.map(category => `
                        <div class="col-md-4 col-6">
                            <div class="category-card" onclick="RentalApp.browse.filterByCategory('${category.id}')">
                                <div class="category-icon">
                                    <i class="${category.icon}"></i>
                                </div>
                                <h5>${category.name}</h5>
                                <p class="text-muted mb-0">${category.description}</p>
                            </div>
                        </div>
                    `).join('');
                },
                
                loadFeaturedItems() {
                    const container = document.getElementById('featured-items');
                    const featuredItems = RentalApp.data.items.slice(0, 3);
                    container.innerHTML = featuredItems.map(item => RentalApp.utils.createItemCard(item)).join('');
                }
            },

            // Browse page module
            browse: {
                currentItems: [],
                
                loadItems(items = null) {
                    this.currentItems = items || RentalApp.data.items;
                    const container = document.getElementById('browse-items');
                    container.innerHTML = this.currentItems.map(item => RentalApp.utils.createItemCard(item)).join('');
                    this.loadFilters();
                },
                
                loadFilters() {
                    const container = document.getElementById('filters-container');
                    container.innerHTML = `
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" onchange="RentalApp.browse.filterByCategory(this.value)">
                                <option value="">All Categories</option>
                                ${RentalApp.data.categories.map(cat => `<option value="${cat.id}">${cat.name}</option>`).join('')}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price Range (per day)</label>
                            <input type="range" class="form-range" min="0" max="100" value="50">
                            <div class="d-flex justify-content-between">
                                <small>$0</small>
                                <small>$100+</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Availability</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked>
                                <label class="form-check-label">Available now</label>
                            </div>
                        </div>
                    `;
                },
                
                filterByCategory(categoryId) {
                    RentalApp.navigation.showPage('browse');
                    if (categoryId) {
                        const filtered = RentalApp.data.items.filter(item => item.category === categoryId);
                        this.loadItems(filtered);
                    } else {
                        this.loadItems();
                    }
                },
                
                sortItems(sortBy) {
                    let sorted = [...this.currentItems];
                    switch(sortBy) {
                        case 'price-low':
                            sorted.sort((a, b) => a.price - b.price);
                            break;
                        case 'price-high':
                            sorted.sort((a, b) => b.price - a.price);
                            break;
                        case 'distance':
                            // Mock sorting by distance
                            sorted.sort((a, b) => parseFloat(a.location) - parseFloat(b.location));
                            break;
                        default:
                            // newest first (default)
                            break;
                    }
                    this.currentItems = sorted;
                    this.loadItems(sorted);
                }
            },

            // Dashboard module
            dashboard: {
                init() {
                    // Initialize dashboard stats
                    this.updateStats();
                },
                
                updateStats() {
                    document.getElementById('total-earnings').textContent = '$' + Math.floor(Math.random() * 1000);
                    document.getElementById('active-rentals').textContent = RentalApp.data.userRentals.length;
                    document.getElementById('listed-items').textContent = RentalApp.data.userItems.length;
                    document.getElementById('user-rating').textContent = RentalApp.data.currentUser.rating;
                },
                
                loadContent() {
                    this.loadMyItems();
                    this.loadMyRentals();
                    this.loadRecentActivity();
                },
                
                loadMyItems() {
                    const container = document.getElementById('my-items-list');
                    container.innerHTML = RentalApp.data.userItems.map(item => `
                        <div class="mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">${item.name}</h6>
                                    <small class="text-muted">Listed ${item.listedDate} • $${item.dailyRate}/day</small>
                                </div>
                                <span class="status-badge status-${item.status}">${item.status.charAt(0).toUpperCase() + item.status.slice(1)}</span>
                            </div>
                        </div>
                    `).join('');
                },
                
                loadMyRentals() {
                    const container = document.getElementById('my-rentals-list');
                    container.innerHTML = RentalApp.data.userRentals.map(rental => `
                        <div class="mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">${rental.itemName}</h6>
                                    <small class="text-muted">From ${rental.owner} • ${rental.dailyRate}/day</small>
                                </div>
                                <span class="status-badge status-${rental.status}">${rental.status.charAt(0).toUpperCase() + rental.status.slice(1)}</span>
                            </div>
                        </div>
                    `).join('');
                },
                
                loadRecentActivity() {
                    const container = document.getElementById('recent-activity');
                    container.innerHTML = RentalApp.data.activities.map(activity => `
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <i class="${activity.icon} text-primary me-2"></i>
                                <div class="flex-grow-1">
                                    <div class="fw-medium">${activity.message}</div>
                                    <small class="text-muted">${activity.time}</small>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }
            },

            // Profile module
            profile: {
                init() {
                    this.loadProfile();
                },
                
                loadProfile() {
                    const container = document.getElementById('profile-form-container');
                    const user = RentalApp.data.currentUser;
                    container.innerHTML = `
                        <form id="profile-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstName" value="John">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" value="Doe">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="${user.email}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" class="form-control" name="phone" value="+1 234 567 8900">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" value="Downtown Community">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Bio</label>
                                    <textarea class="form-control" name="bio" rows="3">Friendly community member who loves sharing and helping neighbors!</textarea>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-outline-secondary ms-2">Cancel</button>
                            </div>
                        </form>
                    `;
                },
                
                editProfile() {
                    // Enable form editing
                    const form = document.getElementById('profile-form');
                    if (form) {
                        form.addEventListener('submit', (e) => {
                            e.preventDefault();
                            this.saveProfile();
                        });
                    }
                },
                
                saveProfile() {
                    // Mock save functionality
                    alert('Profile saved successfully!');
                }
            },

            // Items management module
            items: {
                addItem() {
                    const form = document.getElementById('addItemForm');
                    const formData = new FormData(form);
                    
                    // Mock validation
                    if (!formData.get('itemName') || !formData.get('category') || !formData.get('dailyRate')) {
                        alert('Please fill in all required fields');
                        return;
                    }
                    
                    // Create new item object
                    const newItem = {
                        id: Date.now(),
                        name: formData.get('itemName'),
                        category: formData.get('category'),
                        price: parseInt(formData.get('dailyRate')),
                        description: formData.get('description'),
                        condition: formData.get('condition'),
                        status: 'available',
                        owner: RentalApp.data.currentUser.name,
                        location: '0.1 km away',
                        rating: 5.0
                    };
                    
                    // Add to user items
                    RentalApp.data.userItems.push({
                        id: newItem.id,
                        name: newItem.name,
                        status: 'available',
                        dailyRate: newItem.price,
                        listedDate: 'just now'
                    });
                    
                    // Add to all items
                    RentalApp.data.items.push(newItem);
                    
                    // Close modal and refresh dashboard
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addItemModal'));
                    modal.hide();
                    form.reset();
                    
                    // Show success message
                    alert('Item listed successfully!');
                    
                    // Refresh dashboard if currently viewing
                    if (document.getElementById('dashboard-page').classList.contains('active')) {
                        RentalApp.dashboard.loadContent();
                    }
                },
                
                requestRental(itemId) {
                    const item = RentalApp.data.items.find(i => i.id === itemId);
                    if (item && item.status === 'available') {
                        alert(`Rental request sent for ${item.name}! The owner will be notified.`);
                        // In a real app, this would send a notification to the owner
                    }
                }
            },

            // Search module
            search: {
                performSearch() {
                    const query = document.getElementById('searchInput').value.trim().toLowerCase();
                    if (query) {
                        const results = RentalApp.data.items.filter(item => 
                            item.name.toLowerCase().includes(query) ||
                            item.description.toLowerCase().includes(query) ||
                            item.category.toLowerCase().includes(query)
                        );
                        
                        RentalApp.navigation.showPage('browse');
                        RentalApp.browse.loadItems(results);
                    }
                }
            },

            // Utility functions
            utils: {
                createItemCard(item) {
                    const statusClass = `status-${item.status}`;
                    const statusText = item.status.charAt(0).toUpperCase() + item.status.slice(1);
                    
                    return `
                        <div class="col-md-6 col-lg-4">
                            <div class="item-card" onclick="RentalApp.utils.showItemDetails(${item.id})">
                                <div class="item-image" style="background: linear-gradient(45deg, #e2e8f0, #cbd5e1);">
                                    <div class="price-tag">${item.price}/day</div>
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-image text-secondary" style="font-size: 3rem;"></i>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-2">${item.name}</h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rating me-2">
                                            ${'★'.repeat(Math.floor(item.rating))} ${item.rating}
                                        </div>
                                        <small class="text-muted">by ${item.owner}</small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt"></i> ${item.location}
                                        </small>
                                        <span class="status-badge ${statusClass}">${statusText}</span>
                                    </div>
                                    <button class="btn btn-primary btn-sm w-100 mt-2" 
                                            ${item.status !== 'available' ? 'disabled' : ''} 
                                            onclick="event.stopPropagation(); RentalApp.items.requestRental(${item.id})">
                                        ${item.status === 'available' ? 'Request Rental' : 'Not Available'}
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                },
                
                showItemDetails(itemId) {
                    const item = RentalApp.data.items.find(i => i.id === itemId);
                    if (item) {
                        alert(`Item Details:\n\nName: ${item.name}\nPrice: ${item.price}/day\nOwner: ${item.owner}\nDescription: ${item.description}\nStatus: ${item.status}`);
                        // In a real app, this would open a detailed modal or navigate to item page
                    }
                }
            }
        };

        // Global functions for backwards compatibility and easy access
        function showPage(pageId) {
            RentalApp.navigation.showPage(pageId);
        }

        function showAddItemModal() {
            const modal = new bootstrap.Modal(document.getElementById('addItemModal'));
            modal.show();
        }

        function filterByCategory(category) {
            RentalApp.browse.filterByCategory(category);
        }

        // Initialize application when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            RentalApp.init();
        });
    </script>
</body>
</html>