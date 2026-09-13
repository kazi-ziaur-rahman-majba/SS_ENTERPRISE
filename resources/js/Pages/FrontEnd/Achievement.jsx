import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { Award, ShieldCheck } from 'lucide-react';

export default function Achievement({ membershipCertificate }) {
    return (
        <FrontEndLayout>
            <Head title="Certification & Achievements - SS Group" />

            {/* Banner */}
            <section className="relative bg-slate-900 text-white py-24 overflow-hidden">
                <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-orange-400 mb-3">
                        <Link href="/" className="hover:underline">Home</Link>
                        <span>/</span>
                        <span className="text-slate-300">Certification</span>
                    </nav>
                    <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight">
                        Membership & Certification
                    </h1>
                </div>
            </section>

            {/* Content */}
            <section className="py-20 bg-slate-50">
                <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    {membershipCertificate ? (
                        <div className="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 space-y-8">
                            <div className="flex items-center gap-4 border-b border-slate-100 pb-6">
                                <div className="w-14 h-14 bg-orange-500/10 text-orange-600 rounded-2xl flex items-center justify-center shrink-0">
                                    <Award className="w-7 h-7" />
                                </div>
                                <div>
                                    <h2 className="text-2xl sm:text-3xl font-extrabold text-slate-900">
                                        {membershipCertificate.title || 'Official Certifications'}
                                    </h2>
                                </div>
                            </div>

                            {membershipCertificate.image && (
                                <div className="rounded-2xl overflow-hidden shadow-lg max-w-2xl mx-auto">
                                    <img src={`/${membershipCertificate.image}`} alt="Certificate" className="w-full h-auto object-contain" />
                                </div>
                            )}

                            {membershipCertificate.details && (
                                <div
                                    className="text-slate-600 leading-relaxed text-base prose prose-slate max-w-none"
                                    dangerouslySetInnerHTML={{ __html: membershipCertificate.details }}
                                />
                            )}
                        </div>
                    ) : (
                        <div className="bg-white rounded-3xl p-12 text-center text-slate-500">
                            No membership certificate data available.
                        </div>
                    )}
                </div>
            </section>
        </FrontEndLayout>
    );
}
