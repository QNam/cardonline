const axios = require('axios');

const http = axios.create({
    baseURL: process.env.MIX_APP_URL_API, 
    headers: {'X-Requested-With': 'XMLHttpRequest'},
});

window.http = http

export default http