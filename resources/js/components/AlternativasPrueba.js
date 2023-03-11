import React, { Component } from "react";
import Spinner from "./spinner";
import Http from "../Http";
import Swal from "sweetalert2";
export default class AlternativasPrueba extends Component {
    _isMounted = false;
    constructor(props) {
        super(props),
            (this.state = {
                alternativas: [],
                cargando: false,
                selected: 0,
                pruebas: []
            });
    }

    componentDidMount() {
        this._isMounted = true;
        const idPregunta = this.props.id_pregunta;
        this.setState({ cargando: true });

        Http.get(`/api/prueba/alternativas_pregunta/${idPregunta}`)
            .then(response => {
                if (this._isMounted) {
                    this.setState({
                        alternativas: response.data,
                        cargando: false
                    });
                }
            })
            .catch(() => {
                this.setState({
                    error: "Unable to fetch data."
                });
            });
    }
    componentWillUnmount() {
        this._isMounted = false;
    }
    handleClick(id_alternativa, event) {
        this.setState({ selected: id_alternativa });
        const idPregunta = this.props.id_pregunta;
        Http.get(`/api/prueba/guardar_respuesta/${id_alternativa}`)
            .then(response => {
                Http.get(`/api/prueba/alternativas_pregunta/${idPregunta}`)
                    .then(response => {
                        this.setState({
                            alternativas: response.data,
                            cargando: false
                        });
                    })
                    .catch(() => {
                        this.setState({
                            error: "Unable to fetch data."
                        });
                    });
            })
            .catch(error => {
                console.log(error.response);
                Swal.fire(
                    "Algo a sucedido",
                    error.response.data.message,
                    "error"
                );
            });
    }

    changeSelected(id) {}

    render() {
        function AlternativaChecked(props) {
            if (props.checked === "checked") {
                return (
                    <span>
                        <input
                            checked
                            onChange={e => {
                                changeSelected(props.value);
                            }}
                            type="radio"
                            value={props.value}
                            name={props.name}
                            className="custom-control-input"
                            id={props.value}
                        />
                        <label
                            className="custom-control-label"
                            htmlFor={props.value}
                        >
                            {props.descripcion}
                        </label>
                    </span>
                );
            } else {
                return (
                    <span>
                        <input
                            type="radio"
                            value={props.value}
                            name={props.name}
                            className="custom-control-input"
                            id={props.value}
                        />
                        <label
                            className="custom-control-label"
                            htmlFor={props.value}
                        >
                            {props.descripcion}
                        </label>
                    </span>
                );
            }
        }

        return (
            <div>
                {this.state.cargando ? (
                    <Spinner />
                ) : (
                    this.state.alternativas.map(alternativa => (
                        <div
                            key={alternativa.id}
                            className="custom-control custom-checkbox"
                            onClick={e => this.handleClick(alternativa.id, e)}
                        >
                            <AlternativaChecked
                                checked={alternativa.selected}
                                selected={this.state.selected}
                                value={alternativa.id}
                                name={alternativa.id_pregunta}
                                descripcion={
                                    alternativa.descripcion_alternativa
                                }
                            />
                        </div>
                    ))
                )}
            </div>
        );
    }
}
