<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'School Management System') }} — Every period, planned.</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<style>
    /* Reset & variables */
    :root {
        --ink: #0F1A2F;
        --ink-2: #1E2F4A;
        --parchment: #F9F6F0;
        --paper: #FFFFFF;
        --brass: #D4A24C;
        --brass-light: #F2D99A;
        --slate: #4A6A85;
        --sage: #7C9885;
        --line: rgba(15, 26, 47, 0.08);
        --text: #1C1C1C;
        --max-width: 1200px;
        --radius: 20px;
        --shadow-card: 0 30px 60px -30px rgba(15,26,47,0.25);
        --shadow-hover: 0 40px 80px -30px rgba(15,26,47,0.35);
        --transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    * { box-sizing: border-box; margin:0; padding:0; }
    html { scroll-behavior: smooth; }
    body {
        background: var(--parchment);
        color: var(--text);
        font-family: 'Inter', sans-serif;
        -webkit-font-smoothing: antialiased;
        line-height: 1.6;
        overflow-x: hidden;
    }
    h1, h2, h3, .display {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin: 0;
    }
    .eyebrow {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.7rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--brass);
        font-weight: 600;
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    a { color: inherit; text-decoration: none; }
    .wrap { max-width: var(--max-width); margin: 0 auto; padding: 0 24px; }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 32px;
        border-radius: 50px;
        font-size: 0.95rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        background: transparent;
    }
    .btn-primary {
        background: var(--ink);
        color: white;
        box-shadow: 0 4px 12px rgba(15,26,47,0.15);
    }
    .btn-primary:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 30px rgba(15,26,47,0.3);
        background: #1a2d4a;
    }
    .btn-ghost {
        border-color: var(--line);
        color: var(--ink);
        background: rgba(255,255,255,0.6);
        backdrop-filter: blur(4px);
    }
    .btn-ghost:hover {
        border-color: var(--brass);
        background: white;
        transform: translateY(-3px);
    }
    .btn-gold {
        background: var(--brass);
        color: var(--ink);
        box-shadow: 0 4px 12px rgba(212,162,76,0.3);
    }
    .btn-gold:hover {
        background: #c4943a;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 30px rgba(212,162,76,0.4);
    }

    /* Navigation */
    header {
        position: sticky;
        top: 0;
        z-index: 100;
        background: rgba(249, 246, 240, 0.85);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--line);
        transition: background 0.3s;
    }
    nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
    }
    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--ink);
    }
    .brand .mark {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--ink);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brass);
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.9rem;
        font-weight: 700;
    }
    .navlinks {
        display: flex;
        gap: 32px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    .navlinks a {
        color: var(--ink-2);
        opacity: 0.7;
        transition: var(--transition);
        position: relative;
    }
    .navlinks a::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--brass);
        transition: var(--transition);
    }
    .navlinks a:hover {
        opacity: 1;
    }
    .navlinks a:hover::after {
        width: 100%;
    }
    @media (max-width: 768px) {
        .navlinks { display: none; }
    }

    /* Hero */
    .hero {
        min-height: 90vh;
        display: flex;
        align-items: center;
        position: relative;
        padding: 60px 0 80px;
        background: linear-gradient(140deg, #f9f6f0 0%, #f0ebe3 100%);
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(212,162,76,0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .hero::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(74,106,133,0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    .hero-content .eyebrow {
        font-size: 0.8rem;
        background: rgba(212,162,76,0.15);
        padding: 4px 14px;
        border-radius: 30px;
        color: var(--brass);
        margin-bottom: 1rem;
        display: inline-block;
    }
    .hero h1 {
        font-size: clamp(2.6rem, 5vw, 4.2rem);
        line-height: 1.05;
        margin: 0.5rem 0 1.2rem;
        color: var(--ink);
    }
    .hero h1 em {
        font-style: italic;
        color: var(--brass);
        position: relative;
        display: inline-block;
    }
    .hero h1 em::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 4px;
        width: 100%;
        height: 8px;
        background: rgba(212,162,76,0.25);
        border-radius: 4px;
        z-index: -1;
    }
    .hero p.lede {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #4a4a4a;
        max-width: 48ch;
        margin-bottom: 2rem;
    }
    .hero-ctas {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    .hero-visual {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .grid-card {
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: var(--radius);
        padding: 28px 24px;
        box-shadow: var(--shadow-card);
        width: 100%;
        max-width: 500px;
        transition: var(--transition);
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
        100% { transform: translateY(0px); }
    }
    .grid-card .gc-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    .gc-head .eyebrow {
        margin: 0;
        font-size: 0.65rem;
        color: var(--slate);
    }
    .gc-head .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--sage);
        box-shadow: 0 0 0 4px rgba(124,152,133,0.15);
        animation: pulse-dot 2s infinite;
    }
    @keyframes pulse-dot {
        0% { box-shadow: 0 0 0 0 rgba(124,152,133,0.3); }
        70% { box-shadow: 0 0 0 10px rgba(124,152,133,0); }
        100% { box-shadow: 0 0 0 0 rgba(124,152,133,0); }
    }
    table.timetable {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.7rem;
    }
    table.timetable th {
        font-family: 'IBM Plex Mono', monospace;
        font-weight: 600;
        color: #8a8a8a;
        text-align: center;
        padding: 6px 2px;
        font-size: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    table.timetable td {
        border: 1px solid var(--line);
        text-align: center;
        padding: 10px 2px;
        border-radius: 6px;
        color: #b0b0b0;
        font-weight: 500;
        font-size: 0.7rem;
        transition: var(--transition);
    }
    table.timetable td.filled {
        background: var(--ink);
        color: white;
        animation: fillIn 0.5s ease forwards;
        opacity: 0;
        transform: scale(0.9);
        border-color: var(--ink);
    }
    table.timetable td.filled.brass {
        background: var(--brass);
        color: var(--ink);
        border-color: var(--brass);
    }
    table.timetable td.filled.slate {
        background: var(--slate);
        color: white;
        border-color: var(--slate);
    }
    table.timetable td.filled:hover {
        transform: scale(1.05);
        z-index: 2;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    @keyframes fillIn {
        to { opacity: 1; transform: scale(1); }
    }
    .gc-foot {
        margin-top: 16px;
        font-size: 0.75rem;
        color: #6b6b6b;
        display: flex;
        justify-content: space-between;
        font-weight: 500;
    }
    .gc-foot span:first-child {
        color: var(--sage);
    }
    .gc-foot span:last-child {
        color: var(--brass);
    }
    @media (max-width: 900px) {
        .hero-grid { grid-template-columns: 1fr; gap: 40px; }
        .hero { min-height: auto; }
        .grid-card { max-width: 100%; }
    }

    /* Storytelling sections */
    .section-pad {
        padding: 80px 0;
    }
    .section-head {
        max-width: 640px;
        margin-bottom: 48px;
    }
    .section-head .eyebrow {
        margin-bottom: 0.75rem;
    }
    .section-head h2 {
        font-size: clamp(1.8rem, 3vw, 2.8rem);
        line-height: 1.1;
        color: var(--ink);
    }
    .section-head p {
        color: #5a5a5a;
        margin-top: 0.5rem;
        font-size: 1.05rem;
    }

    /* How it works - step timeline */
    .steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 30px;
        counter-reset: step;
        position: relative;
    }
    .steps::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--line);
        transform: translateY(-50%);
        z-index: 0;
    }
    .step-card {
        background: var(--paper);
        border-radius: var(--radius);
        padding: 32px 24px;
        box-shadow: var(--shadow-card);
        text-align: center;
        position: relative;
        z-index: 1;
        transition: var(--transition);
        border: 1px solid rgba(255,255,255,0.5);
        counter-increment: step;
    }
    .step-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
    }
    .step-card .step-num {
        font-family: 'IBM Plex Mono', monospace;
        font-weight: 700;
        font-size: 1.8rem;
        color: var(--brass);
        display: block;
        margin-bottom: 12px;
        opacity: 0.6;
    }
    .step-card .step-num::before {
        content: "0" counter(step);
    }
    .step-card:nth-child(n+10) .step-num::before {
        content: counter(step);
    }
    .step-card h3 {
        font-family: 'Fraunces', serif;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--ink);
    }
    .step-card p {
        font-size: 0.9rem;
        color: #5a5a5a;
        margin: 0;
    }
    .step-card .icon {
        font-size: 2.2rem;
        display: block;
        margin-bottom: 12px;
    }
    @media (max-width: 700px) {
        .steps::before { display: none; }
        .steps { grid-template-columns: 1fr; }
    }

    /* Roles */
    .role-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    .role-card {
        background: var(--paper);
        border-radius: var(--radius);
        padding: 32px 28px;
        box-shadow: var(--shadow-card);
        border: 1px solid rgba(255,255,255,0.5);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .role-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--brass);
        opacity: 0;
        transition: var(--transition);
    }
    .role-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
    }
    .role-card:hover::before {
        opacity: 1;
    }
    .role-card .tag {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.65rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: white;
        background: var(--ink);
        display: inline-block;
        padding: 4px 14px;
        border-radius: 30px;
        margin-bottom: 16px;
        font-weight: 600;
    }
    .role-card.admin .tag { background: var(--ink); }
    .role-card.teacher .tag { background: var(--slate); }
    .role-card.student .tag { background: var(--sage); color: #1e2f1e; }
    .role-card h3 {
        font-size: 1.3rem;
        margin-bottom: 12px;
        font-weight: 600;
    }
    .role-card ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .role-card ul li {
        padding: 6px 0;
        padding-left: 24px;
        position: relative;
        font-size: 0.9rem;
        color: #4a4a4a;
        line-height: 1.5;
    }
    .role-card ul li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--brass);
        font-weight: 700;
    }
    @media (max-width: 850px) {
        .role-grid { grid-template-columns: 1fr; }
    }

    /* Features */
    .features {
        background: var(--ink);
        color: var(--parchment);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }
    .features .section-head h2 {
        color: white;
    }
    .features .section-head p {
        color: rgba(255,255,255,0.6);
    }
    .feat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1px;
        background: rgba(255,255,255,0.06);
        border-radius: var(--radius);
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.06);
    }
    .feat {
        background: rgba(255,255,255,0.03);
        padding: 32px 24px;
        backdrop-filter: blur(4px);
        transition: var(--transition);
    }
    .feat:hover {
        background: rgba(255,255,255,0.07);
    }
    .feat .num {
        font-family: 'IBM Plex Mono', monospace;
        color: var(--brass);
        font-size: 0.8rem;
        margin-bottom: 12px;
        display: block;
        opacity: 0.7;
    }
    .feat h4 {
        font-family: 'Fraunces', serif;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: white;
    }
    .feat p {
        font-size: 0.85rem;
        line-height: 1.6;
        color: rgba(255,255,255,0.65);
        margin: 0;
    }
    @media (max-width: 850px) {
        .feat-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 500px) {
        .feat-grid { grid-template-columns: 1fr; }
    }

    /* Stats */
    .stats {
        background: var(--paper);
        padding: 60px 0;
        border-top: 1px solid var(--line);
        border-bottom: 1px solid var(--line);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        text-align: center;
    }
    .stat-item .number {
        font-family: 'Fraunces', serif;
        font-size: 2.6rem;
        font-weight: 700;
        color: var(--ink);
        display: block;
        line-height: 1;
    }
    .stat-item .label {
        font-size: 0.85rem;
        color: #6b6b6b;
        margin-top: 4px;
    }
    @media (max-width: 700px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
    }

    /* Testimonials */
    .testimonials {
        background: var(--parchment);
    }
    .testimonial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    .testimonial-card {
        background: var(--paper);
        border-radius: var(--radius);
        padding: 32px 28px;
        box-shadow: var(--shadow-card);
        border: 1px solid rgba(255,255,255,0.5);
        transition: var(--transition);
    }
    .testimonial-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
    }
    .testimonial-card .quote {
        font-size: 1rem;
        line-height: 1.7;
        color: #2a2a2a;
        font-style: italic;
        margin-bottom: 16px;
        position: relative;
        padding-left: 20px;
        border-left: 3px solid var(--brass);
    }
    .testimonial-card .author {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .testimonial-card .author .avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: var(--ink);
        font-size: 1.1rem;
        background: var(--brass-light);
        color: var(--ink);
    }
    .testimonial-card .author .info {
        font-size: 0.85rem;
    }
    .testimonial-card .author .info strong {
        display: block;
        font-weight: 600;
        color: var(--ink);
    }
    .testimonial-card .author .info span {
        color: #6b6b6b;
        font-size: 0.75rem;
    }
    @media (max-width: 850px) {
        .testimonial-grid { grid-template-columns: 1fr; }
    }

    /* CTA */
    .cta {
        padding: 100px 0;
        text-align: center;
        background: linear-gradient(140deg, var(--ink) 0%, #1a2d4a 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }
    .cta::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 50%, rgba(212,162,76,0.05) 0%, transparent 60%);
        pointer-events: none;
    }
    .cta h2 {
        font-size: clamp(2rem, 3.5vw, 3rem);
        max-width: 700px;
        margin: 0 auto 1rem;
        position: relative;
        z-index: 2;
    }
    .cta p {
        color: rgba(255,255,255,0.7);
        margin-bottom: 2rem;
        font-size: 1.1rem;
        position: relative;
        z-index: 2;
    }
    .cta .btn {
        position: relative;
        z-index: 2;
    }

    /* Footer */
    footer {
        background: var(--paper);
        border-top: 1px solid var(--line);
        padding: 30px 0;
        font-size: 0.85rem;
        color: #6b6b6b;
    }
    footer .wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    footer .brand-small {
        font-family: 'Fraunces', serif;
        font-weight: 600;
        color: var(--ink);
    }

    /* Scroll-reveal (simple) */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }
    @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; }
        .grid-card { animation: none; }
    }
