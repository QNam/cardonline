export function toQrcode(string, size = 'md') {
    if(size == 'md') {
        size = '150x150'
    } else if(size == 'lg') {
        size = '350x350'
    } else {
        size = '150x150'
    }
    return `https://chart.googleapis.com/chart?chs=${size}&cht=qr&chl=${string}&choe=UTF-8`
}

export function getUrlImage(imageName) {
    return process.env.MIX_APP_UPLOADFILE_URL + imageName
}