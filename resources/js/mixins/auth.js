let user = document.head.querySelector('meta[name="user"]');
module.exports = {
    computed: {
        //se usan cuando no hay necesidad de recalcularlo solo para mostrarlo
        //computed es más optimo y funciona de forma asynxrona a diferenfia de watch
        user() {
            if (this.isAuthenticated){
                return JSON.parse(user.content);
            }

            return {
                name:'Usuario invitado'
            }

        },
        isAuthenticated() {
            return !!user.content
        },
        isGuest() {
            return !this.isAuthenticated
        },
    },
    methods:{
        redirectIfGuest() {
            if (this.isGuest)
                return window.location.href = `${this.$baseUrl}/login`;
        }
    }
};
