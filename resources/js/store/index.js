import { createStore } from 'vuex';
import axios from 'axios';
import apiUrls from '../config/api.js';

const store = createStore({
    state: {
        // Store the list of items
        items: [],
        isDarkMode: false,
    },
    mutations: {
        // Set the entire list of items
        setItems(state, items) {
            state.items = items; 
        },
        // Add a new item to the list
        addItem(state, item) {
            state.items.push(item); 
        },
        // Update the item in the list
        updateItem(state, updatedItem) {
            const index = state.items.findIndex(item => item.id === updatedItem.id);
            if (index !== -1) {
                state.items.splice(index, 1, updatedItem); 
            }
        },
        // Remove item by ID
        removeItem(state, itemId) {
            state.items = state.items.filter(item => item.id !== itemId); 
        },

        toggleDarkMode(state) {
            state.isDarkMode = !state.isDarkMode;
            localStorage.setItem('dark-mode', state.isDarkMode);
            if (state.isDarkMode) {
              document.body.classList.add('dark-mode');
            } else {
              document.body.classList.remove('dark-mode');
            }
        },

        setDarkMode(state, payload) {
            state.isDarkMode = payload;
            if (payload) {
              document.body.classList.add('dark-mode');
            } else {
              document.body.classList.remove('dark-mode');
            }
        },
    },
    actions: {
        // Fetch items from API and update store
        fetchItems({ commit }) {
            return axios.get(apiUrls.fetchItems)
                .then(response => {
                    commit('setItems', response.data); 
                })
                .catch(error => {
                    console.error('Error fetching items:', error); 
                });
        },
        // Add new item to store
        createItem({ commit }, item) {
            return axios.post(apiUrls.storeItem, { item })
                .then(response => {
                    commit('addItem', response.data); 
                })
                .catch(error => {
                    console.error('Error adding item:', error); 
                    throw error; 
                });
        },
        // Update existing item in store
        updateItem({ commit }, item) {
            return axios.put(apiUrls.updateItem(item.id), { item })
                .then(response => {
                    commit('updateItem', response.data); 
                })
                .catch(error => {
                    console.error('Error updating item:', error); 
                    throw error; 
                });
        },
        // Remove item from store
        deleteItem({ commit }, itemId) {
            return axios.delete(apiUrls.destroyItem(itemId))
                .then(() => {
                    commit('removeItem', itemId); 
                })
                .catch(error => {
                    console.error('Error deleting item:', error); 
                    throw error; 
                });
        },

        uploadExcelFile({ commit }, formData) {
            return axios.post(apiUrls.importItem, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                commit('setItems', response.data); 
            })
            .catch(error => {
                console.error('Error uploading Excel file:', error);
                throw error;
            });
        },
        exportExcelFile() {
            return axios({
              url: apiUrls.exportItem,
              method: 'GET',
              responseType: 'blob'  
            })
            .then((response) => {
              const url = window.URL.createObjectURL(new Blob([response.data]));
              const link = document.createElement('a');
              link.href = url;
              link.setAttribute('download', 'items.xlsx');  
              document.body.appendChild(link);
              link.click();
              link.remove();
            })
            .catch(error => {
              console.error('Error exporting Excel file:', error);
              throw error;
            });
          },

        initDarkMode({ commit }) {
            const savedMode = localStorage.getItem('dark-mode');
            commit('setDarkMode', savedMode === 'true');
        
        },
    },


    // Get the list of items from the store
    getters: {
        items: state => state.items 
    }
});

export default store;
