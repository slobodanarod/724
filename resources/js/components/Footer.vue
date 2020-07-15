<template>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="footer-left">
                            <ul v-if="lang === 'tr'">
                                <li><router-link to="/privacy">Üyelik Koşulları</router-link></li>
                                <li><router-link to="/about">Hakkımızda</router-link></li>
                                <li><router-link to="/use-of-cookie">Çerez Kullanımı</router-link></li>
                                <li><router-link to="/security">Güvenlik</router-link></li>
                                <li><router-link to="/blog">Blog</router-link></li>
                                <li><router-link to="/contact">İletişim</router-link></li>
                            </ul>
                            <ul v-else>
                                <li><router-link to="/privacy">Privacy Policy</router-link></li>
                                <li><router-link to="/about">About Us</router-link></li>
                                <li><router-link to="/use-of-cookie">Use Of Cookie</router-link></li>
                                <li><router-link to="/security">Security</router-link></li>
                                <li><router-link to="/contact">Contact</router-link></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="footer-right">
                            <ul class="copyright-text">
                                <li><router-link to="/"><img src="/front/images/logo-2.png" alt=""></router-link></li>
                                <li>
                                    <div class="ftr-1"><i class="far fa-copyright"></i> 2020 724chat by <a
                                        href="http://www.izmirdewebsite.com" target="_blank">izmirde website</a>. Tüm hakları saklıdır.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
</template>

<script>
	export default {
	    props : ["lang"],
		name: "Footer"
	}
</script>

<style scoped>

</style>
