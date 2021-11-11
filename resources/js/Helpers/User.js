import Token from './Token';
import AppStorage from './AppStorage';

class User{

    responseAfterLogin(res){
        const access_token = res.data.access_token;
        const name = res.data.name;
        if(Token.isValid(access_token)){
            AppStorage.store(access_token,name)
        }
    }

    hasToken(){
        const storeItem = localStorage.getItem('token');
        if(storeItem){
            return Token.isValid(storeItem) ? true : false
        }
        false
    }

    loogedIn(){
        return this.hasToken();
    }

    name(){
        if(this.loggedIn()){
            return localStorage.getItem('user')
        }
    }

    id(){
        if (this.loggedIn()) {
            const payload = Token.payload(localStorage.getItem('token'));
            return payload.sub
        }
        return false
    }


}

export default User = new User();