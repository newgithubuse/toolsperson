export default [
    {
        path: '/',
        name: 'home',
        component: require('@/components/Home.vue').default,
        meta: { requireAuth: true },
        children: [
            {
                path: '/login',
                name: 'login',
                component: require('@/components/home/Login.vue').default,
                meta: { requireAuth: true }
            },
            {
                path: '/register',
                name: 'register',
                component: require('@/components/home/Register.vue').default,
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
            },
            {
                path: '/profile',
                name: 'profile',
                component: require('@/components/home/Profile.vue').default,
                meta: { requireAuth: false }
            },
            {
                path: '/history',
                name: 'history',
                component: require('@/components/home/History.vue').default,
                meta: { requireAuth: false }
            },
            {
                path: '/registrationuser/:id',
                name: 'registrationuser',
                component: require('@/components/home/RegistrationUserShow.vue')
                    .default,
                meta: { requireAuth: false }
            },
            {
                path: '/registration_history',
                name: 'registrationhistory',
                component: require('@/components/home/RegistrationHistory.vue')
                    .default,
                meta: { requireAuth: false }
            }
        ]
    },
    {
        path: '*',
        redirect: '/'
    }
]
