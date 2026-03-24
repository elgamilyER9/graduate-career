import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { universityService } from '../services/universityService';
import './Home.css';

const Universities = () => {
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');
    
    const [universities, setUniversities] = useState([]);
    const [loading, setLoading] = useState(true);
    const [searchTerm, setSearchTerm] = useState('');

    useEffect(() => {
        const loadUniversities = async () => {
            setLoading(true);
            try {
                const data = await universityService.fetchUniversities();
                setUniversities(data);
            } catch (err) {
                console.error("Error loading universities:", err);
            } finally {
                setLoading(false);
            }
        };
        loadUniversities();
    }, []);

    const filteredUnis = universities.filter(uni => 
        uni.name?.toLowerCase().includes(searchTerm.toLowerCase()) || 
        uni.location?.toLowerCase().includes(searchTerm.toLowerCase())
    );

    // Fallback Image Map for common universities if name matches
    const getUniImage = (name) => {
        const lowerName = name?.toLowerCase() || '';
        if (lowerName.includes('mit')) return 'https://images.unsplash.com/photo-1541339907198-e08756ebafe3?w=800&auto=format&fit=crop&q=80';
        if (lowerName.includes('stanford')) return 'https://images.unsplash.com/photo-1576085898323-218337735fa7?w=800&auto=format&fit=crop&q=80';
        if (lowerName.includes('harvard')) return 'https://images.unsplash.com/photo-1514364845967-df5e67272782?w=800&auto=format&fit=crop&q=80';
        if (lowerName.includes('oxford')) return 'https://images.unsplash.com/photo-1590490359854-dfba1d261e44?w=800&auto=format&fit=crop&q=80';
        return 'https://images.unsplash.com/photo-1562774053-701939374585?w=800&auto=format&fit=crop&q=80'; // Default Tech Uni Image
    };

    return (
        <div className={`universities-page bg-light pb-5 ${isRtl ? 'text-end' : 'text-start'}`} style={{ minHeight: '100vh', perspective: '1000px' }}>
            {/* Advanced Hero Section */}
            <div className="position-relative overflow-hidden pt-5 mb-5" style={{ background: 'var(--hero-gradient)', minHeight: '450px' }}>
                <div className="position-absolute w-100 h-100 top-0 start-0" style={{ background: 'radial-gradient(circle at 10% 20%, rgba(255,255,255,0.05) 0%, transparent 40%)' }}></div>
                <div className="position-absolute bottom-0 start-0 w-100 overflow-hidden" style={{ height: '100px' }}>
                    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style={{ height: '100%', width: '100%', fill: '#f8f9fa' }}>
                        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
                    </svg>
                </div>

                <div className="container position-relative z-1 text-center text-white py-5">
                    <span className="badge bg-white text-primary px-4 py-2 rounded-pill fw-bold mb-4 shadow-sm animate__animated animate__fadeInDown">
                        <i className={`fas fa-university ${isRtl ? 'ms-2' : 'me-2'}`}></i>
                        {isRtl ? 'التميز الأكاديمي' : 'Academic Excellence'}
                    </span>
                    <h1 className="display-3 fw-black text-white mb-4 animate__animated animate__zoomIn" style={{ letterSpacing: '-2px', textShadow: '0 10px 20px rgba(0,0,0,0.2)' }}>
                        {isRtl ? 'أفضل الجامعات التكنولوجية' : 'Top Tech Universities'}
                    </h1>
                    <p className="lead text-white-50 mb-5 max-w-2xl mx-auto fs-4 animate__animated animate__fadeInUp">
                        {isRtl ? 'اكتشف أرقى المؤسسات التعليمية في العالم التي تشكل مستقبل تكنولوجيا المعلومات والابتكار.' : 'Explore the world\'s most prestigious educational institutions shaping the future of IT and innovation.'}
                    </p>

                    {/* Glassmorphism Quick Search */}
                    <div className="max-w-xl mx-auto position-relative animate__animated animate__fadeInUp" style={{ animationDelay: '0.3s' }}>
                        <div className="p-1 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-25 shadow-2xl backdrop-blur">
                            <div className="input-group input-group-lg rounded-pill overflow-hidden bg-white position-relative">
                                <span className="position-absolute top-50 translate-middle-y translate-middle-x-reverse" style={{ [isRtl ? 'right' : 'left']: '25px', color: 'var(--primary)', fontSize: '1.2rem' }}>
                                    <i className="bi bi-search"></i>
                                </span>
                                <input 
                                    type="text" 
                                    className="form-control form-control-lg border-0 bg-transparent text-dark fw-medium ps-5 pe-5 py-4 shadow-none" 
                                    placeholder={isRtl ? 'ابحث عن اسم الجامعة أو الموقع...' : 'Search university name or location...'}
                                    value={searchTerm}
                                    onChange={(e) => setSearchTerm(e.target.value)}
                                    style={{ [isRtl ? 'paddingRight' : 'paddingLeft']: '65px', fontSize: '1.1rem' }}
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Content Section */}
            <div className="container mt-n4 pb-5">
                {loading ? (
                    <div className="text-center py-5">
                        <div className="spinner-border text-primary" role="status" style={{ width: '3.5rem', height: '3.5rem' }}>
                            <span className="visually-hidden">Loading...</span>
                        </div>
                        <p className="mt-3 text-muted fw-bold">{isRtl ? 'جاري تحميل الجامعات...' : 'Loading Universities...'}</p>
                    </div>
                ) : (
                    <div className="row g-4 justify-content-center">
                        {filteredUnis.length > 0 ? (
                            filteredUnis.map((uni, idx) => (
                                <div key={uni.id} className="col-lg-4 col-md-6 animate__animated animate__fadeInUp" style={{ animationDelay: `${idx * 0.1}s` }}>
                                    <div 
                                        className="uni-advanced-card card h-100 border-0 shadow-lg rounded-5 overflow-hidden transition-all duration-300 hover-translate-up"
                                        style={{ background: '#fff' }}
                                    >
                                        <div className="position-relative overflow-hidden" style={{ height: '220px' }}>
                                            <img src={getUniImage(uni.name)} className="w-100 h-100 object-cover transition-transform duration-500 hover-scale-img" alt={uni.name} />
                                            <div className="position-absolute top-0 start-0 w-100 h-100" style={{ background: 'linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%)' }}></div>
                                            
                                            {/* Advanced Badge */}
                                            <div className="position-absolute top-0 end-0 m-4">
                                                <span className="badge bg-white bg-opacity-90 backdrop-blur text-primary rounded-pill px-3 py-2 fw-bold shadow-sm">
                                                    <i className="bi bi-mortarboard-fill me-2 ms-2"></i>
                                                    {isRtl ? 'شريك أكاديمي' : 'Academic Partner'}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div className="card-body p-4 d-flex flex-column text-center">
                                            <div className="uni-icon-square mx-auto mb-3 bg-white shadow-sm rounded-4 d-flex align-items-center justify-content-center" style={{ width: '60px', height: '60px', border: '1px solid #eee' }}>
                                                <span style={{ fontSize: '2.5rem' }}>🏛️</span>
                                            </div>
                                            <h4 className="fw-black text-dark mb-3" style={{ fontSize: '1.3rem', lineHeight: '1.4' }}>{uni.name}</h4>
                                            
                                            <div className="d-flex align-items-center mb-2 text-primary fw-bold justify-content-center" style={{ fontSize: '0.85rem', letterSpacing: '0.5px' }}>
                                                <i className="bi bi-geo-alt-fill me-2 ms-2"></i>
                                                {uni.location || (isRtl ? 'عالمي' : 'Global')}
                                            </div>

                                            <div className="mt-auto pt-3">
                                                <Link 
                                                    to={`/universities/${uni.id}`}
                                                    className="btn btn-primary rounded-pill w-100 py-3 fw-bold shadow-sm transition-all hover-glow"
                                                >
                                                    {isRtl ? 'عرض التفاصيل' : 'View Details'}
                                                    <i className={`bi bi-arrow-${isRtl ? 'left' : 'right'} ms-2 ms-2`}></i>
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))
                        ) : (
                            <div className="col-12 text-center py-5">
                                <div className="mb-4 text-muted opacity-25">
                                    <i className="fas fa-university fa-5x"></i>
                                </div>
                                <h3 className="fw-bold">{isRtl ? 'لم يتم العثور على نتائج' : 'No Universities Found'}</h3>
                                <p className="text-muted">{isRtl ? 'جرب البحث عن اسم آخر أو تأكد من الكتابة الصحيحة.' : 'Try different keywords or reset your search.'}</p>
                                <button className="btn btn-outline-primary rounded-pill px-5 mt-3 fw-bold" onClick={() => setSearchTerm('')}>
                                    {isRtl ? 'إعادة تعيين' : 'Reset Search'}
                                </button>
                            </div>
                        )}
                    </div>
                )}
            </div>

            <style dangerouslySetInnerHTML={{
                __html: `
                .fw-black { font-weight: 900; }
                .hover-translate-up { transition: transform 0.3s ease, box-shadow 0.3s ease !important; }
                .hover-translate-up:hover { transform: translateY(-8px); box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important; }
                .hover-scale-img { transition: transform 0.6s cubic-bezier(0.25, 1, 0.25, 1); }
                .uni-advanced-card:hover .hover-scale-img { transform: scale(1.1); }
                .hover-glow:hover { box-shadow: 0 0 20px rgba(42, 82, 190, 0.4) !important; filter: brightness(1.1); }
                .backdrop-blur { backdrop-filter: blur(10px); }
                .leading-relaxed { line-height: 1.8; }
                .uni-icon-square { transition: all 0.3s ease; }
                .uni-advanced-card:hover .uni-icon-square { transform: rotate(10deg) scale(1.1); background-color: var(--primary) !important; }
                .uni-advanced-card:hover .uni-icon-square i { color: #fff !important; }
            `}} />
        </div>
    );
};

export default Universities;
