import ultis from './ultis'

Vue.filter('toQrcode', function (string, size = 'md') {
    return ultis.toQrcode(string, size)
})

