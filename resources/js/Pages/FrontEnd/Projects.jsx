import React, { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { Image as ImageIcon, ChevronRight } from 'lucide-react';

export default function Projects({ pageCms, galleryCategory, gallery }) {
    const [selectedCategory, setSelectedCategory] = useState('all');
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    const filteredGallery = selectedCategory === 'all'
        ? gallery
        : gallery?.filter((item) => String(item.category_id) === String(selectedCategory));

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.banner_title || 'Projects'} - SS Group`} />

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
                    <nav className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-orange-400 mb-3">
                        <Link href="/" className="hover:underline">Home</Link>
                        <span>/</span>
                        <span className="text-slate-300">{pageCms?.page_title || 'Projects'}</span>
                    </nav>
                    <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight">
                        {pageCms?.banner_title || 'Our Projects & Portfolio'}
                    </h1>
                </div>
            </section>

            {/* Main Content */}
            <section className="py-20 bg-slate-50">
                <div className={containerClass}>
                    <div className="grid grid-cols-1 lg:grid-cols-4 gap-10">
                        {/* Categories Sidebar */}
                        <aside className="lg:col-span-1">
                            <div className="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 sticky top-28 space-y-2">
                                <h3 className="font-bold text-slate-900 text-sm uppercase tracking-wider px-3 py-2 border-b border-slate-100">
                                    Project Categories
                                </h3>
                                <button
                                    onClick={() => setSelectedCategory('all')}
                                    className={`w-full text-left px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all ${
                                        selectedCategory === 'all'
                                            ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20'
                                            : 'text-slate-700 hover:bg-slate-50 hover:text-orange-600'
                                    }`}
                                >
                                    All Projects
                                </button>
                                {galleryCategory && galleryCategory.map((cat) => (
                                    <button
                                        key={cat.id}
                                        onClick={() => setSelectedCategory(String(cat.id))}
                                        className={`w-full text-left flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all ${
                                            String(selectedCategory) === String(cat.id)
                                                ? 'bg-orange-500 text-white shadow-md shadow-orange-500/20'
                                                : 'text-slate-700 hover:bg-slate-50 hover:text-orange-600'
                                        }`}
                                    >
                                        <span>{cat.name}</span>
                                        <ChevronRight className="w-4 h-4 opacity-60" />
                                    </button>
                                ))}
                            </div>
                        </aside>

                        {/* Projects / Gallery Grid */}
                        <main className="lg:col-span-3">
                            {filteredGallery && filteredGallery.length > 0 ? (
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    {filteredGallery.map((item, idx) => (
                                        <div key={item.id || idx} className="group bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300">
                                            <div className="h-64 overflow-hidden relative bg-slate-900">
                                                {item.image ? (
                                                    <img src={`/${item.image}`} alt={item.title || 'Project image'} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                                ) : (
                                                    <div className="w-full h-full flex items-center justify-center text-slate-500">
                                                        <ImageIcon className="w-10 h-10" />
                                                    </div>
                                                )}
                                                {item.title && (
                                                    <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent p-4 flex items-end opacity-90 group-hover:opacity-100 transition-opacity">
                                                        <h3 className="text-white font-bold text-base">{item.title}</h3>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="bg-white rounded-2xl p-12 text-center text-slate-500">
                                    No project gallery items found for this category.
                                </div>
                            )}
                        </main>
                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
