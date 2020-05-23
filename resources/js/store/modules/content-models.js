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

                if(payload.id == value.id) {
                    return payload;
                }

                return value;
            });

        },
        removeContentField(state, slug) {
            state.contentModelsFields = state.contentModelsFields.filter(function(field) {
                return field.slug != slug;
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
        setContentFields(state, payload) {
            state.contentModelsFields = payload;
        }
    },
    actions: {
        getContentModels(context, params) {
            return new Promise((resolve, reject) => {
                axios.get("/api/meta-content", {
                    params: params
                })
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
