<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prahari | Management System</title>
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f172a;
            --primary-light: #1e293b;
            --accent: #3b82f6;
            --accent-hover: #2563eb;
            --surface: #ffffff;
            --bg: #f8fafc;
            --text: #334155;
            --text-light: #64748b;
            --border: #e2e8f0;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); overflow-x: hidden; }

        /* Navbar */
        .navbar-custom {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            padding: 1rem 0;
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            transition: box-shadow 0.3s;
        }
        .navbar-custom.scrolled { box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .nav-brand {
            font-weight: 800; font-size: 1.5rem; color: var(--primary);
            text-decoration: none; display: flex; align-items: center; gap: 0.6rem;
        }
        .nav-brand .brand-dot {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), #6366f1);
            display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.1rem;
        }
        .btn-login {
            background: var(--primary); color: #fff; border: none;
            padding: 0.6rem 1.6rem; border-radius: 8px; font-weight: 600;
            font-size: 0.9rem; text-decoration: none;
            transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.4rem;
        }
        .btn-login:hover { background: var(--primary-light); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(15,23,42,0.15); }

        /* Hero */
        .hero {
            min-height: 100vh; display: flex; align-items: center;
            padding-top: 80px; position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; top: -200px; right: -200px;
            width: 600px; height: 600px; border-radius: 50%;
            background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero::after {
            content: ''; position: absolute; bottom: -150px; left: -150px;
            width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.06) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(59,130,246,0.08); color: var(--accent);
            padding: 0.45rem 1rem; border-radius: 50px;
            font-size: 0.85rem; font-weight: 600; margin-bottom: 1.5rem;
            border: 1px solid rgba(59,130,246,0.15);
        }
        .hero-title {
            font-size: 3.5rem; font-weight: 800; color: var(--primary);
            line-height: 1.1; margin-bottom: 1.5rem; letter-spacing: -0.03em;
        }
        .hero-title .gradient-text {
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-desc {
            font-size: 1.15rem; color: var(--text-light); line-height: 1.7;
            max-width: 520px; margin-bottom: 2.5rem;
        }
        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--accent), #6366f1);
            color: #fff; border: none; padding: 0.85rem 2rem; border-radius: 10px;
            font-weight: 600; font-size: 1rem; text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.5rem;
            transition: all 0.25s; box-shadow: 0 4px 15px rgba(59,130,246,0.25);
        }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(59,130,246,0.35); color: #fff; }
        .btn-hero-secondary {
            background: var(--surface); color: var(--primary); border: 1.5px solid var(--border);
            padding: 0.85rem 2rem; border-radius: 10px; font-weight: 600;
            font-size: 1rem; text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.25s;
        }
        .btn-hero-secondary:hover { border-color: var(--accent); color: var(--accent); transform: translateY(-2px); }

        /* Stats Floating Card */
        .hero-visual {
            position: relative; display: flex; justify-content: center; align-items: center;
        }
        .stats-card {
            background: var(--surface); border-radius: 20px; padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.06); border: 1px solid var(--border);
            width: 100%; max-width: 420px; position: relative;
        }
        .stats-card::before {
            content: ''; position: absolute; top: -1px; left: 40px; right: 40px; height: 3px;
            background: linear-gradient(90deg, var(--accent), #8b5cf6); border-radius: 0 0 4px 4px;
        }
        .stat-row { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid #f1f5f9; }
        .stat-row:last-child { border-bottom: none; }
        .stat-icon {
            width: 44px; height: 44px; border-radius: 12px; display: flex;
            align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;
        }
        .stat-icon.blue { background: rgba(59,130,246,0.1); color: var(--accent); }
        .stat-icon.purple { background: rgba(139,92,246,0.1); color: #8b5cf6; }
        .stat-icon.green { background: rgba(34,197,94,0.1); color: #22c55e; }
        .stat-icon.amber { background: rgba(245,158,11,0.1); color: #f59e0b; }
        .stat-label { font-size: 0.85rem; color: var(--text-light); }
        .stat-value { font-size: 1.3rem; font-weight: 700; color: var(--primary); }

        /* Features */
        .features { padding: 6rem 0; background: var(--surface); }
        .section-label {
            display: inline-flex; align-items: center; gap: 0.4rem;
            font-size: 0.8rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.1em; color: var(--accent); margin-bottom: 0.75rem;
        }
        .section-title { font-size: 2.2rem; font-weight: 800; color: var(--primary); margin-bottom: 1rem; letter-spacing: -0.02em; }
        .section-desc { font-size: 1.05rem; color: var(--text-light); max-width: 550px; margin: 0 auto 3.5rem; }
        .feature-card {
            background: var(--bg); border: 1px solid var(--border); border-radius: 16px;
            padding: 2rem; height: 100%; transition: all 0.3s;
        }
        .feature-card:hover { transform: translateY(-6px); box-shadow: 0 15px 40px rgba(0,0,0,0.06); border-color: rgba(59,130,246,0.2); }
        .feature-card .icon-wrap {
            width: 52px; height: 52px; border-radius: 14px; display: flex;
            align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.25rem;
        }
        .feature-card h5 { font-weight: 700; color: var(--primary); margin-bottom: 0.5rem; font-size: 1.1rem; }
        .feature-card p { color: var(--text-light); font-size: 0.92rem; line-height: 1.6; margin: 0; }

        /* CTA */
        .cta {
            padding: 5rem 0; background: var(--primary);
            background-image: linear-gradient(135deg, var(--primary) 0%, #1e293b 100%);
            position: relative; overflow: hidden;
        }
        .cta::before {
            content: ''; position: absolute; top: -100px; right: -100px;
            width: 400px; height: 400px; border-radius: 50%;
            background: rgba(59,130,246,0.08); pointer-events: none;
        }
        .cta-title { font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 1rem; }
        .cta-desc { color: rgba(255,255,255,0.6); font-size: 1.05rem; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto; }
        .btn-cta {
            background: #fff; color: var(--primary); border: none;
            padding: 0.85rem 2.2rem; border-radius: 10px; font-weight: 700;
            font-size: 1rem; text-decoration: none; display: inline-flex;
            align-items: center; gap: 0.5rem; transition: all 0.25s;
        }
        .btn-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.2); color: var(--primary); }

        /* Footer */
        .footer { padding: 2.5rem 0; background: var(--bg); border-top: 1px solid var(--border); }
        .footer-text { color: var(--text-light); font-size: 0.85rem; }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-title { font-size: 2.5rem; }
            .hero-visual { margin-top: 3rem; }
        }
        @media (max-width: 575px) {
            .hero-title { font-size: 2rem; }
            .hero { padding-top: 100px; }
            .hero-actions { flex-direction: column; }
            .stats-card { padding: 1.5rem; }
        }

        /* Animations */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .animate-in { animation: fadeUp 0.7s ease forwards; }
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.25s; opacity: 0; }
        .delay-3 { animation-delay: 0.4s; opacity: 0; }
        .delay-4 { animation-delay: 0.55s; opacity: 0; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar-custom" id="mainNav">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="nav-brand">
                <span class="brand-dot"><i class="bi bi-shield-check"></i></span>
                Prahari
            </a>
            <div class="d-flex align-items-center gap-3">
                @auth
                    <a href="{{ route('dashboardAdmin') }}" class="btn-login">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="animate-in delay-1">
                        <span class="hero-badge"><i class="bi bi-lightning-fill"></i> Secure & Reliable Platform</span>
                    </div>
                    <h1 class="hero-title animate-in delay-2">
                        Smarter<br><span class="gradient-text">Prahari Management</span><br>Starts Here.
                    </h1>
                    <p class="hero-desc animate-in delay-3">
                        A centralized platform to manage Prahari profiles, track violation cases, process challans, and handle financial transactions — all in one secure dashboard.
                    </p>
                    <div class="hero-actions animate-in delay-4">
                        @auth
                            <a href="{{ route('dashboardAdmin') }}" class="btn-hero-primary">
                                Open Dashboard <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-hero-primary">
                                Get Started <i class="bi bi-arrow-right"></i>
                            </a>
                        @endauth
                        <a href="#features" class="btn-hero-secondary">
                            <i class="bi bi-play-circle"></i> Explore Features
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 hero-visual">
                    <div class="stats-card animate-in delay-3">
                        <h6 class="fw-bold mb-3" style="color: var(--primary);">Platform Overview</h6>
                        <div class="stat-row">
                            <div class="stat-icon blue"><i class="bi bi-people-fill"></i></div>
                            <div class="flex-grow-1">
                                <div class="stat-label">Active Praharis</div>
                                <div class="stat-value">1,200+</div>
                            </div>
                        </div>
                        <div class="stat-row">
                            <div class="stat-icon purple"><i class="bi bi-briefcase-fill"></i></div>
                            <div class="flex-grow-1">
                                <div class="stat-label">Cases Tracked</div>
                                <div class="stat-value">8,500+</div>
                            </div>
                        </div>
                        <div class="stat-row">
                            <div class="stat-icon green"><i class="bi bi-currency-rupee"></i></div>
                            <div class="flex-grow-1">
                                <div class="stat-label">Challans Processed</div>
                                <div class="stat-value">₹42L+</div>
                            </div>
                        </div>
                        <div class="stat-row">
                            <div class="stat-icon amber"><i class="bi bi-shield-fill-check"></i></div>
                            <div class="flex-grow-1">
                                <div class="stat-label">Violations Resolved</div>
                                <div class="stat-value">95%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features" id="features">
        <div class="container text-center">
            <div class="section-label"><i class="bi bi-stars"></i> CORE CAPABILITIES</div>
            <h2 class="section-title">Everything You Need to Manage</h2>
            <p class="section-desc">From field operations to financial audits — Prahari covers every aspect of enforcement management.</p>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="icon-wrap" style="background:rgba(59,130,246,0.1);color:#3b82f6;">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <h5>Prahari Profiles</h5>
                        <p>Onboard, manage and track all field Praharis with detailed profiles and bank information.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="icon-wrap" style="background:rgba(139,92,246,0.1);color:#8b5cf6;">
                            <i class="bi bi-folder2-open"></i>
                        </div>
                        <h5>Case Tracking</h5>
                        <p>Monitor violation cases from report to resolution with full status and approval workflows.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="icon-wrap" style="background:rgba(34,197,94,0.1);color:#22c55e;">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>
                        <h5>Challan Engine</h5>
                        <p>Generate, assign and track challans with automated calculations and audit trails.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="icon-wrap" style="background:rgba(245,158,11,0.1);color:#f59e0b;">
                            <i class="bi bi-wallet-fill"></i>
                        </div>
                        <h5>Payments & Payouts</h5>
                        <p>Process transactions, approve withdrawal requests, and maintain financial transparency.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta text-center">
        <div class="container position-relative">
            <h2 class="cta-title">Ready to Get Started?</h2>
            <p class="cta-desc">Login to access the admin portal and start managing your operations efficiently.</p>
            @auth
                <a href="{{ route('dashboardAdmin') }}" class="btn-cta">Go to Dashboard <i class="bi bi-arrow-right"></i></a>
            @else
                <a href="{{ route('login') }}" class="btn-cta">Login to Portal <i class="bi bi-arrow-right"></i></a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="footer-text">&copy; {{ date('Y') }} Prahari Management System. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Navbar shadow on scroll
        window.addEventListener('scroll', function() {
            document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 10);
        });
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function(e) {
                e.preventDefault();
                const t = document.querySelector(this.getAttribute('href'));
                if (t) t.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    </script>
</body>
</html>
