import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { ChevronRight } from 'lucide-react';

export default function Services({ pageCms, serviceCategory }) {
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.banner_title || 'Our Businesses'} - SS Group`} />

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
                        <span className="text-slate-300">{pageCms?.page_title || 'Businesses'}</span>
                    </nav>
                    <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight">
                        {pageCms?.banner_title || 'Our Businesses & Services'}
                    </h1>
                </div>
            </section>

            {/* Services Grid */}
            <section className="py-20 bg-slate-50">
                <div className={containerClass}>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {serviceCategory && serviceCategory.map((service, idx) => (
                            <div
                                key={service.id || idx}
                                className="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300 flex flex-col group"
                            >
                                <div className="relative h-56 bg-slate-100 overflow-hidden">
                                    {service.image && (
                                        <img
                                            src={`/${service.image}`}
                                            alt={service.name}
                                            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        />
                                    )}
                                    {service.icon && (
                                        <div className="absolute bottom-4 left-4 bg-white p-3 rounded-xl shadow-md">
                                            <img src={`/${service.icon}`} alt={service.name} className="w-8 h-8 object-contain" />
                                        </div>
                                    )}
                                </div>
                                <div className="p-6 flex flex-col flex-grow">
                                    <h3 className="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors mb-3">
                                        <Link href={`/service/${service.slug}`}>{service.name}</Link>
                                    </h3>
                                    <p className="text-slate-500 text-sm leading-relaxed mb-6 flex-grow">
                                        {service.short_description}
                                    </p>
                                    <Link
                                        href={`/service/${service.slug}`}
                                        className="inline-flex items-center gap-1.5 font-bold text-xs uppercase tracking-wider text-blue-600 hover:text-blue-700 mt-auto"
                                    >
                                        <span>Learn More</span>
                                        <ChevronRight className="w-4 h-4" />
                                    </Link>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
