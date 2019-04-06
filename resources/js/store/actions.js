export const CONTENTS_READ = context => {
    return axios.get('v1/public/get').then(response => {
        let res = response
        console.log(res)
        context.commit('getcontents', res.data.data)
    })
}
export const Login = (context, status) => {
    context.commit('login', status)
}

export const Logout = (context, status) => {
    context.commit('logout', status)
}

export const LoginStatus = (context, status) => {
    if (status) {
        context.commit('loginstatus', true)
    } else {
        context.commit('loginstatus', false)
    }
}
