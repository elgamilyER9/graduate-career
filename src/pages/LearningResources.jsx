import React, { useState, useEffect, useMemo } from 'react';
import { useTranslation } from 'react-i18next';
import { motion, AnimatePresence } from 'framer-motion';
import { TypeAnimation } from 'react-type-animation';

const categories = [
    {
        id: 'frontend',
        icon: 'bi bi-code-slash',
        image: `${import.meta.env.BASE_URL}images/frontend.png`,
        color: '#0D6EFD',
        glow: 'rgba(13, 110, 253, 0.5)',
        description: {
            en: 'Master the art of building beautiful, interactive user interfaces with modern web standards.',
            ar: 'أتقن فن بناء واجهات مستخدم جميلة وتفاعلية باستخدام أحدث معايير الويب العالمية.'
        },
        resources: [
            { name: 'freeCodeCamp', url: 'https://www.freecodecamp.org', desc: 'Comprehensive curriculum for web development basics.' },
            { name: 'MDN Web Docs', url: 'https://developer.mozilla.org', desc: 'The most trusted source for web technology documentation.' },
            { name: 'Frontend Masters', url: 'https://frontendmasters.com', desc: 'Expert-led courses for professional frontend engineers.' },
            { name: 'CSS-Tricks', url: 'https://css-tricks.com', desc: 'Advanced techniques and tips for modern CSS.' },
        ],
    },
    {
        id: 'backend',
        icon: 'bi bi-database-fill-gear',
        image: `${import.meta.env.BASE_URL}images/backend.png`,
        color: '#10B981',
        glow: 'rgba(16, 185, 129, 0.5)',
        description: {
            en: 'Deep dive into server-side logic, databases, and APIs to power scalable applications.',
            ar: 'تعمق في منطق الخادم، قواعد البيانات، وواجهات برمجة التطبيقات لبناء تطبيقات قابلة للتوسع.'
        },
        resources: [
            { name: 'Node.js Docs', url: 'https://nodejs.org/en/docs', desc: 'Detailed API references for the Node.js runtime.' },
            { name: 'Express.js Guide', url: 'https://expressjs.com', desc: 'Standard framework for building web apps on Node.js.' },
            { name: 'Postman Academy', url: 'https://learning.postman.com', desc: 'Master API development and testing tools.' },
            { name: 'Laravel News', url: 'https://laravel-news.com', desc: 'Latest updates and tutorials for the Laravel ecosystem.' },
        ],
    },
    {
        id: 'ai',
        icon: 'bi bi-cpu-fill',
        image: `${import.meta.env.BASE_URL}images/ai.png`,
        color: '#8B5CF6',
        glow: 'rgba(139, 92, 246, 0.5)',
        description: {
            en: 'Explore the future of intelligence through machine learning, neural networks, and data science.',
            ar: 'استكشف مستقبل الذكاء من خلال تعلم الآلة، الشبكات العصبية، وعلوم البيانات المتقدمة.'
        },
        resources: [
            { name: 'Coursera AI', url: 'https://www.coursera.org/browse/data-science/machine-learning', desc: 'Certificates from Google, Stanford, and IBM.' },
            { name: 'Kaggle Learn', url: 'https://www.kaggle.com/learn', desc: 'Bite-sized courses on data science and ML.' },
            { name: 'Fast.ai', url: 'https://www.fast.ai', desc: 'Deep learning for coders with a practical approach.' },
            { name: 'NVIDIA Deep Learning', url: 'https://www.nvidia.com/en-us/training/', desc: 'Hands-on training for developers/data scientists.' },
        ],
    },
    {
        id: 'cybersecurity',
        icon: 'bi bi-shield-lock-fill',
        image: `${import.meta.env.BASE_URL}images/cybersecurity.png`,
        color: '#EF4444',
        glow: 'rgba(239, 68, 68, 0.5)',
        description: {
            en: 'Learn to protect systems, networks, and data from digital attacks and threats.',
            ar: 'تعلم كيفية حماية الأنظمة، الشبكات، والبيانات من الهجمات والتهديدات الرقمية المتطورة.'
        },
        resources: [
            { name: 'TryHackMe', url: 'https://tryhackme.com', desc: 'Hands-on laboratories for hacking and defense.' },
            { name: 'Hack The Box', url: 'https://www.hackthebox.com', desc: 'Advanced penetration testing platform.' },
            { name: 'OWASP Foundation', url: 'https://owasp.org', desc: 'The world\'s largest security community.' },
            { name: 'Cybrary', url: 'https://www.cybrary.it', desc: 'Career-focused cybersecurity training.' },
        ],
    },
];

