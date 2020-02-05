<template>
    <button v-if="model.is_liked"
            @click="unlike"
            class="btn btn-link"
            dusk="unlike-btn">
        <i class="far fa-thumbs-up text-primary"/> TE GUSTA
    </button>
    <button v-else
            @click="like"
            class="btn btn-link"
            dusk="like-btn">
        <i class="fas fa-thumbs-up text-primary"/> Me Gusta
    </button>
</template>

<script>
    import auth from '../mixins/auth';

    export default {
        props: {
            model: {
                type: Object,
                required: true
            }
        },
        mixins: [auth],
        methods: {
            like() {

                this.redirectIfGuest();
                this.model.is_liked = true;

                axios.post(`/statuses/${this.model.id}/likes`)
                    .then(res => {

                        this.model.likes_count++;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });

            },
            unlike() {
                this.redirectIfGuest();

                this.model.is_liked = false;
                axios.delete(`/statuses/${this.model.id}/likes`)
                    .then(res => {

                        this.model.likes_count--;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });

            }
        },
    }
</script>

<style scoped>

</style>
