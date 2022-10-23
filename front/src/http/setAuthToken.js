import axios from 'axios';
import { connectionService } from '../services/connection.services';

export const setAuthToken = token => {
    if (token) {
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

    }
    // else
    //     delete axios.defaults.headers.common["Authorization"];
}