class AppStorage {
    storeToken(token)
    {
        localStorage.setItem('token',token);
    }
    storeLmsclass(Lmsclass)
    {
        localStorage.setItem('Lmsclass',Lmsclass);
    }
    storeUser(user)
    {
        localStorage.setItem('user',user);
    }
    storeRole(Role)
    {
        localStorage.setItem('Role',Role);
    }

    store(user,token,Role,Lmsclass)
    {
        this.storeToken(token)
        this.storeUser(user)
        this.storeRole(Role)
        this.storeLmsclass(Lmsclass)
    }
    clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        localStorage.removeItem('Role')
        localStorage.removeItem('Lmsclass')
    }
    getToken(){
        return localStorage.getItem('token')
    }
    getUSer(){
        return localStorage.getItem('user')
    }
    getRole()
    {
        return localStorage.getItem('Role')
    }
    getLmsclass()
    {
        return localStorage.getItem('Lmsclass')
    }


}
export default AppStorage=new AppStorage()
