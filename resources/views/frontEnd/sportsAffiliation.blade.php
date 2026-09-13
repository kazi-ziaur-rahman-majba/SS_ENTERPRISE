@extends('layouts.app')
@section('title', 'Sports Affiliation')
@section('content')

{{-- Hero Section --}}
<section class="hero">
    <div class="hero-content">
        <div class="hero-text fade-in">
            <h1>SS Group × 10-12 Sports</h1>
            <p>Empowering Bangladesh Cricket Excellence Since 2018. A proud partnership fostering grassroots talent and building pathways to professional cricket.</p>
            <div class="hero-stats">
                <div class="stat stagger-1">
                    <div class="stat-number">7+</div>
                    <div class="stat-label">Years Partnership</div>
                </div>
                <div class="stat stagger-2">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Active Players</div>
                </div>
                <div class="stat stagger-3">
                    <div class="stat-number">5</div>
                    <div class="stat-label">Major Championships</div>
                </div>
            </div>
        </div>
        <div class="slider-container fade-in">
            <div class="slider">
                <div class="slide slide1 active">
                    <img src="{{ asset('assets/images/sports/482248727_630090159807679_1759744023289367802_n.jpg') }}" alt="Cricket Excellence">
                    <div class="slide-overlay">
                        <h3>Cricket Excellence</h3>
                        <p>Empowering grassroots talent across Bangladesh</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div class="slide slide2">
                    <img src="{{ asset('assets/images/sports/497750612_679129711570390_6929261868971358590_n.jpg') }}" alt="Partnership Success">
                    <div class="slide-overlay">
                        <h3>Partnership Success</h3>
                        <p>7+ years of successful collaboration</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div class="slide slide3">
                    <img src="{{ asset('assets/images/sports/488250225_649535181196510_5133201489674523724_n.jpg') }}" alt="Tournament Victory">
                    <div class="slide-overlay">
                        <h3>Tournament Victory</h3>
                        <p>5 major championships won together</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
            <div class="slider-dots">
                <span class="dot active" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    </div>
</section>

{{-- Partnership Section --}}
<section class="partnership">
    <div class="container">
        <div class="section-header fade-in">
            <span class="kicker">Strategic Partnership</span>
            <h2 class="section-title">Building Cricket Excellence Together</h2>
            <p class="section-subtitle">Since 2018, SS Group has been proudly affiliated with 10-12 Sports, supporting Bangladesh's cricket development ecosystem</p>
        </div>
        
        <div class="partnership-content">
            <div class="partnership-text fade-in">
                <h3>Our Seven-Year Journey</h3>
                <p>Our partnership with 10-12 Sports represents a commitment to transforming grassroots cricket in Bangladesh. Together, we've created opportunities for underprivileged and rural talent to reach professional levels.</p>
                
                <div class="highlight">
                    <h4><i class="fas fa-handshake"></i> Partnership Highlights (2018-current)</h4>
                    <ul class="highlight-list">
                        <li>Supporting 100+ active cricketers in DPL, First & Second Division</li>
                        <li>Enabling pathways to BPL, U-19, and National teams</li>
                        <li>Facilitating grassroots coaching and scouting programs</li>
                        <li>Organizing franchise-style tournaments</li>
                    </ul>
                </div>
                
                <p>Through this partnership, we've witnessed remarkable success stories - from rural discoveries to national team selections, proving that talent knows no geographical boundaries.</p>
            </div>
            
            <div class="logo-showcase fade-in">
                <div class="logo-display">
                    <div class="company-logo">
                        <div class="logo-text">SS GROUP</div>
                        <div class="logo-subtitle">Since 2004</div>
                    </div>
                    <div class="partnership-symbol">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="sports-logo">
                        <div class="sports-badge">10-12</div>
                        <div class="sports-text">SPORTS</div>
                        <div class="sports-tagline">Grassroots to Glory</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Vision & Mission Section --}}
