<template>
    <div>
        <div >
            <v-tabs
                color="grey lighten-2"  flat
                grow
                v-model="tab"
                center-active
                slider-size="4"





            >
                <v-tab
                    :key="item.name"
                    v-for="item in items"
                    outlined
                    tile
                    style="font-size:1em;background-color:#3b5998;color: white;"


                >
                    {{ item.name }}
                </v-tab>
            </v-tabs>
        </div>

        <v-tabs-items  v-model="tab">
            <v-tab-item>
                <v-card class="grey lighten-4" flat>

                    <Classhead :dataH="class_head"></Classhead>
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card class="grey lighten-4" flat>
                    <C_lass :dataH="class_head" :datafld="subjects"></C_lass>
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card class="grey lighten-4" flat>
                    <All_Student :dataH="classHeadData" :datafld="subjects" :data="student_user"></All_Student>
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card class="grey lighten-4" flat>
                    <AllTeacher :dataH="class_head" :datafld="subjects" :data="teacher_user"  ></AllTeacher >
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card class="grey lighten-4" flat>
                    <AllAdmin  :data="admin_user"></AllAdmin >
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card class="grey lighten-4" flat>
                    <Request :data="request_user"></Request>
                </v-card>
            </v-tab-item>
        </v-tabs-items>
       {{getStudentData}}
    </div>

</template>
<script>
    import AllAdmin from "./AllAdmin.vue";
    import All_Student from "./AllStudent.vue";
    import AllTeacher from "./AllTeacher.vue";
    import Request from "./Request.vue";
    import C_lass from "./Subject.vue";
    import Classhead from "./classHead.vue"
    import User from "../../Helpers/User";

    export default {

        components: {AllTeacher, All_Student,Request,C_lass,Classhead,AllAdmin},
        data() {
            return {
                tab: null,
                items: [
                    {
                        name:'Class'
                    },
                    {
                      name:'Subject'
                    },
                    {
                        name: 'Student',

                    },
                    {
                        name: 'Teacher',


                    },
                    {
                        name: 'Admin',


                    },
                    {
                        name: 'Permission',


                    },

                ],
                class_head:{},
                subjects:{},
                request_user:{},
                student_user:{},
                teacher_user:{},
                admin_user:{},
                classHeadData:null,

            }
        },
        beforeRouteEnter (to, from, next) {
            if (User.loggedIn() && User.role()=='Admin'){
                next();
            }
            else
            {
                next('/')
            }
        },
        created()
        {
           this. getclassHead();
           this.getSubject();
           this.getRequest_user();
           this.getStudent_user();
           this.getTeacher_user();
           this.getAdmin_user();
        },


        methods: {
            getclassHead() {
                axios.get('/lms/api/class-head')
                    .then(res => this.class_head = res.data.data)


            },
            getSubject()
            {
                axios.get('/lms/api/class')
                    .then(res => this.subjects = res.data.data)

            },
            getRequest_user(){
                axios.get('/lms/api/request_user')
                    .then(res => this.request_user = res.data.data)
            },
            getStudent_user(){
                axios.get('/lms/api/user/student_user')
                    .then(res => this.student_user = res.data.data)
            },
            getTeacher_user()
            {
                axios.get('/lms/api/user/teacher_user')
                    .then(res => this.teacher_user = res.data.data)

            },
            getAdmin_user()
            {
                axios.get('/lms/api/user/admin_user')
                    .then(res => this.admin_user = res.data.data)

            },

        },
        computed: {
            getStudentData()
            {
                this.classHeadData=this.class_head;
            }



        },
    }
</script>
<style>


</style>
