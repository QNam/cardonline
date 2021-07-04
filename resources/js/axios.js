const axios = require('axios');

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

const http = axios.create({
    baseURL: process.env.MIX_APP_URL_API, 
    // headers: {'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': window.Laravel.csrfToken},
});


window.http = http

export default http