import moment from 'moment'

export const state = {
    contents: [],
    user: [],
    userobject: [],
    loginstatus: false
}

export const mutations = {
    getcontents(state, data) {
        let i
        for (i = 0; i < data.length; i++) {
            data[i].footer = moment(
                data[i].createdatetime,
                'YYYY-MM-DD HH:mm:ss'
            ).fromNow()
        }
        state.contents = data.reverse()
    },
    setcontents(state, data) {
        state.contents = state.contents.reverse()
        state.contents.push(data)
        state.contents = state.contents.reverse()
    },
    login(state, data) {
        state.user = data
        state.loginstatus = true
    },
    logout(state, data) {
        state.user = ''
        state.loginstatus = false
    },
    loginstatus(state, data) {
        if (data) {
            state.user = JSON.parse(window.localStorage.getItem('user'))
        }
        state.loginstatus = data
    },
    updateuserprofile(state, data) {
        state.user = data
    },
    getuserobject(state, data) {
        state.userobject = data.reverse()
    }
}
