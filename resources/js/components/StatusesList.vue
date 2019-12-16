<template>
    <div>
        <div class="card mb-3 border-0 shadow-sm" v-for="status in statusesList">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded-circle mr-3 shadow-sm" width="40px"
                         src="https://aprendible.com/images/default-avatar.jpg"
                         alt="">
                    <div class="">
                        <h5 class="mb-1">{{status.user_name}} </h5>
                        <div class="small text-muted">
                            {{status.ago}}
                        </div>
                    </div>
                </div>
                <p class="card-text text-secondary">{{status.body}}</p>

            </div>
            <div class="card-footer p-2 d-flex justify-content-between align-items-center">
                <button v-if="status.is_liked"
                        @click="unlike(status)"
                        class="btn btn-link"
                        dusk="unlike-btn">
                    <i class="far fa-thumbs-up text-primary"></i> TE GUSTA
                </button>
                <button v-else
                        @click="like(status)"
                        class="btn btn-link"
                        dusk="like-btn">
                    <i class="fas fa-thumbs-up text-primary"></i> Me Gusta
                </button>

                <div class="mr-2 text-secondary">
                    <i class="far fa-thumbs-up"></i>
                    <span dusk="likes-count">{{status.likes_count}}</span>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
    import auth from '../mixins/auth';

    export default {
        data() {
            return {
                statusesList: []
            }
        },
        mixins: [auth],
        methods: {
            like(status) {

                this.redirectIfGuest();

                axios.post(`/statuses/${status.id}/likes`)
                    .then(res => {
                        status.is_liked = true;
                        status.likes_count++;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });

            },
            unlike(status) {
                this.redirectIfGuest();

                axios.delete(`/statuses/${status.id}/likes`)
                    .then(res => {
                        status.is_liked = false;
                        status.likes_count--;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });

            }
        },
        mounted() {

            axios.get('/statuses')
                .then(res => {
                    this.statusesList = res.data.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });

            EventBus.$on('status-created', status => {
                this.statusesList.unshift(status);
            })
        }
    }
</script>

<style scoped>

</style>
