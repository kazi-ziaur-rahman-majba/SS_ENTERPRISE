import React, { useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { MapPin, Mail, Phone, Send, CheckCircle2, AlertCircle, Loader2 } from 'lucide-react';

export default function Contact({ pageCms, siteSetting }) {
    const { data, setData, processing, reset } = useForm({
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
    });

    const [statusMessage, setStatusMessage] = useState(null);
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    const handleSubmit = (e) => {
        e.preventDefault();
        setStatusMessage(null);

        fetch('/contact-request', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then((res) => res.json())
            .then((resData) => {
                if (resData.success) {
                    setStatusMessage({ type: 'success', text: resData.message || 'Thank you! Your message has been sent.' });
                    reset();
                } else {
                    setStatusMessage({ type: 'error', text: resData.message || 'Something went wrong. Please check your input.' });
                }
            })
            .catch(() => {
                setStatusMessage({ type: 'error', text: 'An error occurred while submitting your message.' });
            });
    };

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.banner_title || 'Contact Us'} - SS Group`} />

            {/* Banner */}
            <section className="relative py-12 sm:py-24 overflow-hidden">
                {pageCms?.banner_image && (
                    <img
                        src={pageCms.banner_image.startsWith('/') ? pageCms.banner_image : `/${pageCms.banner_image}`}
                        alt="Contact Banner"
                        className="absolute inset-0 w-full h-full object-cover"
                    />
                )}
                <div className={`relative z-10 ${containerClass}`}>
                    <div className="max-w-3xl">
                        <nav className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-black mb-3">
                            <Link href="/" className="hover:underline text-black font-extrabold">Home</Link>
                            <span className="text-black font-bold">/</span>
                            <span className="text-white font-bold">{pageCms?.page_title || 'Contact'}</span>
                        </nav>
                        <h1 className="text-3xl sm:text-5xl font-bold text-white">
                            {pageCms?.banner_title || 'Contact Us'}
                        </h1>
                    </div>
                </div>
            </section>

            {/* Contact Cards & Form */}
            <section className="py-20 bg-slate-50">
                <div className={`${containerClass} space-y-16`}>
                    {/* Contact Info Cards */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div className="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-center space-y-4 hover:shadow-xl transition-all">
                            <div className="w-14 h-14 bg-blue-500/10 text-blue-600 rounded-2xl flex items-center justify-center mx-auto shrink-0">
                                <MapPin className="w-7 h-7" />
                            </div>
                            <h3 className="text-xl font-bold text-slate-900">Visit Us</h3>
                            <div
                                className="text-slate-600 text-sm leading-relaxed"
                                dangerouslySetInnerHTML={{ __html: siteSetting?.corporate_office_address || 'High Tower, Mohakhali C/A, Dhaka-1212' }}
                            />
                        </div>

                        <div className="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-center space-y-4 hover:shadow-xl transition-all">
                            <div className="w-14 h-14 bg-blue-500/10 text-blue-600 rounded-2xl flex items-center justify-center mx-auto shrink-0">
                                <Mail className="w-7 h-7" />
                            </div>
                            <h3 className="text-xl font-bold text-slate-900">Email Us</h3>
                            {siteSetting?.email && (
                                <a href={`mailto:${siteSetting.email}`} className="text-slate-600 hover:text-blue-600 text-sm font-medium transition-colors">
                                    {siteSetting.email}
                                </a>
                            )}
                        </div>

                        <div className="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-center space-y-4 hover:shadow-xl transition-all">
                            <div className="w-14 h-14 bg-blue-500/10 text-blue-600 rounded-2xl flex items-center justify-center mx-auto shrink-0">
                                <Phone className="w-7 h-7" />
                            </div>
                            <h3 className="text-xl font-bold text-slate-900">Call Us</h3>
                            {siteSetting?.phone && (
                                <a href={`tel:${siteSetting.phone}`} className="text-slate-600 hover:text-blue-600 text-sm font-medium transition-colors">
                                    {siteSetting.phone}
                                </a>
                            )}
                        </div>
                    </div>

                    {/* Google Map Frame */}
                    <div className="rounded-3xl overflow-hidden shadow-sm border border-slate-100 h-96">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d138588.10800925622!2d90.263797!3d23.7809194!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sbd!4v1755592405118!5m2!1sen!2sbd"
                            width="100%"
                            height="100%"
                            style={{ border: 0 }}
                            allowFullScreen=""
                            loading="lazy"
                        />
                    </div>

                    {/* Contact Form */}
                    <div className="bg-white rounded-3xl p-8 sm:p-12 border border-slate-100 shadow-sm space-y-8">
                        <div>
                            <span className="text-blue-600 font-bold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1.5 rounded-md">
                                Get In Touch
                            </span>
                            <h2 className="text-3xl font-extrabold text-slate-900 tracking-tight mt-2">
                                Send Us a Message
                            </h2>
                        </div>

                        {statusMessage && (
                            <div
                                className={`p-4 rounded-2xl flex items-center gap-3 text-sm font-medium ${
                                    statusMessage.type === 'success' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-red-50 text-red-800 border border-red-200'
                                }`}
                            >
                                {statusMessage.type === 'success' ? <CheckCircle2 className="w-5 h-5 shrink-0" /> : <AlertCircle className="w-5 h-5 shrink-0" />}
                                <span>{statusMessage.text}</span>
                            </div>
                        )}

                        <form onSubmit={handleSubmit} className="space-y-6">
                            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div>
                                    <label className="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Name *</label>
                                    <input
                                        type="text"
                                        required
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        placeholder="Full name"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Email *</label>
                                    <input
                                        type="email"
                                        required
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                        placeholder="Email address"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Phone *</label>
                                    <input
                                        type="text"
                                        required
                                        value={data.phone}
                                        onChange={(e) => setData('phone', e.target.value)}
                                        placeholder="Phone number"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Subject *</label>
                                    <input
                                        type="text"
                                        required
                                        value={data.subject}
                                        onChange={(e) => setData('subject', e.target.value)}
                                        placeholder="Subject"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                            </div>

                            <div>
                                <label className="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Message *</label>
                                <textarea
                                    rows="5"
                                    required
                                    value={data.message}
                                    onChange={(e) => setData('message', e.target.value)}
                                    placeholder="Write your query or message here..."
                                    className="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                            </div>

                            <div className="flex justify-end">
                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="inline-flex items-center gap-2 bg-[#0066ff] hover:bg-[#0052cc] text-white font-semibold px-8 py-3.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all duration-300 disabled:opacity-50"
                                >
                                    {processing ? <Loader2 className="w-4 h-4 animate-spin" /> : <Send className="w-4 h-4" />}
                                    <span>Send Message</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
