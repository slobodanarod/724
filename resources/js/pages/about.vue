<template>
    <main class="discussion-mp">
        <div class="main-section">
            <div class="about-us">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12" v-if="lang === 'tr'">
                            <div class="checkout-heading text-center">
                                <h2>{{ info.name }}</h2>
                            </div>
                            <div class="about-text" v-html="info.content">  </div>
                        </div>
                        <div class="col-lg-12 col-md-12" v-else>
                            <div class="checkout-heading text-center">
                                <h2>{{ info.name_en }}</h2>
                            </div>
                            <div class="about-text" v-html="info.content_en"> </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </main>
</template>

<script>
	export default {
		name: "about",
        props : ["lang"],
        data(){
		    return {
                info : {}
            }
        },
        mounted () {
		    this.get();
        },
        methods:{
		    get()
            {
                var data = {
                    page_id : 1
                }
                window.axios.post("/get/page",data).then((res) => {
                    this.info = res.data;
                })
            }
        }
	}
</script>

<style scoped>

</style>
