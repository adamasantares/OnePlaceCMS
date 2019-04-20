export default {
    state: {

    },
    getters: {

    },
    mutations: {

    },
    actions: {
        getEntries(context, params) {
            let queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');
            let url = '/api/content-entry?' + queryString;

            axios.get(url)
                .then((response) => {
                    context.commit('updateEntries', response.data);
                }).catch(() => {
                context.commit('updateEntries', {});
            });
        }
    }
};