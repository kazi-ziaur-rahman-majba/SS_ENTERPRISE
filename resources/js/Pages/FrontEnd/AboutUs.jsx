import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { CheckCircle, Award } from 'lucide-react';

export default function AboutUs({ pageCms, homePageCms, teams }) {
    const aboutImages = pageCms?.about_image ? (typeof pageCms.about_image === 'string' ? JSON.parse(pageCms.about_image) : pageCms.about_image) : [];
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.banner_title || 'About Us'} - SS Group`} />

            {/* Banner Section */}
            <section className="relative py-12 sm:py-24 overflow-hidden">
                {pageCms?.banner_image && (
                    <img
                        src={pageCms.banner_image.startsWith('/') ? pageCms.banner_image : `/${pageCms.banner_image}`}
                        alt="Banner"
                        loading="eager"
                        fetchPriority="high"
                        className="absolute inset-0 w-full h-full object-cover"
                    />
                )}
                <div className={`relative z-10 ${containerClass}`}>
                    <div className="max-w-3xl">
                        <nav className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-black mb-3">
                            <Link href="/" className="hover:underline text-black font-bold">Home</Link>
                            <span className="text-black font-bold">/</span>
                            <span className="text-white font-bold">{pageCms?.page_title || 'About Us'}</span>
                        </nav>
                        <h1 className="text-3xl sm:text-5xl font-bold text-white">
                            {pageCms?.banner_title || 'About Our Company'}
                        </h1>
                    </div>
                </div>
            </section>

            {/* Main Content Section */}
            <section className="py-20 sm:py-28 bg-white relative overflow-hidden">
                {/* Background subtle blur decorative elements */}
                <div className="absolute -top-24 -left-24 w-96 h-96 bg-blue-50/70 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute -bottom-24 -right-24 w-96 h-96 bg-slate-100/80 rounded-full blur-3xl pointer-events-none" />

                <div className={`relative z-10 ${containerClass}`}>
                    <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                        {/* Left Column: Content */}
                        <div className="lg:col-span-6 space-y-2">
                            <span className="text-blue-600 font-bold text-xs uppercase tracking-widest block mb-1">
                                WHO WE ARE
                            </span>

                            <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight leading-tight">
                                {pageCms?.about_title || 'Leading Business Consortium'}
                            </h2>

                            <div className="w-10 h-1 bg-blue-600 rounded-full mt-2.5 mb-5" />

                            <div
                                className="text-slate-600 leading-relaxed text-sm sm:text-base prose prose-slate max-w-none prose-p:leading-relaxed prose-strong:text-slate-900 pt-1"
                                dangerouslySetInnerHTML={{ __html: pageCms?.about_details || '' }}
                            />

                            {/* Feature Highlights */}
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                                <div className="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-50/80 border border-slate-100 shadow-2xs hover:border-blue-200 transition-colors">
                                    <div className="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shrink-0 shadow-md shadow-blue-500/20">
                                        <CheckCircle className="w-5 h-5" />
                                    </div>
                                    <div>
                                        <h4 className="font-bold text-slate-900 text-sm">Diversified Sectors</h4>
                                        <p className="text-slate-500 text-xs mt-0.5">Multi-industry Leader</p>
                                    </div>
                                </div>
                                <div className="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-50/80 border border-slate-100 shadow-2xs hover:border-blue-200 transition-colors">
                                    <div className="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shrink-0 shadow-md shadow-blue-500/20">
                                        <Award className="w-5 h-5" />
                                    </div>
                                    <div>
                                        <h4 className="font-bold text-slate-900 text-sm">Top-Notch Quality</h4>
                                        <p className="text-slate-500 text-xs mt-0.5">Reliable & Trusted</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Right Column: Image Showcase Grid */}
                        <div className="lg:col-span-6 relative">
                            {aboutImages && aboutImages.length > 0 ? (
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-6 relative">
                                    {aboutImages.map((imgItem, idx) => (
                                        <div
                                            key={idx}
                                            className="group relative rounded-3xl overflow-hidden shadow-md hover:shadow-xl border border-slate-100 bg-slate-900 h-64 sm:h-72 transition-all duration-300"
                                        >
                                            <img
                                                src={imgItem.image?.startsWith('/') ? imgItem.image : `/${imgItem.image}`}
                                                alt={imgItem.title || 'About image'}
                                                loading="lazy"
                                                decoding="async"
                                                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100"
                                            />
                                            {imgItem.title && (
                                                <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent p-5 flex items-end">
                                                    <h3 className="text-white font-bold text-base sm:text-lg">
                                                        {imgItem.title}
                                                    </h3>
                                                </div>
                                            )}
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="relative rounded-3xl overflow-hidden shadow-xl border border-slate-100 bg-slate-900 h-80">
                                    <img
                                        src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200&auto=format&fit=crop"
                                        alt="SS Group Corporate"
                                        className="w-full h-full object-cover"
                                    />
                                    <div className="absolute inset-0 bg-gradient-to-t from-slate-950/70 to-transparent p-6 flex items-end">
                                        <h3 className="text-white font-bold text-xl">Corporate Excellence & Innovation</h3>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </section>

            {/* Teams Section */}
            {teams && teams.length > 0 && (
                <section className="py-20 sm:py-24 bg-gradient-to-b from-slate-50 via-white to-slate-50 border-t border-slate-100">
                    <div className={containerClass}>
                        <div className="text-center max-w-2xl mx-auto mb-12">
                            <span className="text-blue-600 font-bold text-xs uppercase tracking-widest block mb-1">
                                DEDICATED LEADERS
                            </span>
                            <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                                Our Executive Team
                            </h2>
                            <div className="w-10 h-1 bg-blue-600 mx-auto rounded-full mt-2.5" />
                        </div>

                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                            {teams.map((member) => (
                                <div
                                    key={member.id}
                                    className="group relative bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 hover:-translate-y-2 flex flex-col"
                                >
                                    {/* Image Container */}
                                    <div className="relative h-72 sm:h-80 w-full overflow-hidden bg-slate-100">
                                        <img
                                            src={member.image?.startsWith('/') ? member.image : `/${member.image}`}
                                            alt={member.name}
                                            loading="lazy"
                                            decoding="async"
                                            className="w-full h-full object-cover object-top group-hover:scale-108 transition-transform duration-700 ease-out"
                                        />
                                        {/* Soft hover gradient */}
                                        <div className="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                                        
                                        {/* Floating Badge */}
                                        {member.destination && (
                                            <div className="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full border border-white/60 text-[11px] font-bold text-slate-700 shadow-sm">
                                                {member.destination}
                                            </div>
                                        )}
                                    </div>

                                    {/* Card Content */}
                                    <div className="p-6 text-center flex-grow flex flex-col justify-between bg-white relative z-10 border-t border-slate-100">
                                        <div>
                                            <h3 className="font-bold text-slate-900 text-lg sm:text-xl tracking-tight group-hover:text-blue-600 transition-colors">
                                                {member.name}
                                            </h3>
                                            <p className="text-blue-600 text-xs font-bold uppercase tracking-widest mt-1.5">
                                                {member.destination || 'Executive'}
                                            </p>
                                        </div>

                                        {/* Bottom subtle expanding accent line */}
                                        <div className="w-10 h-0.5 bg-blue-500/20 group-hover:w-16 group-hover:bg-blue-600 mx-auto mt-4 transition-all duration-300 rounded-full" />
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
