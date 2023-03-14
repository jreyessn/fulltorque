import React, { useEffect, useState } from "react";
import CabeceraPrueba from "../components/CabeceraPrueba";
import ResumenPrueba from "../components/ResumenPrueba";
import { connect } from "react-redux";
import { fetchUser } from "../services/authService";
import Http from "../Http";

function Prueba(props) {
    const {
        isAuthenticated,
        user,
        dispatch,
        match: { params }
    } = props;

    const [revision, guardarRevision] = useState({
        revisada: false
    });
    const [posts, setPosts] = useState([]);

    //Si cambiamos el state a true mostramos las incorrectas
    const { revisada } = revision;

    useEffect(() => {
        const fetchPosts = async () => {
            const res = await Http.get(
                "/api/prueba/preguntas_prueba/" + params.id
            );
            setPosts(res.data);
        };

        fetchPosts();

    }, []);

    useEffect(() => {
        const fetchStart = async () => {
            const res_time = await Http.get(
                "/api/prueba/time/" + params.id
            );

            if(res_time.data?.start_status == false){
                await Http.put(
                    "/api/prueba/start_prueba/" + params.id
                );                
            }
        };

        fetchStart();

    }, []);

    useEffect(() => {
        if (isAuthenticated && !user.id) {
            dispatch(fetchUser());
        }
    }, [isAuthenticated]);

    return (
        <div>
            <div className="row">
                {user.presento ? (
                    ""
                ) : (
                    <>
                        <div className="col-12 grid-preguntas">
                            <CabeceraPrueba 
                                id_prueba={params.id} 
                                revisada={revisada}
                                posts={posts}
                            />
                            <ResumenPrueba 
                                id_prueba={params.id} 
                                guardarRevision={guardarRevision}
                                setPosts={setPosts}  
                            />
                        </div>
                    </>
                )}
            </div>
        </div>
    );
}

{
    /* class Prueba extends Component {
    constructor(props) {
        super(props),
            (this.state = {
                id_prueba: this.props.location.pruebaLink,
                avanza: false
            });
    }

    componentDidMount() {
        localStorage.setItem("avanza", true);
    }

    render() {
        const {
            match: { params }
        } = this.props;
        return (
            <div>
                <div className="row">
                    {this.props.user.presento ? (
                        ""
                    ) : (
                        <>
                            <div className="col-sm-12 col-xl-9 pr-lg-0 mb-3">
                                <CabeceraPrueba id_prueba={params.id} />
                            </div>
                            <ResumenPrueba id_prueba={params.id} />
                        </>
                    )}
                </div>
            </div>
        );
    }
}*/
}
const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated,
    user: state.user
});

export default connect(mapStateToProps)(Prueba);
