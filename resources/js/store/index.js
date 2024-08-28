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
            return axios.post('/api/items', item)
                .then(response => {
                    commit('addItem', response.data);
                })
                .catch(error => {
                    console.error('Error adding item:', error);
                });
        },
        deleteItem({ commit }, itemId) {
            return axios.delete(`/api/items/${itemId}`)
                .then(() => {
                    commit('removeItem', itemId);
                })
                .catch(error => {
                    console.error('Error deleting item:', error);
                });
        }
    },
    getters: {
        items: state => state.items
    }
});

export default store;
