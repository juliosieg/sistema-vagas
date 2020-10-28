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
                            <div class='col-sm-4 col-md-4'>
                                <label>Área</label>
                                <select type="text" class="form-control" id="filtro_area" name='filtro_area' placeholder="Área">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Nível</label>
                                <select type="text" class="form-control" id="filtro_nivel" name='filtro_nivel' placeholder="Nível">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Idioma</label>
                                <select type="text" class="form-control" id="filtro_idioma" name='filtro_idioma' placeholder="Idioma">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Nível Idioma</label>
                                <select type="text" class="form-control" id="filtro_nivel_idioma" name='filtro_nivel_idioma' placeholder="Nível Idioma">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Estado</label>
                                <select type="text" class="form-control" id="filtro_estado" name='filtro_estado' onchange='carregaCidades(this.value)' placeholder="Estado">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Cidade</label>
                                <select type="text" class="form-control" id="filtro_cidade" name='filtro_cidade' placeholder="Cidade">
                                    <option value=''>Selecione um estado</option>
                                </select>
                            </div>
                            <div class='col-sm-2 col-md-2'>
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-block bg-gradient-orange" onclick='filtrarCandidatos()'>Filtrar</button>
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
                                <b> Candidatos </b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="tabelaCandidatos" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Área de Interesse</th>
                                    <th>Nível de Interesse</th>
                                    <th>Data de Atualização</th>
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
<div class="modal fade" id='modalVerCurriculo' tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="gridSystemModalLabel">Currículo de Candidato</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

            <form role="form">

                <input type="hidden" id="id" name="id">

                <div class="row">
                    <div class="col-md-12">
                        <label for="nome">Nome Completo</label>
                        <input type="text" class="form-control" name="nome" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class='col-md-6'>
                        <label for="cpf">CPF</label>
                        <input type='text' name='cpf' class='form-control' disabled>
                    </div>
                    <div class='col-md-6'>
                        <label for="sexo">Sexo</label>
                        <div class="row">
                            <div class="form-check" style='margin-left: 10px'>
                                <input class="form-check-input" type="radio" name="sexo" value='1' disabled>
                                <label class="form-check-label">Masculino</label>
                            </div>
                            <div class="form-check" style='margin-left: 10px'>
                                <input class="form-check-input" type="radio" name="sexo" value='2' disabled>
                                <label class="form-check-label">Feminino</label>
                            </div>
                            <div class="form-check" style='margin-left: 10px'>
                                <input class="form-check-input" type="radio" name="sexo" value='3' disabled>
                                <label class="form-check-label">Não-Binário</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class='col-md-6'>
                        <label for="estadoCivil">Estado Civil</label>
                        <select type="text" class="form-control" id="estadoCivil" name='estadoCivil' disabled>
                            <option value="">Selecione</option>
                            <option value="1">Solteiro(a)</option>
                            <option value="2">Casado(a)</option>
                            <option value="3">Divorciado(a)</option>
                            <option value="4">Viúvo(a)</option>
                            <option value="5">Separado(a)</option>
                        </select>
                    </div>
                    <div class='col-md-6'>
                        <label for="naturalidade">Naturalidade</label>
                        <input type='text' name='naturalidade' class='form-control' disabled/>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="email">E-mail</label>
                        <input type='text' name='email' class='form-control' disabled/>
                    </div>
                    <div class='col-md-6'>
                        <label for="dtNascimento">Data de Nascimento</label>
                        <input type='date' name='dt_nascimento' class='form-control' disabled/>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="possui_deficiencia">Possui alguma deficiência?</label>
                        <select type="text" class="form-control" id="pcd" name='pcd' disabled>
                            <option value="">Selecione</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>

                <hr>

                <h5>Informações de Contato</h5>
                <br>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="endereco">Endereço</label>
                        <input type='text' name='endereco' class='form-control' disabled/>
                    </div>
                    <div class='col-md-6'>
                        <label for="numero">Número</label>
                        <input type='text' name='numero' class='form-control' disabled/>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="complemento">Complemento</label>
                        <input type='text' name='complemento' class='form-control' disabled/>
                    </div>
                    <div class='col-md-6'>
                        <label for="bairro">Bairro</label>
                        <input type='text' name='bairro' class='form-control' disabled/>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="estado">Estado</label>
                        <select name='estado' class='form-control' disabled>
                        </select>
                    </div>
                    <div class='col-md-6'>
                        <label for="cidade">Cidade</label>
                        <select name='cidade' class='form-control' disabled>
                        </select>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="celular">Celular</label>
                        <input type='text' name='celular' class='form-control' disabled/>
                    </div>
                    <div class='col-md-6'>
                        <label for="fixo">Telefone Fixo</label>
                        <input type='text' name='fixo' class='form-control' disabled/>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="linkedin">Linkedin</label>
                        <input type='text' name='linkedin' class='form-control' disabled/>
                    </div>
                    <div class='col-md-6'>
                        <label for="facebook">Facebook</label>
                        <input type='text' name='facebook' class='form-control' disabled/>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="blog">Blog/Site</label>
                        <input type='text' name='blog' class='form-control' disabled/>
                    </div>
                </div>
                
                <hr>
                
                <h5>Informações Profissionais</h5>
                <br>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='experiencias'>
                        </div>
                    </div>
                </div>
                <hr>
                <h5>Informações Educacionais</h5>
                <br>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='formacoes'>
                        </div>
                    </div>
                </div>
                <hr>
                <h5>Idiomas</h5>
                <br>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='idiomas'>
                        </div>
                    </div>
                </div>
                <hr>
                <h5>Informações Adicionais</h5>
                <br>
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="area_interesse">Área de Interesse</label>
                        <select  name='area_interesse' class='form-control' disabled>
                        </select>
                    </div>
                    <div class='col-md-6'>
                        <label for="nivel_interesse">Nível de Interesse</label>
                        <select  name='nivel_interesse' class='form-control' disabled>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class='col-md-12'>
                        <label for="observacoes_candidato">Observações</label>
                        <textarea id="observacoes_candidato" class='form-control' name="observacoes_candidato" rows="5" disabled></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="./pages/candidatos/main.js"></script>