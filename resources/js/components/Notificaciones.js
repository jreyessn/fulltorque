import React, { Component } from "react";
import { connect } from "react-redux";
import * as actions from "../store/actions";

class Notificaciones extends Component {
    state = {
        Notification: null
    };

    componentDidMount() {
        setInterval(() => {
            this.setState({
                Notification: localStorage.getItem("noti")
            });
        }, 60000);
    }

    render() {
        return (
            <>
                <a
                    className="nav-link dropdown-toggle arrow-none waves-effect"
                    data-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-haspopup="false"
                    aria-expanded="false"
                >
                    <i className="mdi mdi-bell-outline noti-icon"></i>
                    <span className="badge badge-pill badge-danger noti-icon-badge">
                        {this.state.Notification ? 1 : 0}
                    </span>
                </a>
                <div className="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                    <h6 className="dropdown-item-text">Notificaciones</h6>
                    {this.state.Notification ? (
                        <div className="slimscroll notification-item-list">
                            <a
                                href="#"
                                className="dropdown-item notify-item active"
                            >
                                <div className="notify-icon bg-success">
                                    <i className="far fa-clock"></i>
                                </div>
                                <p className="notify-details">
                                    <b>Cronómetro</b>
                                    <span className="text-muted">
                                        {this.state.Notification}
                                    </span>
                                </p>
                            </a>
                        </div>
                    ) : null}

                    <a
                        href="#"
                        className="dropdown-item text-center notify-all text-primary"
                    >
                        View all <i className="fi-arrow-right"></i>
                    </a>
                </div>
            </>
        );
    }
}

const mapStateToProps = state => ({
    notification: state.Notification.notification
});

export default connect(mapStateToProps)(Notificaciones);
