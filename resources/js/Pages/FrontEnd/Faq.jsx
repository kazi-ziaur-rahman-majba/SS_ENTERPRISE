import React, { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { ChevronDown, HelpCircle, ArrowRight } from 'lucide-react';

export default function Faq({ pageCms, blogs }) {
    const [openIdx, setOpenIdx] = useState(null);

    const toggleFaq = (idx) => {
        setOpenIdx(openIdx === idx ? null : idx);
    };

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.banner_title || 'FAQ'} - SS Group`} />

            {/* Banner */}
            <section className="relative text-white py-12 sm:py-24 overflow-hidden">
                {pageCms?.banner_image && (
                    <img
                        src={pageCms.banner_image.startsWith('/') ? pageCms.banner_image : `/${pageCms.banner_image}`}
                        alt="Banner"
                        className="absolute inset-0 w-full h-full object-cover"
                    />
                )}
                <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-blue-400 mb-3">
                        <Link href="/" className="hover:underline">Home</Link>
                        <span>/</span>
                        <span className="text-slate-300">FAQ</span>
                    </nav>
                    <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight">
                        {pageCms?.banner_title || 'Frequently Asked Questions'}
                    </h1>
                </div>
            </section>

            {/* Content */}
            <section className="py-20 bg-slate-50">
                <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                    <div className="bg-white rounded-3xl p-8 sm:p-12 border border-slate-100 shadow-sm space-y-6">
                        <div className="flex items-center gap-3 text-blue-600 font-bold text-sm">
                            <HelpCircle className="w-5 h-5" />
                            <span>Help & Support</span>
                        </div>
                        <h2 className="text-2xl sm:text-3xl font-extrabold text-slate-900">
                            {pageCms?.faq_title || 'General Questions'}
                        </h2>

                        <div className="text-slate-600 leading-relaxed text-sm sm:text-base prose prose-slate max-w-none" dangerouslySetInnerHTML={{ __html: pageCms?.faq_details || '' }} />
                    </div>

                    {/* Latest Blogs / News */}
                    {blogs && blogs.length > 0 && (
                        <div className="space-y-6">
                            <h3 className="text-2xl font-bold text-slate-900">Related Articles</h3>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {blogs.map((b) => (
                                    <div key={b.id} className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all">
                                        <h4 className="font-bold text-slate-900 text-lg mb-2">
                                            <Link href={`/blog/${b.slug}`} className="hover:text-blue-600 transition-colors">{b.title}</Link>
                                        </h4>
                                        <p className="text-slate-500 text-xs line-clamp-2">{b.short_details}</p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    )}
                </div>
            </section>
        </FrontEndLayout>
    );
}
