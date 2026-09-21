import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';

const parseJsonData = (data) => {
    if (!data) return [];
    if (Array.isArray(data)) return data;
    if (typeof data === 'string') {
        try {  
            return JSON.parse(data);
        } catch (e) {
            return [];
        }
    }
    return [];
};

export default function Achievement({ membershipCertificate }) {
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    const bannerTitle = membershipCertificate?.banner_title || 'Certification';
    const pageTitle = membershipCertificate?.page_title || 'Certification';
    const memberTitle = membershipCertificate?.member_title || 'Our Businesses';
    const certificatesTitle = membershipCertificate?.certificates_title || 'ISO certificate';

    const memberImages = parseJsonData(membershipCertificate?.member_image);
    const rawCertifications = parseJsonData(membershipCertificate?.certificates_image);

    // Normalize certifications items to array of { image, title }
    const certifications = rawCertifications.map((item) => {
        if (typeof item === 'string') {
            return { image: item, title: '' };
        }
        return {
            image: item?.image || '',
            title: item?.title || '',
        };
    });

    const getImageUrl = (path) => {
        if (!path) return '';
        return path.startsWith('/') ? path : `/${path}`;
    };

    return (
        <FrontEndLayout>
            <Head title={`${bannerTitle} - SS Group`} />

            {/* Banner Section */}
            <section className="relative py-8 sm:py-24 overflow-hidden">
                {membershipCertificate?.banner_image && (
                    <img
                        src={getImageUrl(membershipCertificate.banner_image)}
                        alt="Banner Background"
                        className="absolute inset-0 w-full h-full object-cover"
                    />
                )}

                <div className={`relative z-10 ${containerClass}`}>
                    <div className="max-w-3xl">
                        <nav className="flex items-center gap-2 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-black mb-2 sm:mb-3">
                            <Link href="/" className="hover:underline text-black font-bold">Home</Link>
                            <span className="text-black font-bold">/</span>
                            <span className="text-white font-bold">{pageTitle}</span>
                        </nav>
                        <h1 className="text-2xl sm:text-5xl font-bold text-white tracking-tight">
                            {bannerTitle}
                        </h1>
                    </div>
                </div>
            </section>

            {/* Section 1: Member / Business Logos (Pure White Background) */}
            <section className="bg-white py-8 sm:py-20 border-b border-slate-100">
                <div className={containerClass}>
                    <div className="text-center mb-6 sm:mb-10">
                        <h2 className="text-xl sm:text-3xl font-bold text-slate-800 tracking-tight">
                            {memberTitle}
                        </h2>
                        <div className="w-12 h-1 bg-blue-500 mx-auto rounded-full mt-2" />
                    </div>

                    {memberImages && memberImages.length > 0 ? (
                        <div className="grid grid-cols-2 sm:flex sm:flex-wrap lg:flex lg:flex-row lg:flex-nowrap items-center justify-center gap-3.5 sm:gap-6 lg:gap-8 max-w-4xl mx-auto">
                            {memberImages.map((imgSrc, idx) => (
                                <div
                                    key={idx}
                                    className={`bg-white p-3.5 sm:p-5 rounded-xl sm:rounded-2xl border border-slate-100 shadow-2xs hover:shadow-md transition-all duration-300 flex items-center justify-center w-full sm:w-60 lg:w-64 h-24 sm:h-32 ${
                                        memberImages.length % 2 !== 0 && idx === memberImages.length - 1
                                            ? 'col-span-2 sm:col-span-1 max-w-[220px] sm:max-w-none lg:max-w-none mx-auto lg:mx-0'
                                            : ''
                                    }`}
                                >
                                    <img
                                        src={getImageUrl(imgSrc)}
                                        alt={`Member logo ${idx + 1}`}
                                        className="max-h-full max-w-full object-contain"
                                    />
                                </div>
                            ))}
                        </div>
                    ) : (
                        <p className="text-center text-slate-400 text-sm">No member logos configured.</p>
                    )}
                </div>
            </section>

            {/* Section 2: Certifications (Soft Light Blue Gradient Background) */}
            <section className="relative bg-gradient-to-b from-sky-50/80 via-blue-50/40 to-sky-100/70 py-8 sm:py-20 overflow-hidden">
                {/* Decorative background glow spots */}
                <div className="absolute top-1/4 -left-32 w-96 h-96 bg-blue-200/40 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute bottom-10 -right-32 w-96 h-96 bg-sky-200/50 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-blue-100/30 rounded-full blur-[120px] pointer-events-none" />

                <div className={`relative z-10 ${containerClass}`}>
                    <div className="text-center mb-6 sm:mb-10">
                        <h2 className="text-xl sm:text-3xl font-bold text-slate-800 tracking-tight">
                            {certificatesTitle}
                        </h2>
                        <div className="w-12 h-1 bg-blue-500 mx-auto rounded-full mt-2" />
                    </div>

                    {certifications && certifications.length > 0 ? (
                        <div className="grid grid-cols-2 sm:flex sm:flex-wrap items-center justify-center gap-3.5 sm:gap-10">
                            {certifications.map((item, idx) => (
                                <div key={idx} className="flex flex-col items-center w-full sm:w-auto">
                                    <div className="bg-white p-3 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-200/90 shadow-2xs flex items-center justify-center w-full sm:w-52 h-36 sm:h-52 mb-2 hover:shadow-md transition-shadow">
                                        <img
                                            src={getImageUrl(item.image)}
                                            alt={item.title || `Certificate ${idx + 1}`}
                                            className="max-h-full max-w-full object-contain"
                                        />
                                    </div>
                                    {item.title && (
                                        <span className="text-slate-700 font-semibold text-xs sm:text-base text-center max-w-xs mt-0.5 line-clamp-2">
                                            {item.title}
                                        </span>
                                    )}
                                </div>
                            ))}
                        </div>
                    ) : (
                        <p className="text-center text-slate-400 text-sm">No certificate data configured.</p>
                    )}
                </div>
            </section>
        </FrontEndLayout>
    );
}
