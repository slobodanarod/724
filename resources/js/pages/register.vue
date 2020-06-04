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
                                                <router-link to="/"><img src="/front/images/logo.png" alt="Sohbet"></router-link>
                                            </div>
                                            <div class="lr-text">
                                                <div v-if="lang === 'tr'">
                                                <h2>Üyelik tamamen ücretsiz!</h2>
                                                <p>Senden kesinlikle para talebi etmiyoruz. Tamamen ücretsiz.</p>
                                                </div>
                                                <div v-else>
                                                    <h2>İt's free!</h2>
                                                    <p>İngilizce.</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="lr-right">
                                            <h4 v-if="lang === 'tr'">Şimdi Ücretsiz Üye Ol</h4>
                                            <h4 v-else>Now Be Member</h4>
                                            <div class="login-register-form">
                                                <div class="alert alert-danger" v-if="alerts.length > 0">
                                                    <span style="color:black" v-for="alert in alerts">{{ alert }}</span>
                                                </div>
                                                <form @submit.prevent="onSubmit" v-if="lang=== 'tr'">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group" >
                                                                <input v-model="user.name"
                                                                       class="title-discussion-input"
                                                                       type="text" placeholder="Kullanıcı Adın"
                                                                       required>
                                                            </div>

                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input v-model="user.email"
                                                                       class="title-discussion-input"
                                                                       type="email" placeholder="E-Posta Adresin"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input v-model="user.password"
                                                                       class="title-discussion-input"
                                                                       type="password" placeholder="Şifren" required>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input v-model="user.password_confirmation"
                                                                       class="title-discussion-input" type="password"
                                                                       placeholder="Şifre Tekrar" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <select class="form-control" v-model="user.gender">
                                                                    <option selected value="1">Erkek</option>
                                                                    <option value="2">Kadın</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <select class="form-control" v-model="user.city">
                                                                    <option value="0" selected disabled>Şehir Seçin
                                                                    </option>
                                                                    <option value="1">İzmir</option>
                                                                    <option value="2">İstanbul</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="float-left">Doğum Tarihi</label>
                                                                <input v-model="user.borndate"
                                                                       class="form-control"
                                                                       type="date" placeholder=""
                                                                       required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="rgstr-dt-txt">
                                                        Üye olarak <a href="#">Kuralları</a>, <a href="#">Üyelik
                                                        Politikasını</a> ve <a href="#">Çerez Politikasını</a> kabul
                                                        ediyorum.
                                                    </div>
                                                    <button class="login-btn" type="submit">Kaydı Tamamla</button>
                                                    <div class="login-link">Zaten üyeliğin var mı?
                                                        <router-link to="/login">Giriş Yap</router-link>
                                                    </div>
                                                </form>
                                                <form @submit.prevent="onSubmit" v-else>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group" >
                                                                <input v-model="user.name"
                                                                       class="title-discussion-input"
                                                                       type="text" placeholder="Username"
                                                                       required>
                                                            </div>

                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input v-model="user.email"
                                                                       class="title-discussion-input"
                                                                       type="email" placeholder="E-mail"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input v-model="user.password"
                                                                       class="title-discussion-input"
                                                                       type="password" placeholder="Password" required>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input v-model="user.password_confirmation"
                                                                       class="title-discussion-input" type="password"
                                                                       placeholder="Password Again" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <select class="form-control" v-model="user.gender">
                                                                    <option selected value="1">Man</option>
                                                                    <option value="2">Woman</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <select class="form-control" v-model="user.city">
                                                                    <option value="0" selected disabled>Select City
                                                                    </option>
                                                                    <option value="1">İzmir</option>
                                                                    <option value="2">İstanbul</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="float-left">Birthday</label>
                                                                <input v-model="user.borndate"
                                                                       class="form-control"
                                                                       type="date" placeholder=""
                                                                       required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="rgstr-dt-txt">
                                                        Üye olarak <a href="#">Kuralları</a>, <a href="#">Üyelik
                                                        Politikasını</a> ve <a href="#">Çerez Politikasını</a> kabul
                                                        ediyorum.
                                                    </div>
                                                    <button class="login-btn" type="submit">Kaydı Tamamla</button>
                                                    <div class="login-link">I have a account
                                                        <router-link to="/login">Login</router-link>
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
		name: "Register",
        props : ["lang"],
        data ()
		{
			return {
				user: {
					city: 0, gender: 1
				}, alerts: []
			}
		}, methods: {
			onSubmit ()
			{
				this.alerts = [];
				if (this.user.name === null)
				{
					this.alerts.push("Kullanıcı adı boş bırakılamaz.");
				}
				else
					if (this.user.password !== this.user.password_confirmation)
					{
						this.alerts.push("Şifreler eşleşmiyor.");
					}
					else
					{
						window.axios.post("/user/register", this.user).then((res) => {
                            this.$store.dispatch("login",res.data.token);
                            document.location.href = "/settings";
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
