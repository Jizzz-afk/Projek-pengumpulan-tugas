<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Portal Tugas Online | SMKN 1 Cirebon</title>

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* =========================================================
       1) ROOT & THEME TOKENS (Sama seperti halaman Login)
       ========================================================= */
    :root {
      --bg-gradient-start: #121826;
      --bg-gradient-end: #1f2a44;
      --brand: #2fd7c4;
      --brand-2: #3aa0ff;
      --text: #e7eef7;
      --text-dim: #b9c5d6;
      --card-bg: rgba(255, 255, 255, 0.08);
      --card-stroke: rgba(255, 255, 255, 0.14);
      --shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
      --radius-lg: 22px;
      --radius-md: 14px;
      --blur: blur(14px);
      --focus-ring: 0 0 0 3px rgba(58, 160, 255, 0.35);
      --ring-muted: 0 0 0 2px rgba(231, 238, 247, 0.2);
    }

    [data-theme="light"] {
      --bg-gradient-start: #f3f6fb;
      --bg-gradient-end: #dfe8ff;
      --text: #1b2430;
      --text-dim: #3e4b60;
      --card-bg: rgba(255, 255, 255, 0.7);
      --card-stroke: rgba(27, 36, 48, 0.06);
      --shadow: 0 10px 30px rgba(0, 0, 0, 0.10);
      --ring-muted: 0 0 0 2px rgba(27, 36, 48, 0.08);
    }

    /* =========================================================
       2) GLOBAL BASE
       ========================================================= */
    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }

    body {
      font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans";
      background: linear-gradient(120deg, var(--bg-gradient-start), var(--bg-gradient-end));
      color: var(--text);
      line-height: 1.7;
      overflow-x: hidden;
      min-height: 100vh;
    }

    /* =========================================================
       3) DECOR LAYERS (Sama seperti halaman Login)
       ========================================================= */
    .decor-aurora, .decor-grid, .orb, .wave-wrap {
      position: fixed;
      z-index: -1;
      pointer-events: none;
    }
    .decor-aurora {
      inset: -10% -10% auto -10%; height: 75vh;
      background: radial-gradient(60% 60% at 20% 30%, rgba(58,160,255,.22), transparent 60%), radial-gradient(60% 60% at 80% 40%, rgba(47,215,196,.18), transparent 60%), radial-gradient(50% 50% at 50% 80%, rgba(255,92,122,.18), transparent 60%);
      filter: blur(40px) saturate(110%);
    }
    .decor-grid {
      inset: 0;
      background-image: linear-gradient(rgba(231,238,247,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(231,238,247,0.06) 1px, transparent 1px);
      background-size: 28px 28px;
      mask-image: radial-gradient(circle at 50% 50%, rgba(0,0,0,0.85), transparent 70%);
    }
    .orb { width: 380px; height: 380px; border-radius: 50%; filter: blur(90px); opacity: .55; mix-blend-mode: screen; }
    .orb.teal { background: #2fd7c4; top: -80px; left: -60px; }
    .orb.pink { background: #ff5c7a; bottom: -70px; right: 10%; }
    .wave-wrap { left: 0; right: 0; bottom: -1px; opacity: .55; }
    .wave-wrap svg { width: 100%; height: auto; display: block; }
    
    /* =========================================================
       4) KONTEN UTAMA & SECTION
       ========================================================= */
    .container {
      width: min(100% - 32px, 1100px);
      margin-inline: auto;
      padding-top: 140px; /* Space for fixed navbar */
      padding-bottom: 100px;
    }

    section {
      padding: 60px 0;
      text-align: center;
    }

    .section-title {
      font-size: clamp(24px, 4vw, 36px);
      font-weight: 700;
      margin-bottom: 16px;
      color: var(--text);
    }

    .section-subtitle {
      font-size: 16px;
      color: var(--text-dim);
      max-width: 600px;
      margin: 0 auto 48px;
    }

    /* Animasi masuk */
    .fade-in-up {
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp .8s cubic-bezier(.2,.7,.2,1) forwards;
    }
    
    @keyframes fadeInUp {
      to { opacity: 1; transform: translateY(0); }
    }

    /* =========================================================
       5) NAVBAR
       ========================================================= */
    .navbar-landing {
      position: fixed;
      top: 16px;
      left: 16px;
      right: 16px;
      z-index: 10;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 24px;
      background: var(--card-bg);
      border: 1px solid var(--card-stroke);
      border-radius: 999px;
      box-shadow: var(--shadow);
      backdrop-filter: var(--blur);
      transition: transform .3s ease;
    }

    .nav-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }

    .nav-logo img {
      width: 40px;
      height: 40px;
    }

    .nav-logo-text {
      color: var(--text);
      font-weight: 600;
      font-size: 18px;
    }

    .nav-links {
      display: flex;
      gap: 24px;
    }
    
    .nav-links a {
      color: var(--text-dim);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: color .2s;
    }

    .nav-links a:hover {
      color: var(--text);
    }
    
    .btn-login {
      padding: 10px 24px;
      border: none;
      border-radius: 999px;
      color: white;
      font-weight: 600;
      letter-spacing: .2px;
      cursor: pointer;
      text-decoration: none;
      background: linear-gradient(135deg, var(--brand), var(--brand-2));
      box-shadow: 0 8px 20px rgba(58,160,255,0.25);
      transition: transform .2s ease, box-shadow .3s ease;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(58,160,255,0.35);
    }
    
    @media (max-width: 768px) {
        .nav-links { display: none; }
        .nav-logo-text { display: none; }
    }


    /* =========================================================
       6) HERO SECTION
       ========================================================= */
    .hero-section {
      min-height: 60vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .hero-title {
      font-size: clamp(36px, 6vw, 64px);
      font-weight: 700;
      line-height: 1.2;
      background: linear-gradient(135deg, var(--text), var(--text-dim));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 24px;
      max-width: 800px;
    }
    
    .hero-subtitle {
      font-size: clamp(16px, 2.5vw, 20px);
      color: var(--text-dim);
      max-width: 650px;
      margin-bottom: 32px;
    }

    .hero-cta {
      display: flex;
      gap: 16px;
    }

    /* =========================================================
       7) FITUR SECTION
       ========================================================= */
    .feature-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
    }

    .feature-card {
      background: var(--card-bg);
      border: 1px solid var(--card-stroke);
      border-radius: var(--radius-lg);
      padding: 32px;
      text-align: left;
      transition: transform .3s ease, box-shadow .3s ease;
      animation-delay: calc(0.2s * var(--i));
    }
    
    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow);
    }

    .feature-icon {
      width: 50px; height: 50px;
      display: grid;
      place-items: center;
      border-radius: var(--radius-md);
      background: linear-gradient(135deg, var(--brand), var(--brand-2));
      margin-bottom: 20px;
    }
    
    .feature-icon svg { width: 24px; height: 24px; color: white; }
    .feature-title { font-size: 20px; font-weight: 600; color: var(--text); margin-bottom: 8px; }
    .feature-desc { font-size: 14px; color: var(--text-dim); }

    /* =========================================================
       8) FOOTER
       ========================================================= */
    .footer-landing {
        border-top: 1px solid var(--card-stroke);
        padding: 40px 0;
        text-align: center;
    }
    
    .footer-landing p {
        margin: 0;
        font-size: 14px;
        color: var(--text-dim);
    }
    
    /* =========================================================
       9) THEME SWITCHER (Sama seperti halaman Login)
       ========================================================= */
    .theme-toggle {
      position: fixed; top: 18px; right: 18px; z-index: 11;
      border: 1px solid var(--card-stroke); border-radius: 999px; padding: 8px;
      background: var(--card-bg); color: var(--text); display: flex;
      box-shadow: var(--shadow); backdrop-filter: var(--blur);
      transition: transform .2s ease;
      cursor: pointer;
    }
    .theme-toggle:hover { transform: scale(1.05); }
    .theme-toggle svg { width: 20px; height: 20px; }
    
  </style>
