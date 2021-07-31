export default {
    namespaced: true,
    state: {
    },
    getters: {
        isLoggedIn (state) {
        return state.accessToken !== null && state.accessToken !== ''
        },
        getAccessToken (state) {
        return state.accessToken
        }
    },
    actions: {
        saveApiKey (context, payload) {
            return new Promise((resolve, reject) => {
                axios.post('api_key/store', payload).then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
        getApiKey (context, payload) {
            return new Promise((resolve, reject) => {
                axios.get('api_key').then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
        subscribe (context, payload) {
            return new Promise((resolve, reject) => {
                axios.post('subscribe', payload).then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
    },
    mutations: {
    }
}
