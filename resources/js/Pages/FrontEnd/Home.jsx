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
                <section className="relative bg-slate-900 text-white overflow-hidden min-h-[550px] lg:min-h-[650px] flex items-center">
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

                                <div className={`relative z-20 ${containerClass} h-full flex flex-col justify-center py-20`}>
                                    <div className={`max-w-2xl space-y-6 animate-in fade-in slide-in-from-left duration-700 flex flex-col ${textAlignClass}`}>
                                        <div className="flex items-center gap-2">
                                            <span className="font-bold text-xs uppercase tracking-widest text-white">SS GROUP</span>
                                            <div className="w-8 h-0.5 bg-[#0066ff]" />
                                        </div>
                                        {slider.title && (
                                            <h1 className="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-white drop-shadow-md">
                                                {slider.title}
                                            </h1>
                                        )}
                                        {subTitleText && (
                                            <p className="text-base sm:text-lg text-white leading-relaxed drop-shadow">
                                                {subTitleText}
                                            </p>
                                        )}
                                        <div className="pt-4 flex flex-wrap gap-4">
                                            {slider.button_text && (
                                                <a
                                                    href={buttonLinkUrl}
                                                    className="inline-flex items-center gap-2 bg-[#0066ff] hover:bg-[#0052cc] text-white font-bold px-7 py-3.5 rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-300 hover:scale-105 uppercase tracking-wider text-sm"
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
                        <div className="absolute right-6 bottom-8 z-30 flex items-center gap-2">
                            <button
                                onClick={() => setCurrentSlider((prev) => (prev === 0 ? sliders.length - 1 : prev - 1))}
                                className="w-10 h-10 rounded-full bg-slate-900/60 hover:bg-[#0066ff] text-white flex items-center justify-center backdrop-blur-md border border-slate-700 transition-colors"
                            >
                                <ChevronLeft className="w-5 h-5" />
                            </button>
                            <button
                                onClick={() => setCurrentSlider((prev) => (prev + 1) % sliders.length)}
                                className="w-10 h-10 rounded-full bg-slate-900/60 hover:bg-[#0066ff] text-white flex items-center justify-center backdrop-blur-md border border-slate-700 transition-colors"
                            >
                                <ChevronRight className="w-5 h-5" />
                            </button>
                        </div>
                    )}
                </section>
            )}

            {/* Floating Statistics Counter Bar */}
            {(() => {
                const getStat = (val, fallback) => (val !== null && val !== undefined && String(val).trim() !== '' ? val : fallback);
                return (
                    <div className={`relative z-30 ${containerClass} -mt-12 mb-8`}>
                        <div className="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8 grid grid-cols-2 md:grid-cols-4 gap-6 items-center divide-y sm:divide-y-0 md:divide-x divide-slate-100">
                            <div className="flex items-center gap-4 px-2 py-2 sm:py-0">
                                <div className="w-12 h-12 rounded-xl bg-blue-50 text-[#0066ff] flex items-center justify-center shrink-0">
                                    <Award className="w-6 h-6" />
                                </div>
                                <div>
                                    <span className="block text-2xl sm:text-3xl font-extrabold text-[#0066ff]">
                                        {getStat(homePageCms?.stat_1_number, '27+')}
                                    </span>
                                    <span className="text-xs font-semibold text-slate-600">
                                        {getStat(homePageCms?.stat_1_label, 'Years of Experience')}
                                    </span>
                                </div>
                            </div>
                            <div className="flex items-center gap-4 px-2 py-2 sm:py-0 md:pl-6">
                                <div className="w-12 h-12 rounded-xl bg-blue-50 text-[#0066ff] flex items-center justify-center shrink-0">
                                    <Users className="w-6 h-6" />
                                </div>
                                <div>
                                    <span className="block text-2xl sm:text-3xl font-extrabold text-[#0066ff]">
                                        {getStat(homePageCms?.stat_2_number, '1170+')}
                                    </span>
                                    <span className="text-xs font-semibold text-slate-600">
                                        {getStat(homePageCms?.stat_2_label, 'Construction Experts')}
                                    </span>
                                </div>
                            </div>
                            <div className="flex items-center gap-4 px-2 py-2 sm:py-0 md:pl-6">
                                <div className="w-12 h-12 rounded-xl bg-blue-50 text-[#0066ff] flex items-center justify-center shrink-0">
                                    <Sliders className="w-6 h-6" />
                                </div>
                                <div>
                                    <span className="block text-2xl sm:text-3xl font-extrabold text-[#0066ff]">
                                        {getStat(homePageCms?.stat_3_number, '500+')}
                                    </span>
                                    <span className="text-xs font-semibold text-slate-600">
                                        {getStat(homePageCms?.stat_3_label, 'Successful Projects')}
                                    </span>
                                </div>
                            </div>
                            <div className="flex items-center gap-4 px-2 py-2 sm:py-0 md:pl-6">
                                <div className="w-12 h-12 rounded-xl bg-blue-50 text-[#0066ff] flex items-center justify-center shrink-0">
                                    <ThumbsUp className="w-6 h-6" />
                                </div>
                                <div>
                                    <span className="block text-2xl sm:text-3xl font-extrabold text-[#0066ff]">
                                        {getStat(homePageCms?.stat_4_number, '100%')}
                                    </span>
                                    <span className="text-xs font-semibold text-slate-600">
                                        {getStat(homePageCms?.stat_4_label, 'Client Satisfaction')}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                );
            })()}

            {/* 2. Call to Action Banner (Original Feature) */}
            {(homePageCms?.slider_bottom_title || homePageCms?.slider_bottom_link_title || homePageCms?.slider_bottom_link) && (
                <section className="bg-[#0056c6] text-white py-8 shadow-inner">
                    <div className={containerClass}>
                        <div className="flex flex-col md:flex-row items-center justify-between gap-6">
                            {homePageCms?.slider_bottom_title && (
                                <h3 className="text-xl sm:text-2xl font-bold tracking-tight text-center md:text-left">
                                    {homePageCms.slider_bottom_title}
                                </h3>
                            )}
                            {(homePageCms?.slider_bottom_link_title || homePageCms?.slider_bottom_link) && (
                                <a
                                    href={homePageCms.slider_bottom_link || '/contact'}
                                    className="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold px-6 py-3 rounded-xl shadow-lg transition-all duration-300 shrink-0 text-sm"
                                >
                                    <Send className="w-4 h-4 text-blue-400" />
                                    <span>{homePageCms.slider_bottom_link_title || 'Get In Touch'}</span>
                                </a>
                            )}
                        </div>
                    </div>
                </section>
            )}

            {/* 3. About Section with Trust/Expertise/Safety Tabs */}
            {aboutUs && (
                <section className="py-20 bg-white">
                    <div className={containerClass}>
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                            {/* Left Text Intro */}
                            <div className="space-y-6">
                                <span className="text-blue-600 font-bold text-xs uppercase tracking-widest bg-blue-50 px-3.5 py-1.5 rounded-md">
                                    About Our Company
                                </span>
                                <h2 className="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                    {aboutUs.title}
                                </h2>
                                <div
                                    className="text-slate-600 leading-relaxed text-sm sm:text-base prose prose-slate"
                                    dangerouslySetInnerHTML={{ __html: aboutUs.detail }}
                                />
                                {aboutUs.button_title && (
                                    <div className="pt-2">
                                        <a
                                            href={aboutUs.button_link || '/about-us'}
                                            className="inline-flex items-center gap-2 bg-slate-900 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 text-sm shadow-md"
                                        >
                                            <span>{aboutUs.button_title}</span>
                                            <ArrowRight className="w-4 h-4" />
                                        </a>
                                    </div>
                                )}
                            </div>

                            {/* Right Interactive Tabs */}
                            <div className="bg-slate-50 border border-slate-100 rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm">
                                {/* Tab Navigation */}
                                <div className="flex border-b border-slate-200 gap-2">
                                    <button
                                        onClick={() => setAboutTab('trust')}
                                        className={`pb-3 px-4 font-bold text-sm transition-all border-b-2 ${
                                            aboutTab === 'trust' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-900'
                                        }`}
                                    >
                                        Trust
                                    </button>
                                    <button
                                        onClick={() => setAboutTab('expertise')}
                                        className={`pb-3 px-4 font-bold text-sm transition-all border-b-2 ${
                                            aboutTab === 'expertise' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-900'
                                        }`}
                                    >
                                        Expertise
                                    </button>
                                    <button
                                        onClick={() => setAboutTab('safety')}
                                        className={`pb-3 px-4 font-bold text-sm transition-all border-b-2 ${
                                            aboutTab === 'safety' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-900'
                                        }`}
                                    >
                                        Safety
                                    </button>
                                </div>

                                {/* Tab Panels */}
                                {aboutTab === 'trust' && (
                                    <div className="space-y-4 animate-in fade-in duration-300">
                                        {aboutUs.trust_title_one && (
                                            <div className="flex items-start gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-xs">
                                                <Award className="w-6 h-6 text-blue-600 shrink-0 mt-1" />
                                                <div>
                                                    <h4 className="font-bold text-slate-900 text-base">{aboutUs.trust_title_one}</h4>
                                                    <p className="text-xs text-slate-500 mt-1 leading-relaxed">{aboutUs.trust_detail_one}</p>
                                                </div>
                                            </div>
                                        )}
                                        {aboutUs.trust_title_two && (
                                            <div className="flex items-start gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-xs">
                                                <Sliders className="w-6 h-6 text-blue-600 shrink-0 mt-1" />
                                                <div>
                                                    <h4 className="font-bold text-slate-900 text-base">{aboutUs.trust_title_two}</h4>
                                                    <p className="text-xs text-slate-500 mt-1 leading-relaxed">{aboutUs.trust_detail_two}</p>
                                                </div>
                                            </div>
                                        )}
                                        {aboutUs.trust_title_three && (
                                            <div className="flex items-start gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-xs">
                                                <ThumbsUp className="w-6 h-6 text-blue-600 shrink-0 mt-1" />
                                                <div>
                                                    <h4 className="font-bold text-slate-900 text-base">{aboutUs.trust_title_three}</h4>
                                                    <p className="text-xs text-slate-500 mt-1 leading-relaxed">{aboutUs.trust_detail_three}</p>
                                                </div>
                                            </div>
                                        )}
                                    </div>
                                )}

                                {aboutTab === 'expertise' && (
                                    <div className="space-y-4 animate-in fade-in duration-300">
                                        {aboutUs.expertise_detail && (
                                            <p className="text-xs text-slate-600 leading-relaxed italic bg-white p-3.5 rounded-xl border border-slate-100">
                                                {aboutUs.expertise_detail}
                                            </p>
                                        )}
                                        {aboutUs.expertise_title_one && (
                                            <div className="flex items-start gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-xs">
                                                <Users className="w-6 h-6 text-blue-600 shrink-0 mt-1" />
                                                <div>
                                                    <h4 className="font-bold text-slate-900 text-base">{aboutUs.expertise_title_one}</h4>
                                                    <p className="text-xs text-slate-500 mt-1 leading-relaxed">{aboutUs.expertise_detail_one}</p>
                                                </div>
                                            </div>
                                        )}
                                        {aboutUs.expertise_title_two && (
                                            <div className="flex items-start gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-xs">
                                                <Hourglass className="w-6 h-6 text-blue-600 shrink-0 mt-1" />
                                                <div>
                                                    <h4 className="font-bold text-slate-900 text-base">{aboutUs.expertise_title_two}</h4>
                                                    <p className="text-xs text-slate-500 mt-1 leading-relaxed">{aboutUs.expertise_detail_two}</p>
                                                </div>
                                            </div>
                                        )}
                                    </div>
                                )}

                                {aboutTab === 'safety' && (
                                    <div className="space-y-4 animate-in fade-in duration-300">
                                        {aboutUs.safety_image && (
                                            <img src={`/${aboutUs.safety_image}`} alt="Safety" className="rounded-2xl w-full h-44 object-cover shadow-sm" />
                                        )}
                                        {aboutUs.safety_detail && (
                                            <p className="text-xs text-slate-600 leading-relaxed bg-white p-4 rounded-xl border border-slate-100">
                                                {aboutUs.safety_detail}
                                            </p>
                                        )}
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </section>
            )}

            {/* 4. What We Do Section */}
            {whatWeDo && (
                <section className="py-20 bg-slate-900 text-white relative">
                    <div className={containerClass}>
                        <div className="text-center max-w-3xl mx-auto mb-16 space-y-4">
                            <span className="text-blue-400 font-bold text-xs uppercase tracking-widest bg-blue-500/10 border border-blue-500/20 px-3.5 py-1.5 rounded-full">
                                {whatWeDo.title || 'What We Do'}
                            </span>
                            <h2 className="text-3xl sm:text-4xl font-extrabold tracking-tight">
                                {whatWeDo.sub_title || 'Services & Business Excellence'}
                            </h2>
                        </div>

                        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                            {/* Column 1: First 3 services */}
                            <div className="space-y-6">
                                {firstHalfWorks.map((item, idx) => (
                                    <div key={idx} className="bg-slate-800/80 p-5 rounded-2xl border border-slate-700/80 hover:border-blue-500/50 transition-all flex items-start gap-4">
                                        {item.icon && (
                                            <img src={`/${item.icon}`} alt={item.title} className="w-10 h-10 object-contain shrink-0 mt-1" />
                                        )}
                                        <div>
                                            <h3 className="font-bold text-white text-base mb-1">{item.title}</h3>
                                            <p className="text-slate-400 text-xs leading-relaxed">{item.detail}</p>
                                        </div>
                                    </div>
                                ))}
                            </div>

                            {/* Center Image */}
                            {whatWeDo.image && (
                                <div className="text-center">
                                    <img
                                        src={`/${whatWeDo.image}`}
                                        alt="What We Do Center"
                                        className="rounded-3xl shadow-2xl mx-auto max-h-[420px] object-cover border-4 border-slate-800"
                                    />
                                </div>
                            )}

                            {/* Column 3: Remaining services */}
                            <div className="space-y-6">
                                {secondHalfWorks.map((item, idx) => (
                                    <div key={idx} className="bg-slate-800/80 p-5 rounded-2xl border border-slate-700/80 hover:border-blue-500/50 transition-all flex items-start gap-4">
                                        {item.icon && (
                                            <img src={`/${item.icon}`} alt={item.title} className="w-10 h-10 object-contain shrink-0 mt-1" />
                                        )}
                                        <div>
                                            <h3 className="font-bold text-white text-base mb-1">{item.title}</h3>
                                            <p className="text-slate-400 text-xs leading-relaxed">{item.detail}</p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
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
