export default {
    state: {
        contentModels: [],
        isFieldFormDisplayed: false,
        contentModelsFields: [],
        currentContentField: {},
        currentValidationsRules: {}
    },
    getters: {
        contentModels(state) {
            return state.contentModels;
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
        updateContentModels(state, payload) {
            state.contentModels = payload;
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
        },
        updateOrderOfField(state, payload) {
            state.contentModelsFields = state.contentModelsFields.map((field) => {

                if(payload.api_id == field.api_id) {
                    field.order = payload.order;
                }

                return field;

            });
        }
    },
    actions: {
        getContentModels(context, params) {
            return new Promise((resolve, reject) => {
                let queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');
                let url = '/api/content-model?' + queryString;

                axios.get(url)
                    .then((response) => {
                        context.commit('updateContentModels', response.data);
                        resolve();
                    }).catch(() => {
                    context.commit('updateContentModels', {});
                    reject();
                });
            });
        }
    }
};