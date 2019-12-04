<template>
    <div>
        <form @submit.prevent="submit">
            <div class="card-body">
            <textarea v-model="body" class="form-control border-0 bg-light" name="body"
                      placeholder="¿Qué estás pensando Jorge?"></textarea>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="create-status">Publicar</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
            }
        },
        methods: {
            submit() {
                axios.post('/statuses', {
                    body: this.body
                })
                    .then(res => {
                        this.body = '';
                        EventBus.$emit('status-created', res.data);
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    })
            }
        }
    }
</script>

<style scoped>

</style>
