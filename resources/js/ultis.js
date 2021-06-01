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

export function exportExcel(element,fileName) {
    setTimeout(function () {
        let tableEP = $(element).tableExport({
            headings: true,                    // (Boolean), display table headings (th/td elements) in the <thead>
            footers: true,                     // (Boolean), display table footers (th/td elements) in the <tfoot>
            formats: ["xlsx"],    // (String[]), filetypes for the export
            filename: fileName,// (id, String), filename for the downloaded file
            bootstrap: false,                   // (Boolean), style buttons using bootstrap
            exportButtons: false
        });
        let getEp = tableEP.getExportData()
        let exportData = getEp[Object.keys(getEp)[0]]['xlsx'];

        tableEP.export2file(exportData.data, exportData.mimeType, exportData.filename, exportData.fileExtension);
        tableEP.remove();
    },200);
}