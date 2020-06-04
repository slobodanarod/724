<template>
    <div>
        <nprogress-container></nprogress-container>
        <nav-bar :user="user" :lang="lang"></nav-bar>
        <router-view :user="user" :lang="lang"></router-view>
        <footer-div :lang="lang"></footer-div>
    </div>
</template>
<script>
    import NavBar from './components/Navbar'
    import Footer from "./components/Footer";
    import io from "socket.io-client";
    import NprogressContainer from 'vue-nprogress/src/NprogressContainer'

    export default {
        name: "app", components: {
            NprogressContainer, NavBar, "footer-div": Footer
        }, data ()
        {
            return {
                user: {}, lang: ""
            }
        }, created ()
        {
            this.init();
        }, mounted ()
        {
            this.socket = io("http://localhost:3000");
            this.socket.on('chat_leave', function (data) {
                console.log("chat leave çalıştı");
                window.axios.post("/chat/room/leave", data).then((res) => {
                });
            });
        }, computed: {
            activeUser ()
            {
                return this.$store.getters.activeUser;
            }
        }, methods: {
            init ()
            {

                if (localStorage.getItem("lang"))
                {
                    this.lang = localStorage.getItem("lang");
                }
                else
                {
                    var userLang = navigator.language || navigator.userLanguage;
                    if (userLang !== "tr-TR")
                    {
                        localStorage.setItem("lang", "en");
                        this.lang = "en";
                    }
                    else
                    {
                        localStorage.setItem("lang", "tr");
                        this.lang = "tr";
                    }
                }
                if (localStorage.getItem("token"))
                {
                    var data = {
                        token: localStorage.getItem("token")
                    };
                    window.axios.post('/user/init', data).then((res) => {
                        if (res.data.status)
                        {
                            this.user = res.data.user;
                            this.$store.dispatch("initAuth");
                            console.log("app init");
                            if (this.user)
                            {
                                this.$socket.client.emit('login', {user: res.data.user});
                            }
                        }
                        else
                        {
                            this.$store.dispatch("logout");
                        }
                    });
                }
                else
                {
                    this.$store.dispatch("logout");
                }
            }
        }
    }
</script>

<style>
    @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css);
    @import '/node_modules/nprogress/nprogress.css';

    .alt-link { color: black;}

    .alt-link-active { font-weight: bold; color: black;}

</style>
