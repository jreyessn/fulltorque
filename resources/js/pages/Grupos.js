import React, { useEffect } from 'react';

export default function AcccessibleTable() {
    // Cargar vista de blade
    useEffect(() => {
      $('#renderLaravelBlade').load("/grupos_content")
    }, []);
    
  return (
    <>
      <div id="renderLaravelBlade"></div>
    </>
  );
}