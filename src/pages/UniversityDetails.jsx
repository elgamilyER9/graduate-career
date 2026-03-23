import React, { useState, useEffect } from 'react';
import { useParams, useNavigate, Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { universityService } from '../services/universityService';
import './Home.css';

const UniversityDetails = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');
    
    const [university, setUniversity] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const loadUniversity = async () => {
            setLoading(true);
            try {
                const data = await universityService.fetchUniversityById(id);
                setUniversity(data);
            } catch (err) {
                console.error("Error loading university details:", err);
            } finally {
                setLoading(false);
            }
        };
        loadUniversity();
    }, [id]);

    const getUniImage = (name) => {
        const lowerName = name?.toLowerCase() || '';
        if (lowerName.includes('mit')) return 'https://images.unsplash.com/photo-1541339907198-e08756ebafe3?w=1200&auto=format&fit=crop&q=80';
        if (lowerName.includes('stanford')) return 'https://images.unsplash.com/photo-1576085898323-218337735fa7?w=1200&auto=format&fit=crop&q=80';
        if (lowerName.includes('harvard')) return 'https://images.unsplash.com/photo-1514364845967-df5e67272782?w=1200&auto=format&fit=crop&q=80';
        if (lowerName.includes('oxford')) return 'https://images.unsplash.com/photo-1590490359854-dfba1d261e44?w=1200&auto=format&fit=crop&q=80';
        return 'https://images.unsplash.com/photo-1562774053-701939374585?w=1200&auto=format&fit=crop&q=80';
    };

    if (loading) {
        return (
            <div className="d-flex justify-content-center align-items-center" style={{ minHeight: '80vh' }}>
                <div className="spinner-border text-primary" role="status" style={{ width: '3rem', height: '3rem' }}>
                    <span className="visually-hidden">Loading...</span>
                </div>
            </div>
        );
    }

    if (!university) {
        return (
            <div className="container text-center py-5">
                <div className="mb-4 text-muted opacity-25"><i className="fas fa-exclamation-triangle fa-5x"></i></div>
                <h2 className="fw-black">{isRtl ? 'الجامعة غير موجودة' : 'University Not Found'}</h2>
                <button className="btn btn-primary rounded-pill px-5 py-3 mt-4 fw-bold shadow" onClick={() => navigate('/universities')}>
                    {isRtl ? 'العودة لقائمة الجامعات' : 'Back to Universities'}
                </button>
            </div>
        );
    }

    return (
        <div className={`uni-details-page pb-5 ${isRtl ? 'text-end' : 'text-start'}`} style={{ minHeight: '100vh', background: '#f8f9fa' }}>
            {/* Dynamic Hero Header */}
            <div className="position-relative overflow-hidden" style={{ height: '500px' }}>
                <img src={getUniImage(university.name)} className="w-100 h-100 object-cover" alt={university.name} />
                <div className="position-absolute top-0 start-0 w-100 h-100" style={{ background: 'linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.4) 50%, rgba(15,23,42,0.95) 100%)' }}></div>
                
                <div className="position-absolute top-0 w-100 p-4">
                    <button className="btn btn-white bg-white bg-opacity-25 backdrop-blur text-white rounded-pill px-4 py-2 fw-bold border-0 shadow-sm" onClick={() => navigate('/universities')}>
                        <i className={`fas fa-arrow-${isRtl ? 'right' : 'left'} ${isRtl ? 'ms-2' : 'me-2'}`}></i>
                        {isRtl ? 'العودة للجامعات' : 'Back to Universities'}
                    </button>
                </div>

                <div className="container position-absolute bottom-0 start-50 translate-middle-x pb-5 w-100">
                    <div className="row align-items-end g-4">
                        <div className="col-lg-8">
                            <span className="badge bg-primary px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm animate__animated animate__fadeInDown">
                                <i className="bi bi-mortarboard-fill me-2 ms-2"></i> {isRtl ? 'صرح تعليمي معتمد' : 'Verified Academic Institution'}
                            </span>
                            <h1 className="display-3 fw-black text-white mb-0 animate__animated animate__fadeInUp" style={{ letterSpacing: '-1.5px', textShadow: '0 5px 15px rgba(0,0,0,0.3)' }}>
                                {university.name}
                            </h1>
                            <div className="d-flex align-items-center mt-3 text-white-50 fs-5 animate__animated animate__fadeInUp" style={{ animationDelay: '0.2s' }}>
                                <i className="bi bi-geo-alt-fill me-2 ms-2"></i>
                                {university.location || (isRtl ? 'موقع غير محدد' : 'Global Institution')}
                            </div>
                        </div>
                        <div className="col-lg-4 text-lg-end">
                            <div className="d-inline-flex gap-3 animate__animated animate__fadeInUp" style={{ animationDelay: '0.3s' }}>
                                <a 
                                    href={university.website || '#'} 
                                    target="_blank" 
                                    rel="noopener noreferrer"
                                    className={`btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-lg hover-glow ${!university.website ? 'disabled opacity-50' : ''}`}
                                >
                                    <i className="bi bi-box-arrow-up-right me-2 ms-2"></i>
                                    {isRtl ? 'زيارة الموقع الرسمي' : 'Visit Official Website'}
                                </a>
                                <button className="btn btn-light rounded-circle shadow-lg d-flex align-items-center justify-content-center" style={{ width: '56px', height: '56px' }}>
                                    <i className="bi bi-heart fs-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div className="container mt-n5 position-relative z-index-2">
                <div className="row g-4">
                    {/* Main Content Info */}
                    <div className="col-lg-8 mb-4">
                        <div className="card border-0 shadow-lg rounded-5 p-5 bg-white h-100 animate__animated animate__fadeInUp" style={{ animationDelay: '0.4s' }}>
                            <div className="d-flex align-items-center mb-4 border-bottom pb-3">
                                <i className="bi bi-mortarboard-fill fs-1 text-primary me-3 ms-3"></i>
                                <h3 className="fw-black text-dark mb-0">
                                    {isRtl ? 'عن الصرح الجامعي' : 'About the University'}
                                </h3>
                            </div>
                            <p className="text-muted fs-5 leading-relaxed mb-5">
                                {isRtl 
                                    ? `تعتبر ${university.name} واحدة من أرقى المؤسسات التعليمية عالمياً. تلتزم الجامعة بتوفير بيئة أكاديمية خصبة تشجع على البحث والارتقاء المعرفي في مجالات العلوم والتكنولوجيا والهندسة والرياضيات (STEM). بفضل شراكتها الاستراتيجية معنا، تفتح ${university.name} آفاقاً جديدة لطلابنا للالتحاق ببرامجها المتميزة.` 
                                    : `${university.name} stands as one of the most prestigious educational institutions worldwide. The university is committed to providing a fertile academic environment that encourages research and intellectual growth in STEM fields. Through our strategic partnership, ${university.name} opens new horizons for our students to join its elite programs.`
                                }
                            </p>

                            <div className="row g-4 mb-4">
                                <div className="col-md-6">
                                    <div className="p-4 bg-light rounded-4 border-start border-primary border-4">
                                        <h5 className="fw-bold text-primary mb-3"><i className="bi bi-lightbulb-fill me-2 ms-2"></i> {isRtl ? 'رؤية الجامعة' : 'University Vision'}</h5>
                                        <p className="small text-muted mb-0">{isRtl ? 'قيادة الابتكار العالمي من خلال التميز في التعليم والبحث العلمي.' : 'Leading global innovation through excellence in education and scientific research.'}</p>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <div className="p-4 bg-light rounded-4 border-start border-info border-4">
                                        <h5 className="fw-bold text-info mb-3"><i className="bi bi-globe me-2 ms-2"></i> {isRtl ? 'الانتشار الدولي' : 'Global Reach'}</h5>
                                        <p className="small text-muted mb-0">{isRtl ? 'شبكة خريجين واسعة تمتد لأكثر من 150 دولة حول العالم.' : 'A vast alumni network spanning over 150 countries worldwide.'}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 className="fw-black text-dark mt-5 mb-4">{isRtl ? 'أبرز الكليات والبرامج' : 'Top Faculties & Programs'}</h4>
                            <div className="row g-3">
                                {['Software Engineering', 'Artificial Intelligence', 'Cyber Security', 'Data Science'].map((prog, i) => (
                                    <div key={i} className="col-sm-6">
                                        <div className="d-flex align-items-center p-3 rounded-4 border bg-white shadow-sm hover-translate-up">
                                            <div className="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3 ms-3" style={{ width: '40px', height: '40px' }}>
                                                <i className="bi bi-check-lg"></i>
                                            </div>
                                            <span className="fw-bold text-dark">{prog}</span>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>

                    {/* Sidebar Stats & Location */}
                    <div className="col-lg-4 mb-4">
                        <div className="sticky-top" style={{ top: '100px' }}>
                            <div className="card border-0 shadow-lg rounded-5 p-4 mb-4 bg-dark text-white animate__animated animate__fadeInRight" style={{ animationDelay: '0.5s' }}>
                                <h4 className="fw-black mb-4"><i className="bi bi-graph-up-arrow me-2 ms-2 text-primary"></i> {isRtl ? 'أرقام وإحصائيات' : 'Quick Stats'}</h4>
                                <div className="d-flex flex-column gap-4">
                                    <div className="d-flex justify-content-between align-items-center">
                                        <span className="opacity-75">{isRtl ? 'الترتيب العالمي' : 'World Ranking'}</span>
                                        <span className="badge bg-primary fs-6">#1-10</span>
                                    </div>
                                    <div className="d-flex justify-content-between align-items-center">
                                        <span className="opacity-75">{isRtl ? 'نسبة القبول' : 'Acceptance Rate'}</span>
                                        <span className="fw-bold fs-5">4.5%</span>
                                    </div>
                                    <div className="d-flex justify-content-between align-items-center">
                                        <span className="opacity-75">{isRtl ? 'عدد الطلاب' : 'Total Students'}</span>
                                        <span className="fw-bold fs-5">15,000+</span>
                                    </div>
                                    <div className="d-flex justify-content-between align-items-center">
                                        <span className="opacity-75">{isRtl ? 'اللغة' : 'Language'}</span>
                                        <span className="fw-bold fs-5">English</span>
                                    </div>
                                </div>
                                <hr className="opacity-25" />
                                <div className="p-3 rounded-4 bg-white bg-opacity-10 text-center">
                                    <div className="small opacity-75 mb-1">{isRtl ? 'تكلفة التقديم' : 'Application Fee'}</div>
                                    <div className="fw-black text-primary fs-3">$75.00</div>
                                </div>
                            </div>

                            <div className="card border-0 shadow-lg rounded-5 overflow-hidden animate__animated animate__fadeInRight" style={{ animationDelay: '0.6s' }}>
                                <div className="p-4 bg-white border-bottom">
                                    <h4 className="fw-black mb-0 text-dark"><i className="bi bi-map-fill text-primary me-2 ms-2"></i> {isRtl ? 'موقع الجامعة' : 'Campus Location'}</h4>
                                </div>
                                <div className="bg-light d-flex align-items-center justify-content-center" style={{ height: '200px' }}>
                                    <div className="text-center p-4">
                                        <div className="text-primary fs-1 mb-2"><i className="bi bi-compass-fill"></i></div>
                                        <div className="fw-bold text-dark">{university.location || (isRtl ? 'موقع غير محدد' : 'Global')}</div>
                                        <a href={`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(university.name + ' ' + (university.location || ''))}`} target="_blank" rel="noopener noreferrer" className="btn btn-sm btn-outline-primary rounded-pill mt-3 px-4">
                                            <i className="bi bi-map me-1"></i>
                                            {isRtl ? 'عرض على الخريطة' : 'View on Maps'}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style dangerouslySetInnerHTML={{
                __html: `
                .fw-black { font-weight: 900; }
                .backdrop-blur { backdrop-filter: blur(12px); }
                .leading-relaxed { line-height: 1.8; }
                .z-index-2 { z-index: 2; }
                .hover-glow:hover { box-shadow: 0 0 25px rgba(42, 82, 190, 0.5) !important; filter: brightness(1.1); }
                .hover-translate-up { transition: all 0.3s ease; }
                .hover-translate-up:hover { transform: translateY(-5px); border-color: var(--primary) !important; }
            `}} />
        </div>
    );
};

export default UniversityDetails;
