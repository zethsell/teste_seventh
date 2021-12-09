import axios from 'axios';
import authHeader from './auth-header';

const API_URL = process.env.VUE_APP_ROOT_API;

class AxiosService {

    getContent(link, payload) {
        return axios.get(API_URL + link, {headers: authHeader(), params: {payload}})
            .then((response) => {
                return response
            })
            .catch((error) => {
                console.log(error)
            });

    }

    postContent(link, payload) {
        return axios.post(API_URL + link, payload, {headers: authHeader()})
            .then((response) => {
                return response
            }).catch((error) => {
                console.log(error)
            });
    }

    putContent(link, payload) {
        return axios.put(API_URL + link, payload, {headers: authHeader()})
            .then((response) => {
                return response
            }).catch((error) => {
                console.log(error)
            });
    }

    patchContent(link, payload) {
        return axios.patch(API_URL + link, payload, {headers: authHeader()})
            .then((response) => {
                return response
            }).catch((error) => {
                console.log(error)
            });
    }

    deleteContent(link, id) {
        return axios.delete(API_URL + link + '/' + id, {headers: authHeader()});
    }

}

export default new

AxiosService();