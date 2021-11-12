let login = require("./components/auth/login.vue").default;
let register = require("./components/auth/register.vue").default;
let forget = require("./components/auth/forget.vue").default;
let home = require("./components/home.vue").default;
let logout = require("./components/auth/logout.vue").default;

// category component
let storecategory = require("./components/category/create.vue").default;
let category = require("./components/category/index.vue").default;
let editcategory = require("./components/category/edit.vue").default;

// subcategory component
let subcategory = require("./components/subcategory/index.vue").default;
let editsubcategory = require("./components/subcategory/edit.vue").default;

// subsubcategory component
let subSubcategory = require("./components/sub_subcategory/index.vue").default;
let editsubsubcategory = require("./components/sub_subcategory/edit.vue")
    .default;

// brand component
let brand = require("./components/brand/index.vue").default;
let editbrand = require("./components/brand/edit.vue").default;

// product component
let productcreate = require("./components/product/create.vue").default;
let product = require("./components/product/index.vue").default;
let productview = require("./components/product/view.vue").default;
let productedit = require("./components/product/edit.vue").default;



export const routes = [
    { path: "/", component: login, name: "/" },
    { path: "/register", component: register, name: "register" },
    { path: "/forget", component: forget, name: "forget" },
    { path: "/home", component: home, name: "home" },
    { path: "/logout", component: logout, name: "logout" },

    // category module
    {
        path: "/store-category",
        component: storecategory,
        name: "store-category"
    },
    { path: "/category", component: category, name: "category" },
    {
        path: "/edit-category/:id",
        component: editcategory,
        name: "edit-category"
    },

    // sub-category module
    {
        path: "/sub-category",
        component: subcategory,
        name: "subcategory"
    },
    {
        path: "/edit-subcategory/:id",
        component: editsubcategory,
        name: "edit-subcategory"
    },

    // sub-sub category module
    {
        path: "/sub-sub-category",
        component: subSubcategory,
        name: "subsubcategory"
    },
    {
        path: "/edit-sub-sub-category/:id",
        component: editsubsubcategory,
        name: "editsubsubcategory"
    },

    // brand module
    { path: "/brand", component: brand, name: "brand" },
    { path: "/edit-brand/:id", component: editbrand, name: "edit-brand" },

    // product module
    { path: "/create-product", component: productcreate, name: "productcreate" },
    { path: "/view-product/:id", component: productview, name: "view-product" },
    { path: "/edit-product/:id", component: productedit, name: "edit-product" },
    { path: "/product", component: product, name: "product" },
];
