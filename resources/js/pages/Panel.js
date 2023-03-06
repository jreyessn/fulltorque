import React, { useEffect, useState } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import Http from "../Http";
const useStyles = makeStyles({
  table: {
    minWidth: 650,
  },
});



export default function AcccessibleTable() {

    const [resultados, setResultados] = useState([]);

    useEffect(() => {
        const fetchPosts = async () => {
            Http.get(`/api/prueba/resultados_pruebas`)
                .then(response => {
                    setResultados(response.data);
                })
                .catch(() => {
                    this.setState({
                        error: "Unable to fetch data."
                    });
                });
        };
        fetchPosts();
    }, []);
    
  const classes = useStyles();

  return (
    <TableContainer component={Paper}>
      <Table className={classes.table} aria-label="caption table">
        <caption>Listado de pruebas</caption>
        <TableHead>
          <TableRow>
            <TableCell>Nombre</TableCell>
            <TableCell align="right">Respuestas Correctas</TableCell>
            <TableCell align="right">Respuestas Incorrectas</TableCell>
            <TableCell align="right">Total preguntas</TableCell>
            <TableCell align="right">Porcentaje en %</TableCell>
            <TableCell align="right">Estado</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {resultados ?  resultados.map((row) => (
              
            <TableRow key={row.name}>
              <TableCell component="th" scope="row">
                {row.name}
              </TableCell>
              <TableCell align="right">{row.correctas}</TableCell>
              <TableCell align="right">{(row.preguntas - row.correctas).toFixed()}</TableCell>
              <TableCell align="right">{row.preguntas}</TableCell>
              <TableCell align="right">{ ( (100  / row.preguntas) * row.correctas).toFixed()}</TableCell>
              <TableCell align="right">{ ((100  / row.preguntas) * row.correctas).toFixed() >= 80 ? 'Aprobado' : 'Reprobado'  }</TableCell>
            </TableRow>
          )) : ''}
        </TableBody>
      </Table>
    </TableContainer>
  );
}