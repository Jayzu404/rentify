<?php
  require_once dirname(__DIR__) . '/layouts/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Rentify</title>

  <!-- Bootstraps -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  
  <!-- Font awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      color: #212529;
    }

    .hero-section {
      background: linear-gradient(135deg, #fff 0%, #fef4de 100%);
      padding: 80px 0;
      text-align: center;
    }

    .hero-section h1 {
      font-weight: 700;
      font-size: 2.5rem;
      color: #212529;
    }

    .hero-section p {
      max-width: 700px;
      margin: 15px auto 0;
      color: #6c757d;
      font-size: 1.05rem;
    }

    .section-title {
      font-weight: 600;
      color: #212529;
      margin-bottom: 1rem;
    }

    .about-content {
      padding: 80px 0;
    }

    .about-content img {
      border-radius: 16px;
      width: 100%;
      object-fit: cover;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .highlight {
      color: #ebac25;
      font-weight: 600;
    }

    .values-section {
      background-color: #fff;
      padding: 70px 0;
    }

    .value-card {
      background: #fff;
      border: none;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
      transition: 0.3s;
      height: 100%;
    }

    .value-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .value-card i {
      font-size: 2rem;
      color: #ebac25;
      margin-bottom: 15px;
    }

  .team-section {
    background-color: #fafafa;
    font-family: 'Poppins', sans-serif;
  }

  .section-title {
    font-weight: 600;
    color: #1e293b;
    letter-spacing: 0.5px;
  }

  .team-member {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
  }

  .team-member:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
  }

  .member-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e40af;
    margin-bottom: 0.25rem;
  }

  .member-role {
    font-size: 0.95rem;
    font-weight: 500;
    color: #64748b;
    margin-bottom: 0.75rem;
  }

  .member-desc {
    font-size: 0.9rem;
    color: #475569;
    line-height: 1.5;
  }

    footer {
      background: #212529;
      color: #fff;
      padding: 40px 0;
      text-align: center;
      font-size: 0.9rem;
    }

    footer a {
      color: #ebac25;
      text-decoration: none;
      font-weight: 500;
    }

    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <h1>About <span class="highlight">Rentify</span></h1>
      <p>Rentify is a modern rental platform built to connect students, professionals, and communities — making sharing and renting items simpler, safer, and more affordable for everyone.</p>
    </div>
  </section>

  <!-- About Content -->
  <section class="about-content">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-md-6">
          <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786" alt="Our Mission">
        </div>
        <div class="col-md-6">
          <h3 class="section-title">Our Mission</h3>
          <p>Our mission is to empower people to <span class="highlight">maximize what they own</span> and access what they need — without the burden of buying. At Rentify, we believe in creating a circular economy where sharing is both practical and profitable.</p>
          <p>We aim to make every transaction transparent, reliable, and secure. Whether you’re lending or renting, Rentify ensures a smooth experience built on trust.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Core Values -->
  <section class="values-section text-center">
    <div class="container">
      <h3 class="section-title mb-4">Our Core Values</h3>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="value-card">
            <i class="bi bi-people-fill"></i>
            <h5>Community</h5>
            <p>We connect people through shared value and trust, promoting meaningful interactions among our users.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="value-card">
            <i class="bi bi-shield-check"></i>
            <h5>Safety & Trust</h5>
            <p>Your security matters most. We ensure verified users and reliable listings for every rental transaction.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="value-card">
            <i class="bi bi-lightbulb"></i>
            <h5>Innovation</h5>
            <p>We continuously evolve to deliver a seamless, tech-driven rental experience that meets modern needs.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Meet the Team -->
  <section class="team-section py-5">
    <div class="container">
      <h3 class="text-center section-title mb-5">Meet Our Team</h3>
      <div class="row justify-content-center g-4">
        
        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">Teejay Arancina</h5>
            <p class="member-role">Full Stack Engineer</p>
            <p class="member-desc">Passionate about building scalable web systems and leading design-driven innovation.</p>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">Mitchlyn Tutor</h5>
            <p class="member-role">UI/UX Designer</p>
            <p class="member-desc">Crafts seamless digital experiences with a focus on clarity, accessibility, and emotion.</p>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">Alvin Guillermo</h5>
            <p class="member-role">Backend Engineer</p>
            <p class="member-desc">Ensures smooth, secure, and efficient data flow across all Rentify systems.</p>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">Grace Temblor</h5>
            <p class="member-role">Project Manager</p>
            <p class="member-desc">Coordinates product development and ensures timely delivery with team synergy.</p>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">Carla Mahinay</h5>
            <p class="member-role">Frontend Developer</p>
            <p class="member-desc">Transforms design ideas into responsive and interactive user interfaces.</p>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">David Veloso</h5>
            <p class="member-role">Database Administrator</p>
            <p class="member-desc">Manages and optimizes the database for performance, consistency, and reliability.</p>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">Giovanne Macasa</h5>
            <p class="member-role">Quality Assurance</p>
            <p class="member-desc">Ensures every feature functions smoothly through detailed testing and review.</p>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">Jeric Fallera</h5>
            <p class="member-role">System Analyst</p>
            <p class="member-desc">Analyzes requirements and ensures the system aligns with project goals and user needs.</p>
          </div>
        </div>

        
        <div class="col-md-3 col-sm-6">
          <div class="team-member text-center p-4">
            <h5 class="member-name">Joey Ibanez</h5>
            <p class="member-role">Desinger, AI engineer, Cloud Engineer, Data Analyst, NASA Astronaut, Former U.S President, Former WBO Champion, 20 Division Champion, Former Member of Power Ranger, Former Member of F4, Former Kagawad, Created Half of the Universe, LGBT Leader, First Human discovered, BIPSU National Treasure, Endangered Species, Miss Universe 2000-2025, Top Global Zilong, Miya, Belerick, Brody, Angela, World War I & II Veteran, Pokemon Gym Leader, Created I Hate You Virus, Raises Tarzan, Painted Mona Lisa, Professor/Mentor of Da Vinci, Einstein, Tesla, Isaac Newton, Elon Musk, Father of Philippine Revolution, Killed Magellan & Lapu-Lapu, Victoria Secret Super model, Bollywood Award Winning Actor, Special Child and many more...</p>
            <p class="member-desc">Coordinates product development and ensures timely delivery with team synergy.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
  require_once dirname(__DIR__) . '/layouts/footer.php';
?>