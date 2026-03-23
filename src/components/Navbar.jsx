import React, { useState, useEffect, useRef } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { authService } from '../services/authService';
import { useTranslation } from 'react-i18next';
import LoginModal from './LoginModal';
import SubNavbar from './SubNavbar';
import NewsMarquee from './NewsMarquee';
import './Navbar.css';

const Navbar = () => {
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');
    const navigate = useNavigate();

    const [isLoginModalOpen, setIsLoginModalOpen] = useState(false);
    const [modalInitialStep, setModalInitialStep] = useState(1);
    const [user, setUser] = useState(authService.getCurrentUser());

    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
    const [isUserDropdownOpen, setIsUserDropdownOpen] = useState(false);
    const [scrolled, setScrolled] = useState(false);

    const [isDarkMode, setIsDarkMode] = useState(() => {
        return localStorage.getItem('theme') === 'dark';
    });

    const userRef = useRef(null);
    const isAdmin = authService.isAdmin();

    useEffect(() => {
        const handleScroll = () => setScrolled(window.scrollY > 20);
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    useEffect(() => {
        const root = document.documentElement;
        if (isDarkMode) {
            document.body.classList.add('dark-mode');
            root.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-mode');
            root.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    }, [isDarkMode]);

    useEffect(() => {
        const handleClickOutside = (event) => {
            if (userRef.current && !userRef.current.contains(event.target)) {
                setIsUserDropdownOpen(false);
            }
        };
        document.addEventListener('mousedown', handleClickOutside);
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, []);

    const handleLogout = () => {
        authService.logout();
        setUser(null);
        setIsUserDropdownOpen(false);
        navigate('/');
    };

    const handleLoginSuccess = (loggedInUser) => setUser(loggedInUser);

    const openLogin = () => {
        setModalInitialStep(3);
        setIsLoginModalOpen(true);
        setIsMobileMenuOpen(false);
    };

    const openRegister = () => {
        setModalInitialStep(1);
        setIsLoginModalOpen(true);
        setIsMobileMenuOpen(false);
    };

    const toggleLanguage = () => i18n.changeLanguage(isRtl ? 'en' : 'ar');
    const toggleTheme = () => setIsDarkMode(!isDarkMode);

    return (
        <header className={`modern-navbar ${scrolled ? 'scrolled' : ''} ${isDarkMode ? 'dark-mode' : ''}`} dir={isRtl ? 'rtl' : 'ltr'}>
            <SubNavbar />
            <NewsMarquee />

            <div className="navbar-container">
                {/* Logo Section */}
                <Link to="/" className="brand-logo" onClick={() => setIsMobileMenuOpen(false)}>
                    <div className="logo-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <span className="logo-text">graduate<span> career</span></span>
                </Link>

                {/* Mobile Burger Menu */}
                <button className="mobile-toggle" onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}>
                    <i className={`bi ${isMobileMenuOpen ? 'bi-x-lg' : 'bi-list'}`}></i>
                </button>

                {/* Navigation and Actions */}
                <nav className={`navbar-menu ${isMobileMenuOpen ? 'open' : ''}`}>

                    {/* Navigation Links Section */}
                    <ul className="nav-links">
                        <li>
                            <Link to="/" onClick={() => setIsMobileMenuOpen(false)}>
                                <i className="bi bi-house"></i> <span>{t('nav.home')}</span>
                            </Link>
                        </li>
                        <li>
                            <Link to="/career-paths" onClick={() => setIsMobileMenuOpen(false)}>
                                <i className="bi bi-briefcase"></i> <span>{t('nav.services')}</span>
                            </Link>
                        </li>
                        <li>
                            <Link to="/recommendation" onClick={() => setIsMobileMenuOpen(false)}>
                                <i className="bi bi-diagram-3"></i> <span>{t('nav.guidance')}</span>
                            </Link>
                        </li>
                        <li>
                            <Link to="/articles" onClick={() => setIsMobileMenuOpen(false)}>
                                <i className="bi bi-journal-text"></i> <span>{t('nav.articles')}</span>
                            </Link>
                        </li>
                        <li>
                            <Link to="/universities" onClick={() => setIsMobileMenuOpen(false)}>
                                <i className="bi bi-building-columns"></i> <span>{isRtl ? 'الجامعات الشريكة' : 'Partner Universities'}</span>
                            </Link>
                        </li>
                        <li>
                            <Link to="/support" onClick={() => setIsMobileMenuOpen(false)}>
                                <i className="bi bi-mortarboard"></i> <span>{isRtl ? 'مصادر التعلم' : 'Learning Resources'}</span>
                            </Link>
                        </li>
                    </ul>

                    {/* Actions Section */}
                    <div className="nav-actions">

                        <div className="quick-actions">
                            {/* Language Toggle */}
                            <button className="action-icon-btn" onClick={toggleLanguage} title={isRtl ? 'English' : 'عربي'}>
                                <i className="bi bi-translate"></i>
                            </button>

                            {/* Theme Toggle */}
                            <button className="action-icon-btn" onClick={toggleTheme} title="Toggle Theme">
                                <i className={`bi ${isDarkMode ? 'bi-sun' : 'bi-moon'}`}></i>
                            </button>
                        </div>

                        {/* Login/Register or User Dropdown */}
                        <div className="auth-buttons">
                            {user ? (
                                <div className="user-dropdown-wrapper" ref={userRef}>
                                    <button className="user-avatar-btn" onClick={() => setIsUserDropdownOpen(!isUserDropdownOpen)} style={{ padding: '4px 12px 4px 6px', borderRadius: '50px', display: 'flex', alignItems: 'center', gap: '8px' }}>
                                        <img
                                            src={`https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=0D6EFD&color=fff&size=32`}
                                            className="rounded-circle"
                                            alt="User"
                                            style={{ width: '32px', height: '32px' }}
                                        />
                                        <span className="fw-bold text-dark d-none d-md-inline" style={{ fontSize: '0.9rem' }}>{user.name}</span>
                                        <i className="bi bi-chevron-down opacity-50"></i>
                                    </button>
                                    {isUserDropdownOpen && (
                                        <div className="user-dropdown-menu animate__animated animate__fadeIn">
                                            <a href="/profile" className="dropdown-item d-flex align-items-center" onClick={() => { setIsUserDropdownOpen(false); setIsMobileMenuOpen(false); }}>
                                                <i className="bi bi-person-circle me-2 opacity-75"></i>
                                                <span>{isRtl ? 'الملف الشخصي' : 'Profile Settings'}</span>
                                            </a>
                                            {isAdmin && (
                                                <a href="/home" className="dropdown-item d-flex align-items-center" onClick={() => { setIsUserDropdownOpen(false); setIsMobileMenuOpen(false); }}>
                                                    <i className="bi bi-speedometer2 me-2 opacity-75"></i>
                                                    <span>{isRtl ? 'لوحة التحكم' : 'Dashboard'}</span>
                                                </a>
                                            )}
                                            <div className="dropdown-divider"></div>
                                            <button onClick={handleLogout} className="dropdown-item d-flex align-items-center text-danger">
                                                <i className="bi bi-box-arrow-right me-2"></i>
                                                <span>{t('nav.logout')}</span>
                                            </button>
                                        </div>
                                    )}
                                </div>
                            ) : (
                                <>
                                    <a href="/login" className="btn-login">{t('nav.login')}</a>
                                    <a href="/select-role" className="btn-signup">{t('nav.signup')}</a>
                                </>
                            )}
                        </div>
                    </div>
                </nav>
            </div>


            <LoginModal isOpen={isLoginModalOpen} initialStep={modalInitialStep} onClose={() => setIsLoginModalOpen(false)} onLoginSuccess={handleLoginSuccess} />
        </header>
    );
};

export default Navbar;
