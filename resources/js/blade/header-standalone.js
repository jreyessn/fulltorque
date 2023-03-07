import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import store from '../store';
import * as action from '../store/actions';
import Header from "../components/Header";
import BaseStandalone from "./base-standalone";
import { BrowserRouter as Router } from 'react-router-dom';

store.dispatch(action.authCheck());

ReactDOM.render(
  <Provider store={store}>
    <Router>
      <BaseStandalone>
        <Header></Header>
      </BaseStandalone>
    </Router>
  </Provider>,
  document.getElementById('headerReact'),
);
