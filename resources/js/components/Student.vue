<template>
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

                <th style=" font-size: 1.5rem " class="text-left font-weight-black">Name</th>
                <th style=" font-size: 1.5rem " class="text-center font-weight-black">Profile</th>
                <th  v-if="permission=='Admin'" style=" font-size: 1.5rem " class="text-center font-weight-black">Action</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="student in data" v-if="student.role=='Student' && student.Status==1">
                <td>
                    <v-list  class="grey lighten-4 ma-0 pa-0" subheader>
                    <v-list-item
                    >
                        <v-list-item-avatar>
                            <v-img :src="'http://127.0.0.1:8000/uploads/x/x/profile/blank-profile.png'"
                                   v-if="student.image==null"></v-img>
                            <v-img :src="'http://127.0.0.1:8000/uploads/x/x/profile/'+ student.image"
                                   v-else></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title> {{student.first_name}} {{student.last_name}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                </td>
                <td>
                    <details_dilog :data="student"></details_dilog>
                </td>

                <td v-if="permission=='Admin'"  class="text-center">
                    <removeStudentFromClass :data1="data1" :data="student"></removeStudentFromClass>
                </td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>

</template>
<script>
    import details_dilog from "../components/AdminPannel/details_dilog.vue";
    import removeStudentFromClass from "./removeStudentFromClass.vue";
    export default {
        props:['data','data1'],
        components:{details_dilog,removeStudentFromClass},
        data () {
            return {
                permission:null,
            }
        },
        created() {
            this.permission=User.role();
            this.listen();
        },
        methods:{
            listen(){
                EventBus.$on('user-remove',(userRemove) =>{
                    this.data.splice(this.data.indexOf(userRemove), 1);
                })
            },
        }
    }
</script>
<style>

</style>

