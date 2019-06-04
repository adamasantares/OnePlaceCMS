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
            return new Promise((resolve, reject) => {
                let queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');
                let url = '/api/entry?' + queryString;

                axios.get(url)
                    .then((response) => {
                        context.commit('updateContentEntries', response.data);
                        resolve();
                    }).catch(() => {
                    context.commit('updateContentEntries', {});
                    reject();
                });
            });
        }
    }
};