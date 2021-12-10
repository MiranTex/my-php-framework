<template>
    <div class="content">

        <top-bar></top-bar>
        <div class="all-game" v-if="game">

             <div class="container">
            <div class="layer">
                <div class="cab">
                    <div class="nome">
                        <label id="apostador">{{name}}</label>
                    </div>
                    <div class="slectApostas">
                        <select v-model="max" id="seletor" name="">
                            <option value=0>N° de Apostas</option>
                            <option value=6>6</option>
                            <option value=8>8</option>
                            <option value=10>10</option>
                        </select>
                    </div>

                    <div class="date">
                        <p><span id="curent-date">{{date}}</span></p>
                    </div>

                </div>

            </div>

        </div>

        <div  class="container ">
            <div class="layer l2">
                <div class="tabela">
                    <table>
                        <tbody>
                            <div class="joker-buttons" style="padding:40px 7px; display:flex; justify-content:space-between; align-items:center; gap:7px">
                                <div style="display:flex; align-items:center; justify-content:center; gap:7px">
                                    <input v-model="joker" type="checkbox"  style="width:19px; height:19px; cursor:pointer;">
                                    <label :class="{'joker':joker}" style="color:rgb(200,200,200);">JOKER: {{joker_num}}</label>
                                </div>
                                <div>
                                    <button type="button" @click="validate()" class="b1">Apostar</button>
                                    <button type="button" @click="nums = fillNums()" class="b1">Limpar</button>
                                </div>  
                            </div>
                            
                            <tr id="tabela">
                                <td v-for="(num, index) in nums" :key="index+'_game'"  class='box'>
                                    <button type= "button" @click="selectNum(index)" :class="{'active':num}" class="btn"> {{index < 9 ? "0"+(index+1) : index+1}}</button>    
                                </td>
                            </tr>

                        </tbody>

                        

                    </table>
                </div>

                <div class="showNum">
                    
                </div>
            </div>
        </div>
        </div>
       
        <div v-else class="no-game"><p>Nenhum Jogo activo</p></div>


    </div>
</template>

<script>
import helpers from '../helpers/helpers';

import topBar from '../includes/top-bar.vue';
export default {
  components: { topBar },

    watch:{
        max(currentVal, previousVal){
            if(currentVal<this.countSelected()){
                this.nums = this.fillNums();
            }
        }
    },


    computed:{
        name(){
            return this.$store.state.user.name;
        },

        date(){
            let today="";
            let date="";

            today = new Date();
            date = today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear();

           return date;
        },

        apostarEnable(){
            return this.max == this.countSelected() && this.max>0;
        }


    },

    data(){
        return {
            nums:[],
            max:0,
            currentDate:"",
            joker:false,
            game:null,
            joker_num:""

        }
    },

    created(){
        if(this.$store.state.role.name != "Admin" && this.$store.state.role.name != "player"){
            this.$router.push('/');
        }

        this.axios.post("/jogo/jogoativo",helpers.formDataCreate({token:this.$store.state.user.remember_token}))
            .then(res=>{
                if(res.data.data.active == 1){
                    this.game = res.data.data;
                }
            })

        this.nums = this.fillNums();

        this.joker_num = this.getRandomIntInclusive(0,99999999);
    },


    methods:{
        getRandomIntInclusive(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
            },
        fillNums(){

            let nums=[];
            for (let i = 0; i < 49; i++) {
                nums[i] = false;
            }
            return nums;
        },

        selectNum(index){
            if((this.max > 0 && this.countSelected() < this.max) || this.nums[index]){
                this.$set(this.nums,index,!this.nums[index]);
            }
            else{
                this.$swal.fire({
                    title: 'Atenção',
                    text: this.max == 0 ? "Selecione o numero de Apostas" : "Excedeu o numero de apostas",
                    icon: 'warning',
                    confirmButtonText: 'Voltar'
                })
            }
        },

        countSelected(){

            let count = 0;

            for (let i = 0; i < this.nums.length; i++) {

                if(this.nums[i])
                    count++;
            
            }

            return count;
        },

        validate(){
            let num_selected = Array();
            this.nums.forEach((el,key)=>{
                if(el) num_selected.push(key+1);
            })

            num_selected = num_selected.join("-");

            this.axios.post("/aposta/create",helpers.formDataCreate({
                totoloto: num_selected,
                joker: this.joker ? this.joker_num : "",
                id_jogo: this.game.id,
                token: this.$store.state.user.remember_token
            })).then(res=>{
                if(helpers.getRequestStatus(res)){
                    this.$swal.fire({
                        icon: "success",
                        html: "Aposta com sucesso"
                    })

                this.joker_num = this.getRandomIntInclusive(0,99999999);
                this.nums = this.fillNums();
                this.joker = false;
                    
                }
            })
        }

    }

    


}
</script>

