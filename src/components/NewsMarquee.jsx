import React from 'react';
import { useTranslation } from 'react-i18next';
import './NewsMarquee.css';

const NewsMarquee = () => {
    const { t, i18n } = useTranslation();
    const isRtl = i18n.language?.startsWith('ar');

    const newsItems = isRtl ? [
        "فرص عمل جديدة متاحة الآن في قسم التكنولوجيا",
        "انضم إلى برنامج التميز المهني واحصل على توجيه مباشر",
        "تمت إضافة 15 موجه جديد هذا الأسبوع",
        "سجل الآن للحصول على استشارة مهنية مجانية",
        "تابع آخر المقالات المهنية لتعزيز مهاراتك"
    ] : [
        "New job opportunities available in the Tech sector",
        "Join the Career Excellence Program for direct mentorship",
        "15 new mentors joined the platform this week",
        "Register now for a free career consultation",
        "Check out our latest articles to boost your professional skills"
    ];

    return (
        <div className="news-marquee-wrapper" dir={isRtl ? 'rtl' : 'ltr'}>
            <div className="marquee-label">
                <i className="bi bi-megaphone-fill"></i>
                <span>{isRtl ? 'تحديثات' : 'Updates'}</span>
            </div>
            <div className="marquee-content">
                <div className="marquee-track">
                    {newsItems.map((item, index) => (
                        <span key={index} className="news-item">
                            {item}
                            <span className="news-dot">•</span>
                        </span>
                    ))}
                    {/* Duplicate for seamless loop */}
                    {newsItems.map((item, index) => (
                        <span key={`dup-${index}`} className="news-item">
                            {item}
                            <span className="news-dot">•</span>
                        </span>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default NewsMarquee;
