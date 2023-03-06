import * as ActionTypes from "../action-types";

const defaultNotification = {
    noti: null
};

const initialState = {
    notification: defaultNotification
};

const notification = (state, payload) => {
    const { noti } = payload;
    localStorage.setItem("noti", JSON.stringify(noti));

    const stateObj = Object.assign({}, state, {
        noti
    });
    return stateObj;
};

const Notification = (state = initialState, { type, payload = null }) => {
    switch (type) {
        case ActionTypes.NOTIFICATION:
            return notification(state, payload);
        default:
            return state;
    }
};

export default Notification;