</style>
</head>
<body>

<header>
    <div class="wrap">
        <nav>
            <div class="brand">
                <span class="mark">SM</span>
                {{ config('app.name', 'SchoolMS') }}
            </div>
            <div class="navlinks">
                <a href="#how-it-works">How it works</a>
                <a href="#roles">For whom</a>
                <a href="#features">Features</a>
                <a href="#testimonials">Stories</a>
            </div>
            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
        </nav>
    </div>
</header>

<!-- Hero -->
<section class="hero" id="home">
    <div class="wrap hero-grid">
        <div class="hero-content">
            <span class="eyebrow"> School &amp; College Management</span>
            <h1>Every period, <em>planned</em> — before the bell even rings.</h1>
            <p class="lede">One system for admins, teachers and students: build the class structure, auto-generate a clash-free weekly timetable, and run assignments end to end — post, submit, grade.</p>
            <div class="hero-ctas">
                <a href="{{ route('login') }}" class="btn btn-primary">Get started →</a>
                <a href="#how-it-works" class="btn btn-ghost">Explore the story</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="grid-card">
                <div class="gc-head">
                    <span class="eyebrow">Section 10-A · Auto-generated</span>
                    <span class="dot"></span>
                </div>
                <table class="timetable">
                    <thead>
                        <tr><th></th><th>P1</th><th>P2</th><th>P3</th><th>P4</th><th>P5</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Mon</th>
                            <td class="filled" style="animation-delay:.05s">Math</td>
                            <td class="filled slate" style="animation-delay:.15s">Sci</td>
                            <td class="filled brass" style="animation-delay:.25s">Eng</td>
                            <td class="filled" style="animation-delay:.35s">Math</td>
                            <td>—</td>
                        </tr>
                        <tr>
                            <th>Tue</th>
                            <td class="filled slate" style="animation-delay:.45s">Sci</td>
                            <td class="filled brass" style="animation-delay:.55s">Eng</td>
                            <td>—</td>
                            <td class="filled" style="animation-delay:.65s">Math</td>
                            <td class="filled slate" style="animation-delay:.75s">Sci</td>
                        </tr>
                        <tr>
                            <th>Wed</th>
                            <td class="filled brass" style="animation-delay:.85s">Eng</td>
                            <td class="filled" style="animation-delay:.95s">Math</td>
                            <td class="filled slate" style="animation-delay:1.05s">Sci</td>
                            <td>—</td>
                            <td class="filled brass" style="animation-delay:1.15s">Eng</td>
                        </tr>
                    </tbody>
                </table>
                <div class="gc-foot">
                    <span>✅ 0 teacher clashes</span>
                    <span>⚡ Generated in &lt;1s</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How it works -->
