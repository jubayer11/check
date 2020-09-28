<template>

    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
            <v-btn v-on="on" depressed rounded style="background-color: #3b5998;color: white">Create Subject</v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span style="color: #3b5998" class="headline">Create Student</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-form @submit.prevent="signup">
                    <v-row>
                        <v-col cols="12" sm="12" md="6">

                            <v-text-field outlined rounded label="Subject Name*" v-model="classes.name" required></v-text-field>
                            <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
                        </v-col>
                            <v-col cols="12" sm="12" md="6">
                            <v-text-field  label="Section*" outlined rounded  required v-model="classes.section" ></v-text-field>
                                <span class="red--text" v-if="errors.section">{{errors.section[0]}}</span>
                            </v-col>

                        <v-col cols="12" sm="12" md="6">
                            <v-select
                                outlined
                                rounded
                                :items="item"
                                label="Select Status*"
                                item-text="name"
                                item-value="id"
                                v-model="classes.status"
                            >


                            </v-select>
                            <span class="red--text" v-if="errors.status">{{errors.status[0]}}</span>
                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                            <v-select
                                outlined
                                rounded
                                :items="datah"
                                label="Select Class*"
                                item-text="name"
                                item-value="id"
                                return-object
                                v-model="classes.class_head"
                            >

                            </v-select>
                            <span class="red--text" v-if="errors.class_head">you have to select a class</span>
                        </v-col>
                                <v-col cols="12" sm="12" md="12">
                            <v-textarea
                                outlined
                                rounded
                                label="Description"
                                v-model="classes.description"
                            ></v-textarea>
                                </v-col>
                    </v-row>
                    </v-form>
                </v-container>

            </v-card-text>
            <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                <v-btn style="background-color:#3b5998;color:white"  text @click="created">Save</v-btn>
            </v-card-actions>
        </v-card>
        {{userId}}
        {{cheeckingX}}
        {{checking}}
        {{againChecking}}
    </v-dialog>


</template>

<script>
    export default {
        props:['datah'],
        data: () => ({
            dialog: false,
            modal: false,
            menu2: false,
            classes:{
                name:null,
                section:null,
                description:null,
                user_id:null,
                class_head:{
                    id:null,
                },
                class_name:null,
            },
            check:null,
            y:0,

            x:0,
            item:[
                {'id':1,'name':'Active'},
                {'id':0,'name':'In-Active'}
            ],
            errors:'',
        }),

        computed:{
            checking()
            {
                this.check=this.classes.class_head;
                if (this.check !=null){
                    this.y=1;
                }
            },
            againChecking(){
                if (this.y == 1){
                    this.classes.class_name=this.check.name;
                    this.y=2;
                }
            },
            userId(){
                this.classes.user_id=User.id();
            },
            cheeckingX()
            {
                if (this.x==0){
                    this.classes={};
                    this.x=1;
                }
            },



        },
        methods:{
          created(){
              axios.post(`/lms/api/class`,this.classes)
                  .then(res =>this.dialog=false,
                      EventBus.$emit('newSubject',this.classes),
                      this.$toasted.show('Subject Created',{type:'success'}),
                      this.x=0,
                  )
                  .catch(error =>this.errors = error.response.data.errors)


          },
        },
    }
</script>
