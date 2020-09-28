<template>
    <v-menu
        transition="slide-y-transition"
        nudge-bottom="50"
        nudge-width="100"
        open-on-hover
        allow-overflow
        max-width="250"


    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                icon
                depressed
                style="background-color:#E0E0E0;color:#757575;"
                class="mr-3"
                v-bind="attrs"
                v-on="on"
            >
                <v-badge
                    color="#3b5998"
                >
                    <template v-if="unreadCount>0" v-slot:badge>{{unreadCount}}</template>
                    <v-icon :color="color">notifications</v-icon>
                </v-badge>
            </v-btn>
        </template>

        <v-list
            style="max-height: 400px"
            class="overflow-y-auto"
        >

            <v-list-item v-for="item in unread" :key="item.id">
                <div v-if="item.type =='App\\Notifications\\newUserNotification'"  @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}} <b>"{{item.name}} {{item.title}}"</b>.</a></div>
                <div v-if="item.type =='App\\Notifications\\newSubjectEventNotification'"  @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}} <b>"{{item.title}}"</b>  in {{item.name}}.</a></div>
                <div v-if="item.type =='App\\Notifications\\newAllEventNotification'"  @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}} <b>"{{item.title}}"</b></a></div>
                <div v-if="item.type =='App\\Notifications\\newStudentAssignNotification'"  @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}} <b>"{{item.name}}"</b>  in  {{item.title}}.</a></div>
                <div v-if="item.type =='App\\Notifications\\newTeacherAssignNotification'"  @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}} <b>"{{item.name}}"</b>  in  {{item.title}}.</a></div>
                <div v-if="item.type=='App\\Notifications\\newaAnnouncementNotification'" @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}} <b>"{{item.title}}"</b>  in  {{item.name}}.</a></div>
                <div v-if="item.type=='App\\Notifications\\newAssignmentNotification'" @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}} <b>"{{item.title}}"</b>  in  {{item.name}}</a></div>
                <div v-if="item.type=='App\\Notifications\\newMaterialNotification'" @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}} <b>"{{item.title}}"</b>  in  {{item.name}}</a></div>
                <div v-if="item.type=='App\\Notifications\\newExamStartNotification'" @click="readIt(item)" class="caption"> <a :href="item.path" class="font-weight-bold" style="color: #e53935;text-decoration:none" >{{item.data}}   <b>{{item.name}}</b> </a></div>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item v-for="item in read" :key="item.id">
                <div  class="caption"> <a :href="item.path"  style="text-decoration:none;color:#1a1a1a" >{{item.data}} <b>"{{item.title}}"</b>  in  {{item.name}}.</a></div>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script>
    import Exception from "../Helpers/Exception";

    export default {
        data(){
            return {
                read : {},
                unread : {},
                unreadCount : 0,
                sound: "http://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3",
                id:0,
            }
        },
        created(){
            if(User.loggedIn()){
                this.getNotifications()
            }
            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.playSound()
                    this.unread.unshift(notification)
                    this.unreadCount++
                });

        },
        methods:{
            playSound(){
                let alert = new Audio(this.sound)
                alert.play()

            },
            getNotifications(){
                this.id=User.id()
                axios.post(`/lms/api/notifications/${this.id}`)
                    .then(res =>{
                        this.read = res.data.read
                        this.unread = res.data.unread
                        this.unreadCount=res.data.unread.length
                    })
                    .catch(error =>Exception.handle(error))
            },
            readIt(notification){
                this.id=User.id()
                axios.post(`/lms/api/markAsRead/${this.id}`,{id:notification.id})
                    .then(res =>{
                        this.unread.splice(notification,1)
                        this.read.push(notification)
                        this.unreadCount--
                    })

            },

        },
        computed:{
            color(){
                return this.unreadCount > 0 ? 'red' : ''
            }
        }
    }
</script>
