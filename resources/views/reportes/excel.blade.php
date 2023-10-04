<html>
  <meta charset="utf-8">
<table>
    <thead>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr>
            <td></td>
            <td align="center" colspan="10">
              <h1><strong>REPORTE CURSO</strong></h1>
            </td>
               
        </tr>
        <tr>
            <td></td>
            <td align="center" colspan="10">
              <h3><strong>USO CORRECTO Y SEGURO DE HERRAMIENTAS CRITICAS DE MINERIAS</strong></h3>
            </td>
               
        </tr>
        <tr>      
        </tr>
        <tr>
            <td></td>
            <td align="center" colspan="1">
              <strong>Cliente</strong>
            </td>
            <td align="center" colspan="2">
              {{ $grupo[0]->cliente }}
            </td>
            <td align="center" colspan="5">
            </td>
            <td align="center" colspan="1">
              <strong>Hora</strong>
            </td>
            <td align="center" colspan="1">
              {{ date("g:i a", strtotime($grupo[0]->hora)) }}
            </td>      
        </tr>
        <tr>
            <td></td>
            <td align="center" colspan="1">
              <strong>Tutor</strong>
            </td>
            <td align="center" colspan="2">
              {{ $grupo[0]->tutor }}
            </td>
            <td align="center" colspan="5">
            </td>
            <td align="center" colspan="1">
              <strong>Fecha</strong>
            </td>
            <td align="center" colspan="1">
              {{ date("d/m/Y", strtotime($grupo[0]->fecha)) }}     
        </tr>
        <tr>
            <td></td>
            <td align="center" colspan="1">
              <strong>Instructor</strong>
            </td>
            <td align="center" colspan="3">
              <strong></strong>
            </td>      
        </tr>
        <tr>      
        </tr>
        <tr>      
        </tr>  
        <tr>
            <td></td>
            <td align="center" bgcolor="#4A86E8">Rut</td>
            <td align="center" bgcolor="#4A86E8">Nombre Participante</td> 
            <td align="center" bgcolor="#4A86E8">Telefono</td>  
            <td align="center" bgcolor="#4A86E8">Email</td>   
            <td align="center" bgcolor="#4A86E8">Estado Prueba</td>  
            <td align="center" bgcolor="#4A86E8">% Prueba</td> 
            <td align="center" bgcolor="#4A86E8">Correctas</td>   
            <td align="center" bgcolor="#4A86E8">Incorrectas</td> 
            <td align="center" bgcolor="#4A86E8">Total Preg</td> 
            <td align="center" bgcolor="#4A86E8">Hora Entrega</td>    
        </tr>    
    </thead> 
    <tbody>
          @foreach($grupos_usuarios as $value) 
        <tr bgcolor="red">
            <td></td>
            <td align="center">{{$value->rut}}</td> 
            <td align="center">{{strtoupper($value->nombre_usuario)}}</td> 
            <td align="center">{{$value->telefono}}</td> 
            <td align="center">{{$value->email}}</td> 
            <?php if($value->porcentaje_respuestas_correctas> 80){ ?>
            <td align="center" bgcolor="green">
                  Aprobado
            </td> 
            <?php }else if($value->porcentaje_respuestas_correctas < 80 && $value->porcentaje_respuestas_correctas > 0){ ?>
            <td align="center" bgcolor="red">
                  Reprobado
            </td>     
            <?php }else{ ?>
             <td align="center" bgcolor="yellow">
                  Pendiente
            </td>     
            <?php } ?>  
            <td align="center">{{round($value->porcentaje_respuestas_correctas)}}</td> 
            <td align="center">{{$value->respuestas_correctas}}</td>
            <td align="center">{{$value->respuestas_incorrectas}}</td>
            <td align="center">{{$value->total_preguntas}}</td>
            <td align="center">
              <?php if($value->end_at == null){ ?>

              <?php }else{ ?>
              {{ date("g:i a", strtotime($value->end_at)) }}
              <?php } ?>
            </td>
        </tr> 
        @endforeach
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
          <td></td>
          <td align="center" colspan="10">Powered by Publigital - www.publigital.cl</td>
        </tr>
    </tbody>   
</table>
</html>


