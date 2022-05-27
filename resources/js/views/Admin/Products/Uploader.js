export default class UploadAdapter {
    constructor(loader) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }

    async upload() {
        const data = new FormData();
        data.append('image', await this.loader.file);

        return new Promise((resolve, reject) => {
            axios({
                url: `/api/upload`,
                method: 'post',
                data,
            }).then(res => {
                var resData = res.data;
                resData.default = resData.url;
                resolve(resData);
            }).catch(error => {
                reject(error)
            });
        });
    }
    // Aborts the upload process.
    abort() {
        //
    }
}

export const uploader = function (editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) =>
        new UploadAdapter(loader);
};
