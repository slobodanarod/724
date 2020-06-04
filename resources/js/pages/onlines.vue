<template>
    <div>

        <main class="dashboard-mp">

            <div class="dash-tab-links">
                <div class="container">
                    <div class="dash-discussions mb20">
                        <div class="main-section">
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="search-bar-main">
                                            <h1 class="text-center" v-if="lang === 'tr'">Çevrimiçi Üyeler</h1>
                                            <h1 class="text-center" v-else>Online Members</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="all-search-events">
                                <div class="row" v-if="users.length > 0">
                                    <div class="col-lg-3 col-md-6" v-for="o in users">
                                        <div class="user-data full-width">
                                            <div class="user-profile">
                                                <div class="userbg-dt dpbg-1">
                                                    <router-link
                                                        :to="{ name : 'profile', params : { url : o.user.slug}}">
                                                        <div class="usr-pic">
                                                            <img :src="'/images/users/' + o.user.image "
                                                                 :alt="o.user.name">
                                                        </div>
                                                    </router-link>
                                                </div>
                                                <div class="user-main-details">
                                                    <h4>{{ o.user.name }}</h4>
                                                </div>
                                                <ul class="follow-msg-dt">
                                                    <li>
                                                        <div class="msg-dt-sm">
                                                            <router-link
                                                                :to="{ name : 'profile', params : { url : o.user.slug}}">
                                                                <button class="msg-btn1">Mesaj At</button>
                                                            </router-link>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="follow-dt-sm">
                                                            <router-link
                                                                :to="{ name : 'profile', params : { url : o.user.slug}}">
                                                                <button class="follow-btn1">Takip Et</button>
                                                            </router-link>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="profile-link">
                                                    <router-link
                                                        :to="{ name : 'profile', params : { url : o.user.slug}}">Profili
                                                        Görüntüle
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                <p style="text-align: center;width:100%;" v-if="lang === 'tr'">Şu an senden başka çevrimiçi üye bulunmuyor.</p>
                                <p style="text-align: center;width:100%;" v-else>There are no other online members at the moment.</p>
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
        name: "onlines", props : ["lang"], data ()
        {
            return {
                users: []
            }
        }, sockets: {
            GetOnlines (data)
            {
                this.users = data;
            }
        }, mounted ()
        {

            if(!localStorage.getItem("token"))
            {

                this.$router.push({ name : "login"})
            }
            this.$socket.client.emit("GetOnlines");
        }
    }
</script>

<style scoped>

</style>
