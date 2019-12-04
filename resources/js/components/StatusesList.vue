<template>
    <div>
        <div class="card mb-3 border-0 shadow-sm" v-for="status in statusesList">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded-circle mr-3 shadow-sm" width="40px" src="https://aprendible.com/images/default-avatar.jpg"
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
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                statusesList: []
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
