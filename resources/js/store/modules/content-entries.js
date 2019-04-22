export default {
    state: {
        contentEntries: [],
    },
    getters: {
        contentEntries(state) {
            return state.contentEntries;
        },
    },
    mutations: {
        updateContentEntries(state, payload) {
            state.contentEntries = payload;
        },
    },
    actions: {
        getEntries(context, params) {
            let queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');
            let url = '/api/content-entry?' + queryString;

            axios.get(url)
                .then((response) => {
                    context.commit('updateContentEntries', response.data);
                }).catch(() => {
                context.commit('updateContentEntries', {});
            });
        }
    }
};