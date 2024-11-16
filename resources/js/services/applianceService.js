import { api } from '@/utils';

async function fetchAll() {
    try {
        return await api.get('/api/appliances');

    } catch (error) {
        console.error('Error while attempting to fetch the appliances:', error);
        throw error;
    }
}

async function fetch(applianceId) {
    try {
        return await api.get(`/api/appliances/${applianceId}`);

    } catch (error) {
        console.error('Error attempting to fetch the appliance:', error);
        throw error;
    } 
}

async function create(payload) {
    try {
        return await api.post('/api/appliances', payload);

    } catch (error) {
        console.error('Error while attempting to add new appliance:', error);
        throw error;
    }
}

async function edit(payload, applianceId) {
    try {
        return await api.put(`/api/appliances/${applianceId}`, payload);

    } catch (error) {
        console.error('Error while attempting to edit the appliance:', error);
        throw error;
    }
}

async function remove(applianceId) {
    try {
        await api.del(`/api/appliances/${applianceId}`);
        
    } catch (error) {
        console.error('Error while attempting to delete the appliance:', error);
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