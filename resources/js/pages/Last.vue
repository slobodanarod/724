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
                                            <h1 class="text-center" v-if="lang === 'tr'">Son Üyeler</h1>
                                            <h1 class="text-center" v-else>Last Users</h1>
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
                                                    <router-link :to="{ name : 'profile', params : { url : o.slug}}">
                                                        <div class="usr-pic">
                                                            <img :src="'/images/users/' + o.image " :alt="o.name">
                                                        </div>
                                                    </router-link>

                                                </div>
                                                <div class="user-main-details">
                                                    <h4>{{ o.name }}</h4>
                                                    <span> <timeago :datetime="o.created_at"  :auto-update="60"></timeago></span>
                                                </div>
                                                <ul class="follow-msg-dt">
                                                    <li>
                                                        <div class="msg-dt-sm">
                                                            <router-link
                                                                :to="{ name : 'profile', params : { url : o.slug}}">
                                                                <button class="msg-btn1">Mesaj At</button>
                                                            </router-link>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="follow-dt-sm">
                                                            <router-link
                                                                :to="{ name : 'profile', params : { url : o.slug}}">
                                                                <button class="follow-btn1">Takip Et</button>
                                                            </router-link>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="profile-link">
                                                    <router-link :to="{ name : 'profile', params : { url : o.slug}}">
                                                        Profili Görüntüle
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <p style="text-align: center;width:100%;" v-if="lang === 'tr'">Bir hata oluştu.</p>
                                    <p style="text-align: center;width:100%;" v-else>Error. Please try again.</p>
                                </div>
                                <div class="container">
                                    <paginate :meta="meta" v-on:pageChange="get"></paginate>
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
    import Paginate from "../components/Paginate";

    export default {
        name: "last", props: ["lang"], components: {Paginate}, data ()
        {
            return {
                users: [], meta: {}
            }
        }, mounted ()
        {
            this.get();
            if (!localStorage.getItem("token"))
            {

                this.$router.push({name: "login"})
            }
        }, methods: {
            get (page = 1)
            {
                var data = {
                    status: true
                };
                window.axios.post("/get/last-users?page=" + page, data).then((res) => {
                    this.users = res.data.data;
                    this.meta = {
                        current_page: res.data.current_page,
                        from: res.data.from,
                        last_page: res.data.last_page,
                        last_page_url: res.data.last_page_url,
                        next_page_url: res.data.next_page_url,
                        path: res.data.path,
                        per_page: res.data.per_page,
                        prev_page_url: res.data.prev_page_url,
                        to: res.data.to,
                        total: res.data.total,
                    };
                    $("html, body").animate({scrollTop: 0}, "slow");
                });
            }
        }
    }
</script>
<style scoped>
</style>
