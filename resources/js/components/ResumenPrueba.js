import React, { useEffect, useState } from "react";
import Temporizador from "./Temporizador";
import Http from "../Http";
import LinearProgress from "@material-ui/core/LinearProgress";

const ResumenPrueba = props => {
    const [resultados, setResultados] = useState([]);

    useEffect(() => {
        const interval = setInterval(() => {
            const fetchPosts = async () => {
                Http.get(`/api/prueba/resultado_prueba/${props.id_prueba}`)
                    .then(response => {
                        setResultados(response.data);
                    })
                    .catch(() => {});
            };
            fetchPosts();
        }, 1000);
        return () => clearInterval(interval);
    }, []);

    return (
        <div className="col-sm-12 col-xl-3 pl-lg-2">
            <div
                className="card mb-0"
                style={{
                    height: "100%",
                    marginBottom: "0px !important"
                }}
            >
                <div className="card-heading p-4">
                    <div className="mini-stat-icon float-right">
                        <i className="mdi mdi-briefcase-check bg-success text-white"></i>
                    </div>
                    <div>
                        <h5 className="font-16">Resumen Prueba</h5>
                    </div>
                    {resultados
                        ? resultados.map(resumen => (
                              <h3 key={resumen} className="mt-4">
                                  {resumen.respuestas_usuario}/
                                  {resumen.cantidad_preguntas}
                              </h3>
                          ))
                        : ""}

                    {resultados
                        ? resultados.map(resumen => (
                              <LinearProgress
                                  key={resumen}
                                  variant="determinate"
                                  value={
                                      (100 / resumen.cantidad_preguntas) *
                                      resumen.respuestas_usuario
                                  }
                              />
                          ))
                        : ""}

                    {resultados
                        ? resultados.map(resumen => (
                              <p className="text-muted mt-2 mb-0" key={resumen}>
                                  Completado
                                  <span className="float-right">
                                      {(
                                          (100 / resumen.cantidad_preguntas) *
                                          resumen.respuestas_usuario
                                      ).toFixed()}{" "}
                                      %
                                  </span>
                              </p>
                          ))
                        : ""}
                    <Temporizador />
                </div>
            </div>
        </div>
    );
};

export default ResumenPrueba;
{
    /* 

class ResumenPrueba extends React.Component {
    constructor(props) {
        super(props);
        this.state = { resultados: [], id_prueba: this.props.id_prueba };
    }

    componentDidMount() {
        this.inter = setInterval(() => {
            Http.get(`api/prueba/resultado_prueba/${this.state.id_prueba}`)
                .then(response => {
                    this.setState({ pruebas: response.data });
                })
                .catch(() => {
                    this.setState({
                        error: "Unable to fetch data."
                    });
                });
        }, 2000);
    }

    componentWillUnmount() {
        clearInterval(this.inter);
    }

    render() {
        return (
            
        );
    }
}

export default ResumenPrueba;
*/
}
