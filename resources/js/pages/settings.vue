<template>
    <div>
        <main class="dashboard-mp">
            <div class="dash-tab-links">
                <div class="container">
                    <div class="setting-page mb-20">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="setting-form">
                                    <div class="alert alert-success text-center" v-if="lang === 'tr'">
                                        Aşağıdaki bilgileri girerek daha fazla kişinin sana erişmesini sağlayabilirsin.
                                    </div>
                                    <div class="alert alert-success text-center" v-else>
                                        You can provide more people to access you by entering the information below.
                                    </div>

                                        <div class="user-data full-width">
                                            <div class="about-left-heading" v-if="lang === 'tr'">
                                                <h3>Profil Resmi <small>Profil resmi girmek zorunlu değildir.</small></h3>
                                            </div>
                                            <div class="about-left-heading" v-else>
                                                <h3>Profile Photo <small>Profile photo is not required.</small></h3>
                                            </div>
                                            <div class="prsnl-info">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <span v-if="lang=== 'tr'">Şuan ki profil resmin</span>
                                                            <span v-else>Your profile photo</span>
                                                            <div class="setting-dp">
                                                                <img :src="'/images/users/' + user.image" alt="">
                                                            </div>
                                                            <div class="setting-upload">
                                                                <div class="addpic" id="OpenImgUpload1">
                                                                    <form enctype="multipart/form-data">
                                                                    <input type="file" id="file1" class="form-control" v-on:change="onImageChange">
                                                                        <label for="file1" v-if="lang === 'tr'">Resim Seç</label>
                                                                        <label for="file1" v-else>Select Photo</label>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <form @submit.prevent="onSubmit">
                                        <div class="user-data full-width">
                                            <div class="about-left-heading">
                                                <h3>Profil Yazısı *</h3>
                                            </div>
                                            <div class="prsnl-info">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Profil Yazısı seni çok iyi tanıtmalı *</label>
                                                            <textarea class="replt-comnt" v-model="user.description"
                                                                      placeholder="profil yazını buraya girmelisin">{{ user.description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-data full-width">
                                            <div class="about-left-heading">
                                                <h3>Profil Bilgilerin</h3>
                                            </div>
                                            <div class="prsnl-info">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label>Kullanıcı adı *</label>
                                                            <input class="payment-input" type="text" :value="user.name" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label>E-Posta Adresi*</label>
                                                            <input class="payment-input" type="email" disabled :value="user.email">
                                                        </div>

                                                    </div>

                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label>Cinsiyet *</label>
                                                            <select class="form-control" v-model="user.gender" disabled>
                                                                <option value="1">Erkek</option>
                                                                <option value="2">Kadın</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label>Şehir *</label>
                                                            <select class="form-control" v-model="user.city" >
                                                                <option value="0" selected disabled>Ülke Seç </option>
                                                                <option v-for="c in countries" :value="c.id_country">{{ c.country_name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Doğum Tarihi *</label>
                                                            <input class="form-control" v-model="user.borndate"
                                                                   type="date"
                                                                   placeholder="08/29/1991">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-crdt-amnt">

                                            <button class="setting-save-btn" type="submit">Kaydet</button>
                                            <div class="alert alert-success" style="margin-top:10px" v-if="alert">
                                                <span style="color:black">{{ alert }}</span>
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
    </div>
</template>

<script>
	export default {
		name: "settings", props : ["user","lang"],
        data()
        {
        	return {
                alert : null,
                image : null,
                countries : []
            }
        },
        mounted () {
            window.axios.get("/countries").then((res) => {
                this.countries = res.data;
            });
        },
        methods:
        {
        	onSubmit()
            {
            	window.axios.post("/user/settings/update", this.user).then((res) => {
                        this.alert = "Başarıyla güncellendi";
                }).catch((err) => {

                });
            },
			onImageChange (e)
			{
				this.image = e.target.files[ 0 ];
				e.preventDefault();
				let currentObj = this;
				const config = {
					headers: {'content-type': 'multipart/form-data'}
				};
				let formData = new FormData();
				formData.append('image', this.image);
				axios.post('/user/imageUpload', formData, config)
					.then((response) => {
					    this.u.image = response.data;
					})
					.catch(function (error) {
						currentObj.output = error;
					});
			}
        }
	}
</script>

<style scoped>

</style>
