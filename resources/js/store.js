import { getLocalUser } from "./helpers/auth";

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
        contentModels: [],
        sidebarShow: false,
        isFieldFormDisplayed: false,
        contentModelsFields: [],
        currentContentField: {},
        currentValidationsRules: {}
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
        contentModels(state) {
            return state.contentModels;
        },
        sidebarShow(state) {
            return state.sidebarShow;
        },
        isFieldFormDisplayed(state) {
            return state.isFieldFormDisplayed;
        },
        contentModelsFields(state) {
            return state.contentModelsFields;
        },
        currentContentField(state) {
            return state.currentContentField;
        },
        currentValidationsRules(state) {
            return state.currentValidationsRules;
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
        updateContentModels(state, payload) {
            state.contentModels = payload;
        },
        sidebarShowToggle(state) {
            state.sidebarShow = !state.sidebarShow;
        },
        updateFieldFormDisplay(state, payload) {
            state.isFieldFormDisplayed = payload;
        },
        addContentField(state, payload) {
            state.contentModelsFields.push(payload);
        },
        updateContentField(state, payload) {

            state.contentModelsFields = state.contentModelsFields.map((value) => {

                if(payload._id == value._id) {
                    return payload;
                }

                return value;
            });


        },
        removeContentField(state, api_id) {
            state.contentModelsFields = state.contentModelsFields.filter(function(field) {
                return field.api_id != api_id;
            });
        },
        resetContentFields(state) {
            state.contentModelsFields = [];
        },
        setCurrentContentField(state, payload) {
            state.currentContentField = payload;
        },
        resetCurrentContentField(state) {
            state.currentContentField = {};
        },
        setCurrentValidationsRules(state, payload) {
            state.currentValidationsRules = payload;
        },
        resetCurrentValidationsRules(state) {
            state.currentValidationsRules = {};
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getContentModels(context, params) {
            let queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');
            let url = '/api/content-model?' + queryString;

            axios.get(url)
                .then((response) => {
                    context.commit('updateContentModels', response.data);
                }).catch(() => {
                    context.commit('updateContentModels', {});
                });
        }
    }
};