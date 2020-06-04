<template>
    <div class="modal fade" id="sendMessage" style="z-index: 99999;" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mesaj Gönder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: auto;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="onSubmit">
                        <div class="form-group" style="margin-top: 0">
                            <label for="message-text" class="col-form-label">Mesajınız:</label>
                            <textarea class="form-control" v-model="message.content" id="message-text"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Mesaj Gönder</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SendMessageModal", props: ["messageData", 'user'], data ()
        {
            return {
                conversations: {}, total_count: 0, message: {
                    content: "",
                }, response: {}
            }
        }, computed: {
            activeUser ()
            {
                return this.$store.getters.activeUser;
            }
        }, mounted ()
        {

        }, methods: {
            onSubmit ()
            {
                const convMsg = {
                    message: this.message.content,
                    created_at: Date.now(),
                    deleted: "{0}",
                    view: 0,
                    p_id: this.messageData.p_id,
                    status: 0
                };

                window.axios.post("/profile/message", convMsg).then((res) => {
                    if (res.data)
                    {
                        $('#sendMessage').modal('hide');
                        this.$router.push();
                    }
                });

            }

        }
    }

</script>

<style scoped>

</style>
