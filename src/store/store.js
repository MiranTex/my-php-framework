import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        name:"Artur MiranTex" ,
        user:{},
        role:""
    },

    mutations:{
        set_user(state,user){
            state.user = user;
        },

        set_role(state,role){
            state.role = role;
        }
    },

    actions:{

    }


});

export default store;