import axios from "axios";
import { setAuthToken } from "./setAuthToken";
import { connectionService } from "../services/connection.services";

 const Connection = () =>  {

    // api credentials
    const credentials = {
        username: 'AtelierVelo',
        password: 'velovelo'
    }

    const apiUrl = "http://atelier.lndo.site/api/login_check";
  
    axios.post(apiUrl, credentials)
      .then(response => {
        //get token from response
        const token  =  response.data.token;
        // localStorage.setItem('AuthToken', token);
        connectionService.saveToken(token);

        // console.log(response.data.token);

        //set token to axios common header
        setAuthToken(token);

        // AxiosInstance.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('AuthToken');
      })

      .catch(err => console.log(err));
  };


export default Connection;