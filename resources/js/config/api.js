const apiUrls = {
    fetchItems: '/api/item/',
    importItem: '/api/item/import',
    exportItem: '/api/item/export',
    storeItem: '/api/item/store',
    updateItem: (id) => `/api/item/${id}`,
    destroyItem: (id) => `/api/item/${id}`,
    
    start: (id) => `/api/item/start/${id}`,
    complete: (id) => `/api/item/complete/${id}`,
    archive: (id) => `/api/item/archive/${id}`,
    cancel: (id) => `/api/item/cancel/${id}`,
    restore: (id) => `/api/item/restore/${id}`,

    fetchUser: '/api/user/user',
    registerUser: '/api/user/register',
    loginUser: '/api/user/login',
    logoutUser: '/api/user/logout',
};

export default apiUrls;
