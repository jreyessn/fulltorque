import * as ActionTypes from "../action-types";
import Http from "../../Http";

const initialState = {
    isAuthenticated: false
};

const authLogin = (state, payload) => {
    localStorage.setItem('access_token', payload);
    
    Http.defaults.headers.common['Authorization'] = `Bearer ${payload}`;
    const stateObj = Object.assign({}, state, {
        isAuthenticated: true
    });
    return stateObj;
};

const checkAuth = state => {
    const stateObj = Object.assign({}, state, {
        isAuthenticated: !!localStorage.getItem('access_token')
    });
    if (state.isAuthenticated) {
        Http.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('access_token')}`;
    }
    return stateObj;
};

const logout = state => {
    localStorage.removeItem('access_token')
    const stateObj = Object.assign({}, state, {
        isAuthenticated: false
    });
    return stateObj;
};

const Auth = (state = initialState, { type, payload = null }) => {
    switch (type) {
        case ActionTypes.AUTH_REFRESH_TOKEN:
        case ActionTypes.AUTH_LOGIN:
            return authLogin(state, payload);
        case ActionTypes.AUTH_CHECK:
            return checkAuth(state);
        case ActionTypes.AUTH_LOGOUT:
            return logout(state);
        default:
            return state;
    }
};

export default Auth;
