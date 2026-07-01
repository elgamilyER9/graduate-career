import { useEffect } from 'react';
import { useLocation } from 'react-router-dom';
import { useTranslation } from 'react-i18next';

const DocumentTitle = () => {
    const { t } = useTranslation();
    const location = useLocation();

    useEffect(() => {
        const siteName = t('app.name');
        const path = location.pathname;

        const pageTitles = {
            '/': siteName,
            '/career-paths': t('nav.services'),
            '/recommendation': t('nav.guidance'),
            '/articles': t('nav.articles'),
            '/support': t('nav.support'),
            '/universities': t('nav.browse'),
            '/add-career': t('admin_panel.add_title'),
        };

        let pageTitle = pageTitles[path];

        if (!pageTitle) {
            if (path.startsWith('/article/')) {
                pageTitle = t('nav.articles');
            } else if (path.startsWith('/jobs/')) {
                pageTitle = t('nav.services');
            } else if (path.startsWith('/universities/')) {
                pageTitle = t('nav.browse');
            }
        }

        document.title = pageTitle && pageTitle !== siteName
            ? `${pageTitle} | ${siteName}`
            : siteName;
    }, [location.pathname, t]);

    return null;
};

export default DocumentTitle;
