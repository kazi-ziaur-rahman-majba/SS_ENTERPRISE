import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { ChevronRight } from 'lucide-react';

export default function ServiceDetails({ pageCms, service, serviceCategory, slug }) {
    const parseJson = (val) => {
        if (!val) return [];
        if (Array.isArray(val)) return val;
        if (typeof val === 'string') {
            try {
                return JSON.parse(val);
            } catch (e) {
                return [];
            }
        }
        return [];
    };

    const serviceImages = parseJson(service?.image);

    const cleanText = (text) => {
        if (!text || typeof text !== 'string') return text || '';
        return text
            .replace(/â€™/g, "'")
            .replace(/â€“/g, "–")
            .replace(/â€”/g, "—")
            .replace(/â€œ/g, '"')
            .replace(/â€/g, '"')
            .replace(/â€Action/g, "");
    };

    const matchedCategory = serviceCategory?.find((cat) => cat.slug === slug);

    const getImageUrl = (path) => {
        if (!path) return '';
        return path.startsWith('/') ? path : `/${path}`;
    };

    const mainHeaderImage = matchedCategory?.image
        ? getImageUrl(matchedCategory.image)
        : (serviceImages[0]?.image ? getImageUrl(serviceImages[0].image) : null);

    const displayTitle = matchedCategory?.name || service?.category_name || service?.title || 'Business Detail';

    const displayDescription = matchedCategory?.short_description || service?.detail || 'Detailed information for this business is coming soon.';

    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${cleanText(displayTitle)} - SS Group`} />

            {/* Top Page Banner */}
            <section className="relative py-8 sm:py-16 lg:py-24 overflow-hidden">
                {pageCms?.detail_page_banner_image && (
                    <img
                        src={getImageUrl(pageCms.detail_page_banner_image)}
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
                            <span className="text-white font-bold">{cleanText(displayTitle)}</span>
                        </nav>
                        <h1 className="text-2xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight">
                            {cleanText(displayTitle)}
                        </h1>
                    </div>
                </div>
            </section>

            {/* Main Content & Sidebar Layout */}
            <section className="py-6 sm:py-12 lg:py-16 bg-slate-50">
                <div className={containerClass}>
                    <div className="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8 items-start">
                        {/* Sidebar: All Businesses Navigation (Left Side) */}
                        <aside className="lg:col-span-1 space-y-2">
                            <div className="bg-white rounded-lg border border-slate-200/90 shadow-2xs overflow-hidden">
                                {serviceCategory && serviceCategory.map((cat, idx) => {
                                    const isActive = cat.slug === slug;
                                    return (
                                        <Link
                                            key={idx}
                                            href={`/service/${cat.slug}`}
                                            className={`flex items-center gap-2.5 px-4 py-3.5 text-xs sm:text-sm font-semibold transition-all border-b border-slate-100 last:border-0 ${
                                                isActive
                                                    ? 'bg-[#0066ff] text-white shadow-xs'
                                                    : 'bg-[#f8fafc] text-slate-700 hover:bg-slate-100 hover:text-[#0066ff]'
                                            }`}
                                        >
                                            <ChevronRight className={`w-4 h-4 shrink-0 ${isActive ? 'text-white' : 'text-slate-500'}`} />
                                            <span className="line-clamp-1">{cat.name}</span>
                                        </Link>
                                    );
                                })}
                            </div>
                        </aside>

                        {/* Main Content Area (Right Side) */}
                        <main className="lg:col-span-3">
                            <div className="bg-white rounded-xl border border-slate-200/90 shadow-2xs overflow-hidden">
                                {/* 1. Main Header Image at Top */}
                                {mainHeaderImage && (
                                    <div className="w-full h-60 sm:h-80 lg:h-[420px] bg-slate-100 overflow-hidden">
                                        <img
                                            src={mainHeaderImage}
                                            alt={cleanText(displayTitle)}
                                            className="w-full h-full object-cover"
                                        />
                                    </div>
                                )}

                                {/* 2. Title & Description Content (Only Title & Short Description / Details) */}
                                <div className="p-6 sm:p-8 lg:p-10 space-y-6">
                                    {/* Main Title with Blue Line */}
                                    <div>
                                        <h2 className="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight">
                                            {cleanText(displayTitle)}
                                        </h2>
                                        <div className="w-10 h-1 bg-[#0066ff] rounded-full mt-3" />
                                    </div>

                                    {/* Description / Detail text */}
                                    <div
                                        className="text-slate-600 leading-relaxed text-sm sm:text-base prose prose-slate max-w-none prose-p:leading-relaxed prose-img:rounded-xl"
                                        dangerouslySetInnerHTML={{ __html: cleanText(displayDescription) }}
                                    />
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
