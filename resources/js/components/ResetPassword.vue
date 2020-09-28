<template>

        <v-dialog v-model="dialog" persistent max-width="400px">
            <template v-slot:activator="{ on }">
                <h5 v-on="on" style="color:#3b5998">Forgotten account?</h5>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Reset PassWord</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-form @submit.prevent="requestResetPassword">
                                <v-text-field
                                    outlined
                                    rounded
                                    label="Enter Your Email Address*"
                                    required
                                    v-model="email"
                                >
                                </v-text-field>
                                    <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>
                                </v-form>
                            </v-col>
                        </v-row>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn depressed style="background-color:#3b5998;color: white;"  text @click="dialog = false">Close</v-btn>
                    <v-btn type="submit" depressed style="background-color:#3b5998;color: white;" text @click="requestResetPassword">Submit</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
</template>
<script>
    export default {
        data: () => ({
            dialog: false,
            email: null,
            has_error: false,
            errors:{},

        }),
        methods: {
            requestResetPassword() {
                axios.post("/lms/api/reset-password", {email: this.email})
                    .then(res =>(this.dialog=false,this.$toasted.show('mail has been sent to your Account',{type:'success'})))
                    .catch(error =>this.errors = error.response.data.errors);

            }
        }
    }
</script>