<section class="vision-mission">
    <div class="container">
        <div class="section-header fade-in center">
            <span class="kicker">Our Foundation</span>
            <h2 class="section-title">Shared Vision & Mission</h2>
            <p class="section-subtitle">United in our commitment to cricket excellence and social impact</p>
        </div>
        
        <div class="cards-grid">
            <div class="card fade-in stagger-1">
                <div class="card-icon icon-vision">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Our Vision</h3>
                <p>To be a catalyst for local cricket excellence in Bangladesh by creating structured opportunities and long-term support systems for players beyond Dhaka's elite leagues.</p>
            </div>
            
            <div class="card fade-in stagger-2">
                <div class="card-icon icon-mission">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Our Mission</h3>
                <ul class="mission-list">
                    <li>Organize high-quality tournaments for emerging players</li>
                    <li>Develop local talent through coaching and scouting</li>
                    <li>Promote cricket as a tool for empowerment</li>
                    <li>Build infrastructure for long-term excellence</li>
                    <li>Develop cricket academies for talent enrichment</li>
                </ul>
            </div>
            
            <div class="card fade-in stagger-3">
                <div class="card-icon icon-impact">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>Tournament Success</h3>
                <ul class="achievement-list">
                    <li><i class="fas fa-medal"></i> 3× Mash Champion Trophy</li>
                    <li><i class="fas fa-medal"></i> GULZER T20 Season 7 Champions</li>
                    <li><i class="fas fa-medal"></i> PKSP Academy Cup Champions</li>
                    <li><i class="fas fa-medal"></i> City Cup Champions</li>
                    <li><i class="fas fa-medal"></i> Royal Champion Trophy</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Notable Players Section --}}
<section class="players-section">
    <div class="container">
        <div class="section-header fade-in center">
            <span class="kicker">Success Stories</span>
            <h2 class="section-title">Notable Players</h2>
            <p class="section-subtitle">Celebrating talent nurtured through our partnership</p>
        </div>
        
        <div class="players-grid">
            @php
                $players = [
                    ['name' => 'Habibur Rahman Sohan', 'achievement' => 'BPL, DPL, HP Squad', 'level' => 'National'],
                    ['name' => 'Mahfijul Rahman Robin', 'achievement' => 'U19, HP, DPL', 'level' => 'Youth'],
                    ['name' => 'Rayan Rafsan Rahman', 'achievement' => 'U19, Emerging Team, DPL', 'level' => 'Emerging'],
                    ['name' => 'AB Jibon', 'achievement' => 'D1 consistent performer', 'level' => 'Professional'],
                    ['name' => 'AKM Husna Habib', 'achievement' => 'DPL all-rounder (both-arm bowler)', 'level' => 'Specialist'],
                    ['name' => 'Shariful Islam', 'achievement' => 'Man of the Tournament, National Championship', 'level' => 'Champion'],
                    ['name' => 'Rafsan Al Mahmud', 'achievement' => 'U19, highest scorer in D1', 'level' => 'Youth'],
                    ['name' => 'Mahidul Islam Ankon', 'achievement' => 'Gulzar T20 performer', 'level' => 'T20']
                ];
            @endphp
            
            @foreach($players as $index => $player)
                <div class="player-card fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="player-avatar">
                        <div class="avatar-text">{{ substr($player['name'], 0, 2) }}</div>
                        <div class="level-badge {{ strtolower($player['level']) }}">{{ $player['level'] }}</div>
                    </div>
                    <div class="player-info">
                        <h4 class="player-name">{{ $player['name'] }}</h4>
                        <p class="player-achievement">{{ $player['achievement'] }}</p>
                    </div>
                    <div class="player-stats">
                        <span class="stat-dot active"></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Impact Statistics --}}
<section class="impact-stats">
    <div class="container">
        <div class="stats-overlay">
            <div class="section-header fade-in center">
                <span class="kicker">Our Impact</span>
                <h2 class="section-title white">Partnership Impact</h2>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card fade-in stagger-1">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" data-count="100">0</div>
                    <div class="stat-text">Active Players</div>
                    <div class="stat-desc">Across DPL, First & Second Division</div>
                </div>
                
                <div class="stat-card fade-in stagger-2">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-number" data-count="8">0</div>
                    <div class="stat-text">Major Championships</div>
                    <div class="stat-desc">Tournament victories achieved</div>
                </div>
                
                <div class="stat-card fade-in stagger-3">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-number" data-count="7">0</div>
                    <div class="stat-text">Years Partnership</div>
                    <div class="stat-desc">Continuous collaboration since 2018</div>
                </div>
                
                <div class="stat-card fade-in stagger-4">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number" data-count="15">0</div>
                    <div class="stat-text">National Selections</div>
                    <div class="stat-desc">Players reached national level</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Contact Section --}}
