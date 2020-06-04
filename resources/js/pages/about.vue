<template>
    <main class="discussion-mp">
        <div class="main-section">
            <div class="about-us">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12" v-if="lang === 'tr'">
                            <div class="checkout-heading text-center">
                                <h2>Hakkımızda</h2>
                            </div>
                            <div class="about-text">
                                <p>Vivamus tortor nisl, lobortis in, faucibus et, tempus at, dui. Nunc risus. Proin scelerisque augue. Nam ullamcorper. Phasellus id massa. Pellentesque nisl. Pellentesque habitant tuni morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc augue. Aenean sed justo non leo vehicula laoreet. Praesent ipsum libero, auctor ac, tempus nec, casion tempor nec, justo cretusi sino zumbua iloseum musumfu lilokuta nabase uchiha itachi suctung from munual pracetamol testio soel curom ose testio soel lorem isutm pausm mintest osrit ucii</p>
                                <p>Maecenas ullamcorper, odio vel tempus egestas, dui orci faucibus orci, sit amet aliquet lectus dolor et quam. Pellentesque consequat luctus purus. Nunc et risus. Etiam a nibh tunil Phasellus dignissim metus eget nisi. Vestibulum sapien dolor, aliquet nec, porta ac, malesuada a, libero. Praesent feugiat purus eget est. Nulla facilisi. Vestibulum tincidunt sapiens eu velit. Mauris purus. Maecenas eget mauris eu orci accumsan feugiat. Pellentesque eget velit. Nunc tincidunt.</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12" v-else>
                            <div class="checkout-heading text-center">
                                <h2>About Us</h2>
                            </div>
                            <div class="about-text">
                                <p>Vivamus tortor nisl, lobortis in, faucibus et, tempus at, dui. Nunc risus. Proin scelerisque augue. Nam ullamcorper. Phasellus id massa. Pellentesque nisl. Pellentesque habitant tuni morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc augue. Aenean sed justo non leo vehicula laoreet. Praesent ipsum libero, auctor ac, tempus nec, casion tempor nec, justo cretusi sino zumbua iloseum musumfu lilokuta nabase uchiha itachi suctung from munual pracetamol testio soel curom ose testio soel lorem isutm pausm mintest osrit ucii</p>
                                <p>Maecenas ullamcorper, odio vel tempus egestas, dui orci faucibus orci, sit amet aliquet lectus dolor et quam. Pellentesque consequat luctus purus. Nunc et risus. Etiam a nibh tunil Phasellus dignissim metus eget nisi. Vestibulum sapien dolor, aliquet nec, porta ac, malesuada a, libero. Praesent feugiat purus eget est. Nulla facilisi. Vestibulum tincidunt sapiens eu velit. Mauris purus. Maecenas eget mauris eu orci accumsan feugiat. Pellentesque eget velit. Nunc tincidunt.</p>
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
		name: "about",
        props : ["lang"],
        data(){
		    return {

            }
        }
	}
</script>

<style scoped>

</style>
