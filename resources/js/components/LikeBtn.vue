<template>
    <button @click="toggle"
            :class="getBtnClasses">
        <i :class="getIconClasses"/> {{getText}}
    </button>
</template>

<script>
    import auth from '../mixins/auth';

    export default {
        props: {
            model: {
                type: Object,
                required: true
            },
            url: {
                type: String,
                required: true
            }
        },
        mixins: [auth],
        methods: {
            toggle() {
                this.redirectIfGuest();
                const method = this.model.is_liked ? 'delete' : 'post';
                this.model.is_liked = !this.model.is_liked;

                axios[method](this.url)
                    .then(res => {
                        this.model.likes_count = res.data.likes_count;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },
        },
        computed: {
            getText(){
                return this.model.is_liked ? 'TE GUSTA' : 'Me Gusta';
            },
            getBtnClasses(){
                return [
                    this.model.is_liked ? 'font-weight-bold' : '',
                    'btn', 'btn-link', 'btn-sm'
                ]
            },
            getIconClasses(){
                return [
                    this.model.is_liked ? 'fa' : 'far',
                    'fa-thumbs-up','text-primary'
                ]
            }
        }
    }
</script>

<style scoped>

</style>
