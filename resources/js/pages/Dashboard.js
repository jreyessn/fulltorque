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
                {this.props.user.is_admin == 0 ? (
                    this.props.user.presento ? (
                        <div className="row">
                            <div className="col-12">
                                <div className="card m-b-30">
                                    <div className="card-body">
                                        <h4
                                            className="mt-0 header-title"
                                            style={{ textAlign: "center" }}
                                        >
                                            Prueba presentada feliciades.!{" "}
                                        </h4>
                                        <p style={{ textAlign: "center" }}>
                                            <img
                                                src="images/herramientas.png"
                                                style={{
                                                    height: "10rem",
                                                    marginTop: "20px"
                                                }}
                                                alt="user"
                                            ></img>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ) : (
                        <div className="row">
                            <div className="col-12">
                                <div className="card m-b-30">
                                    <div
                                        className="card-body"
                                        style={{ height: "768px" }}
                                    >
                                        <h4
                                            className="mt-0 header-title"
                                            style={{ textAlign: "center" }}
                                        >
                                            CORRECTO Y SEGURO USO DE
                                            HERRAMIENTAS DE TORQUE
                                        </h4>
                                        <p style={{ textAlign: "center" }}>
                                            <img
                                                src="images/herramientas.png"
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
                                            Estimado, {this.props.user.name}. Ha
                                            sido un agrado que usted haya
                                            participado en nuestro webinar.
                                        </p>
                                        <p
                                            className="sub-title"
                                            style={{
                                                textAlign: "center",
                                                marginTop: "-22px"
                                            }}
                                        >
                                            {" "}
                                            Ahora, es cuando debe poner a prueba
                                            lo aprendido.
                                        </p>
                                        {this.state.pruebas.map(prueba => (
                                            <Link
                                                key="uniqueIdLinkPrueba"
                                                to={`/prueba/${prueba.id_prueba}`}
                                            >
                                                {" "}
                                                <div
                                                    style={{
                                                        color: "#fff",
                                                        backgroundColor:
                                                            "green",
                                                        marginLeft: "35%",
                                                        marginRight: "35%",
                                                        width: "30%"
                                                    }}
                                                    className="btn btn-primary btn-lg btn-block waves-effect waves-light"
                                                >
                                                    Comenzar
                                                </div>
                                            </Link>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>
                    )
                ) : (
                    ""
                )}
            </div>
        );
    }
}

const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated,
    user: state.user
});

export default connect(mapStateToProps)(Dashboard);
