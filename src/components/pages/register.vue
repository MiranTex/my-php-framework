<template>
   <div class="all a2">
    <div class="allzinho">

        <div class="back">

            <div class="login">
                <div class="title">
                    <h1> LuckLottery</h1>
                    <h3 style="padding-top:20px">Cadastrar</h3>
                </div>

                <div id="campos">
                    <label>Nome</label>
                    <input v-model="user.name" type="text" id="nomeText">

                    <label>NIF</label>
                    <input v-model="user.nif" type="text" id="nif">

                    <label>Telefone</label>
                    <input v-model="user.tel" type="tel" placeholder="+(1) 000 000">

                    <label>Email</label>
                    <input v-model="user.email" type="Email" placeholder="artur.teixeira@ideiacv.com">

                    <label>Password</label>
                    <input v-model="user.pw" type="password" id="pwtext">

                    <label>Confirm Password</label>
                    <input v-model="user.pwconf" type="password" id="confpwtext">

                    <div class="buttons">
                        <button type="button" @click="validate()">Cadastrar</button>
                    </div>

                    <div class="cadastrar">
                         <router-link to="/">Voltar</router-link>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
</template>

<script>
import helpers from '../helpers/helpers';
export default {

    data(){
        return{
            user:{
                name:"",
                nif:"",
                tel:"" ,
                email:"" ,
                pw:"" ,
                pwconf:"" 

            }
        }
    },

    methods:{
        validate(){
            let valido = true;
            Object.entries(this.user).forEach(([key, value]) => {
                if(value == "" || !(this.user.pw == this.user.pwconf)){
                   valido = false;
                    
                }

            });
            
            if(!valido){
                this.$swal.fire({
                    title: 'Atenção',
                    text: !(this.user.pw == this.user.pwconf) ? "Os paswords ñ coencidem" : "Preencha todos dos campos",
                    icon: 'warning',
                    confirmButtonText: 'Voltar'
                })

                
            }else{
                if(isNaN(this.user.nif) || (this.user.nif.length) < 9){
                    this.$swal.fire({
                        title: 'Atenção',
                        text: isNaN(this.user.nif) ? "O campo 'NIF' deve ser preenchido com numeros" : "O campo 'NIF' deve conter pelo menos '9' numeros",
                        icon: 'warning',
                        confirmButtonText: 'Voltar'
                    })
                }else{
                    this.cadastrar();
                }
            }

           
        },
        
        cadastrar(){
            this.axios.post('/registar',helpers.formDataCreate({
                name:this.user.name,
                nif:this.user.nif,
                email:this.user.email,
                password:this.user.password
            })).then(res=>{
                if(helpers.getRequestStatus(res)){
                    this.$store.commit('set_user',res.data.data);
                    localStorage.totoloto_user = res.data.data.remember_token;

                }else{
                    console.log(res.data.data);
                }
            })
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