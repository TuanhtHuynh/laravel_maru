import { store } from '../store';
export const getMenus = () => {
    axios
        .get(url + "/getmenus")
        .then((data) => {
            store.menu.menus = data.data.menus;
        })
};
export const getAllMenus = async () => {
    await axios
        .get(url + "/get")
        .then((data) => {
            store.menu.menus = data.data.menus;
        }).catch(e => alert("Kết nối data đóng.\nVui lòng truy cập sau 11h.\nCảm ơn"))
};
export const getSubMenus = () => {
    axios
        .get(url + "/getsubmenus")
        .then((data) => {
            store.menu.submenus = data.data.submenus;
        })
};
export const getMenuLevel = () => {
    axios
        .get(url + "/getMenulevel2s")
        .then((data) => {
            store.menu.menulevel2 = data.data.menu_level2s;
        })
};


const url = store.UrlApi + "menu";