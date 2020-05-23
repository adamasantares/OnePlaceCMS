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
        },
        resetMedias(state) {
            state.medias = {};
        }
    },
    actions: {
        getEntries(context, params) {
            return new Promise((resolve, reject) => {
                axios.get('/api/content', {
                    params: params
                })
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
