import React, { useState, useEffect } from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { ArrowRight, CheckCircle2, ChevronLeft, ChevronRight, Send, Award, Sliders, ThumbsUp, Users, Hourglass, Shield } from 'lucide-react';

export default function Home({ sliders, aboutUs, blog, event, whatWeDo, works, gallery, galleryCat, workProcess, ourClient, homePageCms }) {
    const [currentSlider, setCurrentSlider] = useState(0);
    const [aboutTab, setAboutTab] = useState('trust'); // 'trust', 'expertise', 'safety'

    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    useEffect(() => {
        if (!sliders || sliders.length === 0) return;
        const timer = setInterval(() => {
            setCurrentSlider((prev) => (prev + 1) % sliders.length);
        }, 6000);
        return () => clearInterval(timer);
    }, [sliders]);

    const firstHalfWorks = works ? works.slice(0, 3) : [];
    const secondHalfWorks = works ? works.slice(3) : [];

    return (
        <FrontEndLayout>
            <Head title="Home - SS Group" />

            {/* 1. Hero Slider Section */}
            {sliders && sliders.length > 0 && (
                <section className="relative bg-slate-900 text-white overflow-hidden min-h-[320px] sm:min-h-[550px] lg:min-h-[650px] flex items-center">
                    {sliders.map((slider, idx) => {
                        const subTitleText = slider.sub_title || slider.subtitle;
                        const buttonLinkUrl = slider.button_link || slider.link || '/about-us';
                        const position = (slider.text_position || 'left').toLowerCase();
                        const textAlignClass = position === 'right' 
                            ? 'text-right items-end ml-auto' 
                            : position === 'center' 
                                ? 'text-center items-center mx-auto' 
                                : 'text-left items-start mr-auto';
                        const imgSrc = slider.image 
                            ? (slider.image.startsWith('http') || slider.image.startsWith('/') ? slider.image : `/${slider.image}`) 
                            : '';

                        return (
                            <div
                                key={slider.id || idx}
                                className={`absolute inset-0 transition-opacity duration-1000 ease-in-out ${
                                    idx === currentSlider ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'
                                }`}
                            >
                                <div className="absolute inset-0 z-10 pointer-events-none" />
                                {imgSrc && (
                                    <img
                                        src={imgSrc}
                                        alt={slider.title || 'Slider image'}
                                        className="absolute inset-0 w-full h-full object-cover z-0"
                                    />
                                )}

                                <div className={`relative z-20 ${containerClass} h-full flex flex-col justify-center py-6 sm:py-20 pb-16 sm:pb-20`}>
                                    <div className={`max-w-2xl space-y-3 sm:space-y-6 animate-in fade-in slide-in-from-left duration-700 flex flex-col ${textAlignClass}`}>
                                        <div className="flex items-center gap-2">
                                            <span className="font-bold text-xs uppercase tracking-widest text-white">SS GROUP</span>
                                            <div className="w-8 h-0.5 bg-[#0066ff]" />
                                        </div>
                                        {slider.title && (
                                            <h1 className="text-xl sm:text-5xl lg:text-6xl font-semibold sm:font-bold tracking-tight leading-tight text-white drop-shadow-md">
                                                {slider.title}
                                            </h1>
                                        )}
                                        {subTitleText && (
                                            <p className="text-xs sm:text-lg text-white leading-relaxed drop-shadow line-clamp-3 sm:line-clamp-none">
                                                {subTitleText}
                                            </p>
                                        )}
                                        <div className="pt-2 sm:pt-4 flex flex-wrap gap-4">
                                            {slider.button_text && (
                                                <a
                                                    href={buttonLinkUrl}
                                                    className="inline-flex items-center gap-2 bg-[#0066ff] hover:bg-[#0052cc] text-white font-bold px-5 sm:px-7 py-3 sm:py-3.5 rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 uppercase tracking-wider text-xs sm:text-sm"
                                                >
                                                    <span>{slider.button_text}</span>
                                                    <ArrowRight className="w-4 h-4" />
                                                </a>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        );
                    })}

                    {/* Slider Arrows */}
                    {sliders.length > 1 && (
                        <div className="absolute right-4 sm:right-6 bottom-16 sm:bottom-8 z-30 flex items-center gap-2">
                            <button
                                onClick={() => setCurrentSlider((prev) => (prev === 0 ? sliders.length - 1 : prev - 1))}
                                className="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-900/60 hover:bg-[#0066ff] text-white flex items-center justify-center backdrop-blur-md border border-slate-700 transition-colors"
                            >
                                <ChevronLeft className="w-4 h-4 sm:w-5 sm:h-5" />
                            </button>
                            <button
                                onClick={() => setCurrentSlider((prev) => (prev + 1) % sliders.length)}
                                className="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-900/60 hover:bg-[#0066ff] text-white flex items-center justify-center backdrop-blur-md border border-slate-700 transition-colors"
                            >
                                <ChevronRight className="w-4 h-4 sm:w-5 sm:h-5" />
                            </button>
                        </div>
                    )}
                </section>
            )}

            {/* Floating Statistics Counter Bar */}
            {(() => {
                const getStat = (val, fallback) => (val !== null && val !== undefined && String(val).trim() !== '' ? val : fallback);
                return (
                    <div className={`relative z-30 ${containerClass} -mt-10 sm:-mt-12 mb-8`}>
                        <div className="bg-white rounded-2xl shadow-xl border border-slate-100 p-4 sm:p-8 grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 items-center divide-y-0 sm:divide-y-0 md:divide-x divide-slate-100">
                            <div className="flex items-center gap-3 sm:gap-4 p-3 sm:p-0 rounded-xl bg-slate-50/70 sm:bg-transparent border border-slate-100/80 sm:border-none">
                                <div className="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0066ff] flex items-center justify-center shrink-0">
                                    <Award className="w-5 h-5 sm:w-6 sm:h-6" />
                                </div>
                                <div className="min-w-0">
                                    <span className="block text-lg sm:text-2xl md:text-3xl font-extrabold text-[#0066ff] leading-tight truncate">
                                        {getStat(homePageCms?.stat_1_number, '27+')}
                                    </span>
                                    <span className="text-[11px] sm:text-xs font-semibold text-slate-600 leading-snug line-clamp-2">
                                        {getStat(homePageCms?.stat_1_label, 'Years of Experience')}
                                    </span>
                                </div>
                            </div>
                            <div className="flex items-center gap-3 sm:gap-4 p-3 sm:p-0 rounded-xl bg-slate-50/70 sm:bg-transparent border border-slate-100/80 sm:border-none md:pl-6">
                                <div className="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0066ff] flex items-center justify-center shrink-0">
                                    <Users className="w-5 h-5 sm:w-6 sm:h-6" />
                                </div>
                                <div className="min-w-0">
                                    <span className="block text-lg sm:text-2xl md:text-3xl font-extrabold text-[#0066ff] leading-tight truncate">
                                        {getStat(homePageCms?.stat_2_number, '1170+')}
                                    </span>
                                    <span className="text-[11px] sm:text-xs font-semibold text-slate-600 leading-snug line-clamp-2">
                                        {getStat(homePageCms?.stat_2_label, 'Construction Experts')}
                                    </span>
                                </div>
                            </div>
                            <div className="flex items-center gap-3 sm:gap-4 p-3 sm:p-0 rounded-xl bg-slate-50/70 sm:bg-transparent border border-slate-100/80 sm:border-none md:pl-6">
                                <div className="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0066ff] flex items-center justify-center shrink-0">
                                    <Sliders className="w-5 h-5 sm:w-6 sm:h-6" />
                                </div>
                                <div className="min-w-0">
                                    <span className="block text-lg sm:text-2xl md:text-3xl font-extrabold text-[#0066ff] leading-tight truncate">
                                        {getStat(homePageCms?.stat_3_number, '500+')}
                                    </span>
                                    <span className="text-[11px] sm:text-xs font-semibold text-slate-600 leading-snug line-clamp-2">
                                        {getStat(homePageCms?.stat_3_label, 'Successful Projects')}
                                    </span>
                                </div>
                            </div>
                            <div className="flex items-center gap-3 sm:gap-4 p-3 sm:p-0 rounded-xl bg-slate-50/70 sm:bg-transparent border border-slate-100/80 sm:border-none md:pl-6">
                                <div className="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0066ff] flex items-center justify-center shrink-0">
                                    <ThumbsUp className="w-5 h-5 sm:w-6 sm:h-6" />
                                </div>
                                <div className="min-w-0">
                                    <span className="block text-lg sm:text-2xl md:text-3xl font-extrabold text-[#0066ff] leading-tight truncate">
                                        {getStat(homePageCms?.stat_4_number, '100%')}
                                    </span>
                                    <span className="text-xs font-semibold text-slate-600 leading-snug line-clamp-2">
                                        {getStat(homePageCms?.stat_4_label, 'Client Satisfaction')}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                );
            })()}



            {/* 3. About Section with 3-Column Layout & Trust/Expertise/Safety Tabs */}
            {aboutUs && (() => {
                const checks = [
                    aboutUs.check_1 || 'Quality Construction',
                    aboutUs.check_2 || 'Professional Team',
                    aboutUs.check_3 || 'On Time Delivery',
                    aboutUs.check_4 || 'Modern Equipment',
                    aboutUs.check_5 || 'Certified Engineers',
                    aboutUs.check_6 || '24/7 Support'
                ].filter(Boolean);

                const getImgSrc = (path, fallback) => {
                    if (!path) return fallback;
                    return path.startsWith('http') || path.startsWith('/') ? path : `/${path}`;
                };

                return (
                    <section className="py-16 sm:py-20 bg-white">
                        <div className={containerClass}>
                            <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch">
                                
                                {/* Left Column: Intro text, bullet list, and button */}
                                <div className="lg:col-span-5 flex flex-col justify-start space-y-5">
                                    <div className="space-y-4">
                                        <div>
                                            <span className="inline-block text-[#0066ff] font-bold text-xs uppercase tracking-widest bg-blue-50 px-3.5 py-1.5 rounded-xl mb-2">
                                                {aboutUs.sub_title || 'ABOUT US'}
                                            </span>
                                            <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                                {aboutUs.title || 'Building Trust. Delivering Excellence.'}
                                            </h2>
                                        </div>

                                        <div
                                            className="text-slate-600 leading-relaxed text-sm prose prose-slate max-w-none"
                                            dangerouslySetInnerHTML={{ __html: aboutUs.detail }}
                                        />

                                        {checks.length > 0 && (
                                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                                                {checks.map((check, idx) => (
                                                    <div key={idx} className="flex items-center gap-2.5">
                                                        <CheckCircle2 className="w-5 h-5 text-[#0066ff] shrink-0" />
                                                        <span className="text-xs sm:text-sm font-bold text-slate-800">{check}</span>
                                                    </div>
                                                ))}
                                            </div>
                                        )}
                                    </div>

                                    {aboutUs.button_title && (
                                        <div className="pt-2">
                                            <a
                                                href={aboutUs.button_link || '/about-us'}
                                                className="inline-flex items-center justify-center gap-2.5 bg-white hover:bg-[#0066ff] text-[#0066ff] hover:text-white border-2 border-[#0066ff] font-semibold px-5 py-2.5 rounded-md shadow-xs transition-all duration-300 uppercase tracking-wider text-xs sm:text-sm group"
                                            >
                                                <span>{aboutUs.button_title}</span>
                                                <ArrowRight className="w-4 h-4 text-[#0066ff] group-hover:text-white transition-colors" />
                                            </a>
                                        </div>
                                    )}
                                </div>

                                {/* Middle Column: Image with Experience Badge Overlay matching media_1789362502466.png */}
                                <div className="lg:col-span-3 relative min-h-[380px] lg:min-h-[460px] pb-4 pl-4 sm:pb-5 sm:pl-5">
                                    <div className="relative w-full h-full rounded-2xl overflow-hidden shadow-md border border-slate-100">
                                        <img
                                            src={getImgSrc(aboutUs.first_image, 'https://images.unsplash.com/photo-1541888946425-d0fbb186a5b3?auto=format&fit=crop&w=800&q=80')}
                                            alt={aboutUs.title || 'About Us Image'}
                                            className="w-full h-full object-cover"
                                            onError={(e) => {
                                                e.currentTarget.src = 'https://images.unsplash.com/photo-1541888946425-d0fbb186a5b3?auto=format&fit=crop&w=800&q=80';
                                            }}
                                        />
                                    </div>

                                    {/* Solid Royal Blue Overlapping Badge at Bottom Left */}
                                    <div className="absolute bottom-0 left-0 bg-[#0066ff] text-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl shadow-xl z-20 min-w-[105px] sm:min-w-[115px]">
                                        <span className="block text-2xl sm:text-3xl font-semibold text-white leading-none tracking-tight mb-1.5">
                                            {aboutUs.experience_years || '27+'}
                                        </span>
                                        <span className="block text-[11px] sm:text-xs font-semibold text-white leading-tight max-w-[80px]">
                                            {aboutUs.experience_label || 'Years of Experience'}
                                        </span>
                                    </div>
                                </div>

                                {/* Right Column: Interactive Tabs (Trust, Expertise, Safety) */}
                                <div className="lg:col-span-4 bg-slate-50 border border-slate-100 rounded-3xl p-6 sm:p-7 space-y-6 shadow-sm flex flex-col justify-between">
                                    {/* Tab Bar */}
                                    <div className="flex border-b border-slate-200 gap-1 sm:gap-2">
                                        <button
                                            onClick={() => setAboutTab('trust')}
                                            className={`pb-3 px-3 sm:px-4 font-bold text-xs sm:text-sm uppercase tracking-wider transition-all border-b-2 ${
                                                aboutTab === 'trust' ? 'border-[#0066ff] text-[#0066ff]' : 'border-transparent text-slate-500 hover:text-slate-900'
                                            }`}
                                        >
                                            Trust
                                        </button>
                                        <button
                                            onClick={() => setAboutTab('expertise')}
                                            className={`pb-3 px-3 sm:px-4 font-bold text-xs sm:text-sm uppercase tracking-wider transition-all border-b-2 ${
                                                aboutTab === 'expertise' ? 'border-[#0066ff] text-[#0066ff]' : 'border-transparent text-slate-500 hover:text-slate-900'
                                            }`}
                                        >
                                            Expertise
                                        </button>
                                        <button
                                            onClick={() => setAboutTab('safety')}
                                            className={`pb-3 px-3 sm:px-4 font-bold text-xs sm:text-sm uppercase tracking-wider transition-all border-b-2 ${
                                                aboutTab === 'safety' ? 'border-[#0066ff] text-[#0066ff]' : 'border-transparent text-slate-500 hover:text-slate-900'
                                            }`}
                                        >
                                            Safety
                                        </button>
                                    </div>

                                    {/* Tab Content */}
                                    <div className="space-y-4 flex-1 flex flex-col justify-center">
                                        {aboutTab === 'trust' && (
                                            <div className="space-y-3.5 animate-in fade-in duration-300">
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <Award className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.trust_title_one || 'Proven Track Record'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.trust_detail_one || 'Delivering top-tier quality across complex infrastructure projects.'}</p>
                                                    </div>
                                                </div>
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <Sliders className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.trust_title_two || 'Transparent Process'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.trust_detail_two || 'Clear communication, fair pricing, and full reporting at every phase.'}</p>
                                                    </div>
                                                </div>
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <ThumbsUp className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.trust_title_three || 'Client Satisfaction'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.trust_detail_three || 'Long-term client relationships built on dependability and integrity.'}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        )}

                                        {aboutTab === 'expertise' && (
                                            <div className="space-y-3.5 animate-in fade-in duration-300">
                                                {aboutUs.expertise_detail && (
                                                    <p className="text-xs text-slate-600 leading-relaxed italic bg-white p-3 rounded-xl border border-slate-100">
                                                        {aboutUs.expertise_detail}
                                                    </p>
                                                )}
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <Users className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.expertise_title_one || 'Advanced Engineering'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.expertise_detail_one || 'Utilizing modern structural engineering methodologies.'}</p>
                                                    </div>
                                                </div>
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <Hourglass className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.expertise_title_two || 'Skilled Workforce'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.expertise_detail_two || 'Highly trained project managers, site engineers, and specialists.'}</p>
                                                    </div>
                                                </div>
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <Sliders className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.expertise_title_three || 'Quality Control'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.expertise_detail_three || 'Strict quality standards and continuous site inspection.'}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        )}

                                        {aboutTab === 'safety' && (
                                            <div className="space-y-3.5 animate-in fade-in duration-300">
                                                {aboutUs.safety_image && (
                                                    <img src={getImgSrc(aboutUs.safety_image, '')} alt="Safety" className="rounded-xl w-full h-32 object-cover shadow-xs mb-2" />
                                                )}
                                                {aboutUs.safety_detail && (
                                                    <p className="text-xs text-slate-600 leading-relaxed bg-white p-3 rounded-xl border border-slate-100 mb-2">
                                                        {aboutUs.safety_detail}
                                                    </p>
                                                )}
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <Shield className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.safety_title_one || 'Zero Accident Policy'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.safety_detail_one || 'Enforcing comprehensive health and safety regulations on all job sites.'}</p>
                                                    </div>
                                                </div>
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <Award className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.safety_title_two || 'Certified Protective Gear'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.safety_detail_two || 'Equipping all workers with standard PPE and safety equipment.'}</p>
                                                    </div>
                                                </div>
                                                <div className="flex items-start gap-3 p-3.5 bg-white rounded-2xl border border-slate-100 shadow-2xs">
                                                    <CheckCircle2 className="w-5 h-5 text-[#0066ff] shrink-0 mt-0.5" />
                                                    <div>
                                                        <h4 className="font-bold text-slate-900 text-sm">{aboutUs.safety_title_three || 'Regular Safety Audits'}</h4>
                                                        <p className="text-xs text-slate-500 mt-0.5 leading-relaxed">{aboutUs.safety_detail_three || 'Conducting routine risk assessments and emergency protocol training.'}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        )}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                );
            })()}

            {/* 4. What We Do Section */}
            {whatWeDo && (
                <section className="py-16 sm:py-20 lg:py-24 bg-white relative border-y border-slate-100">
                    <div className={containerClass}>
                        {/* Section Header */}
                        <div className="flex flex-col md:flex-row md:items-end justify-between gap-4 md:gap-8 mb-8 sm:mb-10">
                            <div>
                                <span className="text-[#0066ff] font-bold text-xs uppercase tracking-widest block mb-1.5">
                                    {whatWeDo.title || 'WHAT WE DO'}
                                </span>
                                <h2 className="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                                    {whatWeDo.sub_title || 'Our Core Services'}
                                </h2>
                                <div className="w-10 h-1 bg-[#0066ff] rounded-full mt-2.5" />
                            </div>
                            <div className="md:max-w-sm">
                                <p className="text-slate-500 text-xs sm:text-sm leading-relaxed">
                                    {whatWeDo.description || 'Collaboratively administrate empowered markets via plug and play networks.'}
                                </p>
                            </div>
                        </div>

                        {/* Services Grid (Responsive 6 Columns with reduced gap) */}
                        {works && works.length > 0 && (
                            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-3.5 lg:gap-4">
                                {works.map((item, idx) => {
                                    const titleLower = (item.title || '').toLowerCase();
                                    const itemLink = item.link || '/business';

                                    // Dynamic SVG vector icons matching the reference design
                                    const renderIcon = () => {
                                        if (item.icon) {
                                            const imgSrc = item.icon.startsWith('http') || item.icon.startsWith('/') ? item.icon : `/${item.icon}`;
                                            return <img src={imgSrc} alt={item.title} className="w-14 h-14 sm:w-16 sm:h-16 object-contain group-hover:scale-110 transition-transform duration-300" />;
                                        }

                                        if (titleLower.includes('construct')) {
                                            return (
                                                <svg className="w-10 h-10 text-[#0066ff]" viewBox="0 0 64 64" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                                                    <path d="M12 56V12h20l12-8h8v8H32v44" />
                                                    <path d="M8 56h48" />
                                                    <path d="M32 20h24v4" />
                                                    <path d="M48 24v20" />
                                                    <path d="M40 32h16v16H40z" fill="currentColor" fillOpacity="0.12" />
                                                    <path d="M20 28h8v28h-8z" />
                                                    <path d="M24 36v.01" strokeWidth="4" />
                                                    <path d="M24 44v.01" strokeWidth="4" />
                                                </svg>
                                            );
                                        }
                                        if (titleLower.includes('land') || titleLower.includes('develop')) {
                                            return (
                                                <svg className="w-10 h-10 text-[#0066ff]" viewBox="0 0 64 64" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                                                    <path d="M8 48c8-4 16 2 24-2s16-2 24-2" />
                                                    <path d="M8 54c8-4 16 2 24-2s16-2 24-2" />
                                                    <path d="M20 38c4-8 12-14 20-14 4 0 8 2 10 4" />
                                                    <path d="M32 24V10" />
                                                    <path d="M32 10c-4 0-8 4-8 8s8 6 8 6" fill="currentColor" fillOpacity="0.15" />
                                                    <path d="M32 10c4 0 8 4 8 8s-8 6-8 6" fill="currentColor" fillOpacity="0.15" />
                                                </svg>
                                            );
                                        }
                                        if (titleLower.includes('dredg') || titleLower.includes('river')) {
                                            return (
                                                <svg className="w-10 h-10 text-[#0066ff]" viewBox="0 0 64 64" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                                                    <path d="M12 36l8-12h24l6 12H12z" fill="currentColor" fillOpacity="0.12" />
                                                    <path d="M24 24V14h12v10" />
                                                    <path d="M8 44c6 0 10-3 16-3s10 3 16 3 10-3 16-3" />
                                                    <path d="M8 52c6 0 10-3 16-3s10 3 16 3 10-3 16-3" />
                                                    <path d="M44 24l8 12" />
                                                </svg>
                                            );
                                        }
                                        if (titleLower.includes('medic') || titleLower.includes('electro') || titleLower.includes('furniture')) {
                                            return (
                                                <svg className="w-10 h-10 text-[#0066ff]" viewBox="0 0 64 64" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                                                    <rect x="14" y="10" width="36" height="28" rx="4" fill="currentColor" fillOpacity="0.12" />
                                                    <path d="M22 24h4l3-6 4 12 3-6h6" />
                                                    <path d="M28 38v10" />
                                                    <path d="M36 38v10" />
                                                    <path d="M20 48h24" />
                                                </svg>
                                            );
                                        }
                                        if (titleLower.includes('import') || titleLower.includes('export')) {
                                            return (
                                                <svg className="w-10 h-10 text-[#0066ff]" viewBox="0 0 64 64" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                                                    <circle cx="28" cy="28" r="16" fill="currentColor" fillOpacity="0.12" />
                                                    <path d="M12 28h32" />
                                                    <path d="M28 12c4 5 6 11 6 16s-2 11-6 16" />
                                                    <path d="M28 12c-4 5-6 11-6 16s2 11 6 16" />
                                                    <path d="M44 40l10-10-10-10" />
                                                    <path d="M36 30h18" />
                                                </svg>
                                            );
                                        }
                                        return (
                                            <svg className="w-10 h-10 text-[#0066ff]" viewBox="0 0 64 64" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                                                <path d="M16 24l12-8 12 8v16l-12 8-12-8V24z" fill="currentColor" fillOpacity="0.12" />
                                                <path d="M16 24l12 8 12-8" />
                                                <path d="M28 32v16" />
                                                <path d="M36 12l12 8v16" />
                                            </svg>
                                        );
                                    };

                                    return (
                                        <div
                                            key={idx}
                                            className="relative bg-white rounded-2xl p-4 sm:p-5 border border-[#0066ff]/40 shadow-[0_14px_20px_-12px_rgba(15,23,42,0.08)] hover:shadow-[0_16px_24px_-10px_rgba(0,102,255,0.14)] hover:border-[#0066ff]/70 transition-all duration-300 flex flex-col justify-between group overflow-hidden h-full text-left"
                                        >
                                            {/* Top Row: Icon & Serial Number */}
                                            <div className="flex items-center justify-between mb-3">
                                                <div className="w-12 h-12 flex items-center justify-start text-[#0066ff] shrink-0">
                                                    {renderIcon()}
                                                </div>
                                                <span className="text-slate-300 font-bold text-xs tracking-wider group-hover:text-[#0066ff] transition-colors select-none">
                                                    0{idx + 1}
                                                </span>
                                            </div>

                                            {/* Title */}
                                            <h3 className="font-bold text-slate-900 text-sm sm:text-[15px] leading-snug mb-2 min-h-[38px] flex items-center group-hover:text-[#0066ff] transition-colors">
                                                {item.title}
                                            </h3>

                                            {/* Detail Description */}
                                            <p className="text-slate-500 text-xs leading-relaxed line-clamp-4 font-normal flex-1 mb-3">
                                                {item.detail}
                                            </p>

                                            {/* Action Link Button */}
                                            <a
                                                href={itemLink}
                                                className="inline-flex items-center justify-between w-full pt-2.5 border-t border-slate-100 text-[#0066ff] font-bold text-[11px] sm:text-xs uppercase tracking-wider group-hover:text-blue-700 transition-colors mt-auto group/btn"
                                            >
                                                <span>LEARN MORE</span>
                                                <div className="w-6 h-6 rounded-full bg-blue-50 text-[#0066ff] flex items-center justify-center group-hover:bg-[#0066ff] group-hover:text-white group-hover/btn:translate-x-0.5 transition-all">
                                                    <ArrowRight className="w-3 h-3" />
                                                </div>
                                            </a>
                                        </div>
                                    );
                                })}
                            </div>
                        )}
                    </div>
                </section>
            )}

            {/* 5. Projects Title / Gallery Section */}
            {gallery && gallery.length > 0 && (
                <section className="py-20 bg-slate-50">
                    <div className={containerClass}>
                        <div className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                            <div>
                                <span className="text-blue-600 font-bold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1.5 rounded-md">
                                    Our Portfolio
                                </span>
                                <h2 className="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-2">
                                    {homePageCms?.project_title || 'Featured Projects'}
                                </h2>
                            </div>
                            <a
                                href={homePageCms?.project_button_link || '/projects'}
                                className="inline-flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 text-sm"
                            >
                                <span>{homePageCms?.project_button_title || 'View All Projects'}</span>
                                <ArrowRight className="w-4 h-4" />
                            </a>
                        </div>

                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            {gallery.slice(0, 4).map((item) => (
                                <div key={item.id} className="group bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300">
                                    <div className="h-56 overflow-hidden relative bg-slate-900">
                                        {item.image && (
                                            <img src={`/${item.image}`} alt={item.title} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                        )}
                                        <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent p-4 flex items-end opacity-90 group-hover:opacity-100 transition-opacity">
                                            <h3 className="text-white font-bold text-sm">{item.title}</h3>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            {/* 6. Our Clients Section */}
            {ourClient && ourClient.length > 0 && (
                <section className="py-16 bg-white border-t border-slate-100">
                    <div className={containerClass}>
                        <div className="text-center">
                            <span className="text-xs font-bold uppercase tracking-widest text-slate-400 block mb-8">
                                {homePageCms?.client_title || 'Trusted By Corporate Leaders & Brands'}
                            </span>
                            <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 items-center">
                                {ourClient.map((client, idx) => (
                                    <div key={client.id || idx} className="bg-slate-50 p-4 rounded-xl shadow-xs border border-slate-100 hover:shadow-md transition-shadow flex items-center justify-center h-24">
                                        <img
                                            src={`/${client.image}`}
                                            alt={client.title || 'Client logo'}
                                            className="max-h-14 max-w-full object-contain grayscale hover:grayscale-0 transition-all duration-300"
                                        />
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </section>
            )}

            {/* 7. Latest News / Blog Section */}
            {blog && blog.length > 0 && (
                <section className="py-20 bg-slate-50">
                    <div className={containerClass}>
                        <div className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                            <div>
                                <span className="text-blue-600 font-bold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1.5 rounded-md">
                                    Our Journal
                                </span>
                                <h2 className="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-2">
                                    {homePageCms?.news_title || 'Latest Articles & Insights'}
                                </h2>
                                {homePageCms?.news_sub_title && (
                                    <p className="text-slate-500 text-sm mt-1">{homePageCms.news_sub_title}</p>
                                )}
                            </div>
                            <a
                                href={homePageCms?.news_button_link || '/blog'}
                                className="inline-flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 text-sm"
                            >
                                <span>{homePageCms?.news_button_title || 'See All Posts'}</span>
                                <ArrowRight className="w-4 h-4" />
                            </a>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {blog.slice(0, 3).map((item) => (
                                <article key={item.id} className="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                                    <div className="relative h-48 overflow-hidden bg-slate-100">
                                        {item.image && (
                                            <img
                                                src={`/${item.image}`}
                                                alt={item.title}
                                                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            />
                                        )}
                                    </div>
                                    <div className="p-6 flex flex-col flex-grow">
                                        <h3 className="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors line-clamp-2 mb-3">
                                            <Link href={`/blog/${item.slug}`}>{item.title}</Link>
                                        </h3>
                                        <p className="text-slate-500 text-sm line-clamp-3 mb-4 leading-relaxed">
                                            {item.details ? item.details.replace(/(<([^>]+)>)/gi, '') : ''}
                                        </p>
                                        <div className="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                                            <span>{new Date(item.created_at).toLocaleDateString()}</span>
                                            <Link href={`/blog/${item.slug}`} className="font-semibold text-blue-600 hover:text-blue-700">
                                                Read More &rarr;
                                            </Link>
                                        </div>
                                    </div>
                                </article>
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </FrontEndLayout>
    );
}
