// 此檔案配置 Axios 作為前端 HTTP 客戶端的預設行為。

import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default axios;
