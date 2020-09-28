
<template>
    <v-container class="grey lighten-4" style="padding-bottom:25%;margin-top: 0.5%">
        <v-row class="d-flex mb-0">
            <v-col md="6">
        <Create_subject_dialog  :datah="dataH"> </Create_subject_dialog>
            </v-col>
            <v-col md="6">
                <div align="right">
                    <v-text-field
                        class="my-input"
                        style="width: 70%;"
                        placeholder="Search By Name"
                        outlined
                        rounded
                        append-icon
                        v-model="search"
                    >
                        <v-tooltip slot="append" bottom>
                            <v-icon slot="activator" color="primary" dark>search</v-icon>
                            <span>Tooltip</span>
                        </v-tooltip>
                    </v-text-field>

                </div>
            </v-col>
        </v-row>
        <v-simple-table
            fixed-header
            width="100%"
            height="100%"
            class="grey lighten-4"
            flat
        >
            <template v-slot:default>
                <thead>
                <tr>
                    <th  style=" font-size: 1.2rem " class="text-left font-weight-black">Name</th>
                    <th style=" font-size: 1.2rem " class="text-center font-weight-black">Class</th>
                    <th style=" font-size: 1.2rem " class="text-center font-weight-black">Profile</th>
                    <th style=" font-size: 1.2rem " class="text-center font-weight-black">Status</th>
                <th style=" font-size: 1.2rem;"   class="text-center font-weight-black">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="subject in filteredBlogs">
                    <td class="text-capitalize" style="font-size: 1rem">
                        {{subject.name}}
                    </td>

                    <td style="text-align: center;font-size: 1rem">
                        {{subject.class_name}}
                    </td>
                    <td style="text-align: center;font-size: 1rem">
                        <subject_Profile_dialog :data="subject"></subject_Profile_dialog>
                    </td>
                    <td class="text-center">
                        <v-btn depressed small style="color:white;background-color:#2196F3" v-if="subject.status==1"
                               width="70">Active
                        </v-btn>
                        <v-btn depressed small style="color:white;background-color:#ff531a" v-else width="70">
                            In-Active
                        </v-btn>
                    </td>
                    <td class="text-center">
                        <Edit_Subject_dialog :subject="subject" :datah="dataH"></Edit_Subject_dialog>
                        <Delete_subject_dialog :data="subject"></Delete_subject_dialog>
                    </td>

                </tr>

                </tbody>
            </template>
        </v-simple-table>
    </v-container>

</template>
<script>
    import details_dilog from "./details_dilog.vue";
    import Create_subject_dialog from "./Create_subject_dialog.vue";
    import Edit_Subject_dialog from "./Edit_Subject_dialog.vue";
    import Delete_subject_dialog from "./Delete_subject_dialog.vue";
    import subject_Profile_dialog from "./subject_Profile_dialog.vue";

    export default {
        props:['dataH','datafld'],
        components:{details_dilog,Create_subject_dialog,Edit_Subject_dialog,Delete_subject_dialog,subject_Profile_dialog},
        data () {
            return {
                search:'',


            }
        },
        created() {
            this.createSubjectUpdate();
            this.deleteSubject();
        
        },
        methods:{


            createSubjectUpdate()
            {
                EventBus.$on('newSubject',(subject) =>{
                    this.datafld.unshift(subject)
                })
            },
            deleteSubject()
            {
                EventBus.$on('subject-deleted',(subjectDelete) =>{
                    this.datafld.splice(this.datafld.indexOf(subjectDelete), 1);
                })
            },
        },
        computed:{
            filteredBlogs: function(){
                return this.datafld.filter((el) => {
                    return (el.name.toLowerCase().match(this.search)) ||(el.name.toUpperCase().match(this.search));
                });
            },
        }

    }
</script>
<style>

</style>
