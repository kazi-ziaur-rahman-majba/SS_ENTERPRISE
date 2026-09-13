import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { Search, ArrowRight, BookOpen, Briefcase } from 'lucide-react';

export default function SearchResult({ data }) {
    const blogs = data?.blog || [];
    const services = data?.service || [];

    return (
        <FrontEndLayout>
            <Head title="Search Results - SS Group" />

            {/* Banner */}
            <section className="relative bg-slate-900 text-white py-20 overflow-hidden">
                <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-orange-400 mb-3">
                        <Link href="/" className="hover:underline">Home</Link>
                        <span>/</span>
                        <span className="text-slate-300">Search Results</span>
                    </nav>
                    <h1 className="text-3xl sm:text-4xl font-extrabold tracking-tight">
                        Search Results
                    </h1>
                </div>
            </section>

            {/* Results Grid */}
            <section className="py-20 bg-slate-50">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                    {/* Services / Businesses Results */}
                    {services.length > 0 && (
                        <div className="space-y-6">
                            <div className="flex items-center gap-2 text-slate-900 font-bold text-xl border-b border-slate-200 pb-3">
                                <Briefcase className="w-5 h-5 text-orange-500" />
                                <h2>Businesses & Services ({services.length})</h2>
                            </div>
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {services.map((item) => (
                                    <div key={item.id} className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                                        <div className="space-y-3">
                                            <h3 className="font-bold text-slate-900 text-lg hover:text-orange-600 transition-colors">
                                                <Link href={`/service/${item.slug}`}>{item.title}</Link>
                                            </h3>
                                            <p className="text-slate-500 text-xs line-clamp-3">
                                                {item.detail ? item.detail.replace(/(<([^>]+)>)/gi, '') : ''}
                                            </p>
                                        </div>
                                        <div className="pt-4 mt-4 border-t border-slate-100 flex justify-end">
                                            <Link href={`/service/${item.slug}`} className="text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1">
                                                <span>View Business</span>
                                                <ArrowRight className="w-3.5 h-3.5" />
                                            </Link>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    )}

                    {/* Blog Results */}
                    {blogs.length > 0 && (
                        <div className="space-y-6">
                            <div className="flex items-center gap-2 text-slate-900 font-bold text-xl border-b border-slate-200 pb-3">
                                <BookOpen className="w-5 h-5 text-orange-500" />
                                <h2>Articles & Journal ({blogs.length})</h2>
                            </div>
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {blogs.map((item) => (
                                    <div key={item.id} className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                                        <div className="space-y-3">
                                            <h3 className="font-bold text-slate-900 text-lg hover:text-orange-600 transition-colors">
                                                <Link href={`/blog/${item.slug}`}>{item.title}</Link>
                                            </h3>
                                            <p className="text-slate-500 text-xs line-clamp-3">
                                                {item.details ? item.details.replace(/(<([^>]+)>)/gi, '') : ''}
                                            </p>
                                        </div>
                                        <div className="pt-4 mt-4 border-t border-slate-100 flex justify-end">
                                            <Link href={`/blog/${item.slug}`} className="text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1">
                                                <span>Read Article</span>
                                                <ArrowRight className="w-3.5 h-3.5" />
                                            </Link>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    )}

                    {services.length === 0 && blogs.length === 0 && (
                        <div className="bg-white rounded-3xl p-12 text-center text-slate-500 space-y-4">
                            <Search className="w-12 h-12 text-slate-300 mx-auto" />
                            <h3 className="text-xl font-bold text-slate-800">No results found</h3>
                            <p className="text-sm">Try searching with different keywords.</p>
                        </div>
                    )}
                </div>
            </section>
        </FrontEndLayout>
    );
}
