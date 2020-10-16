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

                    <?php
                    /* Filtros */
                    $selectedAberta = (isset($_GET['status']) && $_GET['status'] == 1) ? 'selected' : '';
                    $selectedAndamento = (isset($_GET['status']) && $_GET['status'] == 2) ? 'selected' : '';
                    $selectedSelecionado = (isset($_GET['status']) && $_GET['status'] == 3) ? 'selected' : '';
                    $selectedEncerrada = (isset($_GET['status']) && $_GET['status'] == 4) ? 'selected' : '';
                    $selectedExcluida = (isset($_GET['status']) && $_GET['status'] == 5) ? 'selected' : '';
                    ?>

                    <div class="card-body">
                        <div class='row' style='text-align: center'>
                            <div class='col-sm-2 col-md-2'>
                                <label>Status</label>
                                <select type="text" class="form-control" id="filtro_status" name='filtro_status' placeholder="Status">
                                    <option value="">Todos</option>
                                    <option value="1" <?=$selectedAberta?>>Vaga aberta</option>
                                    <option value="2" <?=$selectedAndamento?>>Processo em andamento</option>
                                    <option value="3" <?=$selectedSelecionado?>>Candidato selecionado</option>
                                    <option value="4" <?=$selectedEncerrada?>>Vaga encerrada</option>
                                    <option value="5" <?=$selectedExcluida?>>Vaga excluída</option>
                                </select>
                            </div>
                            <div class='col-sm-2 col-md-2'>
                                <label>Data Inicial</label>
                                <input type='date' class='form-control' value="<?=$_GET['dtCadastroInicial'] ?? ''?>" id='filtro_dtCadastroInicial' name='filtro_dtCadastroInicial'>
                            </div>
                            <div class='col-sm-2 col-md-2'>
                                <label>Data Final</label>
                                <input type='date' class='form-control' value="<?=$_GET['dtCadastroFinal'] ?? ''?>" id='filtro_dtCadastroFinal' name='filtro_dtCadastroFinal'/>
                            </div>
                            <div class='col-sm-2 col-md-2'>

                                <?
                                $salarioInicial = $_GET['salarioInicial'] ?? '';
                                ?>

                                <label>Salário Inicial</label>
                                <input type='text' value='<?=$salarioInicial?>' class='form-control' id='filtro_salarioInicial' name='filtro_salarioInicial' placeholder='0,00'/>
                            </div>
                            <div class='col-sm-2 col-md-2'>

                                <?
                                $salarioFinal = $_GET['salarioFinal'] ?? '';
                                ?>

                                <label>Salário Final</label>
                                <input type='text' value='<?=$salarioFinal?>' class='form-control' id='filtro_salarioFinal' name='filtro_salarioFinal' placeholder='0,00'/>
                            </div>
                            <div class='col-sm-2 col-md-2'>
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
                                    <th>Status</th>
                                    <th>Data de Cadastro</th>
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
            <h4 class="modal-title" id="gridSystemModalLabel">Formulário de Vaga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

            <form role="form">

                <input type="hidden" id="id" name="id">

                <div class="row">
                    <div class="col-md-12">
                        <label for="nome">Cargo</label>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase().trimStart();" class="form-control" id="cargo" name="cargo" placeholder="Cargo">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="salario">Salário</label>
                        <input type="text" class="form-control" id="salario" name="salario" placeholder="Salário">
                    </div>

                    <div class="col-md-6">
                        <label for="disp_horario">Disponibilidade de Horário</label>
                        <select type="text" class="form-control" id="disp_horario" name='disp_horario' placeholder="Disponibilidade de Horário">
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="pcd">PCD</label>
                        <select type="text" class="form-control" id="pcd" name='pcd' placeholder="PCD">
                            <option value="">Selecione</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="cnh">CNH</label>
                        <select type="text" class="form-control" id="cnh" name='cnh' placeholder="CNH">
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="reg_contrato">Regime de Contrato</label>
                        <select type="text" class="form-control" id="reg_contrato" name='reg_contrato' placeholder="Regime de Contrato">
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tempo_experiencia">Tempo de experiência</label>
                        <input type="text" class="form-control" id="tempo_experiencia" name="tempo_experiencia" placeholder="Tempo de Experiência">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="escolaridade">Escolaridade</label>
                        <select type="text" class="form-control" id="escolaridade" name='escolaridade' placeholder="Escolaridade">
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="estado">Estado</label>
                        <select type="text" class="form-control" id="estado" name='estado' placeholder="Estado" onchange='carregarCidades(this.value)'>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="cidade">Cidade</label>
                        <select type="text" class="form-control" id="cidade" name='cidade' placeholder="Cidade">
                            <option value=''>Selecione um estado</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>Benefícios</label>
                        <div class='beneficios' name='beneficios'></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="descricao">Descrição da Vaga</label>
                        <textarea class='form-control' rows="5" id='descricao' name='descricao'></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="responsabilidades">Responsabilidades</label>
                        <textarea class='form-control' rows="5" id='responsabilidades' name='responsabilidades'></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="atribuicoes">Atribuições</label>
                        <textarea class='form-control' rows="5" id='atribuicoes' name='atribuicoes'></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="obs_cargo">Observações requeridas para o cargo</label>
                        <textarea class='form-control' rows="5" id='obs_cargo' name='obs_cargo'></textarea>
                    </div>
                </div>

                <div class='modal-footer'>
                    <input type='button' class="btn btn-primary" onclick="salvarDados()" value='Salvar Dados'/>
                </div>

            </form>
        </div>
    </div>
  </div>
</div>

<script src="./pages/vagas/main.js"></script>