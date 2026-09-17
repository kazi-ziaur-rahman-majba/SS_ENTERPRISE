import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { Trophy } from 'lucide-react';

export default function SportsAffiliation() {
    return (
        <FrontEndLayout>
            <Head title="Sports Affiliation - SS Group" />

            {/* Top Banner */}
            <section className="relative py-12 sm:py-24 overflow-hidden">
                <div className="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="max-w-3xl">
                        <nav className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-black mb-3">
                            <Link href="/" className="hover:underline text-black font-extrabold">Home</Link>
                            <span className="text-black font-bold">/</span>
                            <span className="text-white font-bold">Sports Affiliation</span>
                        </nav>
                        <h1 className="text-3xl sm:text-5xl font-bold text-white">
                            Sports Affiliation & Corporate Engagement
                        </h1>
                    </div>
                </div>
            </section>

            {/* Content */}
            <section className="py-20 bg-slate-50">
                <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 space-y-6">
                        <div className="flex items-center gap-4 border-b border-slate-100 pb-6">
                            <div className="w-14 h-14 bg-blue-500/10 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                                <Trophy className="w-7 h-7" />
                            </div>
                            <div>
                                <h2 className="text-2xl sm:text-3xl font-extrabold text-slate-900">
                                    Promoting Sports & Youth Development
                                </h2>
                            </div>
                        </div>

                        <div className="text-slate-600 leading-relaxed text-base space-y-4">
                            <p>
                                SS Group takes immense pride in supporting sports initiatives, tournaments, and youth athletic growth across Bangladesh. As part of our corporate social responsibility and community outreach, we actively affiliate with sports clubs, events, and athletic organizations.
                            </p>
                            <p>
                                Through dedicated sponsorships, equipment support, and tournament hosting, we aim to inspire teamwork, discipline, and healthy living among the youth.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
