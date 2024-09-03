import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
    state: {
        items: []
    },
    mutations: {
        setItems(state, items) {
            state.items = items;
        },
        addItem(state, item) {
            state.items.push(item);
        },
        updateItem(state, updatedItem) {
            const index = state.items.findIndex(item => item.id === updatedItem.id);
            if (index !== -1) {
                state.items.splice(index, 1, updatedItem);
            }
        },
        removeItem(state, itemId) {
            state.items = state.items.filter(item => item.id !== itemId);
        }
    },
    actions: {
        fetchItems({ commit }) {
            return axios.get('/api/items')
                .then(response => {
                    commit('setItems', response.data);
                })
                .catch(error => {
                    console.error('Error fetching items:', error);
                });
        },
        createItem({ commit }, item) {
            return axios.post('/api/item/store', { item })
                .then(response => {
                    commit('addItem', response.data);
                })
                .catch(error => {
                    console.error('Error adding item:', error);
                    throw error;
                });
        },
        updateItem({ commit }, item) {
            return axios.put(`/api/item/${item.id}`, { item })
                .then(response => {
                    commit('updateItem', response.data);
                })
                .catch(error => {
                    console.error('Error updating item:', error);
                    throw error;
                });
        },
        deleteItem({ commit }, itemId) {
            return axios.delete(`/api/item/${itemId}`)
                .then(() => {
                    commit('removeItem', itemId);
                })
                .catch(error => {
                    console.error('Error deleting item:', error);
                    throw error;
                });
        }
    },
    getters: {
        items: state => state.items
    }
});

export default store;
