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
                    Create Event


                </v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Create Event</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-form @submit.prevent="send">
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Event Name*"
                                    outlined
                                    v-model="event.name"
                                ></v-text-field>
                                <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-textarea
                                    label="Event Details*"
                                    outlined
                                    rows="1"
                                    v-model="event.details"
                                ></v-textarea>
                                <span class="red--text" v-if="errors.details">{{errors.details[0]}}</span>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-dialog
                                    ref="dialogs"
                                    v-model="modal"
                                    :return-value.sync="start_date"
                                    persistent
                                    width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="start_date"
                                            label="Event Start Date*"
                                            prepend-icon="event"
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker color="#3b5998" v-model="start_date" scrollable>
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
                                        <v-btn text color="primary" @click="$refs.dialogs.save(start_date)">OK</v-btn>
                                    </v-date-picker>
                                </v-dialog>
                                <span class="red--text" v-if="errors.start">This field is required</span>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-menu
                                    ref="menus"
                                    v-model="menu2"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    :return-value.sync="start_time"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="start_time"
                                            label="Event Start Time*"
                                            prepend-icon="access_time"
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-time-picker
                                        color="#3b5998"
                                        v-if="menu2"
                                        v-model="start_time"
                                        full-width
                                        @click:minute="$refs.menus.save(start_time)"
                                    ></v-time-picker>
                                </v-menu>
                                <span class="red--text" v-if="errors.start">This field is required</span>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-dialog
                                    ref="dialog"
                                    v-model="modal2"
                                    :return-value.sync="end_date"
                                    persistent
                                    width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="end_date"
                                            label="Event End Date*"
                                            prepend-icon="event"
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker color="#3b5998" v-model="end_date" scrollable>
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="modal2 = false">Cancel</v-btn>
                                        <v-btn text color="primary" @click="$refs.dialog.save(end_date)">OK</v-btn>
                                    </v-date-picker>
                                </v-dialog>
                                <span class="red--text" v-if="errors.end">This field is required</span>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-menu
                                    ref="menu"
                                    v-model="menu3"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    :return-value.sync="end_time"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="end_time"
                                            label="Event End Time*"
                                            prepend-icon="access_time"
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-time-picker
                                        color="#3b5998"
                                        v-if="menu3"
                                        v-model="end_time"
                                        full-width
                                        @click:minute="$refs.menu.save(end_time)"
                                    ></v-time-picker>
                                </v-menu>
                                <span class="red--text" v-if="errors.end">This field is required</span>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-select
                                    :items="colors"
                                    label="Event Color*"
                                    item-text="name"
                                    item-value="name"
                                    outlined
                                    v-model="event.color"
                                ></v-select>
                                <span class="red--text" v-if="errors.color">{{errors.color[0]}}</span>
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
        {{gettingStart_EndTime}}
        {{cheeckingX}}
    </v-row>
</template>
<script>
    export default {
        data: () => ({
            dialog: false,
            menu2: false,
            menu3: false,
            modal: false,
            modal2: false,
            event:{
                name: null,
                details: null,
                start: null,
                end: null,
                color: null,
                userId:null,
            },
            start_date:null,
            start_time:null,
            end_date:null,
            end_time:null,
            colors: [
                {
                    name: 'blue',

                },
                {
                    name: 'indigo',


                },
                {
                    name: 'deep-purple',


                },
                {
                    name: 'cyan',


                },
                {
                    name: 'red',

                },
                {
                    name:'brown',
                },
                {
                    name:'deep-orange',
                },
                {
                    name:'teal',
                },
                {
                    name:'grey darken-1',
                },
                {
                    name:'black',
                },



            ],
            x:0,
            errors:{},


        }),


        computed:{
            gettingUserId(){
                this.event.userId=User.id();
            },

            gettingStart_EndTime(){
                if (this.start_date !=null && this.start_time !=null) {
                    this.event.start = this.start_date + ' ' + this.start_time;
                }
                if(this.end_date !=null && this.end_time !=null) {
                    this.event.end = this.end_date + ' ' + this.end_time;
                }

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
                axios.post('/lms/api/allevent',this.event)
                    .then(res =>(this.dialog=false,this.$toasted.show('Event Created',{type:'success'}),window.location.reload()))
                    .catch(error =>this.errors = error.response.data.errors)
                this.x=0
            }


        }


    }
</script>
