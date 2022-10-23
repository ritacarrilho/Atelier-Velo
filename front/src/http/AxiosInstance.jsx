import axios from "axios";
import { connectionService } from "../services/connection.services";
import { setAuthToken } from "./setAuthToken";

const baseURL = 'http://atelier.lndo.site/api';

const getToken = () => localStorage.getItem("AuthToken")

export const getAuthorizationHeader = () => `Bearer ${getToken()}`;

export const AxiosInstance = axios.create({
  baseURL,
  headers: { Authorization: getAuthorizationHeader() },
});

// AxiosInstance.defaults.headers.common['Authorization'] = `Bearer ${getToken()}`;