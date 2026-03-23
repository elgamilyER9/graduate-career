export const careerImages = {
    // Software & Tech
    'software': 'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
    'fullstack': 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97',
    'android': 'https://images.unsplash.com/photo-1551650975-87deedd944c3',
    'frontend': 'https://images.unsplash.com/photo-1547658719-da2b51169166',
    'backend': 'https://images.unsplash.com/photo-1555066931-4365d14bab8c',
    'devops': 'https://images.unsplash.com/photo-1667372333374-9d3d17336ed7',
    'cybersecurity': 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5',
    'cloud': 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8',
    'networking': 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31',
    'it_support': 'https://images.unsplash.com/photo-1531482615713-2afd69097998',

    // Data & AI
    'analyst': 'https://images.unsplash.com/photo-1551288049-bbbda1400a16',
    'data_analyst': 'https://images.unsplash.com/photo-1551288049-bbbda1400a16',
    'data': 'https://images.unsplash.com/photo-1460925895917-afdab827c52f',
    'ml_engineer': 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e',
    'data_scientist': 'https://images.unsplash.com/photo-1527474305487-b87b222841cc',
    'artificial_intelligence': 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485',

    // Marketing & Sales
    'marketing': 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a',
    'marketing_spec': 'https://images.unsplash.com/photo-1533750349088-cd871a92f312',
    'seo': 'https://images.unsplash.com/photo-1571721795195-a2ca2d3370a9',
    'social_media': 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7',
    'sales': 'https://images.unsplash.com/photo-1556761175-4b46a572b786',
    'b2b': 'https://images.unsplash.com/photo-1557804506-669a67965ba0',

    // Design & Creative
    'creative': 'https://images.unsplash.com/photo-1513364776144-60967b0f800f',
    'uiux': 'https://images.unsplash.com/photo-1561070791-2526d30994b5',
    'graphic_designer': 'https://images.unsplash.com/photo-1626785774573-4b799314346d',
    'motion_graphic': 'https://images.unsplash.com/photo-1550745165-9bc0b252726f',
    'video_editor': 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d',
    'content_strat': 'https://images.unsplash.com/photo-1552664730-d307ca884978',
    'writer': 'https://images.unsplash.com/photo-1455390582262-044cdead27d8',

    // Business & Finance
    'finance': 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3',
    'accounting': 'https://images.unsplash.com/photo-1554224155-6726b3ff858f',
    'hr': 'https://images.unsplash.com/photo-1521791136064-7986c2920216',
    'human_resources': 'https://images.unsplash.com/photo-1521791136064-7986c2920216',
    'management': 'https://images.unsplash.com/photo-1552664730-d307ca884978',
    'legal': 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73',

    // Healthcare & Science
    'health': 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528',
    'medical': 'https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7',
    'doctor': 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d',
    'pharmacy': 'https://images.unsplash.com/photo-1585435557343-3b092031a831',
    'biotech': 'https://images.unsplash.com/photo-1532094349884-543bc11b234d',

    // Engineering & Construction
    'civil': 'https://images.unsplash.com/photo-1503387762-592deb58ef4e',
    'architecture': 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab',
    'mechanical': 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158',
    'electrical': 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4',
    'construction': 'https://images.unsplash.com/photo-1541888086425-d81bb19240f5',

    // Education
    'education': 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655',
    'teaching': 'https://images.unsplash.com/photo-1577896851231-70ef18881754',

    // Logistics & Others
    'logistics': 'https://images.unsplash.com/photo-1586528116311-ad8ed7c1590f',
    'supply_chain': 'https://images.unsplash.com/photo-1565891741441-64926e441838',
    'customer_service': 'https://images.unsplash.com/photo-1519389950473-47ba0277781c'
};

export const DEFAULT_CAREER_IMAGE = 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80';

export const getCareerImage = (key, title = '') => {
    // Safely cast key to string
    const stringKey = key != null ? String(key) : '';

    // If key is a full URL, return it
    if (stringKey && (stringKey.startsWith('http') || stringKey.startsWith('data:') || stringKey.startsWith('/'))) {
        return stringKey;
    }

    const searchStr = `${stringKey} ${title || ''}`.toLowerCase().trim().replace(/\s+/g, '_');

    // Check direct matches in catalog
    if (key) {
        const normalizedKey = key.toString().toLowerCase().trim().replace(/\s+/g, '_');
        if (careerImages[normalizedKey]) {
            return `${careerImages[normalizedKey]}?auto=format&fit=crop&w=1200&q=80`;
        }
    }

    // Keyword based fallbacks mapping
    const keywordMap = [
        { keywords: ['software', 'engineer', 'developer', 'code', 'backend', 'frontend', 'app', 'programmer'], imageKey: 'software' },
        { keywords: ['data', 'analyst', 'stat', 'math', 'science', 'analytics'], imageKey: 'data' },
        { keywords: ['market', 'seo', 'ads', 'business', 'social', 'campaign'], imageKey: 'marketing' },
        { keywords: ['design', 'ui', 'ux', 'creative', 'graphic', 'motion', 'art'], imageKey: 'uiux' },
        { keywords: ['finance', 'bank', 'account', 'audit', 'tax', 'investment', 'money'], imageKey: 'finance' },
        { keywords: ['hr', 'human', 'resource', 'recruit', 'talent'], imageKey: 'hr' },
        { keywords: ['sales', 'b2b', 'retail', 'account executive', 'sell'], imageKey: 'sales' },
        { keywords: ['legal', 'law', 'attorney', 'court', 'compliance'], imageKey: 'legal' },
        { keywords: ['health', 'medic', 'doctor', 'nurse', 'hospital', 'clinic', 'care'], imageKey: 'health' },
        { keywords: ['civil', 'construct', 'build', 'architect'], imageKey: 'civil' },
        { keywords: ['teach', 'educat', 'school', 'tutor', 'professor'], imageKey: 'education' },
        { keywords: ['logistic', 'supply', 'chain', 'transport', 'warehouse'], imageKey: 'logistics' },
        { keywords: ['manager', 'management', 'lead', 'director', 'admin'], imageKey: 'management' },
        { keywords: ['write', 'content', 'copy', 'edit', 'journal'], imageKey: 'writer' },
        { keywords: ['cyber', 'security', 'hack', 'protect'], imageKey: 'cybersecurity' },
        { keywords: ['network', 'system', 'admin', 'support', 'it '], imageKey: 'networking' }
    ];

    for (const group of keywordMap) {
        for (const kw of group.keywords) {
            if (searchStr.includes(kw)) {
                return `${careerImages[group.imageKey]}?auto=format&fit=crop&w=1200&q=80`;
            }
        }
    }

    // If all else fails, generate a pseudo-random image from the catalog based on string length 
    // to keep it looking varied rather than repeating the same default image everywhere.
    const keys = Object.keys(careerImages);
    const fallbackIndex = searchStr.length % keys.length;
    return `${careerImages[keys[fallbackIndex]]}?auto=format&fit=crop&w=1200&q=80`;
};
