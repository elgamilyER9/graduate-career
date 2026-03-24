import React, { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { useTranslation } from 'react-i18next';

const ScrollButtons = () => {
    const [showUp, setShowUp] = useState(false);
    const { i18n } = useTranslation();
    const isRtl = i18n.dir() === 'rtl';
    const whatsappNumber = '01223030960';
    const whatsappLink = `https://wa.me/20${whatsappNumber}`;

    useEffect(() => {
        const handleScroll = () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            setShowUp(scrollTop > 300);
        };

        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    const scrollToTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    const buttonVariants = {
        initial: { opacity: 0, scale: 0.5, x: isRtl ? -20 : 20 },
        animate: { opacity: 1, scale: 1, x: 0 },
        exit: { opacity: 0, scale: 0.5, x: isRtl ? -20 : 20 },
        hover: { scale: 1.1, backgroundColor: 'var(--nav-blue)', color: '#fff' }
    };

    const whatsappVariants = {
        ...buttonVariants,
        hover: { scale: 1.1, backgroundColor: '#25D366', color: '#fff' }
    };

    const containerStyle = {
        position: 'fixed',
        bottom: '30px',
        [isRtl ? 'left' : 'right']: '30px',
        display: 'flex',
        flexDirection: 'column',
        gap: '12px',
        zIndex: 1000
    };

    const buttonStyle = {
        width: '50px',
        height: '50px',
        borderRadius: '15px',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        cursor: 'pointer',
        fontSize: '24px',
        background: 'var(--glass-card-bg)',
        backdropFilter: 'blur(10px)',
        border: '1px solid var(--border-color)',
        boxShadow: '0 8px 32px 0 rgba(0, 0, 0, 0.1)',
        color: 'var(--nav-blue)',
        transition: 'all 0.3s ease',
        outline: 'none',
        textDecoration: 'none'
    };

    const whatsappStyle = {
        ...buttonStyle,
        color: '#25D366',
    };

    return (
        <div style={containerStyle}>
            <AnimatePresence>
                <motion.a
                    key="whatsapp"
                    href={whatsappLink}
                    target="_blank"
                    rel="noopener noreferrer"
                    variants={whatsappVariants}
                    initial="initial"
                    animate="animate"
                    whileHover="hover"
                    style={whatsappStyle}
                    aria-label="WhatsApp"
                    title={isRtl ? 'تواصل معنا عبر واتساب' : 'Contact us on WhatsApp'}
                >
                    <svg viewBox="0 0 448 512" width="24" height="24" fill="currentColor">
                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-5.5-2.8-23.2-8.5-44.2-27.1-16.4-14.6-27.4-32.7-30.6-38.1-3.2-5.5-.3-8.4 2.4-11.1 2.5-2.5 5.5-6.5 8.3-9.7 2.8-3.2 3.7-5.5 5.6-9.2 1.9-3.7 1-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 13.2 5.7 23.5 9.2 31.6 11.8 13.3 4.2 25.4 3.6 35 2.2 10.7-1.5 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                    </svg>
                </motion.a>

                {showUp && (
                    <motion.button
                        key="scroll-up"
                        variants={buttonVariants}
                        initial="initial"
                        animate="animate"
                        exit="exit"
                        whileHover="hover"
                        onClick={scrollToTop}
                        style={buttonStyle}
                        aria-label={isRtl ? 'العودة للأعلى' : 'Scroll to Top'}
                        title={isRtl ? 'العودة للأعلى' : 'Scroll to Top'}
                    >
                        <svg viewBox="0 0 448 512" width="20" height="20" fill="currentColor">
                            <path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.7c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/>
                        </svg>
                    </motion.button>
                )}
            </AnimatePresence>
        </div>
    );
};

export default ScrollButtons;
