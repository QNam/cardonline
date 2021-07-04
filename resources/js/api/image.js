export function uploadImage(params) {
    let formData = new FormData();
    formData.append('image', params.image);

    return http.post('/media/uploadImage', formData,{
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
}

export function uploadImageBase64(img, id) {
    return http.post('/media/uploadImageBase64', {
        image: img,
        id
    })
}