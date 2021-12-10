import login from '../pages/login.vue';
import register from '../pages/register.vue';
import jogo from '../pages/jogo.vue';
import admin from '../pages/admin.vue';


export default[
    {path:'/',name:'login', meta:{title:"Login"},component:login},
    {path:'/register', meta:{title:"Register"},component:register},
    {path:'/jogo', name:'jogo', meta:{title:"Jogo"},component:jogo},
    {path:'/admin',name:'admin', meta:{title:"admin"},component:admin}
]