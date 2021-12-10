<template>
  <div class="all">
    <div class="allzinho">

        <div class="back">

             <div class="login">
                <div class="title">
                    <h1> LuckLottery</h1>
                </div>

                 <div id="campos">
                    <label>Nome</label>
                    <input v-model="email" type="email" id="" placeholder="artur.teixeira@ideiacv.com">
                    <label>Password</label>
                    <input v-model="password" type="password" id="">

                    <div class="buttons">
                        <button @click="login()">Entrar</button>
                    </div>

                    <div class="cadastrar">
                        <transition name="fade" mode="out-in">
                            <router-link to="register">Cria seu Cadastro</router-link>
                        </transition>
                    </div>
                </div>

            </div>

        </div>

    </div>
    
   

</div>
</template> x

<script>
import helpers from "../helpers/helpers";
export default {
    data(){
        return{
            email:"",
            password:""
        }                                                                                                                                                                                                                                                                                                                                                                                                                                
    },

    created(){
        if(localStorage.totoloto_user){
            this.login(localStorage.totoloto_user)
        }
    },
    mounted(){

    },

    methods:{
        login(token = null){
            if(token || (this.email != "" && this.password != "")){

                let route = token ? "/tokenlogin" : "/login";
                let form =  helpers.formDataCreate(token ? {token:token} : {email:this.email,password:this.password});


                this.axios.post(route,form)
                    .then(res => {
                        if(helpers.getRequestStatus(res)){
                            this.$store.commit("set_user",res.data.data);
                            localStorage.totoloto_user = res.data.data.remember_token;

                            this.axios.post('user/role',helpers.formDataCreate({token:this.$store.state.user.remember_token}))
                                .then(res=>{
                                    this.$store.commit('set_role',res.data.data);
                                    this.redirectTo();
                                })
                        }
                    })
            }else{
                this.$swal.fire({
                    html:"tem de preencher todos os campos",
                    icon:"warning"
                })
            }
        },

        redirectTo(){
            switch(this.$store.state.role.name){
                case "Admin":
                    this.$router.push('/admin');
                    break;

                case "player":
                    this.$router.push("/jogo");
                    break;
            }
        }
    }
}
</script>

<style scoped>

.all{
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 900px;
    /* background: rgb(204, 204, 204) !important; */
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url("../../img/moeda5.jpg");
    background-size: cover;
}
.a2{

}

.allzinho{
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgb(0, 0, 0, 0.6);
}

.back{
    width: 800px;
    min-width:50%;
    /* height: 600px; */
    /* background: blue; */
    display: flex;
    justify-content: space-around;
    align-items:center;
    padding: 20px;
    
}

.login{
    width: 500px;
    /* max-width:px; */
    min-width:320px;
    position: relative;
    /* background: red; */
    padding: 30px 15px 30px 15px;
    /* From https://css.glass */
    /* background: rgba(255, 255, 255, 0.03); */
    border-radius: 6px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(9px);
    /* border: 4px solid; */
    /* border: 1px solid rgba(255, 255, 255, 0.22); */
    border-image-slice: 1;
    /* border-width: 2px; */
    /* border-image-source: linear-gradient(to left, #743ad5, #d53a9d); */
    --angle: 0deg;
    /* … */
    border-image: linear-gradient(var(--angle), #741ed6, #1839ca , rgb(204, 20, 20) ,rgb(212, 11, 185)) 1;
    animation: rotate 2s linear infinite;
    background: rgba(66, 66, 66, 0.24);
}

@property --angle {
  syntax: '<angle>';
  initial-value: 0deg;
  inherits: false;
}



.title{
    /* background: green; */
    width: 100%;
    padding: 20px 0 20px 0;
    text-align: center;  
    color: #fff;
}
h3{
    font-weight: 100;
    font-size: 18px;
}
.title h1{
    font-size: 28px;
}

#campos{
    width: 100%;
    padding: 20px;
    /* background: red; */
    display: flex;
    flex-direction: column;
    align-items: center;
   
    
}

#campos label{
    width: 100%;
    padding: 10px 0 10px 0;
    color: rgb(255, 255, 255);
    font-size: 16px;
}

#campos input {
    width: 100%;
    padding: 4px;
    margin-bottom: 20px;
    background: none;
    border: none;
    border-bottom:solid rgb(255, 255, 255) 1px;
    color: aliceblue;
    font-size: 17px;
    
}

#campos input:focus {
    outline: none;
    border-color: rgb(187, 144, 63);
    
}
#campos input::placeholder{
    color: rgba(165, 161, 154, 0.692);
}

#campos button{
    margin-top: 25px;
    padding: 10px 30px 10px 30px;
    margin-bottom: 20px;
    cursor: pointer;
    font-size: 15px;
    border: none;
    border-radius: 3px;
    transition: .2s;

}

#campos button:hover{
    background: rgb(209, 178, 121);

}

a{
    color: rgb(255, 255, 255);
    font-weight: 500;
    font-size: 14px;
}

#campos a:hover {
    color: wheat;

}
@keyframes rotate {
  to {
    --angle: 360deg;
  }
}

@media  screen and (max-width:420px) {
    .all{
        min-height: 100vh;
        height: 120vh;
        
    }

    .back{
        width: 100%;
    }

    .login{
        border:none;
        width: 100%;
        min-width: 320pxa;
    }
}

@media screen and (max-width:768px) {

    .all{
        min-height: 100vh;
        height: 900px;
        /* background-image: url("../../img/wall.jpg") !important; */
    }
    .back{
        height: 100%;
        padding: 0;
    }
    .login{
        height: auto;
        border:none;
        min-height: 320px;
        padding:0px;
    }
}

@media screen and (max-width:390px) {

    .all{
        
        min-height: 900px;
    }
}

/* @media screen and (max-height:380px) {
    .login{
        height: 100px !important;
        background: red;
    }
    
} */

</style>