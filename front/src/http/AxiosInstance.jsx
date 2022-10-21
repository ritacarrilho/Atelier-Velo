import axios from "axios";

const apiUrl = 'http://atelier.lndo.site/api';
// get token from local storage
const token = localStorage.getItem('authToken');

export const AxiosInstance = axios.create({
    baseURL: apiUrl,
    headers: {
        Authorization: `Bearer ${token}`
    },
    credentials: true,
})

// API connection credentials
// const credentials = {
//     username: 'AtelierVelo',
//     password: 'velovelo'
// };

// // Get Bearer Token with admin credentials
// const getTokenValue = axios.post('http://atelier.lndo.site/api/login_check', credentials) 
//     .then(res => {
//         if (res.status == 200) {
//             localStorage.removeItem('authToken')
//             localStorage.setItem('authToken', res.data.token)
//         }
//         console.log(res.data.token);
//         return res.data.token
//     })
//     .catch(err => console.log(err));

// // API url
// const baseUrl = 'http://atelier.lndo.site/api';
// // const token = localStorage.getItem('authToken');

// const AxiosInstance = axios.create({
//     baseURL: baseUrl,
//     credentials: true,
// })

// AxiosInstance.interceptors.request.use(function (config) {
//     let token = localStorage.getItem("authToken");
//     config = {
//         headers: {
//             "Authorization":  `Bearer ${token}`
//         }
//     }
//     return config;
//   });

//   export default AxiosInstance;