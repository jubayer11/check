import Token from './Token'
import AppStorage from './AppStorage'
class User {


    responseAfterLogin(res)
{

    const access_token= res.data.access_token
    const username=res.data.user
    const role=res.data.Role

    if (Token.isValid(access_token)) {
        AppStorage.store(username,access_token,role)
       window.location = '/lms/profile'


    }
 }
 hasToken(){
    const storedToken = AppStorage.getToken();
    if(storedToken)
    {
        return Token.isValid(storedToken) ? true : this.logout()
    }
    return false
 }


 loggedIn()
 {
     return this.hasToken()
 }

 logout(){
    AppStorage.clear()
     window.location='/lms'

 }
name(){
    if(this.loggedIn()){
        return AppStorage.getUSer()
    }
}

    role(){
        if(this.loggedIn()){
            return AppStorage.getRole()
        }
    }


    Lmsclass(){
        if(this.loggedIn()){
            return AppStorage.getLmsclass()
        }
    }

id(){
    if(this.loggedIn()){
        const payload = Token.payload(AppStorage.getToken())
        return payload.sub
    }
}
own(id){
    return this.id() ==id
}
admin(){
    return this.id() ==1
}


}
export default User=new User();
