import Http from "../Http";
import React, { useEffect, useState } from "react";
import Preguntas from "./Preguntas";
import Pagination from "./Pagination";
const CabeceraPrueba = props => {
    const [pageOfItems, setPageOfItems] = useState([]);
    const [posts, setPosts] = useState([]);
    const [loading, setLoading] = useState(false);
    const [currentPage, setCurrentPage] = useState(1);
    const [postsPerPage] = useState(3);

    const idPrueba = props.id_prueba;

    useEffect(() => {
        const fetchPosts = async () => {
            setLoading(true);
            const res = await Http.get(
                "/api/prueba/preguntas_prueba/" + idPrueba
            );
            setPosts(res.data);
            setLoading(false);
        };

        fetchPosts();
    }, []);

    function changeCurrPage(pageOfItems) {
        setPageOfItems(pageOfItems);
    }

    // Get current posts
    const indexOfLastPost = currentPage * postsPerPage;
    const indexOfFirstPost = indexOfLastPost - postsPerPage;
    const currentPosts = posts.slice(indexOfFirstPost, indexOfLastPost);

    // Change page
    const paginate = pageNumber => setCurrentPage(pageNumber);

    return (
        <div>
            <div
                className="card mb-0"
                style={{
                    height: "100%",
                    marginBottom: "0px !important"
                }}
            >
                <div className="card-heading p-1">
                    <Preguntas
                        preguntas={pageOfItems}
                        loading={loading}
                        id_prueba={props.id_prueba}
                        setPosts={setPosts}
                    />

                    <div className="mt-0">
                        <Pagination
                            items={posts}
                            onChangePage={changeCurrPage.bind(this)}
                        />
                    </div>
                </div>
            </div>
        </div>
    );
};

export default CabeceraPrueba;
