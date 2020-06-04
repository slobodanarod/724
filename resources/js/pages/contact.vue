<template>
    <main class="contact-mp">
        <div class="main-section">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="contact-heading text-center" v-if="lang === 'tr'">
                            <h2>Bizimle iletişime geç</h2>
                            <p>Bir sorun veya problemin varsa bizimle iletişime geç..</p>
                        </div>
                        <div class="contact-heading text-center" v-else>
                            <h2>Get In Touch With Our Team of Experts</h2>
                            <p>Do you have any question? Our experts will be happy to help.</p>
                        </div>
                        <div class="contact-form" v-if="lang === 'tr'">
                            <form @submit.prevent="onSubmit">
                                <div class="form-group">
                                    <input class="title-discussion-input" v-model="contact.name" type="text"
                                           placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input class="title-discussion-input" v-model="contact.mail" type="email"
                                           placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <textarea class="replt-comnt" v-model="contact.message"
                                              placeholder="What are you looking for?"></textarea>
                                </div>
                                <button class="send-m-btn" type="submit">Send Message</button>
                            </form>
                        </div>
                        <div class="contact-form" v-else>
                            <form @submit.prevent="onSubmit">
                                <div class="form-group">
                                    <input class="title-discussion-input" v-model="contact.name" type="text"
                                           placeholder="Adın">
                                </div>
                                <div class="form-group">
                                    <input class="title-discussion-input" v-model="contact.mail" type="email"
                                           placeholder="E-posta adresin" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="replt-comnt" v-model="contact.message"
                                              placeholder="Sormak istediğin konuyu bize anlat"></textarea>
                                </div>
                                <button class="send-m-btn" type="submit">Mesajı Gönder</button>
                            </form>
                        </div>

                        <div v-if="alert" class="alert alert-success" style="margin-top:10px;">
                            {{ alert }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        name: "contact", props: ["lang"], data ()
        {
            return {
                contact: {}, alert: ""
            }
        }, methods: {
            onSubmit ()
            {
                var data = {
                    name: this.contact.name, mail: this.contact.mail, message: this.contact.message
                };
                window.axios.post("/contact/message", data).then((res) => {
                    this.alert = "";
                    if (this.lang === 'tr')
                    {
                        this.alert = "Mesajınız bize ulaştı. En kısa zamanda e-posta adresinize geri dönüş yapılacaktır.";
                    }
                    else
                    {
                        this.alert = "Thanks for message.";
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
