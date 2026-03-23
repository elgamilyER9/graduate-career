import React, { useState, useEffect, useRef } from 'react';
import { useTranslation } from 'react-i18next';
import { dummyArticles } from '../data/articles';
import './Home.css';

const Articles = () => {
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');
    const lang = isRtl ? 'ar' : 'en';

    const [searchTerm, setSearchTerm] = useState('');
    const [selectedCategory, setSelectedCategory] = useState('all');
    const [selectedArticle, setSelectedArticle] = useState(null);
    const [isPanelOpen, setIsPanelOpen] = useState(false);

    const categories = [
        { id: 'all', icon: 'fa-globe' },
        { id: 'tech', icon: 'fa-microchip' },
        { id: 'career', icon: 'fa-rocket' },
        { id: 'soft_skills', icon: 'fa-brain' },
        { id: 'industry', icon: 'fa-city' }
    ];

    const filteredArticles = dummyArticles.filter(article => {
        const matchesCategory = selectedCategory === 'all' || article.category === selectedCategory;
        const searchInput = searchTerm.toLowerCase();
        const matchesSearch = article.title[lang].toLowerCase().includes(searchInput) ||
            article.excerpt[lang].toLowerCase().includes(searchInput);
        return matchesCategory && matchesSearch;
    });

    const openArticle = (article) => {
        setSelectedArticle(article);
        setIsPanelOpen(true);
        document.body.style.overflow = 'hidden';
    };

    const closeArticle = () => {
        setIsPanelOpen(false);
        setTimeout(() => setSelectedArticle(null), 400); // wait for animation
        document.body.style.overflow = 'auto';
    };

    // Separate featured article (e.g. the first one in the filtered list)
    const featuredArticle = filteredArticles.length > 0 ? filteredArticles[0] : null;
    const gridArticles = filteredArticles.length > 1 ? filteredArticles.slice(1) : [];

    // 3D Tilt Effect applied to cards
    const handleMouseMove = (e) => {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = ((y - centerY) / centerY) * -10;
        const rotateY = ((x - centerX) / centerX) * 10;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;

        // Add a glossy spotlight effect
        const glare = card.querySelector('.glare-effect');
        if (glare) {
            glare.style.transform = `translate(${x}px, ${y}px)`;
            glare.style.opacity = '0.4';
        }
    };

    const handleMouseLeave = (e) => {
        const card = e.currentTarget;
        card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        const glare = card.querySelector('.glare-effect');
        if (glare) glare.style.opacity = '0';
    };

    return (
        <div className={`articles-premium-page bg-light ${isRtl ? 'text-end' : 'text-start'}`} style={{ minHeight: '100vh', paddingBottom: '100px', overflowX: 'hidden' }}>

            {/* Ultra-Modern Hero */}
            <div className="position-relative overflow-hidden" style={{ minHeight: '45vh', background: 'radial-gradient(circle at top right, #0f172a, #1e293b, #020617)' }}>
                {/* Abstract Glowing Orbs */}
                <div className="orb-1 position-absolute rounded-circle" style={{ width: '600px', height: '600px', background: 'radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%)', top: '-200px', right: '-200px', filter: 'blur(60px)' }}></div>
                <div className="orb-2 position-absolute rounded-circle" style={{ width: '500px', height: '500px', background: 'radial-gradient(circle, rgba(168,85,247,0.1) 0%, transparent 70%)', bottom: '-100px', left: '-150px', filter: 'blur(50px)' }}></div>

                <div className="container position-relative z-index-2 pt-5 mt-5">
                    <div className="row align-items-center">
                        <div className="col-lg-7">
                            <div className="badge border border-light border-opacity-25 bg-white bg-opacity-10 text-white px-4 py-2 rounded-pill fw-bold mb-4 shadow-sm" style={{ backdropFilter: 'blur(10px)', letterSpacing: '2px', textTransform: 'uppercase', fontSize: '0.8rem' }}>
                                <i className="fas fa-sparkles text-info me-2"></i>
                                {isRtl ? 'بوابة المعرفة المتقدمة' : 'Advanced Knowledge Portal'}
                            </div>
                            <h1 className="display-3 fw-black text-white mb-4 slide-up-anim" style={{ letterSpacing: '-2px', lineHeight: '1.1' }}>
                                {isRtl ? 'اكتشف عوالم' : 'Explore Oceans of'}<br />
                                <span className="text-transparent bg-clip-text" style={{ backgroundImage: 'linear-gradient(to right, #60a5fa, #c084fc)' }}>
                                    {isRtl ? 'الإلهام والمعرفة' : 'Insight & Inspiration'}
                                </span>
                            </h1>
                            <p className="lead text-white-50 mb-5 max-w-lg slide-up-anim-delay">
                                {isRtl ? 'منصة قراءة غامرة مصممة خصيصاً لتوفر لك أفضل محتوى تقني ومهني بأسلوب بصري فريد.' : 'An immersive reading platform designed to deliver premium tech and career content with a unique visual flair.'}
                            </p>
                        </div>
                        <div className="col-lg-5">
                            {/* Premium Search */}
                            <div className="p-1 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-25 shadow-2xl slide-up-anim-delay-2" style={{ backdropFilter: 'blur(20px)' }}>
                                <div className="input-group input-group-lg rounded-pill overflow-hidden bg-dark bg-opacity-50">
                                    <span className="input-group-text bg-transparent border-0 ps-4">
                                        <i className="fas fa-search text-info"></i>
                                    </span>
                                    <input
                                        type="text"
                                        className="form-control border-0 py-4 shadow-none bg-transparent text-white"
                                        placeholder={isRtl ? 'ابحث في ملايين الأفكار...' : 'Search millions of ideas...'}
                                        value={searchTerm}
                                        onChange={(e) => setSearchTerm(e.target.value)}
                                        style={{ fontSize: '1.2rem', color: '#fff' }}
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Floating Glass Filters */}
            <div className="container position-relative" style={{ marginTop: '-35px', zIndex: 10 }}>
                <div className="d-flex align-items-center justify-content-center flex-wrap gap-3">
                    {categories.map((cat) => (
                        <button
                            key={cat.id}
                            onClick={() => setSelectedCategory(cat.id)}
                            className={`filter-pill btn rounded-pill px-4 py-3 fw-bold shadow-lg border border-white transition-all ${selectedCategory === cat.id ? 'active-pill' : 'inactive-pill'}`}
                        >
                            <i className={`fas ${cat.icon} ${selectedCategory === cat.id ? 'text-white' : 'text-primary'}`}></i>
                            <span className="ms-2">{t(`articles_page.categories.${cat.id}`)}</span>
                        </button>
                    ))}
                </div>
            </div>

            {/* Editorial Content Layout */}
            <div className="container mt-5 pt-4">
                {filteredArticles.length > 0 ? (
                    <>
                        {/* Featured Article (Hero Card) */}
                        {featuredArticle && (
                            <div className="row mb-5 fade-in-up">
                                <div className="col-12">
                                    <div
                                        className="featured-card rounded-5 overflow-hidden position-relative shadow-2xl cursor-pointer"
                                        onClick={() => openArticle(featuredArticle)}
                                        onMouseMove={handleMouseMove}
                                        onMouseLeave={handleMouseLeave}
                                        style={{ minHeight: '500px', transition: 'transform 0.2s ease-out' }}
                                    >
                                        <div className="glare-effect position-absolute pointer-events-none rounded-circle bg-white" style={{ width: '400px', height: '400px', filter: 'blur(80px)', opacity: 0, transition: 'opacity 0.3s', zIndex: 2, mixBlendMode: 'overlay', top: '-200px', left: '-200px' }}></div>

                                        <img src={featuredArticle.image} alt={featuredArticle.title[lang]} className="position-absolute w-100 h-100 object-cover" style={{ zIndex: 0 }} />
                                        <div className="position-absolute w-100 h-100" style={{ background: 'linear-gradient(to right, rgba(15,23,42,0.95) 0%, rgba(15,23,42,0.6) 50%, transparent 100%)', zIndex: 1, ...(isRtl ? { background: 'linear-gradient(to left, rgba(15,23,42,0.95) 0%, rgba(15,23,42,0.6) 50%, transparent 100%)' } : {}) }}></div>

                                        <div className="position-relative z-3 h-100 d-flex flex-column justify-content-center p-5 w-md-60">
                                            <div className="mb-4">
                                                <span className="badge bg-info text-dark px-3 py-2 rounded-pill fw-black fs-6 shadow-lg mb-3">
                                                    <i className="fas fa-star me-2"></i> {isRtl ? 'مقال مميز' : 'Featured Editor Choice'}
                                                </span>
                                            </div>
                                            <h2 className="display-4 fw-black text-white mb-4" style={{ letterSpacing: '-1px', textShadow: '0 4px 12px rgba(0,0,0,0.5)' }}>{featuredArticle.title[lang]}</h2>
                                            <p className="lead text-white-50 mb-5" style={{ lineHeight: '1.8' }}>{featuredArticle.excerpt[lang]}</p>

                                            <div className="d-flex align-items-center">
                                                <div className="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow border border-white border-opacity-25" style={{ width: '50px', height: '50px', fontSize: '1.2rem' }}>
                                                    {featuredArticle.author.name.charAt(0)}
                                                </div>
                                                <div className={`ms-3 text-white ${isRtl ? 'me-3 ms-0' : ''}`}>
                                                    <div className="fw-bold fs-5">{featuredArticle.author.name}</div>
                                                    <div className="opacity-75 small">{featuredArticle.author.role} • {featuredArticle.readTime}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )}

                        {/* Bento Grid */}
                        <div className="row g-4 bento-grid">
                            {gridArticles.map((article, idx) => (
                                <div key={article.id} className={`col-lg-${idx % 4 === 0 || idx % 4 === 3 ? '8' : '4'} col-md-6 fade-in-up`} style={{ animationDelay: `${idx * 0.1}s` }}>
                                    <div
                                        className="bento-card card h-100 border-0 rounded-5 overflow-hidden shadow-lg cursor-pointer bg-white"
                                        onClick={() => openArticle(article)}
                                        onMouseMove={handleMouseMove}
                                        onMouseLeave={handleMouseLeave}
                                        style={{ transition: 'transform 0.1s ease-out, box-shadow 0.3s' }}
                                    >
                                        <div className="glare-effect position-absolute pointer-events-none rounded-circle bg-white" style={{ width: '200px', height: '200px', filter: 'blur(50px)', opacity: 0, transition: 'opacity 0.3s', zIndex: 4, mixBlendMode: 'overlay', top: '-100px', left: '-100px' }}></div>
                                        <div className="position-relative overflow-hidden" style={{ height: idx % 4 === 0 || idx % 4 === 3 ? '300px' : '220px' }}>
                                            <img src={article.image} alt={article.title[lang]} className="w-100 h-100 object-cover article-img" />
                                            <div className="position-absolute w-100 h-100 top-0 start-0 gradient-overlay"></div>
                                            <div className={`position-absolute top-0 ${isRtl ? 'start-0' : 'end-0'} p-3 z-3`}>
                                                <span className="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill fw-bold" style={{ backdropFilter: 'blur(10px)', backgroundColor: 'rgba(255,255,255,0.85)' }}>
                                                    {t(`articles_page.categories.${article.category}`)}
                                                </span>
                                            </div>
                                        </div>

                                        <div className="card-body p-4 d-flex flex-column position-relative bg-white z-2">
                                            <div className="d-flex justify-content-between align-items-center mb-3">
                                                <span className="text-primary fw-bold small"><i className="far fa-clock me-1"></i> {article.readTime}</span>
                                                <span className="text-muted small">{article.date}</span>
                                            </div>
                                            <h4 className="fw-black mb-3 text-dark card-title-hover" style={{ lineHeight: '1.4' }}>{article.title[lang]}</h4>
                                            {/* Only show excerpt on wider cards for varying density */}
                                            {(idx % 4 === 0 || idx % 4 === 3) && (
                                                <p className="text-muted mb-4 flex-grow-1">{article.excerpt[lang]}</p>
                                            )}
                                            <div className="mt-auto pt-3 border-top d-flex align-items-center">
                                                <div className="fw-bold text-dark small">{article.author.name}</div>
                                                <div className="ms-auto text-primary read-more-btn fw-bold">
                                                    {isRtl ? 'اقرأ المزيد' : 'Read More'} <i className={`fas fa-arrow-${isRtl ? 'left' : 'right'} ms-1`}></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </>
                ) : (
                    <div className="text-center py-5 my-5">
                        <div className="empty-state-icon mx-auto mb-4 bg-white rounded-circle shadow-lg d-flex align-items-center justify-content-center" style={{ width: '120px', height: '120px' }}>
                            <i className="fas fa-ghost fa-3x text-muted opacity-25"></i>
                        </div>
                        <h3 className="fw-black text-dark mb-3">{isRtl ? 'لا توجد مقالات قيد العرض' : 'No articles match your criteria'}</h3>
                        <p className="text-muted fs-5 mb-4">{isRtl ? 'يرجى تغيير فلاتر البحث والمحاولة مرة أخرى.' : 'Try adjusting your search or category filters.'}</p>
                        <button className="btn btn-dark rounded-pill px-5 py-3 fw-bold shadow hover-translate" onClick={() => { setSearchTerm(''); setSelectedCategory('all'); }}>
                            <i className="fas fa-sync-alt me-2"></i> {isRtl ? 'إعادة تعيين' : 'Reset All'}
                        </button>
                    </div>
                )}
            </div>

            {/* Ultra-Premium Glass Offcanvas Reading Panel */}
            <div className={`reading-panel position-fixed top-0 ${isRtl ? 'start-0' : 'end-0'} h-100 ${isPanelOpen ? 'open' : ''}`} style={{ zIndex: 1050, width: '100%', maxWidth: '800px', transition: 'transform 0.5s cubic-bezier(0.19, 1, 0.22, 1)', transform: isPanelOpen ? 'translateX(0)' : (isRtl ? 'translateX(-100%)' : 'translateX(100%)') }}>

                {selectedArticle && (
                    <div className="h-100 bg-white shadow-2xl overflow-auto custom-scrollbar position-relative d-flex flex-column">

                        {/* Panel Header Actions */}
                        <div className="position-absolute top-0 w-100 p-4 d-flex justify-content-between align-items-center z-index-10" style={{ pointerEvents: 'none' }}>
                            <div className="d-flex gap-2" style={{ pointerEvents: 'auto' }}>
                                <button className="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style={{ width: '45px', height: '45px', backdropFilter: 'blur(10px)', background: 'rgba(255,255,255,0.8)' }}>
                                    <i className="fas fa-bookmark text-primary"></i>
                                </button>
                                <button className="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style={{ width: '45px', height: '45px', backdropFilter: 'blur(10px)', background: 'rgba(255,255,255,0.8)' }}>
                                    <i className="fas fa-share-alt text-primary"></i>
                                </button>
                            </div>
                            <button onClick={closeArticle} className="btn btn-dark rounded-circle shadow-lg d-flex align-items-center justify-content-center hover-scale" style={{ width: '50px', height: '50px', pointerEvents: 'auto' }}>
                                <i className="fas fa-times fs-5"></i>
                            </button>
                        </div>

                        {/* Article Cover */}
                        <div className="position-relative w-100" style={{ height: '450px' }}>
                            <img src={selectedArticle.image} className="w-100 h-100 object-cover" alt={selectedArticle.title[lang]} />
                            <div className="position-absolute w-100 h-100 top-0 start-0" style={{ background: 'linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%)' }}></div>
                        </div>

                        {/* Article Body */}
                        <div className="px-4 px-md-5 pb-5 position-relative" style={{ marginTop: '-100px', zIndex: 5 }}>
                            <div className="bg-white rounded-5 p-4 p-md-5 shadow-sm border border-black border-opacity-10">
                                <div className="mb-4">
                                    <span className="badge bg-primary text-white px-3 py-2 rounded-pill fw-bold me-2">
                                        {t(`articles_page.categories.${selectedArticle.category}`)}
                                    </span>
                                    <span className="text-muted fw-bold small"><i className="far fa-clock me-1"></i> {selectedArticle.readTime}</span>
                                </div>

                                <h1 className="display-4 fw-black text-dark mb-4" style={{ lineHeight: '1.2', letterSpacing: '-1px' }}>
                                    {selectedArticle.title[lang]}
                                </h1>

                                <div className="d-flex align-items-center mb-5 pb-4 border-bottom">
                                    <div className="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style={{ width: '55px', height: '55px', fontSize: '1.5rem' }}>
                                        {selectedArticle.author.name.charAt(0)}
                                    </div>
                                    <div className={`ms-3 ${isRtl ? 'me-3 ms-0' : ''}`}>
                                        <div className="fw-black fs-5 text-dark">{selectedArticle.author.name}</div>
                                        <div className="text-muted">{selectedArticle.author.role} • {selectedArticle.date}</div>
                                    </div>
                                </div>

                                <div className="article-body-text" style={{ fontSize: '1.25rem', lineHeight: '2.1', color: '#374151' }}>
                                    <p className="lead fw-bold text-dark mb-5 border-start border-4 border-primary ps-4 py-2" style={{ fontStyle: 'italic', fontSize: '1.4rem' }}>
                                        {selectedArticle.excerpt[lang]}
                                    </p>

                                    {selectedArticle.content[lang].split('\n\n').map((para, i) => (
                                        <p key={i} className="mb-4">{para}</p>
                                    ))}
                                </div>

                                <div className="mt-5 pt-5 border-top text-center">
                                    <h4 className="fw-bold mb-4">{isRtl ? 'هل أعجبك المقال؟ شاركه مع شبكتك' : 'Enjoyed this article? Share it with your network'}</h4>
                                    <div className="d-flex justify-content-center gap-3">
                                        <button className="btn btn-outline-primary rounded-circle" style={{ width: '50px', height: '50px' }}><i className="fab fa-linkedin-in"></i></button>
                                        <button className="btn btn-outline-info rounded-circle" style={{ width: '50px', height: '50px' }}><i className="fab fa-twitter"></i></button>
                                        <button className="btn btn-outline-dark rounded-circle" style={{ width: '50px', height: '50px' }}><i className="fas fa-link"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                )}
            </div>

            {/* Reading Panel Backdrop */}
            <div
                className={`panel-backdrop position-fixed top-0 start-0 w-100 h-100 bg-dark ${isPanelOpen ? 'visible' : ''}`}
                style={{
                    zIndex: 1040,
                    opacity: isPanelOpen ? 0.6 : 0,
                    visibility: isPanelOpen ? 'visible' : 'hidden',
                    transition: 'opacity 0.4s ease',
                    backdropFilter: 'blur(8px)'
                }}
                onClick={closeArticle}
            ></div>

            <style dangerouslySetInnerHTML={{
                __html: `
                .fw-black { font-weight: 900; }
                .text-transparent { color: transparent; }
                .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
                .w-md-60 { width: 100%; }
                @media (min-width: 768px) { .w-md-60 { width: 60%; } }
                
                /* Filter Pills */
                .filter-pill {
                    background: rgba(255,255,255,0.8);
                    backdrop-filter: blur(10px);
                }
                .filter-pill.active-pill {
                    background: var(--primary) !important;
                    color: white;
                    border-color: var(--primary) !important;
                    transform: translateY(-3px);
                }
                .filter-pill.inactive-pill:hover {
                    background: white;
                    transform: translateY(-2px);
                }

                /* Animations */
                .slide-up-anim { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateY(30px); }
                .slide-up-anim-delay { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards; opacity: 0; transform: translateY(30px); }
                .slide-up-anim-delay-2 { animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s forwards; opacity: 0; transform: translateY(30px); }
                .fade-in-up { animation: slideUp 0.8s ease forwards; opacity: 0; transform: translateY(20px); }
                
                @keyframes slideUp {
                    to { opacity: 1; transform: translateY(0); }
                }

                /* Card Interactivity */
                .bento-card:hover {
                    box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important;
                }
                .bento-card:hover .article-img {
                    transform: scale(1.08);
                }
                .bento-card:hover .card-title-hover {
                    color: var(--primary) !important;
                }
                .bento-card:hover .read-more-btn {
                    transform: translateX(${isRtl ? '-5px' : '5px'});
                }
                .article-img { transition: transform 0.6s cubic-bezier(0.25, 1, 0.25, 1); }
                .gradient-overlay { background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 100%); opacity: 0.6; transition: opacity 0.3s; }
                .bento-card:hover .gradient-overlay { opacity: 0.8; }
                .read-more-btn { transition: transform 0.3s ease; }
                
                .hover-scale { transition: transform 0.2s; }
                .hover-scale:hover { transform: scale(1.1); }
                .hover-translate { transition: transform 0.3s ease; }
                .hover-translate:hover { transform: translateY(-5px); }

                /* Scrollbar */
                .custom-scrollbar::-webkit-scrollbar { width: 8px; }
                .custom-scrollbar::-webkit-scrollbar-track { background: #f8f9fa; }
                .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
                .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
                
                /* Typography enhancements */
                .article-body-text p:first-of-type::first-letter {
                    font-size: 4rem;
                    font-weight: 900;
                    float: ${isRtl ? 'right' : 'left'};
                    line-height: 0.8;
                    margin: 0.1em 0.15em 0 0;
                    color: var(--primary);
                }
                
                .cursor-pointer { cursor: pointer; }
                .pointer-events-none { pointer-events: none; }
                .object-cover { object-fit: cover; }
                .z-index-2 { z-index: 2; }
                .z-index-10 { z-index: 10; }
            `}} />
        </div>
    );
};

export default Articles;
