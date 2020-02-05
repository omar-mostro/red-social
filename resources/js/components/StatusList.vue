<template>
    <div>
        <status-list-item
            v-for="status in statusesList"
            :status="status"
            :key="status.id"></status-list-item>
    </div>
</template>

<script>

    import StatusListItem from './StatusListItem';

    export default {
        data() {
            return {
                statusesList: []
            }
        },

        methods: {

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
        },
        components:
            {
                StatusListItem
            }
    }
</script>

<style scoped>

</style>
