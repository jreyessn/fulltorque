import { connect } from "react-redux";
import React, { useEffect } from "react";
import PropTypes from "prop-types";
import { fetchUser } from "../services/authService";
import { withRouter } from "react-router-dom";

function BaseStandalone(props) {
    const { isAuthenticated, user, children, dispatch } = props;

    useEffect(() => {
        if (isAuthenticated && !user.id) {
            dispatch(fetchUser());
        }
    }, [isAuthenticated]);

    return (
        <>
            {children}
        </>
    );
}

BaseStandalone.propTypes = {
    isAuthenticated: PropTypes.bool.isRequired,
    user: PropTypes.object.isRequired,
    children: PropTypes.node.isRequired,
    dispatch: PropTypes.func.isRequired
};

const mapStateToProps = state => {
    return {
        isAuthenticated: state.Auth.isAuthenticated,
        user: state.user
    };
};

export default withRouter(connect(mapStateToProps)(BaseStandalone));
