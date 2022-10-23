import React from "react";
import axios from "axios";
import { setAuthToken } from "./setAuthToken";
import { connectionService } from "../services/connection.services";

function Connection() {
    
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

        connectionService.saveToken(token);

        console.log(response.data.token);

        //set token to axios common header
        setAuthToken(token);
      })

      .catch(err => console.log(err));
  };


export default Connection;