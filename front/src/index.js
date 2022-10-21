import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import Auth from './http/Auth';
import axios from "axios";

import "./styles/index.scss";
const root = ReactDOM.createRoot(document.getElementById('root'));

axios.interceptors.request.use(
    function(config) {
      const token = localStorage.getItem('authToken');

      if (token) {
        config.headers["Authorization"] = `Bearer ${token}`;
      }
      return config;
    },
    function(error) {
      return Promise.reject(error);
    }
  );

root.render(
    <React.StrictMode>
        <Auth /> 
        <App />
    </React.StrictMode>
    );