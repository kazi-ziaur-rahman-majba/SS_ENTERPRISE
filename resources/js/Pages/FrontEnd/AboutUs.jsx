import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';

export default function AboutUs({ pageCms, homePageCms, teams }) {
    const aboutImages = pageCms?.about_image ? (typeof pageCms.about_image === 'string' ? JSON.parse(pageCms.about_image) : pageCms.about_image) : [];
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.banner_title || 'About Us'} - SS Group`} />

            {/* Banner Section */}
            <section className="relative bg-slate-900 text-white py-24 overflow-hidden">
                {pageCms?.banner_image && (
                    <img
                        src={`/${pageCms.banner_image}`}
                        alt="Banner"
                        className="absolute inset-0 w-full h-full object-cover opacity-25"
                    />
                )}
                <div className={`relative z-10 ${containerClass}`}>
                    <div className="max-w-3xl">
                        <nav className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-orange-400 mb-3">
                            <Link href="/" className="hover:underline">Home</Link>
                            <span>/</span>
                            <span className="text-slate-300">{pageCms?.page_title || 'About Us'}</span>
                        </nav>
                        <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight">
                            {pageCms?.banner_title || 'About Our Company'}
                        </h1>
                    </div>
                </div>
            </section>

            {/* Main Content Section */}
            <section className="py-20 bg-white">
                <div className={containerClass}>
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div className="space-y-6">
                            <span className="text-orange-600 font-bold text-xs uppercase tracking-widest bg-orange-50 px-3.5 py-1.5 rounded-md">
                                Who We Are
                            </span>
                            <h2 className="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                {pageCms?.about_title || 'Leading Business Consortium'}
                            </h2>
                            <div
                                className="text-slate-600 leading-relaxed text-sm sm:text-base prose prose-slate"
                                dangerouslySetInnerHTML={{ __html: pageCms?.about_details || '' }}
                            />
                        </div>

                        {/* Image Showcase */}
                        {aboutImages && aboutImages.length > 0 && (
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                {aboutImages.map((imgItem, idx) => (
                                    <div key={idx} className="group relative rounded-2xl overflow-hidden shadow-lg border border-slate-100 bg-slate-900 h-64">
                                        <img
                                            src={`/${imgItem.image}`}
                                            alt={imgItem.title || 'About image'}
                                            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100"
                                        />
                                        {imgItem.title && (
                                            <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent p-4 flex items-end">
                                                <h3 className="text-white font-bold text-sm">{imgItem.title}</h3>
                                            </div>
                                        )}
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>
                </div>
            </section>

            {/* Teams Section */}
            {teams && teams.length > 0 && (
                <section className="py-20 bg-slate-50 border-t border-slate-100">
                    <div className={containerClass}>
                        <div className="text-center max-w-2xl mx-auto mb-12">
                            <span className="text-orange-600 font-bold text-xs uppercase tracking-widest bg-orange-100 px-3 py-1.5 rounded-full">
                                Dedicated Leaders
                            </span>
                            <h2 className="text-3xl font-extrabold text-slate-900 mt-3">Our Executive Team</h2>
                        </div>
                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                            {teams.map((member) => (
                                <div key={member.id} className="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 group hover:shadow-xl transition-all">
                                    <div className="h-64 bg-slate-100 overflow-hidden">
                                        <img src={`/${member.image}`} alt={member.name} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                    </div>
                                    <div className="p-5 text-center">
                                        <h3 className="font-bold text-slate-900 text-lg">{member.name}</h3>
                                        <p className="text-orange-600 text-xs font-semibold uppercase tracking-wider mt-1">{member.destination}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </FrontEndLayout>
    );
}
