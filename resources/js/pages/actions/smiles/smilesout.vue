<template>
    <main class="dashboard-mp">
        <div class="dash-tab-links">
            <div class="container">
                <div class="dash-discussions mb20">
                    <div class="main-section">
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-12 col-md-12">
                                    <div class="search-bar-main">
                                        <div class="button-group">
                                            <router-link to="/actions/viewer/in" class="btn btn-info col-md-6"
                                                         style="float:left">Gezenler
                                            </router-link>
                                            <router-link to="/actions/smiles/in" class="btn btn-info col-md-6 active">
                                                Gülümsemeler
                                            </router-link>

                                        </div>
                                        <div style="margin:10px 0;">
                                            <router-link to="/actions/smiles/in" class="alt-link">Gülümseyenler
                                            </router-link>
                                            |
                                            <router-link to="/actions/smiles/out" class="alt-link-active">
                                                Gülümsediklerim
                                            </router-link>
                                            <span style="float: right;cursor: pointer;"
                                                  @click="deleteAll()">Tümünü Sil</span>
                                        </div>
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

                                                <span> <timeago :datetime="o.olusturulma_tarihi"
                                                                :auto-update="60"></timeago></span>

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
                                                <router-link :to="{ name : 'profile', params : { url : o.slug}}">Profili
                                                    Görüntüle
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <paginate :meta="meta" v-on:pageChange="get"></paginate>
                                </div>
                            </div>
                            <div class="row text-center" v-else>
                                <div class="col-lg-12 col-md-12">
                                    <p>Henüz kimseye gülümsemedin</p>
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
    import Paginate from "../../../components/Paginate";

    export default {
        name: "out", components: {Paginate}, data ()
        {
            return {
                users: [], meta: []
            }
        }, mounted ()
        {
            this.get();
        }, methods: {
            get (page = 1)
            {
                var data = {
                    sohbet: "tam zamanı"
                };

                window.axios.post("/actions/smiles/out?page=" + page, data).then((res) => {
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
                }).catch((err) => {

                });
            }
        }
    }
</script>

<style scoped>

</style>
