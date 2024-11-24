export default {
    totalDailyEnergyConsumption() {
        return this.appliances.reduce(
            (total, appliance) => total + (appliance.powerRating * appliance.usageHours * appliance.units),
            0
        );
    }
};