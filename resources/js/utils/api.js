import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL
});

// Add a response interceptor to handle errors
axiosInstance.interceptors.response.use(
    (response) => response,
    (error) => {
        if (axios.isCancel(error)) {
            console.log('Request canceled', error.message);
        }
        return Promise.reject(error);
    }
);

/**
 * Makes a GET request to the specified URL and returns the response data.
 * @param {string} url - The URL to make the GET request to.
 * @param {object} [config] - Optional Axios request configuration.
 * @returns {Promise} A Promise that resolves to the response data.
 * @throws {Error} An error if the request fails.
 */
export async function get(url, config) {
    try {
        const response = await axiosInstance.get(url, config);
        return response.data;
    } catch (error) {
        throw error;
    }
}

/**
 * Sends a POST request to the specified URL with the given data and configuration.
 * @param {string} url - The URL to send the request to.
 * @param {object} data - The data to send with the request.
 * @param {object} [config] - Optional Axios request configuration.
 * @returns {Promise} A Promise that resolves to the response data.
 * @throws {Error} An error if the request fails.
 */
export async function post(url, data, config) {
    try {
        const response = await axiosInstance.post(url, data, config);
        return response.data;
    } catch (error) {
        throw error;
    }
}

/**
 * Sends a PUT request to the specified URL with the provided data and configuration.
 * @param {string} url - The URL to send the request to.
 * @param {object} data - The data to send with the request.
 * @param {object} [config] - Optional Axios request configuration.
 * @returns {Promise} A Promise that resolves to the response data.
 * @throws {Error} An error if the request fails.
 */
export async function put(url, data, config) {
    try {
        const response = await axiosInstance.put(url, data, config);
        return response.data;
    } catch (error) {
        throw error;
    }
}

/**
 * Sends a DELETE request to the specified URL using axiosInstance.
 * @param {string} url - The URL to send the request to.
 * @param {object} [config] - Optional Axios request configuration.
 * @returns {Promise} A Promise that resolves to the response data.
 * @throws {Error} An error if the request fails.
 */
export async function del(url, config) {
    try {
        const response = await axiosInstance.delete(url, config);
        return response.data;
    } catch (error) {
        throw error;
    }
}

export default { get, post, put, del };
