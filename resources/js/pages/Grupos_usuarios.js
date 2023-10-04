import React, { useEffect } from 'react';
function Gestion_usuarios(props) {
  const {
        isAuthenticated,
        user,
        dispatch,
        match: { params }
    } = props;
    var id = params.id;
    // Cargar vista de blade
    useEffect(() => {
      $('#renderLaravelBlade').load('/gestion_content/'+id)
    }, []);
    
  return (
    <>
      <div id="renderLaravelBlade"></div>
    </>
  );
}
export default Gestion_usuarios;
