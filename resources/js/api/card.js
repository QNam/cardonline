import http from '../axios'
import {toQrcode, getUrlImage} from '../ultis'

export function getListCard(data) {
    return http.get('/card/getList', {
        params: { 
            getForExport: data.getForExport,
            page: data.page,
            limit: data.limit
        }
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
    const params = {
        id: data.id,
        userName: data.userName,
        phoneNumber: data.phoneNumber,
        email: data.email,
    }

    if(data && data.descr) {
        params.descr = data.descr
    }

    if(data && data.background_img) {
        params.background_img = data.background_img
    }

    if(data && data.avatar_img) {
        params.avatar_img = data.avatar_img
    }

    if(data && data.links) {
        params.links = data.links
    }

    return http.post('/card', params)
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
        this.scanNumber = card && card.scanNumber ? card.scanNumber : ''
        this.activeTime = card && card.activeTime ? card.activeTime : ''
        this.qrCode = toQrcode(process.env.MIX_APP_URL + this.id)
        this.avatar_img = card && card.avatar_img && card.avatar_img != "" ? card.avatar_img  : ''
        this.avatar_img_url = card && card.avatar_img && card.avatar_img != "" ? getUrlImage(card.avatar_img)  : 'https://www.ro-spain.com/wp-content/uploads/2018/07/default-avatar.png'
        this.background_img = card && card.background_img && card.background_img != "" ? card.background_img : ''
        this.background_img_url = card && card.background_img && card.background_img != "" ? getUrlImage(card.background_img) : 'https://cover-talk.zadn.vn/0/f/3/a/1/4345cc7015c1bbcae0d24e8a26ec3ae5.jpg'

        this.links = card && card.links ? card.links : null
    }

    static setDefaultLinksFormat(links = null) {
        return {
            type: links && links.type ? links.type : "",
            link: links && links.link ? links.link : ""
        }
    }
}
