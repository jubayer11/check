<template>
    <v-container
        fill-height
        flat
        fluid
    >

        <v-layout
            align-center
            justify-center

        >
            <v-flex
                md4
                sm8
                xs12
            >
                <v-card
                    class="elevation-5"
                    flat
                >
                    <v-toolbar
                        color="#3b5998"
                        dark
                        flat
                    >
                        <v-toolbar-title>Reset Password</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        <form>
                            <v-text-field
                                label="E-mail"
                                required
                                v-model="email"
                                outlined
                            ></v-text-field>
                            <v-text-field
                                label="Password"
                                required
                                v-model="password"
                                outlined
                                type="password"
                            ></v-text-field>
                            <v-text-field
                                label="Confirm Password"
                                required
                                v-model="password_confirmation"
                                outlined
                                type="password"
                            ></v-text-field>
                        </form>
                    </v-card-text>

                    <v-card-actions>
                        <a style="text-decoration:none" @click="loginpage">Back to Login</a>
                        <v-spacer></v-spacer>
                        <v-btn style="background-color: #3b5998;color: white"  @click="resetPassword" >submit</v-btn>

                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
    export default {

        data() {
            return {
                token: null,
                email: null,
                password: null,
                password_confirmation: null,
                has_error: false
            }
        },
        methods: {
            loginpage(){
                window.location = '/lms'
            },
            resetPassword() {
                axios.post("/lms/api/reset/password", {
                    token: this.$route.params.token,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then(result => {
                        console.log(result.data);
                        window.location = '/lms'
                    }, error => {
                        console.error(error);
                    });
            }
        }
    }
</script>
