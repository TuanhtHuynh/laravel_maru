//import { ref } from 'vue';
import { reactive, toRefs } from 'vue';

export default function useProducts() {
    const url = "http://localhost:8000/api/product";
    const error = ref(null);
    const products = ref(null);
    const state = reactive({
        error: null,
        products: null
    })

    const load = async () => {
        try {
            await axios
                .get(url + "/get")
                .then((data) => {
                    state.products = data.data.data
                });
        } catch (error) {
            state.error = e;
        }
    }

    return { ...toRefs(state), load }
}