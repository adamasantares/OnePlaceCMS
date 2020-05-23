import { getLocalUser } from "../helpers/auth";

const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        titlePage: '',
        successMessage: '',
        errorMessage: [],
        sidebarShow: false,
        allContentModels: []
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        titlePage(state) {
            return state.titlePage;
        },
        successMessage(state) {
            return state.successMessage;
        },
        errorMessage(state) {
            return state.errorMessage;
        },
        sidebarShow(state) {
            return state.sidebarShow;
        },
        allContentModels(state) {
            return state.allContentModels;
        }
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        updateTitlePage(state, payload) {
            state.titlePage = payload;
        },
        updateSuccessMessage(state, payload) {
            state.successMessage = payload;
        },
        updateErrorMessage(state, payload) {
            state.errorMessage = payload;
        },
        sidebarShowToggle(state) {
            state.sidebarShow = !state.sidebarShow;
        },
        updateAllContentModels(state, payload) {
            state.allContentModels = payload;
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getAllContentModels(context) {
            axios.get('/api/meta-content/all')
                .then((response) => {
                    context.commit('updateAllContentModels', response.data);
                }).catch(() => {
                    context.commit('updateAllContentModels', []);
            });
        }
    }
};
