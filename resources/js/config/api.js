const apiUrls = {
    fetchItems: '/api/item/',
    importItem: '/api/item/import',
    exportItem: '/api/item/export',
    storeItem: '/api/item/store',
    updateItem: (id) => `/api/item/${id}`,
    destroyItem: (id) => `/api/item/${id}`,

    fetchUser: '/api/user/user',
    registerUser: '/api/user/register',
    loginUser: '/api/user/login',
    logoutUser: '/api/user/logout',
};

export default apiUrls;
