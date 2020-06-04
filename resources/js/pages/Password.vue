<template>
    <main class="dashboard-mp">
        <div class="dash-tab-links">
            <div class="container">

                <div class="setting-page mb-20">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="setting-form">
                                <form @submit.prevent="onSubmit">
                                    <div class="user-data full-width">
                                        <div class="about-left-heading">
                                            <h3>Şifreni Değiştir</h3>
                                        </div>
                                        <div class="prsnl-info">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label>Eski Şifren*</label>
                                                        <input class="payment-input" v-model="pass.old" type="Password"
                                                               placeholder="Eski şifreni gir">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Yeni Şifre*</label>
                                                        <input class="payment-input" v-model="pass.new" type="Password"
                                                               placeholder="Yeni şifreni gir">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Yeni Şifre Tekrar*</label>
                                                        <input class="payment-input" v-model="pass.new2" type="Password"
                                                               placeholder="Yeni şifreni tekrar gir">
                                                    </div>
                                                    <div class="form-group" v-if="alert !== null">
                                                        <div class="alert alert-danger">
                                                            <b>İşlem başarısız!</b>
                                                            {{ alert }}
                                                        </div>
                                                    </div>
                                                    <div class="add-profile-btn">
                                                        <button class="setting-save-btn" type="submit">Şifremi
                                                            değiştir
                                                        </button>
                                                        <small> Şifre değiştirme işleminden sonra lütfen tekrardan giriş
                                                            yapınız.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        name: "Password", data ()
        {
            return {
                pass: [], alert: null
            }
        }, methods: {
            onSubmit ()
            {
                this.alert = null;
                if (this.pass.new !== this.pass.new2)
                {
                    this.alert = "Şifreler birbiriyle uyuşmuyor."
                }
                else
                {
                    var data = {
                        old: this.pass.old,
                        new : this.pass.new
                    };
                    window.axios.post("/ch/password", data).then((res) => {
                        this.$store.dispatch('activeUser', null);
                        document.location.href = "/logout";
                    }).catch((err) => {
                        this.alert = err.response.data;
                    })
                }

            }
        }
    }
</script>

<style scoped>

</style>
