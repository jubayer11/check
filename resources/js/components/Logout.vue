<template>


</template>
<script>

    export default {
        created(){
            EventBus.$emit('logout');
            window.location = '/';
        }


    }
</script>
<style>

</style>
