import { createStore } from 'vuex';
import axios from 'axios';
import apiUrls from '../config/api.js';

// Set the default Authorization header if the token exists
const token = localStorage.getItem('token');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

const store = createStore({
    state: {
        // Store the list of items
        items: [],
        isDarkMode: false,
        token: token || null,
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
        setToken(state, token) {
            state.token = token;
            localStorage.setItem('token', token);
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        },
        
        clearToken(state) {
            state.token = null;
            localStorage.removeItem('token');
            delete axios.defaults.headers.common['Authorization'];
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
                const response = await axios.post(apiUrls.storeItem, { item },
                    {headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}` // Add the token to the header
                      }
            });
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
                const response = await axios.post(apiUrls.importItem, formData, {
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
        //Register
        async registerUser({commit}, userData) {
            try {
                const response = await axios.post(apiUrls.registerUser, {
                    name: userData.name,
                    email: userData.email,
                    password: userData.password,
                    password_confirmation: userData.password_confirmation
                });
                commit('setToken', response.data.access_token);
                return true;
            } catch (error) {
                console.error('Registration error:', error);
                throw new Error('Error during registration');
            }
        },
        //Login
        async loginUser({commit}, credentials) {
            try {
                const response = await axios.post(apiUrls.loginUser, {
                    email: credentials.email,
                    password: credentials.password,
                });
                commit('setToken', response.data.access_token);
                return true;
            } catch (error) {
                console.error('Login error:', error);
                throw new Error('Invalid credentials');
            }
        },
        //Logout
        async logoutUser({commit}) {
            try {
                await axios.post(apiUrls.logoutUser);
            } catch (error) {
                console.error('Logout error:', error);
            }
            commit('clearToken');
        }

    },

    // Get the list of items from the store
    getters: {
        items: state => state.items,
        isAuthenticated: state => !!state.token, 
    }
});

export default store;
