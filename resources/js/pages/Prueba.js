import React, { useEffect } from "react";
import CabeceraPrueba from "../components/CabeceraPrueba";
import ResumenPrueba from "../components/ResumenPrueba";
import { connect } from "react-redux";
import { fetchUser } from "../services/authService";

function Prueba(props) {
    const {
        isAuthenticated,
        user,
        dispatch,
        match: { params }
    } = props;

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
