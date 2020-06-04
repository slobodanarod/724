<template>

    <div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" :class="{ 'disabled' : meta.current_page === 1 }">
                    <a class="page-link" @click="pageChange(meta.current_page - 1)">Önceki Sayfa</a>
                </li>

                <li class="page-item" v-for=" page in meta.last_page " :key="page" :class="{ 'active' : meta.current_page === page }">
                    <a class="page-link" @click="pageChange(page)">{{ page }}</a>
                </li>

                <li class="page-item" :class="{ 'disabled' : meta.current_page === meta.last_page }">
                    <a class="page-link" @click="pageChange(meta.current_page + 1)">Sonraki Sayfa</a>
                </li>
            </ul>
        </nav>

        <p class="section-results-text" style="text-align: center;margin-top: 10px;">Toplam {{ meta.total }} kullanıcı</p>
    </div>


</template>

<script>
	export default {
		name: "Paginate", props: ['meta'], methods: {
			pageChange (page)
			{
				this.$emit('pageChange', page);
			}
		}
	}
</script>

<style scoped>

    .page-link{
        cursor: pointer;
    }
</style>
