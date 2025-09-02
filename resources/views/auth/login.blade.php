<!DOCTYPE html>
<html lang="id">
<head>
  <!-- =========================================================
       LOGIN SMKN 1 CIREBON — LEVEL DEWA
       Fitur:
       -  Bootstrap 5
       -  Dark / Light mode switch (persist via localStorage)
       -  Glassmorphism + neon glow + aurora gradient + waves
       -  Logo besar (>= 150px) + hover micro-interactions
       -  Floating labels, password toggle, keyboard-accessible
       -  Responsive penuh (mobile, tablet, desktop)
       -  Animasi masuk (fade+slide) & hover states
       -  Laravel Blade friendly (asset(), route(), csrf, errors)
       -  350+ lines (dengan komentar rapi)
       ========================================================= -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | SMKN 1 Cirebon</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* =========================================================
       1) ROOT & THEME TOKENS
       ========================================================= */
    :root {
      --bg-gradient-start: #121826;    /* base dark */
      --bg-gradient-end:   #1f2a44;    /* base dark-2 */
      --brand:             #2fd7c4;    /* teal brand */
      --brand-2:           #3aa0ff;    /* blue brand */
      --text:              #e7eef7;    /* text on dark */
      --text-dim:          #b9c5d6;    /* dim text */
      --card-bg:           rgba(255,255,255,0.08);
      --card-stroke:       rgba(255,255,255,0.14);
      --input-bg:          rgba(255,255,255,0.12);
      --input-bg-focus:    rgba(255,255,255,0.18);
      --shadow:            0 20px 50px rgba(0,0,0,0.35);
      --glow:              0 0 0 3px rgba(47,215,196,0.25);
      --danger:            #ff5c7a;
      --success:           #3ecf8e;
      --warning:           #ffcc66;
      --radius-lg:         22px;
      --radius-md:         14px;
      --radius-sm:         10px;
      --blur:              blur(14px);
      --focus-ring:        0 0 0 3px rgba(58,160,255,0.35);
      --ring-muted:        0 0 0 2px rgba(231,238,247,0.2);
      --logo-size:         160px;      /* >>> LOGO SIZE CONTROL <<< */
    }

    /* Light mode tokens (applied by [data-theme="light"]) */
    [data-theme="light"] {
      --bg-gradient-start: #f3f6fb;
      --bg-gradient-end:   #dfe8ff;
      --text:              #1b2430;
      --text-dim:          #3e4b60;
      --card-bg:           rgba(255,255,255,0.7);
      --card-stroke:       rgba(27,36,48,0.06);
      --input-bg:          rgba(255,255,255,0.9);
      --input-bg-focus:    #ffffff;
      --shadow:            0 10px 30px rgba(0,0,0,0.10);
      --glow:              0 0 0 3px rgba(58,160,255,0.20);
      --ring-muted:        0 0 0 2px rgba(27,36,48,0.08);
    }

    /* =========================================================
       2) GLOBAL BASE
       ========================================================= */
    * { box-sizing: border-box; }
    html, body { height: 100%; }

    body {
      font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
      background: linear-gradient(120deg, var(--bg-gradient-start), var(--bg-gradient-end));
      color: var(--text);
      display: grid;
      place-items: center;
      overflow: hidden;
    }

    /* Subtle scroll for mobile address bar */
    @supports (height: 100svh) {
      body { min-height: 100svh; }
    }

    /* =========================================================
       3) DECOR LAYERS (Aurora + Orbs + Grid)
       ========================================================= */
    .decor-aurora {
      position: fixed; inset: -10% -10% auto -10%; height: 75vh; z-index: 0;
      background: radial-gradient(60% 60% at 20% 30%, rgba(58,160,255,.22), transparent 60%),
                  radial-gradient(60% 60% at 80% 40%, rgba(47,215,196,.18), transparent 60%),
                  radial-gradient(50% 50% at 50% 80%, rgba(255,92,122,.18), transparent 60%);
      filter: blur(40px) saturate(110%);
      pointer-events: none;
    }

    .decor-grid {
      position: fixed; inset: 0; z-index: 0;
      background-image:
        linear-gradient(rgba(231,238,247,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(231,238,247,0.06) 1px, transparent 1px);
      background-size: 28px 28px, 28px 28px;
      mask-image: radial-gradient(circle at 50% 50%, rgba(0,0,0,0.85), transparent 70%);
      pointer-events: none;
    }

    .orb {
      position: fixed; width: 380px; height: 380px; border-radius: 50%; filter: blur(90px);
      opacity: .55; z-index: 0; pointer-events: none; mix-blend-mode: screen;
    }
    .orb.teal { background: #2fd7c4; top: -80px; left: -60px; }
    .orb.pink { background: #ff5c7a; bottom: -70px; right: 10%; }

    /* Wave at bottom using SVG */
    .wave-wrap { position: fixed; left: 0; right: 0; bottom: -1px; z-index: 0; opacity: .55; }
    .wave-wrap svg { width: 100%; height: auto; display: block; }

    /* =========================================================
       4) CONTAINER & CARD
       ========================================================= */
    .container-auth { position: relative; z-index: 2; width: min(100% - 32px, 1100px); margin-inline: auto; }

    .card-auth {
      display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 0;
      background: var(--card-bg);
      border-radius: 28px;
      box-shadow: var(--shadow);
      border: 1px solid var(--card-stroke);
      overflow: hidden;
      transform: translateY(12px);
      animation: cardIn .9s cubic-bezier(.2,.7,.2,1) both;
    }

    @keyframes cardIn {
      from { opacity: 0; transform: translateY(40px) scale(.98); }
      to   { opacity: 1; transform: translateY(12px) scale(1); }
    }

    /* Left pane (brand) */
    .pane-brand {
      position: relative; padding: 48px 40px; display: grid; place-items: center;
      background: linear-gradient(160deg, rgba(58,160,255,0.15), rgba(47,215,196,0.14));
      border-right: 1px solid var(--card-stroke);
      isolation: isolate;
    }

    .brand-inner { text-align: center; max-width: 520px; }

    .brand-logo {
      width: var(--logo-size); height: var(--logo-size); border-radius: 22px;
      display: grid; place-items: center; overflow: hidden; margin: 0 auto 20px;
      background: radial-gradient(50% 50% at 50% 50%, rgba(255,255,255,0.18), rgba(255,255,255,0.06));
      border: 1px solid var(--card-stroke);
      box-shadow: 0 20px 60px rgba(0,0,0,0.25), 0 0 0 6px rgba(58,160,255,0.06);
      transition: transform .35s ease, box-shadow .35s ease;
    }
    .brand-logo img { width: 82%; height: auto; display: block; filter: drop-shadow(0 6px 14px rgba(0,0,0,.25)); }
    .brand-logo:hover { transform: translateY(-4px) scale(1.02); box-shadow: 0 26px 80px rgba(0,0,0,0.32), 0 0 0 8px rgba(58,160,255,0.08); }

    .brand-title { font-weight: 700; letter-spacing: .2px; font-size: clamp(20px, 2vw, 26px); margin: 4px 0 6px; color: var(--text); }
    .brand-sub   { color: var(--text-dim); font-size: 14px; }

    /* Right pane (form) */
    .pane-form { padding: 44px 40px; display: grid; align-content: center; justify-items: center; }
    .form-wrap { width: min(100%, 420px); }

    /* =========================================================
       5) FORM ELEMENTS (Floating labels + states)
       ========================================================= */
    .form-title { font-weight: 600; font-size: 22px; margin-bottom: 12px; }
    .form-desc { color: var(--text-dim); font-size: 13px; margin-bottom: 22px; }

    .floating-group { position: relative; margin-bottom: 18px; }
    .floating-input {
      width: 100%; padding: 14px 14px 14px 46px; border-radius: var(--radius-md);
      border: 1px solid var(--card-stroke);
      background: var(--input-bg); color: var(--text); outline: none; transition: box-shadow .25s, background .25s, border-color .25s; caret-color: var(--brand-2);
    }
    .floating-input::placeholder { color: transparent; }
    .floating-input:focus { background: var(--input-bg-focus); box-shadow: var(--focus-ring); border-color: transparent; }

    .floating-label {
      position: absolute; left: 46px; top: 50%; transform: translateY(-50%);
      font-size: 14px; color: var(--text-dim); pointer-events: none; transition: all .2s ease;
      background: transparent; padding: 0 .25rem;
    }

    /* Shrink label when focused or has value */
    .floating-input:focus + .floating-label,
    .floating-input:not(:placeholder-shown) + .floating-label {
      top: -8px; left: 40px; font-size: 12px; color: var(--brand-2);
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
      border-radius: 12px;
    }

    /* Prefix icon */
    .field-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); opacity: .8; }
    .field-icon svg { width: 20px; height: 20px; display: block; }

    /* Password toggle button */
    .toggle-pass {
      position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
      border: none; background: transparent; color: var(--text-dim); cursor: pointer; padding: 6px 10px; border-radius: var(--radius-sm);
    }
    .toggle-pass:focus { box-shadow: var(--ring-muted); }

    /* Helper row */
    .helper-row { display: flex; align-items: center; justify-content: space-between; margin: 10px 2px 18px; }

    /* Custom checkbox */
    .check {
      appearance: none; width: 18px; height: 18px; border-radius: 4px; margin-right: 8px;
      background: var(--input-bg); border: 1px solid var(--card-stroke);
      display: inline-grid; place-items: center; transition: background .2s, border-color .2s, box-shadow .2s;
    }
    .check:focus { box-shadow: var(--ring-muted); }
    .check:checked { background: linear-gradient(180deg, var(--brand), var(--brand-2)); border-color: transparent; }
    .check:checked::after { content: ""; width: 10px; height: 10px; background: white; border-radius: 2px; }

    .label-inline { font-size: 13px; color: var(--text-dim); cursor: pointer; }

    /* Submit button */
    .btn-submit {
      width: 100%; padding: 14px; border: none; border-radius: var(--radius-md);
      color: white; font-weight: 600; letter-spacing: .2px; cursor: pointer; position: relative; overflow: hidden;
      background: linear-gradient(135deg, var(--brand), var(--brand-2)); box-shadow: 0 10px 25px rgba(58,160,255,0.25);
      transition: transform .2s ease, box-shadow .3s ease;
    }
    .btn-submit:hover   { transform: translateY(-2px); box-shadow: 0 16px 34px rgba(58,160,255,0.35); }
    .btn-submit:active  { transform: translateY(0);   box-shadow: 0 8px 20px rgba(58,160,255,0.25); }
    .btn-submit:focus   { outline: none; box-shadow: var(--focus-ring); }

    /* Error / status alert */
    .alert-inline { background: rgba(255, 92, 122, .1); color: #ffd9e1; border: 1px solid rgba(255,92,122,.35); border-radius: 12px; font-size: 13px; padding: 10px 12px; }
    [data-theme="light"] .alert-inline { background: #ffecef; color: #9a1230; border-color: #ffc6d1; }

    .footer-links { margin-top: 18px; font-size: 12px; color: var(--text-dim); text-align: center; }
    .footer-links a { color: var(--text-dim); text-decoration: none; }
    .footer-links a:hover { color: var(--text); text-decoration: underline; }

    /* =========================================================
       6) THEME SWITCHER BUTTON
       ========================================================= */
    .theme-toggle {
      position: fixed; top: 18px; right: 18px; z-index: 5;
      border: 1px solid var(--card-stroke); border-radius: 999px; padding: 8px 12px;
      background: var(--card-bg); color: var(--text); display: flex; gap: 8px; align-items: center;
      box-shadow: var(--shadow); backdrop-filter: var(--blur);
      transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .theme-toggle:hover { transform: translateY(-1px); box-shadow: 0 14px 26px rgba(0,0,0,.22); }
    .theme-toggle span { font-size: 12px; color: var(--text-dim); }
    .theme-toggle svg { width: 18px; height: 18px; }

    /* =========================================================
       7) RESPONSIVE ADJUSTMENTS
       ========================================================= */
    @media (max-width: 992px) {
      .card-auth { grid-template-columns: 1fr; }
      .pane-brand { padding: 36px 24px; border-right: none; border-bottom: 1px solid var(--card-stroke); }
      .pane-form  { padding: 32px 24px 40px; }
      :root { --logo-size: 150px; }
    }

    @media (max-width: 560px) {
      .brand-title { font-size: 20px; }
      .brand-sub   { font-size: 12px; }
      .form-title  { font-size: 20px; }
      .form-desc   { font-size: 12px; }
      :root { --logo-size: 140px; }
    }

    /* =========================================================
       8) ACCESSIBILITY HELPERS
       ========================================================= */
    .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
    .kbd { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; background: rgba(231,238,247,.12); border: 1px solid var(--card-stroke); border-radius: 6px; padding: 0 6px; }

    /* =========================================================
       9) EXTRA MICRO INTERACTIONS
       ========================================================= */
    .shake { animation: shake .45s cubic-bezier(.36,.07,.19,.97) both; }
    @keyframes shake {
      10%, 90% { transform: translateX(-1px); }
      20%, 80% { transform: translateX(2px); }
      30%, 50%, 70% { transform: translateX(-4px); }
      40%, 60% { transform: translateX(4px); }
    }

    .fade-slide { animation: fadeSlide .8s cubic-bezier(.2,.7,.2,1) both; }
    @keyframes fadeSlide {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

  </style>
</head>
<body>
  <!-- ================== DECOR LAYERS ================== -->
  <div class="decor-aurora" aria-hidden="true"></div>
  <div class="decor-grid" aria-hidden="true"></div>
  <div class="orb teal" aria-hidden="true"></div>
  <div class="orb pink" aria-hidden="true"></div>

  <!-- Bottom Wave -->
  <div class="wave-wrap" aria-hidden="true">
    <svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path fill="rgba(231,238,247,0.15)" d="M0,80 C240,90 240,20 480,30 C720,40 720,110 960,100 C1200,90 1200,30 1440,40 L1440,120 L0,120 Z"></path>
    </svg>
  </div>

  <!-- ================== THEME TOGGLE ================== -->
  <button class="theme-toggle" type="button" id="themeToggle" aria-label="Toggle tema">
    <!-- sun/moon icon -->
    <svg id="iconSun" viewBox="0 0 24 24" fill="currentColor"><path d="M6.76 4.84l-1.8-1.79-1.41 1.41 1.79 1.8 1.42-1.42zm10.48 0l1.79-1.79 1.41 1.41-1.79 1.8-1.41-1.42zM12 4V1h-0v3h0zm0 19v-3h0v3h0zM4 13H1v-0h3v0zm19 0h-3v0h3v0zM6.76 19.16l-1.42 1.42-1.79-1.8 1.41-1.41 1.8 1.79zM19.16 17.24l1.41 1.41-1.79 1.8-1.42-1.42 1.8-1.79zM12 7a5 5 0 100 10 5 5 0 000-10z"/></svg>
    <svg id="iconMoon" viewBox="0 0 24 24" fill="currentColor" style="display:none"><path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/></svg>
    <span id="themeLabel">Light</span>
  </button>

  <!-- ================== MAIN CONTAINER ================== -->
  <main class="container-auth fade-slide">
    <section class="card-auth">
      <!-- BRAND PANE -->
      <aside class="pane-brand">
        <div class="brand-inner">
          <div class="brand-logo" title="SMKN 1 Cirebon">
            <!-- LOGO BESAR (ambil dari storage) -->
            <img src="{{ asset('storage/foto/logo.png') }}" alt="Logo SMKN 1 Cirebon" />
          </div>
          <h1 class="brand-title">SMK Negeri 1 Cirebon</h1>
          <p class="brand-sub">Portal Login — akses hanya untuk akun yang ditentukan oleh admin.</p>
        </div>
      </aside>

      <!-- FORM PANE -->
      <section class="pane-form">
        <div class="form-wrap">
          <h2 class="form-title">Masuk ke Akun</h2>
          <p class="form-desc">Gunakan email dan password yang diberikan. Butuh bantuan? Tekan <span class="kbd">F1</span> atau hubungi admin.</p>

          <!-- Laravel errors / status -->
          @if (session('status'))
            <div class="alert-inline mb-3" role="alert">{{ session('status') }}</div>
          @endif
          @if ($errors->any())
            <div class="alert-inline mb-3" role="alert">{{ $errors->first() }}</div>
          @endif

          <!-- FORM START -->
          <form method="POST" action="{{ route('login') }}" novalidate id="loginForm">
            @csrf

            <!-- EMAIL -->
            <div class="floating-group">
              <span class="field-icon" aria-hidden="true">
                <!-- email icon -->
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5L4 8V6l8 5 8-5v2z"/></svg>
              </span>
              <input class="floating-input" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="username" />
              <label class="floating-label" for="email">Email</label>
            </div>

            <!-- PASSWORD with toggle -->
            <div class="floating-group" style="margin-bottom: 8px;">
              <span class="field-icon" aria-hidden="true">
                <!-- lock icon -->
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 17a2 2 0 100-4 2 2 0 000 4zm6-6h-1V9a5 5 0 10-10 0v2H6c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-7c0-1.1-.9-2-2-2zm-3 0H9V9a3 3 0 016 0v2z"/></svg>
              </span>
              <input class="floating-input" type="password" id="password" name="password" placeholder="Password" required autocomplete="current-password" />
              <label class="floating-label" for="password">Password</label>
              <button class="toggle-pass" type="button" id="togglePass" aria-label="Tampilkan password">
                <!-- eye icon -->
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 12a4.5 4.5 0 110-9 4.5 4.5 0 010 9zm0-7a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"/></svg>
              </button>
            </div>

            <!-- REMEMBER & FORGOT -->
            <div class="helper-row">
              <label class="d-inline-flex align-items-center" for="remember">
                <input class="check" type="checkbox" id="remember" name="remember" />
                <span class="label-inline">Ingat saya</span>
              </label>
              <a href="{{ route('password.request') }}" class="label-inline">Lupa password?</a>
            </div>

            <!-- SUBMIT -->
            <button type="submit" class="btn-submit" id="btnSubmit">Login</button>

            <!-- SECURITY INFO / FOOTER -->
            <div class="footer-links">
              <p class="mt-3 mb-0">Dengan masuk, Anda menyetujui <a href="#">Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>.</p>
              <p class="mb-0">Hak akses ditetapkan oleh admin. Tidak memiliki akun? Hubungi admin sekolah.</p>
            </div>
          </form>
        </div>
      </section>
    </section>
  </main>

  <!-- ================== SCRIPTS ================== -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // =========================================================
    // THEME PERSISTENCE (Dark / Light)
    // =========================================================
    (function() {
      const root = document.documentElement;
      const toggle = document.getElementById('themeToggle');
      const iconSun = document.getElementById('iconSun');
      const iconMoon = document.getElementById('iconMoon');
      const label = document.getElementById('themeLabel');

      // read saved theme
      const saved = localStorage.getItem('theme') || 'dark';
      if (saved === 'light') {
        root.setAttribute('data-theme', 'light');
        iconSun.style.display = 'none';
        iconMoon.style.display = 'block';
        label.textContent = 'Dark';
      } else {
        root.removeAttribute('data-theme');
        iconSun.style.display = 'block';
        iconMoon.style.display = 'none';
        label.textContent = 'Light';
      }

      toggle.addEventListener('click', () => {
        const isLight = root.getAttribute('data-theme') === 'light';
        if (isLight) {
          root.removeAttribute('data-theme');
          localStorage.setItem('theme', 'dark');
          iconSun.style.display = 'block';
          iconMoon.style.display = 'none';
          label.textContent = 'Light';
        } else {
          root.setAttribute('data-theme', 'light');
          localStorage.setItem('theme', 'light');
          iconSun.style.display = 'none';
          iconMoon.style.display = 'block';
          label.textContent = 'Dark';
        }
      });
    })();

    // =========================================================
    // PASSWORD TOGGLE
    // =========================================================
    (function() {
      const input = document.getElementById('password');
      const btn = document.getElementById('togglePass');
      btn.addEventListener('click', () => {
        const isPass = input.getAttribute('type') === 'password';
        input.setAttribute('type', isPass ? 'text' : 'password');
        btn.setAttribute('aria-label', isPass ? 'Sembunyikan password' : 'Tampilkan password');
      });
    })();

    // =========================================================
    // CLIENT VALIDATION LIGHT (optional)
    // =========================================================
    (function() {
      const form = document.getElementById('loginForm');
      const submit = document.getElementById('btnSubmit');
      form.addEventListener('submit', function(e) {
        // simple check
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        let ok = true;
        if (!email.value.trim()) { ok = false; email.classList.add('shake'); setTimeout(()=>email.classList.remove('shake'), 500); }
        if (!password.value.trim()) { ok = false; password.classList.add('shake'); setTimeout(()=>password.classList.remove('shake'), 500); }
        if (!ok) {
          e.preventDefault();
        } else {
          // micro feedback
          submit.disabled = true;
          submit.textContent = 'Memproses…';
        }
      });
    })();

    // =========================================================
    // ACCESSIBILITY: F1 to help link
    // =========================================================
    (function(){
      window.addEventListener('keydown', (ev) => {
        if (ev.key === 'F1') {
          ev.preventDefault();
          alert('Hubungi admin sekolah untuk bantuan reset password atau akses akun.');
        }
      });
    })();
  </script>
</body>
</html>