<section class="section-pad" id="how-it-works">
    <div class="wrap">
        <div class="section-head reveal">
            <span class="eyebrow">The story in 5 steps</span>
            <h2>From setup to success, in a single flow.</h2>
            <p>No more spreadsheets, no more confusion. Here’s how the system turns your school day into a well‑oiled machine.</p>
        </div>
        <div class="steps">
            <div class="step-card reveal">
                <span class="icon">🏗️</span>
                <span class="step-num"></span>
                <h3>Set up your school</h3>
                <p>Add classes, sections, subjects, and teachers. Define the structure once.</p>
            </div>
            <div class="step-card reveal">
                <span class="icon">⚙️</span>
                <span class="step-num"></span>
                <h3>Generate timetable</h3>
                <p>One click creates a clash‑free schedule for every section and teacher.</p>
            </div>
            <div class="step-card reveal">
                <span class="icon">📝</span>
                <span class="step-num"></span>
                <h3>Teachers post work</h3>
                <p>Assignments are linked to sections — students see them instantly.</p>
            </div>
            <div class="step-card reveal">
                <span class="icon">📤</span>
                <span class="step-num"></span>
                <h3>Students submit</h3>
                <p>Upload text or files before the deadline, from anywhere.</p>
            </div>
            <div class="step-card reveal">
                <span class="icon">📊</span>
                <span class="step-num"></span>
                <h3>Grade &amp; feedback</h3>
                <p>Teachers review, grade, and give feedback — students see it all.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats">
    <div class="wrap stats-grid">
        <div class="stat-item reveal">
            <span class="number">12k+</span>
            <span class="label">Periods generated</span>
        </div>
        <div class="stat-item reveal">
            <span class="number">0</span>
            <span class="label">Clashes reported</span>
        </div>
        <div class="stat-item reveal">
            <span class="number">99.9%</span>
            <span class="label">Uptime</span>
        </div>
        <div class="stat-item reveal">
            <span class="number">4.9★</span>
            <span class="label">User satisfaction</span>
        </div>
    </div>
