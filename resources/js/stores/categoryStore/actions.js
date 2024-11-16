import _ from 'lodash';

export default {
    init(categories = []) {
        this.categories = categories;
    },

    addCategory(category) {
        this.categories.push(category);
    },

    updateCategory(updatedCategory) {
        const idx = _.findIndex(this.categories, { id: updatedCategory.id });

        if (idx !== -1) {
            this.categories.splice(idx, 1, updatedCategory);
        } else {
            console.error('Category not found');
        }
    },

    removeCategory(categoryId) {
        _.remove(this.categories, category => category.id === categoryId);
    }
};