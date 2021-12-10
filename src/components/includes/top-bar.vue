<template>
     <nav style="width:100%; min-height:9vh;">
            <div class="logo">
                <!-- <h1>Luck <br>Lott</h1> -->
            </div>

            <div class="menu">
                <ul class="list">
                    <li> <router-link to="/"><a><font-awesome-icon icon="home" style="width:30px; height:30px"/><label>Home</label></a></router-link></li>
                    <li><router-link to="/jogo"><a><font-awesome-icon icon="dice" style="width:30px; height:30px"/><label>Jogar</label></a></router-link></li>
                    <li><router-link to="/"><a><font-awesome-icon icon="clipboard-list" style="width:30px; height:30px"/><label>Apostas</label></a></router-link></li>
                </ul>
            </div>

            <div>
                <ul class="list">
                    <li><a @click="logout()"><font-awesome-icon icon="sign-out-alt" style="width:25px; height:25px;"/><label>Sair</label></a></li>
                </ul>
                
            </div>

        </nav>
</template>

<script>
export default {
    computed:{
        user(){
            return this.$store.state.user.name;
        }
    },
    methods:{
        logout(){
            localStorage.clear();
            alert(this.user +' vai ser desconectado');
            
            this.$store.state.user = {};
            this.$store.state.role = null;

            this.$router.push({name:'login'})
        }
    }
}
</script>
    
<style scoped>
nav{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    /* position: absolute; */
    /* background:rgb(255, 255, 255) !important; */
    background: linear-gradient(45deg, #1c2555, #255969,#3e2d6d);

    border:1px solid rgb(221, 221, 221);

}

nav .list{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    list-style: none;
    align-items: center;
    
}

nav .list li{
    padding:10px;
    margin-left: 30px;
    /* background: red; */
    font-size: 18px;
    transition: .2s;

}

nav .list li:hover{
    padding:10px;
    /* background: red; */
    transform: scale(1.15);
}

nav .list li a{
    text-decoration: none;
    color: #fff;
}
nav .list li:hover a{
   color: wheat;
   
}

@media screen and (max-width:646px){
    nav{
        position: absolute;
    }

    nav label{
        display: none;
    }

    nav .list ul li{
        margin-left: 40px;
    }
}

@media screen and (max-width:425px) {
    nav{
        position: relative;
    }
}
</style>