</section>

<!-- Roles -->
<section class="section-pad" id="roles">
    <div class="wrap">
        <div class="section-head reveal">
            <span class="eyebrow">Built for every role</span>
            <h2>One system, three perspectives — each one empowered.</h2>
            <p>Whether you're running the school, teaching a class, or learning, everything is exactly where you need it.</p>
        </div>
        <div class="role-grid">
            <div class="role-card admin reveal">
                <span class="tag">Admin</span>
                <h3>Full control, nothing hidden.</h3>
                <ul>
                    <li>Create, edit &amp; deactivate teachers and students</li>
                    <li>Reset or change any password</li>
                    <li>Manage classes, sections &amp; subjects</li>
                    <li>Auto-generate or manually edit the timetable</li>
                </ul>
            </div>
            <div class="role-card teacher reveal">
                <span class="tag">Teacher</span>
                <h3>Teach the class in front of you.</h3>
                <ul>
                    <li>See your own weekly timetable</li>
                    <li>Post assignments to your sections</li>
                    <li>Review submissions as they come in</li>
                    <li>Grade with marks and written feedback</li>
                </ul>
            </div>
            <div class="role-card student reveal">
                <span class="tag">Student</span>
                <h3>Know what's due, and when.</h3>
                <ul>
                    <li>Check your class timetable anytime</li>
                    <li>See every assignment for your section</li>
                    <li>Submit text or a file before the deadline</li>
                    <li>View grades and feedback once released</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="features" id="features">
    <div class="wrap">
        <div class="section-head reveal">
            <span class="eyebrow">Under the hood</span>
            <h2>The engines that power your day.</h2>
            <p>Every feature is built to save time, reduce errors, and give everyone clarity.</p>
        </div>
        <div class="feat-grid">
            <div class="feat reveal">
                <span class="num">01</span>
                <h4>Clash‑free scheduling</h4>
                <p>The generator checks every teacher against every section before it places a period, so nobody is ever booked twice.</p>
            </div>
            <div class="feat reveal">
                <span class="num">02</span>
                <h4>Role‑scoped access</h4>
                <p>Every screen is gated by who's logged in — a student can never reach an admin action, even by guessing a URL.</p>
            </div>
            <div class="feat reveal">
                <span class="num">03</span>
                <h4>Assignments, end to end</h4>
                <p>Post, submit, grade — all three tied to the exact class and section a teacher actually teaches.</p>
            </div>
            <div class="feat reveal">
                <span class="num">04</span>
                <h4>One place for admin</h4>
                <p>Passwords, statuses, class structure — every account‑level change lives in a single, auditable panel.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section-pad testimonials" id="testimonials">
    <div class="wrap">
        <div class="section-head reveal">
            <span class="eyebrow">Real stories</span>
            <h2>What schools are saying.</h2>
            <p>From principals to first‑year teachers — our system is making a difference.</p>
        </div>
        <div class="testimonial-grid">
            <div class="testimonial-card reveal">
                <div class="quote">“Our timetable used to take weeks. Now it’s done in seconds — and we’ve had zero conflicts all year.”</div>
                <div class="author">
                    <div class="avatar">MR</div>
                    <div class="info">
                        <strong>Maria Rodriguez</strong>
                        <span>Principal, Lincoln High</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal">
                <div class="quote">“As a teacher, I love that I can see my whole week at a glance and post assignments right from my dashboard.”</div>
                <div class="author">
                    <div class="avatar">JC</div>
                    <div class="info">
                        <strong>James Chen</strong>
                        <span>Math Teacher, Westside Academy</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal">
                <div class="quote">“Finally, a system where I can see all my assignments and grades without hunting through emails.”</div>
                <div class="author">
                    <div class="avatar">AL</div>
                    <div class="info">
                        <strong>Aisha Lam</strong>
                        <span>Student, Year 12</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="cta">
    <div class="wrap">
        <h2>Ready to write your school’s next chapter?</h2>
        <p>Your timetable is already waiting to be generated. Log in and pick up where your school left off.</p>
        <a href="{{ route('login') }}" class="btn btn-gold">Log in to your dashboard →</a>
    </div>
</section>

<footer>
    <div class="wrap">
        <span class="brand-small">{{ config('app.name', 'School Management System') }}</span>
        <span>Built with ❤️ on Laravel</span>
    </div>
</footer>

<!-- Scroll reveal script -->
<script>
    (function() {
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        reveals.forEach(el => observer.observe(el));
    })();
</script>
</body>
</html>