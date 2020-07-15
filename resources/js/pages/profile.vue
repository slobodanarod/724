<template>
    <div>
        <send-message-modal :messageData="profileData"></send-message-modal>
        <main class="dashboard-mp" v-if="profile">
            <div class="dash-dts">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="event-title">
                                <div class="my-dash-dt">
                                    <img class="room-image" :src="'/images/users/' + profile.image"
                                         :alt="profile.name">
                                    <h3>{{ profile.name }},<small>{{ ageFunc() }} yaşında</small></h3>
                                    <span><i class="fas fa-map-marker-alt"></i>İzmir</span>
                                    <span v-if="onlinestatus === true">Şu an sistemde!</span>
                                    <span v-if="onlinestatus === false">Sistemde değil!</span>
                                </div>
                            </div>
                        </div>

                        <div v-if="profile.id !== user.id" class="col-lg-6 col-md-6 col-sm-12">
                            <ul class="right-details">
                                <li>
                                    <div class="user-buttons">
                                        <div class="my-all-evnts">
                                            <button @click="SendMessage()" class="msg-btn1 message"><i
                                                class="far fa-envelope-open"></i> Mesaj
                                                Gönder
                                            </button>
                                        </div>
                                        <div class="user-follow">
                                            <button @click="smile()" v-if="smiles" class="msg-btn1 smile"><i
                                                class="far fa-smile"></i> Zaten gülümsedin
                                            </button>
                                            <button @click="smile()" v-else class="msg-btn1 nsmile"><i
                                                class="far fa-smile"></i>
                                                Gülümse
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="dash-tab-links">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-md-12">
                            <div class="user-data full-width">
                                <div class="categories-left-heading">
                                    <h3>Hakkımda</h3>
                                </div>
                                <div class="sugguest-user">
                                    <p v-if="profile.description"> {{ profile.description}}</p>
                                    <p v-else> Bu Kullanıcı henüz bir açıklama yazısı girmedi. </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="main-posts">
                                <div v-for="p in posts">

                                    <div class="activity-posts" v-if="p.type === 1 ">
                                        <div class="activity-group1">
                                            <div class="main-user-dts1">
                                                <img :src="'/images/users/'+p.image" :alt="p.name">
                                                <div class="user-text3">
                                                    <h4>{{ p.name }}</h4>
                                                    <span><timeago :datetime="p.olusturma_tarihi"></timeago></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="activity-descp">
                                            <p>{{ p.post_content }}</p>
                                        </div>
                                    </div>
                                    <div class="activity-posts" v-if="p.type === 2 ">
                                        <div class="activity-group1">
                                            <div class="main-user-dts1">
                                                <router-link :to="{ name : 'profile' , params: { url: p.slug } }"><img
                                                    :src="'/images/users/'+p.image" :alt="p.name"></router-link>
                                                <div class="user-text3">
                                                    <h4>
                                                        <router-link
                                                            :to="{ name : 'profile' , params: { url: p.slug } }"
                                                            style="color:black;">{{ p.name }}
                                                        </router-link>
                                                    </h4>
                                                    <p>
                                                        <router-link
                                                            :to="{ name : 'room' , params: { url: p.room_slug } }"
                                                            style="color:black; font-weight:bold;">
                                                            {{ p.room_name}}
                                                        </router-link>
                                                        {{ p.post_content }} <span style="float:right"><timeago
                                                        :datetime="p.olusturma_tarihi"></timeago></span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="activity-descp">
                                            <p></p>
                                        </div>

                                    </div>
                                    <div class="activity-posts" v-if="p.type === 3 ">
                                        <div class="activity-group1">
                                            <div class="main-user-dts1">
                                                <router-link :to="{ name : 'profile' , params: { url: p.slug } }"><img
                                                    :src="'/images/users/'+p.image" :alt="p.name"></router-link>
                                                <div class="user-text3">
                                                    <h4>
                                                        <router-link
                                                            :to="{ name : 'profile' , params: { url: p.slug } }"
                                                            style="color:black;">{{ p.name }}
                                                        </router-link>
                                                    </h4>
                                                    <p>
                                                        <router-link
                                                            :to="{ name : 'room' , params: { url: p.room_slug } }"
                                                            style="color:black; font-weight:bold;">
                                                            {{ p.room_name}}
                                                        </router-link>
                                                        {{ p.post_content }} <span style="float:right"><timeago
                                                        :datetime="p.olusturma_tarihi"></timeago></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import SendMessageModal from "../components/SendMessageModal";

    export default {
        name: "profile", props: ["user"], components: {SendMessageModal}, data ()
        {
            return {
                profile: null, onlinestatus: null, posts: [], viewers: [], profileData: {}, smiles: null
            }
        }, sockets: {
            onlineCheck (data)
            {
                this.onlinestatus = data;

            }
        }, created ()
        {

        }, mounted ()
        {
            this.init();
            console.log(this.$route.params.url);
        }, methods: {
            init ()
            {
                var data = {
                    slug: this.$route.params.url
                };
                window.axios.post("/profile/init", data).then((res) => {
                    this.profile = res.data.profile;
                    this.viewers = res.data.viewers;
                    this.smiles = res.data.smile;
                    this.$socket.client.emit('onlineCheck', {user_id: res.data.profile.id});
                    var data1 = {
                        user_id: res.data.profile.id
                    };
                    window.axios.post("/post/get", data1).then((res) => {
                        this.posts = res.data;
                    })
                }).catch((err) => {
                    this.$router.push("/");
                });
            }, ageFunc ()
            {
                var tarih = new Date();
                var yil = tarih.getFullYear();
                var year = this.profile.borndate.substring(0, 4);
                return yil - year;
            }, SendMessage ()
            {
                this.profileData = {
                    p_id: this.profile.id
                };

                $('#sendMessage').modal('show');
            }, smile ()
            {
                var data = {
                    profile_id: this.profile.id
                };
                window.axios.post("/profile/smile", data).then((res) => {
                    this.smiles = !this.smiles;

                }).catch((err) => {

                });
            }
        }
    }
</script>

<style scoped>
    .room-image {
        float: left;
        width: 100px;
        margin-right: 10px;

    }

    .smile {
        background: #ec5569;
        color: white;
        border: 1px solid #ccc;
        width: 150px;
    }

    .nsmile {
        background: #ffac45;
        color: #fff;
        border: 1px solid #ccc;
        width: 150px;
    }

    .message {
        width: 150px;
        margin-right: 10px;
    }

    @media only screen and (max-width: 600px) {
        .room-image {
            width: 100%;
            margin-right: 10px;
            float: none;

        }

        .my-dash-dt h3 { text-align: center;margin: 10px !important;}

        .my-dash-dt span { text-align: center;}


    }
</style>
