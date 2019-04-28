export default {
    state: {
        contentEntries: [],
        medias: {}
    },
    getters: {
        contentEntries(state) {
            return state.contentEntries;
        },
        medias(state) {
            return state.medias;
        }
    },
    mutations: {
        updateContentEntries(state, payload) {
            state.contentEntries = payload;
        },
        updateMedias(state, payload) {
            state.medias[payload.key] = payload.files;
        }
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