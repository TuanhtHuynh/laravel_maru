import axios from "axios"
import { store } from '../store.js'

export const login = async (formData, redirect) => {
    await axios.get(urlCsrf)
        .then((res) => {
            axios.post(`${url}/login`, formData).then((reslogin) => {
                store.Authentication.user = reslogin.data.user;
                let token = reslogin.data.token;
                localStorage.setItem("token", token);
                if (redirect) {
                    redirect();
                }
            });
        });
}

export const logout = async (token, afterlogout) => {
    const options = {
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
            //'X-Authorization': `${token}`,
        }
    }
    await axios.post(`${store.UrlApi}logout`,
        null,
        options
    ).then(res => {
        if (afterlogout) {
            afterlogout()
        }
    });
}
const url = store.UrlApi + "auth";
const urlCsrf = store.UrlSanctumCsrf;
