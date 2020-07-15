<template>
    <div>
        <main v-if="user">
            <div class="main-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-5">
                            <div class="main-left-sidebar">
                                <div class="user-data full-width">
                                    <div class="user-profile">
                                        <div class="username-dt dpbg-1">
                                            <div class="usr-pic">
                                                <img :src=" '/images/users/' + user.image " :alt="user.name">
                                            </div>
                                        </div>
                                        <div class="user-main-details" style="padding: 70px 0 10px 0;">
                                            <h4>{{ user.name }}</h4>
                                        </div>

                                    </div>
                                </div>

                                <div class="user-data full-width">

                                    <div class="categories-items" v-if="lang === 'tr'">
                                        <router-link class="category-item" to="/actions/viewer/in"><i class="fas fa-bullhorn"></i>Profilini  Gezenler </router-link>
                                        <router-link class="category-item" to="/actions/smiles/in"><i class="fas fa-flag"></i> Gülümsemeler  </router-link>
                                        <router-link class="category-item" to="/settings"><i class="fas fa-pen-nib"></i>Resmini Güncelle </router-link>
                                        <router-link class="category-item" to="/change/password"><i class="fas fa-key"></i>Şifreni Değiştir</router-link>
                                    </div>

                                    <div class="categories-items" v-else>
                                        <router-link class="category-item" to="/actions/viewer/in"><i class="fas fa-bullhorn"></i>Viewing Your Profile </router-link>
                                        <router-link class="category-item" to="/actions/smiles/in"><i class="fas fa-flag"></i> Smiles  </router-link>
                                        <router-link class="category-item" to="/settings"><i class="fas fa-pen-nib"></i>Update Your Profile Photo </router-link>
                                        <router-link class="category-item" to="/change/password"><i class="fas fa-key"></i>Change Your Password</router-link>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-7">
                            <div class="main-posts">
                                <div class="add-activity">
                                    <form @submit.prevent="onSubmit">
                                        <div class="activity-group" v-if="lang === 'tr'">
                                            <textarea class="add-activity-des" v-model="post.content"
                                                      placeholder="Şu an ne düşünüyorsun ?"></textarea>
                                        </div>
                                        <div class="activity-group" v-else>
                                            <textarea class="add-activity-des" v-model="post.content"
                                                      placeholder="What you think ?"></textarea>
                                        </div>
                                        <div class="activity-button" v-if="lang === 'tr'">
                                            <button class="act-btn-post" type="submit">Gönder</button>
                                        </div>
                                        <div class="activity-button" v-else>
                                            <button class="act-btn-post" type="submit">Send</button>
                                        </div>
                                    </form>
                                </div>
                                <div v-for="p in posts">

                                    <div class="activity-posts" v-if="p.type === 1 ">
                                        <div class="activity-group1">
                                            <div class="main-user-dts1">
                                                <router-link :to="{ name : 'profile' , params: { url: p.slug } }"><img :src="'/images/users/'+p.image" :alt="p.name"></router-link>
                                                <div class="user-text3">
                                                    <router-link :to="{ name : 'profile' , params: { url: p.slug } }"><h4>{{ p.name }}</h4></router-link>
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

                                        <div class="activity-descp">
                                            <p></p>
                                        </div>

                                    </div>

                                </div>

                                <div class="main-loader mb-50" v-if="lang === 'tr'">
                                    <button id="load-more" @click="getPosts(page+1)"> Daha Fazla Yükle</button>
                                </div>
                                <div class="main-loader mb-50" v-else>
                                    <button id="load-more" @click="getPosts(page+1)"> Load More</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="right-side-items">
                                <div style="margin-bottom:10px;" class="explore-events">
                                    <img src="https://via.placeholder.com/250x250">
                                </div>
                                <div class="post-event" v-if="lang === 'tr'">
                                    <h6>Sen de sohbete katıl!</h6>
                                    <p> Canlı sohbet odalarına girerek sen de sohbete katıl! Herkese uygun sohbet
                                        odaları </p>
                                    <router-link to="/chat-rooms" class="add-nw-event">Sohbete Katıl</router-link>
                                </div>
                                <div class="post-event" v-else>
                                    <h6>Join the chat!</h6>
                                    <p> Canlı sohbet odalarına girerek sen de sohbete katıl! Herkese uygun sohbet
                                        odaları İNG </p>
                                    <router-link to="/chat-rooms" class="add-nw-event">Sohbete Katıl</router-link>
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
        name: "dashboard", props: ['user', 'lang'], data ()
        {
            return {
                post: {}, posts: []
            }
        }, created ()
        {

        }, mounted ()
        {
            this.getPosts(1);
        }, methods: {
            onSubmit ()
            {
                var data = {
                    user_id: this.user.id, post_content: this.post.content
                };
                window.axios.post("/post/send", data).then((res) => {
                    this.post = {};
                    this.getPosts(1);
                })
            }, getPosts (page = 1)
            {
                var data = {
                    user_id: 0,
                };
                window.axios.post("/post/get?page=" + page, data).then((res) => {
                    if (page === 1)
                    {
                        this.posts = res.data.data;
                    }
                    else
                    {
                        for (var index = 0; index < res.data.data.length; ++index)
                        {
                            this.posts.push(res.data.data[ index ]);
                        }
                    }
                    this.page = res.data.current_page;
                })
            }
        }
    }
</script>

<style scoped>

    #load-more {
        width: 100%;
        background: #ec5569;
        padding: 4px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border: 0;
    }

</style>
