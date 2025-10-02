
<div class="box-content" style="background:transparent">

<?php 
  if($_SESSION['cargo'] == 3){
?>
  <div class="row">

    <div class="box-single">
      <div class="top">
        <div class="avatar" style="background:tomato">
         <i class="bx bx-line-chart"></i>
        </div>
        <span>Usuários online</span>
        <h2>12</h2>
      </div><!--top-->

      <div class="bottom">
        <p>Nas últimas 24 horas</p>
      </div><!--bottom-->
    </div><!--box-single-->

    
    <div class="box-single">
      <div class="top">
        <div class="avatar" style="background:darkred">
         <i class="bx bx-chart"></i>
        </div>
        <span>Total de visitas</span>
        <h2>25</h2>
      </div><!--top-->

      <div class="bottom">
        <p>Nos últimos 30 dias</p>
      </div><!--bottom-->
    </div><!--box-single-->

    
    <div class="box-single">
      <div class="top">
        <div class="avatar" style="background:lightgreen">
         <i class="bx bx-line-chart"></i>
        </div>
        <span>Usuários online</span>
        <h2>12</h2>
      </div><!--top-->

      <div class="bottom">
        <p>Nas últimas 24 horas</p>
      </div><!--bottom-->
    </div><!--box-single-->

    

  </div><!--row-->
  <?php }else{ ?>


  <h3>Bem vindo ao Nexus 👋</h3>

  <div class="content-nexus-wellcome">
    <div class="row-wellcome">
     <div class="wellcome-left-nexus">
        <img src="<?php echo INCLUDE_PATH_PAINEL ?>img/students.webp" />
     </div><!--wellcome-left-nexus-->

     <div class="wellcome-right-nexus">
        <div class="info-login">
          <h4><?php echo $_SESSION['nome']; ?></h4>
          <h5><?php echo $_SESSION['email']; ?></h5>
          <?php
            if($_SESSION['cargo'] == 1){
          ?>
          <div class="cargo-content">
            <span>Docente</span>
          </div>
          <?php }else if($_SESSION['cargo'] == 2){ ?>
            <div class="cargo-content">
             <span>Ex Estudante</span>
            </div><!--cargo-content-->
           <?php } ?>

            <div class="info-nexus">
              <h1>Plataforma de Gestão e Comunicação</h1>
              <p>Plataforma integrada para gestão e comunicação entre estudantes e docentes, uma solucação 
                para melhorar a comunicacao e gestao academica no campos de Inhamizua
              </p>
           </div><!--info-nexus-->
        </div><!--info-login-->

       
     </div><!--wellcome-right-nexus-->
    </div><!--row-wellcome-->  
  </div><!--content-nexus-wellcome-->
  <?php } ?>
</div><!--box-content-->