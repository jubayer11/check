<template>


            <v-container
                fluid
                fill-height
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
                        <v-card flat class="elevation-5">
                            <v-toolbar
                                color="#3b5998"
                                dark
                                flat
                            >
                                <v-toolbar-title>Sign Up</v-toolbar-title>
                                <v-spacer></v-spacer>

                            </v-toolbar>
                            <v-card-text>
                                <v-form @submit.prevent="signup">
                                    <v-text-field
                                        label="First Name*"
                                        name="first_name"
                                        v-model="form.first_name"
                                        prepend-icon="person"
                                        type="text"
                                    ></v-text-field>
                                    <span class="red--text" v-if="errors.first_name">{{errors.first_name[0]}}</span>

                                    <v-text-field
                                        label="Last Name*"
                                        name="last_name"
                                        v-model="form.last_name"
                                        prepend-icon="person"
                                        type="text"
                                    ></v-text-field>
                                    <span class="red--text" v-if="errors.last_name">{{errors.last_name[0]}}</span>

                                    <v-text-field
                                        label="Email"
                                        name="email"
                                        v-model="form.email"
                                        prepend-icon="email"
                                        type="email"
                                    ></v-text-field>
                                    <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>
                                    <v-text-field
                                        label="Phone No*"
                                        name="phone"
                                        v-model="form.phone"
                                        prepend-icon="phone"
                                        type="text"
                                    ></v-text-field>
                                    <span class="red--text" v-if="errors.phone">{{errors.phone[0]}}</span>

                                    <v-text-field
                                        id="password"
                                        label="Password*"
                                        name="password"
                                        v-model="form.password"
                                        prepend-icon="lock"
                                        type="password"
                                    ></v-text-field>
                                    <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>

                                    <v-text-field
                                        id="Confirm Your password"
                                        label="Confirm  password*"
                                        name="password"
                                        v-model="form.password_confirmation"
                                        prepend-icon="lock"
                                        type="password"
                                    ></v-text-field>
                                    <span class="red--text" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</span>

                                    <v-select
                                        :items="roles"
                                        item-text="name"
                                        item-value="name"
                                        label="Select your Role*"
                                        prepend-icon="supervisor_account"
                                        v-model="form.role"

                                    ></v-select>
                                    <span class="red--text" v-if="errors.role">{{errors.role[0]}}</span>
                                </v-form>
                                <small>*indicates required field</small>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn depressed style="background-color:#3b5998;color: white;text-transform: none !important;margin: 3%"  @click="login">Login</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn
                                    type="submit"
                                    depressed
                                    style="background-color:#3b5998;color: white;text-transform: none !important;margin: 3%"
                                    dark
                                    @click="signup"
                                >
                                    Sign Up</v-btn>

                            </v-card-actions>
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
                    first_name:null,
                    last_name:null,
                    email:null,
                    password:null,
                    role:null,
                    password_confirmation: null,
                    phone:null,

                },
                roles:{},
                errors:{},


            }

            },
        created(){

            if(User.loggedIn()){
                window.location = '/lms/profile'
            }

          axios.get('/lms/api/role')
              .then(res =>this.roles=res.data.data)
              .catch(error =>console.log(error.response.data))
        },

        methods:
            {
                signup() {
                    axios.post('/lms/api/auth/signup', this.form)
                        .then(res => window.location = '/lms/checking_signup')
                        .catch(error =>this.errors = error.response.data.errors)
                },
                login(){
                    window.location = '/lms'
                },

            }

        }




</script>
