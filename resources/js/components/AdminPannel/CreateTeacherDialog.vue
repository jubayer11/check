<template>

    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
            <v-btn v-on="on" depressed rounded style="background-color: #3b5998;color: white">Create Teacher</v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span style="color: #3b5998" class="headline">Create Teacher</span>
            </v-card-title>
            <v-card-text>
                <v-container>
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
                            :items="items"
                            item-text="status"
                            item-value="id"
                            label="Select Status"
                            prepend-icon="view_array"
                            v-model="form.Status"
                        ></v-select>
                    </v-form>
                    <small>*indicates required field</small>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                <v-btn style="background-color:#3b5998;color:white"  text @click="signup">Save</v-btn>
            </v-card-actions>
        </v-card>
        {{cheeckingX}}
    </v-dialog>


</template>

<script>
    export default {
        data ()  {
            return{
                dialog:false,
                form:{
                    first_name:null,
                    last_name:null,
                    email:null,
                    password:null,
                    password_confirmation: null,
                    phone:null,
                    Status:null,
                    class_head:[],

                },
                x:0,
                items: [
                    { id: 1, status: 'Active' },
                    { id: 2, status: 'In-Active' },

                ],
                errors:{},


            }

        },
        computed:
            {
                cheeckingX()
                {
                    if (this.x==0){
                        this.form={};
                        this.x=1;
                    }
                },
            },

        methods:
            {
                signup() {
                    axios.post('/lms/api/create/teacher', this.form)
                        .then(res => this.dialog = false,
                            EventBus.$emit('newTeacher',this.form),
                            this.$toasted.show('Teacher Created',{type:'success'}),
                            this.x=0,
                        )
                        .catch(error =>this.errors = error.response.data.errors)
                },

            }

    }
</script>