</head>
<body>
  <div class="decor-aurora" aria-hidden="true"></div>
  <div class="decor-grid" aria-hidden="true"></div>
  <div class="orb teal" aria-hidden="true"></div>
  <div class="orb pink" aria-hidden="true"></div>
  <div class="wave-wrap" aria-hidden="true">
    <svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path fill="rgba(231,238,247,0.15)" d="M0,80 C240,90 240,20 480,30 C720,40 720,110 960,100 C1200,90 1200,30 1440,40 L1440,120 L0,120 Z"></path>
    </svg>
  </div>
  
  <header class="navbar-landing fade-in-up">
    <a href="#" class="nav-logo">
      <img src="{{ asset('storage/foto/logo.png') }}" alt="Logo" width="40" class="me-2">
      <span class="nav-logo-text">SMKN 1 Cirebon</span>
    </a>
    <nav class="nav-links">
      <a href="#hero">Beranda</a>
      <a href="#features">Fitur</a>
      <a href="https://smkn1-cirebon.sch.id/" target="_blank">Website Sekolah</a>
    </nav>
    <a href="login.html" class="btn-login">Login</a>
  </header>
  
  <button class="theme-toggle" type="button" id="themeToggle" aria-label="Toggle tema">
    <svg id="iconSun" viewBox="0 0 24 24" fill="currentColor"><path d="M6.76 4.84l-1.8-1.79-1.41 1.41 1.79 1.8 1.42-1.42zm10.48 0l1.79-1.79 1.41 1.41-1.79 1.8-1.41-1.42zM12 4V1h-0v3h0zm0 19v-3h0v3h0zM4 13H1v-0h3v0zm19 0h-3v0h3v0zM6.76 19.16l-1.42 1.42-1.79-1.8 1.41-1.41 1.8 1.79zM19.16 17.24l1.41 1.41-1.79 1.8-1.42-1.42 1.8-1.79zM12 7a5 5 0 100 10 5 5 0 000-10z"/></svg>
    <svg id="iconMoon" viewBox="0 0 24 24" fill="currentColor" style="display:none"><path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/></svg>
  </button>
  
  <main class="container">
    <section id="hero" class="hero-section">
      <h1 class="hero-title fade-in-up">Kumpulkan Tugas Lebih Mudah, Cepat, dan Terorganisir.</h1>
      <p class="hero-subtitle fade-in-up" style="animation-delay: 0.2s;">
        Selamat datang di Portal Pengumpulan Tugas Online SMKN 1 Cirebon. Platform digital untuk menyederhanakan proses belajar mengajar.
      </p>
      <div class="hero-cta fade-in-up" style="animation-delay: 0.4s;">
        <a href="login.html" class="btn-login">Mulai Kumpulkan Tugas</a>
      </div>
    </section>

    <section id="features">
      <h2 class="section-title fade-in-up">Semua Kemudahan dalam Satu Platform</h2>
      <p class="section-subtitle fade-in-up" style="animation-delay: 0.2s;">
        Dirancang khusus untuk memenuhi kebutuhan siswa dan guru, menjadikan proses pengumpulan dan penilaian tugas lebih efisien.
      </p>

      <div class="feature-grid">
        <div class="feature-card fade-in-up" style="--i:1; animation-delay: 0.4s;">
          <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M13 7h-2v5.414l3.293 3.293 1.414-1.414L13 11.586z"></path></svg>
          </div>
          <h3 class="feature-title">Pengumpulan Tepat Waktu</h3>
          <p class="feature-desc">Unggah tugas kapan saja sebelum tenggat waktu. Sistem akan mencatat waktu pengumpulan secara otomatis.</p>
        </div>

        <div class="feature-card fade-in-up" style="--i:2; animation-delay: 0.6s;">
          <div class="feature-icon">
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13.586V10c0-3.217-2.185-5.927-5-6.758V2h-4v1.242C7.185 4.073 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17z"></path><path d="M12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"></path></svg>
          </div>
          <h3 class="feature-title">Notifikasi Real-time</h3>
          <p class="feature-desc">Dapatkan pemberitahuan instan saat ada tugas baru atau setelah tugas Anda selesai dinilai oleh guru.</p>
        </div>
        
        <div class="feature-card fade-in-up" style="--i:3; animation-delay: 0.8s;">
          <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>
          </div>
          <h3 class="feature-title">Penilaian Transparan</h3>
          <p class="feature-desc">Lihat nilai dan masukan dari guru langsung di dasbor akun Anda. Lebih cepat, jelas, dan tanpa kertas.</p>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer-landing">
    <p>© 2025 SMK Negeri 1 Cirebon. Semua Hak Dilindungi.</p>
  </footer>
  
  <script>
    // THEME PERSISTENCE (Dark / Light)
    (function() {
      const root = document.documentElement;
      const toggle = document.getElementById('themeToggle');
      const iconSun = document.getElementById('iconSun');
      const iconMoon = document.getElementById('iconMoon');

      const savedTheme = localStorage.getItem('theme') || 'dark';
      
      function applyTheme(theme) {
          if (theme === 'light') {
              root.setAttribute('data-theme', 'light');
              iconSun.style.display = 'none';
              iconMoon.style.display = 'block';
          } else {
              root.removeAttribute('data-theme');
              iconSun.style.display = 'block';
              iconMoon.style.display = 'none';
          }
      }

      applyTheme(savedTheme);

      toggle.addEventListener('click', () => {
        const isLight = root.hasAttribute('data-theme');
        const newTheme = isLight ? 'dark' : 'light';
        localStorage.setItem('theme', newTheme);
        applyTheme(newTheme);
      });
    })();
  </script>
</body>
</html>