import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import ConfirmSignup from "../components/ConfirmSignup.vue";
import Login from'../components/Login.vue'
import SignUp from'../components/Signup.vue';
import Calender from'../components/Calender.vue';
import Profile from'../components/Profile.vue';
import Class from'../components/Class.vue';
import Announcement from '../components/Announcement.vue';
import Assignment from '../components/Assaignment.vue';
import Student from '../components/Student.vue';
import Information from "../components/Information.vue";
import Admin from "../components/AdminPannel/index.vue"
import lms from "../components/AppHome.vue";
import AppHome from "../components/AppHome.vue";
import Logout from "../components/Logout.vue";
import lesson from "../components/lesson_view.vue";
import userProfile from "../components/userProfile.vue";
import resetPasswordWithToken from "../components/resetPasswordWithToken.vue";
import ClassRoutine from "../components/AdminPannel/ClassRoutine.vue";




const routes = [

     { path: '/lms/login', component: Login },
     { path: '/lms/signup', component: SignUp },
    { path: '/lms/calendar', component: Calender },
    { path: '/lms/profile', component: Profile,name:'profile'},
    { path: '/lms/user_profile/:name/:id', component: userProfile,name:'userProfile'},
    { path: '/lms/class/:name', component: Class,name:'class'},
    { path: '/lms/class/routine/:id', component: ClassRoutine,name:'routine'},
    { path:'/lms/class/material/:material',component:lesson,name:'material'},
    { path: '/lms/announcement', component: Announcement },
    { path: '/lms/assignment', component: Assignment },
    { path: '/lms/student', component: Student },
    { path: '/lms/information', component: Information},
    { path: '/lms/admin/dashboard', component: Admin},
    { path: '/lms/lms', component: lms},
    { path: '/lms/home', component: AppHome,name:'home'},
    { path: '/lms/logout', component: Logout,name:'logout'},
    { path: '/lms/checking_signup', component: ConfirmSignup,name:'ConfirmSignup'},
    {
        path: '/lms/reset-password/:token',
        name: '/lms/reset-password-form',
        component: resetPasswordWithToken,
    },



]


const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang:false,
    mode: 'history'
})
export default router
