import React, { Component } from "react";
import { connect } from "react-redux";
import { Link } from "react-router-dom";
import { Scrollbars } from "react-custom-scrollbars";
import Notificaciones from "./Notificaciones";
import { logout } from "../services/authService";

class Header extends Component {
    componentDidUpdate(){}

    componentDidMount() {
        $(".slimscroll-menu").slimscroll({
            height: "auto",
            position: "right",
            size: "7px",
            color: "#9ea5ab",
            wheelStep: 5,
            touchScrollStep: 50
        });

        $(".slimscroll").slimscroll({
            height: "auto",
            position: "right",
            size: "7px",
            color: "#9ea5ab",
            touchScrollStep: 50
        });

        $("#side-menu").metisMenu();

        $(".button-menu-mobile").on("click", function(event) {
            event.preventDefault();
            $("body").toggleClass("enlarged");
        });

        if ($(window).width() < 1025) {
            $("body").addClass("enlarged");
        } else {
            if ($("body").data("keep-enlarged") != true)
                $("body").removeClass("enlarged");
        }

        $("#sidebar-menu a").each(function() {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("mm-active");
                $(this)
                    .parent()
                    .addClass("mm-active"); // add active to li of the current link
                $(this)
                    .parent()
                    .parent()
                    .addClass("mm-show");
                $(this)
                    .parent()
                    .parent()
                    .prev()
                    .addClass("mm-active"); // add active class to an anchor
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .addClass("mm-active");
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .addClass("mm-show"); // add active to li of the current link
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .addClass("mm-active");
            }
        });
    }

    handleLogout = e => {
        e.preventDefault();
        this.props.dispatch(logout());
    };

    handleToogle = e => {
        document.body.classList.add("enlarged");
    };

    render() {
        return (
            <>
                {this.props.isAuthenticated && (
                    <>
                        <div className="topbar">
                            <div className="topbar-left">
                                <a href="/" className="logo">
                                    <span className="logo-light">
                                        <img
                                            src="/images/logo-dark.png"
                                            alt="Fulltorque"
                                            style={{
                                                height: "36px"
                                            }}
                                        />
                                    </span>
                                    <span className="logo-sm">
                                        <img
                                            src="/images/tuerca-light.png"
                                            alt="La Tuerca"
                                            style={{
                                                height: "36px"
                                            }}
                                        />
                                    </span>
                                </a>
                            </div>

                            <nav className="navbar-custom">
                                <ul className="navbar-right list-inline float-right mb-0">
                                    <li className="dropdown notification-list list-inline-item d-none d-md-inline-block">
                                        <a
                                            className="nav-link waves-effect"
                                            href="#"
                                            id="btn-fullscreen"
                                        >
                                            <i className="mdi mdi-arrow-expand-all noti-icon"></i>
                                        </a>
                                    </li>

                                    <li className="dropdown notification-list list-inline-item">
                                        <Notificaciones />
                                    </li>

                                    <li className="dropdown notification-list list-inline-item">
                                        <div className="dropdown notification-list nav-pro-img">
                                            <a
                                                className="dropdown-toggle nav-link arrow-none nav-user"
                                                data-toggle="dropdown"
                                                href="#"
                                                role="button"
                                                aria-haspopup="false"
                                                aria-expanded="false"
                                            >
                                                <img
                                                    src="/images/users/user-4.jpg"
                                                    alt="user"
                                                    className="rounded-circle"
                                                />
                                            </a>
                                            <div className="dropdown-menu dropdown-menu-right profile-dropdown ">
                                                <a
                                                    className="dropdown-item"
                                                    href="#"
                                                >
                                                    <i className="mdi mdi-account-circle"></i>{" "}
                                                    {this.props.user.name}
                                                </a>

                                                <div className="dropdown-divider"></div>

                                                <a
                                                    className="dropdown-item text-danger"
                                                    href="#"
                                                    onClick={this.handleLogout}
                                                >
                                                    <i className="mdi mdi-power text-danger"></i>
                                                    Salir
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                <ul className="list-inline menu-left mb-0">
                                    <li className="float-left">
                                        <button className="button-menu-mobile open-left waves-effect">
                                            <i className="mdi mdi-menu"></i>
                                        </button>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div className="left side-menu">
                            <div className="slimscroll-menu" id="remove-scroll">
                                <div id="sidebar-menu">
                                    <ul className="metismenu" id="side-menu">
                                        <li className="menu-title">Menú</li>
                                        {this.props.user.is_admin ? (
                                            <>
                                                <li>
                                                    <Link
                                                        key="uniqueIdLinkPrueba"
                                                        to={`/panel`}
                                                        className="waves-effect"
                                                    >
                                                        <i className="fas fa-home"></i>

                                                        <span>Panel</span>
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link
                                                        key="uniqueIdLinkPrueba"
                                                        to={`/usuarios`}
                                                        className="waves-effect"
                                                    >
                                                        <i className="fas fa-users"></i>

                                                        <span>Usuarios</span>
                                                    </Link>
                                                </li>
                                            </>
                                        ) 
                                        : (
                                            ""
                                        )}

                                        {this.props.user.is_admin ? (
                                            ""
                                        ) : (
                                            <li>
                                                <Link
                                                    key="uniqueIdLinkPrueba"
                                                    to={`/prueba/1`}
                                                    className="waves-effect"
                                                >
                                                    <i className="fas fa-file-signature"></i>

                                                    <span>Prueba</span>
                                                </Link>
                                            </li>
                                        )}
                                    </ul>
                                </div>
                                <div className="clearfix"></div>
                            </div>
                        </div>
                    </>
                )}
            </>
        );
    }
}

const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated,
    user: state.user,
    notification: state.Notification.notification
});

export default connect(mapStateToProps)(Header);
