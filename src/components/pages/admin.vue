<template>

<div>

     <div class="main">
        <div class="menu">
            <div style="background: gray; padding:24.5px 10px; background: rgb(21, 23, 36);" >
                <label style="font-weight: 700; color: white; padding-left: 10px; font-size: 18px;">Admin Area</label>
            </div>

            <div style="padding-left: 20px; padding-top: 30px;">
                <label style="color: rgb(143, 143, 143); ">Geral</label>
            </div>
            
            <div class="menus">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-desktop"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-laptop"></i> Apostas</a>
                    </li>
                </ul>
            </div>
        </div >

        <div class="dash">
            <nav>
                <div class="welcome">
                    <label>Welcome <strong>{{user}}</strong></label>
                </div>

                <div class="admin">

                    <div class="user">
                        <!-- <a><img src="../../img/pessoa.jpg" style="width: 40px; height:40px;" alt=""></a> -->
                        <a style="padding-right:10px; color:#232833;"><i class="fa fa-user"></i></a>
                        <label id="nome"><a>{{user}} </a></label>
                        <label style="margin-left:10px;"><a><i @click="dropDown()" class="fa fa-angle-down"></i></a></label>
                        <div id="drop" class="user-drop-down">
                            <!-- <a href="">
                                <span class="fa fa-user"></span>
                                <span class="">Perfil</span>
                            </a>
                            <a href="">
                                <span class="fa fa-inbox"></span>
                                <span class="">Notificações</span>
                            </a> -->
                            <a>
                                <span @click="signOut()" class="fa fa-sign-out"></span>
                                <span @click="signOut()">Sign Out</span>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </nav>

            <div style="padding: 30px 40px; border-top: 1px solid rgb(231, 231, 231); border-bottom: 1px solid rgb(231, 231, 231); background: #fff;" >
                <label style="font-size: 26px; font-weight: 600;">Dashboard</label>
            </div>

            <div class="infos">
                <div class="info"><label>Totoloto <p>{{totolotoVal}}$00 ESC</p></label></div>
                <div class="info"><label>Joker <p>{{jokerVal}}$00 ESC</p></label></div>
                <div class="info"><label><strong>Totoloto:</strong> {{totoloto}} <br><strong> Joker:</strong> {{joker}}</label></div>
                
            </div>

            <div class="btns">
               <button v-if="!game.active" @click="createGame()">Criar Jogo</button>
                <!-- <button  @click="closeGame()" >Fechar Jogo</button> -->
                <button v-if="game.active" @click="extractNums()">Extrair Números</button>

            </div>
        </div>
    </div>
    
</div>

</template>

<script>
import helpers from "../helpers/helpers";
export default {
    created(){
        if(this.$store.state.role.name != "Admin"){
            this.$router.push('/');
        }

        
    },

    mounted(){
        setTimeout(() => {
            this.lastGame();
        }, 1000);

    },
    data(){
        return{
            totolotoVal:0,
            jokerVal:0,
            totalVal:0,
            game:null,
            totoloto: "?",
            joker:"?"
        }
    },
    computed:{
        user(){
            return this.$store.state.user.name;
        }
    },

    methods:{
        signOut(){
            localStorage.clear();
            alert(this.user +' vai ser desconectado');

            this.$store.state.user = {};
            this.$store.state.role = null;

            this.$router.push({name:'login'})


        },
        dropDown(){
            document.getElementById('drop').classList.toggle("show")
        },

        extractNums(){
            this.axios.post("/jogo/sortear",helpers.formDataCreate(
                {
                    token:this.$store.state.user.remember_token
                    }
                )
            ).then(res=>{
                this.lastGame();
            })


        },

        lastGame(){
           
            
                this.axios.post("/jogo/ultimojogo",helpers.formDataCreate({token:this.$store.state.user.remember_token}))
                    .then(res=>{
                        if(res.data.data.active == 1){
                            this.game = res.data.data;
        
                            this.totolotoVal = this.game.premio_totoloto;
                            this.jokerVal = this.game.premio_joker;
                        }else{
                            this.game = res.data.data;
        
                            this.totolotoVal = this.game.premio_totoloto;
                            this.jokerVal = this.game.premio_joker;
                            this.totoloto = this.game.totoloto;
                            this.joker = this.game.joker;
                        }

                        
                    })
        }
    }
}
</script>

