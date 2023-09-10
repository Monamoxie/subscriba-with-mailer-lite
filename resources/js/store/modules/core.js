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
                axios.post('api_keys', payload).then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
        getApiKey (context, payload) {
            return new Promise((resolve, reject) => {
                axios.get('api_keys').then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
        hasApiKey (context, payload) {
            return new Promise((resolve, reject) => {
                axios.get('has_api_keys').then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
        subscribe (context, payload) {
            return new Promise((resolve, reject) => {
                axios.post('subscribers', payload).then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
        subscribers (context, payload) {
            return new Promise((resolve, reject) => {
                axios.get('subscribers').then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
        editSubscriber (context, payload) {
            return new Promise((resolve, reject) => {
                axios.put('subscribers', payload).then(response => {
                    resolve(response)
                }).catch(errors => {
                    reject(errors)
                })
            })
        },
        deleteSubscriber (context, payload) {
            return new Promise((resolve, reject) => {
                axios.delete('subscribers', {
                    data: {
                        email: payload.email
                    }
                }).then(response => {
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
