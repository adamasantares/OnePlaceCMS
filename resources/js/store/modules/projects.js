export default {
    state: {
        projects: [],
    },
    getters: {
        projects(state) {
            return state.projects;
        }
    },
    mutations: {
        updateProjects(state, payload) {
            state.projects = payload;
        },
    },
    actions: {
        getAllProjects(context) {
            axios.get('/api/project')
                .then((response) => {
                    context.commit('updateProjects', response.data);
                }).catch(() => {
                    context.commit('updateProjects', []);
                });
        }
    }
};