<style scoped>

body{
    background: rgb(248, 248, 248);

}
.main{
    width: 100%;
    display: flex;
}


.menu{
    background: #232833;
    min-width: 16%;
    min-height: 1000px;
    display: flex;
    flex-direction: column;
    /* justify-content: space-around; */
    /* align-items: center; */
}

.menu div{
    padding: 10px 0 10px 0;
    /* background: gray; */
    /* border: 1px solid yellow; */
    width: 100%;
}
.menus ul{
    list-style: none;
}

.menus a{
    text-decoration: none;
    color: white;
    padding: 15px 0px 15px 0px;
}

.menus ul{
    width: 100%;
}
.menus ul li{
    width: 100%;
    padding: 15px 15px 15px 20px;
    transition: .2s;
}
.menus ul li:hover{
    background:rgb(21, 23, 36)
}

.menus ul li i{
    padding-right: 15px;
}

.dash{
    background: rgb(248, 248, 248);
    width: 84%;
    height: 1000px;
}

nav{
    /* position: fixed; */
    width: 100%;
    height: 55px;
    background: #f5f5f5;
    display: flex;
    justify-content: space-between;
    padding: 10px 30px;
    align-items: center;
    color: rgb(41, 41, 41);
}
.admin{
    display: flex;
    justify-content: center;
    align-items: center;


}
.admin div{
    /* padding:6px 14px; */
    

}
.user{
    /* width: 100%; */
    /*  */
    /* border-left:1px solid #dadada; */
    /* border-right:1px solid #dadada; */
    display: flex;
    align-items: center;
    transition: .2s;
    cursor: pointer;
    justify-content: center;
}
.user label{
    cursor: pointer;
}
.user-drop-down{
    position: relative;
    display: flex;
    /* justify-content: space-between; */
    /* top:20.3%; */
    top: 57px;
    right:49.8%;
    flex-direction: column;
    padding:11px 0px !important;
    background: #fff;
    border-bottom: 2px solid rgb(231, 231, 231);
    border-top: 1px solid rgb(231, 231, 231);
    visibility: hidden;
    opacity: 0;
    transition: .2s;
}

.show{

    visibility: visible;
    opacity: 1;
}

.user-drop-down a {
    text-decoration: none;
    color: rgb(31, 31, 31);
}



.user-drop-down a{
    text-align: left;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 8px 32px !important;
    gap: 28px;
    transition: .2s;
    
}

.user a{
   text-decoration: none;
   color: #000;
}

.user-drop-down a:hover{
    background: #232833;
    color: #fff !important;
    
}
.user:hover .user-drop-down a{
    color: black;
}



.user img{
    border-radius:50%;
    margin-right: 10px;
}
.welcome{
    padding: 10px;
}

.welcome label{
    font-size: 18px;
}
.infos{
    display: flex;
    width:100%;
    padding: 20px;
    /* height: 100px; */
    /* background: green; */
    justify-content: space-around;
}

.info{
    width: 30%;
    height: 120px;
    background:rgb(255, 255, 255);
    display: flex;
    justify-content: flex-start;
    align-items: center;
    font-size: 18px;
    text-align: left;
    padding: 25px;
    border-radius: 5px;
    border: 1px solid rgb(231, 231, 231);
    transition: .2s;
}

.info:hover{
    background: #3b455a;
    
}
.info:hover label {
    color:#fff;
}

.info:hover p{
    color: #fff;
}
.info label{
    font-weight: 500;
    color: rgb(65, 65, 65);

}

.info p{
    font-weight: 700;
    color: rgb(26, 24, 24);
    
}

.btns{
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    background: rgb(255, 255, 255);
    padding: 50px 250px;
}

.btns button{
    padding: 20px;
    border-radius: 2px;
    border: 1px solid rgb(231, 231, 231);
    cursor: pointer;
    margin-bottom: 10px;
    font-size: 16px;
    transition: .2s;
    border-radius: 6px;
}

.btns button:hover{
    background: rgb(47, 60, 85);
    color: #fff;
}


</style>