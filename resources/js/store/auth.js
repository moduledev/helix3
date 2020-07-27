import axios from "axios";

export default ({
    namespaced: true,
    state: {
        token: null,
        user: null
    },
    getters: {
        getAuthenteticated(state) {
            return state.token && state.user
        },
        getUser(state) {
            return state.user
        },
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, data) {
            state.user = data;
        }
    },
    actions: {
        async signIn({dispatch}, credentials) {
            let res = await axios.post('auth/signin', credentials);
            //send promice to invoke method (in Signin.vue)
            return dispatch('attempt', res.data.token)
        },
        async attempt({commit,state}, token) {
            if(token){
                commit('SET_TOKEN', token)
            }
            if(!state.token){
                return
            }
            try {
                // Get auth/me doesn't work without headers, so we create subscriber in store/subscriber and set Bearer + token
                let res = await axios.get('auth/me')
                commit('SET_USER', res.data)
            } catch (e) {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)

            }
        },
        async signOut({commit}) {
            return await axios.post('auth/signout').then(()=>{
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            })
        }
    },
})
