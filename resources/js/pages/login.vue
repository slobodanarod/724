<template>
    <div>
        <main class="register-mp">
            <div class="main-section">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-10">
                            <div class="login-register-bg">
                                <div class="row no-gutters">
                                    <div class="col-lg-6">
                                        <div class="lg-left">
                                            <div class="lg-logo">
                                                <router-link to="/"><img src="/front/images/logo.png" alt="Sohbet">
                                                </router-link>
                                            </div>
                                            <div class="lr-text">
                                                <h2>Üyelik tamamen ücretsiz!</h2>
                                                <p>Senden kesinlikle para talebi etmiyoruz. Tamamen ücretsiz.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="lr-right">
                                            <h4>Giriş Yap</h4>
                                            <div class="login-register-form">
                                                <div class="alert alert-danger" v-if="alerts.length > 0">
                                                    <span style="color:black" v-for="alert in alerts">{{ alert }}</span>
                                                </div>
                                                <form @submit.prevent="onSubmit">
                                                    <div class="form-group">
                                                        <input v-model="user.email" class="title-discussion-input"
                                                               type="email" placeholder="E-Posta Adresin" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input v-model="user.password" class="title-discussion-input"
                                                               type="password" placeholder="Şifren" required>
                                                    </div>
                                                    <button class="login-btn" type="submit">Giriş Yap</button>
                                                    <div class="login-link">Üye değil misin ?
                                                        <router-link to="/register">Hemen Ücretsiz Üye Ol</router-link>
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
        name: "login", data ()
        {
            return {
                user: {}, alerts: []
            }
        }, methods: {
            onSubmit ()
            {
                this.alerts = [];
                if (this.user.name === null)
                {
                    this.alerts.push("Kullanıcı adı boş bırakılamaz.");
                }
                if (this.user.password === null)
                {
                    this.alerts.push("Şifre boş bırakılamaz.");
                }
                else
                {
                         window.axios.post("/user/login", this.user).then((res) => {
                             this.$store.dispatch("login",res.data.token);
                             document.location.href = "/dashboard";
                             return true;
                    }).catch(err => {
                        this.alerts = err.response.data;
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>