<style scoped>
.no-game{
    color: #fff;
    font-size: 2em;
    text-align: center;
}
.content{
    background: linear-gradient(45deg, #1c2555, #255969,#3e2d6d);
    /* background: gray; */
    width: 100%;
    min-height: 100vh;
    height: auto;
    
    background-size: 600%;
    animation: rotate 20s;
}

label{
    cursor: pointer;
}

.joker{
    color:rgb(15, 173, 28) !important;;
}

.all-game{
    width: 100%;
    height: 900px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.container{
    /* margin-top: 70px; */
    position: relative;
    width: 100%;
    height: auto;
    /* background: red; */
    display: flex;
    justify-content: center;
    
}
.active{
    background-color: rgb(33, 109, 180) !important;
    /* border-color: rgb(37, 69, 117) !important; */
    color: #fff !important;

}
.active a{
    color:#fff;
}

.layer{
    position: relative;
    width: 80%;
    /* background: blue; */
    padding: 20px;
    display: flex;
    justify-content: center;
}

.l2{
    flex-direction: column;
    align-items: center;
}



.cab{
    background: rgb(247, 247, 247);
    min-width: 715px;
    width: 715px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px 20px;
    font-size: 18px;
    backdrop-filter: blur(3px);
    color: rgb(32, 32, 32);
    border-radius: 5px;
}


.slectApostas{
    display: flex;
    justify-content: center;
    min-width: 50%;
}
.slectApostas select{

    width: 60%;
    padding: 6px 10px;
    background: none;
    color: rgb(34, 34, 34);
    border: 1px solid rgb(199, 199, 199); 
    text-align: center;

}
.slectApostas select:focus{
    outline: none;
}

.slectApostas select option{
    background: rgb(247, 247, 247);
}
.tabela{
    background: rgb(247, 247, 247);
    padding: 0px 35px 35px 35px;
    border-radius: 7px;
    backdrop-filter: blur(7px);
}


.btn{
    padding:16px;
    border-radius: 50%;
    border: none;
    background:rgba(247, 247, 247, 1);
    cursor: pointer;
    border: 1px solid rgb(223, 223, 223);
    color: rgb(26, 26, 26);
    font-size: 16px;

}



.btn:hover{
    border-color: rgb(202, 169, 96);
}

/* .btn:focus{
    outline: none;
    background-color: rgb(37, 69, 117);
    border-color: rgb(37, 69, 117);
} */

tr{ 
    display: grid;
    grid-template-rows: 55px 55px 55px 55px 55px;
    grid-template-columns: 55px 55px 55px 55px 55px 55px 55px 55px 55px 55px;
    gap: 10px;
}
.showNum{
    position: relative;
    width: 100%;
    height: auto;
    display: flex;
    padding: 10px;
    justify-content: center;
    /* background: green; */
    
}
#selNum{
    /* margin-top:20px ;
    width: 100%;
    border-radius: 2px;
    border: 2px solid rgb(207, 207, 207);
    padding: 10px;
    cursor: pointer !important; */
    
}

#selNum:focus{
    /* outline: none;
    border: 2px solid rgb(17, 103, 129); */
    

}
form{
    width: 100%;
    /* background: pink; */
    display: flex;
    justify-content: center;
    align-items: center;
}

