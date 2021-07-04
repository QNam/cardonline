import { uploadImageBase64 } from '../../../api/image'
import { getCardById, CardDTO, storeCard, saveCardAvatar, saveBackgroundBase64} from '../../../api/card'
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
            state.cardContent.avatar_img_url = image

            const rep = await uploadImageBase64(image, state.cardContent.id)
            const data = rep.data.data
            saveCardAvatar(state.cardContent.id, data.img)
            const img = getUrlImage(data.img)

            state.cardContent.avatar_img = data.img
            state.cardContent.avatar_img_url = img
        },

        setAvatarToLocalStorage({state}, avatarImage) {
            localStorage.setItem("FUKI_AVATAR", avatarImage);
        },

        getAvatarToLocalStorage() {
            return localStorage.getItem("FUKI_AVATAR");
        },

        setBackgroundToLocalStorage({state}, image) {
            localStorage.setItem("FUKI_BACKGROUND", image);
        },

        getBackgroundToLocalStorage() {
            return localStorage.getItem("FUKI_BACKGROUND");
        },

        async uploadBackground({state}, image) {
            state.cardContent.background_img_url = image
            
            const rep = await saveBackgroundBase64({ id: state.cardContent.id, image });
            const data = rep.data.data
            const img = getUrlImage(data.background_img)

            state.cardContent.background_img = data.background_img
            state.cardContent.background_img_url = img
        },

        async getCardInfo({commit, dispatch, state}, params) {
            const rep = await getCardById(params.id)
            const data = rep.data.data
            commit('SET_CARD_CONTENT', data)
            dispatch('setAvatarToLocalStorage', state.cardContent.avatar_img_url)
            dispatch('setBackgroundToLocalStorage', state.cardContent.background_img_url)
        },

        async saveCard({state}) {
            const params = {
                id: state.cardContent.id,
                userName: state.cardContent.userName,
                phoneNumber: state.cardContent.phoneNumber,
                email: state.cardContent.email,
                descr: state.cardContent.descr,
                background_img: state.cardContent.background_img,
                background_color: state.cardContent.background_color,
                avatar_img: state.cardContent.avatar_img,
                links: state.cardContent.links,
                theme: state.cardContent.theme,
                iconTheme: state.cardContent.iconTheme
            }

            if(state.cardContent.links) {
                params.link = state.cardContent.links.map((link, key) => {
                    let val = link
                    val.sort = key

                    return val
                })
            }
            
            return await storeCard(params)
        }
    },

    getters: {

    },
    
    mutations: {
        SET_THEME(state, payload) {
            state.cardContent.theme = payload
        },

        SET_ICON_THEME(state, payload) {
            state.cardContent.iconTheme = payload
        },

        SET_BACKGROUND_COLOR(state, payload) {
            state.cardContent.background_color = payload
        },

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

        SET_AVATAR_IMAGE_URL(state, payload) { 
            state.cardContent.avatar_img_url = payload
        },

        SET_BACKGROUND_IMAGE_URL(state, payload) { 
            state.cardContent.background_img_url = payload
        },

        PUSH_CARD_LINKS(state, payload) {
            state.cardContent.links.push({
                card_id: payload.card_id,
                link: payload.link,
                type: payload.type,
                sort: payload.sort
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
            if(payload.id) {
                state.socialEdit.id = payload.id
            }

            if(payload.type) {
                state.socialEdit.type = payload.type
            }

            if(typeof payload.link != "undefined") {
                state.socialEdit.link = payload.link
            }
        },
    }
}