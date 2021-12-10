<template>

    <div>
        <!-- <router-link to="/jogo">jogo</router-link>
        <router-link to="/admin">admin</router-link>
        <router-link to="/">login</router-link> -->
        <!-- <top-bar></top-bar> -->
       

        <router-view></router-view>
</div>
</template>

<script>
export default {
    watch: {
        $route(to, from) {
            document.title = to.meta.title || 'Totoloto';
        },
    }
    
}
</script>

<style lang="css">

      *{
            font-family:sans-serif;
            box-sizing:border-box;
            margin:0;
            padding:0;
            
        }
 
</style>