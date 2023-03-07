import Http from "../Http";
import * as action from "../store/actions";

export function login(credentials) {
    return dispatch =>
        new Promise((resolve, reject) => {
            Http.post("/api/auth/login", credentials)
                .then(res => {
                    dispatch(action.authLogin(res.data.access_token));
                    return resolve();
                })
                .catch(err => {
                    const { status, errors } = err.response.data;
                    const data = {
                        status,
                        errors
                    };
                    return reject(data);
                });
        });
}

export function fetchUser() {
    return dispatch => {
        return Http.get("/api/me")
            .then(res => {
                dispatch(action.authUser(res.data));
            })
            .catch(err => {
                console.log(err);
            });
    };
}

/**
 * logout user
 *
 * @returns {function(*)}
 */
export function logout() {
    return dispatch => {
        return Http.delete("/api/logout")
            .then(() => {
                dispatch(action.authLogout());
                console.log("ff");
                return (window.location.href = "/");
            })
            .catch(err => {
                console.log(err);
            });
    };
}
