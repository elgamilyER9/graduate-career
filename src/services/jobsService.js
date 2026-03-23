import { getCareerPaths, saveCareerPath, deleteCareerPath as storageDelete } from '../utils/storage';

/**
 * Service to handle job/career related API operations.
 * Currently mocks a real backend using localStorage via storage.js.
 */
export const jobsService = {
    /**
     * Fetches all jobs.
     * @returns {Promise<Array>}
     */
    async fetchJobs() {
        try {
            const response = await fetch('/api/getjobs');
            if (!response.ok) throw new Error('Network response was not ok');
            const result = await response.json();
            const apiJobs = result.data || result;
            
            return apiJobs.map(job => {
                let industry = 'Software Engineering'; // default
                
                const pathName = job.career_path ? job.career_path.name.toLowerCase() : '';
                const title = job.title ? job.title.toLowerCase() : '';
                const combinedStr = `${pathName} ${title}`;
                
                if (combinedStr.includes('بيانات') || combinedStr.includes('data') || combinedStr.includes('ذكاء') || combinedStr.includes('ai')) {
                    industry = 'Data Science';
                } else if (combinedStr.includes('تصميم') || combinedStr.includes('design') || combinedStr.includes('ui') || combinedStr.includes('ux') || combinedStr.includes('جرافيك')) {
                    industry = 'Creative Design';
                } else if (combinedStr.includes('تسويق') || combinedStr.includes('marketing') || combinedStr.includes('مشاريع') || combinedStr.includes('project') || combinedStr.includes('sales')) {
                    industry = 'Strategic Marketing';
                }
                
                return {
                    ...job,
                    // Normalize fields for Home.jsx rendering
                    id: job.id,
                    title: job.title,
                    description: job.description || 'لا يوجد وصف متاح حالياً للتفاصيل الخاصة بهذه الوظيفة.',
                    industry: industry,
                    level: job.type || 'Mid-Level',
                };
            });
        } catch (error) {
            console.error('Failed to fetch jobs from API, falling back to local storage', error);
            // Simulating network delay for fallback
            return new Promise((resolve) => {
                setTimeout(() => {
                    const data = getCareerPaths();
                    resolve(data);
                }, 500);
            });
        }
    },

    /**
     * Adds a new job to the system.
     * @param {Object} jobData 
     * @returns {Promise<Object>}
     */
    async addJob(jobData) {
        return new Promise((resolve) => {
            setTimeout(() => {
                const newJob = {
                    ...jobData,
                    id: jobData.id || `job_${Date.now()}`,
                    level: jobData.level || 'Junior', // Default level
                    skills: jobData.skills || []
                };
                saveCareerPath(newJob);
                resolve(newJob);
            }, 300);
        });
    },

    /**
     * Deletes a job by ID.
     * @param {string|number} id 
     * @returns {Promise<boolean>}
     */
    async deleteJob(id) {
        return new Promise((resolve) => {
            setTimeout(() => {
                storageDelete(id);
                resolve(true);
            }, 300);
        });
    },

    /**
     * Dynamically extracts unique industries/categories from a list of jobs.
     * @param {Array} jobs 
     * @returns {Array<string>}
     */
    getUniqueCategories(jobs) {
        return [...new Set(jobs.map(job => job.industry || job.category).filter(Boolean))].sort();
    }
};
