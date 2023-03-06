import Http from "../Http";
import React, { useEffect, useState } from "react";
import AlternativasPrueba from "./AlternativasPrueba";
import { EnviarPrueba } from "./EnviarPrueba";

const Preguntas = ({ preguntas, loading, id_prueba, setPosts }) => {
    /**
     * States para las preguntas
     */
    const [alternativas, setAlternativas] = useState([]);
    const [resultados, guardarResultados] = useState([]);

    const [revision, guardarRevision] = useState({
        revisada: false
    });

    //Si cambiamos el state a true mostramos las incorrectas
    const { revisada } = revision;

    function AlternativasPregunta(props) {
        return (
            <AlternativasPrueba
                key={props.id_pregunta + 120220}
                id_pregunta={props.id_pregunta}
            />
        );
    }
	
	console.log(preguntas);
	
    return (
        <div>
            {preguntas.map(pregunta => (
                <div
                    key={pregunta.numero_pregunta_prueba}
                    className={`box ${
                        revisada
                            ? pregunta.correcta
                                ? "list-group-item p-1"
                                : "list-group-item border border-danger p-1"
                            : "list-group-item p-1"
                    }`}
                    style={{
                        border: "1px solid #e4e4e6",
                        boxShadow: "0px 0px 13px 0px rgba(236, 236, 241, 0.44)",
                        borderRadius: 5,
                        marginBottom: "5px",
                        paddingLeft: "3%",
                        paddingRight: "3%",
                        width: "100%"
                    }}
                >
                    <h6>
                        <div key="div!2">
                            {pregunta.numero_pregunta_prueba} :{" "}
                            {pregunta.enunciado_pregunta}
                        </div>
                    </h6>

                    <AlternativasPregunta
                        key={pregunta.id}
                        id_pregunta={pregunta.id_pregunta}
                    />
                </div>
            ))}

            <nav>
                <EnviarPrueba
                    pruebaLink={id_prueba}
                    guardarRevision={guardarRevision}
                    guardarResultados={guardarResultados}
                    setPosts={setPosts}
                />
            </nav>
        </div>
    );
};

export default Preguntas;
