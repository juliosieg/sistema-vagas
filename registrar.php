<style>
    body {
        background-color: #fe8800;
    }
    .container {
        height: auto !important;
        background-color: white !important;
        border-radius: 4px;
        margin-top: 20px;
    }
    .cabecalho {
        text-align: center;
        font-weight: bold;
        padding-top: 20px;
        padding-bottom: 10px;
    }
    .corpo_form {
        padding:10px;
    }
</style>

<div class='container col-sm-10 col-md-8'>
    <div class='cabecalho'>
        <h3>Cadastro de Candidato</h3>
    </div>
    <form accept-charset="UTF-8" role="form" id='formCandidato' onSubmit="javascript:enviarDados(event)">
        <div class='corpo_form'>
            <h5>Informações pessoais</h5>
            <br>
            <div class='row'>
                <div class='col-md-12'>
                    <label for="nome">Nome Completo</label>
                    <input type='text' name='nome' class='form-control' placeholder='Nome Completo' required/>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label for="cpf">CPF</label>
                    <input type='text' name='cpf' class='form-control' placeholder='999.999.999-99' required/>
                </div>
                <div class='col-md-6'>
                    <label for="sexo">Sexo</label>
                    <div class="row">
                        <div class="form-check" style='margin-left: 10px'>
                            <input class="form-check-input" type="radio" name="sexo" value='1' required>
                            <label class="form-check-label">Masculino</label>
                        </div>
                        <div class="form-check" style='margin-left: 10px'>
                            <input class="form-check-input" type="radio" name="sexo" value='2' required>
                            <label class="form-check-label">Feminino</label>
                        </div>
                        <div class="form-check" style='margin-left: 10px'>
                            <input class="form-check-input" type="radio" name="sexo" value='3' required>
                            <label class="form-check-label">Não-Binário</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label for="estadoCivil">Estado Civil</label>
                    <select type="text" class="form-control" id="estadoCivil" name='estadoCivil' placeholder="Estado Civil" required>
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
                    <input type='text' name='naturalidade' class='form-control' placeholder='Naturalidade' required/>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label for="email">E-mail</label>
                    <input type='text' name='email' class='form-control' placeholder='E-mail' required/>
                </div>
                <div class='col-md-6'>
                    <label for="dtNascimento">Data de Nascimento</label>
                    <input type='date' name='dt_nascimento' class='form-control' placeholder='dd/mm/yyyy' required/>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label for="possui_deficiencia">Possui alguma deficiência?</label>
                    <select type="text" class="form-control" id="pcd" name='pcd' placeholder="PCD" required>
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
                    <input type='text' name='endereco' class='form-control' placeholder='Endereço' required/>
                </div>
                <div class='col-md-6'>
                    <label for="numero">Número</label>
                    <input type='text' name='numero' class='form-control' placeholder='Número' required/>
                </div>
            </div>

            <div class='row'>
                <div class='col-md-6'>
                    <label for="complemento">Complemento</label>
                    <input type='text' name='complemento' class='form-control' placeholder='Complemento'/>
                </div>
                <div class='col-md-6'>
                    <label for="bairro">Bairro</label>
                    <input type='text' name='bairro' class='form-control' placeholder='Bairro' required/>
                </div>
            </div>

            <div class='row'>
                <div class='col-md-6'>
                    <label for="estado">Estado</label>
                    <select name='estado' onchange="carregaCidades(this.value)" class='form-control' required>
                    </select>
                </div>
                <div class='col-md-6'>
                    <label for="cidade">Cidade</label>
                    <select name='cidade' class='form-control' required>
                        <option value="">Selecione um estado</option>
                    </select>
                </div>
            </div>

            <div class='row'>
                <div class='col-md-6'>
                    <label for="celular">Celular</label>
                    <input type='text' name='celular' class='form-control' placeholder='(99) 99999-9999' required/>
                </div>
                <div class='col-md-6'>
                    <label for="fixo">Telefone Fixo</label>
                    <input type='text' name='fixo' class='form-control' placeholder='(99) 9999-9999'/>
                </div>
            </div>
            
            <div class='row'>
                <div class='col-md-6'>
                    <label for="linkedin">Linkedin</label>
                    <input type='text' name='linkedin' class='form-control' placeholder='Linkedin'/>
                </div>
                <div class='col-md-6'>
                    <label for="facebook">Facebook</label>
                    <input type='text' name='facebook' class='form-control' placeholder='Facebook'/>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label for="blog">Blog/Site</label>
                    <input type='text' name='blog' class='form-control' placeholder='Blog/Site'/>
                </div>
            </div>
            <hr>
            <h5>Informações Profissionais</h5>
            <br>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='experiencias'>
                        <div class='experiencia experiencia_1' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label for="empresa_1">Empresa</label>
                                    <input type='text' required name='empresa_1' class='form-control' placeholder='Empresa'/>
                                </div>
                                <div class='col-md-6'>
                                    <label for="cargo_1">Cargo</label>
                                    <input type='text' required name='cargo_1' class='form-control' placeholder='Cargo'/>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-6'>
                                    <label for="dtInicioEmpresa_1">Data de Início</label>
                                    <input type='date' required name='dtInicioEmpresa_1' class='form-control' placeholder='dd/mm/yyyy'/>
                                </div>
                                <div class='col-md-6'>
                                    <label for="dtFimEmpresa_1">Data de Saída</label>
                                    <input type='date' name='dtFimEmpresa_1' id='dtFimEmpresa_1' class='form-control' placeholder='dd/mm/yyyy'/>
                                </div>
                                <div class='col-md-6'></div>
                                <div class='col-md-6'>
                                    <input type='checkbox' class='form_control' id="trabalhoAtual_1" name="trabalhoAtual_1"/>
                                    <label for='trabalhoAtual_1' style='font-weight: normal'> Ainda estou trabalhando nessa empresa</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-12'>
                                    <label for="atribuicoes_empresa_1">Principais atribuições</label>
                                    <textarea id="atribuicoes_empresa_1" required class='form-control' name="atribuicoes_empresa_1" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-12' style='text-align: right'>
                                    <br>
                                    <div class="pull-right">
                                        <a href="javascript:excluirLinhaExperienciaProfissional(1)" class="btn btn-danger btn-flat">Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br class='experiencia_1'>
                    <div class='col-md-5'>
                        <input type='button' name='btnExperienciaProfissional' class='btn btn-block bg-gradient-orange' value='Adicionar nova experiência'/>
                    </div>
                </div>
            </div>
            <hr>
            <h5>Informações Educacionais</h5>
            <br>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='formacoes'>
                        <div class='formacao formacao_1' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <label for="instituicao_1">Instituição</label>
                                    <input type='text' required name='instituicao_1' class='form-control' placeholder='Instituição'/>
                                </div>
                                <div class='col-md-4'>
                                    <label for="curso_1">Curso</label>
                                    <input type='text' required name='curso_1' class='form-control' placeholder='Curso'/>
                                </div>
                                <div class='col-md-4'>
                                    <label for="nivel_1">Nível</label>
                                    <select name="nivel_1" required class='form-control'>
                                        <option value="">Selecione</option>
                                        <option value="1">Ensino Fundamental</option>
                                        <option value="2">Ensino Médio</option>
                                        <option value="3">Ensino Técnico</option>
                                        <option value="4">Ensino Superior</option>
                                        <option value="5">Pós-Graduação</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-6'>
                                    <label for="dtInicioFormacao_1">Data de Início</label>
                                    <input type='date'  required name='dtInicioFormacao_1' class='form-control' placeholder='dd/mm/yyyy'/>
                                </div>
                                <div class='col-md-6'>
                                    <label for="dtFimFormacao_1">Data de Formação (Previsão de Conclusão)</label>
                                    <input type='date' required name='dtFimFormacao_1' id='dtFimFormacao_1' class='form-control' placeholder='dd/mm/yyyy'/>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-12' style='text-align: right'>
                                    <br>
                                    <div class="pull-right">
                                        <a href="javascript:excluirFormacao(1)" class="btn btn-danger btn-flat">Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br class='formacao_1'>
                    <div class='col-md-5'>
                        <input type='button' name='btnFormacao' class='btn btn-block bg-gradient-orange' value='Adicionar nova formação'/>
                    </div>
                </div>
            </div>
            <hr>
            <h5>Idiomas</h5>
            <br>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='idiomas'>
                        <div class='idioma idioma_1' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label for="idioma_1">Idioma</label>
                                    <select name='idioma_1' required class='form-control' placeholder='Idioma'>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label for="nivel_idioma_1">Nível</label>
                                    <select  name='nivel_idioma_1' required class='form-control'>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-12' style='text-align: right'>
                                    <br>
                                    <div class="pull-right">
                                        <a href="javascript:excluirIdioma(1)" class="btn btn-danger btn-flat">Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br class='idioma_1'>
                    <div class='col-md-5'>
                        <input type='button' name='btnIdioma' class='btn btn-block bg-gradient-orange' value='Adicionar novo idioma'/>
                    </div>
                </div>
            </div>
            <hr>
            <h5>Informações Adicionais</h5>
            <br>
            <div class='row'>
                <div class='col-md-6'>
                    <label for="area_interesse">Área de Interesse</label>
                    <select  name='area_interesse' class='form-control' required>
                    </select>
                </div>
                <div class='col-md-6'>
                    <label for="nivel_interesse">Nível de Interesse</label>
                    <select  name='nivel_interesse' class='form-control' required>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class='col-md-12'>
                    <label for="observacoes_candidato">Observações</label>
                    <textarea id="observacoes_candidato" class='form-control' name="observacoes_candidato" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12' style='text-align: right; display: inline-flex'>
                <div class='col-md-4' style='flex: 1; position: absolute; left: 0'>
                </div>
                <div class='col-md-4' style='flex: 1; position: absolute; right: 0'>
                    <button type='submit' class='btn btn-block bg-gradient-orange'>Concluir Cadastro</button>
                </div>
            </div>
            <br>
            <br>
        </div>
    </form>
</div>
<br>
<br>

<script src="./pages/functions/js/registrar.js"></script>