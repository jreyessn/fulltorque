import React, { useEffect } from 'react';

export default function AcccessibleTable() {
    // Si te da flojera usar react porque crees que el anterior programador se mamó haciendolo asi, carga tus plantillas de blade esta manera xd
    useEffect(() => {
      $('#renderLaravelBlade').load("/usuarios_content")
    }, []);
    
  return (
    <>
      <div id="renderLaravelBlade"></div>
    </>
  );
}