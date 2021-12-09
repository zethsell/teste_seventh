import axios from 'axios';
import store from '.././store';
import router from '.././router'
import authHeader from './auth-header';

const API_URL = process.env.VUE_APP_ROOT_API;

class UserService {

    getContent(link, payload) {
        return axios.get(API_URL + link, {headers: authHeader(), params: {payload}})
            .then((response) => {
                return response
            })
            .catch((error) => {
                switch (error.response.status) {
                    case 401:
                        this.$sq
                        store.dispatch("auth/logout")
                        router.push({name: 'Login'});
                        console.log(error)
                        break;

                    case 422:
                        this.errors = error.response.data.errors;
                        break;

                    default:
                        this.msg = `Server Error: ${error.response.status}`;
                        break;
                }
            });

    }

    postContent(link, payload) {
        return axios.post(API_URL + link, payload, {headers: authHeader()})
            .then((response) => {
                return response
            }).catch((error) => {
                switch (error.response.status) {
                    case 401:
                        store.dispatch("auth/logout")
                        router.push({name: 'Login'});
                        break;

                    case 422:
                        this.errors = error.response.data.errors;
                        break;

                    default:
                        this.msg = `Server Error: ${error.response.status}`;
                        break;
                }
            });
    }

    putContent(link, payload) {
        return axios.put(API_URL + link, payload, {headers: authHeader()})
            .then((response) => {
                return response
            }).catch((error) => {
                switch (error.response.status) {
                    case 401:
                        store.dispatch("auth/logout")
                        router.push({name: 'Login'});
                        break;

                    case 422:
                        this.errors = error.response.data.errors;
                        break;

                    default:
                        this.msg = `Server Error: ${error.response.status}`;
                        break;
                }
            });
    }

    patchContent(link, payload) {
        return axios.patch(API_URL + link, payload, {headers: authHeader()})
            .then((response) => {
                return response
            }).catch((error) => {
                switch (error.response.status) {
                    case 401:
                        store.dispatch("auth/logout")
                        router.push({name: 'Login'});
                        break;

                    case 422:
                        this.errors = error.response.data.errors;
                        break;

                    default:
                        this.msg = `Server Error: ${error.response.status}`;
                        break;
                }
            });
    }

    deleteContent(link, id) {
        return axios.delete(API_URL + link + '/' + id, {headers: authHeader()});
    }

}

export default new

UserService();