.bt{
    width: 100%;
    display: flex;
    justify-content:center;
    gap:10px;
    /* background:rgb(187, 0, 0); */
    align-items: center;
}
.b1{

    padding:10px 30px;
    border: 1px solid rgb(201, 201, 201);
    border-radius: 2px;
    transition: .2s;
    cursor: pointer;
    background: rgba(221, 221, 221, 0);  
    color:rgb(51, 51, 51);
    font-size:16px
}

.b1:hover{
    background: rgb(212, 212, 212);
    color:black
}

@keyframes rotate {
  0% {
      background-position: 0 50% ;
  }
  50% {
      background-position: 100% 50% ;
  }
  100% {
      background-position: 0 50% ;
  }
}


@media screen and (max-width:720px){

    
    .cab{

        min-width: 640px;
        width: 640px;
    }

    .slectApostas{
        width: 40%;
    }

    .slectApostas select{
        width:70%;
        font-size: 16px;
    }

    tr{ 
        display: grid;
        grid-template-rows: 50px 50px 50px 50px 50px;
        grid-template-columns: 50px 50px 50px 50px 50px 50px 50px 50px 50px 50px;
        gap: 8px;
    }

    .btn{
        font-size: 12px;
        padding: 16px;
    }

    
}
@media screen and (max-width:646px){
    .cab{
        min-width: 455px;
        width: 455px;
        
    }
    .slectApostas select{
        font-size: 15px;

    }

    .tabela{
        padding: 0 20px 30px 20px;
    }    

    .b1{
        padding: 10px 18px;
    }

    
    tr{ 
        display: grid;
        grid-template-rows: 50px 50px 50px 50px 50px;
        grid-template-columns: 50px 50px 50px 50px 50px 50px 50px;
        gap: 10px;
    }
}

@media screen and (max-width:455px) {

    .layer{
        padding: 0 !important;

    }
    .cab{
        min-width: 420px;
        width:420px;
    }
    .slectApostas{
        width: 30%;
    }

    .slectApostas select{
        width:80%;
        font-size: 18px;
      
    }
    .tabela{
        padding: 0 20px 30px 20px;
    }
    .b1{
        padding: 8px 13px;
    }
    .btn{
        padding: 16px;
    }
    tr{ 
        display: grid;
        grid-template-rows: 40px 40px 40px 40px 40px 40px 40px;
        grid-template-columns: 40px 40px 40px 40px 40px 40px 40px;
        gap:15px;
    }
    
}

@media screen and (max-width:425px) {


    .content{
        background:linear-gradient(rgb(51, 129, 143),rgb(42, 85, 124));
        background:rgb(83, 125, 145);
        animation: none;
    }


    .container{
        width: 100%;

    }
    .layer{
        width: 100%;
    }
    .cab{
        flex-direction: column;
        height:auto;
        padding: 0;
        justify-content: center;
        width: 300px;
        min-width: 300px;
        background: none;
        padding-top: 40px ;
        backdrop-filter: blur(0);
        color: #fff;
    }

    .slectApostas{
        width:60%;
        min-width: 0;

    }

    .slectApostas select{
        font-size: 16px;
        width: 100%;
        color: #fff;
        backdrop-filter: blur(0);
    }
    .cab div{
        margin-bottom: 10px;
    }
    .joker-buttons{
        flex-direction: column;

    }

    .joker-buttons div{
        padding-bottom: 10px ;
    }
    .b1{
        padding: 10px 45px;
        color: #fff;
    }

    .tabela{
        padding:0;
        background: none;
        margin: 0;
    }
    tr{ 
        display: grid;
        grid-template-rows: 40px 40px 40px 40px 40px 40px 40px 40px;
        grid-template-columns: 40px 40px 40px 40px 40px 40px;
        gap:4.8vw;
    }
    .btn{
        padding: 15px;
        font-size: 14px;
        background: transparent;
        color: #fff;
    }


}
</style>
