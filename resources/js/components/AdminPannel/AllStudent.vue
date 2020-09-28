<template>
    <v-container class="grey lighten-4" style="padding-bottom:25%;margin-top: 0.5%;height: 100%">
        <v-row class="d-flex mb-0">
            <v-col md="6">
                <CreateStudentDialog> </CreateStudentDialog>
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
                <th> <v-checkbox  color="#3b5998" v-model="checkAll" label="all"></v-checkbox></th>
                <th style=" font-size: 1.2rem " class="text-center font-weight-black">Name</th>
                <th style=" font-size: 1.2rem " class="text-center font-weight-black">Class</th>
                <th style=" font-size: 1.2rem " class="text-center font-weight-black">Profile</th>
                <th style=" font-size: 1.2rem " class="text-center font-weight-black">Status</th>
                <th  style=" font-size: 1.2rem;" class="text-center font-weight-black">Action</th>
                <th  style=" font-size: 1.2rem;" class="text-center font-weight-black">Last Login Ip</th>
                <th colspan="2" style=" font-size: 1.2rem;" class="text-center font-weight-black">Last Login Time</th>
            </tr>
            </thead>
            <tbody v-if="data.length">
            <tr v-for="(student,index) in students">
                <td> <v-checkbox color="#3b5998" dense v-model="userIds" :value="student.id" :label="index+1" ></v-checkbox> </td>
                <td>
                    <v-list  class="grey lighten-4 ma-0 pa-0" subheader>
                        <v-list-item
                        >
                            <v-list-item-avatar>
                                <v-img :src="'http://faisalsarker.com/lms/public/uploads/x/x/profile/blank-profile.png'"
                                       v-if="student.image==null"></v-img>
                                <v-img :src="'http://faisalsarker.com/lms/public/uploads/x/x/profile/'+ student.image"
                                       v-else></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title class="text-capitalize"> {{student.first_name}} {{student.last_name}}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </td>
                <template v-if="student.class_head !=''">
                <td v-for="(className,index) in student.class_head" class="text-center" style="font-size: 1rem">
                     {{className.name}}
                </td>
                </template>
                <template v-if="student.class_head == ''">
                    <td  class="text-center" style="font-size: 1rem">
                        Not Assigned
                    </td>
                </template>


                <td>
                    <details_dilog :data="student"></details_dilog>
                </td>
                <td class="text-center">
                    <v-btn depressed small style="color:white;background-color:#2196F3" v-if="student.Status==1"
                           width="70">Active
                    </v-btn>
                    <v-btn depressed small style="color:white;background-color:#ff531a" v-else width="70">In-Active
                    </v-btn>
                </td>
                <td class="text-center">
                    <Student_Assign_dialog :dataH="dataH" :datafld="datafld" :data="student"></Student_Assign_dialog>
                    <userEditProfile :data="student"></userEditProfile>
                    <Delete_Request :data="student"></Delete_Request>
                </td>
                <td class="text-center" v-if="student.login_ip!=null">
                    {{student.login_ip}}
                </td>
                <td class="text-center" v-if="student.login_ip==null">
                    Not logged In Yet
                </td>
                <td class="text-center" v-if="student.login_time!=null" >
                    {{student.login_time}}
                </td>
                <td class="text-center" v-if="student.login_time==null" >
                    Not logged In Yet
                </td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
        <br>
        <multipleStudentAssign :data="dataH" :datas="userIds" > </multipleStudentAssign>

        {{filteredBlogs}}
    </v-container>
</template>
<script>
    import userEditProfile from "./userEditProfile.vue";
    import multipleStudentAssign from "./multipleStudentAssign.vue";
    import details_dilog from "./details_dilog.vue";
    import Student_Assign_dialog from "./Student_Assign_dialog.vue";
    import Delete_Request from "./Delete_Request.vue";
    import CreateStudentDialog from "./CreateStudentDialog.vue";

    export default {
        components: {details_dilog, Student_Assign_dialog,Delete_Request,multipleStudentAssign,userEditProfile,CreateStudentDialog},
        props: ['data','dataH','datafld'],
        data () {
            return {
                AllClass:null,
                AllSubject:null,
                search:'',
                CheckingUser:null,
                selected: [],
                allSelected: false,
                userIds: [],
                students:null,


            }
        },
        created() {
            this.deleteStudent();
            this.createStudentUpadate();
        },
        methods:{
            createStudentUpadate(){
                EventBus.$on('newStudent',(student) =>{
                    this.students.unshift(student)
                })
            },

            select: function() {
                this.allSelected = false;
            },

            changing(){
                this.y=1;
            },
            deleteStudent()
            {
                EventBus.$on('user-deleted',(userDelete) =>{
                        this.data.splice(this.data.indexOf(userDelete), 1);
                    })
            },

        },
        computed:
            {
                checkAll: {
                    get: function () {
                        return this.students ? this.userIds.length == this.students.length : false;
                    },
                    set: function (value) {
                        var userIds = [];
                        if (value) {
                            this.students.forEach(function (student) {
                                userIds.push(student.id);
                            });
                        }
                        this.userIds = userIds;
                    }
                },

                filteredBlogs: function(){
                    this.students=this.data.filter((el) => {
                        return (el.first_name.toLowerCase().match(this.search)) ||(el.first_name.toUpperCase().match(this.search));
                    });
                },

            },
    }
</script>
<style>

</style>

