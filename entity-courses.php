<?

  $entity = get_custom_value("nau-id");
  
  $courses = nau_get_pages("courses", ["owner" => $entity]);
?>

<pre>
<?  
  print_r($courses);
?>
</pre>

  <section id=="entity-courses">  
    <h3>Cursos <a href="">INA</a></h3>
    <!-- starts curso em destaque #1 -->
    <ul>
      <li>
        <h3>Curso #1</h3>
        <p>pre&ccedil;o | Certificado</p>
        <p>In&iacute;cio do curso</p>
        <p>x Participantes</p>
      </li>
      <li> <a href="#" title="Ver vídeo de apresentção">V&iacute;deo</a> <a href="#" title="Saiba mais acerca do curso">Saber +</a> <a href="#" title="Iniciar curso">Iniciar</a> </li>
    </ul>
    <!-- ends curso em destaque #1 --> 
    <!-- starts curso em destaque #2 -->
    <ul>
      <li>
        <h3>Curso #2</h3>
        <p>pre&ccedil;o | Certificado</p>
        <p>In&iacute;cio do curso</p>
        <p>x Participantes</p>
      </li>
      <li> <a href="#" title="Ver vídeo de apresentção">V&iacute;deo</a> <a href="#" title="Saiba mais acerca do curso">Saber +</a> <a href="#" title="Iniciar curso">Iniciar</a> </li>
    </ul>
    <!-- ends curso em destaque #2 --> 
    <!-- starts curso em destaque #3 -->
    <ul>
      <li>
        <h3>Curso #3</h3>
        <p>pre&ccedil;o | Certificado</p>
        <p>In&iacute;cio do curso</p>
        <p>x Participantes</p>
      </li>
      <li> <a href="#" title="Ver vídeo de apresentção">V&iacute;deo</a> <a href="#" title="Saiba mais acerca do curso">Saber +</a> <a href="#" title="Iniciar curso">Iniciar</a> </li>
    </ul>
    <!-- ends curso em destaque #3 -->    
  </section>
  <!-- ends all institution courses -->
