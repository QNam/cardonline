import http from '../axios'
import {toQrcode} from '../ultis'

export function getListCard(data) {
    return http.get('/card/getList', {
        params: { 
            page: data.page,
            limit: data.limit
        }
    })
}

export function storeCard(data) {
    const params = {
        id: data.id,
        userName: data.userName,
        phoneNumber: data.phoneNumber,
        email: data.email,
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

export class CardDTO {
    constructor(card = {}) {
        this.id = typeof card.id !== 'undefined' ? card.id : null
        this.userName = card.userName ? card.userName : ''
        this.phoneNumber = card.phoneNumber ? card.phoneNumber : ''
        this.email = card.email ? card.email : ''
        this.scanNumber = card.scanNumber ? card.scanNumber : ''
        this.activeTime = card.activeTime ? card.activeTime : ''
        this.qrCode = toQrcode(process.env.MIX_APP_URL + this.id)
    }
}