<section class="contact-section">
    <div class="container">
        <div class="contact-content">
            <div class="contact-info fade-in">
                <h3><i class="fas fa-handshake"></i> Partnership Coordination</h3>
                <div class="contact-card">
                    <div class="contact-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="contact-details">
                        <h4>Md. Milon Mondal (Abir)</h4>
                        <p class="title">Managing Director - 10-12 Sports</p>
                        <p class="phone"><i class="fas fa-phone"></i> 01776426880</p>
                    </div>
                </div>
                
                <div class="contact-card">
                    <div class="contact-avatar">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="contact-details">
                        <h4>Fokhrul Islam Robin</h4>
                        <p class="title">Chairman - 10-12 Sporting Club</p>
                        <p class="role">Strategic Leadership & Governance</p>
                    </div>
                </div>
            </div>
            
            <div class="partnership-summary fade-in">
                <h3>Partnership Excellence</h3>
                <p>Our collaboration with 10-12 Sports has created a sustainable ecosystem for cricket development in Bangladesh. Together, we continue to identify, nurture, and promote talented cricketers from grassroots to professional levels.</p>
                <div class="summary-badges">
                    <span class="badge">Grassroots Development</span>
                    <span class="badge">Professional Pathways</span>
                    <span class="badge">Social Impact</span>
                    <span class="badge">Tournament Excellence</span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --primary: #2563eb;
        --secondary: #00d084;
        --accent: #7dd56f;
        --gold: #ffcc33;
        --dark: #0b1b3a;
        --light: #f8fafc;
        --white: #ffffff;
        --gray: #64748b;
        --shadow: rgba(0, 0, 0, 0.1);
        --glass: rgba(255, 255, 255, 0.1);
    }

    /* Hero Section */
    .hero {
        padding: 4rem 0;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    }

    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .hero-text h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        line-height: 1.2;
        background: linear-gradient(45deg, white, var(--gold));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-text p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
        line-height: 1.6;
    }

    .hero-stats {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
    }

    .stat {
        text-align: center;
        padding: 1rem;
        background: var(--glass);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--gold);
        display: block;
    }

    .stat-label {
        font-size: 12px;
        opacity: 0.8;
        margin-top: 0.5rem;
    }

    /* Slider */
    .slider-container { position: relative; width: 100%; height: 400px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
    .slider { position: relative; width: 100%; height: 100%; }
    .slide { position: absolute; inset: 0; opacity: 0; transition: opacity .6s ease; pointer-events: none; }
    .slide.active { opacity: 1; pointer-events: auto; }
    .slide img { width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 20px; }


    .slide-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .slide-overlay h3 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: #fff;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    .slide-overlay p {
        font-size: 1rem;
        margin: 0;
        opacity: 0.9;
        text-shadow: 0 1px 2px rgba(0,0,0,0.5);
    }

    .slider-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
    }

    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: all 0.3s;
    }

    .dot.active {
        background: white;
        transform: scale(1.2);
    }

    /* Common Section Styles */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .section-header {
    }

    .section-header.center {
        text-align: center;
    }

    .kicker {
        display: inline-block;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-size: 12px;
        color: var(--secondary);
        margin-bottom: 0.5rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .section-title.white {
        color: white;
    }

    .section-subtitle {
        font-size: 14px;
        color: var(--gray);
        line-height: 1.6;
    }

    /* Partnership Section */
    .partnership {
        padding: 6rem 0;
        background: var(--light);
    }

    .partnership-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .partnership-text h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
    }

    .partnership-text p {
        margin-bottom: 1.5rem;
        color: var(--gray);
        line-height: 1.7;
    }

    .highlight {
        background: linear-gradient(135deg, var(--secondary), var(--accent));
        color: white;
        padding: 2rem;
        border-radius: 20px;
        margin: 2rem 0;
        position: relative;
    }

    .highlight::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, var(--gold), var(--secondary), var(--accent));
        border-radius: 22px;
        z-index: -1;
    }

    .highlight h4 {
        font-size: 16px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .highlight-list {
        list-style: none;
        padding: 0;
    }

    .highlight-list li {
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
    }

    .highlight-list li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: var(--gold);
        font-weight: bold;
    }

    /* Logo Showcase */
    .logo-showcase {
        background: white;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 20px 40px var(--shadow);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .logo-display {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
    }

    .company-logo {
        text-align: center;
        flex: 1;
    }

    .logo-text {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .logo-subtitle {
        font-size: 12px;
        color: var(--gray);
        font-weight: 500;
    }

    .partnership-symbol {
        font-size: 2rem;
        color: var(--secondary);
        background: var(--light);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sports-logo {
        text-align: center;
        flex: 1;
    }

    .sports-badge {
        background: linear-gradient(135deg, var(--secondary), var(--accent));
        color: white;
        font-size: 2rem;
        font-weight: 800;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 10px 20px rgba(0,208,132,0.3);
    }

    .sports-text {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .sports-tagline {
        font-size: 12px;
        color: var(--gray);
        font-style: italic;
    }

    /* Vision Mission Section */
    .vision-mission {
        padding: 6rem 0;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .card {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: 0 10px 30px var(--shadow);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--secondary), var(--accent));
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1.5rem;
    }

    .icon-vision { 
        background: linear-gradient(135deg, var(--primary), var(--secondary)); 
    }
    
    .icon-mission { 
        background: linear-gradient(135deg, var(--secondary), var(--accent)); 
    }
    
    .icon-impact { 
        background: linear-gradient(135deg, var(--gold), #ff6b35); 
    }

    .card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1rem;
    }

    .mission-list, .achievement-list {
        list-style: none;
        padding: 0;
    }

    .mission-list li {
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
        color: var(--gray);
    }

    .mission-list li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: var(--secondary);
        font-weight: bold;
        font-size: 1.2rem;
    }

    .achievement-list li {
        padding: 0.7rem 0;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .achievement-list i {
        color: var(--gold);
        font-size: 12px;
    }

    /* Players Section */
    .players-section {
        padding: 6rem 0;
        background: var(--light);
    }

    .players-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .player-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 8px 25px var(--shadow);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
        border-left: 4px solid var(--secondary);
    }

    .player-card:hover {
        transform: translateX(5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }

    .player-avatar {
        position: relative;
        flex-shrink: 0;
    }

    .avatar-text {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary), var(--accent));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1rem;
    }

    .level-badge {
        position: absolute;
        bottom: -5px;
        right: -5px;
        padding: 0.2rem 0.5rem;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 600;
        color: white;
    }

    .level-badge.national { background: var(--gold); }
    .level-badge.youth { background: var(--primary); }
    .level-badge.emerging { background: var(--secondary); }
    .level-badge.professional { background: var(--dark); }
    .level-badge.specialist { background: #8b5cf6; }
    .level-badge.champion { background: #ef4444; }
    .level-badge.t20 { background: #f97316; }

    .player-info {
        flex-grow: 1;
    }

    .player-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.3rem;
    }

    .player-achievement {
        font-size: 12px;
        color: var(--gray);
        margin: 0;
    }

    .player-stats {
        flex-shrink: 0;
    }

    .stat-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--secondary);
        display: inline-block;
    }

    .stat-dot.active {
        box-shadow: 0 0 0 4px rgba(0,208,132,0.2);
    }

    /* Impact Stats Section */
    .impact-stats {
        padding: 6rem 0;
        background: linear-gradient(135deg, var(--dark), var(--primary));
        position: relative;
        overflow: hidden;
    }

    .impact-stats::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    }

    .stats-overlay {
        position: relative;
        z-index: 1;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .stat-card {
        background: var(--glass);
        padding: 2rem;
        border-radius: 20px;
        text-align: center;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.15);
    }

    .stat-icon {
        font-size: 2.5rem;
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-text {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stat-desc {
        font-size: 12px;
        opacity: 0.8;
    }

    /* Contact Section */
    .contact-section {
        padding: 6rem 0;
        background: var(--light);
    }

    .contact-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
    }

    .contact-info h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .contact-card {
        background: white;
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 10px 25px var(--shadow);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        border-left: 4px solid var(--secondary);
    }

    .contact-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary), var(--accent));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .contact-details h4 {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .contact-details .title {
        font-size: 12px;
        color: var(--secondary);
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .contact-details .phone {
        font-size: 12px;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .contact-details .role {
        font-size: 12px;
        color: var(--gray);
        font-style: italic;
    }

    /* Partnership Summary */
    .partnership-summary {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: 0 10px 25px var(--shadow);
        border-top: 4px solid var(--gold);
    }

    .partnership-summary h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
    }

    .partnership-summary p {
        color: var(--gray);
        line-height: 1.7;
        margin-bottom: 2rem;
    }

    .summary-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .badge {
        background: linear-gradient(135deg, var(--secondary), var(--accent));
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes countUp {
        from {
            transform: translateY(10px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .fade-in {
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .stagger-1 { animation-delay: 0.1s; }
    .stagger-2 { animation-delay: 0.2s; }
    .stagger-3 { animation-delay: 0.3s; }
    .stagger-4 { animation-delay: 0.4s; }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-content {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 2rem;
        }

        .hero-text h1 {
            font-size: 2.5rem;
        }

        .hero-stats {
            justify-content: center;
            flex-wrap: wrap;
        }

        .slider-container {
            height: 250px;
        }

        .partnership-content {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .logo-display {
            flex-direction: column;
            text-align: center;
        }

        .section-title {
            font-size: 2rem;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }

        .contact-content {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .contact-card {
            flex-direction: column;
            text-align: center;
        }

        .summary-badges {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .hero-text h1 {
            font-size: 2rem;
        }

        .hero-stats {
            flex-direction: column;
            align-items: center;
        }

        .stat {
            width: 100%;
            max-width: 200px;
        }

        .slider-container {
            height: 200px;
        }

        .cards-grid {
            gap: 1rem;
        }

        .card {
            padding: 1.5rem;
        }

        .players-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<script>
    (function () {
      let index = 0;
      let timer = null;
  
      const slides = () => Array.from(document.querySelectorAll('.slider .slide'));
      const dots   = () => Array.from(document.querySelectorAll('.slider-dots .dot'));
  
      function setActive(i) {
        const s = slides();
        const d = dots();
        if (!s.length) return;
  
        index = ((i % s.length) + s.length) % s.length; // wrap both ways
  
        s.forEach((el, k) => el.classList.toggle('active', k === index));
        d.forEach((el, k) => el.classList.toggle('active', k === index));
      }
  
      function next() { setActive(index + 1); }
      function goTo(n) { stop(); setActive(n); start(); }
  
      function start() {
        stop();
        timer = setInterval(next, 4000);
      }
      function stop() {
        if (timer) { clearInterval(timer); timer = null; }
      }
  
      // expose dot click handler (since you use inline onclick)
      window.currentSlide = function (n) { goTo(n - 1); };
  
      document.addEventListener('DOMContentLoaded', () => {
        // if first slide didn't have 'active', initialize
        if (!document.querySelector('.slide.active')) setActive(0);
        start();
      });
  
      // optional: pause on hover
      const container = document.querySelector('.slider-container');
      if (container) {
        container.addEventListener('mouseenter', stop);
        container.addEventListener('mouseleave', start);
      }
    })();
  </script>
  
<script>
   

    // Counter Animation
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number[data-count]');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const increment = target / 50;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target + '+';
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current);
                }
            }, 40);
        });
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                
                // Trigger counter animation for stats section
                if (entry.target.classList.contains('impact-stats')) {
                    setTimeout(animateCounters, 500);
                }
            }
        });
    }, observerOptions);

    // Initialize when DOM loads
    document.addEventListener('DOMContentLoaded', function() {
       
        
        // Observe elements for animation
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
        
        // Observe stats section specifically
        const statsSection = document.querySelector('.impact-stats');
        if (statsSection) {
            observer.observe(statsSection);
        }
    });
</script>