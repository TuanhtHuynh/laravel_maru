import Vue from 'vue';
import Router from "vue-router";

Vue.use(Router);
const routes = [
    {
        path: '/',
        redirect: { name: 'index' },
        component: () =>
            import("./views/Home/HomeLayout.vue"),
        children: [
            {
                path: '',
                name: 'index',
                component: () =>
                    import('./views/Home/Home.vue')
            },
            {
                path: '/tim-kiem',
                component: () =>
                    import('./views/Home/HomeSearch.vue'),
            },
            {
                path: '/maru/:category_slug',
                component: () =>
                    import("./views/Home/Product_Category.vue"),
            },
            {
                path: '/gioi-thieu',
                component: () =>
                    import("./views/Home/About.vue"),
            },
            // {
            //     path: '/:NotFound(.*)*',
            //     component: () =>
            //         import("./views/Home/Home.vue")
            // }
        ]
    },
    {
        path: '/admin',
        redirect: { name: 'adminlogin' },
        component: () => import("./views/Admin/AdminLayout.vue"),
        children: [
            {
                path: 'dashboard',
                name: 'admin-dashboard',
                component: () =>
                    import('./views/Admin/Dashboard.vue'),
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: 'category',
                name: 'admin-category-index',
                component: () =>
                    import('./views/Admin/Category/CategoryIndex.vue'),
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: 'product',
                name: 'admin-product-index',
                component: () =>
                    import('./views/Admin/Products/ProductIndex.vue'),
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'product/new',
                name: 'product-new',
                component: () =>
                    import('./views/Admin/Products/ProductNew.vue'),
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'product/edit/:id',
                name: 'product-edit',
                component: () =>
                    import('./views/Admin/Products/ProductEdit.vue'),
                meta: {
                    requiresAuth: true
                },
            },
            {
                path: 'secure',
                name: 'secure',
                component: () => import('./views/Security.vue'),
                meta: {
                    requiresAuth: true
                }
            },
        ]
    },
    {
        path: '/admin/login',
        name: 'adminlogin',
        component: () =>
            import("./views/Login.vue")
    },
    {
        path: '/login',
        name: 'userlogin',
        component: () =>
            import("./views/Home/UserLogin.vue")
    },
    {
        path: '/signup',
        name: 'usersignup',
        component: () =>
            import("./views/Home/UserSignUp.vue")
    },

]
const router = new Router({
    mode: 'history',
    linkActiveClass: 'active',
    routes
});
router.beforeEach((to, from, next) => {
    let ctgslug = to.params.category_slug ? " - " + to.params.category_slug.replace('-', ' ') : "";
    document.title = "Maru" + ctgslug;

    if (to.path == '/admin/login') {
        if (localStorage.getItem("token")) {
            next({ name: 'admin-dashboard' });
        }
        next();
    }
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem("token")) {
            next();
        } else {
            next({ name: 'adminlogin' })
        }
    }
    next();
})
export default router;
