<template>
    <div>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-dark1 justify-content-sm-start">
                            <router-link class="order-1 order-lg-0 ml-lg-0 ml-3 mr-auto" to="/"><img
                                src="/front/images/logo.png" alt=""></router-link>
                            <button class="navbar-toggler align-self-start" type="button">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu"
                                id="navbarSupportedContent">
                                <ul class="navbar-nav align-self-stretch" v-if="lang === 'tr'">
                                    <li class="nav-item active">
                                        <router-link class="nav-link" to="/">Ana Sayfa <span
                                            class="sr-only">(current)</span></router-link>
                                    </li>
                                    <li class="nav-item"><router-link class="nav-link" to="/onlines">Çevrimiçi Üyeler</router-link></li>

                                </ul>
                                <ul class="navbar-nav align-self-stretch" v-else>
                                    <li class="nav-item active">
                                        <router-link class="nav-link" to="/">Home <span
                                            class="sr-only">(current)</span></router-link>
                                    </li>
                                    <li class="nav-item"><router-link class="nav-link" to="/onlines">Online Members</router-link></li>

                                </ul>
                                <router-link to="/chat-rooms" class="add-event">Chat Rooms</router-link>
                            </div>

                            <ul class="group-icons">
                                <li><img @click="changelang('tr')" src="/images/turkey.png" alt="türkçe"> | <img @click="changelang('en')" src="/images/england.png" alt="english"></li>
                            </ul>

                            <ul class="group-icons" v-if="this.$store.getters.isAuthenticated">
                                <li><router-link to="/actions/smiles/in" class="icon-set"><i class="fas fa-smile"></i></router-link></li>
                                <li class="dropdown">
                                    <a href="#" class="icon-set dropdown-toggle-no-caret" role="button"
                                       data-toggle="dropdown">
                                        <i class="fas fa-user-plus"></i>
                                    </a>
                                    <div class="dropdown-menu user-request-dropdown dropdown-menu-right">
                                        <div class="user-request-list">
                                            <div class="request-users">
                                                <div class="user-request-dt">
                                                    <a href="#"><img src="images/user-dp-1.jpg" alt=""></a>
                                                    <a href="#" class="user-title">Jassica William</a>
                                                </div>
                                                <button class="accept-btn">Accept</button>
                                            </div>
                                        </div>
                                        <div class="user-request-list">
                                            <div class="request-users">
                                                <div class="user-request-dt">
                                                    <a href="#"><img src="images/user-dp-1.jpg" alt=""></a>
                                                    <a href="#" class="user-title">Rock Smith</a>
                                                </div>
                                                <button class="accept-btn">Accept</button>
                                            </div>
                                        </div>
                                        <div class="user-request-list">
                                            <div class="request-users">
                                                <div class="user-request-dt">
                                                    <a href="#"><img src="images/user-dp-1.jpg" alt=""></a>
                                                    <a href="#" class="user-title">Joy Doe</a>
                                                </div>
                                                <button class="accept-btn">Accept</button>
                                            </div>
                                        </div>
                                        <div class="user-request-list">
                                            <a href="my_dashboard_all_requests.html" class="view-all">View All Friend
                                                Requests</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <router-link to="/messages" class="icon-set dropdown-toggle-no-caret" role="button" >
                                        <i class="fas fa-envelope"></i>
                                    </router-link>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="icon-set dropdown-toggle-no-caret" role="button"
                                       data-toggle="dropdown">
                                        <i class="fas fa-bell"></i>
                                    </a>
                                    <div class="dropdown-menu notification-dropdown dropdown-menu-right">
                                        <div class="user-request-list">
                                            <div class="request-users">
                                                <div class="user-request-dt">
                                                    <a href="#"><img src="images/user-dp-1.jpg" alt="">
                                                        <div class="user-title1">Jassica William</div>
                                                        <span>comment on your video.</span>
                                                    </a>
                                                </div>
                                                <div class="time5">2 min ago</div>
                                            </div>
                                        </div>
                                        <div class="user-request-list">
                                            <div class="request-users">
                                                <div class="user-request-dt">
                                                    <a href="#"><img src="images/user-dp-1.jpg" alt="">
                                                        <div class="user-title1">Rock Smith</div>
                                                        <span>your order is accepted.</span>
                                                    </a>
                                                </div>
                                                <div class="time5">5 min ago</div>
                                            </div>
                                        </div>
                                        <div class="user-request-list">
                                            <div class="request-users">
                                                <div class="user-request-dt">
                                                    <a href="#"><img src="images/user-dp-1.jpg" alt="">
                                                        <div class="user-title1">Joy Doe</div>
                                                        <span>your bill slip sent on your email.</span>
                                                    </a>
                                                </div>
                                                <div class="time5">10 min ago</div>
                                            </div>
                                        </div>
                                        <div class="user-request-list">
                                            <a href="my_dashboard_all_notifications.html" class="view-all">View All
                                                Notifications</a>
                                        </div>
                                    </div>
                                </li>
                            </ul >

                            <div class="account order-1 dropdown" v-if="this.$store.getters.isAuthenticated">
                                <a href="#" class="account-link dropdown-toggle-no-caret" role="button"
                                   data-toggle="dropdown">
                                    <div class="user-dp"><img src="/images/dp.jpg" alt=""></div>
                                    <span>{{ user.name }}</span>
                                    <i class="fas fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu account-dropdown dropdown-menu-right" v-if="lang === 'tr'">
                                    <router-link class="link-item" to="/settings">Profil Bilgilerin</router-link>
                                    <router-link class="link-item" to="/messages">Mesajların</router-link>
                                    <router-link class="link-item" to="/actions/viewer/in">Profilini Gezenler</router-link>
                                    <span class="link-item" @click.prevent="logout">Çıkış Yap</span>
                                </div>

                                <div class="dropdown-menu account-dropdown dropdown-menu-right" v-else>
                                    <router-link class="link-item" to="/settings">Information Profile</router-link>
                                    <router-link class="link-item" to="/messages">Messages</router-link>
                                    <router-link class="link-item" to="/actions/viewer/in">Viewing Your Profile</router-link>
                                    <span class="link-item" @click.prevent="logout">Logout</span>
                                </div>
                            </div>

                            <div class="account order-1 dropdown" v-else>
                                <router-link to="/register" class="account-link dropdown-toggle-no-caret">
                                    <span v-if="lang === 'en'">Login</span>
                                    <span v-else> Giriş Yap </span>
                                </router-link>
                            </div>

                        </nav>
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
	export default {
		name: "NavBar", props: ["user", "lang"], data ()
		{
			return {}
		}, computed: {}, methods: {
            logout()
            {
                window.axios.get("/user/logout").then((res) => {
                    this.$store.dispatch("logout");
                });

            },
            changelang(lang)
            {
                localStorage.setItem("lang",lang);
                window.location = "/"
            }
        }
	}
</script>
<style scoped>

</style>
