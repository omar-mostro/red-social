<template>
    <div>
        <div v-for="status in statusesList">{{status.body}}</div>
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
