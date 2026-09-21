import React, { useState, useEffect, useRef } from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { 
    Trophy, Users, Calendar, Star, Eye, Target, Award, Check, 
    Handshake, Phone, Crown, UserCheck, ShieldCheck, ChevronRight 
} from 'lucide-react';

export default function SportsAffiliation({ pageCms }) {
    // Parse JSON fields safely with fallbacks
    const parseJson = (val, fallback = []) => {
        if (!val) return fallback;
        if (typeof val === 'object') return val;
        try {
            return JSON.parse(val);
        } catch (e) {
            return fallback;
        }
    };

    const heroStats = parseJson(pageCms?.hero_stats, [
        { number: '7+', label: 'Years Partnership' },
        { number: '100+', label: 'Active Players' },
        { number: '5', label: 'Major Championships' }
    ]);

    const heroSlides = parseJson(pageCms?.hero_slides, [
        {
            image: 'assets/images/sports/482248727_630090159807679_1759744023289367802_n.jpg',
            title: 'Cricket Excellence',
            subtitle: 'Empowering grassroots talent across Bangladesh'
        },
        {
            image: 'assets/images/sports/497750612_679129711570390_6929261868971358590_n.jpg',
            title: 'Partnership Success',
            subtitle: '7+ years of successful collaboration'
        },
        {
            image: 'assets/images/sports/488250225_649535181196510_5133201489674523724_n.jpg',
            title: 'Tournament Victory',
            subtitle: '5 major championships won together'
        }
    ]);

    const highlightList = parseJson(pageCms?.highlight_list, [
        'Supporting 100+ active cricketers in DPL, First & Second Division',
        'Enabling pathways to BPL, U-19, and National teams',
        'Facilitating grassroots coaching and scouting programs',
        'Organizing franchise-style tournaments'
    ]);

    const missionList = parseJson(pageCms?.mission_list, [
        'Organize high-quality tournaments for emerging players',
        'Develop local talent through coaching and scouting',
        'Promote cricket as a tool for empowerment',
        'Build infrastructure for long-term excellence',
        'Develop cricket academies for talent enrichment'
    ]);

    const tournamentList = parseJson(pageCms?.tournament_list, [
        '3× Mash Champion Trophy',
        'GULZER T20 Season 7 Champions',
        'PKSP Academy Cup Champions',
        'City Cup Champions',
        'Royal Champion Trophy'
    ]);

    const playersList = parseJson(pageCms?.players_list, [
        { name: 'Habibur Rahman Sohan', achievement: 'BPL, DPL, HP Squad', level: 'National' },
        { name: 'Mahfijul Rahman Robin', achievement: 'U19, HP, DPL', level: 'Youth' },
        { name: 'Rayan Rafsan Rahman', achievement: 'U19, Emerging Team, DPL', level: 'Emerging' },
        { name: 'AB Jibon', achievement: 'D1 consistent performer', level: 'Professional' },
        { name: 'AKM Husna Habib', achievement: 'DPL all-rounder (both-arm bowler)', level: 'Specialist' },
        { name: 'Shariful Islam', achievement: 'Man of the Tournament, National Championship', level: 'Champion' },
        { name: 'Rafsan Al Mahmud', achievement: 'U19, highest scorer in D1', level: 'Youth' },
        { name: 'Mahidul Islam Ankon', achievement: 'Gulzar T20 performer', level: 'T20' }
    ]);

    const impactStats = parseJson(pageCms?.impact_stats, [
        { icon: 'users', count: 100, text: 'Active Players', desc: 'Across DPL, First & Second Division' },
        { icon: 'trophy', count: 8, text: 'Major Championships', desc: 'Tournament victories achieved' },
        { icon: 'calendar', count: 7, text: 'Years Partnership', desc: 'Continuous collaboration since 2018' },
        { icon: 'star', count: 15, text: 'National Selections', desc: 'Players reached national level' }
    ]);

    const contactCards = parseJson(pageCms?.contact_cards, [
        { name: 'Md. Milon Mondal (Abir)', title: 'Managing Director - 10-12 Sports', phone: '01776426880', role: '', icon: 'user-tie' },
        { name: 'Fokhrul Islam Robin', title: 'Chairman - 10-12 Sporting Club', phone: '', role: 'Strategic Leadership & Governance', icon: 'crown' }
    ]);

    const excellenceBadges = parseJson(pageCms?.excellence_badges, [
        'Grassroots Development',
        'Professional Pathways',
        'Social Impact',
        'Tournament Excellence'
    ]);

    // Active Slider State
    const [activeSlide, setActiveSlide] = useState(0);
    const [isHovered, setIsHovered] = useState(false);

    useEffect(() => {
        if (!heroSlides.length || isHovered) return;
        const interval = setInterval(() => {
            setActiveSlide((prev) => (prev + 1) % heroSlides.length);
        }, 4000);
        return () => clearInterval(interval);
    }, [heroSlides.length, isHovered]);

    // Helper for Level Badge Colors
    const getLevelBadgeClass = (level) => {
        const l = (level || '').toLowerCase();
        switch (l) {
            case 'national': return 'bg-amber-400 text-slate-950 font-bold';
            case 'youth': return 'bg-blue-600 text-white font-bold';
            case 'emerging': return 'bg-emerald-500 text-white font-bold';
            case 'professional': return 'bg-slate-800 text-white font-bold';
            case 'specialist': return 'bg-purple-600 text-white font-bold';
            case 'champion': return 'bg-red-500 text-white font-bold';
            case 't20': return 'bg-orange-500 text-white font-bold';
            default: return 'bg-emerald-500 text-white font-bold';
        }
    };

    // Helper for Impact Icons
    const renderImpactIcon = (iconName) => {
        const name = (iconName || '').toLowerCase();
        if (name.includes('user')) return <Users className="w-8 h-8 text-amber-300" />;
        if (name.includes('calendar')) return <Calendar className="w-8 h-8 text-amber-300" />;
        if (name.includes('star')) return <Star className="w-8 h-8 text-amber-300" />;
        return <Trophy className="w-8 h-8 text-amber-300" />;
    };

    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.meta || 'Sports Affiliation'} - SS Group`} />

            {/* HERO SECTION */}
            <section className="relative bg-gradient-to-r from-blue-700 via-blue-600 to-emerald-500 text-white py-12 lg:py-20 overflow-hidden">
                <div className="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(255,255,255,0.1),transparent_70%)] pointer-events-none" />
                <div className={`${containerClass} relative z-10`}>
                    <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                        {/* Left Column Text & Stats */}
                        <div className="lg:col-span-6 space-y-6">
                            <nav className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-blue-100 mb-2">
                                <Link href="/" className="hover:underline text-white font-bold">Home</Link>
                                <span className="text-blue-200 font-bold">/</span>
                                <span className="text-white font-bold">Sports Affiliation</span>
                            </nav>

                            <h1 className="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                                {pageCms?.hero_title || 'SS Group × 10-12 Sports'}
                            </h1>

                            <p className="text-blue-50 text-base sm:text-lg leading-relaxed max-w-xl">
                                {pageCms?.hero_subtitle || 'Empowering Bangladesh Cricket Excellence Since 2018. A proud partnership fostering grassroots talent and building pathways to professional cricket.'}
                            </p>

                            {/* Stat Counters */}
                            <div className="grid grid-cols-3 gap-3 pt-4 max-w-lg">
                                {heroStats.map((stat, idx) => (
                                    <div key={idx} className="bg-white/10 backdrop-blur-md rounded-2xl p-4 text-center border border-white/20 shadow-sm">
                                        <div className="text-2xl sm:text-3xl font-bold text-amber-300">
                                            {stat.number}
                                        </div>
                                        <div className="text-[11px] sm:text-xs text-white/90 font-medium mt-1">
                                            {stat.label}
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Right Column Image Slider */}
                        <div className="lg:col-span-6">
                            <div 
                                className="relative w-full h-80 sm:h-96 rounded-3xl overflow-hidden shadow-2xl border border-white/20 group"
                                onMouseEnter={() => setIsHovered(true)}
                                onMouseLeave={() => setIsHovered(false)}
                            >
                                {heroSlides.map((slide, idx) => {
                                    const imgUrl = slide.image?.startsWith('http') || slide.image?.startsWith('/') 
                                        ? slide.image 
                                        : `/${slide.image}`;
                                    return (
                                        <div 
                                            key={idx}
                                            className={`absolute inset-0 transition-opacity duration-700 ease-in-out ${idx === activeSlide ? 'opacity-100 z-10' : 'opacity-0 z-0'}`}
                                        >
                                            <img 
                                                src={imgUrl} 
                                                alt={slide.title || 'Sports Slider'} 
                                                loading={idx === 0 ? "eager" : "lazy"}
                                                decoding="async"
                                                className="w-full h-full object-cover"
                                            />
                                            <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex flex-col justify-end p-6 sm:p-8 text-white">
                                                <h3 className="text-xl sm:text-2xl font-bold text-amber-300 mb-1">
                                                    {slide.title}
                                                </h3>
                                                <p className="text-xs sm:text-sm text-slate-200 line-clamp-2">
                                                    {slide.subtitle}
                                                </p>
                                            </div>
                                        </div>
                                    );
                                })}

                                {/* Slide controls */}
                                <div className="absolute bottom-4 right-4 z-20 flex items-center gap-2">
                                    {heroSlides.map((_, idx) => (
                                        <button
                                            key={idx}
                                            onClick={() => setActiveSlide(idx)}
                                            className={`h-2 rounded-full transition-all duration-300 ${idx === activeSlide ? 'w-6 bg-amber-400' : 'w-2 bg-white/50 hover:bg-white'}`}
                                            aria-label={`Go to slide ${idx + 1}`}
                                        />
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* STRATEGIC PARTNERSHIP SECTION */}
            <section className="py-16 sm:py-24 bg-slate-50 relative overflow-hidden">
                <div className={containerClass}>
                    {/* Header */}
                    <div className="max-w-3xl mb-12">
                        <span className="text-emerald-600 font-semibold text-xs uppercase tracking-widest block mb-2">
                            {pageCms?.partnership_kicker || 'STRATEGIC PARTNERSHIP'}
                        </span>
                        <h2 className="text-2xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-snug">
                            {pageCms?.partnership_title || 'Building Cricket Excellence Together'}
                        </h2>
                        <p className="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                            {pageCms?.partnership_subtitle || "Since 2018, SS Group has been proudly affiliated with 10-12 Sports, supporting Bangladesh's cricket development ecosystem"}
                        </p>
                    </div>

                    {/* Seven Year Journey Section */}
                    <div className="space-y-6 lg:space-y-8">
                        {/* Title & Top Text */}
                        <div className="space-y-3">
                            <h3 className="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-900 tracking-tight">
                                {pageCms?.journey_title || 'Our Seven-Year Journey'}
                            </h3>
                            <p className="text-slate-600 text-sm sm:text-base leading-relaxed">
                                {pageCms?.journey_text_1 || "Our partnership with 10-12 Sports represents a commitment to transforming grassroots cricket in Bangladesh. Together, we've created opportunities for underprivileged and rural talent to reach professional levels."}
                            </p>
                        </div>

                        {/* Middle Row: Green Box & Logo Box side by side on lg */}
                        <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
                            {/* Left: Green Box */}
                            <div className="lg:col-span-7 flex flex-col">
                                <div className="h-full p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-emerald-600 to-teal-700 text-white shadow-lg border border-emerald-400/30 flex flex-col justify-center">
                                    <div className="flex items-center gap-2.5 font-bold text-base sm:text-lg text-amber-300 mb-4">
                                        <Handshake className="w-5 h-5 shrink-0" />
                                        <span>{pageCms?.highlight_title || 'Partnership Highlights (2018-current)'}</span>
                                    </div>
                                    <ul className="space-y-3">
                                        {highlightList.map((item, idx) => (
                                            <li key={idx} className="flex items-start gap-3 text-xs sm:text-sm font-medium text-emerald-50">
                                                <div className="w-5 h-5 rounded-full bg-amber-300 text-slate-900 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5 shadow-xs">
                                                    ✓
                                                </div>
                                                <span>{item}</span>
                                            </li>
                                        ))}
                                    </ul>
                                </div>
                            </div>

                            {/* Right: Logo Showcase Card */}
                            <div className="lg:col-span-5 flex flex-col">
                                <div className="h-full bg-white p-6 sm:p-8 lg:p-8 rounded-3xl shadow-xl border border-slate-100 flex flex-col items-center justify-center text-center">
                                    <div className="w-full flex flex-col sm:flex-row items-center justify-around gap-6">
                                        {/* Company Logo Box */}
                                        <div className="flex-1 flex flex-col items-center">
                                            <div className="text-2xl sm:text-3xl font-extrabold text-blue-600 tracking-tight">
                                                {pageCms?.company_logo_text || 'SS GROUP'}
                                            </div>
                                            <div className="text-xs font-semibold text-slate-400 mt-1">
                                                {pageCms?.company_logo_subtitle || 'Since 2004'}
                                            </div>
                                        </div>

                                        {/* Plus Divider */}
                                        <div className="w-10 h-10 rounded-full bg-slate-100 text-emerald-500 font-bold text-lg flex items-center justify-center shrink-0">
                                            +
                                        </div>

                                        {/* Sports Logo Box */}
                                        <div className="flex-1 flex flex-col items-center">
                                            <div className="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 text-white font-bold text-lg flex items-center justify-center shadow-md shadow-emerald-500/20 mb-1.5">
                                                {pageCms?.sports_logo_badge || '10-12'}
                                            </div>
                                            <div className="text-lg font-bold text-slate-900">
                                                {pageCms?.sports_logo_text || 'SPORTS'}
                                            </div>
                                            <div className="text-[11px] italic text-slate-500 mt-0.5">
                                                {pageCms?.sports_logo_tagline || 'Grassroots to Glory'}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Bottom Text */}
                        <p className="text-slate-600 text-sm sm:text-base leading-relaxed">
                            {pageCms?.journey_text_2 || "Through this partnership, we've witnessed remarkable success stories - from rural discoveries to national team selections, proving that talent knows no geographical boundaries."}
                        </p>
                    </div>
                </div>
            </section>

            {/* SHARED VISION & MISSION SECTION */}
            <section className="py-16 sm:py-24 bg-white relative">
                <div className={containerClass}>
                    <div className="text-center max-w-2xl mx-auto mb-14">
                        <span className="text-emerald-600 font-semibold text-xs uppercase tracking-widest block mb-2">
                            {pageCms?.vision_kicker || 'OUR FOUNDATION'}
                        </span>
                        <h2 className="text-2xl sm:text-4xl font-bold text-slate-900 tracking-tight">
                            {pageCms?.vision_title || 'Shared Vision & Mission'}
                        </h2>
                        <p className="text-slate-600 text-sm sm:text-base mt-2">
                            {pageCms?.vision_subtitle || 'United in our commitment to cricket excellence and social impact'}
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {/* Card 1: Our Vision */}
                        <div className="bg-white p-8 rounded-3xl shadow-lg border border-slate-100 hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden group">
                            <div className="w-full h-1 bg-gradient-to-r from-blue-600 to-emerald-500 absolute top-0 left-0" />
                            <div className="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-emerald-500 text-white flex items-center justify-center font-bold mb-6 shadow-md shadow-blue-500/20">
                                <Eye className="w-7 h-7" />
                            </div>
                            <h3 className="text-xl font-bold text-slate-900 mb-3">
                                {pageCms?.vision_card_title || 'Our Vision'}
                            </h3>
                            <p className="text-slate-600 text-sm leading-relaxed">
                                {pageCms?.vision_card_text || "To be a catalyst for local cricket excellence in Bangladesh by creating structured opportunities and long-term support systems for players beyond Dhaka's elite leagues."}
                            </p>
                        </div>

                        {/* Card 2: Our Mission */}
                        <div className="bg-white p-8 rounded-3xl shadow-lg border border-slate-100 hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden group">
                            <div className="w-full h-1 bg-gradient-to-r from-emerald-500 to-teal-500 absolute top-0 left-0" />
                            <div className="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center font-bold mb-6 shadow-md shadow-emerald-500/20">
                                <Target className="w-7 h-7" />
                            </div>
                            <h3 className="text-xl font-bold text-slate-900 mb-4">
                                {pageCms?.mission_card_title || 'Our Mission'}
                            </h3>
                            <ul className="space-y-2.5">
                                {missionList.map((mItem, idx) => (
                                    <li key={idx} className="flex items-start gap-2.5 text-xs sm:text-sm text-slate-600 leading-snug">
                                        <span className="text-emerald-500 font-bold text-base leading-none">•</span>
                                        <span>{mItem}</span>
                                    </li>
                                ))}
                            </ul>
                        </div>

                        {/* Card 3: Tournament Success */}
                        <div className="bg-white p-8 rounded-3xl shadow-lg border border-slate-100 hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden group">
                            <div className="w-full h-1 bg-gradient-to-r from-amber-400 to-orange-500 absolute top-0 left-0" />
                            <div className="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 text-white flex items-center justify-center font-bold mb-6 shadow-md shadow-amber-500/20">
                                <Trophy className="w-7 h-7" />
                            </div>
                            <h3 className="text-xl font-bold text-slate-900 mb-4">
                                {pageCms?.tournament_card_title || 'Tournament Success'}
                            </h3>
                            <ul className="space-y-3">
                                {tournamentList.map((tItem, idx) => (
                                    <li key={idx} className="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-700">
                                        <Trophy className="w-4 h-4 text-amber-500 shrink-0" />
                                        <span>{tItem}</span>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            {/* NOTABLE PLAYERS SECTION */}
            <section className="py-16 sm:py-24 bg-slate-50 relative">
                <div className={containerClass}>
                    <div className="text-center max-w-2xl mx-auto mb-14">
                        <span className="text-emerald-600 font-semibold text-xs uppercase tracking-widest block mb-2">
                            {pageCms?.players_kicker || 'SUCCESS STORIES'}
                        </span>
                        <h2 className="text-2xl sm:text-4xl font-bold text-slate-900 tracking-tight">
                            {pageCms?.players_title || 'Notable Players'}
                        </h2>
                        <p className="text-slate-600 text-sm sm:text-base mt-2">
                            {pageCms?.players_subtitle || 'Celebrating talent nurtured through our partnership'}
                        </p>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        {playersList.map((player, idx) => {
                            const initials = (player.name || '')
                                .split(' ')
                                .map(n => n[0])
                                .join('')
                                .substring(0, 2)
                                .toUpperCase() || 'PL';

                            const hasImage = player.image && player.image.trim().length > 0;
                            const pImgUrl = hasImage && (player.image.startsWith('http') || player.image.startsWith('/')) 
                                ? player.image 
                                : `/${player.image}`;

                            return (
                                <div 
                                    key={idx}
                                    className="bg-white p-5 rounded-2xl shadow-sm hover:shadow-md border-l-4 border-l-emerald-500 border-t border-r border-b border-slate-100 flex items-center gap-4 transition-all duration-300 hover:translate-x-1"
                                >
                                    {/* Avatar / Photo */}
                                    <div className="relative shrink-0">
                                        {hasImage ? (
                                            <img 
                                                src={pImgUrl} 
                                                alt={player.name} 
                                                loading="lazy"
                                                decoding="async"
                                                className="w-14 h-14 rounded-full object-cover border-2 border-emerald-400"
                                            />
                                        ) : (
                                            <div className="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 text-white font-bold text-base flex items-center justify-center shadow-sm">
                                                {initials}
                                            </div>
                                        )}
                                        {/* Level Badge Tag */}
                                        <span className={`absolute -bottom-1 -right-1 text-[9px] px-2 py-0.5 rounded-full uppercase tracking-wider ${getLevelBadgeClass(player.level)}`}>
                                            {player.level}
                                        </span>
                                    </div>

                                    {/* Info */}
                                    <div className="flex-1 min-w-0">
                                        <h4 className="font-bold text-slate-900 text-base truncate">
                                            {player.name}
                                        </h4>
                                        <p className="text-xs text-slate-500 mt-1 font-medium leading-tight line-clamp-2">
                                            {player.achievement}
                                        </p>
                                    </div>

                                    {/* Green Indicator Dot */}
                                    <div className="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0 shadow-sm shadow-emerald-500/50" />
                                </div>
                            );
                        })}
                    </div>
                </div>
            </section>

            {/* PARTNERSHIP IMPACT SECTION */}
            <section className="py-16 sm:py-24 bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 text-white relative overflow-hidden">
                <div className="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(255,255,255,0.05),transparent_70%)] pointer-events-none" />
                <div className={`${containerClass} relative z-10`}>
                    <div className="text-center max-w-2xl mx-auto mb-14">
                        <span className="text-emerald-400 font-semibold text-xs uppercase tracking-widest block mb-2">
                            {pageCms?.impact_kicker || 'OUR IMPACT'}
                        </span>
                        <h2 className="text-2xl sm:text-4xl font-bold text-white tracking-tight">
                            {pageCms?.impact_title || 'Partnership Impact'}
                        </h2>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        {impactStats.map((stat, idx) => (
                            <div 
                                key={idx} 
                                className="bg-white/10 backdrop-blur-lg p-8 rounded-3xl border border-white/10 text-center hover:-translate-y-2 transition-transform duration-300"
                            >
                                <div className="flex justify-center mb-4">
                                    {renderImpactIcon(stat.icon)}
                                </div>
                                <div className="text-4xl sm:text-5xl font-bold text-white mb-2">
                                    {stat.count}+
                                </div>
                                <div className="text-sm font-bold text-amber-300 mb-1">
                                    {stat.text}
                                </div>
                                <div className="text-xs text-slate-300 font-medium opacity-90">
                                    {stat.desc}
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* CONTACT & EXCELLENCE SECTION */}
            <section className="py-16 sm:py-24 bg-slate-50 relative">
                <div className={containerClass}>
                    <div className="grid grid-cols-1 lg:grid-cols-12 gap-10">
                        {/* Left Box: Partnership Coordination */}
                        <div className="lg:col-span-6 space-y-6">
                            <h3 className="text-xl sm:text-2xl font-bold text-slate-900 flex items-center gap-2">
                                <Handshake className="w-6 h-6 text-emerald-500" />
                                <span>{pageCms?.contact_section_title || 'Partnership Coordination'}</span>
                            </h3>

                            <div className="space-y-4">
                                {contactCards.map((contact, idx) => (
                                    <div 
                                        key={idx}
                                        className="bg-white p-6 rounded-3xl shadow-sm border-l-4 border-l-emerald-500 border-t border-r border-b border-slate-100 flex items-center gap-5"
                                    >
                                        <div className="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center text-xl shrink-0 shadow-md shadow-emerald-500/20">
                                            {contact.icon === 'crown' ? <Crown className="w-7 h-7" /> : <UserCheck className="w-7 h-7" />}
                                        </div>
                                        <div className="space-y-1">
                                            <h4 className="font-bold text-slate-900 text-base">
                                                {contact.name}
                                            </h4>
                                            {contact.title && (
                                                <p className="text-xs font-bold text-emerald-600">
                                                    {contact.title}
                                                </p>
                                            )}
                                            {contact.phone && (
                                                <a href={`tel:${contact.phone}`} className="flex items-center gap-1.5 text-xs text-slate-500 hover:text-blue-600 font-medium">
                                                    <Phone className="w-3.5 h-3.5 text-emerald-500" />
                                                    <span>{contact.phone}</span>
                                                </a>
                                            )}
                                            {contact.role && (
                                                <p className="text-xs text-slate-500 italic">
                                                    {contact.role}
                                                </p>
                                            )}
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Right Box: Partnership Excellence */}
                        <div className="lg:col-span-6">
                            <div className="bg-white p-8 sm:p-10 rounded-3xl shadow-sm border-t-4 border-t-amber-400 border-r border-b border-l border-slate-100 space-y-6 h-full flex flex-col justify-between">
                                <div className="space-y-4">
                                    <h3 className="text-xl sm:text-2xl font-bold text-slate-900">
                                        {pageCms?.excellence_title || 'Partnership Excellence'}
                                    </h3>
                                    <p className="text-slate-600 text-sm sm:text-base leading-relaxed">
                                        {pageCms?.excellence_text || 'Our collaboration with 10-12 Sports has created a sustainable ecosystem for cricket development in Bangladesh. Together, we continue to identify, nurture, and promote talented cricketers from grassroots to professional levels.'}
                                    </p>
                                </div>

                                {/* Tag Badges */}
                                <div className="flex flex-wrap gap-2 pt-4 border-t border-slate-100">
                                    {excellenceBadges.map((badge, idx) => (
                                        <span 
                                            key={idx}
                                            className="px-4 py-2 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold text-xs uppercase tracking-wider shadow-sm"
                                        >
                                            {badge}
                                        </span>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
