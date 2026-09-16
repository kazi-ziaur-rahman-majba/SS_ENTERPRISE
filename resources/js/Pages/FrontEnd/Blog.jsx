import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { Calendar, FolderOpen, ArrowRight } from 'lucide-react';

export default function Blog({ pageCms, blogs, blogCategories }) {
    const blogList = blogs?.data || [];
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.banner_title || 'Blog'} - SS Group`} />

            {/* Banner */}
            <section className="relative text-white py-12 sm:py-24 overflow-hidden">
                {pageCms?.banner_image && (
                    <img
                        src={pageCms.banner_image.startsWith('/') ? pageCms.banner_image : `/${pageCms.banner_image}`}
                        alt="Banner"
                        className="absolute inset-0 w-full h-full object-cover"
                    />
                )}
                <div className={`relative z-10 ${containerClass}`}>
                    <nav className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-blue-400 mb-3">
                        <Link href="/" className="hover:underline">Home</Link>
                        <span>/</span>
                        <span className="text-slate-300">{pageCms?.page_title || 'Journal'}</span>
                    </nav>
                    <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight">
                        {pageCms?.banner_title || 'News & Articles'}
                    </h1>
                </div>
            </section>

            {/* Main Content */}
            <section className="py-20 bg-slate-50">
                <div className={containerClass}>
                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        {/* Blog Post Stream */}
                        <main className="lg:col-span-2 space-y-8">
                            {blogList && blogList.length > 0 ? (
                                blogList.map((post) => (
                                    <article key={post.id} className="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 group hover:shadow-xl transition-all duration-300">
                                        <div className="h-72 bg-slate-100 overflow-hidden relative">
                                            {post.image && (
                                                <img
                                                    src={`/${post.image}`}
                                                    alt={post.title}
                                                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                                />
                                            )}
                                        </div>
                                        <div className="p-8 space-y-4">
                                            <div className="flex items-center gap-4 text-xs font-medium text-slate-500">
                                                {post.category_name && (
                                                    <span className="flex items-center gap-1.5 text-blue-600 font-semibold bg-blue-50 px-2.5 py-1 rounded-md">
                                                        <FolderOpen className="w-3.5 h-3.5" />
                                                        {post.category_name}
                                                    </span>
                                                )}
                                                <span className="flex items-center gap-1.5">
                                                    <Calendar className="w-3.5 h-3.5 text-slate-400" />
                                                    {new Date(post.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}
                                                </span>
                                            </div>

                                            <h2 className="text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors leading-snug">
                                                <Link href={`/blog/${post.slug}`}>{post.title}</Link>
                                            </h2>

                                            <p className="text-slate-600 text-sm leading-relaxed line-clamp-3">
                                                {post.details ? post.details.replace(/(<([^>]+)>)/gi, '') : post.short_details}
                                            </p>

                                            <div className="pt-4 border-t border-slate-100">
                                                <Link
                                                    href={`/blog/${post.slug}`}
                                                    className="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-blue-600 hover:text-blue-700"
                                                >
                                                    <span>Continue Reading</span>
                                                    <ArrowRight className="w-3.5 h-3.5" />
                                                </Link>
                                            </div>
                                        </div>
                                    </article>
                                ))
                            ) : (
                                <div className="bg-white rounded-3xl p-12 text-center text-slate-500">
                                    No blog articles published yet.
                                </div>
                            )}

                            {/* Pagination Links */}
                            {blogs?.links && blogs.links.length > 3 && (
                                <div className="flex items-center justify-center gap-2 pt-6">
                                    {blogs.links.map((link, idx) => (
                                        <Link
                                            key={idx}
                                            href={link.url || '#'}
                                            dangerouslySetInnerHTML={{ __html: link.label }}
                                            className={`px-4 py-2 rounded-xl text-sm font-medium transition-all ${
                                                link.active
                                                    ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20'
                                                    : link.url
                                                    ? 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'
                                                    : 'bg-slate-100 text-slate-400 cursor-not-allowed'
                                            }`}
                                        />
                                    ))}
                                </div>
                            )}
                        </main>

                        {/* Sidebar */}
                        <aside className="space-y-6">
                            <div className="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 sticky top-28 space-y-4">
                                <h3 className="font-bold text-slate-900 text-base border-b border-slate-100 pb-3">
                                    Categories
                                </h3>
                                <ul className="space-y-2">
                                    {blogCategories && blogCategories.map((cat, idx) => (
                                        <li key={idx}>
                                            <span className="flex items-center justify-between px-3 py-2 rounded-xl text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-colors">
                                                <span>{cat.name}</span>
                                                <span className="text-xs bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-semibold">
                                                    {cat.blogs_count}
                                                </span>
                                            </span>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
