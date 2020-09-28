<template>


    <v-container
        fluid
        fill-height
        flat
        class="grey lighten-2"
    >

        <v-layout
            align-center
            justify-center

        >
            <v-flex
                xs12
                sm8
                md4

            >
                <v-card
                    flat
                    class="mx-auto"
                    max-width="400"
                >
                    <v-card-title class="headline font-weight-bold" style="color:#3b5998">
                        New Account Created.
                    </v-card-title>

                    <v-card-text style="color:black">
                        We will Notify You Through Email If It Is Accepted.
                    </v-card-text>
                    <v-card-actions class="ml-2"><a style="text-decoration:none" @click="loginpage">Back to Login</a></v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>


</template>

<script>
    export default {
        data ()  {
            return{
                form:{
                    email:null,
                    password:null,
                },


            }

        },
        created(){
            if(User.loggedIn()){
                this.$router.push({name:'profile'})
                // window.location = '/'
            }

        },
        methods:{
            loginpage(){
                window.location = '/lms'
            },
            login(){
                User.login(this.form)

            },
            signup(){
                window.location = '/lms/signups'
            }

        },
    }



</script>
