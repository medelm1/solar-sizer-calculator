import { api } from '@/utils';

async function fetchAll() {
    try {
        return await api.get('/api/categories');

    } catch (error) {
        console.error('Error while attempting to fetch the categories:', error);
        throw error;
    }
}

async function fetch(categoryId) {
    try {
        return await api.get(`/api/categories/${categoryId}`);

    } catch (error) {
        console.error('Error attempting to fetch the category:', error);
        throw error;
    } 
}

async function create(payload) {
    try {
        return await api.post('/api/categories', payload);

    } catch (error) {
        console.error('Error while attempting to add new category:', error);
        throw error;
    }
}

async function edit(payload, categoryId) {
    try {
        return await api.put(`/api/categories/${categoryId}`, payload);

    } catch (error) {
        console.error('Error while attempting to edit the category:', error);
        throw error;
    }
}

async function remove(categoryId) {
    try {
        await api.del(`/api/categories/${categoryId}`);
        
    } catch (error) {
        console.error('Error while attempting to delete the category:', error);
        throw error;
    }
}

export default {
    fetchAll,
    fetch,
    create,
    edit,
    remove,
};