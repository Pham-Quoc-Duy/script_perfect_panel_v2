<!DOCTYPE html>
<html lang="vi" id="html-root">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $config->title ?? 'NexaSMM' }} — Social Media Marketing Panel</title>
    <meta name="description" content="{{ $config->description ?? 'SMM Panel hàng đầu Việt Nam' }}">
    <meta name="keywords" content="{{ $config->keywords ?? 'smm panel, social media marketing' }}">
    <link rel="icon" href="{{ $config->favicon ? asset($config->favicon) : '/assets/media/favicon.ico' }}">
    <meta property="og:title" content="{{ $config->title ?? 'NexaSMM' }}">
    <meta property="og:description" content="{{ $config->description ?? 'SMM Panel hàng đầu Việt Nam' }}">
    @if ($config->og_image)
        <meta property="og:image" content="{{ asset($config->og_image) }}">
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --c-cyan: #00f5ff;
            --c-violet: #7c3aed;
            --c-dark: #020617;
            --c-card: rgba(255, 255, 255, 0.04);
            --c-border: rgba(0, 245, 255, 0.15);
            --font-main: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-main);
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background: var(--c-dark);
            color: #e2e8f0;
            overflow-x: hidden;
            letter-spacing: -0.01em;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        body.ready {
            opacity: 1;
        }

        h1,
        h2,
        h3 {
            font-family: var(--font-main);
            letter-spacing: -0.03em;
            font-weight: 800;
        }

        #canvas-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .above {
            position: relative;
            z-index: 1;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            backdrop-filter: blur(18px);
            background: rgba(2, 6, 23, 0.7);
            border-bottom: 1px solid var(--c-border);
        }

        /* Glowing text */
        .glow-text {
            text-shadow: 0 0 40px rgba(0, 245, 255, 0.5), 0 0 80px rgba(124, 58, 237, 0.3);
        }

        .glow-btn {
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.35), inset 0 0 20px rgba(0, 245, 255, 0.05);
            transition: box-shadow 0.3s, transform 0.2s;
        }

        .glow-btn:hover {
            box-shadow: 0 0 35px rgba(0, 245, 255, 0.6), inset 0 0 30px rgba(0, 245, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Cards */
        .glass-card {
            background: var(--c-card);
            border: 1px solid var(--c-border);
            backdrop-filter: blur(12px);
            transition: border-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        .glass-card:hover {
            border-color: rgba(0, 245, 255, 0.4);
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0, 245, 255, 0.1);
        }

        /* Gradient text */
        .grad-text {
            background: linear-gradient(135deg, #00f5ff 0%, #a78bfa 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Stat counter animation */
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-num {
            animation: countUp 1s ease forwards;
        }

        /* Horizontal scroll ticker */
        .ticker-wrap {
            overflow: hidden;
        }

        .ticker {
            display: flex;
            gap: 3rem;
            animation: ticker-scroll 20s linear infinite;
            white-space: nowrap;
        }

        @keyframes ticker-scroll {
            0% {
                transform: translateX(0)
            }

            100% {
                transform: translateX(-50%)
            }
        }

        /* Pulse ring */
        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 2px solid rgba(0, 245, 255, 0.4);
            animation: pulse-expand 2s ease-out infinite;
        }

        @keyframes pulse-expand {
            0% {
                transform: scale(1);
                opacity: 1
            }

            100% {
                transform: scale(1.6);
                opacity: 0
            }
        }

        /* Pricing highlight */
        .price-popular {
            background: linear-gradient(135deg, rgba(0, 245, 255, 0.12), rgba(124, 58, 237, 0.12));
            border-color: rgba(0, 245, 255, 0.5) !important;
        }

        /* Progress bar */
        .progress-bar {
            height: 4px;
            border-radius: 2px;
            background: linear-gradient(90deg, #00f5ff, #7c3aed);
            box-shadow: 0 0 10px rgba(0, 245, 255, 0.5);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 3px;
        }

        /* Mobile menu */
        #mobile-menu {
            display: none;
        }

        #mobile-menu.open {
            display: block;
        }

        /* Fade in */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Text colors */
        .text-body {
            color: #cbd5e1;
        }

        .text-muted {
            color: #64748b;
        }

        .text-heading {
            color: #f1f5f9;
        }

        .text-label {
            color: #94a3b8;
        }

        /* Button base */
        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid rgba(0, 245, 255, 0.2);
            background: rgba(255, 255, 255, 0.03);
            color: #cbd5e1;
            cursor: pointer;
            transition: all 0.25s;
            text-decoration: none;
            letter-spacing: -0.01em;
        }

        .btn-outline:hover {
            border-color: rgba(0, 245, 255, 0.45);
            color: #f1f5f9;
            background: rgba(0, 245, 255, 0.06);
            transform: translateY(-1px);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            background: linear-gradient(135deg, #00f5ff, #7c3aed);
            color: #020617;
            cursor: pointer;
            transition: all 0.25s;
            text-decoration: none;
            letter-spacing: -0.01em;
            border: none;
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.3), inset 0 0 20px rgba(0, 245, 255, 0.05);
        }

        .btn-primary:hover {
            box-shadow: 0 0 35px rgba(0, 245, 255, 0.55), inset 0 0 30px rgba(0, 245, 255, 0.1);
            transform: translateY(-2px);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            background: transparent;
            color: #94a3b8;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
        }

        .btn-ghost:hover {
            color: #f1f5f9;
            background: rgba(255, 255, 255, 0.05);
        }

        /* Lang switcher */
        .lang-switcher {
            position: relative;
            display: inline-flex;
        }

        .lang-toggle {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid rgba(0, 245, 255, 0.2);
            background: rgba(0, 245, 255, 0.05);
            color: #94a3b8;
            transition: all 0.2s;
            white-space: nowrap;
            outline: none;
        }

        .lang-toggle:hover {
            border-color: rgba(0, 245, 255, 0.4);
            color: #e2e8f0;
            background: rgba(0, 245, 255, 0.09);
        }

        .lang-toggle img {
            width: 18px;
            height: 13px;
            border-radius: 2px;
            object-fit: cover;
            flex-shrink: 0;
            display: block;
        }

        .lang-toggle .chev {
            width: 10px;
            height: 10px;
            transition: transform 0.2s;
            opacity: 0.5;
            flex-shrink: 0;
        }

        .lang-toggle.open .chev {
            transform: rotate(180deg);
        }

        .lang-drop {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #0d1526;
            border: 1px solid rgba(0, 245, 255, 0.18);
            border-radius: 10px;
            overflow: hidden;
            min-width: 148px;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.7);
            z-index: 9999;
        }

        .lang-drop.open {
            display: block;
            animation: fadeDown 0.15s ease;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-4px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .lang-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 10px 14px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            color: #94a3b8;
            transition: all 0.15s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .lang-item:hover {
            background: rgba(0, 245, 255, 0.08);
            color: #e2e8f0;
        }

        .lang-item.active {
            color: #00f5ff;
            background: rgba(0, 245, 255, 0.07);
        }

        .lang-item img {
            width: 18px;
            height: 13px;
            border-radius: 2px;
            object-fit: cover;
            flex-shrink: 0;
            display: block;
        }

        /* Nav link active indicator */
        nav a.nav-link {
            position: relative;
            padding-bottom: 2px;
        }

        nav a.nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #00f5ff;
            transition: width 0.2s;
        }

        nav a.nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body>

    <canvas id="canvas-bg"></canvas>

    <!-- NAVBAR -->
    <!-- NAVBAR -->
    <nav class="above">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-6">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 flex-shrink-0">
                @if ($config->logo_square)
                    <img src="{{ asset($config->logo_square) }}" alt="{{ $config->title }}"
                        class="w-9 h-9 rounded-xl object-contain">
                @else
                    <div class="w-9 h-9 rounded-2xl flex items-center justify-center flex-shrink-0"
                        style="background:linear-gradient(135deg,#00f5ff,#7c3aed);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="white" />
                        </svg>
                    </div>
                @endif
                <span class="text-2xl font-black tracking-tighter text-white"
                    style="letter-spacing:-0.05em;">{{ $config->title ?? 'NexaSMM' }}</span>
            </a>

            {{-- Desktop nav links --}}
            <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-400">
                <li><a href="#services" class="nav-link hover:text-white transition-colors"
                        data-i18n="nav.services">Dịch vụ</a></li>
                <li><a href="#platforms" class="nav-link hover:text-white transition-colors"
                        data-i18n="nav.platforms">Nền tảng</a></li>
                <li><a href="#pricing" class="nav-link hover:text-white transition-colors" data-i18n="nav.pricing">Bảng
                        giá</a></li>
                <li><a href="#stats" class="nav-link hover:text-white transition-colors" data-i18n="nav.stats">Thống
                        kê</a></li>
                <li><a href="#faq" class="nav-link hover:text-white transition-colors">FAQ</a></li>
            </ul>

            {{-- Right side Desktop --}}
            <div class="hidden md:flex items-center gap-3">

                <!-- Language Switcher - Đã cải tiến -->
                <!-- Language Switcher - Đã cải tiến đẹp & mượt -->
                <div class="lang-switcher relative">
                    <button id="lang-toggle" type="button" onclick="toggleLang(event)" class="lang-toggle">

                        <img id="lang-flag" src="https://cdn.whoispanel.com/admin/media/flags/vietnam.svg"
                            alt="VI">

                        <span id="lang-name" class="font-semibold">Tiếng Việt</span>

                        <svg class="chev" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div id="lang-drop" class="lang-drop">
                        <button onclick="setLang('vi'); event.stopPropagation();" id="opt-vi"
                            class="lang-item active">
                            <img src="https://cdn.whoispanel.com/admin/media/flags/vietnam.svg" alt="VI">
                            <span>Tiếng Việt</span>
                        </button>

                        <button onclick="setLang('en'); event.stopPropagation();" id="opt-en" class="lang-item">
                            <img src="https://cdn.whoispanel.com/admin/media/flags/united-states.svg" alt="EN">
                            <span>English</span>
                        </button>
                    </div>
                </div>

                <!-- Buttons -->
                <a href="{{ route('login') }}" class="btn-ghost px-5 py-2.5 text-sm font-medium">
                    Đăng nhập
                </a>

                <a href="{{ route('signup') }}" class="btn-primary px-7 py-3 text-sm font-bold shadow-lg">
                    Bắt đầu ngay
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button id="menu-btn" class="md:hidden text-slate-300 hover:text-white transition p-2"
                onclick="toggleMenu()">
                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden px-6 pb-8 border-t border-cyan-500/10">
            <ul class="flex flex-col gap-2 pt-6 text-base text-slate-300">
                <li><a href="#services" onclick="toggleMenu()"
                        class="block py-3 px-4 hover:bg-white/5 rounded-2xl transition" data-i18n="nav.services">Dịch
                        vụ</a></li>
                <li><a href="#platforms" onclick="toggleMenu()"
                        class="block py-3 px-4 hover:bg-white/5 rounded-2xl transition" data-i18n="nav.platforms">Nền
                        tảng</a></li>
                <li><a href="#pricing" onclick="toggleMenu()"
                        class="block py-3 px-4 hover:bg-white/5 rounded-2xl transition" data-i18n="nav.pricing">Bảng
                        giá</a></li>
                <li><a href="#stats" onclick="toggleMenu()"
                        class="block py-3 px-4 hover:bg-white/5 rounded-2xl transition" data-i18n="nav.stats">Thống
                        kê</a></li>
                <li><a href="#faq" onclick="toggleMenu()"
                        class="block py-3 px-4 hover:bg-white/5 rounded-2xl transition">FAQ</a></li>

                <!-- Mobile Language -->
                <li class="pt-6 pb-2">
                    <div class="text-xs uppercase tracking-widest text-slate-500 mb-3 px-1">Ngôn ngữ</div>
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="setLang('vi')" id="opt-vi-m"
                            class="flex items-center justify-center gap-3 py-4 rounded-2xl border border-cyan-500/30 hover:border-cyan-400 bg-white/5 hover:bg-white/10 transition-all font-medium">
                            <img src="https://cdn.whoispanel.com/admin/media/flags/vietnam.svg" alt="VI"
                                class="w-6 h-4">
                            Tiếng Việt
                        </button>

                        <button onclick="setLang('en')" id="opt-en-m"
                            class="flex items-center justify-center gap-3 py-4 rounded-2xl border border-cyan-500/30 hover:border-cyan-400 bg-white/5 hover:bg-white/10 transition-all font-medium">
                            <img src="https://cdn.whoispanel.com/admin/media/flags/united-states.svg" alt="EN"
                                class="w-6 h-4">
                            English
                        </button>
                    </div>
                </li>

                <li class="pt-4">
                    <a href="{{ route('signup') }}"
                        class="btn-primary w-full py-4 text-base font-bold justify-center">
                        Bắt đầu ngay miễn phí
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- HERO -->
    <section class="above min-h-screen flex items-center justify-center px-6 pt-24 pb-16">
        <div class="max-w-5xl mx-auto text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card text-xs font-medium text-cyan-400 mb-8 fade-in">
                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                <span data-i18n="hero.badge">Hệ thống hoạt động 24/7 — Tốc độ giao hàng #1 Việt Nam</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black leading-[1.05] mb-6 fade-in text-heading"
                style="letter-spacing:-0.04em;">
                <span data-i18n="hero.title1">Tăng trưởng</span> <span class="grad-text glow-text">Social
                    Media</span><br>
                <span data-i18n="hero.title2">với tốc độ ánh sáng</span>
            </h1>
            <p class="text-lg text-body max-w-2xl mx-auto mb-10 fade-in" data-i18n="hero.desc">
                Nền tảng SMM Panel hàng đầu — Followers, Likes, Views, Comments trên mọi mạng xã hội.
                API tích hợp, giá cạnh tranh, giao hàng tự động tức thì.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center fade-in">
                <a href="#pricing" class="btn-primary" data-i18n="hero.cta1">Xem bảng giá →</a>
                <a href="{{ route('signup') }}" class="btn-outline" data-i18n="hero.cta2">Đăng ký miễn phí</a>
            </div>
            <!-- Mini stats row -->
            <div class="grid grid-cols-3 gap-6 max-w-xl mx-auto mt-16 fade-in">
                <div class="text-center">
                    <div class="text-3xl font-extrabold grad-text">500K+</div>
                    <div class="text-xs text-muted mt-1" data-i18n="hero.stat1">Đơn hoàn thành</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold grad-text">12K+</div>
                    <div class="text-xs text-muted mt-1" data-i18n="hero.stat2">Khách hàng tin dùng</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold grad-text">99.8%</div>
                    <div class="text-xs text-muted mt-1" data-i18n="hero.stat3">Uptime đảm bảo</div>
                </div>
            </div>
        </div>
    </section>

    <!-- TICKER -->
    <div class="above py-4 border-y" style="border-color:var(--c-border);">
        <div class="ticker-wrap">
            <div class="ticker">
                <span class="text-cyan-400 text-sm font-medium">⚡ Giao hàng tức thì</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-violet-400 text-sm font-medium">🔒 Bảo mật tuyệt đối</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-pink-400 text-sm font-medium">💳 Thanh toán linh hoạt</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-cyan-400 text-sm font-medium">🌍 Hỗ trợ 50+ nền tảng</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-violet-400 text-sm font-medium">📊 API dành cho reseller</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-pink-400 text-sm font-medium">🎯 Chất lượng cao nhất</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-cyan-400 text-sm font-medium">⚡ Giao hàng tức thì</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-violet-400 text-sm font-medium">🔒 Bảo mật tuyệt đối</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-pink-400 text-sm font-medium">💳 Thanh toán linh hoạt</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-cyan-400 text-sm font-medium">🌍 Hỗ trợ 50+ nền tảng</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-violet-400 text-sm font-medium">📊 API dành cho reseller</span>
                <span class="text-slate-500 text-sm">•</span>
                <span class="text-pink-400 text-sm font-medium">🎯 Chất lượng cao nhất</span>
            </div>
        </div>
    </div>

    <!-- PLATFORMS -->
    <section id="platforms" class="above py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <div class="text-xs text-cyan-400 font-semibold tracking-widest uppercase mb-3"
                    data-i18n="platforms.label">Hỗ trợ đa nền tảng</div>
                <h2 class="text-4xl md:text-5xl font-black text-heading" style="letter-spacing:-0.04em;"><span
                        data-i18n="platforms.title1">Tất cả mạng xã hội</span><br><span class="grad-text"
                        data-i18n="platforms.title2">trong một nơi</span></h2>
            </div>
            <div class="grid grid-cols-3 md:grid-cols-6 gap-4 fade-in">
                <!-- Platform cards -->
                <div class="glass-card rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
                        style="background:linear-gradient(135deg,#833ab4,#fd1d1d,#fcb045);">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-white">Instagram</span>
                    <span class="text-xs text-slate-500">Followers, Likes</span>
                </div>
                <div class="glass-card rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
                        style="background:#1877f2;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-white">Facebook</span>
                    <span class="text-xs text-slate-500">Page Likes, Views</span>
                </div>
                <div class="glass-card rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
                        style="background:linear-gradient(135deg,#ff0050,#010101);">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V9.62a8.27 8.27 0 004.83 1.54V7.71a4.85 4.85 0 01-1.06-.02z" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-white">TikTok</span>
                    <span class="text-xs text-slate-500">Followers, Views</span>
                </div>
                <div class="glass-card rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:#ff0000;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
                            <path
                                d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-white">YouTube</span>
                    <span class="text-xs text-slate-500">Views, Subscribers</span>
                </div>
                <div class="glass-card rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:#1da1f2;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
                            <path
                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-white">Twitter/X</span>
                    <span class="text-xs text-slate-500">Followers, Likes</span>
                </div>
                <div class="glass-card rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                        style="background:linear-gradient(135deg,#0088cc,#29b6f6);">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
                            <path
                                d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-white">Telegram</span>
                    <span class="text-xs text-slate-500">Members, Views</span>
                </div>
            </div>
            <p class="text-center text-sm text-muted mt-6" data-i18n="platforms.more">và 44+ nền tảng khác: Spotify,
                SoundCloud, LinkedIn, Pinterest, Twitch...</p>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="above py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <div class="text-xs text-cyan-400 font-semibold tracking-widest uppercase mb-3"
                    data-i18n="services.label">Dịch vụ nổi bật</div>
                <h2 class="text-4xl md:text-5xl font-black text-heading" style="letter-spacing:-0.04em;"><span
                        data-i18n="services.title1">Mọi thứ bạn cần</span><br><span class="grad-text"
                        data-i18n="services.title2">để viral</span></h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="glass-card rounded-2xl p-7 fade-in">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5"
                        style="background:rgba(0,245,255,0.1);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="#00f5ff" stroke-width="2"
                                stroke-linecap="round" />
                            <circle cx="9" cy="7" r="4" stroke="#00f5ff" stroke-width="2" />
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="#00f5ff"
                                stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-heading mb-3" data-i18n="svc.followers.title">Followers &
                        Subscribers</h3>
                    <p class="text-sm text-body mb-4 leading-relaxed" data-i18n="svc.followers.desc">Tăng lượng theo
                        dõi thực chất, chất lượng cao. Profile không ảo, không bot — chạy từ traffic thật.</p>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-label" data-i18n="svc.speed">Tốc độ giao hàng</span>
                            <span class="text-cyan-400 font-semibold">1K/ngày</span>
                        </div>
                        <div class="progress-bar" style="width:85%"></div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-label" data-i18n="svc.drop">Tỷ lệ rớt</span>
                            <span class="text-green-400 font-semibold">&lt; 2%</span>
                        </div>
                        <div class="progress-bar" style="width:95%;background:linear-gradient(90deg,#22c55e,#16a34a)">
                        </div>
                    </div>
                    <div class="mt-5 text-xs font-semibold text-cyan-400" data-i18n="svc.followers.price">Từ 5,000đ /
                        1000</div>
                </div>

                <div class="glass-card rounded-2xl p-7 fade-in" style="animation-delay:0.1s">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5"
                        style="background:rgba(124,58,237,0.1);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"
                                stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-heading mb-3" data-i18n="svc.likes.title">Likes & Reactions</h3>
                    <p class="text-sm text-body mb-4 leading-relaxed" data-i18n="svc.likes.desc">Tương tác cực nhanh,
                        bắt đầu trong 0–5 phút. Hỗ trợ tất cả loại bài đăng, Reel, Story.</p>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-label" data-i18n="svc.startspeed">Tốc độ bắt đầu</span>
                            <span class="text-violet-400 font-semibold">&lt; 5 phút</span>
                        </div>
                        <div class="progress-bar" style="width:98%;background:linear-gradient(90deg,#7c3aed,#a78bfa)">
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-label" data-i18n="svc.quality">Chất lượng</span>
                            <span class="text-violet-400 font-semibold">Premium</span>
                        </div>
                        <div class="progress-bar" style="width:90%;background:linear-gradient(90deg,#7c3aed,#a78bfa)">
                        </div>
                    </div>
                    <div class="mt-5 text-xs font-semibold text-violet-400" data-i18n="svc.likes.price">Từ 2,000đ /
                        1000</div>
                </div>

                <div class="glass-card rounded-2xl p-7 fade-in" style="animation-delay:0.2s">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5"
                        style="background:rgba(244,114,182,0.1);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <polygon points="23 7 16 12 23 17 23 7" stroke="#f472b6" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"
                                stroke="#f472b6" stroke-width="2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-heading mb-3" data-i18n="svc.views.title">Views & Impressions
                    </h3>
                    <p class="text-sm text-body mb-4 leading-relaxed" data-i18n="svc.views.desc">Lượt xem video,
                        Reels, Stories thực — tăng độ phủ sóng và thuật toán đề xuất của bạn.</p>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-label" data-i18n="svc.maxvol">Volume tối đa</span>
                            <span class="text-pink-400 font-semibold">10M+ views</span>
                        </div>
                        <div class="progress-bar" style="width:92%;background:linear-gradient(90deg,#ec4899,#f472b6)">
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-label" data-i18n="svc.retention">Giữ chân</span>
                            <span class="text-pink-400 font-semibold">60%+</span>
                        </div>
                        <div class="progress-bar" style="width:78%;background:linear-gradient(90deg,#ec4899,#f472b6)">
                        </div>
                    </div>
                    <div class="mt-5 text-xs font-semibold text-pink-400" data-i18n="svc.views.price">Từ 1,000đ / 1000
                    </div>
                </div>

                <div class="glass-card rounded-2xl p-7 fade-in">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5"
                        style="background:rgba(234,179,8,0.1);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" stroke="#eab308"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-heading mb-3" data-i18n="svc.comments.title">Comments</h3>
                    <p class="text-sm text-body mb-4 leading-relaxed" data-i18n="svc.comments.desc">Bình luận thật, đa
                        dạng nội dung. Tùy chỉnh ngôn ngữ và nội dung theo yêu cầu.</p>
                    <div class="mt-5 text-xs font-semibold text-yellow-400" data-i18n="svc.comments.price">Từ 15,000đ
                        / 100</div>
                </div>

                <div class="glass-card rounded-2xl p-7 fade-in" style="animation-delay:0.1s">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5"
                        style="background:rgba(20,184,166,0.1);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" stroke="#14b8a6" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <polyline points="17 6 23 6 23 12" stroke="#14b8a6" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-heading mb-3" data-i18n="svc.api.title">API Reseller</h3>
                    <p class="text-sm text-body mb-4 leading-relaxed" data-i18n="svc.api.desc">Tích hợp API vào hệ
                        thống của bạn. Tài liệu đầy đủ, hỗ trợ JSON, tự động hóa hoàn toàn.</p>
                    <div class="mt-5 text-xs font-semibold text-teal-400" data-i18n="svc.api.price">Miễn phí khi nạp
                        tiền</div>
                </div>

                <div class="glass-card rounded-2xl p-7 fade-in" style="animation-delay:0.2s">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5"
                        style="background:rgba(239,68,68,0.1);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="#ef4444" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-heading mb-3" data-i18n="svc.refill.title">Refill Guarantee</h3>
                    <p class="text-sm text-body mb-4 leading-relaxed" data-i18n="svc.refill.desc">Bảo hành 30–365 ngày
                        tùy gói. Tự động refill nếu rớt followers mà không cần liên hệ.</p>
                    <div class="mt-5 text-xs font-semibold text-red-400" data-i18n="svc.refill.price">Bảo hành suốt 1
                        năm</div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section id="stats" class="above py-24 px-6" style="background:rgba(255,255,255,0.02);">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-4 gap-6 text-center fade-in">
                <div class="glass-card rounded-2xl p-8">
                    <div class="text-5xl font-extrabold grad-text mb-2" data-target="{{ $totalOrders ?? 500000 }}">0
                    </div>
                    <div class="text-sm text-body" data-i18n="stats.orders">Đơn hàng hoàn thành</div>
                </div>
                <div class="glass-card rounded-2xl p-8">
                    <div class="text-5xl font-extrabold grad-text mb-2" data-target="12000">0</div>
                    <div class="text-sm text-body" data-i18n="stats.users">Khách hàng đang dùng</div>
                </div>
                <div class="glass-card rounded-2xl p-8">
                    <div class="text-5xl font-extrabold grad-text mb-2" data-target="{{ $totalServices ?? 50 }}">0
                    </div>
                    <div class="text-sm text-body" data-i18n="stats.services">Dịch vụ hỗ trợ</div>
                </div>
                <div class="glass-card rounded-2xl p-8">
                    <div class="text-5xl font-extrabold grad-text mb-2" data-target="998">0</div>
                    <div class="text-sm text-body" data-i18n="stats.uptime">% Uptime / năm</div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING -->
    <section id="pricing" class="above py-24 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <div class="text-xs text-cyan-400 font-semibold tracking-widest uppercase mb-3"
                    data-i18n="pricing.label">Bảng giá</div>
                <h2 class="text-4xl md:text-5xl font-black text-heading" style="letter-spacing:-0.04em;"><span
                        data-i18n="pricing.title1">Giá cạnh tranh</span><br><span class="grad-text"
                        data-i18n="pricing.title2">minh bạch 100%</span></h2>
                <p class="text-body mt-4 text-sm" data-i18n="pricing.sub">Không phí ẩn. Nạp ngay — dùng ngay.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="glass-card rounded-2xl p-8 fade-in">
                    <div class="text-xs text-muted uppercase tracking-widest mb-3">Starter</div>
                    <div class="text-4xl font-extrabold text-heading mb-1">50K <span
                            class="text-base font-normal text-muted">VNĐ</span></div>
                    <div class="text-xs text-muted mb-6" data-i18n="pricing.starter.sub">Nạp tối thiểu để bắt đầu
                    </div>
                    <ul class="space-y-3 text-sm text-body mb-8">
                        <li class="flex items-center gap-2"><span class="text-cyan-400">✓</span> <span
                                data-i18n="pricing.starter.f1">Truy cập 500+ dịch vụ</span></li>
                        <li class="flex items-center gap-2"><span class="text-cyan-400">✓</span> <span
                                data-i18n="pricing.starter.f2">Giao hàng tức thì</span></li>
                        <li class="flex items-center gap-2"><span class="text-cyan-400">✓</span> <span
                                data-i18n="pricing.starter.f3">Hỗ trợ chat 24/7</span></li>
                        <li class="flex items-center gap-2"><span class="text-slate-600">✗</span> <span
                                class="text-muted">API access</span></li>
                        <li class="flex items-center gap-2"><span class="text-slate-600">✗</span> <span
                                class="text-muted" data-i18n="pricing.starter.f5">Giá reseller</span></li>
                    </ul>
                    <a href="{{ route('signup') }}" class="btn-outline w-full" data-i18n="pricing.topup">Nạp
                        ngay</a>
                </div>

                <div class="rounded-2xl p-8 price-popular glass-card fade-in relative" style="animation-delay:0.1s">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full text-xs font-bold"
                        style="background:linear-gradient(135deg,#00f5ff,#7c3aed);color:#020617;"
                        data-i18n="pricing.popular">⭐ Phổ biến nhất</div>
                    <div class="text-xs text-cyan-400 uppercase tracking-widest mb-3">Pro</div>
                    <div class="text-4xl font-extrabold text-heading mb-1">500K <span
                            class="text-base font-normal text-muted">VNĐ</span></div>
                    <div class="text-xs text-muted mb-6" data-i18n="pricing.pro.sub">Giá reseller unlock từ 500K</div>
                    <ul class="space-y-3 text-sm text-body mb-8">
                        <li class="flex items-center gap-2"><span class="text-cyan-400">✓</span> <span
                                data-i18n="pricing.pro.f1">Tất cả dịch vụ Starter</span></li>
                        <li class="flex items-center gap-2"><span class="text-cyan-400">✓</span> <span
                                data-i18n="pricing.pro.f2">Giảm giá 20–40%</span></li>
                        <li class="flex items-center gap-2"><span class="text-cyan-400">✓</span> <span
                                data-i18n="pricing.pro.f3">API full access</span></li>
                        <li class="flex items-center gap-2"><span class="text-cyan-400">✓</span> <span
                                data-i18n="pricing.pro.f4">Ưu tiên hỗ trợ</span></li>
                        <li class="flex items-center gap-2"><span class="text-slate-600">✗</span> <span
                                class="text-muted">White-label panel</span></li>
                    </ul>
                    <a href="{{ route('signup') }}" class="btn-primary w-full" data-i18n="pricing.topup_pro">Nạp
                        ngay ↗</a>
                </div>

                <div class="glass-card rounded-2xl p-8 fade-in" style="animation-delay:0.2s">
                    <div class="text-xs text-muted uppercase tracking-widest mb-3">Enterprise</div>
                    <div class="text-4xl font-extrabold text-heading mb-1">2M+ <span
                            class="text-base font-normal text-muted">VNĐ</span></div>
                    <div class="text-xs text-muted mb-6" data-i18n="pricing.ent.sub">Dành cho đại lý lớn</div>
                    <ul class="space-y-3 text-sm text-body mb-8">
                        <li class="flex items-center gap-2"><span class="text-violet-400">✓</span> <span
                                data-i18n="pricing.ent.f1">Giá tốt nhất thị trường</span></li>
                        <li class="flex items-center gap-2"><span class="text-violet-400">✓</span> <span>White-label
                                panel</span></li>
                        <li class="flex items-center gap-2"><span class="text-violet-400">✓</span> <span
                                data-i18n="pricing.ent.f3">Account manager riêng</span></li>
                        <li class="flex items-center gap-2"><span class="text-violet-400">✓</span> <span>SLA 99.9%
                                uptime</span></li>
                        <li class="flex items-center gap-2"><span class="text-violet-400">✓</span> <span>Invoice &
                                VAT</span></li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn-outline w-full"
                        style="color:#a78bfa;border-color:rgba(167,139,250,0.3);" data-i18n="pricing.contact">Liên hệ
                        ngay</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="above py-24 px-6" style="background:rgba(255,255,255,0.02);">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-4xl font-extrabold text-heading"><span data-i18n="faq.title1">Câu hỏi</span> <span
                        class="grad-text" data-i18n="faq.title2">thường gặp</span></h2>
            </div>
            <div class="space-y-3 fade-in" id="faq-list">
                <div class="faq-item glass-card rounded-xl overflow-hidden">
                    <button
                        class="faq-q w-full text-left px-6 py-4 font-semibold text-sm text-heading flex justify-between items-center"
                        onclick="toggleFaq(this)">
                        <span data-i18n="faq.q1">SMM Panel là gì và hoạt động như thế nào?</span>
                        <svg class="faq-icon w-4 h-4 text-cyan-400 transition-transform" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-ans hidden px-6 pb-4 text-sm text-body leading-relaxed" data-i18n="faq.a1">
                        SMM Panel là nền tảng cung cấp dịch vụ tăng tương tác mạng xã hội tự động. Bạn đặt đơn, cung cấp
                        link, hệ thống tự xử lý và giao dịch vụ mà không cần can thiệp thủ công.
                    </div>
                </div>
                <div class="faq-item glass-card rounded-xl overflow-hidden">
                    <button
                        class="faq-q w-full text-left px-6 py-4 font-semibold text-sm text-heading flex justify-between items-center"
                        onclick="toggleFaq(this)">
                        <span data-i18n="faq.q2">Dịch vụ có an toàn cho tài khoản của tôi không?</span>
                        <svg class="faq-icon w-4 h-4 text-cyan-400 transition-transform" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-ans hidden px-6 pb-4 text-sm text-body leading-relaxed" data-i18n="faq.a2">
                        Chúng tôi dùng phương pháp giao hàng tự nhiên, không yêu cầu mật khẩu. Gói chất lượng cao sử
                        dụng tài khoản thật, giảm thiểu rủi ro vi phạm chính sách nền tảng.
                    </div>
                </div>
                <div class="faq-item glass-card rounded-xl overflow-hidden">
                    <button
                        class="faq-q w-full text-left px-6 py-4 font-semibold text-sm text-heading flex justify-between items-center"
                        onclick="toggleFaq(this)">
                        <span data-i18n="faq.q3">Tôi có thể tích hợp API vào hệ thống của mình không?</span>
                        <svg class="faq-icon w-4 h-4 text-cyan-400 transition-transform" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-ans hidden px-6 pb-4 text-sm text-body leading-relaxed" data-i18n="faq.a3">
                        Có! API RESTful đầy đủ với tài liệu chi tiết. Hỗ trợ đặt đơn, kiểm tra trạng thái, lấy danh sách
                        dịch vụ và quản lý số dư — tương thích mọi ngôn ngữ lập trình.
                    </div>
                </div>
                <div class="faq-item glass-card rounded-xl overflow-hidden">
                    <button
                        class="faq-q w-full text-left px-6 py-4 font-semibold text-sm text-heading flex justify-between items-center"
                        onclick="toggleFaq(this)">
                        <span data-i18n="faq.q4">Phương thức thanh toán được hỗ trợ?</span>
                        <svg class="faq-icon w-4 h-4 text-cyan-400 transition-transform" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-ans hidden px-6 pb-4 text-sm text-body leading-relaxed" data-i18n="faq.a4">
                        Hỗ trợ: MoMo, ZaloPay, ViettelPay, chuyển khoản ngân hàng, thẻ Visa/Mastercard, USDT/Crypto. Nạp
                        tiền tự động xác nhận trong vòng 1–5 phút.
                    </div>
                </div>
                <div class="faq-item glass-card rounded-xl overflow-hidden">
                    <button
                        class="faq-q w-full text-left px-6 py-4 font-semibold text-sm text-heading flex justify-between items-center"
                        onclick="toggleFaq(this)">
                        <span data-i18n="faq.q5">Nếu đơn hàng không hoàn thành, tôi có được hoàn tiền không?</span>
                        <svg class="faq-icon w-4 h-4 text-cyan-400 transition-transform" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-ans hidden px-6 pb-4 text-sm text-body leading-relaxed" data-i18n="faq.a5">
                        Có. Đơn hàng không hoàn thành hoặc thất bại sẽ được hoàn tiền tự động vào số dư tài khoản trong
                        24 giờ. Liên hệ hỗ trợ nếu cần xử lý sớm hơn.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="above py-24 px-6">
        <div class="max-w-3xl mx-auto text-center fade-in">
            <div class="glass-card rounded-3xl p-12" style="border-color:rgba(0,245,255,0.2);">
                <div class="relative inline-block mb-6">
                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center pulse-ring relative"
                        style="background:linear-gradient(135deg,rgba(0,245,255,0.2),rgba(124,58,237,0.2));border:1px solid rgba(0,245,255,0.3);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="url(#g1)" />
                            <defs>
                                <linearGradient id="g1" x1="0" y1="0" x2="1"
                                    y2="1">
                                    <stop offset="0%" stop-color="#00f5ff" />
                                    <stop offset="100%" stop-color="#7c3aed" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-extrabold text-heading mb-4"><span data-i18n="cta.title1">Sẵn sàng tăng
                        tốc</span><br><span class="grad-text" data-i18n="cta.title2">social media?</span></h2>
                <p class="text-body mb-8 text-sm" data-i18n="cta.sub">Đăng ký miễn phí trong 30 giây. Không cần thẻ
                    tín dụng.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('signup') }}" class="btn-primary" data-i18n="cta.btn1">Tạo tài khoản miễn phí
                        →</a>
                    <a href="{{ route('login') }}" class="btn-outline" data-i18n="cta.btn2">Đăng nhập</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="above border-t py-12 px-6 text-sm text-slate-500" style="border-color:var(--c-border);">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center"
                            style="background:linear-gradient(135deg,#00f5ff,#7c3aed);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" fill="white" />
                            </svg>
                        </div>
                        <span class="font-black text-white tracking-tight"
                            style="letter-spacing:-0.04em;">NexaSMM</span>
                    </div>
                    <p class="text-xs leading-relaxed text-muted" data-i18n="footer.desc">Nền tảng SMM Panel hàng đầu
                        Việt Nam. Giao hàng nhanh, giá tốt, hỗ trợ 24/7.</p>
                </div>
                <div>
                    <div class="font-semibold text-heading mb-4" data-i18n="footer.services">Dịch vụ</div>
                    <ul class="space-y-2 text-xs text-muted">
                        <li>Instagram</li>
                        <li>Facebook</li>
                        <li>TikTok</li>
                        <li>YouTube</li>
                    </ul>
                </div>
                <div>
                    <div class="font-semibold text-heading mb-4" data-i18n="footer.support">Hỗ trợ</div>
                    <ul class="space-y-2 text-xs text-muted">
                        <li data-i18n="footer.api">Tài liệu API</li>
                        <li data-i18n="footer.guide">Hướng dẫn đặt đơn</li>
                        <li data-i18n="footer.refund">Chính sách hoàn tiền</li>
                        <li data-i18n="footer.contact">Liên hệ</li>
                    </ul>
                </div>
                <div>
                    <div class="font-semibold text-heading mb-4" data-i18n="footer.contact_title">Liên hệ</div>
                    <ul class="space-y-2 text-xs text-muted">
                        <li>📧 {{ $config->email ?? 'support@panel.vn' }}</li>
                        <li>💬 Telegram: @{{ $config - > telegram ?? 'support' }}</li>
                        <li data-i18n="footer.support_time">⏰ Hỗ trợ: 24/7</li>
                    </ul>
                </div>
            </div>
            <div class="border-t pt-6 flex flex-col md:flex-row justify-between items-center gap-4"
                style="border-color:var(--c-border);">
                <div class="text-xs text-muted">© {{ date('Y') }} {{ $config->title ?? 'NexaSMM' }}. All rights
                    reserved.</div>
                <div class="flex gap-4 text-xs text-muted"><a href="#" class="hover:text-white transition"
                        data-i18n="footer.terms">Điều khoản</a><a href="#" class="hover:text-white transition"
                        data-i18n="footer.privacy">Bảo mật</a></div>
            </div>
        </div>
    </footer>

    <script>
        // ── THREE.JS BACKGROUND ──────────────────────────────────────────────────────
        (function() {
            const canvas = document.getElementById('canvas-bg');
            const renderer = new THREE.WebGLRenderer({
                canvas,
                alpha: true,
                antialias: true
            });
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.setSize(window.innerWidth, window.innerHeight);

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.set(0, 0, 18);

            // Particle field
            const particleCount = 1800;
            const positions = new Float32Array(particleCount * 3);
            const colors = new Float32Array(particleCount * 3);
            const sizes = new Float32Array(particleCount);

            const palette = [
                new THREE.Color('#00f5ff'),
                new THREE.Color('#7c3aed'),
                new THREE.Color('#f472b6'),
                new THREE.Color('#1e40af'),
            ];

            for (let i = 0; i < particleCount; i++) {
                positions[i * 3] = (Math.random() - 0.5) * 60;
                positions[i * 3 + 1] = (Math.random() - 0.5) * 60;
                positions[i * 3 + 2] = (Math.random() - 0.5) * 40;
                const c = palette[Math.floor(Math.random() * palette.length)];
                colors[i * 3] = c.r;
                colors[i * 3 + 1] = c.g;
                colors[i * 3 + 2] = c.b;
                sizes[i] = Math.random() * 2 + 0.5;
            }

            const pGeo = new THREE.BufferGeometry();
            pGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
            pGeo.setAttribute('color', new THREE.BufferAttribute(colors, 3));
            pGeo.setAttribute('size', new THREE.BufferAttribute(sizes, 1));

            const pMat = new THREE.PointsMaterial({
                size: 0.12,
                vertexColors: true,
                transparent: true,
                opacity: 0.7,
                sizeAttenuation: true,
            });

            const particles = new THREE.Points(pGeo, pMat);
            scene.add(particles);

            // Floating geometric wireframes
            const geos = [
                new THREE.IcosahedronGeometry(2, 0),
                new THREE.OctahedronGeometry(1.5, 0),
                new THREE.TetrahedronGeometry(1.2, 0),
            ];
            const meshes = [];
            geos.forEach((g, i) => {
                const mat = new THREE.MeshBasicMaterial({
                    color: i === 0 ? 0x00f5ff : i === 1 ? 0x7c3aed : 0xf472b6,
                    wireframe: true,
                    transparent: true,
                    opacity: 0.15,
                });
                const m = new THREE.Mesh(g, mat);
                m.position.set((i - 1) * 10, (i % 2 === 0 ? 3 : -3), -5);
                meshes.push(m);
                scene.add(m);
            });

            // Grid floor
            const gridHelper = new THREE.GridHelper(80, 40, 0x00f5ff, 0x0f172a);
            gridHelper.material.opacity = 0.08;
            gridHelper.material.transparent = true;
            gridHelper.position.y = -12;
            gridHelper.rotation.x = 0.15;
            scene.add(gridHelper);

            // Mouse parallax
            let mouseX = 0,
                mouseY = 0;
            document.addEventListener('mousemove', e => {
                mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
                mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
            });

            let t = 0;

            function animate() {
                requestAnimationFrame(animate);
                t += 0.005;
                particles.rotation.y = t * 0.05 + mouseX * 0.03;
                particles.rotation.x = mouseY * 0.02;
                meshes.forEach((m, i) => {
                    m.rotation.x = t * (0.3 + i * 0.1);
                    m.rotation.y = t * (0.2 + i * 0.15);
                    m.position.y = Math.sin(t + i) * 2;
                });
                camera.position.x += (mouseX * 0.5 - camera.position.x) * 0.03;
                camera.position.y += (-mouseY * 0.3 - camera.position.y) * 0.03;
                renderer.render(scene, camera);
            }
            animate();

            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });
        })();

        // ── SCROLL ANIMATIONS ─────────────────────────────────────────────────────────
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));

        // ── COUNTER ANIMATION ─────────────────────────────────────────────────────────
        const counterObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting && !e.target.dataset.done) {
                    e.target.dataset.done = '1';
                    const target = +e.target.dataset.target;
                    const isPercent = target === 998;
                    let cur = 0;
                    const step = Math.max(1, Math.floor(target / 80));
                    const timer = setInterval(() => {
                        cur = Math.min(cur + step, target);
                        if (isPercent) {
                            e.target.textContent = (cur / 10).toFixed(1) + '%';
                        } else if (target >= 1000) {
                            e.target.textContent = (cur / 1000).toFixed(0) + 'K+';
                        } else {
                            e.target.textContent = cur + '+';
                        }
                        if (cur >= target) clearInterval(timer);
                    }, 20);
                }
            });
        }, {
            threshold: 0.3
        });
        document.querySelectorAll('[data-target]').forEach(el => counterObs.observe(el));

        // ── FAQ TOGGLE ────────────────────────────────────────────────────────────────
        function toggleFaq(btn) {
            const ans = btn.nextElementSibling;
            const icon = btn.querySelector('.faq-icon');
            const isOpen = !ans.classList.contains('hidden');
            document.querySelectorAll('.faq-ans').forEach(a => a.classList.add('hidden'));
            document.querySelectorAll('.faq-icon').forEach(i => i.style.transform = '');
            if (!isOpen) {
                ans.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            }
        }

        // ── MOBILE MENU ────────────────────────────────────────────────────────────────
        function toggleMenu() {
            var m = document.getElementById('mobile-menu');
            if (!m) return;
            var isHidden = m.classList.contains('hidden');
            m.classList.toggle('hidden', !isHidden);
        }

        // ── I18N ──────────────────────────────────────────────────────────────────────
        var LANG = {
            vi: {
                'nav.services': 'Dịch vụ',
                'nav.platforms': 'Nền tảng',
                'nav.pricing': 'Bảng giá',
                'nav.stats': 'Thống kê',
                'nav.login': 'Đăng nhập',
                'nav.start': 'Bắt đầu ngay',
                'hero.badge': 'Hệ thống hoạt động 24/7 — Tốc độ giao hàng #1 Việt Nam',
                'hero.title1': 'Tăng trưởng',
                'hero.title2': 'với tốc độ ánh sáng',
                'hero.desc': 'Nền tảng SMM Panel hàng đầu — Followers, Likes, Views, Comments trên mọi mạng xã hội. API tích hợp, giá cạnh tranh, giao hàng tự động tức thì.',
                'hero.cta1': 'Xem bảng giá →',
                'hero.cta2': 'Đăng ký miễn phí',
                'hero.stat1': 'Đơn hoàn thành',
                'hero.stat2': 'Khách hàng tin dùng',
                'hero.stat3': 'Uptime đảm bảo',
                'platforms.label': 'Hỗ trợ đa nền tảng',
                'platforms.title1': 'Tất cả mạng xã hội',
                'platforms.title2': 'trong một nơi',
                'platforms.more': 'và 44+ nền tảng khác: Spotify, SoundCloud, LinkedIn, Pinterest, Twitch...',
                'services.label': 'Dịch vụ nổi bật',
                'services.title1': 'Mọi thứ bạn cần',
                'services.title2': 'để viral',
                'svc.followers.title': 'Followers & Subscribers',
                'svc.followers.desc': 'Tăng lượng theo dõi thực chất, chất lượng cao. Profile không ảo, không bot — chạy từ traffic thật.',
                'svc.followers.price': 'Từ 5,000đ / 1000',
                'svc.likes.title': 'Likes & Reactions',
                'svc.likes.desc': 'Tương tác cực nhanh, bắt đầu trong 0–5 phút. Hỗ trợ tất cả loại bài đăng, Reel, Story.',
                'svc.likes.price': 'Từ 2,000đ / 1000',
                'svc.views.title': 'Views & Impressions',
                'svc.views.desc': 'Lượt xem video, Reels, Stories thực — tăng độ phủ sóng và thuật toán đề xuất của bạn.',
                'svc.views.price': 'Từ 1,000đ / 1000',
                'svc.comments.title': 'Comments',
                'svc.comments.desc': 'Bình luận thật, đa dạng nội dung. Tùy chỉnh ngôn ngữ và nội dung theo yêu cầu.',
                'svc.comments.price': 'Từ 15,000đ / 100',
                'svc.api.title': 'API Reseller',
                'svc.api.desc': 'Tích hợp API vào hệ thống của bạn. Tài liệu đầy đủ, hỗ trợ JSON, tự động hóa hoàn toàn.',
                'svc.api.price': 'Miễn phí khi nạp tiền',
                'svc.refill.title': 'Refill Guarantee',
                'svc.refill.desc': 'Bảo hành 30–365 ngày tùy gói. Tự động refill nếu rớt followers mà không cần liên hệ.',
                'svc.refill.price': 'Bảo hành suốt 1 năm',
                'svc.speed': 'Tốc độ giao hàng',
                'svc.drop': 'Tỷ lệ rớt',
                'svc.startspeed': 'Tốc độ bắt đầu',
                'svc.quality': 'Chất lượng',
                'svc.maxvol': 'Volume tối đa',
                'svc.retention': 'Giữ chân',
                'stats.orders': 'Đơn hàng hoàn thành',
                'stats.users': 'Khách hàng đang dùng',
                'stats.services': 'Dịch vụ hỗ trợ',
                'stats.uptime': '% Uptime / năm',
                'pricing.label': 'Bảng giá',
                'pricing.title1': 'Giá cạnh tranh',
                'pricing.title2': 'minh bạch 100%',
                'pricing.sub': 'Không phí ẩn. Nạp ngay — dùng ngay.',
                'pricing.starter.sub': 'Nạp tối thiểu để bắt đầu',
                'pricing.starter.f1': 'Truy cập 500+ dịch vụ',
                'pricing.starter.f2': 'Giao hàng tức thì',
                'pricing.starter.f3': 'Hỗ trợ chat 24/7',
                'pricing.starter.f5': 'Giá reseller',
                'pricing.popular': '⭐ Phổ biến nhất',
                'pricing.pro.sub': 'Giá reseller unlock từ 500K',
                'pricing.pro.f1': 'Tất cả dịch vụ Starter',
                'pricing.pro.f2': 'Giảm giá 20–40%',
                'pricing.pro.f3': 'API full access',
                'pricing.pro.f4': 'Ưu tiên hỗ trợ',
                'pricing.ent.sub': 'Dành cho đại lý lớn',
                'pricing.ent.f1': 'Giá tốt nhất thị trường',
                'pricing.ent.f3': 'Account manager riêng',
                'pricing.topup': 'Nạp ngay',
                'pricing.topup_pro': 'Nạp ngay ↗',
                'pricing.contact': 'Liên hệ ngay',
                'faq.title1': 'Câu hỏi',
                'faq.title2': 'thường gặp',
                'faq.q1': 'SMM Panel là gì và hoạt động như thế nào?',
                'faq.a1': 'SMM Panel là nền tảng cung cấp dịch vụ tăng tương tác mạng xã hội tự động. Bạn đặt đơn, cung cấp link, hệ thống tự xử lý và giao dịch vụ mà không cần can thiệp thủ công.',
                'faq.q2': 'Dịch vụ có an toàn cho tài khoản của tôi không?',
                'faq.a2': 'Chúng tôi dùng phương pháp giao hàng tự nhiên, không yêu cầu mật khẩu. Gói chất lượng cao sử dụng tài khoản thật, giảm thiểu rủi ro vi phạm chính sách nền tảng.',
                'faq.q3': 'Tôi có thể tích hợp API vào hệ thống của mình không?',
                'faq.a3': 'Có! API RESTful đầy đủ với tài liệu chi tiết. Hỗ trợ đặt đơn, kiểm tra trạng thái, lấy danh sách dịch vụ và quản lý số dư — tương thích mọi ngôn ngữ lập trình.',
                'faq.q4': 'Phương thức thanh toán được hỗ trợ?',
                'faq.a4': 'Hỗ trợ: MoMo, ZaloPay, ViettelPay, chuyển khoản ngân hàng, thẻ Visa/Mastercard, USDT/Crypto. Nạp tiền tự động xác nhận trong vòng 1–5 phút.',
                'faq.q5': 'Nếu đơn hàng không hoàn thành, tôi có được hoàn tiền không?',
                'faq.a5': 'Có. Đơn hàng không hoàn thành hoặc thất bại sẽ được hoàn tiền tự động vào số dư tài khoản trong 24 giờ. Liên hệ hỗ trợ nếu cần xử lý sớm hơn.',
                'cta.title1': 'Sẵn sàng tăng tốc',
                'cta.title2': 'social media?',
                'cta.sub': 'Đăng ký miễn phí trong 30 giây. Không cần thẻ tín dụng.',
                'cta.btn1': 'Tạo tài khoản miễn phí →',
                'cta.btn2': 'Đăng nhập',
                'footer.desc': 'Nền tảng SMM Panel hàng đầu Việt Nam. Giao hàng nhanh, giá tốt, hỗ trợ 24/7.',
                'footer.services': 'Dịch vụ',
                'footer.support': 'Hỗ trợ',
                'footer.contact_title': 'Liên hệ',
                'footer.api': 'Tài liệu API',
                'footer.guide': 'Hướng dẫn đặt đơn',
                'footer.refund': 'Chính sách hoàn tiền',
                'footer.contact': 'Liên hệ',
                'footer.support_time': '⏰ Hỗ trợ: 24/7',
                'footer.terms': 'Điều khoản',
                'footer.privacy': 'Bảo mật',
            },
            en: {
                'nav.services': 'Services',
                'nav.platforms': 'Platforms',
                'nav.pricing': 'Pricing',
                'nav.stats': 'Stats',
                'nav.login': 'Sign In',
                'nav.start': 'Get Started',
                'hero.badge': 'System running 24/7 — #1 Delivery Speed in Vietnam',
                'hero.title1': 'Grow your',
                'hero.title2': 'at the speed of light',
                'hero.desc': 'The leading SMM Panel — Followers, Likes, Views, Comments on every social network. Integrated API, competitive pricing, instant automated delivery.',
                'hero.cta1': 'View Pricing →',
                'hero.cta2': 'Sign Up Free',
                'hero.stat1': 'Orders Completed',
                'hero.stat2': 'Trusted Customers',
                'hero.stat3': 'Uptime Guaranteed',
                'platforms.label': 'Multi-platform Support',
                'platforms.title1': 'All social networks',
                'platforms.title2': 'in one place',
                'platforms.more': 'and 44+ more: Spotify, SoundCloud, LinkedIn, Pinterest, Twitch...',
                'services.label': 'Featured Services',
                'services.title1': 'Everything you need',
                'services.title2': 'to go viral',
                'svc.followers.title': 'Followers & Subscribers',
                'svc.followers.desc': 'High-quality, genuine followers. No fake profiles, no bots — powered by real traffic.',
                'svc.followers.price': 'From $0.20 / 1000',
                'svc.likes.title': 'Likes & Reactions',
                'svc.likes.desc': 'Ultra-fast engagement, starting in 0–5 minutes. Supports all post types, Reels, Stories.',
                'svc.likes.price': 'From $0.08 / 1000',
                'svc.views.title': 'Views & Impressions',
                'svc.views.desc': 'Real video, Reels, Stories views — boost your reach and recommendation algorithm.',
                'svc.views.price': 'From $0.04 / 1000',
                'svc.comments.title': 'Comments',
                'svc.comments.desc': 'Real comments, diverse content. Customize language and content on request.',
                'svc.comments.price': 'From $0.60 / 100',
                'svc.api.title': 'API Reseller',
                'svc.api.desc': 'Integrate our API into your system. Full documentation, JSON support, fully automated.',
                'svc.api.price': 'Free with deposit',
                'svc.refill.title': 'Refill Guarantee',
                'svc.refill.desc': '30–365 day warranty depending on package. Auto-refill if followers drop, no contact needed.',
                'svc.refill.price': '1-year warranty',
                'svc.speed': 'Delivery Speed',
                'svc.drop': 'Drop Rate',
                'svc.startspeed': 'Start Speed',
                'svc.quality': 'Quality',
                'svc.maxvol': 'Max Volume',
                'svc.retention': 'Retention',
                'stats.orders': 'Orders Completed',
                'stats.users': 'Active Customers',
                'stats.services': 'Services Supported',
                'stats.uptime': '% Uptime / year',
                'pricing.label': 'Pricing',
                'pricing.title1': 'Competitive pricing',
                'pricing.title2': '100% transparent',
                'pricing.sub': 'No hidden fees. Deposit now — use now.',
                'pricing.starter.sub': 'Minimum deposit to start',
                'pricing.starter.f1': 'Access 500+ services',
                'pricing.starter.f2': 'Instant delivery',
                'pricing.starter.f3': '24/7 chat support',
                'pricing.starter.f5': 'Reseller pricing',
                'pricing.popular': '⭐ Most Popular',
                'pricing.pro.sub': 'Reseller pricing unlocked from $20',
                'pricing.pro.f1': 'All Starter services',
                'pricing.pro.f2': '20–40% discount',
                'pricing.pro.f3': 'Full API access',
                'pricing.pro.f4': 'Priority support',
                'pricing.ent.sub': 'For large agencies',
                'pricing.ent.f1': 'Best market pricing',
                'pricing.ent.f3': 'Dedicated account manager',
                'pricing.topup': 'Deposit Now',
                'pricing.topup_pro': 'Deposit Now ↗',
                'pricing.contact': 'Contact Us',
                'faq.title1': 'Frequently',
                'faq.title2': 'Asked Questions',
                'faq.q1': 'What is an SMM Panel and how does it work?',
                'faq.a1': 'An SMM Panel is a platform that provides automated social media engagement services. You place an order, provide a link, and the system processes and delivers the service without manual intervention.',
                'faq.q2': 'Is the service safe for my account?',
                'faq.a2': 'We use natural delivery methods and never require your password. Premium packages use real accounts, minimizing the risk of platform policy violations.',
                'faq.q3': 'Can I integrate the API into my system?',
                'faq.a3': 'Yes! Full RESTful API with detailed documentation. Supports order placement, status checking, service listing and balance management — compatible with any programming language.',
                'faq.q4': 'What payment methods are supported?',
                'faq.a4': 'Supported: MoMo, ZaloPay, ViettelPay, bank transfer, Visa/Mastercard, USDT/Crypto. Deposits are automatically confirmed within 1–5 minutes.',
                'faq.q5': 'If my order is not completed, will I get a refund?',
                'faq.a5': 'Yes. Incomplete or failed orders are automatically refunded to your account balance within 24 hours. Contact support if you need faster processing.',
                'cta.title1': 'Ready to accelerate your',
                'cta.title2': 'social media?',
                'cta.sub': 'Sign up free in 30 seconds. No credit card required.',
                'cta.btn1': 'Create Free Account →',
                'cta.btn2': 'Sign In',
                'footer.desc': 'The leading SMM Panel platform. Fast delivery, great prices, 24/7 support.',
                'footer.services': 'Services',
                'footer.support': 'Support',
                'footer.contact_title': 'Contact',
                'footer.api': 'API Documentation',
                'footer.guide': 'Order Guide',
                'footer.refund': 'Refund Policy',
                'footer.contact': 'Contact Us',
                'footer.support_time': '⏰ Support: 24/7',
                'footer.terms': 'Terms',
                'footer.privacy': 'Privacy',
            }
        };

        var currentLang = localStorage.getItem('landing_lang') || 'vi';

        var LANG_META = {
            vi: {
                flag: 'https://cdn.whoispanel.com/admin/media/flags/vietnam.svg',
                name: 'Tiếng Việt'
            },
            en: {
                flag: 'https://cdn.whoispanel.com/admin/media/flags/united-states.svg',
                name: 'English'
            }
        };

        function toggleLang(e) {
            e.stopPropagation();
            var drop = document.getElementById('lang-drop');
            var toggle = document.getElementById('lang-toggle');
            if (!drop || !toggle) return;

            var isOpen = drop.classList.contains('open');
            drop.classList.toggle('open', !isOpen);
            toggle.classList.toggle('open', !isOpen);
        }

        function setLang(lang) {
            currentLang = lang;
            localStorage.setItem('landing_lang', lang);

            // Update html lang
            var root = document.getElementById('html-root');
            if (root) root.lang = lang;

            // Update toggle button flag + name
            var meta = LANG_META[lang];
            var flagEl = document.getElementById('lang-flag');
            var nameEl = document.getElementById('lang-name');
            if (flagEl) flagEl.src = meta.flag;
            if (nameEl) nameEl.textContent = meta.name;

            // Close dropdown
            var drop = document.getElementById('lang-drop');
            var toggle = document.getElementById('lang-toggle');
            if (drop) drop.classList.remove('open');
            if (toggle) toggle.classList.remove('open');

            // Update active state on all lang buttons
            ['vi', 'en'].forEach(function(l) {
                ['opt-' + l, 'opt-' + l + '-m'].forEach(function(id) {
                    var el = document.getElementById(id);
                    if (!el) return;
                    if (l === lang) {
                        el.classList.add('active');
                        el.style.borderColor = 'rgba(0,245,255,0.5)';
                        el.style.color = '#00f5ff';
                    } else {
                        el.classList.remove('active');
                        el.style.borderColor = '';
                        el.style.color = '';
                    }
                });
            });

            // Translate all data-i18n elements
            document.querySelectorAll('[data-i18n]').forEach(function(el) {
                var key = el.getAttribute('data-i18n');
                var val = LANG[lang] && LANG[lang][key];
                if (!val) return;
                if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                    el.placeholder = val;
                } else {
                    el.textContent = val;
                }
            });
        }

        // Close dropdown when clicking outside — use setTimeout to let onclick fire first
        document.addEventListener('click', function(e) {
            var sw = document.querySelector('.lang-switcher');
            var drop = document.getElementById('lang-drop');
            var toggle = document.getElementById('lang-toggle');

            // Nếu click bên trong lang-switcher → không đóng (để onclick handler chạy)
            if (sw && sw.contains(e.target)) return;

            // Nếu click ngoài → đóng dropdown
            if (drop && toggle) {
                drop.classList.remove('open');
                toggle.classList.remove('open');
            }
        });

        // Use mousedown (fires before click) to close dropdown when clicking outside
        document.addEventListener('mousedown', function(e) {
            var sw = document.querySelector('.lang-switcher');
            if (sw && sw.contains(e.target)) return; // inside switcher — do nothing
            var drop = document.getElementById('lang-drop');
            var toggle = document.getElementById('lang-toggle');
            if (drop) drop.classList.remove('open');
            if (toggle) toggle.classList.remove('open');
        });

        // Init
        document.addEventListener('DOMContentLoaded', function() {
            setLang(currentLang);
            document.body.classList.add('ready');
        });
    </script>
</body>

</html>
