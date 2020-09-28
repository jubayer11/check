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
                    Announcements
                </h2>
             <v-spacer></v-spacer>
                <dilog  v-if="permission=='Admin'|| permission=='Teacher'" style="text-align: right" :data="lmsclass_id"></dilog>
            </v-card-title>

            </v-card>

        <v-row style="margin-top:1%;">
            <v-col
                cols="12"
                md="4"
                v-for="(announcement,index) in announcements" :key="announcement.id"
            >
                <v-card flat>
                <v-card
                    flat
                    class="mx-auto"
                    max-width="100%"
                    height="300"
                    style="overflow-y: auto"


                >

                    <v-card-title>
                        <v-icon
                            large
                            left
                        >
                            announcement
                        </v-icon>
                        <span class="title font-weight " style="color:darkred;">{{announcement.title}}</span>
                    </v-card-title>
                    <v-card-actions style="padding-left: 10%">
                   {{announcement.created_at}}
                   </v-card-actions>


                    <v-card-text  style="font-size:1.2em;" class="font-weight-bold">
                        "{{announcement.body}}"
                    </v-card-text>
                </v-card>
                    <v-card   v-if="permission=='Admin'|| permission=='Teacher'" flat>
                        <v-card-title >
                            <VEditDialog :data="announcement"></VEditDialog>
                            <v-spacer></v-spacer>
                            <deleteAnnouncementDialog :data="announcement"></deleteAnnouncementDialog>
                        </v-card-title>
                    </v-card>
                </v-card>
                <br>

            </v-col>
        </v-row>
          {{getannouncements}}
          {{getclassid}}

    </v-card>
</template>
<script>
    import dilog from './Announcement_dilog.vue';
    import VEditDialog from './EditAnnouncements_dilog.vue';
    import deleteAnnouncementDialog from "./deleteAnnouncementDialog.vue";

    export default {
        components: {dilog,VEditDialog,deleteAnnouncementDialog},
        props:['data','datas'],
        data() {
            return {
                announcements: {},
                user_id:null,
                lmsclass_id:null,
                permission:null,


            }
        },
        created() {
            this.permission=User.role();
            this.listen()

        },
        methods:{
            listen(){
                EventBus.$on('newAnn',(ann) =>{
                    this.announcements.unshift(ann)
                })
                EventBus.$on('ann-remove',(ann_r) =>{
                    this.announcements.splice(this.announcements.indexOf(ann_r), 1);
                })
                Echo.private('App.User.' + User.id())
                    .notification((notification) => {
                        this.content.unshift(notification.ann)
                    });
            },

        },
        computed:{
          getannouncements(){
              this.announcements=this.data;
          },
            getclassid(){
                this.lmsclass_id=this.datas;
            },
        },


    }

</script>
<style>
    /*@media screen and (max-width: 400px) {*/
    /*    .sidebar{*/
    /*        font-size:200%*/
    /*    }*/
    /*}*/

</style>
