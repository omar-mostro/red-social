<template>
    <div>
        <form @submit.prevent="submit" v-if="isAuthenticated">
            <div class="card-body">
            <textarea v-model="body"
                      class="form-control border-0 bg-light"
                      name="body"
                      :placeholder="`¿Qué estás pensando ${user.name}?`"></textarea>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="create-status">Publicar</button>
            </div>
        </form>
        <div class="card-body" v-else>
            <a :href="`${$baseUrl}/login`">Debes hacer login</a>
        </div>
    </div>
</template>

<script>

    import auth from '../mixins/auth';

    export default {
        data() {
            return {
                body: '',
            }
        },
        mixins: [auth],
        methods: {
            submit() {
                axios.post('/statuses', {
                    body: this.body
                })
                    .then(res => {
                        this.body = '';
                        EventBus.$emit('status-created', res.data.data);
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
