import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { ChevronRight, CheckCircle2 } from 'lucide-react';

export default function ServiceDetails({ pageCms, service, serviceCategory, slug }) {
    const whyDetail = service?.why_qligence_detail ? (typeof service.why_qligence_detail === 'string' ? JSON.parse(service.why_qligence_detail) : service.why_qligence_detail) : [];
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${service?.title || service?.category_name || 'Business Detail'} - SS Group`} />

            {/* Banner */}
            <section className="relative bg-slate-900 text-white py-24 overflow-hidden">
                {pageCms?.detail_page_banner_image && (
                    <img
                        src={`/${pageCms.detail_page_banner_image}`}
                        alt="Banner"
                        className="absolute inset-0 w-full h-full object-cover opacity-25"
                    />
                )}
                <div className={`relative z-10 ${containerClass}`}>
                    <nav className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-orange-400 mb-3">
                        <Link href="/" className="hover:underline">Home</Link>
                        <span>/</span>
                        <Link href="/business" className="hover:underline">Our Businesses</Link>
                        <span>/</span>
                        <span className="text-slate-300">{service?.category_name}</span>
                    </nav>
                    <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight">
                        {service?.category_name || pageCms?.detail_page_title || 'Business Detail'}
                    </h1>
                </div>
            </section>

            {/* Content & Sidebar */}
            <section className="py-20 bg-slate-50">
                <div className={containerClass}>
                    <div className="grid grid-cols-1 lg:grid-cols-4 gap-10">
                        {/* Sidebar Categories Navigation */}
                        <aside className="lg:col-span-1 space-y-4">
                            <div className="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 sticky top-28">
                                <h3 className="font-bold text-slate-900 text-sm uppercase tracking-wider px-3 py-2 border-b border-slate-100 mb-2">
                                    All Businesses
                                </h3>
                                <div className="space-y-1">
                                    {serviceCategory && serviceCategory.map((cat, idx) => (
                                        <Link
                                            key={idx}
                                            href={`/service/${cat.slug}`}
                                            className={`flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all ${
                                                cat.slug === slug
                                                    ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20'
                                                    : 'text-slate-700 hover:bg-slate-50 hover:text-orange-600'
                                            }`}
                                        >
                                            <span className="line-clamp-1">{cat.name}</span>
                                            <ChevronRight className="w-4 h-4 shrink-0 opacity-60" />
                                        </Link>
                                    ))}
                                </div>
                            </div>
                        </aside>

                        {/* Main Detail Area */}
                        <main className="lg:col-span-3 space-y-8">
                            {service ? (
                                <div className="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 space-y-8">
                                    <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight border-l-4 border-orange-500 pl-4">
                                        {service.title}
                                    </h2>

                                    <div
                                        className="text-slate-600 leading-relaxed text-base sm:text-lg prose prose-slate max-w-none prose-img:rounded-2xl"
                                        dangerouslySetInnerHTML={{ __html: service.detail }}
                                    />

                                    {/* Why Qligence / Key Highlights if present */}
                                    {whyDetail && whyDetail.length > 0 && (
                                        <div className="pt-8 border-t border-slate-100 space-y-6">
                                            <h3 className="text-xl font-bold text-slate-900">Key Highlights</h3>
                                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                {whyDetail.map((item, idx) => (
                                                    <div key={idx} className="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-2">
                                                        <div className="flex items-center gap-2 text-orange-600 font-bold text-sm">
                                                            <CheckCircle2 className="w-4 h-4 shrink-0" />
                                                            <h4>{item.question}</h4>
                                                        </div>
                                                        <p className="text-slate-600 text-xs sm:text-sm leading-relaxed pl-6">{item.answer}</p>
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
