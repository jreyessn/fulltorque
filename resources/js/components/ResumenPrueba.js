import React, { useEffect, useState } from "react";
import Temporizador from "./Temporizador";
import Http from "../Http";
import LinearProgress from "@material-ui/core/LinearProgress";
import { EnviarPrueba } from "./EnviarPrueba";
import { connect } from "react-redux";

const ResumenPrueba = props => {
    const [resultados, setResultados] = useState([]);
    const { guardarRevision, setPosts } = props

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
        <div className="preguntas-block-resume">
            <div className="card px-3 pt-1 mb-6">
                <h6 className="mt-2 mb-0">Resumen Prueba</h6>
    
                <div className="mail-list m-t-10">
                    <a href="#"> <span className="float-right"></span> <i className="ti-user mr-2"></i> {props.user?.name || ''} </a>
                    <a href="#"> 
                        <span className="float-right">
                            {resultados
                                ? resultados.map(resumen => (
                                    <span key={resumen}>
                                        {resumen.respuestas_usuario}/ {resumen.cantidad_preguntas}
                                    </span>
                                ))
                                : ""}
                        </span> 
                        <i className="ti-check mr-2"></i> Respuestas </a>
                    <a href="#" className="text-primary">
                        <span className="float-right"><Temporizador id_prueba={props.id_prueba} /></span>
                    <i className="ti-time mr-2"></i> Tiempo</a>
    
                </div>
    
                <h6 className="mt-2">Progreso</h6>
    
                <div className="mail-list mt-1">
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
                            <p className="text-primary font-bold mt-2 mb-0" key={resumen}>
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
                </div>
    
                <EnviarPrueba
                    pruebaLink={props.id_prueba}
                    guardarRevision={guardarRevision}
                    setPosts={setPosts}
                />
            </div>
        </div>
    );
};

const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated,
    user: state.user
});

export default connect(mapStateToProps)(ResumenPrueba);

    /* 

className ResumenPrueba extends React.Component {
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
