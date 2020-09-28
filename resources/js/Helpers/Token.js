class  Token{
    isValid(token)
    {
        const payload = this.payload(token);

        if(payload){
            console.log(payload.iss);
            return payload.iss == "http://faisalsarker.com/lms/api/auth/login" || "https://faisalsarker.com/lms/api/auth/login" ? true : false
        }
        return false
    }
    payload(token)
    {
        const payload = token.split('.')[1]
        return this.decode(payload)
         //console.log(JSON.parse(atob(payload)))
        //console.log(payload)
        //console.log(atob(payload))

    }
    decode(payload){
        if(this.isBase64(payload)){
            return JSON.parse(atob(payload))
        }
        return false

    }

    isBase64(str){
        try {
            return btoa(atob(str)).replace(/=/g,"") ==str
        }
        catch(err){
            return false
        }
    }


}
export default Token = new Token()
