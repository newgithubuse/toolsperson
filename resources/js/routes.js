export default [
    {
        path: '/',
        name: 'home',
        component: require('@/components/Home.vue').default,
        meta: { requireAuth: false },
        children: [
            {
                path: '/login',
                name: 'login',
                component: require('@/components/Login.vue').default,
                meta: { requireAuth: true }
            },
            {
                path: '/register',
                name: 'register',
                component: require('@/components/home/register.vue').default,
                meta: { requireAuth: true }
            },
            {
                path: '/search',
                name: 'search',
                component: require('@/components/home/Search.vue').default,
                meta: { requireAuth: false }
            },
            {
                path: '/submit',
                name: 'submit',
                component: require('@/components/home/Submit.vue').default,
                meta: { requireAuth: false }
            },
            {
                path: '/detailshow/:id',
                name: 'detailshow',
                component: require('@/components/home/DetailShow.vue').default,
                meta: { requireAuth: false }
            }
        ]
    },
    {
        path: '*',
        redirect: '/'
    }
]
