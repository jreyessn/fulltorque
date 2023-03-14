import React, { useEffect, useState } from "react";
import "toasted-notes/src/styles.css";
import { connect, useDispatch } from "react-redux";
import * as actions from "../store/actions";
import Http from "../Http";

function Temporizador(props) {
    const [remainingSeconds, setRemainingSeconds] = useState(3600);
    const dispatch = useDispatch();

    useEffect(() => {
      if (remainingSeconds > 0) {
        const timerId = setInterval(() => {
            setRemainingSeconds(remainingSeconds => remainingSeconds - 1);
            dispatch(actions.notification({ noti: `Hola te queda ${minutes}` }));
        }, 1000);
        
        return () => clearInterval(timerId);
      }
    }, [remainingSeconds]);

    useEffect(() => {
        const fetchStart = async () => {
            const res_time = await Http.get(
                "/api/prueba/time/" + props.id_prueba
            );
            const time_transcurrido = res_time.data?.time || 0

            setRemainingSeconds(remainingSeconds - time_transcurrido)
        };
        fetchStart();
    }, []);
    
    const hours = Math.floor(remainingSeconds / 3600);
    const minutes = Math.floor((remainingSeconds % 3600) / 60);
    const seconds = remainingSeconds % 60;
    
    return (
      <>
        {hours < 10 ? '0' + hours : hours} : {minutes < 10 ? '0' + minutes : minutes} : {seconds < 10 ? '0' + seconds : seconds}
      </>
    );
}
const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated,
    user: state.user
});

export default connect(mapStateToProps)(Temporizador);
