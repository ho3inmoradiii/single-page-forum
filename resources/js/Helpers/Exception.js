import User from "./User";

class Exception {
    handle(error){
        this.isExpired(error.response.data.error)
    }

    isExpired(error){
        if (error === 'Token has Expired'){
            User.logout();
        }
    }
}

export default Exception = new Exception;