const segmentTitles = {
    en: {
        frontend: 'Modern Frontend',
        backend: 'Cloud & Systems',
        ai: 'Next-Gen Intelligence',
        cybersecurity: 'Secure Infrastructure',
    },
    ar: {
        frontend: 'الواجهات الحديثة',
        backend: 'السحاب والأنظمة',
        ai: 'ذكاء الجيل القادم',
        cybersecurity: 'البنى التحتية الآمنة',
    },
};

const ResourceCard = ({ cat, lang, isRtl }) => {
    return (
        <motion.div
            layout
            initial={{ opacity: 0, scale: 0.9 }}
            animate={{ opacity: 1, scale: 1 }}
            exit={{ opacity: 0, scale: 0.9 }}
            className="bento-glass-card group"
            style={{ '--card-glow': cat.glow, '--card-accent': cat.color }}
        >
            <div className="card-visual-header">
                <div className="status-indicator">
                    <span className="pulse-dot"></span>
                    {isRtl ? 'محتوى محدث' : 'Updated Content'}
                </div>
                <div className="category-glow-blob"></div>
                <motion.div 
                    className="visual-container"
                    whileHover={{ scale: 1.05, rotate: 2 }}
                >
                    <img src={cat.image} alt={cat.id} className="floating-illustration" />
                </motion.div>
            </div>

            <div className="card-body-content">
                <div className="d-flex align-items-center mb-3">
                    <div className="icon-wrapper">
                        <i className={cat.icon}></i>
                    </div>
                    <h3 className="category-title mb-0 ms-3 me-3">
                        {segmentTitles[lang][cat.id]}
                    </h3>
                </div>

                <p className="category-desc">
                    {cat.description[lang]}
                </p>

                <div className="resource-list mt-4">
                    <div className="list-label fw-black mb-3">
                        {isRtl ? 'منصات مقترحة:' : 'Recommended Hubs:'}
                    </div>
                    {cat.resources.map((res, idx) => (
                        <a 
                            key={idx} 
                            href={res.url} 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            className="resource-link-item"
                        >
                            <div className="link-content">
                                <span className="link-name">{res.name}</span>
                                <span className="link-desc">{res.desc}</span>
                            </div>
                            <i className="bi bi-arrow-up-right-circle link-icon"></i>
                        </a>
                    ))}
                </div>
            </div>
        </motion.div>
    );
};

