import Vue from 'vue';

const url = "https://maruht.herokuapp.com";
const urllocal = "http://localhost:8000";
export const store = Vue.observable({
    UrlApi: `${url}/api/`,
    UrlSanctumCsrf: `${url}/sanctum/csrf-cookie`,
    Authentication: {
        user: {},
        token: '',
        loading: false
    },
    topbar: {
        topbars: [],
        error: ''
    },
    category: {
        categories: [],
        perpage: 5,
        sort: 'asc',
        query: '',
        page: 1,
        loading: false
    },
    menu: {
        menus: [],
        submenus: [],
        menulevel2: []
    },
    product: {
        products: [],
        products_filter: [],
        products_discount: [],
        page: 1,
        perpage: 5,
        last_page: 5,
        total_item: 0,
        filter_count: 0,
        sort: 'asc',
        query: "",
        product_detail: {},
        cateSlug: '',
        cateName: '',
        loading: false,
        error: ''
    },
})

export const mutations = {
    setProducts: (value) => store.product.products = value,
    setPage: (value) => store.product.products = value,
}

export const product = Vue.observable({
    products: [],
    page: 1,
    perpage: 5,
    last_page: 1,
    sort: "desc",
    query: ""
})
export const getProducts1 = (page, perpage, sort, q = "") => {
    let query = {
        page: page,
        perpage: perpage,
        sort: sort,
    };
    const querystring = joinQueryString(query);
    const filter = q ? "q=" + q + "&" : "";
    axios
        .get(url + "/get?" + filter + querystring)
        .then((data) => {
            product.products = data.data.data;
            product.page = +data.data.page;
            product.perpage = +data.data.perpage;
            product.last_page = +data.data.last_page;
            product.sort = data.data.sort;
            product.query = data.data.q;
        })
        .catch((e) => alert(e));
}

export const joinQueryString = (query) => {
    return Object.keys(query)
        .map((k) => `${k}=${query[k]}`)
        .join("&")
        .trim();
}