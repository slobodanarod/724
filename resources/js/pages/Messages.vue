<template>
    <main class="dashboard-mp">
        <div class="dash-tab-links">
            <div class="container">
                <div class="dash-discussions mb-20 bpm-50">
                    <div class="text-center" v-if="convs.length < 1">Henüz bir mesaj bulunmamaktadır.</div>
                    <div v-else id="content-wrapper">
                        <div class="container-fluid pb-0">
                            <div class="row">
                                <div class="col-lg-4 msg col-sm-12">
                                    <div class="rightbox">
                                        <div class="msg-scroll">
                                            <div v-for="conv in convs" class="rightmsg" @click="getConv(conv.id)">
                                                <div class="message-radius">
                                                    <img :src=" 'images/users/' + conv.profile.image"
                                                         :alt="conv.profile.name" :title="conv.profile.name">
                                                </div>
                                                <div class="message-heading">
                                                    <h4>{{ conv.profile.name}}</h4>
                                                    <p>{{ conv.last_msg.message}}</p>
                                                </div>
                                                <div class="message-heading1">
                                                    <span><timeago
                                                        :datetime="conv.last_msg.created_at"></timeago></span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12" v-if="messages.length > 0">
                                    <div class="main-conversation-box">
                                        <div class="message-bar-head">
                                            <div class="usr-msg-details">
                                                <div class="usr-ms-img">
                                                    <img :src="'images/users/'+ cprofile.image" :alt="cprofile.name"
                                                         class="mCS_img_loaded">
                                                </div>
                                                <div class="usr-mg-info">
                                                    <router-link
                                                        :to="{ name : 'profile', params : { url : cprofile.slug } }">
                                                        <h3>{{cprofile.name}}</h3></router-link>
                                                    <p>Şu an sitede!</p>
                                                </div>
                                            </div>
                                            <div class="message-heading2">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </div>
                                        <div class="messages-line">
                                            <div id="mCSB_1"
                                                 class="mCS-light mCSB_vertical mCSB_inside"
                                                 tabindex="0" style="max-height: none;">
                                                <div class="mCSB_container"
                                                     style="position: relative;top: 90px;left: 0px;" dir="ltr">
                                                    <div class="main-message-box">
                                                        <div class="messg-usr-img">
                                                            <a href="#"><img src="images/messages/1_chat.jpg" alt=""  class="mCS_img_loaded"></a>
                                                        </div>
                                                    </div>
                                                    <div v-for="m in messages">


                                                        <div class="main-message-box ta-right"
                                                             v-if="m.user_id === user.id">
                                                            <div class="message-dt">
                                                                <div class="message-inner-dt">
                                                                    {{ m.message }}
                                                                </div>
                                                                <span><timeago
                                                                    :datetime="m.created_at"></timeago></span>
                                                            </div>
                                                        </div>
                                                        <div class="main-message-box st3" v-else>
                                                            <div class="message-dt st3">
                                                                <div class="message-inner-dt">
                                                                    <p> {{ m.message }} </p>
                                                                </div>
                                                                <span><timeago
                                                                    :datetime="m.created_at"></timeago></span>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="message-send-area">
                                            <form @submit.prevent="onSubmit">
                                                <div class="mf-field">
                                                    <input type="text" name="message" v-model="message.content"
                                                           placeholder="Mesajınızı buraya yazınız.">
                                                    <button type="submit">Gönder</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12" v-else>
                                    <h3 style="text-align: center; margin-top: 50px;">Lütfen görüntülemek istediğiniz
                                        sohbeti seçiniz.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        name: "Messages", props: ["user"], data ()
        {
            return {
                convs: [], messages: [], cprofile: {}, message: {content: ""}, conv_id: null
            }
        }, mounted ()
        {
            this.getAll();
        }, sockets: {
            sendMessage (data)
            {
                this.messages.push(data);
                $(function () {
                    var wtf = $('.messages-line');
                    var height = wtf[ 0 ].scrollHeight;
                    wtf.scrollTop(height);
                });
            }
        }, methods: {
            getAll ()
            {
                var data = {
                    yugo: "slavia"
                };
                window.axios.post('/messages/all', data).then((res) => {
                    this.convs = res.data;
                }).catch((err) => {

                });
            }, getConv (id)
            {
                var data = {
                    id: id
                };
                this.conv_id = id;
                window.axios.post("/get/conv", data).then((res) => {
                    this.messages = res.data.conversation;
                    this.cprofile = res.data.profile;
                });

            }, onSubmit ()
            {
                var data = {
                    c_id: this.conv_id, message: this.message.content, user_id: this.user.id
                };
                window.axios.post("/message/send", data).then((res) => {
                    this.$socket.client.emit("sendMessage", res.data);
                    this.message  = { content : ""}
                });

            }
        }
    }
</script>

<style scoped>
    .st3 { float: left;}

    .message-inner-dt p {margin-bottom: 0}

</style>
