import React from 'react';
import { Head, Link } from '@inertiajs/react';
import FrontEndLayout from '@/Layouts/FrontEndLayout';
import { 
    Target, 
    Eye, 
    Gem, 
    Compass, 
    Star, 
    Users, 
    ShieldCheck, 
    UserCheck, 
    Lightbulb, 
    TrendingUp, 
    Award, 
    CheckCircle, 
    Heart 
} from 'lucide-react';

const iconMap = {
    Star,
    Users,
    ShieldCheck,
    UserCheck,
    Lightbulb,
    TrendingUp,
    Target,
    Eye,
    Gem,
    Compass,
    Award,
    CheckCircle,
    Heart
};

export default function MissionVision({ pageCms }) {
    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    // Default 6 Core Values matching reference design
    const defaultCoreValues = [
        {
            title: "Excellence",
            description: "We strive for excellence in all that we do.",
            icon: "Star"
        },
        {
            title: "Accountability",
            description: "We take responsibility for our actions and outcomes.",
            icon: "Users"
        },
        {
            title: "Integrity",
            description: "We conduct ourselves with honesty and integrity at all times.",
            icon: "ShieldCheck"
        },
        {
            title: "Customer Focus",
            description: "We prioritize the needs and satisfaction of our customers.",
            icon: "UserCheck"
        },
        {
            title: "Innovation",
            description: "We embrace innovation to drive continuous improvement.",
            icon: "Lightbulb"
        },
        {
            title: "Growth",
            description: "We are committed to personal and professional growth for our team members.",
            icon: "TrendingUp"
        }
    ];

    const coreValues = (pageCms?.core_values_items && Array.isArray(pageCms.core_values_items) && pageCms.core_values_items.length > 0)
        ? pageCms.core_values_items
        : defaultCoreValues;

    // Helper to check valid image path
    const getImagePath = (field, defaultUrl) => {
        if (field && typeof field === 'string' && field.trim() !== '') {
            return field.startsWith('http') || field.startsWith('/') ? field : `/${field}`;
        }
        return defaultUrl;
    };

    const missionImg = getImagePath(
        pageCms?.mission_image,
        "https://images.unsplash.com/photo-1541888946425-d0fbb186a5b3?q=80&w=1200&auto=format&fit=crop"
    );

    const visionImg = getImagePath(
        pageCms?.vision_image,
        "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200&auto=format&fit=crop"
    );

    const coreValuesImg = getImagePath(
        pageCms?.core_values_image,
        "https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=1200&auto=format&fit=crop"
    );

    return (
        <FrontEndLayout>
            <Head title={`${pageCms?.page_title || 'Mission & Vision'} - SS Group`} />

            {/* Top Banner */}
            <section className="relative py-12 sm:py-24 overflow-hidden">
                {pageCms?.banner_image && (
                    <img
                        src={getImagePath(pageCms.banner_image, '')}
                        alt="Banner"
                        className="absolute inset-0 w-full h-full object-cover"
                    />
                )}

                <div className={`relative z-10 ${containerClass}`}>
                    <div className="max-w-3xl">
                        <nav className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-black mb-3">
                            <Link href="/" className="hover:underline text-black font-bold">Home</Link>
                            <span className="text-black font-bold">/</span>
                            <span className="text-white font-bold">{pageCms?.page_title || 'Mission & Vision'}</span>
                        </nav>
                        <h1 className="text-3xl sm:text-5xl font-bold text-white">
                            {pageCms?.banner_title || 'Mission, Vision & Core Values'}
                        </h1>
                    </div>
                </div>
            </section>

            {/* Main Content Section - Seamless Flush Checkerboard Grid */}
            <section className="py-12 sm:py-16 bg-white">
                <div className={containerClass}>
                    <div className="bg-white rounded-lg shadow-lg overflow-hidden divide-y divide-slate-100">
                        
                        {/* 1. OUR MISSION ROW */}
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-0 items-center">
                            {/* Left: Text Block */}
                            <div className="p-6 sm:p-10 lg:p-12 flex flex-col justify-center bg-white space-y-4">
                                <div className="flex items-center gap-3.5">
                                    <div className="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/25 shrink-0">
                                        <Target className="w-6 h-6" />
                                    </div>
                                    <h2 className="text-2xl sm:text-3xl font-bold text-black">
                                        Our <span className="text-blue-600">Mission</span>
                                    </h2>
                                </div>

                                <div 
                                    className="text-black leading-relaxed text-sm sm:text-base font-normal prose prose-slate max-w-none [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:my-2 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:my-2 [&_li]:my-1"
                                    dangerouslySetInnerHTML={{ 
                                        __html: (pageCms?.mission_details && pageCms.mission_details.trim() !== '')
                                            ? pageCms.mission_details
                                            : `Our mission is to deliver excellence in every sector we operate in, with a strong commitment to integrity, innovation, and sustainable development. In construction and land development, we aspire to build infrastructure that enhances urban growth and resilience. Through river dredging, we aim to contribute to environmental preservation, reducing flood risks, and ensuring navigational safety.` 
                                    }}
                                />
                            </div>

                            {/* Right: Image Block (Constrained height on lg devices) */}
                            <div className="relative h-[240px] sm:h-[280px] lg:h-[300px] w-full overflow-hidden bg-slate-100">
                                <img 
                                    src={missionImg} 
                                    alt={pageCms?.mission_title || "Our Mission"} 
                                    className="w-full h-full object-cover"
                                />
                            </div>
                        </div>

                        {/* 2. OUR VISION ROW */}
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-0 items-center">
                            {/* Left: Image Block (Constrained height on lg devices) */}
                            <div className="relative h-[240px] sm:h-[280px] lg:h-[300px] w-full overflow-hidden bg-slate-100 order-2 lg:order-1">
                                <img 
                                    src={visionImg} 
                                    alt={pageCms?.vision_title || "Our Vision"} 
                                    className="w-full h-full object-cover"
                                />
                            </div>

                            {/* Right: Text Block */}
                            <div className="p-6 sm:p-10 lg:p-12 flex flex-col justify-center bg-slate-50/40 order-1 lg:order-2 space-y-4">
                                <div className="flex items-center gap-3.5">
                                    <div className="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/25 shrink-0">
                                        <Eye className="w-6 h-6" />
                                    </div>
                                    <h2 className="text-2xl sm:text-3xl font-bold text-black">
                                        Our <span className="text-blue-600">Vision</span>
                                    </h2>
                                </div>

                                <div 
                                    className="text-black leading-relaxed text-sm sm:text-base font-normal max-w-none [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:my-2 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:my-2 [&_li]:my-1"
                                    dangerouslySetInnerHTML={{ 
                                        __html: (pageCms?.vision_details && pageCms.vision_details.trim() !== '')
                                            ? pageCms.vision_details
                                            : `At SS Group of Companies, our vision is to be a leading conglomerate, known for innovation, quality, and sustainability across multiple industries. We aim to shape a future where our expertise in construction, land development, river dredging, electro-medical equipment supply, and trading elevates the standards of living and contributes to the socio-economic progress of communities.` 
                                    }}
                                />
                            </div>
                        </div>

                        {/* 3. CORE VALUES ROW */}
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-0 items-center">
                            {/* Left: Text & 2-Column Values Grid Block */}
                            <div className="p-6 sm:p-10 lg:p-12 flex flex-col justify-center bg-white space-y-6">
                                <div>
                                    <div className="flex items-center gap-3.5 mb-2">
                                        <div className="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/25 shrink-0">
                                            <Gem className="w-6 h-6" />
                                        </div>
                                        <h2 className="text-2xl sm:text-3xl font-bold text-black">
                                            Core <span className="text-blue-600">Values</span>
                                        </h2>
                                    </div>
                                    {pageCms?.core_values_details && pageCms.core_values_details.trim() !== '' && (
                                        <div 
                                            className="text-black text-xs sm:text-sm font-normal mt-1 max-w-none [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:my-2 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:my-2 [&_li]:my-1"
                                            dangerouslySetInnerHTML={{ __html: pageCms.core_values_details }}
                                        />
                                    )}
                                </div>

                                {/* Values Grid */}
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4">
                                    {coreValues.map((val, idx) => {
                                        const IconComponent = iconMap[val.icon] || Star;
                                        return (
                                            <div key={idx} className="flex gap-3 items-start">
                                                <div className="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                                    <IconComponent className="w-4 h-4" />
                                                </div>
                                                <div>
                                                    <h3 className="text-sm sm:text-base font-semibold text-black mb-0.5">
                                                        {val.title}
                                                    </h3>
                                                    <p className="text-black text-xs font-normal leading-snug">
                                                        {val.description}
                                                    </p>
                                                </div>
                                            </div>
                                        );
                                    })}
                                </div>
                            </div>

                            {/* Right: Image Block (Constrained height on lg devices) */}
                            <div className="relative h-[260px] sm:h-[300px] lg:h-[330px] w-full overflow-hidden bg-slate-100">
                                <img 
                                    src={coreValuesImg} 
                                    alt={pageCms?.core_values_title || "Core Values"} 
                                    className="w-full h-full object-cover"
                                />
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </FrontEndLayout>
    );
}
