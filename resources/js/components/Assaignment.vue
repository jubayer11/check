<template>

    <v-card
        class="mx-auto d-flex flex-wrap grey lighten-4"
        max-width="100%"
        flat
        style="padding: 1%"

    >
        <v-card

            max-width="100%"
            tile
            width="100%"
            flat
            class="grey lighten-4"

        >


            <v-card-title
                class="white--text justify-center font-weight-bold"
                style="font-size: 1.3em;padding-bottom: 1.5%;"
            >
                <v-spacer></v-spacer>
                <h2 style="color: #3b5998;">
                    Assignments
                </h2>
                <v-spacer></v-spacer>
                <dilog v-if="permission=='Admin'|| permission=='Teacher'" :data1="Cdata"></dilog>
            </v-card-title>

        </v-card>
        <v-row style="margin-top:1%;">

            <v-col
                cols="12"
                md="4"
                v-for="(assignment,index) in assignments" :key="assignment.id"
            >
                <v-card flat>
                <v-card
                    flat
                    class="mx-auto"
                    max-width="100%"
                    height="420"
                    style="overflow-y: auto;"


                >
                    <v-card-title>
                        <v-icon
                            large
                            left
                        >
                            event
                        </v-icon>
                        <span class="title font-weight " style="color:darkred;">Deadline: {{assignment.deadline}}</span>
                    </v-card-title>
                    <v-card-actions style="padding-left: 10%">
                        {{assignment.created_at}}
                    </v-card-actions>
                    <v-card-title>
                        {{assignment.title}}
                    </v-card-title>
                    <v-card-actions style="padding-left:5%;">
                        <a v-if="assignment.file" :href="'http://faisalsarker.com/lms/public/uploads/x/x/assignment/'+assignment.file" target="_blank"><button type="button" class="btn btn-sm">Read File</button></a>

                    </v-card-actions>
                    <v-card-text  style="font-size:1.2em;" class="font-weight-bold">
                        "{{assignment.body}}"
                    </v-card-text>

                </v-card>
                    <v-card v-if="permission=='Admin'|| permission=='Teacher'" flat>
                        <v-card-title>
                            <VEditDialog :data="assignment"></VEditDialog>
                            <v-spacer></v-spacer>
                            <deleteAssignmentDialog  :data="assignment"></deleteAssignmentDialog>
                        </v-card-title>
                    </v-card>
                </v-card>

            </v-col>


        </v-row>
        {{geetingClassId}}
        {{gettingAssignment}}
    </v-card>
</template>
<script>
    import dilog from './Assignment_dilog'
    import VEditDialog from './EditAssignments_dilog.vue'
    import deleteAssignmentDialog from "./deleteAssignmentDialog.vue";
    export default {
        props:['Adata','Cdata'],
        components:{dilog,VEditDialog,deleteAssignmentDialog},
        data(){
            return {
                assignments:{},
                class_id:null,
                permission:null,



            }
        },
        created() {
            this.permission=User.role();
            this.listen()

        },
       computed:{
            geetingClassId(){
              this.class_id=this.Cdata;
            },
           gettingAssignment(){
             this.assignments=this.Adata;
           },
       },
        methods:{
            listen(){
                EventBus.$on('newAssignment',(an1) =>{
                    this.assignments.unshift(an1)
                })
                EventBus.$on('ass-remove',(ass_r) =>{
                    this.assignments.splice(this.assignments.indexOf(ass_r), 1);
                })
            },
        },

    }

</script>
