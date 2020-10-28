<div class="content-header"></div>
    <div class="content">
        <div class="container-fluid">
            <? if(isset($_SESSION['tipo_perfil']) && $_SESSION['tipo_perfil'] == 1) { ?>
                <div class='row'>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3 class='qtdCandidatos'>0</h3>
                                <p>Candidato(s) cadastrado(s)</p>
                            </div>
                            <a href="index.php?pg=clientes" class="small-box-footer">
                                Ver mais <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3 class='qtdVagas'>0</h3>
                                <p>Vaga(s) cadastrada(s)</p>
                            </div>
                            <a href="index.php?pg=vagas" class="small-box-footer">
                                Ver mais <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <? } else { ?>
                <div class='row'>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3 class='atualizarDados'>Meus Dados</h3>
                                <p>A sua última atualização de dados foi em: <span class='dtAtualizacaoDados'></span>. <br>
                                Mantenha seus dados atualizados.</p>
                            </div>
                            <a href="index.php?pg=meus-dados" class="small-box-footer">
                                Atualizar dados <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3 class='qtdVagasCandidato'>0 Vaga(s) Aberta(s)</h3>
                                <p>Confira e cadastre-se nas vagas <br>
                                que se adequarem ao seu perfil.</p>
                            </div>
                            <a href="index.php?pg=vagas-candidato" class="small-box-footer">
                                Ver mais <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4> Minhas Candidaturas </h4>
                        <hr>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 minhasCandidaturas" style='display: contents;'>
                        <i> Você não está participando de nenhum processo seletivo. </i>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</div>

<script src="./pages/admin/main.js"></script>