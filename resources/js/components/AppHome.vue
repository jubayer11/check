<template>
    <div>
        <v-app >
            <Navbar class="grey lighten-2" />
            <v-content class="grey lighten-4 mx-1 mb-1">
                <router-view/>
                <vue-progress-bar> </vue-progress-bar>
            </v-content>
          <f/>

        </v-app>

    </div>

</template>
<script>
    import f from './Footer.vue';
    import Navbar from './Navbar.vue';

    export default
    {

        components: { Navbar,f},
        data(){
            return {
               UserId:null,
               allclasses:null,
            }
        },
        created() {
            this.UserId=User.id();
            axios.get(`/lms/api/class/all/all`)
                .then(res => this.allclasses = res.data);
        },

        beforeRouteEnter(to, from, next) {
            if (User.loggedIn()) {
                next();
            } else {
                next('/')
            }
        },

    }

</script>
