import vueRouter from 'vue-router';

let routes=[
    {
        path: '/',
        component: require('./views/Welcome.vue'),
    },
    {
        path: '/post/:slug',
        component: require('./views/Post.vue'),
        props: true,
    }
]

export default new vueRouter({
    routes:routes
})