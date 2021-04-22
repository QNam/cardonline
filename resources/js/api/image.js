export function uploadImage(params) {
    let formData = new FormData();
    formData.append('image', params.image);

    return http.post('/media/uploadImage', formData,{
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
}