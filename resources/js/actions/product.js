import { store } from '../store.js';
import { joinQueryString } from '../actions/actionHelper.js'
import axios from 'axios';

export const getProducts = async (page, perpage, sort, showMore = false, category_slug = "", q = "") => {
    let query = {
        page: page,
        perpage: perpage,
        sort: sort,
    };
    store.product.cateName = '';
    if (category_slug && category_slug != "") {
        query.category_slug = category_slug;
    }
    const querystring = joinQueryString(query);
    const filter = q ? "q=" + q + "&" : "";
    await axios
        .get(url + "/get?" + filter + querystring)
        .then((data) => {
            let total_item = data.data.total_item;
            if (showMore) {
                let store_length = store.product.products.length;
                if (store_length > 0 && store_length < total_item) {
                    store.product.products.push(...data.data.products);
                }
            } else {
                store.product.products = [];
                store.product.products = data.data.products;
            }
            store.product.page = +data.data.page;
            store.product.perpage = +data.data.perpage;
            store.product.last_page = +data.data.last_page;
            store.product.cateSlug = data.data.cateSlug;
            store.product.total_item = total_item;
            store.product.q = q;
            store.product.cateName = data.data.cateName;
        }).catch((error) => {
            store.product.loading = false;
            store.product.products = [];
            store.product.error = error.response.data.error || "";
        });
};

export const getProductsSuggest = async (page, perpage, sort, q = "") => {
    let query = {
        page: page,
        perpage: perpage,
        sort: sort,
    };
    const querystring = joinQueryString(query);
    const filter = q ? "q=" + q + "&" : "";
    await axios
        .get(url + "/get?" + filter + querystring)
        .then((data) => {

            store.product.products_filter = data.data.products;
            store.product.filter_count = data.data.total;
            store.product.q = q;
        }).catch((error) => {
            store.product.loading = false;
            store.product.products_filter = [];
            store.product.error = error.response.data.error || "";
        });
};

export const getLastProducts_Discount = (take, discount = false) => {
    let query = {
        take,
        discount
    }
    const querystring = joinQueryString(query);
    store.product.loading = true;
    axios
        .get(url + "/getlast?" + querystring).then(data => {
            store.product.products_discount = data.data.last_products;
            store.product.category_slug = data.data.category_slug;
            store.product.loading = false;
        }).catch(error => {
            store.product.loading = false;
            store.product.products = [];
            store.product.error = error.response.data.error || error.message;
        })
}

export const getProductDetail = async (ctg_slug, product_slug) => {
    store.product.loading = true;
    await axios
        .get(url + "/getproduct/" + ctg_slug + "/" + product_slug)
        .then((data) => {
            store.product.product_detail = data.data.product_detail[0];
            store.product.loading = false;
        }).catch(error => {
            store.product.loading = false;
            store.product.products = [];
            store.product.error = error.response.data.error || error.message;
        })
}
export const editProduct = async (id) => {
    await axios
        .get(url + "/edit/" + id)
        .then((data) => {
            store.product.product_detail = data.data.product;
        }).catch(error => {
            store.product.loading = false;
            store.product.product_detail = [];
        })
}

export const addProduct = async (data) => {
    let config = { headers: { _token: "{{ csrf-token() }}" } };
    await axios.post(url + '/add', data)
        .catch(error => alert(error));
}

const url = store.UrlApi + "product";