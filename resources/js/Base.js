import { connect } from "react-redux";
import Header from "./components/Header";
import Footer from "./components/Footer";
import React, { useEffect } from "react";
import PropTypes from "prop-types";
import { fetchUser } from "./services/authService";
import { withRouter } from "react-router-dom";

function Base(props) {
    const { isAuthenticated, user, children, dispatch } = props;

    useEffect(() => {
        if (isAuthenticated && !user.id) {
            dispatch(fetchUser());
        }
    }, [isAuthenticated]);

    return (
        <div id="wrapper">
            <Header />
            {isAuthenticated ? (
                <>
                    <div className="content-page">
                        <div className="content">
                            <main>{children}</main>
                        </div>
                    </div>

                    <Footer />
                </>
            ) : (
                <main>{children}</main>
            )}
        </div>
    );
}

Base.propTypes = {
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

export default withRouter(connect(mapStateToProps)(Base));
