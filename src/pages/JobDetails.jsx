import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { getCareerImage } from '../utils/images';

const JobDetails = () => {
    const { id } = useParams();
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');
    const [job, setJob] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        window.scrollTo(0, 0);
        const fetchJobDetails = async () => {
            try {
                const response = await fetch(`/api/showjob/${id}`);
                if (!response.ok) throw new Error('Job not found');
                const data = await response.json();
                setJob(data);
            } catch (err) {
                console.error(err);
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };
        fetchJobDetails();
    }, [id]);

    if (loading) {
        return (
            <div className={`container py-5 text-center ${isRtl ? 'text-end' : 'text-start'}`} style={{ minHeight: '60vh' }}>
                <div className="spinner-border text-primary" role="status" style={{ width: '3rem', height: '3rem' }}>
                    <span className="visually-hidden">{t('loading', isRtl ? 'جاري التحميل...' : 'Loading...')}</span>
                </div>
            </div>
        );
    }

    if (error || !job) {
        return (
            <div className={`container py-5 text-center ${isRtl ? 'text-end' : 'text-start'}`} style={{ minHeight: '60vh' }}>
                <h2 className="text-danger fw-bold">{t('error', isRtl ? 'حدث خطأ' : 'Error Occurred')}</h2>
                <p className="text-muted fs-4">{t('job_not_found', isRtl ? 'لم يتم العثور على الوظيفة المطلوبة.' : 'The requested job could not be found.')}</p>
                <Link to="/" className="btn btn-primary rounded-pill px-4 mt-3">{t('go_back', isRtl ? 'الرجوع للرئيسية' : 'Go Back')}</Link>
            </div>
        );
    }

    const industryName = job.career_path ? job.career_path.name : (job.industry || 'General');

    return (
        <div className={`job-details-page bg-light pb-5 ${isRtl ? 'text-end' : 'text-start'}`}>
            {/* Hero Section */}
            <div className="position-relative bg-dark" style={{ height: '400px' }}>
                <img 
                    src={getCareerImage(job.id, job.title)} 
                    alt={job.title}
                    className="w-100 h-100 opacity-50"
                    style={{ objectFit: 'cover' }}
                    onError={(e) => {
                        e.target.onerror = null;
                        e.target.src = 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80';
                    }}
                />
                <div className="position-absolute top-0 start-0 w-100 h-100" style={{ background: 'linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4))' }}></div>
                
                <div className="position-absolute top-50 translate-middle-y w-100">
                    <div className="container">
                        <Link to="/" className="btn btn-outline-light rounded-pill mb-4 px-4 shadow-sm hover-scale transition-all">
                            <i className={`fas fa-arrow-${isRtl ? 'right' : 'left'} me-2`}></i> {t('go_back', isRtl ? 'رجوع' : 'Go Back')}
                        </Link>
                        <div className="d-flex align-items-center gap-3 mb-3">
                            <span className="badge bg-primary px-3 py-2 rounded-pill fs-6">{industryName}</span>
                            <span className="badge bg-success px-3 py-2 rounded-pill fs-6">{job.type || (isRtl ? 'دوام كامل' : 'Full-time')}</span>
                        </div>
                        <h1 className="display-4 text-white fw-bold mb-2">{job.title}</h1>
                        <p className="text-light fs-4 mb-0"><i className="fas fa-building me-2"></i> {job.company || (isRtl ? 'غير محدد' : 'Company not specified')}</p>
                    </div>
                </div>
            </div>

            {/* Content Section */}
            <div className="container" style={{ marginTop: '-40px', position: 'relative', zIndex: 10 }}>
                <div className="row g-4">
                    {/* Main Details */}
                    <div className="col-lg-8">
                        <div className="bg-white rounded-5 shadow-sm p-4 p-md-5 mb-4 border-0">
                            <h3 className="fw-bold mb-4 text-dark border-bottom pb-3">
                                <i className="fas fa-align-right text-primary me-2"></i> {t('job_details.description', isRtl ? 'الوصف الوظيفي' : 'Job Description')}
                            </h3>
                            <div className="text-secondary fs-5" style={{ lineHeight: '1.8' }}>
                                {job.description ? (
                                    job.description.split('\n').map((paragraph, idx) => (
                                        <p key={idx}>{paragraph}</p>
                                    ))
                                ) : (
                                    <p>{isRtl ? 'لا يوجد وصف متاح.' : 'No description available.'}</p>
                                )}
                            </div>
                        </div>
                        
                        {/* Optional Requirements section placeholder (if backend adds it later) */}
                        {job.requirements && (
                            <div className="bg-white rounded-5 shadow-sm p-4 p-md-5 border-0">
                                <h3 className="fw-bold mb-4 text-dark border-bottom pb-3">
                                    <i className="fas fa-list-check text-success me-2"></i> {t('job_details.requirements', isRtl ? 'المتطلبات' : 'Requirements')}
                                </h3>
                                <div className="text-secondary fs-5" style={{ lineHeight: '1.8' }}>
                                    <p>{job.requirements}</p>
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Sidebar */}
                    <div className="col-lg-4">
                        <div className="bg-white rounded-5 shadow-sm p-4 border-0 mb-4 sticky-top" style={{ top: '100px' }}>
                            <h4 className="fw-bold mb-4 text-dark border-bottom pb-3">{t('job_details.overview', isRtl ? 'ملخص الوظيفة' : 'Job Overview')}</h4>
                            
                            <ul className="list-unstyled mb-4">
                                <li className="d-flex align-items-center mb-4">
                                    <div className="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary" style={{ width: '50px', height: '50px' }}>
                                        <i className="fas fa-map-marker-alt fs-5"></i>
                                    </div>
                                    <div className={`ms-3 ${isRtl ? 'me-3 ms-0' : ''}`}>
                                        <small className="text-muted d-block fw-bold">{t('job_details.location', isRtl ? 'موقع العمل' : 'Location')}</small>
                                        <span className="text-dark fw-bold fs-5">{job.location || (isRtl ? 'عن بُعد' : 'Remote')}</span>
                                    </div>
                                </li>
                                <li className="d-flex align-items-center mb-4">
                                    <div className="bg-light rounded-circle d-flex align-items-center justify-content-center text-warning" style={{ width: '50px', height: '50px' }}>
                                        <i className="fas fa-money-bill-wave fs-5"></i>
                                    </div>
                                    <div className={`ms-3 ${isRtl ? 'me-3 ms-0' : ''}`}>
                                        <small className="text-muted d-block fw-bold">{t('job_details.salary', isRtl ? 'الراتب' : 'Salary')}</small>
                                        <span className="text-dark fw-bold fs-5">{job.salary_range || (isRtl ? 'يحدد لاحقاً' : 'To be determined')}</span>
                                    </div>
                                </li>
                                <li className="d-flex align-items-center mb-4">
                                    <div className="bg-light rounded-circle d-flex align-items-center justify-content-center text-info" style={{ width: '50px', height: '50px' }}>
                                        <i className="fas fa-briefcase fs-5"></i>
                                    </div>
                                    <div className={`ms-3 ${isRtl ? 'me-3 ms-0' : ''}`}>
                                        <small className="text-muted d-block fw-bold">{t('job_details.type', isRtl ? 'نوع الوظيفة' : 'Job Type')}</small>
                                        <span className="text-dark fw-bold fs-5">{job.type || (isRtl ? 'دوام كامل' : 'Full-time')}</span>
                                    </div>
                                </li>
                            </ul>

                            <a href="/login" className="btn btn-primary d-block w-100 py-3 rounded-pill fw-bold fs-5 shadow-sm hover-scale transition-all text-decoration-none text-center">
                                {t('job_details.apply', isRtl ? 'التقديم الآن' : 'Apply Now')}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default JobDetails;
