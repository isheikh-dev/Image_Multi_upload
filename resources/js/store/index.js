import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';


export default new Vuex.Store({
    state:{
        posts:[],
    }, 
    
    mutations:{
        setPosts(state, response){
            state.posts = response.data.data;
        },
    },

    actions: {
        async getAllPosts({ commit }){
            return commit('setPosts' , await axios.get('/post/get_all'));
            // let { data } = await Axios.get(‘https://myapiendpoint.com/api/names')

        },
    },

    

    strict: debug
})















// mutations : {
//     SET_NAME : (state,name) => {
//       state.name = name
//     }
//   },
//   actions : {
//     SET_NAME : async (context, name) => {
//       let { data } = await Axios.post('http://myapiendpoint.com/api/name',{name : name})
//       if(data.status == 200){
//         context.dispatch('SET_NAME', name)
//       }
//     }
//   }