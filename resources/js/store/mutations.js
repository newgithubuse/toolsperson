import moment from 'moment'

export const state = {
    contents: [],
    user: [],
    userobject: [],
    loginstatus: false,
    registrationhistory: []
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
        let tmp = state.contents.filter(item => {
            return item.user_id == data.id
        })
        tmp.forEach(item => {
            item.name = data.name
        })
    },
    getuserobject(state, data) {
        state.userobject = data.reverse()
    },
    getregistrationhistory(state, data) {
        state.registrationhistory = data
    },
    deleteregistration(state, data) {
        for (let i = 0; i < state.registrationhistory.length; i++) {
            if (state.registrationhistory[i].id == data) {
                state.registrationhistory.splice(i, 1)
                break
            }
        }
    },
    updateobject(state, data) {
        let tmp = state.contents.find(item => {
            return item.id == data.id
        })
        tmp.title = data.data.title ? data.data.title : tmp.title
        tmp.text = data.data.text ? data.data.text : tmp.text
        tmp.detail = data.data.detail ? data.data.detail : tmp.detail
        tmp.img = data.data.img ? data.data.img : tmp.img
    }
}
