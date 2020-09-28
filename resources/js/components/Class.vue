<template>
    <div>
        <div >
            <v-tabs
                color="grey lighten-2"
                flat
                grow
                v-model="tab"
                center-active
                mobile-break-point="700"
                show-arrows
                slider-color="white"
                slider-size="4"


            >
                <v-tab

                    outlined
                    tile
                    style="font-size: 100%;background-color:#3b5998;color: white;"

                >
                    INFORMATION
                </v-tab>
                <v-tab

                    outlined
                    tile
                    style="font-size: 100%;background-color:#3b5998;color: white;"

                >
                    ANNOUNCEMENTS
                </v-tab>
                <v-tab

                    outlined
                    tile
                    style="font-size: 100%;background-color:#3b5998;color: white;"

                >
                    ASSIGNMENTS
                </v-tab>
                <v-tab

                    outlined
                    tile
                    style="font-size: 100%;background-color:#3b5998;color: white;"
                    v-if="permission=='Admin'|| permission=='Teacher'"
                >
                    STUDENTS
                </v-tab>
                <v-tab

                    outlined
                    tile
                    style="font-size: 100%;background-color:#3b5998;color: white;"
                    v-if="permission=='Admin'|| permission=='Teacher'"
                >

                    Exam
                </v-tab>
                <v-tab

                    outlined
                    tile
                    style="font-size: 100%;background-color:#3b5998;color: white;"
                    v-if="permission=='Student'"
                >
                    Exam
                </v-tab>
                <v-tab

                    outlined
                    tile
                    style="font-size: 100%;background-color:#3b5998;color: white;"
                    v-if="permission=='Admin'|| permission=='Teacher'"
                >
                    Marks
                </v-tab>
                <v-tab

                    outlined
                    tile
                    style="font-size: 100%;background-color:#3b5998;color: white;"

                >
                    Event
                </v-tab>
            </v-tabs>
        </div>

            <v-tabs-items  v-model="tab">
                <v-tab-item>
                    <v-card flat style="padding-top:1%">
                        <Information :data="classes" :datas="material" :dat="users"></Information>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card class="grey lighten-4" flat style="padding-top:1%">
                        <Announcement :data="announcements" :datas="classes.id"></Announcement >
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card class="grey lighten-4" flat style="padding-top:1%">
                        <Assaignment :Adata="assaignments" :Cdata="classes.id" ></Assaignment>
                    </v-card>
                </v-tab-item>
                <v-tab-item v-if="permission=='Admin'|| permission=='Teacher'">
                    <v-card class="grey lighten-4" flat style="padding-top:1%">
                        <Student :data1="classes.id" :data="users"></Student>
                    </v-card>
                </v-tab-item>
                <v-tab-item v-if="permission=='Admin'|| permission=='Teacher'" >
                    <v-card class="grey lighten-4" flat style="padding-top:1%">
                        <Exam :data="classes.id" :exam="classes.exam"   ></Exam>
                    </v-card>
                </v-tab-item>
                <v-tab-item v-if="permission=='Student'">
                    <v-card class="grey lighten-4" flat style="padding-top:1%">
                        <ExamAnswer :data="classes.id" :exam1="classes.exam"   ></ExamAnswer>
                    </v-card>
                </v-tab-item>
                <v-tab-item v-if="permission=='Admin'|| permission=='Teacher'" >
                    <v-card class="grey lighten-4" flat style="padding-top:1%">
                        <Marks :data1="classes.id" :exam2="classes.exam"   ></Marks>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card class="grey lighten-4" flat >
                        <classCalnederView :events="events" :data1="classes.id"> </classCalnederView>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>

        {{redirect2}}
       {{getmaterial}}
        {{getuser}}
        {{getannouncement}}
        {{getassignment}}
        {{getClassEvent}}
        {{redirect}}


    </div>
</template>
<script>
    import invite_dilog from "./invite_dilog";
    import dilog from './Material_dilog.vue';
    import Information from "./Information.vue";
    import Announcement from "./Announcement.vue";
    import Assaignment from "./Assaignment.vue";
    import Student from "./Student.vue";
    import Exam from "./Exam.vue";
    import ExamAnswer from "./ExamAnswer";
    import Marks from "./Teacher_marking.vue";
    import classCalnederView from "./classCalnederView.vue";
    import User from "../Helpers/User";

    export default {

        components: {
            dilog,
            invite_dilog,
            Information,
            Announcement,
            Assaignment,
            Student,
            Exam,
            ExamAnswer,
            Marks,
            classCalnederView
        },
        data() {
            return {
                tab: null,
                classes: {},
                material: {},
                users: {},
                events: {},
                announcements: {},
                assaignments: {},
                user_id: null,
                permission: null,
                xy:0,
                yz:0,



            }
        },
        beforeRouteEnter(to, from, next) {
            if (User.loggedIn()) {
                next();
            } else {
                next('/')
            }
        },
        created() {
            this.$Progress.start()
            this.permission = User.role();
            this.getclass();
            this.getuserId();


        },


        methods: {
            getuserId() {
                this.user_id = User.id();
            },
            getclass() {
                axios.get(`/lms/api/class/about/${this.$route.params.name}`)
                    .then(res => this.classes = res.data.data)

            },
        },
        computed: {

            redirect() {
                if (User.role() != 'Admin') {
                    this.users.forEach((el) => {
                        if (el.id == this.user_id) {
                            this.xy = 1;
                        }
                    });
                    this.yz = 2;
                    if (this.xy != 1 && this.yz == 2) {
                        this.$router.push({name: 'profile'})
                    }
                }
            },
            redirect2() {
                if (User.role() != 'Admin') {
                    if (this.classes.status == 0 || this.classes.classHead_status == 0) {
                        this.$router.push({name: 'profile'})
                    }
                }
            },
            getClassEvent() {
                axios.get(`/lms/api/class/event/${this.classes.id}`)
                    .then(res => this.events = res.data.data)
            },
            getmaterial() {
                axios.get(`/lms/api/material/${this.classes.id}`)
                    .then(res => this.material = res.data.data)
            },
            getuser() {
                axios.get(`/lms/api/class/user/${this.classes.id}`)
                    .then(res => this.users = res.data.data)

            },
            getannouncement() {
                axios.get(`/lms/api/announcement/${this.classes.id}`)
                    .then(res => this.announcements = res.data.data);

            },
            getassignment() {
                axios.get(`/lms/api/class/assignment/${this.classes.id}`)
                    .then(res => this.assaignments = res.data.data);

            },


        },
    }

</script>
<style>
    /* Helper classes */
    #basil {
        background-color: #b380ff !important;
    }

    .basil--text {
        color: white !important;
    }

</style>
