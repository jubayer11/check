<template>

        <v-dialog  v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn depressed rounded v-on="on"style="background-color: #3b5998;color: white">Create Class</v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span style="color:#3b5998;" class="headline">Create Class</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-form @submit.prevent="CreateClassHead">
                        <v-row>
                            <v-col cols="12" sm="12" md="6">
                                <v-text-field rounded outlined label="Class Name*" v-model="form.name" required></v-text-field>
                                <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
                            </v-col>
                            <v-col cols="12" sm="12" md="6">
                                <v-select
                                    :items="item"
                                    label="Select Status*"
                                    item-text="name"
                                    item-value="id"
                                    outlined
                                    rounded
                                    v-model="form.status"
                                >

                                </v-select>
                                <span class="red--text" v-if="errors.status">{{errors.status[0]}}</span>
                            </v-col>
                        </v-row>
                        </v-form>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                    <v-btn type="submit" style="background-color:#3b5998;color:white;" text @click="CreateClassHead">Create</v-btn>
                </v-card-actions>
            </v-card>
            {{cheeckingX}}
        </v-dialog>

</template>
<script>
    export default {
        data: () => ({
            dialog: false,
            item:[
                {'id':1,'name':'Active'},
                {'id':0,'name':'In-Active'}
            ],
            form:{
                name:null,
                status:null,
            },
            errors:{},
            x:0,
        }),
        methods:{
            CreateClassHead()
            {
                axios.post('/lms/api/class-head',this.form)
                    .then(res =>
                            this.dialog = false,
                            EventBus.$emit('class-head-created', this.form),
                            this.$toasted.show('Class Created', {type: 'success'}),
                            this.errors='',
                            this.x=0,


                    )


                    .catch(error =>this.errors = error.response.data.errors)


            },

        },
        computed:{
            cheeckingX()
            {
                if (this.x==0){
                    this.form={};
                    this.x=1;
                }
            },
        }
    }
</script>
