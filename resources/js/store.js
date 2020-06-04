import Vue from 'vue';
import Vuex from 'vuex';
import router from './router'
import axios from 'axios'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        activeUser: {}, _token: ""
    }, getters: {
        activeUser: state => {
            return state.activeUser;
        }, _token: state => {
            return state._token;
        }, isAuthenticated (state)
        {
            return state._token !== ""
        }
    }, mutations: {
        activeUser: (state, n) => {
            state.activeUser = n;
        }, _token: (state, n) => {
            state._token = n;
        }
    }, actions: {
        logout ({commit, dispatch})
        {
            commit("_token", "");
            localStorage.removeItem("token");
            commit('activeUser', {});
            router.push("/");
        }, login: ({commit, dispatch, state}, n) => {
            commit("_token", n);
            localStorage.setItem("token", n);
        },

        initAuth ({commit, dispatch})
        {
            let token = localStorage.getItem("token");
            console.log("init auth");
            if (token)
            {
                commit("_token", token);
                var data = {
                    token : token
                };
                axios.post('/user/init',data).then((res) => {
                    commit("activeUser", res.data.user);
                });
            }
            else
            {
                dispatch("router/push", {path: "/login"});
                return false;
            }

        }, activeUser: ({commit, dispatch, state}, n) => {

            commit('activeUser', n);
            commit("_token", 2312131);
            localStorage.setItem("token", 2312131);

        }, _token: (context, n) => {
            context.commit('_token', n);
        }
    }
});
