import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { Calendar, FolderOpen, Share2 } from 'lucide-react';

const FacebookIcon = () => (
    <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
);

const TwitterIcon = () => (
    <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.936 9.936 0 0024 4.59z"/></svg>
);

const LinkedinIcon = () => (
    <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
);

export default function BlogDetails({ pageCms, blog, blogs, blogCategories }) {
    const currentUrl = typeof window !== 'undefined' ? window.location.href : '';

    return (
        <FrontEndLayout>
            <Head title={`${blog?.title || 'Article'} - SS Group`} />

            {/* Banner */}
            <section className="relative py-12 sm:py-24 overflow-hidden">
                {pageCms?.detail_page_banner_image && (
                    <img
                        src={pageCms.detail_page_banner_image.startsWith('/') ? pageCms.detail_page_banner_image : `/${pageCms.detail_page_banner_image}`}
                        alt="Banner"
                        className="absolute inset-0 w-full h-full object-cover"
                    />
                )}
                <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="max-w-3xl">
                        <nav className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-black mb-3">
                            <Link href="/" className="hover:underline text-black font-bold">Home</Link>
                            <span className="text-black font-bold">/</span>
                            <Link href="/blog" className="hover:underline text-black font-bold">Blog</Link>
                            <span className="text-black font-bold">/</span>
                            <span className="text-white font-bold line-clamp-1">{blog?.title}</span>
                        </nav>
                        <h1 className="text-3xl sm:text-5xl font-bold leading-tight text-white">
                            {blog?.title}
                        </h1>
                    </div>
                </div>
            </section>

            {/* Content & Sidebar */}
            <section className="py-20 bg-slate-50">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        {/* Main Article */}
                        <main className="lg:col-span-2 space-y-8">
                            <div className="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 space-y-6">
                                {blog?.image && (
                                    <div className="rounded-2xl overflow-hidden shadow-md max-h-[450px]">
                                        <img src={`/${blog.image}`} alt={blog.title} className="w-full h-full object-cover" />
                                    </div>
                                )}

                                <div className="flex flex-wrap items-center gap-4 text-xs font-medium text-slate-500 border-b border-slate-100 pb-4">
                                    {blog?.category_name && (
                                        <span className="flex items-center gap-1.5 text-blue-600 font-semibold bg-blue-50 px-3 py-1 rounded-md">
                                            <FolderOpen className="w-3.5 h-3.5" />
                                            {blog.category_name}
                                        </span>
                                    )}
                                    {blog?.created_at && (
                                        <span className="flex items-center gap-1.5">
                                            <Calendar className="w-3.5 h-3.5 text-slate-400" />
                                            {new Date(blog.created_at).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}
                                        </span>
                                    )}
                                </div>

                                <div
                                    className="text-slate-700 leading-relaxed text-base sm:text-lg prose prose-slate max-w-none prose-img:rounded-2xl"
                                    dangerouslySetInnerHTML={{ __html: blog?.details || '' }}
                                />

                                {/* Social Share */}
                                <div className="pt-6 border-t border-slate-100 flex items-center justify-between">
                                    <span className="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-2">
                                        <Share2 className="w-4 h-4" /> Share Article:
                                    </span>
                                    <div className="flex items-center gap-3">
                                        <a
                                            href={`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`}
                                            target="_blank"
                                            rel="noreferrer"
                                            className="w-9 h-9 rounded-full bg-slate-100 hover:bg-blue-600 hover:text-white flex items-center justify-center text-slate-600 transition-colors"
                                        >
                                            <FacebookIcon />
                                        </a>
                                        <a
                                            href={`https://twitter.com/intent/tweet?url=${encodeURIComponent(currentUrl)}`}
                                            target="_blank"
                                            rel="noreferrer"
                                            className="w-9 h-9 rounded-full bg-slate-100 hover:bg-sky-500 hover:text-white flex items-center justify-center text-slate-600 transition-colors"
                                        >
                                            <TwitterIcon />
                                        </a>
                                        <a
                                            href={`https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(currentUrl)}`}
                                            target="_blank"
                                            rel="noreferrer"
                                            className="w-9 h-9 rounded-full bg-slate-100 hover:bg-blue-700 hover:text-white flex items-center justify-center text-slate-600 transition-colors"
                                        >
                                            <LinkedinIcon />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </main>

                        {/* Sidebar */}
                        <aside className="space-y-6">
                            {/* Recent Posts */}
                            {blogs?.data && blogs.data.length > 0 && (
                                <div className="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 space-y-4">
                                    <h3 className="font-bold text-slate-900 text-base border-b border-slate-100 pb-3">
                                        Recent Articles
                                    </h3>
                                    <div className="space-y-4">
                                        {blogs.data.map((item) => (
                                            <div key={item.id} className="flex gap-3 items-center group">
                                                {item.image && (
                                                    <img src={`/${item.image}`} alt={item.title} className="w-14 h-14 rounded-xl object-cover shrink-0" />
                                                )}
                                                <h4 className="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition-colors line-clamp-2">
                                                    <Link href={`/blog/${item.slug}`}>{item.title}</Link>
                                                </h4>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            )}

                            {/* Categories */}
                            <div className="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 space-y-4">
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
