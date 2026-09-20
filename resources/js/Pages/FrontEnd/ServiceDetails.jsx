import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { ChevronRight, CheckCircle2 } from 'lucide-react';

export default function ServiceDetails({ pageCms, service, serviceCategory, slug }) {
    const whyDetail = service?.why_qligence_detail
        ? (typeof service.why_qligence_detail === 'string'
            ? JSON.parse(service.why_qligence_detail)
            : service.why_qligence_detail)
        : [];

    const cleanText = (text) => {
        if (!text || typeof text !== 'string') return text;
        return text
            .replace(/â€™/g, "'")
            .replace(/â€“/g, "–")
            .replace(/â€”/g, "—")
            .replace(/â€œ/g, '"')
            .replace(/â€/g, '"')
            .replace(/â€Action/g, "");
    };

    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${cleanText(service?.title || service?.category_name || 'Business Detail')} - SS Group`} />

            {/* Banner */}
            <section className="relative py-8 sm:py-16 lg:py-24 overflow-hidden">
                {pageCms?.detail_page_banner_image && (
                    <img
                        src={pageCms.detail_page_banner_image.startsWith('/') ? pageCms.detail_page_banner_image : `/${pageCms.detail_page_banner_image}`}
                        alt="Banner"
                        loading="eager"
                        fetchPriority="high"
                        className="absolute inset-0 w-full h-full object-cover"
                    />
                )}
                <div className={`relative z-10 ${containerClass}`}>
                    <div className="max-w-3xl">
                        <nav className="flex flex-wrap items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-black mb-2 sm:mb-3">
                            <Link href="/" className="hover:underline text-black font-bold">Home</Link>
                            <span className="text-black font-bold">/</span>
                            <Link href="/business" className="hover:underline text-black font-bold">Our Businesses</Link>
                            <span className="text-black font-bold">/</span>
                            <span className="text-white font-bold">{cleanText(service?.category_name)}</span>
                        </nav>
                        <h1 className="text-2xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight">
                            {cleanText(service?.category_name || pageCms?.detail_page_title || 'Business Detail')}
                        </h1>
                    </div>
                </div>
            </section>

            {/* Content & Sidebar */}
            <section className="py-6 sm:py-12 lg:py-20 bg-slate-50">
                <div className={containerClass}>
                    <div className="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-10">
                        {/* Sidebar Categories Navigation */}
                        <aside className="lg:col-span-1 space-y-4">
                            <div className="bg-white rounded-2xl p-3.5 sm:p-4 shadow-sm border border-slate-100 lg:sticky lg:top-28">
                                <h3 className="font-bold text-slate-900 text-xs sm:text-sm uppercase tracking-wider px-2 lg:px-3 py-1.5 lg:py-2 border-b border-slate-100 mb-2.5 lg:mb-2">
                                    All Businesses
                                </h3>
                                <div className="flex lg:flex-col overflow-x-auto gap-2 lg:gap-0 lg:space-y-1 pb-1 lg:pb-0 scrollbar-none">
                                    {serviceCategory && serviceCategory.map((cat, idx) => (
                                        <Link
                                            key={idx}
                                            href={`/service/${cat.slug}`}
                                            className={`flex items-center justify-between px-3.5 py-2 lg:py-2.5 rounded-xl text-xs sm:text-sm font-medium transition-all shrink-0 lg:shrink ${
                                                cat.slug === slug
                                                    ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20 font-semibold'
                                                    : 'bg-slate-100 lg:bg-transparent text-slate-700 hover:bg-slate-200 lg:hover:bg-slate-50 hover:text-blue-600'
                                            }`}
                                        >
                                            <span className="whitespace-nowrap lg:whitespace-normal lg:line-clamp-1">{cat.name}</span>
                                            <ChevronRight className="w-4 h-4 shrink-0 opacity-60 hidden lg:block ml-2" />
                                        </Link>
                                    ))}
                                </div>
                            </div>
                        </aside>

                        {/* Main Detail Area */}
                        <main className="lg:col-span-3 space-y-8">
                            {service ? (
                                <div className="bg-white rounded-2xl lg:rounded-3xl p-5 sm:p-8 lg:p-12 shadow-sm border border-slate-100 space-y-6 lg:space-y-8">
                                    <h2 className="text-xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight border-l-4 border-blue-600 pl-3 sm:pl-4">
                                        {cleanText(service.title)}
                                    </h2>

                                    <div
                                        className="text-slate-600 leading-relaxed text-sm sm:text-base lg:text-lg prose prose-slate max-w-none prose-img:rounded-2xl prose-p:leading-relaxed"
                                        dangerouslySetInnerHTML={{ __html: cleanText(service.detail) }}
                                    />

                                    {/* Why Qligence / Key Highlights if present */}
                                    {whyDetail && whyDetail.length > 0 && (
                                        <div className="pt-6 lg:pt-8 border-t border-slate-100 space-y-4 lg:space-y-6">
                                            <h3 className="text-lg lg:text-xl font-bold text-slate-900">Key Highlights</h3>
                                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
                                                {whyDetail.map((item, idx) => (
                                                    <div key={idx} className="bg-slate-50 p-4 sm:p-6 rounded-2xl border border-slate-100 space-y-2">
                                                        <div className="flex items-start gap-2.5 text-blue-600 font-bold text-xs sm:text-sm">
                                                            <CheckCircle2 className="w-4 h-4 shrink-0 mt-0.5" />
                                                            <h4>{cleanText(item.question)}</h4>
                                                        </div>
                                                        <p className="text-slate-600 text-xs sm:text-sm leading-relaxed pl-6.5">{cleanText(item.answer)}</p>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    )}
                                </div>
                            ) : (
                                <div className="bg-white rounded-3xl p-12 text-center text-slate-500">
                                    Service details unavailable.
                                </div>
                            )}
                        </main>
                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
