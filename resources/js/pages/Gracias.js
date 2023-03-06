import React, { Component } from "react";
import { connect } from "react-redux";
import Http from "../Http";
import { Link } from "react-router-dom";

class Dashboard extends Component {
    constructor(props) {
        super(props);

        // Initial state.
        this.state = {
            error: false,
            pruebas: []
        };

        // API endpoint.
        this.api = "/api/prueba/list_detalles";
    }

    componentDidMount() {
        Http.get(`${this.api}`)
            .then(response => {
                this.setState({ pruebas: response.data });
            })
            .catch(() => {
                this.setState({
                    error: "Unable to fetch data."
                });
            });
    }

    render() {
        const { data, error } = this.state;

        return (
            <div>
                <div className="row">
                    <div className="col-12">
                        <div className="card m-b-30">
                            <div className="card-body">
                                <h4
                                    className="mt-0 header-title"
                                    style={{ textAlign: "center" }}
                                >
                                    CORRECTO Y SEGURO USO DE HERRAMIENTAS DE
                                    TORQUE
                                </h4>
                                <p style={{ textAlign: "center" }}>
                                    <img
                                        src="/images/herramientas.png"
                                        style={{
                                            height: "10rem",
                                            marginTop: "20px"
                                        }}
                                        alt="user"
                                    ></img>
                                </p>
                                <p
                                    className="sub-title"
                                    style={{ textAlign: "center" }}
                                >
                                    Gracias por haber presentado la prueba
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated,
    user: state.Auth.user
});

export default connect(mapStateToProps)(Dashboard);
