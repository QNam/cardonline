import ultis from './ultis'

Vue.filter('toQrcode', function (string, size = 'md') {
    return ultis.toQrcode(string, size)
})

Vue.filter('getUrlImage', function (imageName) {
    return ultis.getUrlImage(imageName)
})