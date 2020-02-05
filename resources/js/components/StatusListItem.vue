<template>
    <div class="card mb-3 border-0 shadow-sm">
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

            <div class="mr-2 text-secondary">
                <i class="far fa-thumbs-up"></i>
                <span dusk="likes-count">{{status.likes_count}}</span>
            </div>

            <LikeBtn :model="status"></LikeBtn>
        </div>
        <div class="card-footer">
            <div v-for="comment in comments" class="mb-2">
                <img class="rounded shadow-sm float-left mr-2" width="34" :src="comment.user_avatar" alt="">
                <div class="card shadow-sm border-0 text-secondary">
                    <div class="card-body p-2 ">
                        <a href=""><strong>{{comment.user_name}}</strong></a>
                        <p>
                            {{comment.body}}
                        </p>
                    </div>
                </div>

                <span dusk="comment-likes-count">{{comment.likes_count}}</span>
                <button dusk="comment-unlike-btn"
                        @click="unlikeComment(comment)"
                        v-if="comment.is_liked">TE GUSTA
                </button>
                <button v-else dusk="comment-like-btn" @click="likeComment(comment)">ME GUSTA</button>

            </div>

            <form @submit.prevent="addComment" v-if="isAuthenticated">

                <div class="d-flex align-items-center">

                    <img class="rounded shadow-sm float-left mr-2"
                         width="34"
                         src="https://aprendible.com/images/default-avatar.jpg" alt="">

                    <div class="input-group">
                        <textarea id="comment"
                                  v-model="commentText"
                                  rows="1"
                                  placeholder="Escribe un comentario"
                                  class="form-control border-0 shadow-sm"/>

                        <div class="input-group-append">
                            <button dusk="comment-btn" class="btn btn-primary" type="submit">Comentar</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    import LikeBtn from './LikeBtn';
    import auth from '../mixins/auth';

    export default {
        data() {
            return {
                commentText: '',
                comments: this.status.comments,
            }
        },
        props: {
            status: {
                type: Object,
                required: true
            }
        },
        mixins: [auth],
        methods: {
            addComment() {
                axios.post(`/statuses/${this.status.id}/comments`,
                    {
                        body: this.commentText
                    })
                    .then(res => {
                        this.comments.push(res.data.data);
                        this.commentText = '';
                    })
                    .catch(error => {
                        console.log(error.response.data)
                    })
            },
            likeComment(comment) {
                axios.post(`/comments/${comment.id}/likes`)
                    .then(resp => {
                        comment.likes_count++;
                        comment.is_liked = true;
                    })
                    .catch(error => {
                        console.log(error.response.data)
                    })
            },
            unlikeComment(comment) {
                axios.delete(`/comments/${comment.id}/likes`)
                    .then(resp => {
                        console.log(resp);
                        comment.likes_count--;
                        comment.is_liked = false;
                    })
                    .catch(error => {
                        console.log(error.response.data)
                    })
            }
        },
        components: {
            LikeBtn
        }
    }
</script>

<style scoped>

</style>
