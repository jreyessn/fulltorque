import Http from "../Http";
import React, { useEffect, useState } from "react";
import AlternativasPrueba from "./AlternativasPrueba";
import { EnviarPrueba } from "./EnviarPrueba";

const Preguntas = ({ preguntas, revisada }) => {

    function AlternativasPregunta(props) {
        return (
            <AlternativasPrueba
                key={props.id_pregunta + 120220}
                id_pregunta={props.id_pregunta}
            />
        );
    }
		
    return (
        <div>
            {preguntas.map(pregunta => (
                <>
                    <div 
                        key={pregunta.numero_pregunta_prueba}
                        className={`pr-3 pl-3 pt-2 ${
                            revisada
                                ? pregunta.correcta
                                    ? "border border-success"
                                    : "border border-danger"
                                : ""
                        }`}>
                        <h6 className="title">{pregunta.numero_pregunta_prueba}. {pregunta.enunciado_pregunta}</h6>
                        <div className="description text-muted">
                            <AlternativasPregunta
                                key={pregunta.id}
                                id_pregunta={pregunta.id_pregunta}
                            />
                        </div>
                        <div className="dropdown-divider"></div>
                    </div>
                </>
            ))}
        </div>
    );
};

export default Preguntas;
