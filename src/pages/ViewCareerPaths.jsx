import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { jobsService } from '../services/jobsService';
import { useDebounce } from '../hooks/useDebounce';
import { authService } from '../services/authService';
import { useTranslation } from 'react-i18next';
import { getCareerImage, DEFAULT_CAREER_IMAGE } from '../utils/images';
import './Home.css';
const ViewCareerPaths = () => {
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');
    const [paths, setPaths] = useState([]);
    const [loading, setLoading] = useState(true);
    const [searchTerm, setSearchTerm] = useState('');
    const [selectedIndustry, setSelectedIndustry] = useState('');
    const [selectedCareer, setSelectedCareer] = useState(null);
    const isAdmin = authService.isAdmin();

    // Use debounced search term to avoid excessive re-filtering
    const debouncedSearch = useDebounce(searchTerm, 300);

    useEffect(() => {
        loadJobs();
    }, []);

    const loadJobs = async () => {
        setLoading(true);
        try {
            const data = await jobsService.fetchJobs();
            setPaths(data);
        } catch (error) {
            console.error("Failed to load jobs:", error);
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id) => {
        if (window.confirm(t('browse.confirm_delete'))) {
            await jobsService.deleteJob(id);
            loadJobs();
        }
    };

    const handleShowDetails = (path) => {
        setSelectedCareer(path);
    };

    const handleImageError = (e) => {
        e.target.onerror = null; // Prevent infinite loop
        e.target.src = DEFAULT_CAREER_IMAGE;
    };

    const getFieldIcon = (industry) => {
        const ind = (industry || '').toLowerCase();
        if (ind.includes('software') || ind.includes('engineering') || ind.includes('dev')) return 'fas fa-laptop-code';
        if (ind.includes('data') || ind.includes('science') || ind.includes('analysis')) return 'fas fa-chart-pie';
        if (ind.includes('marketing') || ind.includes('advertising') || ind.includes('market')) return 'fas fa-bullhorn';
        if (ind.includes('design') || ind.includes('creative') || ind.includes('ui') || ind.includes('ux')) return 'fas fa-palette';
        return 'fas fa-briefcase';
    };

    // Helper: Convert ISO date string to "X ago"
    const timeAgo = (dateStr) => {
        if (!dateStr) return '';
        const seconds = Math.floor((new Date() - new Date(dateStr)) / 1000);
        let interval = seconds / 31536000;
        if (interval > 1) return Math.floor(interval) + (isRtl ? ' سنة' : 'y ago');
        interval = seconds / 2592000;
        if (interval > 1) return Math.floor(interval) + (isRtl ? ' شهر' : 'm ago');
        interval = seconds / 86400;
        if (interval > 1) return Math.floor(interval) + (isRtl ? ' يوم' : 'd ago');
        interval = seconds / 3600;
        if (interval > 1) return Math.floor(interval) + (isRtl ? ' س' : 'h ago');
        interval = seconds / 60;
        if (interval > 1) return Math.floor(interval) + (isRtl ? ' د' : 'm ago');
        return Math.floor(seconds) + (isRtl ? ' ث' : 's ago');
    };

    // Dynamically derive industry list from current data
    const industries = jobsService.getUniqueCategories(paths);

    const filteredPaths = paths.filter(path => {
        const translatedTitle = t(`industries.roles.${path.id}`, path.title);
        const translatedIndustry = t(`industries.tabs.${path.id}`, path.industry);

        const matchesSearch = (path.title || '').toLowerCase().includes(debouncedSearch.toLowerCase()) ||
            (translatedTitle || '').toLowerCase().includes(debouncedSearch.toLowerCase()) ||
            (path.skills || []).some(skill => skill.toLowerCase().includes(debouncedSearch.toLowerCase()));

        const matchesIndustry = selectedIndustry === '' ||
            path.industry === selectedIndustry ||
            translatedIndustry === selectedIndustry ||
            (path.industry === 'Software Engineering' && selectedIndustry === t('industries.tabs.dev')) ||
            (path.industry === 'Data Science' && selectedIndustry === t('industries.tabs.data')) ||
            (path.industry === 'Strategic Marketing' && selectedIndustry === t('industries.tabs.marketing')) ||
            (path.industry === 'Creative Design' && selectedIndustry === t('industries.tabs.design'));

        return matchesSearch && matchesIndustry;
    });

    return (
        <div className={`container-fluid py-5 mt-5 ${isRtl ? 'text-end' : 'text-start'}`}>
            <div className="container py-5">
                <div className="text-center mx-auto mb-5" style={{ maxWidth: '800px' }}>
                    <h1 className="display-3 text-primary fw-extra-bold mb-3" style={{ letterSpacing: '-1px' }}>
                        {t('browse.title')}
                    </h1>
                    <p className="lead text-muted px-lg-5">{t('browse.subtitle')}</p>
                </div>

                {/* Unified Search Section */}
                <div className="mb-5">
                    <div className="unified-search-container">
                        <div className="search-input-group">
                            <i className="fas fa-search text-primary"></i>
                            <input
                                type="text"
                                className="premium-input"
                                placeholder={t('browse.search_placeholder')}
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                        </div>
                        <div className="dropdown-input-group">
                            <i className="fas fa-filter text-primary me-2 ms-0 ms-rtl-2"></i>
                            <select
                                className="premium-select-inline"
                                value={selectedIndustry}
                                onChange={(e) => setSelectedIndustry(e.target.value)}
                            >
                                <option value="">{t('browse.all_industries')}</option>
                                {industries.map(ind => (
                                    <option key={ind} value={ind}>{ind}</option>
                                ))}
                            </select>
                        </div>
                        <div className="p-1">
                            {isAdmin ? (
                                <Link to="/add-career" className="btn btn-primary unified-search-btn h-100 d-flex align-items-center">
                                    <i className={`fas fa-plus ${isRtl ? 'ms-2' : 'me-2'}`}></i> {t('browse.add_new')}
                                </Link>
                            ) : (
                                <button
                                    className="btn btn-primary unified-search-btn h-100"
                                    onClick={loadJobs}
                                >
                                    <i className={`fas fa-sync ${isRtl ? 'ms-2' : 'me-2'}`}></i> {t('hero.search_button')}
                                </button>
                            )}
                        </div>
                    </div>
                </div>

                {/* Results Count Bar & Grid */}
                <div className="filter-results-bar mb-4 border-0 pt-0">
                    <span className="filter-results-count ms-2">
                        <i className="fas fa-briefcase me-2"></i>
                        {filteredPaths.length}
                        <span className="ms-1">{isRtl ? 'مسار متوفر' : 'Paths Available'}</span>
                    </span>
                </div>

                <div className="row g-4 min-vh-50">
                    {loading ? (
                        <div className="col-12 text-center py-5">
                            <div className="spinner-border text-primary" role="status" style={{ width: '3rem', height: '3rem' }}>
                                <span className="visually-hidden">Loading...</span>
                            </div>
                            <p className="mt-3 text-muted fw-bold">تحميل المسارات المهنية...</p>
                        </div>
                    ) : filteredPaths.length > 0 ? (
                        filteredPaths.map((path) => (
                            <div key={path.id} className="col-lg-4 col-md-6">
                                <div className="career-card-v2 border-0">
                                    {/* Card Image */}
                                    <div className="cv2-img-wrapper">
                                        <img
                                            src={path.image || getCareerImage(path.id, path.title)}
                                            className="cv2-img"
                                            alt={t(`industries.roles.${path.id}`, path.title)}
                                            onError={handleImageError}
                                        />
                                        <span className="cv2-industry-badge">
                                            {t(`industries.tabs.${path.id}`, path.industry)}
                                        </span>
                                        {path.level && (
                                            <span className={`cv2-level-badge ${path.level?.toLowerCase() === 'senior' ? 'cv2-level-senior' : 'cv2-level-junior'}`}>
                                                {path.level}
                                            </span>
                                        )}
                                    </div>

                                    {/* Card Body */}
                                    <div className="cv2-body">
                                        <h4 className="cv2-title">{t(`industries.roles.${path.id}`, path.title)}</h4>

                                        {/* Meta: Company / Location / Time */}
                                        <div className="cv2-meta">
                                            {path.company && (
                                                <span className="cv2-meta-item">
                                                    <i className="fas fa-building"></i> {path.company}
                                                </span>
                                            )}
                                            {path.location && (
                                                <span className="cv2-meta-item">
                                                    <i className="fas fa-map-marker-alt"></i> {path.location}
                                                </span>
                                            )}
                                            {path.created_at && (
                                                <span className="cv2-meta-item">
                                                    <i className="fas fa-clock"></i> {timeAgo(path.created_at)}
                                                </span>
                                            )}
                                        </div>

                                        {/* Description */}
                                        <p className="cv2-desc">
                                            {t(`industries.roles.${path.id}_desc`, path.description).length > 110
                                                ? t(`industries.roles.${path.id}_desc`, path.description).slice(0, 110) + '…'
                                                : t(`industries.roles.${path.id}_desc`, path.description)}
                                        </p>

                                        {/* Footer */}
                                        <div className="cv2-footer flex-wrap gap-2 mt-auto">
                                            <Link
                                                to={`/jobs/${path.id}`}
                                                className="cv2-details-btn border-0 shadow-sm"
                                            >
                                                {t('browse.details')}
                                                <i className={`fas fa-search-plus ms-1`}></i>
                                            </Link>
                                            
                                            <div className="d-flex gap-2 ms-auto">
                                                <Link to="/recommendation" className="btn btn-sm btn-light rounded-circle shadow-sm" title={t('nav.recommendation')} style={{ width: '36px', height: '36px', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                                                    <i className={`${getFieldIcon(path.industry || path.id || path.category)} text-primary`}></i>
                                                </Link>
                                                {isAdmin && (
                                                    <>
                                                        <button className="btn btn-sm btn-light rounded-circle shadow-sm text-warning" title="Edit" style={{ width: '36px', height: '36px', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                                                            <i className="fas fa-edit"></i>
                                                        </button>
                                                        <button
                                                            onClick={() => handleDelete(path.id)}
                                                            className="btn btn-sm btn-light rounded-circle shadow-sm text-danger"
                                                            title="Delete"
                                                            style={{ width: '36px', height: '36px', display: 'flex', alignItems: 'center', justifyContent: 'center' }}
                                                        >
                                                            <i className="fas fa-trash"></i>
                                                        </button>
                                                    </>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))
                    ) : (
                        <div className="col-12 text-center py-5">
                            <div className="mb-4">
                                <div className="bg-light rounded-circle d-inline-flex align-items-center justify-content-center shadow-inner" style={{ width: '120px', height: '120px' }}>
                                    <i className="fas fa-search-minus fa-4x text-muted opacity-50"></i>
                                </div>
                            </div>
                            <h3 className="fw-bold ">{t('browse.no_results')}</h3>
                            <p className="text-muted fs-5">{t('browse.no_results_desc')}</p>
                            <button className="btn btn-primary rounded-pill px-5 py-3 mt-3 fw-bold" onClick={() => { setSearchTerm(''); setSelectedIndustry(''); }}>
                                <i className="fas fa-sync-alt me-2"></i> Clear All Filters
                            </button>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

export default ViewCareerPaths;


