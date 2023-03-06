import React, { Component } from "react";
import * as actions from "../store/actions";
import toaster from "toasted-notes";
import "toasted-notes/src/styles.css";
import { connect, useDispatch } from "react-redux";

class Temporizador extends Component {
    state = {
        timerOn: false,
        timerStart: 3600000,
        timerTime: 3600000,
        notification: 60000,
        isAvance: false
    };

    startTimer = () => {};

    componentDidMount() {
        this.setState({
            timerOn: true,
            timerTime: this.state.timerTime,
            timerStart: this.state.timerTime
        });

        this.timer = setInterval(() => {
            let newTime = this.state.timerTime - 10;

            if (newTime >= 0) {
                this.setState({
                    timerTime: newTime
                });
            } else {
                clearInterval(this.timer);
                this.setState({ timerOn: false });
            }
        }, 10);

        this.setState({ isAvance: true });

        setInterval(() => {
            const { timerTime, timerStart, timerOn } = this.state;
            let seconds = (
                "0" +
                (Math.floor((timerTime / 1000) % 60) % 60)
            ).slice(-2);
            let minutes = ("0" + Math.floor((timerTime / 60000) % 60)).slice(
                -2
            );
            let hours = ("0" + Math.floor((timerTime / 3600000) % 60)).slice(
                -2
            );
            this.props.dispatch(
                actions.notification({ noti: `Hola te queda ${minutes}` })
            );
            clearInterval(this.state.notification);
        }, this.state.notification);
    }

    stopTimer = () => {
        clearInterval(this.timer);
        this.setState({ timerOn: false });
    };
    resetTimer = () => {
        if (this.state.timerOn === false) {
            this.setState({
                timerTime: this.state.timerStart
            });
        }
    };

    adjustTimer = input => {
        const { timerTime, timerOn } = this.state;
        if (!timerOn) {
            if (input === "incHours" && timerTime + 3600000 < 216000000) {
                this.setState({ timerTime: timerTime + 3600000 });
            } else if (input === "decHours" && timerTime - 3600000 >= 0) {
                this.setState({ timerTime: timerTime - 3600000 });
            } else if (
                input === "incMinutes" &&
                timerTime + 60000 < 216000000
            ) {
                this.setState({ timerTime: timerTime + 60000 });
            } else if (input === "decMinutes" && timerTime - 60000 >= 0) {
                this.setState({ timerTime: timerTime - 60000 });
            } else if (input === "incSeconds" && timerTime + 1000 < 216000000) {
                this.setState({ timerTime: timerTime + 1000 });
            } else if (input === "decSeconds" && timerTime - 1000 >= 0) {
                this.setState({ timerTime: timerTime - 1000 });
            }
        }
    };

    handleLogout = e => {
        e.preventDefault();
        this.props.dispatch(actions.authLogout());
    };

    render() {
        const { timerTime, timerStart, timerOn } = this.state;
        let seconds = ("0" + (Math.floor((timerTime / 1000) % 60) % 60)).slice(
            -2
        );
        let minutes = ("0" + Math.floor((timerTime / 60000) % 60)).slice(-2);
        let hours = ("0" + Math.floor((timerTime / 3600000) % 60)).slice(-2);

        return (
            <div>
                <h4>
                    {hours} : {minutes} : {seconds}
                </h4>
            </div>
        );
    }
}
const mapStateToProps = state => ({
    isAuthenticated: state.Auth.isAuthenticated,
    user: state.user
});

export default connect(mapStateToProps)(Temporizador);
