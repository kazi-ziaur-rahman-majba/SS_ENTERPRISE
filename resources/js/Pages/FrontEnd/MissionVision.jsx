import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { Target, Eye, Compass } from 'lucide-react';

export default function MissionVision({ pageCms }) {
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.banner_title || 'Mission & Vision'} - SS Group`} />

            {/* Banner */}
            <section className="relative bg-slate-900 text-white py-24 overflow-hidden">
                {pageCms?.banner_image && (
                    <img
                        src={`/${pageCms.banner_image}`}
                        alt="Banner"
                        className="absolute inset-0 w-full h-full object-cover opacity-25"
                    />
                )}
                <div className={`relative z-10 ${containerClass}`}>
                    <nav className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-blue-400 mb-3">
                        <Link href="/" className="hover:underline">Home</Link>
                        <span>/</span>
                        <span className="text-slate-300">{pageCms?.page_title || 'Mission & Vision'}</span>
                    </nav>
                    <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight">
                        {pageCms?.banner_title || 'Mission, Vision & Core Values'}
                    </h1>
                </div>
            </section>

            {/* Content Cards */}
            <section className="py-20 bg-slate-50">
                <div className={`${containerClass} space-y-12`}>
                    {/* Mission Card */}
                    {pageCms?.mission_title && (
                        <div className="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all">
                            <div className="flex items-center gap-4 mb-6">
                                <div className="w-14 h-14 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center shrink-0">
                                    <Target className="w-7 h-7" />
                                </div>
                                <h2 className="text-2xl sm:text-3xl font-extrabold text-slate-900">
                                    {pageCms.mission_title}
                                </h2>
                            </div>
                            <div
                                className="text-slate-600 leading-relaxed text-base sm:text-lg prose prose-slate max-w-none"
                                dangerouslySetInnerHTML={{ __html: pageCms.mission_details }}
                            />
                        </div>
                    )}

                    {/* Vision Card */}
                    {pageCms?.vision_title && (
                        <div className="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all">
                            <div className="flex items-center gap-4 mb-6">
                                <div className="w-14 h-14 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center shrink-0">
                                    <Eye className="w-7 h-7" />
                                </div>
                                <h2 className="text-2xl sm:text-3xl font-extrabold text-slate-900">
                                    {pageCms.vision_title}
                                </h2>
                            </div>
                            <div
                                className="text-slate-600 leading-relaxed text-base sm:text-lg prose prose-slate max-w-none"
                                dangerouslySetInnerHTML={{ __html: pageCms.vision_details }}
                            />
                        </div>
                    )}

                    {/* Core Values Card */}
                    {pageCms?.core_values_title && (
                        <div className="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all">
                            <div className="flex items-center gap-4 mb-6">
                                <div className="w-14 h-14 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center shrink-0">
                                    <Compass className="w-7 h-7" />
                                </div>
                                <h2 className="text-2xl sm:text-3xl font-extrabold text-slate-900">
                                    {pageCms.core_values_title}
                                </h2>
                            </div>
                            <div
                                className="text-slate-600 leading-relaxed text-base sm:text-lg prose prose-slate max-w-none"
                                dangerouslySetInnerHTML={{ __html: pageCms.core_values_details }}
                            />
                        </div>
                    )}
                </div>
            </section>
        </FrontEndLayout>
    );
}
