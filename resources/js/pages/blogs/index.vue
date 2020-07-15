<template>
    <div>
        <div class="title-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="title-bar-text">
                            <li class="breadcrumb-item"><router-link to="/">Anasayfa</router-link></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <main class="categories-mp">
            <div class="main-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6" v-for="blog in blogs">
                            <div class="our-blogs">
                                <div class="blog-img">
                                    <router-link :to="{ name : 'blog' , params: { url: blog.sef_link } }">
                                        <img :src=" '/images/blogs/' + blog.image " alt="">
                                    </router-link>
                                </div>
                                <div class="blog-item1">
                                    <router-link tag="h4" :to="{ name : 'blog' , params: { url: blog.sef_link } }">
                                        {{ blog.title }}
                                    </router-link>
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
        name: "index", methods: {}, mounted ()
        {
            this.$store.dispatch("Blogs");
        }, computed: {
            blogs ()
            {
                return this.$store.getters.getBLogs;
            }
        }
    }
</script>

<style scoped>

</style>
