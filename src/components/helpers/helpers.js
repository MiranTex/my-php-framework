const helpers = {
    formDataCreate(fields){
        let formData = new FormData;
        Object.entries(fields).forEach(function([key,value]){
            formData.append(key,value);
        })

        formData.append("app_key","12345678");

        return formData;
    },

    getRequestStatus(res){
        if(res.data.status == 200 || res.data.status =="200")
            return true;
        else
            return false
    }
}
export default helpers;