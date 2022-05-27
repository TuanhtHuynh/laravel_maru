import axios from 'axios';
import { store } from '../store.js';
import { joinQueryString } from './actionHelper'

export const getCategories = async (page, perpage, sort, q = "") => {
    let query = {
        page: page,
        perpage: perpage,
        sort: sort,
    };
    const querystring = joinQueryString(query);
    const filter = q ? "q=" + q + "&" : "";

    await axios.get(`${url}get?${filter}${querystring}`).then((data) => {
        store.category.categories = data.data.categories;
    });
}
export const getCategoriesPromise = async (addroutes) => {
    return await axios.get(`${url}get`).then(data =>
        data.data.categories
    );
}

const url = store.UrlApi + 'category/';