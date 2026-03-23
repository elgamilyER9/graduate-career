/**
 * Service to handle university related API operations.
 */
export const universityService = {
    /**
     * Fetches all universities from the API.
     * @returns {Promise<Array>}
     */
    async fetchUniversities() {
        try {
            const response = await fetch('/api/getuniversities');
            if (!response.ok) throw new Error('Network response was not ok');
            const result = await response.json();
            
            // The API returns { count: X, data: [...] }
            return result.data || [];
        } catch (error) {
            console.error('Failed to fetch universities:', error);
            return [];
        }
    },

    /**
     * Fetches a single university by ID.
     * @param {string|number} id 
     * @returns {Promise<Object|null>}
     */
    async fetchUniversityById(id) {
        try {
            const response = await fetch(`/api/showuniversity/${id}`);
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error(`Failed to fetch university with id ${id}:`, error);
            return null;
        }
    }
};
