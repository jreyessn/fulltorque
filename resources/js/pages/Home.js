import React, { Component } from "react";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import { Link, Redirect } from "react-router-dom";
import ReeValidate from "ree-validate";
import classNames from "classnames";
import AuthService from "../services";

class Home extends Component {
    constructor() {
        super();

        this.validator = new ReeValidate.Validator({
            email: "required|email",
            password: "required|min:6"
        });

        this.state = {
            loading: false,
            email: "",
            password: "",
            errors: {},
            response: {
                error: false,
                message: ""
            }
        };
    }

    handleChange = e => {
        const { name, value } = e.target;
        this.setState({ [name]: value });

        // If a field has a validation error, we'll clear it when corrected.
        const { errors } = this.state;
        if (name in errors) {
            const validation = this.validator.errors;
            this.validator.validate(name, value).then(() => {
                if (!validation.has(name)) {
                    delete errors[name];
                    this.setState({ errors });
                }
            });
        }
    };

    handleBlur = e => {
        const { name, value } = e.target;

        // Avoid validation until input has a value.
        if (value === "") {
            return;
        }

        const validation = this.validator.errors;
        this.validator.validate(name, value).then(() => {
            if (validation.has(name)) {
                const { errors } = this.state;
                errors[name] = validation.first(name);
                this.setState({ errors });
            }
        });
    };

    handleSubmit = e => {
        e.preventDefault();
        const { email, password } = this.state;
        const credentials = {
            email,
            password
        };

        this.validator.validateAll(credentials).then(success => {
            if (success) {
                this.setState({ loading: true });
                this.submit(credentials);
            }
        });
    };

    submit = credentials => {
        this.props.dispatch(AuthService.login(credentials)).catch(err => {
            this.loginForm.reset();
            const errors = Object.values(err.errors);
            errors.join(" ");
            const response = {
                error: true,
                message: errors
            };
            this.setState({ response });
            this.setState({ loading: false });
        });
    };

    render() {
        // If user is already authenticated we redirect to entry location.
        const { from } = this.props.location.state || {
            from: { pathname: "/" }
        };
        const { isAuthenticated } = this.props;
        if (isAuthenticated) {
            return <Redirect to={from} />;
        }

        const { response, errors, loading } = this.state;

        return (
            <div>
                <div className="accountbg"></div>
                <div className="home-btn d-none d-sm-block">
                    <a href="https://www.fulltorque.cl" className="text-white">
                        <i className="fas fa-home h2"></i>
                    </a>
                </div>
                <div className="wrapper-page">
                    <div className="card card-pages shadow-none">
                        <div className="card-body">
                            <div className="text-center m-t-0 m-b-15">
                                <a href="">
                                    <img
                                        src="/images/logo-dark.png"
                                        style={{
                                            height: "50px"
                                        }}
                                    ></img>
                                </a>
                            </div>

                            <form
                                className="form-horizontal m-t-30"
                                method="POST"
                                onSubmit={this.handleSubmit}
                                ref={el => {
                                    this.loginForm = el;
                                }}
                            >
                                <div className="form-group">
                                    <div className="col-12">
                                        <label>Email</label>
                                        <input
                                            id="email"
                                            type="email"
                                            name="email"
                                            className={classNames(
                                                "form-control",
                                                {
                                                    "is-invalid":
                                                        "email" in errors
                                                }
                                            )}
                                            placeholder="Enter email"
                                            required
                                            onChange={this.handleChange}
                                            onBlur={this.handleBlur}
                                            disabled={loading}
                                        />
                                        {"email" in errors && (
                                            <div className="invalid-feedback">
                                                {errors.email}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="form-group">
                                    <div className="col-12">
                                        <label>Contraseña</label>
                                        <input
                                            id="password"
                                            type="password"
                                            className={classNames(
                                                "form-control",
                                                {
                                                    "is-invalid":
                                                        "password" in errors
                                                }
                                            )}
                                            name="password"
                                            placeholder="Enter password"
                                            required
                                            onChange={this.handleChange}
                                            onBlur={this.handleBlur}
                                            disabled={loading}
                                        />
                                        {"password" in errors && (
                                            <div className="invalid-feedback">
                                                {errors.password}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="form-group text-center m-t-20">
                                    <div className="col-12">
                                        <button
                                            className={classNames(
                                                "btn btn-primary btn-block btn-lg waves-effect waves-light",
                                                {
                                                    "btn-loading": loading
                                                }
                                            )}
                                            type="submit"
                                        >
                                            Iniciar sesión
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

Home.propTypes = {
    dispatch: PropTypes.func.isRequired,
    isAuthenticated: PropTypes.bool.isRequired
};

const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated
});

export default connect(mapStateToProps)(Home);
