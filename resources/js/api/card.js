import http from '../axios'
import {toQrcode, getUrlImage} from '../ultis'

export function saveBackgroundBase64(data) {
    return http.post('/card/saveBackgroundBase64', {
        image: data.image,
        id:  data.id
    })
}

export function checkAccountToForgetPassword(data) {
    return http.post('/card/checkAccountToForgetPassword', {
        email: data.email,
        confirm_code: data.confirm_code
    })
}

export function forgetPassword(data) {
    return http.post('/card/forgetPassword', {
        email: data.email,
        confirm_code: data.confirm_code,
        password: data.password
    })
}

export function getListCard(data) {
    let params = { 
        getForExport: data.getForExport,
        page: data.page,
        limit: data.limit
    }
    
    if(data.fullName) {
        params.fullName = data.fullName
    }
    if(data.email) {
        params.email = data.email
    }
    if(data.id) {
        params.id = data.id
    }

    return http.get('/card/getList', {
        params
    })
}

export function getCardById(id) {
    return http.get('/card/getById', {
        params: { 
            id
        }
    })
}

export function genCard(params) {
    return http.post('/card/genCard', { 
        from: params.from,
        to: params.to,
    })
}

export function saveCardAvatar(id, imageName) {
    return http.post('/card/saveAvatar', { 
            id,
            avatar_img: imageName
        })
}

export function saveCardBackground(id, imageName) {
    return http.post('/card/saveBackground', { 
            id,
            background_img: imageName
        })
}

export function storeCard(data) {
    // const params = {
    //     id: data.id,
    //     userName: data.userName,
    //     phoneNumber: data.phoneNumber,
    //     email: data.email,
    // }

    // if(data && data.descr) {
    //     params.descr = data.descr
    // }

    // if(data && data.theme) {
    //     params.theme = data.theme
    // }

    // if(data && data.background_img) {
    //     params.background_img = data.background_img
    // }

    // if(data && data.avatar_img) {
    //     params.avatar_img = data.avatar_img
    // }

    // if(data && data.links) {
    //     params.links = data.links
    // }

    // if(data && data.background_color) {
    //     params.background_color = data.background_color
    // }

    return http.post('/card', data)
}

export function register(data) {
    const params = {
        id: data.cardId,
        userName: data.userName,
        email: data.email,
        password: data.password,
    }

    return http.post('/card/register', params)
}

export function login(data) {
    const params = {
        email: data.email,
        password: data.password,
    }

    return http.post('/card/login', params)
}


export function checkCardIsExists(data) {
    const params = {
        type: data.type ? data.type : 'cardId',
        value: data.value
    }

    return http.post('/card/exists', params)
}

export function checkConfirmCode(data) {
    const params = {
        cardId: data.cardId,
        confirmCode: data.confirmCode
    }

    return http.post('/card/checkConfirmCode', params)
}

export function removeCard(cardId) {
    const params = {
        id: cardId
    }
    return http.post('/card/remove', params)
}

export function removeCardLink(link_id) {
    const params = {
        link_id
    }
    return http.post('/card/removeLink', params)
}

export class CardDTO {
    constructor(card = null) {
        this.id = card && typeof card.id !== 'undefined' ? card.id : null
        this.userName = card && card.userName ? card.userName : ''
        this.url = card && typeof card.id !== 'undefined' ? process.env.MIX_APP_URL + this.id : ''
        this.phoneNumber = card && card.phoneNumber ? card.phoneNumber : ''
        this.email = card && card.email ? card.email : ''
        this.descr = card && card.descr ? card.descr : ''
        this.theme = card && card.theme ? card.theme : 1
        this.iconTheme = card && card.iconTheme ? card.iconTheme : 1
        this.scanNumber = card && card.scanNumber ? card.scanNumber : ''
        this.activeTime = card && card.activeTime ? card.activeTime : ''
        this.qrCode = toQrcode(process.env.MIX_APP_URL + this.id)
        this.avatar_img = card && card.avatar_img && card.avatar_img != "" ? card.avatar_img  : ''
        this.background_color = card && card.background_color && card.background_color != "" ? card.background_color : null
        this.avatar_img_url = card && card.avatar_img && card.avatar_img != "" ? getUrlImage(card.avatar_img)  : 'https://www.ro-spain.com/wp-content/uploads/2018/07/default-avatar.png'
        this.background_img = card && card.background_img && card.background_img != "" ? card.background_img : ''
        this.background_img_url = card && card.background_img && card.background_img != "" ? getUrlImage(card.background_img) : 'https://cover-talk.zadn.vn/0/f/3/a/1/4345cc7015c1bbcae0d24e8a26ec3ae5.jpg'
        this.confirm_code = card && card.confirm_code ? card.confirm_code : '' 
        this.links = card && card.links ? card.links : null
    }

    static setDefaultLinksFormat(links = null) {
        return {
            type: links && links.type ? links.type : "",
            link: links && links.link ? links.link : ""
        }
    }
}
