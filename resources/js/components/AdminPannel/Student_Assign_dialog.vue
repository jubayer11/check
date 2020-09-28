<template>

    <v-dialog  v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
            <v-badge
                v-model="show"
                color="blue darken-1"
                overlap
            >
                <template v-slot:badge>
                    <span>Assign</span>
                </template>

                <v-icon
                    v-on="on" class="my-3"  dark  color="blue darken-1" width="70"
                    large
                    @mouseover="show = true"
                    @mouseout="show = false"
                >assignment_turned_in</v-icon>

            </v-badge>
        </template>
        <v-card>
            <v-card-title>
                <span style="color:#3b5998;" class="headline">Assign Class/Subject</span>
            </v-card-title>
            <v-card-text>
                <v-container>




                            <v-select
                                :items="datak"
                                label="Select Class"
                                item-text="name"
                                item-value="id"
                                outlined
                                rounded
                                v-model="form.classHead"
                                @change="trackingsubject"
                            >

                            </v-select>

                            <v-select
                                v-model="form.subject"
                                :items="selectedSubject"
                                chips
                                item-text="name"
                                item-value="id"
                                label="Select Subject"
                                multiple
                                deletable-chips
                                rounded
                                outlined
                            ></v-select>
                    <span class="red--text" v-if="errors.subject">{{errors.subject[0]}}</span>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                <v-btn style="background-color:#3b5998;color:white;text-transform: none" text @click="Assign_ClassRoom">Assign</v-btn>
            </v-card-actions>
        </v-card>
        <div v-for="subject in checkingSubject">
            {{gettingcheckingsubject(subject.id)}}
        </div>



        {{getting_subject}}
        {{User_Subject}}
        {{User_class}}
        {{puttingdata}}


    </v-dialog>

</template>
<script>
    export default {
        props: ['data','dataH','datafld'],
        data: () => ({
            dialog: false,
            form: {
                classHead: null,
                subject: null,
            },
            show: false,
            checkingSubject:null,
            datak:[],
            selectedSubject:{},
            subject:{},
            puttingclass:null,
            x:0,
            errors:{},

        }),
        created(){
            this.subject=this.datafld;
            this.datak=this.dataH;
            this.datak.push({name: 'No Class', id: null, status: '', created_at: '', updated_at: ''});
        },


        computed:{

            puttingdata()
            {
                this.form.classHead=this.puttingclass;

            },


            getting_subject: function(){
                this.selectedSubject=this.subject.filter((el) => {
                    return (el.class_head_id== this.form.classHead);

                });

            },

            User_Subject()
            {
                this.form.subject=this.data.subject;
            },
            User_class(){
                this.checkingSubject=this.data.class_head;
            },

        },
        methods:{
            trackingsubject()
            {
                this.form.subject=null;
            },
            gettingcheckingsubject(id){
                this.puttingclass=id;
            },
            Assign_ClassRoom()
            {
                axios.post(`/lms/api/student/assign_c_s/${this.data.id}`,this.form)
                    .then(res =>(this.dialog=false,this.$toasted.show('Assigned',{type:'success'})),
                    )
                    .catch(error =>this.errors = error.response.data.errors)
            },


        }
    }
</script>
