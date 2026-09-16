import React, { useState } from 'react';
import { Link, usePage, router } from '@inertiajs/react';
import { Phone, Mail, MapPin, Search, ChevronDown, ChevronRight, Menu, X, ArrowUp } from 'lucide-react';

const FacebookIcon = () => (
    <svg className="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
);

const InstagramIcon = () => (
    <svg className="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
);

const LinkedinIcon = () => (
    <svg className="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
);

export default function FrontEndLayout({ children }) {
    const { siteSetting, servicesMenu } = usePage().props;
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [aboutDropdownOpen, setAboutDropdownOpen] = useState(false);
    const [businessDropdownOpen, setBusinessDropdownOpen] = useState(false);
    const [searchOpen, setSearchOpen] = useState(false);
    const [searchQuery, setSearchQuery] = useState('');

    const containerClass = "max-w-screen-sm sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl 2xl:max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8";

    const handleSearchSubmit = (e) => {
        e.preventDefault();
        if (searchQuery.trim()) {
            router.get('/search-data', { query: searchQuery.trim() });
            setSearchOpen(false);
        }
    };

    const scrollToTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    return (
        <div className="min-h-screen flex flex-col font-sans bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white">
            {/* Top Bar */}
            <div className="bg-[#0056c6] text-white text-xs py-2.5 shadow-sm">
                <div className={containerClass}>
                    <div className="flex justify-between items-center w-full text-[11px] sm:text-xs">
                        <div className="flex items-center gap-3 sm:gap-6">
                            {siteSetting?.phone && (
                                <a href={`tel:${siteSetting.phone}`} className="flex items-center gap-1.5 hover:text-blue-100 transition-colors shrink-0">
                                    <Phone className="w-3.5 h-3.5 text-white shrink-0" />
                                    <span>{siteSetting.phone}</span>
                                </a>
                            )}
                            {siteSetting?.email && (
                                <a href={`mailto:${siteSetting.email}`} className="hidden sm:flex items-center gap-1.5 hover:text-blue-100 transition-colors">
                                    <Mail className="w-3.5 h-3.5 text-white shrink-0" />
                                    <span>{siteSetting.email}</span>
                                </a>
                            )}
                        </div>
                        <div className="flex items-center gap-2.5 sm:gap-3">
                            {siteSetting?.facebook_link && (
                                <a href={siteSetting.facebook_link} target="_blank" rel="noreferrer" className="hover:text-blue-100 transition-colors p-1">
                                    <FacebookIcon />
                                </a>
                            )}
                            {siteSetting?.instagram_link && (
                                <a href={siteSetting.instagram_link} target="_blank" rel="noreferrer" className="hover:text-blue-100 transition-colors p-1">
                                    <InstagramIcon />
                                </a>
                            )}
                            {siteSetting?.linkedin_link && (
                                <a href={siteSetting.linkedin_link} target="_blank" rel="noreferrer" className="hover:text-blue-100 transition-colors p-1">
                                    <LinkedinIcon />
                                </a>
                            )}
                        </div>
                    </div>
                </div>
            </div>

            {/* Main Header / Navbar */}
            <header className="sticky top-0 z-40 bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-100">
                <div className={containerClass}>
                    <div className="flex justify-between items-center h-20">
                        {/* Logo */}
                        <Link href="/" className="flex items-center group">
                            {siteSetting?.logo ? (
                                <img
                                    src={`/${siteSetting.logo}`}
                                    alt="SS Group Logo"
                                    className="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                                />
                            ) : (
                                <span className="text-2xl font-black tracking-tight text-slate-900">
                                    SS<span className="text-blue-600">GROUP</span>
                                </span>
                            )}
                        </Link>

                        {/* Desktop Navigation */}
                        <nav className="hidden lg:flex items-center space-x-1 font-medium text-sm">
                            <Link
                                href="/"
                                className={`px-3.5 py-2 rounded-lg transition-colors ${
                                    window.location.pathname === '/' ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50'
                                }`}
                            >
                                Home
                            </Link>

                            {/* About Dropdown */}
                            <div className="relative group" onMouseEnter={() => setAboutDropdownOpen(true)} onMouseLeave={() => setAboutDropdownOpen(false)}>
                                <button className="flex items-center gap-1 px-3.5 py-2 rounded-lg text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">
                                    <span>About Us</span>
                                    <ChevronDown className="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-transform duration-200 group-hover:rotate-180" />
                                </button>
                                {aboutDropdownOpen && (
                                    <div className="absolute top-full left-0 w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 animate-in fade-in slide-in-from-top-2 duration-200">
                                        <Link href="/about-us" className="block px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                            About Us
                                        </Link>
                                        <Link href="/mission-vision" className="block px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                            Mission & Vision
                                        </Link>
                                    </div>
                                )}
                            </div>

                            {/* Businesses Dropdown */}
                            <div className="relative group" onMouseEnter={() => setBusinessDropdownOpen(true)} onMouseLeave={() => setBusinessDropdownOpen(false)}>
                                <button className="flex items-center gap-1 px-3.5 py-2 rounded-lg text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">
                                    <span>Our Businesses</span>
                                    <ChevronDown className="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-transform duration-200 group-hover:rotate-180" />
                                </button>
                                {businessDropdownOpen && (
                                    <div className="absolute top-full left-0 w-64 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 animate-in fade-in slide-in-from-top-2 duration-200 max-h-80 overflow-y-auto">
                                        {servicesMenu && servicesMenu.length > 0 ? (
                                            servicesMenu.map((item, idx) => (
                                                <Link
                                                    key={idx}
                                                    href={`/service/${item.slug}`}
                                                    className="block px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors border-b border-slate-50 last:border-0"
                                                >
                                                    {item.name}
                                                </Link>
                                            ))
                                        ) : (
                                            <Link href="/business" className="block px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50">
                                                All Businesses
                                            </Link>
                                        )}
                                    </div>
                                )}
                            </div>

                            <Link
                                href="/certification"
                                className={`px-3.5 py-2 rounded-lg transition-colors ${
                                    window.location.pathname === '/certification' ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50'
                                }`}
                            >
                                Certification
                            </Link>

                            <Link
                                href="/sports-affiliation"
                                className={`px-3.5 py-2 rounded-lg transition-colors ${
                                    window.location.pathname === '/sports-affiliation' ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50'
                                }`}
                            >
                                Sports Affiliation
                            </Link>

                            <Link
                                href="/contact"
                                className={`px-3.5 py-2 rounded-lg transition-colors ${
                                    window.location.pathname === '/contact' ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50'
                                }`}
                            >
                                Contact
                            </Link>

                            {/* Gray Vertical Divider */}
                            <div className="h-5 w-px bg-slate-300 mx-2 self-center" />

                            {/* Search Button */}
                            <button
                                onClick={() => setSearchOpen(!searchOpen)}
                                className="p-2.5 rounded-full text-slate-600 hover:text-blue-600 hover:bg-slate-100 transition-colors"
                                title="Search"
                            >
                                <Search className="w-4 h-4" />
                            </button>
                        </nav>

                        {/* Mobile Menu Button */}
                        <div className="flex items-center gap-2 lg:hidden">
                            <button
                                onClick={() => setSearchOpen(!searchOpen)}
                                className="p-2 rounded-lg text-slate-600 hover:bg-slate-100"
                            >
                                <Search className="w-5 h-5" />
                            </button>
                            <button
                                onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                                className="p-2 rounded-lg text-slate-700 hover:bg-slate-100 focus:outline-none"
                            >
                                {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
                            </button>
                        </div>
                    </div>
                </div>

                {/* Search Bar Overlay */}
                {searchOpen && (
                    <div className="bg-slate-900/90 backdrop-blur-sm border-t border-slate-800 p-4 animate-in slide-in-from-top duration-200">
                        <div className={containerClass}>
                            <form onSubmit={handleSearchSubmit} className="relative flex items-center max-w-3xl mx-auto">
                                <input
                                    type="text"
                                    value={searchQuery}
                                    onChange={(e) => setSearchQuery(e.target.value)}
                                    placeholder="Type keyword and press Enter..."
                                    className="w-full bg-slate-800 text-white placeholder-slate-400 rounded-xl pl-4 pr-12 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    autoFocus
                                />
                                <button type="submit" className="absolute right-3 text-slate-400 hover:text-blue-400 p-1">
                                    <Search className="w-5 h-5" />
                                </button>
                            </form>
                        </div>
                    </div>
                )}

                {/* Mobile Dropdown Menu */}
                {mobileMenuOpen && (
                    <div className="lg:hidden border-t border-slate-100 bg-white px-4 pt-2 pb-6 space-y-1 shadow-lg max-h-[80vh] overflow-y-auto">
                        <Link href="/" className="block px-3 py-2.5 rounded-lg text-slate-800 hover:bg-blue-50 font-medium">Home</Link>
                        
                        <div className="space-y-1 pl-2 border-l-2 border-slate-100 my-1">
                            <span className="block text-xs font-bold uppercase tracking-wider text-slate-400 px-3 py-1">About</span>
                            <Link href="/about-us" className="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50 text-sm">About Us</Link>
                            <Link href="/mission-vision" className="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50 text-sm">Mission & Vision</Link>
                        </div>

                        <div className="space-y-1 pl-2 border-l-2 border-slate-100 my-1">
                            <span className="block text-xs font-bold uppercase tracking-wider text-slate-400 px-3 py-1">Businesses</span>
                            {servicesMenu && servicesMenu.map((item, idx) => (
                                <Link key={idx} href={`/service/${item.slug}`} className="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50 text-sm">
                                    {item.name}
                                </Link>
                            ))}
                        </div>

                        <Link href="/certification" className="block px-3 py-2.5 rounded-lg text-slate-800 hover:bg-blue-50 font-medium">Certification</Link>
                        <Link href="/sports-affiliation" className="block px-3 py-2.5 rounded-lg text-slate-800 hover:bg-blue-50 font-medium">Sports Affiliation</Link>
                        <Link href="/contact" className="block px-3 py-2.5 rounded-lg text-slate-800 hover:bg-blue-50 font-medium">Contact</Link>
                    </div>
                )}
            </header>

            {/* Page Content */}
            <main className="flex-grow">
                {children}
            </main>

            {/* Modern Footer matching design mockup */}
            <footer className="bg-[#051329] text-slate-300 pt-12 pb-6 border-t border-slate-800/60 relative overflow-hidden">
                {/* Optional subtle background map effect pattern */}
                <div className="absolute right-0 top-0 bottom-0 w-1/2 opacity-5 pointer-events-none bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px]"></div>

                <div className={containerClass}>
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-8 mb-10 text-xs sm:text-sm">
                        {/* Column 1: Logo, About, Social Icons */}
                        <div className="lg:col-span-3 space-y-4 pr-2">
                            <div className="flex items-center gap-3">
                                {siteSetting?.logo ? (
                                    <img src={`/${siteSetting.logo}`} alt={siteSetting?.name || 'SS Group'} className="h-14 w-auto object-contain rounded-full bg-white/10 p-1 border border-white/20 shadow-md" />
                                ) : (
                                    <img src="/assets/images/sslogo.png" alt="SS Group" className="h-14 w-14 object-contain rounded-full bg-white/10 p-1 border border-white/20 shadow-md" />
                                )}
                            </div>
                            <p className="text-slate-400 text-xs leading-relaxed" dangerouslySetInnerHTML={{ 
                                __html: siteSetting?.about_us || 'SS Group is also commonly known as SS Group of Companies is a blending of various corporate houses.' 
                            }} />
                            <div className="flex items-center gap-2.5 pt-1">
                                {siteSetting?.facebook_link && (
                                    <a href={siteSetting.facebook_link} target="_blank" rel="noreferrer" className="w-8 h-8 rounded-full bg-[#0d2242] border border-slate-700/50 flex items-center justify-center text-slate-300 hover:bg-blue-600 hover:text-white hover:border-blue-500 transition-all duration-300 shadow-sm">
                                        <FacebookIcon />
                                    </a>
                                )}
                                {siteSetting?.linkedin_link && (
                                    <a href={siteSetting.linkedin_link} target="_blank" rel="noreferrer" className="w-8 h-8 rounded-full bg-[#0d2242] border border-slate-700/50 flex items-center justify-center text-slate-300 hover:bg-blue-600 hover:text-white hover:border-blue-500 transition-all duration-300 shadow-sm">
                                        <LinkedinIcon />
                                    </a>
                                )}
                                {siteSetting?.instagram_link && (
                                    <a href={siteSetting.instagram_link} target="_blank" rel="noreferrer" className="w-8 h-8 rounded-full bg-[#0d2242] border border-slate-700/50 flex items-center justify-center text-slate-300 hover:bg-blue-600 hover:text-white hover:border-blue-500 transition-all duration-300 shadow-sm">
                                        <InstagramIcon />
                                    </a>
                                )}
                            </div>
                        </div>

                        {/* Column 2: Useful Links */}
                        <div className="lg:col-span-3 space-y-3 lg:border-l border-slate-800/70 lg:pl-8">
                            <div>
                                <h3 className="text-white font-bold text-sm tracking-wider uppercase">
                                    Useful Links
                                </h3>
                                <div className="w-8 h-[2px] bg-blue-500 mt-1"></div>
                            </div>
                            <ul className="space-y-2 text-xs text-slate-300 pt-1">
                                <li>
                                    <Link href="/about-us" className="hover:text-blue-400 transition-colors flex items-center justify-between group py-0.5">
                                        <span>About Us</span>
                                        <ChevronRight className="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-400 transition-colors" />
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/business" className="hover:text-blue-400 transition-colors flex items-center justify-between group py-0.5">
                                        <span>Our Businesses</span>
                                        <ChevronRight className="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-400 transition-colors" />
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/certification" className="hover:text-blue-400 transition-colors flex items-center justify-between group py-0.5">
                                        <span>Certification</span>
                                        <ChevronRight className="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-400 transition-colors" />
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/sports-affiliation" className="hover:text-blue-400 transition-colors flex items-center justify-between group py-0.5">
                                        <span>Sports Affiliation</span>
                                        <ChevronRight className="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-400 transition-colors" />
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/contact" className="hover:text-blue-400 transition-colors flex items-center justify-between group py-0.5">
                                        <span>Contact Us</span>
                                        <ChevronRight className="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-400 transition-colors" />
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        {/* Column 3: Registered Address */}
                        <div className="lg:col-span-3 space-y-3 lg:border-l border-slate-800/70 lg:pl-8">
                            <div>
                                <h3 className="text-white font-bold text-sm tracking-wider uppercase">
                                    Registered Address
                                </h3>
                                <div className="w-8 h-[2px] bg-blue-500 mt-1"></div>
                            </div>
                            <ul className="space-y-3 text-xs text-slate-300 pt-1">
                                <li className="flex items-start gap-3">
                                    <Phone className="w-4 h-4 text-blue-500 shrink-0 mt-0.5" />
                                    <a href={`tel:${siteSetting?.phone || '+880 1714-429777'}`} className="hover:text-blue-400 transition-colors">
                                        {siteSetting?.phone || '+880 1714-429777'}
                                    </a>
                                </li>
                                <li className="flex items-start gap-3">
                                    <Mail className="w-4 h-4 text-blue-500 shrink-0 mt-0.5" />
                                    <a href={`mailto:${siteSetting?.email || siteSetting?.contact_email || 'info@esenterprise.com.bd'}`} className="hover:text-blue-400 transition-colors break-all">
                                        {siteSetting?.email || siteSetting?.contact_email || 'info@esenterprise.com.bd'}
                                    </a>
                                </li>
                                <li className="flex items-start gap-3">
                                    <MapPin className="w-4 h-4 text-blue-500 shrink-0 mt-0.5" />
                                    <span className="leading-relaxed" dangerouslySetInnerHTML={{ 
                                        __html: siteSetting?.registered_office_address || 'House-85, Road-05, Mohammadia Housing Society, Mohammadpur, Dhaka-1207' 
                                    }} />
                                </li>
                            </ul>
                        </div>

                        {/* Column 4: Corporate Office */}
                        <div className="lg:col-span-3 space-y-3 lg:border-l border-slate-800/70 lg:pl-8">
                            <div>
                                <h3 className="text-white font-bold text-sm tracking-wider uppercase">
                                    Corporate Office
                                </h3>
                                <div className="w-8 h-[2px] bg-blue-500 mt-1"></div>
                            </div>
                            <ul className="space-y-3 text-xs text-slate-300 pt-1">
                                <li className="flex items-start gap-3">
                                    <MapPin className="w-4 h-4 text-blue-500 shrink-0 mt-0.5" />
                                    <span className="leading-relaxed" dangerouslySetInnerHTML={{ 
                                        __html: siteSetting?.corporate_office_address || '701, Sahlun Green, Satmasjid Road, Dhaka, Bangladesh' 
                                    }} />
                                </li>
                            </ul>
                        </div>
                    </div>

                    {/* Bottom Copyright */}
                    <div className="pt-6 border-t border-slate-800/80 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-400">
                        <div className="w-full text-center sm:text-center">
                            <p>© {new Date().getFullYear()} SS Group. All Rights Reserved.</p>
                        </div>
                        <button
                            onClick={scrollToTop}
                            className="flex items-center gap-1.5 text-blue-400 hover:text-blue-300 transition-colors shrink-0 text-xs font-medium"
                        >
                            <ArrowUp className="w-3.5 h-3.5" />
                            <span>Back to Top</span>
                        </button>
                    </div>
                </div>
            </footer>
        </div>
    );
}
