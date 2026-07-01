import React from 'react';
import { useTranslation } from 'react-i18next';
import { Link } from 'react-router-dom';
import LogoIcon from './LogoIcon';

const Footer = () => {
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');

    return (
        <footer className="modern-footer mt-5" dir={isRtl ? 'rtl' : 'ltr'}>
            <div className="footer-top-shape">
                <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M0,50 C150,100 350,0 720,50 C1080,100 1280,0 1440,50 L1440,100 L0,100 Z" fill="currentColor"></path>
                </svg>
            </div>

            <div className="footer-glow-effect"></div>

            <div className="footer-container position-relative z-1">
                <div className="footer-grid">
                    {/* About Section */}
                    <div className="footer-section about-section">
                        <Link to="/" className="footer-logo">
                            <div className="logo-icon-footer">
                                <LogoIcon size={22} />
                            </div>
                            <span className="logo-text-footer">graduate<span className="text-gradient"> career</span></span>
                        </Link>
                        <p className="footer-description">
                            {t('footer.tagline') || (isRtl ? 'نحن نساعدك على اكتشاف شغفك ورسم مسارك المهني بأفضل الطرق الحديثة والموثوقة.' : 'We help you discover your passion and design your career path with modern and reliable approaches.')}
                        </p>

                        <div className="social-icons mt-4">
                            <a href="https://www.facebook.com/share/1BQQ1JbHdY/" target="_blank" rel="noopener noreferrer" className="social-icon" aria-label="Facebook"><i className="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/careerguidance" target="_blank" rel="noopener noreferrer" className="social-icon" aria-label="Twitter"><i className="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/rby296938?igsh=cnZlbHRtbGcycXEx" target="_blank" rel="noopener noreferrer" className="social-icon" aria-label="Instagram"><i className="fab fa-instagram"></i></a>
                            <a href="https://linkedin.com/company/careerguidance" target="_blank" rel="noopener noreferrer" className="social-icon" aria-label="LinkedIn"><i className="fab fa-linkedin-in"></i></a>
                            <a href="https://youtube.com/c/careerguidance" target="_blank" rel="noopener noreferrer" className="social-icon" aria-label="YouTube"><i className="fab fa-youtube"></i></a>
                        </div>
                    </div>

                    {/* Quick Links */}
                    <div className="footer-section links-section">
                        <h4 className="footer-title">{t('footer.links_title') || (isRtl ? 'روابط سريعة' : 'Quick Links')}</h4>
                        <ul className="footer-links">
                            <li><Link to="/"><i className={`fas fa-chevron-${isRtl ? 'left' : 'right'} link-icon`}></i> {t('nav.home') || (isRtl ? 'الرئيسية' : 'Home')}</Link></li>
                            <li><Link to="/career-paths"><i className={`fas fa-chevron-${isRtl ? 'left' : 'right'} link-icon`}></i> {t('nav.services') || (isRtl ? 'الخدمات' : 'Services')}</Link></li>
                            <li><Link to="/recommendation"><i className={`fas fa-chevron-${isRtl ? 'left' : 'right'} link-icon`}></i> {t('nav.guidance') || (isRtl ? 'التوجيه المهني' : 'Career Guidance')}</Link></li>
                            <li><Link to="/articles"><i className={`fas fa-chevron-${isRtl ? 'left' : 'right'} link-icon`}></i> {t('nav.articles') || (isRtl ? 'مقالات' : 'Articles')}</Link></li>
                            <li><Link to="/support"><i className={`fas fa-chevron-${isRtl ? 'left' : 'right'} link-icon`}></i> {t('nav.support') || (isRtl ? 'الدعم الفني' : 'Support')}</Link></li>
                        </ul>
                    </div>

                    {/* Contact Info */}
                    <div className="footer-section contact-section">
                        <h4 className="footer-title">{t('footer.contact_title') || (isRtl ? 'معلومات التواصل' : 'Contact Us')}</h4>
                        <ul className="contact-info">
                            <li>
                                <div className="contact-icon-wrapper"><i className="fas fa-map-marker-alt"></i></div>
                                <span className="contact-link no-hover" style={{ cursor: 'default' }}>
                                    {isRtl ? 'المنصوره - مصر' : 'Mansoura - Egypt'}
                                </span>
                            </li>
                            <li>
                                <div className="contact-icon-wrapper"><i className="fas fa-phone-alt"></i></div>
                                <span dir="ltr" className="contact-link no-hover fw-bold text-white" style={{ cursor: 'default' }}>+20 1223030960</span>
                            </li>
                            <li>
                                <div className="contact-icon-wrapper"><i className="fas fa-envelope"></i></div>
                                <a href="mailto:elgamilyramadan@gmail.com" className="contact-link">elgamilyramadan@gmail.com</a>
                            </li>
                        </ul>
                    </div>

                    {/* Newsletter / CTA */}
                    <div className="footer-section newsletter-section">
                        <h4 className="footer-title">{isRtl ? 'النشرة البريدية' : 'Newsletter'}</h4>
                        <p className="newsletter-text">
                            {isRtl ? 'اشترك للحصول على أحدث المقالات والنصائح المهنية لنساعدك على بدء مسارك بنجاح.' : 'Subscribe to receive the latest articles and career tips to jumpstart your professional journey.'}
                        </p>
                        <form className="newsletter-form hover-lift" onSubmit={(e) => e.preventDefault()}>
                            <div className="input-group-glass">
                                <input type="email" placeholder={t('footer.placeholder') || (isRtl ? 'البريد الإلكتروني' : 'Email address')} required />
                                <button type="submit" className="glass-btn">
                                    <i className={`fas fa-paper-plane ${isRtl ? 'fa-flip-horizontal' : ''}`}></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div className="footer-bottom">
                    <div className="copyright d-flex align-items-center gap-2">
                        <span>&copy; {new Date().getFullYear()} <strong className="text-white">graduate career</strong>. {isRtl ? 'جميع الحقوق محفوظة.' : 'All rights reserved.'}</span>
                        <span className="badge bg-primary-soft text-primary ms-auto d-none d-md-inline-block">v2.0 Premium</span>
                    </div>
                    <div className="footer-bottom-links">
                        <Link to="#">{t('footer.privacy') || (isRtl ? 'سياسة الخصوصية' : 'Privacy Policy')}</Link>
                        <span className="divider">•</span>
                        <Link to="#">{t('footer.terms') || (isRtl ? 'الشروط والأحكام' : 'Terms of Service')}</Link>
                    </div>
                </div>
            </div>

            <style dangerouslySetInnerHTML={{
                __html: `
                .modern-footer {
                    background: #0f172a; /* Slate 900 */
                    color: #94a3b8; /* Slate 400 */
                    position: relative;
                    font-family: inherit;
                    overflow: hidden;
                }

                .footer-top-shape {
                    position: absolute;
                    top: -99px;
                    left: 0;
                    width: 100%;
                    height: 100px;
                    color: #0f172a;
                    line-height: 0;
                    z-index: 2;
                }

                .footer-top-shape svg {
                    width: 100%;
                    height: 100%;
                }

                /* Advanced Background Glow */
                .footer-glow-effect {
                    position: absolute;
                    top: -20%;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 60%;
                    height: 500px;
                    background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, rgba(15,23,42,0) 70%);
                    pointer-events: none;
                    z-index: 0;
                }

                .footer-container {
                    max-width: 1320px;
                    margin: 0 auto;
                    padding: 5rem 2rem 2rem;
                }

                .footer-grid {
                    display: grid;
                    grid-template-columns: 2fr 1fr 1.25fr 1.5fr;
                    gap: 4rem;
                    margin-bottom: 4rem;
                }

                .footer-title {
                    color: #ffffff;
                    font-size: 1.25rem;
                    font-weight: 800;
                    margin-bottom: 2.2rem;
                    position: relative;
                    display: inline-block;
                    letter-spacing: 0.6px;
                    text-shadow: 0 2px 5px rgba(0,0,0,0.4);
                }

                .footer-title::after {
                    content: '';
                    position: absolute;
                    bottom: -10px;
                    height: 3px;
                    border-radius: 3px;
                    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
                }

                [dir="ltr"] .footer-title::after { left: 0; width: 45px; }
                [dir="rtl"] .footer-title::after { right: 0; width: 45px; }

                /* Logo Section */
                .footer-logo {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    text-decoration: none;
                    margin-bottom: 1.5rem;
                }

                .logo-icon-footer {
                    width: 44px;
                    height: 44px;
                    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 1.2rem;
                    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
                }

                .logo-text-footer {
                    font-size: 1.5rem;
                    font-weight: 900;
                    color: #f8fafc;
                    letter-spacing: -0.02em;
                }

                .text-gradient {
                    background: linear-gradient(to right, #60a5fa, #a78bfa);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    text-shadow: 0 4px 15px rgba(96, 165, 250, 0.3);
                }

                .footer-description {
                    font-size: 1rem;
                    line-height: 1.8;
                    margin-bottom: 2rem;
                    color: #94a3b8;
                }

                /* Glowing Social Icons */
                .social-icons {
                    display: flex;
                    gap: 1rem;
                }

                .social-icon {
                    width: 42px;
                    height: 42px;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.03);
                    border: 1px solid rgba(255, 255, 255, 0.08);
                    color: #cbd5e1;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-decoration: none;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    font-size: 1.1rem;
                }

                .social-icon:hover {
                    background: #3b82f6;
                    color: white;
                    border-color: #3b82f6;
                    transform: translateY(-5px);
                    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
                }

                /* Premium Links */
                .footer-links {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .footer-links li {
                    margin-bottom: 1rem;
                }

                .footer-links a {
                    color: #94a3b8;
                    text-decoration: none;
                    font-size: 1rem;
                    font-weight: 500;
                    transition: all 0.3s ease;
                    display: inline-flex;
                    align-items: center;
                }

                .link-icon {
                    font-size: 0.7rem;
                    color: #475569;
                    margin: 0 8px;
                    transition: all 0.3s ease;
                }

                .footer-links a:hover {
                    color: #60a5fa;
                    transform: translateX(6px);
                }
                
                [dir="rtl"] .footer-links a:hover {
                    transform: translateX(-6px);
                }

                .footer-links a:hover .link-icon {
                    color: #60a5fa;
                }

                /* Contact Info block */
                .contact-info {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .contact-info li {
                    display: flex;
                    align-items: flex-start;
                    margin-bottom: 1.25rem;
                    gap: 1.25rem;
                }

                .contact-icon-wrapper {
                    width: 38px;
                    height: 38px;
                    border-radius: 10px;
                    background: rgba(59, 130, 246, 0.1);
                    color: #60a5fa;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.1rem;
                    flex-shrink: 0;
                }

                .contact-link {
                    font-size: 0.95rem;
                    line-height: 1.6;
                    color: #94a3b8;
                    text-decoration: none;
                    transition: all 0.2s ease;
                    margin-top: 5px;
                }

                .contact-link:not(.no-hover):hover {
                    color: #60a5fa;
                }

                /* Glassmorphism Newsletter Form */
                .newsletter-text {
                    font-size: 0.95rem;
                    line-height: 1.7;
                    margin-bottom: 1.5rem;
                    color: #94a3b8;
                }

                .input-group-glass {
                    display: flex;
                    background: rgba(255, 255, 255, 0.03);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    border-radius: 12px;
                    padding: 6px;
                    transition: all 0.3s ease;
                    backdrop-filter: blur(10px);
                }

                .input-group-glass:focus-within {
                    border-color: rgba(59, 130, 246, 0.5);
                    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
                    background: rgba(255, 255, 255, 0.05);
                }

                .input-group-glass input {
                    flex: 1;
                    background: transparent;
                    border: none;
                    padding: 0.8rem 1.2rem;
                    color: #f8fafc;
                    outline: none;
                    font-size: 0.95rem;
                }

                .input-group-glass input::placeholder {
                    color: #64748b;
                }

                .glass-btn {
                    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                    border: none;
                    border-radius: 8px;
                    color: white;
                    width: 48px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .glass-btn:hover {
                    background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
                    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
                    transform: scale(1.05);
                }

                .hover-lift {
                    transition: transform 0.3s ease;
                }

                .hover-lift:hover {
                    transform: translateY(-3px);
                }

                /* Bottom Bar */
                .footer-bottom {
                    padding-top: 2rem;
                    border-top: 1px solid rgba(255, 255, 255, 0.06);
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    font-size: 0.9rem;
                }

                .footer-bottom-links {
                    display: flex;
                    align-items: center;
                    gap: 1.25rem;
                }

                .footer-bottom-links a {
                    color: #94a3b8;
                    text-decoration: none;
                    font-weight: 500;
                    transition: color 0.2s ease;
                }

                .footer-bottom-links a:hover {
                    color: #f8fafc;
                }
                
                .footer-bottom-links .divider {
                    color: #475569;
                }

                /* Primary Soft Badge */
                .bg-primary-soft { background: rgba(59, 130, 246, 0.15); color: #60a5fa; }

                /* Responsive */
                @media (max-width: 1200px) {
                    .footer-grid {
                        grid-template-columns: 1fr 1fr;
                        gap: 3rem;
                    }
                }

                @media (max-width: 768px) {
                    .footer-grid {
                        grid-template-columns: 1fr;
                        gap: 3rem;
                    }
                    
                    .footer-bottom {
                        flex-direction: column;
                        text-align: center;
                        gap: 1.5rem;
                    }

                    .footer-bottom-links {
                        flex-direction: column;
                        gap: 0.8rem;
                    }
                    
                    .footer-bottom-links .divider {
                        display: none;
                    }
                }
            `}} />
        </footer>
    );
};

export default Footer;
