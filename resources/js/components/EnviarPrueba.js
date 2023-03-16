import React, { useState, useEffect } from "react";
import { useHistory } from "react-router-dom";
import Swal from "sweetalert2";
import Http from "../Http";
import * as actions from "../store/actions";
import { connect, useDispatch } from "react-redux";
import { Loader } from "./overlay";

export const EnviarPrueba = ({
    pruebaLink,
    guardarRevision,
    guardarResultados,
    setPosts
}) => {
    const [resultados, setResultados] = useState([]);
    const [intento, setIntentos] = useState({ intento: 0 });
    let history = useHistory();
    const [active, setActive] = useState(false);
    useEffect(() => {
        const interval = setInterval(() => {
            const fetchPosts = async () => {
                Http.get(`/api/prueba/resultado_prueba/${pruebaLink}`)
                    .then(response => {
                        setResultados(response.data);
                    })
                    .catch(() => {});
            };
            fetchPosts();
        }, 1000); 
        return () => clearInterval(interval);
    }, []);

    const dispatch = useDispatch();

    const handleLogout = props => {
        dispatch(actions.authLogout());
        history.push("/");
    };

    function enviarPruebaClick() {
        const cant_preguntas = resultados[0].cantidad_preguntas;
        const cant_respuestas = resultados[0].respuestas_usuario;
        const cant_respuestas_correctas = resultados[0].respuestas_correctas;

        const porcentaje_aprobacion =
            (100 / cant_preguntas) * cant_respuestas_correctas;

        const title_aprobado = `De momento, está aprobando con un ${porcentaje_aprobacion.toFixed()}%`;

        const title_reprobado = `De momento, está reprobando con un ${porcentaje_aprobacion.toFixed()}%. No cumple con el 80% requerido.`;

        const text_aprobado = `Sin embargo, tiene un intento para corregir las respuestas incorrectas (marcadas con rojo) y mejorar su rendimiento.`;

        const text_reprobado = `Sin embargo, tiene un intento para corregir las respuestas incorrectas (marcadas con rojo) y mejorar su rendimiento.`;
		
		const message =
            porcentaje_aprobacion.toFixed() >= 80
                ? text_aprobado
                : text_reprobado;

        const title =
            porcentaje_aprobacion.toFixed() >= 80
                ? title_aprobado
                : title_reprobado;

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success p-2 mr-2",
                cancelButton: "btn btn-danger p-2 ml-2"
            },
            buttonsStyling: false
        });

        setIntentos({
            intento: +1
        });

        if (intento.intento == 1 || porcentaje_aprobacion.toFixed() == 100) {
            setActive(true);
            setTimeout(() => {
                setActive(false);

                const cant_respuestas_correctas =
                    resultados[0].respuestas_correctas;

                const porcentaje_aprobacion =
                    (100 / cant_preguntas) * cant_respuestas_correctas;

                const title_primary = `Enhorabuena, usted aprobó el examen con un ${porcentaje_aprobacion.toFixed()} %`;

                const text_secondary = `Usted no consiguió el 80% de aprobación requerido. Reprobó con un ${porcentaje_aprobacion.toFixed()}%`;

                const message =
                    porcentaje_aprobacion.toFixed() >= 80
                        ? title_primary
                        : text_secondary;

                const message_title_one = `¡Felicidades! Ha aprobado`;
                const message_title_two = `Lo lamentamos. No aprobó`;

                const titulo =
                    porcentaje_aprobacion.toFixed() >= 80
                        ? message_title_one
                        : message_title_two;

                const type =
                    porcentaje_aprobacion.toFixed() >= 80 ? "success" : "error";

                swalWithBootstrapButtons
                    .fire(titulo, message, type)
                    .then(result => {
                        if (result.value) {
                            Http.get(
                                `/api/prueba/guardar_prueba_rendida/${pruebaLink}`
                            )
                                .then(response => {
                                    history.push("/gracias");
                                })
                                .catch(error => {
                                    console.log(error.response);
                                    Swal.fire(
                                        "Algo ha sucedido",
                                        error.response.data.message,
                                        "error"
                                    );
                                });
                        }
                    });
            }, 2000);

            return false;
        }

        swalWithBootstrapButtons
            .fire({
                title: title,
                text: message,
                icon: "warning",
                showCancelButton: intento.intento == 1 ? false : true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Enviar de todas formas.",
                cancelButtonText: "Quiero revisar"
            })
            .then(result => {
                if (result.value) {
                    const cant_respuestas_correctas =
                        resultados[0].respuestas_correctas;

                    const porcentaje_aprobacion =
                        (100 / cant_preguntas) * cant_respuestas_correctas;

                    const title_primary = `Enhorabuena, usted aprobó el examen con un ${porcentaje_aprobacion.toFixed()} %`;

                    const text_secondary = `Usted no consiguió el 80% de aprobación requerido. Reprobó con un ${porcentaje_aprobacion.toFixed()}%`;

                    const message =
                        porcentaje_aprobacion.toFixed() >= 80
                            ? title_primary
                            : text_secondary;

                    const message_title_one = `¡Felicidades! Ha aprobado`;
                    const message_title_two = `Lo lamentamos. No aprobó`;

                    const titulo =
                        porcentaje_aprobacion.toFixed() >= 80
                            ? message_title_one
                            : message_title_two;

                    const type =
                        porcentaje_aprobacion.toFixed() >= 80
                            ? "success"
                            : "error";
                    setActive(true);
                    setTimeout(() => {
                        setActive(false);
                        swalWithBootstrapButtons
                            .fire(titulo, message, type)
                            .then(result => {
                                if (result.value) {
                                    Http.get(
                                        `/api/prueba/guardar_prueba_rendida/${pruebaLink}`
                                    )
                                        .then(response => {
                                            history.push("/gracias");
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
                            });
                    }, 2000);
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
					const fetchPosts = async () => {
                        const res = await Http.get(
                            "/api/prueba/preguntas_prueba/" + pruebaLink
                        );
                        setPosts(res.data);
                        guardarRevision({
                            revisada: true
                        });
                    };

                    fetchPosts();
                }
            });
    }

    return (
        <div>
            <Loader loaded={active} />
            <button
                type="button"
                onClick={() => enviarPruebaClick(pruebaLink)}
                className="mt-2 btn btn-success rounded btn-custom btn-block waves-effect waves-light"
            >
                Finalizar Prueba
            </button>
        </div>
    );
};

const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated,
    user: state.Auth.user
});

export default connect(mapStateToProps)(EnviarPrueba);
