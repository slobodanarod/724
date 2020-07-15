<template>
    <div>
        <main role="main">

            <div class="container marketing">

                <div class="row">
                    <div class="col-lg-4 text-center">
                        <img class="rounded-circle"
                             src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             alt="Generic placeholder image" width="140" height="140">
                        <h2>Tamamen Ücretsiz</h2>
                        <p>724 Chat, tamamen ücretsizdir. Mesajlaşma hakkı gibi özellikler de ücretsizdir.Kesinlikle para ödemezsiniz.</p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img class="rounded-circle"
                             src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             alt="Generic placeholder image" width="140" height="140">
                        <h2>Sohbet Odaları</h2>
                        <p>724 Chat içerisinde bulunan sohbet odalarında kullanıcılar ile birlikte toplu şekilde canlı sohbet edebilirsiniz. Unutmayın, aykırı mesaj atanların mesajları silinir ve üyelikleri iptal edilir. Telefon numarası vermek yasaktır.</p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img class="rounded-circle"
                             src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             alt="Generic placeholder image" width="140" height="140">
                        <h2>Özel Mesajlaşma</h2>
                        <p>İstediğiniz üyeye özel mesaj atarak sohbet edebilirsiniz. Özel mesajlar üzerinden size gelen mesajlarda istenmedik kelimeler bulunursa şikayet edebilirsiniz. Şikayetiniz dikkate alınarak mesaj atan üyeye yaptırım uygulanabilir.</p>
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">724 Chat sayesinde <span class="text-muted"> tanışıp evlenenler.</span>
                        </h2>
                        <p class="lead">Yıllardır aradığınız ilişki hemen yanınızda olabilir. 724 Chat ile kendinize uygun birleşmeler yaparak bir çok insan gibi siz de evlenebilirsiniz.</p>
                    </div>
                    <div class="col-md-5">
                        <img class="featurette-image img-fluid mx-auto img-thumbnail" src="/images/marriage.png" alt="Evlilik Sitesi">
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">724 Chat sayesinde <span class="text-muted"> sıkı dost olanlar.</span>
                        </h2>
                        <p class="lead">Bir insana güvenmek için eş dost olmanıza gerek yok chat programlarında güzel bir sıkı dost içini döküp güzel vakit geçirebilirsiniz..</p>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <img class="featurette-image img-fluid mx-auto img-thumbnail" src="/images/friends.png" alt="Arkadaşlık Sitesi">
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">247 Chat sayesinde <span class="text-muted">dertlerine ortak bulanlar.</span>
                        </h2>
                        <p class="lead">Bir derdiniz mi var en yakınınızdaki arkadaslarınıza veya ailenize anlatmıyorsunuz fakat içinizi dökmek dertlerinize derman olacak bu chat programları ile güzel hoş zaman geçirebilirsiniz
                        </p>
                    </div>
                    <div class="col-md-5">
                        <img class="featurette-image img-fluid mx-auto img-thumbnail" src="/images/best.png" alt="dostluk sitesi">
                    </div>
                </div>

                <hr class="featurette-divider">
            </div>

        </main>

    </div>
</template>

<script>
    export default {
        name: "home", props: ["user"], created ()
        {

        },
        mounted () {
            if(localStorage.getItem("token"))
            {
                this.$router.push({ name : "dashboard"})
            }
        }
    }
</script>

<style scoped>

    @import url("http://sosyal.test/public/front/css/carousel.css");

</style>
