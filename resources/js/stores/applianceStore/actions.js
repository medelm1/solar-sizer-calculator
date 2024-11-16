import _ from 'lodash';

export default {
    init(appliances = []) {
        this.appliances = appliances;
    },

    addAppliance(appliance) {
        this.appliances.push(appliance);
    },

    // updateAppliance(updatedAppliance) {
    //     const idx = _.findIndex(this.appliances, { id: updatedAppliance.id });

    //     if (idx !== -1) {
    //         this.appliances.splice(idx, 1, updatedAppliance);
    //     } else {
    //         console.error('Appliance not found');
    //     }
    // },

    // removeAppliance(applianceId) {
    //     _.remove(this.appliances, appliance => appliance.id === applianceId);
    // },

    // getApplianceById(applianceId) {
    //     const appliance = _.find(this.appliances, { id: applianceId });
    //     return appliance || null;
    // }
};