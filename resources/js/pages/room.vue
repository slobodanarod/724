<template>
    <div>
        <main class="dashboard-mp" v-if="room">
            <div class="dash-dts">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="event-title">
                                <div class="my-dash-dt">
                                    <img class="room-image" :src="'/images/rooms/' + room.room_image"
                                         :alt="room.room_name">
                                    <h3>{{ room.room_name }}</h3>
                                    <span>{{ room.room_desc }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <ul class="right-details">

                                <li>
                                    <div class="all-dis-evnt">
                                        <div class="dscun-txt">Toplam Mesaj</div>
                                        <div class="dscun-numbr">{{ count }}</div>
                                    </div>
                                </li>

<!--                                <li>-->
<!--                                    <div class="all-dis-evnt">-->
<!--                                        <div class="dscun-txt">Aktif Kullanıcı</div>-->
<!--                                        <div class="dscun-numbr">40</div>-->
<!--                                    </div>-->
<!--                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dash-tab-links">
                <div class="container">
                    <div class="dash-discussions mb-20 bpm-50">
                        <div id="content-wrapper">
                            <div class="container-fluid pb-0">
                                <div class="row">
                                    <div class="col-lg-3 msg col-sm-12">
                                        <div class="rightbox">
                                            <div class="rightside">
                                                <h5 style="margin:10px;">Çevrimiçi Olanlar</h5>
                                            </div>
                                            <div class="msg-scroll">
                                                <div v-if="users">
                                                    <div class="rightmsg" v-for="ou in users">
                                                        <div class="message-radius">
                                                            <img src="/images/online.png"
                                                                 style="width:16px;height:auto;"
                                                                 alt="" title="">
                                                        </div>
                                                        <div class="message-heading">
                                                            <router-link
                                                                :to="{ name : 'profile' , params: { url: ou.user.slug } }">
                                                                <h4>{{ ou.user.name }}</h4></router-link>
                                                        </div>
                                                        <div class="message-heading1">
                                                            <span>yaş {{ ageFunc(ou.user.borndate)}}, izmir</span>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-12 col-sm-12">
                                        <div class="main-conversation-box">
                                            <div class="messages-line  _mCS_1">
                                                <div id="mCSB_1" class="mCS-light mCSB_vertical mCSB_inside"
                                                     tabindex="0" style="max-height: none;">
                                                    <div id="mCSB_1_container" class="mCSB_container"
                                                         style="position: relative; top: 0px; left: 0px;" dir="ltr">
                                                        <div class="main-message-box">
                                                            <div class="messg-usr-img">
                                                                <a href="#"><img src="/images/messages/1_chat.jpg"
                                                                                 alt=""
                                                                                 class="mCS_img_loaded"></a>
                                                            </div>
                                                        </div>
                                                        <div v-for="m in messages" class="main-message-box"
                                                             :class="{ 'st3' : m.user_id !== user.id , ' ta-right' : m.user_id === user.id }">
                                                            <div class="message-dt"
                                                                 :class="{ 'st3' : m.user_id !== user.id}">
                                                                <div class="message-inner-dt">
                                                                    <p> {{ m.name }} : {{ m.message}}</p>
                                                                </div>
                                                                <span>
                                                                        <timeago :datetime="m.created_at"
                                                                                 :auto-update="60"></timeago></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="message-send-area">
                                                <form @submit.prevent="onSubmit">
                                                    <div class="mf-field">
                                                        <input type="text" name="message" v-model="message.text"
                                                               id="message"
                                                               placeholder="mesajını yaz">
                                                        <button type="submit">Gönder</button>
                                                    </div>
                                                </form>
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

    export default {
        name: "room", props: ["user"], data ()
        {
            return {
                room: null, message: {}, messages: [], users: [], count : 0
            }
        }, mounted ()
        {
            this.init();
        }, sockets: {
            chat_login (data)
            {
                console.log("chata giriş var");
                this.users = data;
            }, chat (data)
            {
                if (this.room.id === data.room_id)
                {
                    this.messages.push(data);
                    $(function () {
                        var wtf = $('.messages-line');
                        var height = wtf[ 0 ].scrollHeight;
                        wtf.scrollTop(height);
                    });
                }
            }
        }, methods: {
            init ()
            {
                var data = {
                    slug: this.$route.params.url
                };
                this.users = [];
                window.axios.post("/chat/room/init", data).then((res) => {
                    this.room = res.data.room;
                    this.messages = res.data.messages;
                    this.count = res.data.count;
                    this.$socket.client.emit("chat_login");
                    $(function () {
                        var wtf = $('.messages-line');
                        var height = wtf[ 0 ].scrollHeight;
                        wtf.scrollTop(height);
                    });

                }).catch((err) => {
                    console.log("hata oluştu");
                });

            }, onSubmit ()
            {
                var data = {
                    user_id: this.user.id, room_id: this.room.id, text: this.message.text
                };
                window.axios.post("/chat/room/message", data).then((res) => {
                    console.log(res.data);
                    this.$socket.client.emit('new_msg', {
                        room_id: this.room.id,
                        message: this.message.text,
                        user_id: this.user.id,
                        slug: this.user.slug,
                        created_at: res.data,
                        name: this.user.name
                    });
                    $('#message').val('');
                    this.message.text = null;
                }).catch((err) => {
                });
            }, ageFunc (borndate)
            {
                var tarih = new Date();
                var yil = tarih.getFullYear();
                var year = borndate.substring(0, 4);
                return yil - year;
            }
        },
    }
</script>

<style scoped>
    .room-image {
        float: left;
        width: 200px;
        margin-right: 10px;

    }

    .st3 { float: left;}

    .message-inner-dt p {margin-bottom: 0}
</style>
