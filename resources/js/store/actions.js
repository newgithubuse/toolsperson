export const CONTENTS_READ = context => {
    return axios.get('http://localhost:8888/alldata').then(res => {
        context.commit('getcontents', res.data)
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