const LearningResources = () => {
    const { i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');
    const lang = isRtl ? 'ar' : 'en';
    const [activeTag, setActiveTag] = useState('all');
    const [searchTerm, setSearchTerm] = useState('');

    const filteredCategories = useMemo(() => {
        return categories.filter(cat => {
            const matchesTag = activeTag === 'all' || cat.id === activeTag;
            const matchesSearch = cat.id.toLowerCase().includes(searchTerm.toLowerCase()) || 
                                segmentTitles[lang][cat.id].toLowerCase().includes(searchTerm.toLowerCase());
            return matchesTag && matchesSearch;
        });
    }, [activeTag, searchTerm, lang]);

    return (
        <div className={`learning-hub-page ${isRtl ? 'rtl' : 'ltr'}`}>
            {/* Immersive Hero */}
            <header className="hub-hero">
                <div className="crystal-grid-bg"></div>
                <div className="floating-cubes">
                    {[1, 2, 3, 4, 5].map(i => <div key={i} className={`cube cube-${i}`}></div>)}
                </div>
                
                <div className="container position-relative z-index-2 py-5">
                    <motion.div
                        initial={{ opacity: 0, y: -20 }}
                        animate={{ opacity: 1, y: 0 }}
                        className="hero-badge mx-auto mb-4"
                    >
                        <i className="bi bi-lightning-charge-fill text-warning me-2"></i>
                        {isRtl ? 'مركز التفوق المهني الرقمي' : 'Digital Professional Excellence Hub'}
                    </motion.div>

                    <motion.h1 
                        className="display-2 fw-black text-white mb-3"
                        initial={{ opacity: 0, scale: 0.9 }}
                        animate={{ opacity: 1, scale: 1 }}
                    >
                        {isRtl ? 'بوابة المعرفة الذكية' : 'Smart Knowledge Hub'}
                    </motion.h1>
                    
                    <motion.p 
                        className="lead text-white-50 mx-auto mb-5 max-w-lg"
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        transition={{ delay: 0.2 }}
                    >
                        {isRtl 
                            ? 'انطلق نحو مسارك المهني بأفضل الموارد التعليمية المنسقة بعناية من كبار الخبراء في العالم.' 
                            : 'Launch your career path with the finest learning resources curated by top global experts.'}
                    </motion.p>

                    {/* Advanced Glass Search */}
                    <div className="search-container mx-auto">
                        <div className="glass-search-box">
                            <i className="bi bi-search search-icon"></i>
                            <input 
                                type="text" 
                                placeholder={isRtl ? 'ابحث عن مسار تعليمي...' : 'Search for a learning path...'}
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                        </div>
                    </div>
                </div>
            </header>

            {/* Interactive Filters */}
            <div className="container mt-n4 filter-bar-section">
                <div className="filter-tabs-wrapper glass-blur rounded-pill p-1 shadow-2xl mx-auto">
                    <button 
                        className={`filter-btn ${activeTag === 'all' ? 'active' : ''}`}
                        onClick={() => setActiveTag('all')}
                    >
                        {isRtl ? 'الكل' : 'All Topics'}
                    </button>
                    {categories.map(cat => (
                        <button 
                            key={cat.id}
                            className={`filter-btn ${activeTag === cat.id ? 'active' : ''}`}
                            onClick={() => setActiveTag(cat.id)}
                        >
                            {segmentTitles[lang][cat.id]}
                        </button>
                    ))}
                </div>
            </div>

            {/* Bento Grid */}
            <main className="container py-5 mt-4">
                <motion.div 
                    layout
                    className="bento-grid-layout"
                >
                    <AnimatePresence mode='popLayout'>
                        {filteredCategories.map((cat, idx) => (
                            <ResourceCard key={cat.id} cat={cat} lang={lang} isRtl={isRtl} />
                        ))}
                    </AnimatePresence>
                </motion.div>
                
                {filteredCategories.length === 0 && (
                    <div className="text-center py-5 animate__animated animate__fadeIn">
                        <i className="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                        <h4 className="text-muted">{isRtl ? 'لا توجد نتائج بحث مطابقة' : 'No matching resources found'}</h4>
                    </div>
                )}
            </main>

            <style dangerouslySetInnerHTML={{ __html: `
                :root {
                    --hub-bg: #030712;
                    --glass-bg: rgba(255, 255, 255, 0.03);
                    --glass-border: rgba(255, 255, 255, 0.1);
                    --max-w-lg: 700px;
                }

                .learning-hub-page {
                    background-color: var(--hub-bg);
                    min-height: 100vh;
                    color: white;
                    font-family: 'Cairo', 'Outfit', sans-serif;
                    overflow-x: hidden;
                }

                /* Hero Section Styles */
                .hub-hero {
                    position: relative;
                    padding: 120px 0 100px;
                    background: radial-gradient(circle at 50% 0%, #1e1b4b 0%, var(--hub-bg) 70%);
                    text-align: center;
                    overflow: hidden;
                }

                .crystal-grid-bg {
                    position: absolute;
                    inset: 0;
                    background-image: 
                        linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
                    background-size: 50px 50px;
                    mask-image: radial-gradient(circle at center, black, transparent 80%);
                }

                .hero-badge {
                    display: inline-flex;
                    align-items: center;
                    background: rgba(255,255,255,0.05);
                    border: 1px solid rgba(255,255,255,0.1);
                    padding: 8px 20px;
                    border-radius: 100px;
                    font-size: 0.9rem;
                    font-weight: 600;
                    backdrop-filter: blur(10px);
                }

                .max-w-lg { max-width: var(--max-w-lg); }

                /* Glass Search Box */
                .search-container { max-width: 600px; }
                .glass-search-box {
                    background: rgba(255,255,255,0.05);
                    border: 1px solid rgba(255,255,255,0.1);
                    border-radius: 20px;
                    padding: 15px 25px;
                    display: flex;
                    align-items: center;
                    gap: 15px;
                    backdrop-filter: blur(20px);
                    box-shadow: 0 20px 50px rgba(0,0,0,0.3);
                    transition: all 0.3s ease;
                }
                .glass-search-box:focus-within {
                    border-color: #0D6EFD;
                    box-shadow: 0 0 30px rgba(13, 110, 253, 0.2);
                    transform: translateY(-2px);
                }
                .glass-search-box input {
                    background: none;
                    border: none;
                    color: white;
                    width: 100%;
                    font-size: 1.1rem;
                    outline: none;
                }
                .search-icon { font-size: 1.25rem; color: #0D6EFD; }

                /* Filter Tabs */
                .filter-bar-section {
                    position: relative;
                    z-index: 10;
                }
                .filter-tabs-wrapper {
                    max-width: fit-content;
                    display: flex;
                    gap: 5px;
                    background: rgba(255,255,255,0.03);
                    backdrop-filter: blur(30px);
                    border: 1px solid rgba(255,255,255,0.05);
                }
                .filter-btn {
                    padding: 12px 25px;
                    border-radius: 50px;
                    border: none;
                    background: transparent;
                    color: rgba(255,255,255,0.6);
                    font-weight: 600;
                    transition: all 0.2s ease;
                }
                .filter-btn:hover { color: white; background: rgba(255,255,255,0.05); }
                .filter-btn.active {
                    background: #0D6EFD;
                    color: white;
                    box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
                }

                /* Bento Grid Layout */
                .bento-grid-layout {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 30px;
                }

                @media (max-width: 992px) {
                    .bento-grid-layout { grid-template-columns: 1fr; }
                }

                /* Bento Card Styles */
                .bento-glass-card {
                    background: var(--glass-bg);
                    border: 1px solid var(--glass-border);
                    border-radius: 40px;
                    overflow: hidden;
                    backdrop-filter: blur(20px);
                    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
                    position: relative;
                }
                .bento-glass-card:hover {
                    border-color: var(--card-accent);
                    transform: translateY(-10px);
                    background: rgba(255,255,255,0.05);
                    box-shadow: 0 30px 60px rgba(0,0,0,0.5), 0 0 20px var(--card-glow);
                }

                .card-visual-header {
                    height: 280px;
                    position: relative;
                    background: rgba(0,0,0,0.2);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;
                }
                .category-glow-blob {
                    position: absolute;
                    width: 150px;
                    height: 150px;
                    background: var(--card-accent);
                    filter: blur(80px);
                    opacity: 0.3;
                    z-index: 1;
                }
                .visual-container { z-index: 2; position: relative; }
                .floating-illustration {
                    max-width: 200px;
                    filter: drop-shadow(0 20px 40px rgba(0,0,0,0.4));
                }

                .status-indicator {
                    position: absolute;
                    top: 25px;
                    left: 25px;
                    background: rgba(255,255,255,0.1);
                    padding: 8px 15px;
                    border-radius: 50px;
                    font-size: 0.75rem;
                    font-weight: 700;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    backdrop-filter: blur(10px);
                }
                .rtl .status-indicator { left: auto; right: 25px; }
                .pulse-dot {
                    width: 8px;
                    height: 8px;
                    background: var(--card-accent);
                    border-radius: 50%;
                    box-shadow: 0 0 10px var(--card-accent);
                    animation: pulse 2s infinite;
                }

                @keyframes pulse {
                    0% { transform: scale(0.95); opacity: 0.7; }
                    50% { transform: scale(1.2); opacity: 1; }
                    100% { transform: scale(0.95); opacity: 0.7; }
                }

                .card-body-content { padding: 40px; }
                .icon-wrapper {
                    font-size: 1.75rem;
                    color: var(--card-accent);
                    background: rgba(255,255,255,0.03);
                    width: 60px;
                    height: 60px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 18px;
                    border: 1px solid rgba(255,255,255,0.1);
                }
                .category-title { font-size: 1.8rem; font-weight: 800; }
                .category-desc { color: rgba(255,255,255,0.6); line-height: 1.7; font-size: 1.05rem; }

                .resource-link-item {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 15px 20px;
                    background: rgba(255,255,255,0.02);
                    border: 1px solid rgba(255,255,255,0.05);
                    border-radius: 20px;
                    margin-bottom: 12px;
                    text-decoration: none;
                    transition: all 0.3s ease;
                }
                .resource-link-item:hover {
                    background: rgba(255,255,255,0.05);
                    border-color: var(--card-accent);
                    transform: translateX(8px);
                }
                .rtl .resource-link-item:hover { transform: translateX(-8px); }

                .link-name { display: block; font-weight: 700; color: white; font-size: 1.05rem; }
                .link-desc { display: block; font-size: 0.85rem; color: rgba(255,255,255,0.5); }
                .link-icon { font-size: 1.25rem; color: rgba(255,255,255,0.2); transition: 0.3s; }
                .resource-link-item:hover .link-icon { color: var(--card-accent); transform: rotate(-45deg); }

                /* Floating Cubes Animation */
                .cube {
                    position: absolute;
                    background: rgba(255,255,255,0.03);
                    border: 1px solid rgba(255,255,255,0.05);
                    border-radius: 10px;
                    animation: float 20s infinite linear;
                }
                @keyframes float {
                    from { transform: rotate(0) translate(0,0); }
                    to { transform: rotate(360deg) translate(20px, 30px); }
                }
                .cube-1 { width: 50px; height: 50px; top: 10%; left: 5%; animation-duration: 25s; }
                .cube-2 { width: 80px; height: 80px; bottom: 15%; left: 8%; animation-duration: 35s; }
                .cube-3 { width: 40px; height: 40px; top: 20%; right: 10%; animation-duration: 30s; }
                .cube-4 { width: 60px; height: 60px; bottom: 20%; right: 5%; animation-duration: 40s; }
            ` }} />
        </div>
    );
};

export default LearningResources;