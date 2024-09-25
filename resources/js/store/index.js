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
        async fetchItems({ commit }) {
            try {
                const response = await axios.get(apiUrls.fetchItems);
                commit('setItems', response.data); 
            } catch (error) {
                console.error('Error fetching items:', error); 
            }
        },
        // Add new item to store
        async createItem({ commit }, item) {
            try {
                const response = await axios.post(apiUrls.storeItem, { item });
                commit('addItem', response.data); 
            } catch (error) {
                console.error('Error adding item:', error); 
            }
        },
        // Update existing item in store
        async updateItem({ commit }, item) {
            try {
                const response = await axios.put(apiUrls.updateItem(item.id), { item });
                commit('updateItem', response.data); 
            } catch (error) {
                console.error('Error updating item:', error); 
            }
        },
        // Remove item from store
        async deleteItem({ commit }, itemId) {
            try {
                const response = await axios.delete(apiUrls.destroyItem(itemId));
                commit('removeItem', itemId); 
            } catch (error) {
                console.error('Error deleting item:', error); 
            }
        },
        // Start item
        async startItem({ commit }, itemId) {
            try {
                await axios.put(apiUrls.start(itemId));
            } catch (error) {
                console.error('Error starting item:', error); 
            }
        },
        // Complete item
        async completeItem({ commit }, itemId) {
            try {
                await axios.put(apiUrls.complete(itemId));
            } catch (error) {
                console.error('Error completing item:', error); 
            }
        },
        // Archive item
        async archiveItem({ commit }, itemId) {
            try {
                await axios.put(apiUrls.archive(itemId));
            } catch (error) {
                console.error('Error archiving item:', error); 
            }
        },
        // Cancel item
        async cancelItem({ commit }, itemId) {
            try {
                await axios.put(apiUrls.cancel(itemId));
            } catch (error) {
                console.error('Error canceling item:', error); 
            }
        },
        // Restore item
        async restoreItem({ commit }, itemId) {
            try {
                await axios.put(apiUrls.restore(itemId));
            } catch (error) {
                console.error('Error restoring item:', error); 
            }
        },
        // Upload excel file
        async uploadExcelFile({ commit }, formData) {
            try {
                const respose = await axios.post(apiUrls.importItem, formData, {
                    headers: {'Content-Type': 'multipart/form-data'}
                });
                commit('setItems', response.data); 
            } catch (error) {
                console.error('Error uploading Excel file:', error);
            }
        },
        
        async exportExcelFile() {
            try {
                const response = await axios({
                    url: apiUrls.exportItem,
                    method: 'GET',
                    responseType: 'blob'  
                  });
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'items.xlsx');  
                document.body.appendChild(link);
                link.click();
                link.remove();
            } catch (error) {
                console.error('Error exporting Excel file:', error);
            }
          },

        async initDarkMode({ commit }) {
            try {
                const savedMode = await localStorage.getItem('dark-mode');
                commit('setDarkMode', savedMode === 'true');
            } catch (error) {
                console.error('Error initializing dark mode:', error);
            }
        },
    },

    // Get the list of items from the store
    getters: {
        items: state => state.items 
    }
});

export default store;
