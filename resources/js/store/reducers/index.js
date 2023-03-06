import { combineReducers } from "redux";
import Auth from "./Auth";
import Notification from "./Notification";
import persistStore from "./persistStore";
import user from '../../modules/user/store/reducer'

const RootReducer = combineReducers({ Auth, Notification, user, persistStore });

export default RootReducer;
