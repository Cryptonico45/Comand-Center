<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard Metabase</title>

  <!-- Google Fonts: Poppins & Nunito -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #1E88E5;    /* Biru Magelang */
      --secondary-color: #1565C0;   /* Biru tua Magelang */
      --accent-color: #0D47A1;      /* Biru lebih tua */
      --light-bg: #f9f9f9;
      --text-color: #333;
    }
    body {
      font-family: 'Poppins', 'Nunito', sans-serif;
      background: var(--light-bg);
      color: var(--text-color);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    .navbar {
      padding: 15px 0;
      background: rgba(255, 255, 255, 0.95) !important;
      backdrop-filter: blur(10px);
    }
    .navbar-brand img {
      height: 40px;
    }
    .search-section {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      padding: 80px 0;
      margin-bottom: 60px;
      position: relative;
      overflow: hidden;
    }
    .search-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,208C1248,224,1344,192,1392,176L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
      background-position: center bottom;
      background-repeat: no-repeat;
      opacity: 0.1;
    }
    .search-section h1 {
      color: white;
      margin-bottom: 30px;
      font-weight: 700;
      font-size: 2.5rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .search-box {
      max-width: 600px;
      margin: 0 auto;
      position: relative;
    }
    .search-box input {
      padding: 20px;
      border-radius: 50px;
      border: none;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      font-size: 1.1rem;
    }
    .search-box input:focus {
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }
    .category-card {
      transition: all 0.3s ease;
      margin-bottom: 20px;
      height: 100%;
      border: none;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      overflow: hidden;
    }
    .category-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .category-card.disabled {
      opacity: 0.7;
      cursor: not-allowed;
      background: #f8f9fa;
    }
    .category-card .card-body {
      text-align: center;
      padding: 30px;
      height: 200px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .category-icon {
      font-size: 40px;
      margin-bottom: 20px;
      color: var(--primary-color);
      transition: all 0.3s ease;
    }
    .category-card:hover .category-icon {
      transform: scale(1.1);
    }
    .card-title {
      font-weight: 600;
      margin-bottom: 10px;
      color: var(--text-color);
    }
    .card-text {
      font-size: 0.9rem;
      color: #6c757d;
    }
    footer {
      background: var(--secondary-color);
      color: white;
      padding: 30px 0;
      margin-top: 60px;
      text-align: center;
    }
    .btn-custom {
      padding: 10px 25px;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="8" fill="url(#paint0_linear)"/>
                <path d="M12 20C12 15.5817 15.5817 12 20 12C24.4183 12 28 15.5817 28 20C28 24.4183 24.4183 28 20 28C15.5817 28 12 24.4183 12 20Z" fill="white"/>
                <path d="M20 16C17.7909 16 16 17.7909 16 20C16 22.2091 17.7909 24 20 24C22.2091 24 24 22.2091 24 20C24 17.7909 22.2091 16 20 16Z" fill="url(#paint1_linear)"/>
                <defs>
                    <linearGradient id="paint0_linear" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#1E88E5"/>
                        <stop offset="1" stop-color="#1565C0"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear" x1="16" y1="16" x2="24" y2="24" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#1E88E5"/>
                        <stop offset="1" stop-color="#1565C0"/>
                    </linearGradient>
                </defs>
            </svg>
            <span class="ms-2 fw-bold" style="background: linear-gradient(135deg, #1E88E5, #1565C0); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Command center</span>
        </a>
      <div class="ms-auto">
        @if (Route::has('login'))
          @auth
            <a href="{{ url('/home') }}" class="btn btn-custom btn-outline-primary me-2">Home</a>
          @else
            <a href="{{ route('login') }}" class="btn btn-custom btn-outline-primary me-2">Login</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="btn btn-custom btn-primary">Register</a>
            @endif
          @endauth
        @endif
      </div>
    </div>
  </nav>

  <!-- Search Section -->
  <div class="search-section">
    <div class="container">
      <h1 class="text-center animate__animated animate__fadeInDown">Command Center Kota Magelang</h1>
      <div class="search-box animate__animated animate__fadeInUp">
        <input type="text" id="searchInput" class="form-control form-control-lg"
               placeholder="Cari kategori...">
      </div>
    </div>
  </div>

  <!-- Sectors Section -->
  <div class="container mb-5">
    <div class="row" id="sectorsContainer">
      <?php $allSectors = [
        'Perhubungan' => ['icon' => 'fas fa-truck', 'active' => true],
        'Pembangunan' => ['icon' => 'fas fa-building', 'active' => true],
        'Perizinan' => ['icon' => 'fas fa-file-alt', 'active' => true],
        'Kesehatan' => ['icon' => 'fas fa-heartbeat', 'active' => true],
        'SIG' => ['icon' => 'fas fa-map-marked-alt', 'active' => true],
        'Kepegawaian' => ['icon' => 'fas fa-users', 'active' => true],
        'Kependudukan' => ['icon' => 'fas fa-home', 'active' => true],
        'Keuangan' => ['icon' => 'fas fa-money-bill-alt', 'active' => true],
      ]; ?>

      @foreach($allSectors as $sectorName => $sectorInfo)
        <div class="col-md-3 category-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <a href="{{ $sectorInfo['active'] ? route('metabase.guest.sector', $loop->index + 1) : '#' }}" class="text-decoration-none">
            <div class="card sector-card category-card {{ !$sectorInfo['active'] ? 'disabled' : '' }}">
              <div class="card-body">
                <i class="{{ $sectorInfo['icon'] }} category-icon"></i>
                <h5 class="card-title">{{ $sectorName }}</h5>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 800,
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
      let filter = this.value.toLowerCase();
      let items = document.getElementsByClassName('category-item');

      for (let i = 0; i < items.length; i++) {
        let text = items[i].getElementsByClassName('card-title')[0].textContent;
        if (text.toLowerCase().indexOf(filter) > -1) {
          items[i].style.display = '';
        } else {
          items[i].style.display = 'none';
        }
      }
    });
  </script>
</body>
</html>
