import React, { useEffect, useState } from "react";
import Preguntas from "./Preguntas";
import Pagination from "./Pagination";
import Http from "../Http";
import { isMobile } from 'react-device-detect';

const CabeceraPrueba = props => {
    const { 
        loading,
        id_prueba,
        posts
    } = props
    const [cabeza, setEncabezado] = useState({});

    useEffect(() => {
        const fetchPrueba = async () => {
            const res = await Http.get(
                "/api/prueba/prueba_id/" + id_prueba
            );
            const { encabezado_prueba } = res.data
            setEncabezado(encabezado_prueba);
        }
    
        fetchPrueba()
    }, [])

    const [pageOfItems, setPageOfItems] = useState([]);

    function changeCurrPage(pageOfItems) {
        setPageOfItems(pageOfItems);
    }

    return (
        <div className="mb-3">

            <div className="card mb-0">

                <div className="row p-3">
                    <div className="col-lg-8">
                        <h6 className="header-title">
                            {cabeza.titulo_prueba || ''}
                        </h6>
                    </div>
                </div>

                <div className="scroll-preguntas">
                    <Preguntas
                            preguntas={isMobile? posts : pageOfItems}
                            loading={loading}
                            id_prueba={id_prueba}
                        />

                    {
                        isMobile? "" :
                        <div className="mt-0">
                            <Pagination
                                items={posts}
                                onChangePage={changeCurrPage.bind(this)}
                            />
                        </div>
                    }
                </div>
            </div>

        </div>
    );
};

export default CabeceraPrueba;
