import React, { useState }  from 'react';
import axios from 'axios';

const Auth = () => {

    const [credentials, setCredentials ] = useState ({
        username: 'AtelierVelo',
        password: 'velovelo'
    });

    const [token, setToken ] = useState();

    // Get Bearer Token with admin credentials
    axios.post('http://atelier.lndo.site/api/login_check', credentials) 
        .then(res => {
            localStorage.setItem('authToken', res.data.token);
            // axios.defaults.headers.common['Authorization'] = `Bearer ${res.data.token}`;
            setToken(res.data.token);
            // console.log(res);
            // console.log(res.data.token);

        })
        .catch(err => console.log(err));

        // console.log(token);
        // return token;
};

export default Auth;