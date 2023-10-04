import Home from "../pages/Home";
import Login from "../pages/Login";
import Dashboard from "../pages/Dashboard";
import NoMatch from "../pages/NoMatch";
import Prueba from "../pages/Prueba";
import Gracias from "../pages/Gracias";
import Panel from "../pages/Panel";
import Usuarios from "../pages/Usuarios";
import Grupos from "../pages/Grupos";
import Gestion_usuarios from "../pages/Grupos_usuarios";

const routes = [
    {
        path: "/",
        exact: true,
        auth: true,
        component: Dashboard,
        fallback: Home
    },
    {
        path: "/login",
        exact: true,
        auth: false,
        component: Login
    },
    {
        path: "/gracias",
        exact: true,
        auth: false,
        component: Gracias
    },
    {
        path: "/prueba/:id",
        exact: false,
        auth: true,
        component: Prueba,
        fallback: Home
    },
    {
        path: "/panel",
        exact: false,
        auth: true,
        component: Panel,
        fallback: Home
    },
    {
        path: "/grupos_usuarios",
        exact: false,
        auth: true,
        component: Grupos,
        fallback: Home
    },
    {
        path: "/gestion_usuarios/:id",
        exact: false,
        auth: true,
        component: Gestion_usuarios,
        fallback: Home
    },    
    {
        path: "/usuarios",
        exact: false,
        auth: true,
        component: Usuarios,
        fallback: Home
    },

    {
        path: "",
        exact: false,
        auth: false,
        component: NoMatch
    }
];

export default routes;
