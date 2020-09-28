<template>
    <v-row style="margin-left:.25%">
        <v-dialog max-width="600px" persistent v-model="dialog">
            <template v-slot:activator="{ on }">
                <v-btn
                    depressed
                    style="color: white;background-color: #3b5998;"
                    v-on="on"
                    rounded


                >
                    Edit


                </v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Edit Class Routine</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-form @submit.prevent="send">
                            <v-row>
                                <v-col cols="12" sm="6">
                                    <v-combobox
                                        @change="ChangingColorAll"
                                        outlined
                                        :items="items"
                                        :item-text="item"
                                        :item-value="item"
                                        label="Select a type or create a new one"
                                        v-model="data.type"
                                    ></v-combobox>
                                    <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-select
                                        :disabled="checkingDisabled"
                                        :items="data"
                                        label="Select Subject*"
                                        item-text="name"
                                        item-value="name"
                                        outlined
                                        v-model="data.name"
                                    ></v-select>
                                </v-col>

                                <v-col cols="12" sm="6">
                                    <v-select
                                        @change="changingToDate"
                                        :items="checkDays"
                                        label="Select Start Day*"
                                        outlined
                                        v-model="data.start_date"
                                    ></v-select>
                                    <span class="red--text" v-if="errors.start">This field is required</span>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-menu
                                        ref="menus"
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="data.start_time"
                                        transition="scale-transition"
                                        offset-y
                                        max-width="290px"
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                outlined
                                                v-model="data.start_time"
                                                label="Event Start Time*"
                                                prepend-icon="access_time"
                                                readonly
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            color="#3b5998"
                                            v-if="menu2"
                                            v-model="data.start_time"
                                            full-width
                                            @click:minute="$refs.menus.save(data.start_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                    <span class="red--text" v-if="errors.start">This field is required</span>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-select
                                        @change="changingToDate1"
                                        :items="checkDays"
                                        label="Select End Day*"
                                        outlined
                                        v-model="data.end_date"
                                    ></v-select>
                                    <span class="red--text" v-if="errors.end">This field is required</span>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-menu
                                        ref="menu"
                                        v-model="menu3"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="data.end_time"
                                        transition="scale-transition"
                                        offset-y
                                        max-width="290px"
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                outlined
                                                v-model="data.end_time"
                                                label="Event End Time*"
                                                prepend-icon="access_time"
                                                readonly
                                                v-on="on"
                                            ></v-text-field>
                                        </template>
                                        <v-time-picker
                                            color="#3b5998"
                                            v-if="menu3"
                                            v-model="data.end_time"
                                            full-width
                                            @click:minute="$refs.menu.save(data.end_time)"
                                        ></v-time-picker>
                                    </v-menu>
                                    <span class="red--text" v-if="errors.end">This field is required</span>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-textarea
                                        label="Event Details"
                                        outlined
                                        rows="1"
                                        v-model="data.details"
                                    ></v-textarea>
                                    <span class="red--text" v-if="errors.details">{{errors.details[0]}}</span>
                                </v-col>


                            </v-row>
                        </v-form>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn style="color: white;background-color: #3b5998;" @click="dialog = false"  text>Close</v-btn>
                    <v-btn style="color: white;background-color: #3b5998;" @click="send" text>Create</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        {{gettingUserId}}
        {{cheeckingX}}
    </v-row>
</template>
<script>
    export default {
        props:['data'],
        data: () => ({
            dialog: false,
            menu2: false,
            menu3: false,
            modal: false,
            modal2: false,
            event:{
                type:null,
                name: null,
                details: null,
                start:null,
                end:null,
                start_date:null,
                start_time:null,
                end_date:null,
                end_time:null,
                color: null,
                userId:null,
            },
            start_date:null,
            start_time:null,
            end_date:null,
            end_time:null,
            items: [
                'Subject Routine',
                'Holiday',
                'Class Break',
                'Exam',
            ],
            checkDays: [
                'Saturday',
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
            ],
            // colors: [
            //     {
            //         name: 'blue',
            //
            //     },
            //     {
            //         name: 'indigo',
            //
            //
            //     },
            //     {
            //         name: 'deep-purple',
            //
            //
            //     },
            //     {
            //         name: 'cyan',
            //
            //
            //     },
            //     {
            //         name: 'red',
            //
            //     },
            //     {
            //         name:'brown',
            //     },
            //     {
            //         name:'deep-orange',
            //     },
            //     {
            //         name:'teal',
            //     },
            //     {
            //         name:'grey darken-1',
            //     },
            //     {
            //         name:'black',
            //     },
            //
            //
            //
            // ],
            x:0,
            errors:{},


        }),
        created() {
            this.event=this.data;
        },


        computed:{

            checkingDisabled()
            {
                if(this.event.type=='Subject Routine')
                {
                    return false;
                }
                else
                    return true;
            },
            gettingUserId(){
                this.event.userId=User.id();
            },

            cheeckingX()
            {
                if (this.x==0){
                    this.event={};
                    this.start_date=null;
                    this.start_time=null;
                    this.end_date=null;
                    this.end_time=null;
                    this.x=1;
                }
            },

        },
        methods:{
            send(){
                axios.post(`/lms/api/class/routine/${this.id}`,this.event)
                    .then(res =>(this.dialog=false,this.$toasted.show('Routine Created',{type:'success'})))
                    .catch(error =>this.errors = error.response.data.errors)
                this.x=0
            },
            ChangingColorAll()
            {
                if (this.event.type=='Subject Routine')
                {
                    this.event.color='indigo';
                }
                if (this.event.type=='Holiday')
                {
                    this.event.color='red';
                    this.event.name='Holiday';
                }
                if (this.event.type=='Exam')
                {
                    this.event.color='deep-orange';
                    this.event.name='Exam';
                }
                if (this.event.type=='Class Break')
                {
                    this.event.color='teal';
                    this.event.name='Class Break';

                }
            },
            changingToDate()
            {
                if (this.event.start=='Saturday')
                {
                    this.event.start_date='2019-12-7';
                }
                if (this.event.start=='Sunday')
                {
                    this.event.start_date='2019-12-1';
                }
                if (this.event.start=='Monday')
                {
                    this.event.start_date='2019-12-2';
                }
                if (this.event.start=='Tuesday')
                {
                    this.event.start_date='2019-12-3';
                }
                if (this.event.start=='Wednesday')
                {
                    this.event.start_date='2019-12-4';
                }
                if (this.event.start=='Thursday')
                {
                    this.event.start_date='2019-12-5';
                }
                if (this.event.start=='Friday')
                {
                    this.event.start_date='2019-12-6';
                }
            },
            changingToDate1()
            {
                if (this.event.end=='Saturday')
                {
                    this.event.end_date='2019-12-7';
                }
                if (this.event.end=='Sunday')
                {
                    this.event.end_date='2019-12-1';
                }
                if (this.event.end=='Monday')
                {
                    this.event.end_date='2019-12-2';
                }
                if (this.event.end=='Tuesday')
                {
                    this.event.end_date='2019-12-3';
                }
                if (this.event.end=='Wednesday')
                {
                    this.event.end_date='2019-12-4';
                }
                if (this.event.end=='Thursday')
                {
                    this.event.end_date='2019-12-5';
                }
                if (this.event.end=='Friday')
                {
                    this.event.end_date='2019-12-6';
                }
            },




        }


    }
</script>
`
