import React, { useState, useEffect, useMemo } from 'react';
import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { getCareerImage } from '../utils/images';
import { jobsService } from '../services/jobsService';
import { Carousel } from 'bootstrap';
import './Home.css';
const Home = () => {
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');
    const [jobs, setJobs] = useState([]);
    const [loading, setLoading] = useState(true);
    // Advanced Filter State
    const [searchTerm, setSearchTerm] = useState('');
    const [selectedCategory, setSelectedCategory] = useState('all');
    const [selectedLevel, setSelectedLevel] = useState('all');


    // ── Dynamically extract all unique industries/sectors from loaded jobs ──
    const uniqueIndustries = useMemo(() => {
        const seen = new Set();
        jobs.forEach(job => {
            const sector = job.industry || job.career_path?.name;
            if (sector) seen.add(sector);
        });
        return Array.from(seen).sort();
    }, [jobs]);

    const uniqueLevels = useMemo(() => {
        const levels = new Set();
        jobs.forEach(job => {
            if (job.level) levels.add(job.level);
        });
        return Array.from(levels);
    }, [jobs]);

    useEffect(() => {
        const loadJobs = async () => {
            setLoading(true);
            try {
                const data = await jobsService.fetchJobs();
                setJobs(data);
            } catch (error) {
                console.error('Error loading jobs:', error);
            } finally {
                setLoading(false);
            }
        };
        loadJobs();
    }, []);

    const filteredJobs = useMemo(() => {
        return jobs.filter(job => {
            const matchesCategory = selectedCategory === 'all' || job.industry === selectedCategory;
            const matchesLevel = selectedLevel === 'all' || job.level === selectedLevel;
            
            const searchLower = searchTerm.toLowerCase().trim();
            const matchesSearch = !searchLower || 
                (job.title && job.title.toLowerCase().includes(searchLower)) || 
                (job.description && job.description.toLowerCase().includes(searchLower)) ||
                (job.company && job.company.toLowerCase().includes(searchLower)) ||
                (job.career_path && job.career_path.name && job.career_path.name.toLowerCase().includes(searchLower));

            return matchesCategory && matchesLevel && matchesSearch;
        });
    }, [jobs, selectedCategory, selectedLevel, searchTerm]);

    useEffect(() => {
        const carouselEl = document.getElementById('heroCarousel');
        let carousel = null;
        if (carouselEl) {
            carousel = new Carousel(carouselEl, {
                interval: 3000,
                ride: 'carousel'
            });
            carousel.cycle();
        }
        return () => {
            if (carousel) {
                carousel.dispose();
            }
        };
    }, [isRtl]);

    // ── helper: convert ISO date string to "X ago" ──
    const timeAgo = (dateStr) => {
        if (!dateStr) return '';
        const seconds = Math.floor((Date.now() - new Date(dateStr)) / 1000);
        if (seconds < 60)   return seconds + (isRtl ? ' ث' : 's ago');
        const m = Math.floor(seconds / 60);
        if (m < 60)         return m + (isRtl ? ' د' : 'm ago');
        const h = Math.floor(m / 60);
        if (h < 24)         return h + (isRtl ? ' س' : 'h ago');
        const d = Math.floor(h / 24);
        if (d < 30)         return d + (isRtl ? ' يوم' : 'd ago');
        const mo = Math.floor(d / 30);
        if (mo < 12)        return mo + (isRtl ? ' شهر' : 'mo ago');
        return Math.floor(mo / 12) + (isRtl ? ' سنة' : 'y ago');
    };

    return (
        <div className={`home-page ${isRtl ? 'text-end' : 'text-start'}`}>
            {/* Hero Section */}
            <div className="container-fluid px-0 hero-header overflow-hidden">
                <div className="container-fluid px-lg-5">
                    <div className="row g-5 align-items-center">
                        <div className="col-md-12 col-lg-7 d-flex flex-column align-items-center text-center">
                            <h4 className="mb-3 text-secondary fw-bold" style={{ letterSpacing: '2px' }}>{t('hero.subtitle')}</h4>
                            <h1 className="mb-4 display-3 text-primary fw-extra-bold" style={{ lineHeight: '1.2' }}>{t('hero.title')}</h1>
                            <p className="fs-5 mb-5 w-100 mx-auto" style={{ maxWidth: '600px' }}>{t('hero.description')}</p>

                            <div className="search-container mt-2 w-100 mx-auto" style={{ maxWidth: '700px' }}>
                                <div className="search-wrapper d-flex align-items-center bg-white rounded-pill shadow-xl p-2 border border-2 border-primary">
                                    <div className={isRtl ? 'pe-4' : 'ps-4'}>
                                        <i className="fas fa-search text-primary fs-4"></i>
                                    </div>
                                    <input
                                        type="text"
                                        className={`form-control border-0 bg-transparent py-3 ${isRtl ? 'text-end' : ''}`}
                                        placeholder={t('hero.search_placeholder')}
                                        style={{ fontSize: '1.2rem', boxShadow: 'none' }}
                                    />
                                    <button className="btn btn-primary rounded-pill h-100 px-5 fw-bold ms-auto transition-all shadow-lg hover-scale">
                                        {t('hero.search_button')}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div className={`col-12 col-lg-5 ${isRtl ? 'ps-lg-5' : 'pe-lg-5'} mt-5 mt-lg-0`}>
                            <div id="heroCarousel" className="carousel slide shadow-2xl rounded-4 overflow-hidden border border-primary border-4">
                                <div className="carousel-indicators">
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" className="active"></button>
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                                </div>
                                <div className="carousel-inner" role="listbox">
                                    <div className="carousel-item active rounded" data-bs-interval="3000">
                                        <div className="position-relative">
                                            <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80" className="img-fluid w-100 bg-secondary hero-slide-img" alt="Career" />
                                            <div className={`position-absolute bottom-0 start-0 w-100 p-4 p-md-5 text-white d-flex align-items-center gap-4 transition-all ${isRtl ? 'flex-row-reverse text-end' : 'text-start'}`}
                                                style={{ background: 'var(--glass-bg)', backdropFilter: 'blur(6px)' }}>
                                                <div className="bg-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-lg" style={{ width: '55px', height: '55px', opacity: 0.9 }}>
                                                    <i className="fas fa-rocket text-white fa-lg"></i>
                                                </div>
                                                <div style={{ textShadow: '0 2px 4px rgba(0,0,0,0.5)' }}>
                                                    <p className="mb-1 fw-bold" style={{ fontSize: '1.5rem', letterSpacing: '0.5px' }}>{t('hero.carousel.empowering')}</p>
                                                    <p className="mb-0 text-white" style={{ fontSize: '1rem', fontWeight: '500' }}>{t('hero.carousel.career_step')}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="carousel-item rounded" data-bs-interval="3000">
                                        <div className="position-relative">
                                            <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?auto=format&fit=crop&w=1200&q=80" className="img-fluid w-100 bg-secondary hero-slide-img" alt="Success" />
                                            <div className={`position-absolute bottom-0 start-0 w-100 p-4 p-md-5 text-white d-flex align-items-center gap-4 transition-all ${isRtl ? 'flex-row-reverse text-end' : 'text-start'}`}
                                                style={{ background: 'var(--glass-bg)', backdropFilter: 'blur(6px)' }}>
                                                <div className="bg-success rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-lg" style={{ width: '55px', height: '55px', opacity: 0.9 }}>
                                                    <i className="fas fa-check-double text-white fa-lg"></i>
                                                </div>
                                                <div style={{ textShadow: '0 2px 4px rgba(0,0,0,0.5)' }}>
                                                    <p className="mb-1 fw-bold" style={{ fontSize: '1.5rem', letterSpacing: '0.5px' }}>{t('hero.carousel.promising')}</p>
                                                    <p className="mb-0 text-white" style={{ fontSize: '1rem', fontWeight: '500' }}>{t('hero.carousel.success_path')}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="carousel-item rounded" data-bs-interval="3000">
                                        <div className="position-relative">
                                            <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1200&q=80" className="img-fluid w-100 bg-secondary hero-slide-img" alt="Consultation" />
                                            <div className={`position-absolute bottom-0 start-0 w-100 p-4 p-md-5 text-white d-flex align-items-center gap-4 transition-all ${isRtl ? 'flex-row-reverse text-end' : 'text-start'}`}
                                                style={{ background: 'var(--glass-bg)', backdropFilter: 'blur(6px)' }}>
                                                <div className="bg-info rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-lg" style={{ width: '55px', height: '55px', opacity: 0.9 }}>
                                                    <i className="fas fa-user-tie text-white fa-lg"></i>
                                                </div>
                                                <div style={{ textShadow: '0 2px 4px rgba(0,0,0,0.5)' }}>
                                                    <p className="mb-1 fw-bold" style={{ fontSize: '1.5rem', letterSpacing: '0.5px' }}>{t('hero.carousel.guidance')}</p>
                                                    <p className="mb-0 text-white" style={{ fontSize: '1rem', fontWeight: '500' }}>{t('hero.carousel.expert_talk')}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button className="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                    <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span className="visually-hidden">{t('hero.carousel.prev')}</span>
                                </button>
                                <button className="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                    <span className="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span className="visually-hidden">{t('hero.carousel.next')}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Features Section */}
            <div className="container-fluid py-5 bg-white position-relative" style={{ zIndex: 10, marginTop: '-60px' }}>
                <div className="container py-lg-4">
                    <div className="row g-4 justify-content-center">
                        <div className="col-md-6 col-lg-3">
                            <div className="featurs-item text-center rounded-4 bg-white p-5 shadow-lg border-0 h-100 transition-all hover-translate">
                                <div className="featurs-icon btn-square rounded-circle bg-primary-soft mb-4 mx-auto d-flex align-items-center justify-content-center" style={{ width: '90px', height: '90px' }}>
                                    <i className="fas fa-graduation-cap fa-3x text-primary"></i>
                                </div>
                                <div className="featurs-content">
                                    <h5 className="fw-bold mb-3">{t('features.growth.title')}</h5>
                                    <p className="mb-0 text-muted small px-3">{t('features.growth.desc')}</p>
                                </div>
                            </div>
                        </div>
                        <div className="col-md-6 col-lg-3">
                            <div className="featurs-item text-center rounded-4 bg-white p-5 shadow-lg border-0 h-100 transition-all hover-translate">
                                <div className="featurs-icon btn-square rounded-circle bg-primary-soft mb-4 mx-auto d-flex align-items-center justify-content-center" style={{ width: '90px', height: '90px' }}>
                                    <i className="fas fa-user-shield fa-3x text-primary"></i>
                                </div>
                                <div className="featurs-content">
                                    <h5 className="fw-bold mb-3">{t('features.secure.title')}</h5>
                                    <p className="mb-0 text-muted small px-3">{t('features.secure.desc')}</p>
                                </div>
                            </div>
                        </div>
                        <div className="col-md-6 col-lg-3">
                            <div className="featurs-item text-center rounded-4 bg-white p-5 shadow-lg border-0 h-100 transition-all hover-translate">
                                <div className="featurs-icon btn-square rounded-circle bg-primary-soft mb-4 mx-auto d-flex align-items-center justify-content-center" style={{ width: '90px', height: '90px' }}>
                                    <i className="fas fa-brain fa-3x text-primary"></i>
                                </div>
                                <div className="featurs-content">
                                    <h5 className="fw-bold mb-3">{t('features.ai.title')}</h5>
                                    <p className="mb-0 text-muted small px-3">{t('features.ai.desc')}</p>
                                </div>
                            </div>
                        </div>
                        <div className="col-md-6 col-lg-3">
                            <div className="featurs-item text-center rounded-4 bg-white p-5 shadow-lg border-0 h-100 transition-all hover-translate">
                                <div className="featurs-icon btn-square rounded-circle bg-primary-soft mb-4 mx-auto d-flex align-items-center justify-content-center" style={{ width: '90px', height: '90px' }}>
                                    <i className="fas fa-headset fa-3x text-primary"></i>
                                </div>
                                <div className="featurs-content">
                                    <h5 className="fw-bold mb-3">{t('features.support.title')}</h5>
                                    <p className="mb-0 text-muted small px-3">{t('features.support.desc')}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Industries Section */}
            <div className={`container-fluid py-5 industries-section ${isRtl ? 'text-end' : 'text-start'}`}>
                <div className="container py-5">
                    <div className="text-center mx-auto mb-5 animate-fade-in" style={{ maxWidth: '700px' }}>
                        <h1 className="display-4 fw-bold text-primary mb-3">{t('industries.title')}</h1>
                        <p className="text-muted fs-5">{t('industries.subtitle')}</p>
                    </div>


                    {/* ━━━━━━  Advanced Glassmorphism Filter Bar  ━━━━━━ */}
                    <div className="advanced-filter-wrapper mx-auto mb-4" style={{ maxWidth: '1100px' }}>

                        {/* Top Row: Search */}
                        <div className="filter-glass-card">
                            <div className="row g-3 align-items-center">
                                {/* Search Box */}
                                <div className="col-12 col-lg-5">
                                    <div className="filter-input-group">
                                        <span className="filter-icon-left"><i className="fas fa-search"></i></span>
                                        <input
                                            type="text"
                                            className="filter-input"
                                            placeholder={isRtl ? 'ابحث بالمسمى، الشركة، الوصف...' : 'Search by title, company, description…'}
                                            value={searchTerm}
                                            onChange={(e) => setSearchTerm(e.target.value)}
                                        />
                                        {searchTerm && (
                                            <button className="filter-clear-btn" onClick={() => setSearchTerm('')}>
                                                <i className="fas fa-times"></i>
                                            </button>
                                        )}
                                    </div>
                                </div>

                                {/* Category */}
                                <div className="col-12 col-sm-6 col-lg-3">
                                    <div className="filter-select-wrapper">
                                        <i className="fas fa-layer-group filter-select-icon"></i>
                                        <select
                                            className="filter-select"
                                            value={selectedCategory}
                                            onChange={(e) => setSelectedCategory(e.target.value)}
                                        >
                                            <option value="all">{isRtl ? '🌐 جميع القطاعات' : '🌐 All Sectors'}</option>
                                            {uniqueIndustries.map(ind => (
                                                <option key={ind} value={ind}>{ind}</option>
                                            ))}
                                        </select>
                                    </div>
                                </div>

                                {/* Level */}
                                <div className="col-12 col-sm-6 col-lg-3">
                                    <div className="filter-select-wrapper">
                                        <i className="fas fa-chart-bar filter-select-icon"></i>
                                        <select
                                            className="filter-select"
                                            value={selectedLevel}
                                            onChange={(e) => setSelectedLevel(e.target.value)}
                                        >
                                            <option value="all">{isRtl ? '📊 جميع المستويات' : '📊 All Levels'}</option>
                                            {uniqueLevels.map(lvl => (
                                                <option key={lvl} value={lvl}>{lvl}</option>
                                            ))}
                                        </select>
                                    </div>
                                </div>

                                {/* Reset */}
                                <div className="col-12 col-lg-1 d-flex justify-content-center">
                                    <button
                                        className="filter-reset-btn"
                                        onClick={() => { setSearchTerm(''); setSelectedCategory('all'); setSelectedLevel('all'); }}
                                        title={isRtl ? 'إعادة الضبط' : 'Reset'}
                                    >
                                        <i className="fas fa-redo-alt"></i>
                                    </button>
                                </div>
                            </div>

                            {/* Results Count Bar */}
                            <div className="filter-results-bar">
                                <span className="filter-results-count">
                                    <i className="fas fa-briefcase me-2"></i>
                                    {filteredJobs.length}
                                    <span className="ms-1">{isRtl ? 'وظيفة متاحة' : (filteredJobs.length === 1 ? 'job found' : 'jobs found')}</span>
                                </span>
                                {(searchTerm || selectedCategory !== 'all' || selectedLevel !== 'all') && (
                                    <span className="filter-active-badge">
                                        <i className="fas fa-filter me-1"></i>
                                        {isRtl ? 'فلتر مفعّل' : 'Filters Active'}
                                    </span>
                                )}
                            </div>
                        </div>

                        <div className="tab-content">
                            {loading ? (
                                <div className="text-center py-5">
                                    <div className="spinner-border text-primary" role="status" style={{ width: '3rem', height: '3rem' }}>
                                        <span className="visually-hidden">Loading...</span>
                                    </div>
                                    <p className="text-muted mt-3 fw-bold">{isRtl ? 'جاري تحميل الوظائف...' : 'Loading opportunities…'}</p>
                                </div>
                            ) : (
                                <div className="row g-4 animate-fade-in">
                                    {filteredJobs.length > 0 ? (
                                        filteredJobs.map((job) => (
                                            <div className="col-md-6 col-lg-4" key={job.id}>
                                                <div className="career-card-v2 border-0">
                                                    {/* Card Image */}
                                                    <div className="cv2-img-wrapper">
                                                        <img
                                                            src={getCareerImage(job.id, job.title)}
                                                            alt={job.title}
                                                            className="cv2-img"
                                                            onError={(e) => {
                                                                e.target.onerror = null;
                                                                e.target.src = 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=800&q=80';
                                                            }}
                                                        />
                                                        {/* Industry badge */}
                                                        <span className="cv2-industry-badge">{job.industry || job.career_path?.name || '—'}</span>
                                                        {/* Level badge */}
                                                        {job.level && (
                                                            <span className={`cv2-level-badge ${job.level?.toLowerCase() === 'senior' ? 'cv2-level-senior' : 'cv2-level-junior'}`}>
                                                                {job.level}
                                                            </span>
                                                        )}
                                                    </div>

                                                    {/* Card Body */}
                                                    <div className="cv2-body">
                                                        <h4 className="cv2-title">{job.title}</h4>

                                                        {/* Meta: Company & Location */}
                                                        <div className="cv2-meta">
                                                            {job.company && (
                                                                <span className="cv2-meta-item">
                                                                    <i className="fas fa-building"></i> {job.company}
                                                                </span>
                                                            )}
                                                            {job.location && (
                                                                <span className="cv2-meta-item">
                                                                    <i className="fas fa-map-marker-alt"></i> {job.location}
                                                                </span>
                                                            )}
                                                            {job.created_at && (
                                                                <span className="cv2-meta-item">
                                                                    <i className="fas fa-clock"></i> {timeAgo(job.created_at)}
                                                                </span>
                                                            )}
                                                        </div>

                                                        {/* Description */}
                                                        {job.description && (
                                                            <p className="cv2-desc">
                                                                {job.description.length > 110
                                                                    ? job.description.slice(0, 110) + '…'
                                                                    : job.description}
                                                            </p>
                                                        )}

                                                        {/* Footer */}
                                                        <div className="cv2-footer">
                                                            {job.salary_range ? (
                                                                <span className="cv2-salary">
                                                                    <i className="fas fa-dollar-sign me-1"></i>{job.salary_range}
                                                                </span>
                                                            ) : <span></span>}
                                                            <Link
                                                                to={`/jobs/${job.id}`}
                                                                className="cv2-details-btn"
                                                            >
                                                                {isRtl ? 'التفاصيل' : 'Details'}
                                                                <i className={`fas fa-arrow-${isRtl ? 'left' : 'right'} ms-1`}></i>
                                                            </Link>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ))
                                    ) : (
                                        <div className="col-12">
                                            <div className="no-results-box text-center py-5">
                                                <i className="fas fa-search-minus fa-3x text-muted mb-3"></i>
                                                <h5 className="text-muted fw-bold">{isRtl ? 'لم يتم العثور على وظائف' : 'No jobs found'}</h5>
                                                <p className="text-muted">{isRtl ? 'جرب تغيير معايير البحث أو الفلتر' : 'Try adjusting your search or filters'}</p>
                                            </div>
                                        </div>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Home;
