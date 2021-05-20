import { uploadImage, uploadImageBase64 } from '../../../api/image'
import { getCardById, CardDTO, storeCard, saveCardAvatar, saveCardBackground, removeCardLink} from '../../../api/card'
import { getUrlImage } from '../../../ultis'

export default {
    state: {
        cardContent: new CardDTO(),
        socialEdit: {
            id: null,
            type: null,
            link: null
        }
    },

    actions: {
        async uploadAvatar({state}, image) {
            const rep = await uploadImageBase64(image)
            const data = rep.data.data
            saveCardAvatar(state.cardContent.id, data.img)
            const img = getUrlImage(data.img)

            state.cardContent.avatar_img = data.img
            state.cardContent.avatar_img_url = img
        },

        async getCardInfo({commit}, params) {
            const rep = await getCardById(params.id)
            const data = rep.data.data

            commit('SET_CARD_CONTENT', data)
        },

        async saveCard({state}) {
            const params = {
                id: state.cardContent.id,
                userName: state.cardContent.userName,
                phoneNumber: state.cardContent.phoneNumber,
                email: state.cardContent.email,
                descr: state.cardContent.descr,
                background_img: state.cardContent.background_img,
                avatar_img: state.cardContent.avatar_img,
                links: state.cardContent.links
            }
            
            return await storeCard(params)
        }
    },

    getters: {

    },
    
    mutations: {
        SET_CARD_CONTENT(state, payload) {
            state.cardContent = new CardDTO(payload)
            if(!state.cardContent.links) {
                state.cardContent.links = []
                state.cardContent.links.push(CardDTO.setDefaultLinksFormat())
            }
        },

        SET_CARD_NAME(state, payload) { 
            state.cardContent.userName = payload
        },

        SET_CARD_LINKS(state, payload) { 
            state.cardContent.links = payload
        },

        PUSH_CARD_LINKS(state, payload) {
            state.cardContent.links.push({
                card_id: payload.card_id,
                link: payload.link,
                type: payload.type
            })
        },

        SET_CARD_EMAIL(state, payload) { 
            state.cardContent.email = payload
        },

        SET_CARD_PHONE_NUMBER(state, payload) { 
            state.cardContent.phoneNumber = payload
        },

        SET_CARD_DESC(state, payload) { 
            state.cardContent.descr = payload
        },

        RESET_SOCIAL_EDIT(state) {
            state.socialEdit = {
                id: null,
                type: null,
                link: null
            }
        },

        SET_SOCIAL_EDIT(state, payload) {
            console.log(payload)
            if(payload.id) {
                state.socialEdit.id = payload.id
            }

            if(payload.type) {
                state.socialEdit.type = payload.type
            }

            if(payload.link) {
                state.socialEdit.link = payload.link
            }
        },
    }
}