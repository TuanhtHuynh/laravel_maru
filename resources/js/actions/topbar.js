import { store } from '../store'

export const getTopbarImage = async () => {
    await axios.get(`${url}/gettopbar`).then((data) => {
        store.topbar.topbars = data.data.topbars;
    });
}
const url = store.UrlApi + "topbar";