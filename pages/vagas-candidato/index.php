<style>

    .tituloTabela{
        font-size: 17px;
    }

</style>

<div class="content-header"></div>
    <div class="content">
        <div class="container-fluid">

            <!-- Filtros -->
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        <div class='row'>
                            <div class='col-md-10 col-sm-6 tituloFiltros'>
                                <b> Filtros </b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class='row' style='text-align: center'>
                            <div class='col-sm-3 col-md-3'>
                                <label>PCD</label>
                                <select class='form-control' id='filtro_pcd' name='filtro_pcd'>
                                    <option value=''>Todos</option>
                                    <option value='1' <?= (isset($_GET['pcd']) && $_GET['pcd'] == 1) ? 'selected' : '' ?>>Sim</option>
                                    <option value='0' <?= (isset($_GET['pcd']) && $_GET['pcd'] != '' && $_GET['pcd'] == 0) ? 'selected' : '' ?>>Não</option>
                                </select>
                            </div>
                            <div class='col-sm-3 col-md-3'>
                                <label>Escolaridade</label>
                                <select class='form-control' id='filtro_escolaridade' name='filtro_escolaridade'>
                                </select>
                            </div>
                            <div class='col-sm-3 col-md-3'>
                                <label>Regime Contrato</label>
                                <select class='form-control' id='filtro_regime_contrato' name='filtro_regime_contrato'>
                                </select>
                            </div>
                            <div class='col-sm-3 col-md-3'>
                                <label>Estado</label>
                                <select class='form-control' id='filtro_estado' name='filtro_estado' onchange='carregaFiltroCidades(this.value);'>
                                </select>
                            </div>
                        </div>
                        <div class='row' style='text-align: center'>
                            <div class='col-sm-3 col-md-3'>
                                <label>Cidade</label>
                                <select class='form-control' id='filtro_cidade' name='filtro_cidade'>
                                    <option value=''>Selecione um estado</option>
                                </select>
                            </div>
                            <div class='col-sm-3 col-md-3'>
                                <label>Salário Inicial</label>
                                <input type='text' value='<?= ($_GET['salarioInicial'] ?? '') ?>' class='form-control' id='filtro_salarioInicial' name='filtro_salarioInicial' placeholder='0,00'/>
                            </div>
                            <div class='col-sm-3 col-md-3'>
                                <label>Salário Final</label>
                                <input type='text' value='<?= ($_GET['salarioFinal'] ?? '') ?>' class='form-control' id='filtro_salarioFinal' name='filtro_salarioFinal' placeholder='0,00'/>
                            </div>
                            <div class='col-sm-3 col-md-3'>
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-block bg-gradient-orange" onclick='filtrarVagas()'>Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabela -->
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        <div class='row'>
                            <div class='col-md-10 col-sm-6 tituloTabela'>
                                <b> Vagas </b>
                            </div>
                            <div class='col-md-2 col-sm-6'>
                                <button type="button" class="btn btn-block bg-gradient-orange" data-toggle="modal" data-target="#modalInsercao" data-backdrop="static" data-keyboard="false">Adicionar</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="tabelaVagas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Cargo</th>
                                    <th>Salário</th>
                                    <th>Cidade</th>
                                    <th>Situação</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id='modalInsercao' tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="gridSystemModalLabel">Dados da Vaga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

            <form role="form">

                <input type="hidden" id="id" name="id">

                <div class="row">
                    <div class="col-md-12">
                        <label for="nome">Cargo Ofertado</label>
                        <div id="cargo" name="cargo"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-6">
                        <label for="salario">Salário Ofertado</label>
                        <div id="salario" name="salario"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="disp_horario">Disponibilidade de Horário Requerida</label>
                        <div id="disp_horario" name="disp_horario"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-6">
                        <label for="pcd">Vaga PCD?</label>
                        <div id="pcd" name="pcd"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="cnh">Tipo de CNH Requerida</label>
                        <div id="cnh" name="cnh"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-6">
                        <label for="reg_contrato">Regime de Contrato Ofertado</label>
                        <div id="reg_contrato" name="reg_contrato"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="tempo_experiencia">Tempo de Experiência Requerido</label>
                        <div id="tempo_experiencia" name="tempo_experiencia"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-6">
                        <label for="escolaridade">Escolaridade Requerida</label>
                        <div id="escolaridade" name="escolaridade"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-6">
                        <label for="estado">Estado</label>
                        <div id="estado" name="estado"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="cidade">Cidade</label>
                        <div id="cidade" name="cidade"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-12">
                        <label>Benefícios Oferecidos</label>
                        <div class='beneficios' name='beneficios'></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-12">
                        <label for="descricao">Descrição da Vaga</label>
                        <div id="descricao" name="descricao"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-12">
                        <label for="responsabilidades">Responsabilidades</label>
                        <div id="responsabilidades" name="responsabilidades"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-12">
                        <label for="atribuicoes">Atribuições</label>
                        <div id="atribuicoes" name="atribuicoes"></div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-12">
                        <label for="obs_cargo">Observações requeridas para o cargo</label>
                        <div id="obs_cargo" name="obs_cargo"></div>
                    </div>
                </div>

                <div class='modal-footer'>
                    <input type='button' class="candidatarSe btn btn-primary" onclick="candidatarSe()" value='Candidatar-se'/>
                    <div class='infoCandidatura'></div>
                    <input type='button' class="desfazerCandidatura btn btn-danger" onclick="desafazerCandidatura()" value='Remover Candidatura'/>
                </div>

            </form>
        </div>
    </div>
  </div>
</div>

<script src="./pages/vagas-candidato/main.js"></script>