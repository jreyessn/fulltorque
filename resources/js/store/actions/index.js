import * as ActionTypes from "../action-types";

export function authLogin(payload) {
    return {
        type: ActionTypes.AUTH_LOGIN,
        payload
    };
}

export function notification(payload) {
    return {
        type: ActionTypes.NOTIFICATION,
        payload
    };
}

export function authLogout() {
    return {
        type: ActionTypes.AUTH_LOGOUT
    };
}

export function authCheck() {
    return {
        type: ActionTypes.AUTH_CHECK
    };
}

export function authRefreshToken(payload) {
    return {
      type: ActionTypes.AUTH_REFRESH_TOKEN,
      payload
    }
  }
  


  export function authUser(payload) {
    return {
      type: ActionTypes.AUTH_USER,
      payload
    }
  }
  