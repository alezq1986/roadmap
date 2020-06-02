class Validador {

    constructor(regras) {

        this.regras = regras;
    }

    _validarTipo(tipo, valor) {

        switch (tipo) {

            case 'string':

                if (typeof (valor) == 'string') {

                    return true;

                } else {

                    return false;

                }

            case 'number':

                if (isNaN(valor) || valor.length == 0) {

                    return false;

                } else {

                    return true;

                }

            case 'date':

                let date = Date.parse(valor);

                if (typeof (date) == 'number') {

                    return true;

                } else {

                    return false;

                }

            default:

                return false;

        }

    }

    validar(dados) {

        let erros = new Array();

        let entries_dados = Object.entries(dados);

        for (let i = 0; i < entries_dados.length; i++) {

            let campo = entries_dados[i][0];

            let valor = entries_dados[i][1];

            if (campo in this.regras) {

                let regra = this.regras[campo];

                regra = regra.split('|');

                regra = Array.isArray(regra) ? regra : [regra];

                for (let j = 0; j < regra.length; j++) {

                    let erro = new Object();

                    if (regra[j] == 'required' && (valor == null || valor.length == 0)) {

                        erro.campo = campo;

                        erro.mensagem = 'O campo ' + campo + ' é mandatório.';

                        erros.push(erro);

                        break;

                    } else if ((regra[j] == 'string' || regra[j] == 'number' || regra[j] == 'date') && this._validarTipo(regra[j], valor) === false) {

                        erro.campo = campo;

                        erro.mensagem = 'O campo ' + campo + ' deve ter o formato ' + regra[j] + '.';

                        erros.push(erro);

                        break;

                    } else if (regra[j].includes('max:') && regra[j].replace('max:', '') < valor.length) {

                        erro.campo = campo;

                        erro.mensagem = 'O campo ' + campo + ' deve ter até ' + regra[j].replace('max:', '') + ' caracteres.';

                        erros.push(erro);

                        break;

                    } else if (regra[j].includes('min:') && regra[j].replace('min:', '') > valor.length) {

                        erro.campo = campo;

                        erro.mensagem = 'O campo ' + campo + ' deve ter pelo menos ' + regra[j].replace('min:', '') + ' caracteres.';

                        erros.push(erro);

                        break;

                    } else if ($("input[coluna=id], select[coluna=id]").val().length == 0 && regra[j] == 'unique' && $("td[coluna=" + campo + "]").attr('coluna-valor') == valor) {

                        erro.campo = campo;

                        erro.mensagem = 'O campo ' + campo + ' deve ter valor único.';

                        erros.push(erro);

                    }

                }

            }

        }

        if (erros.length > 0) {

            return erros;

        } else {

            return true;

        }

    }

    marcarErros(erros) {

        $("span.invalid-feedback").remove();

        for (let i = 0; i < erros.length; i++) {

            $("input[coluna=" + erros[i]['campo'] + "], select[coluna=" + erros[i]['campo'] + "]").parent().append(
                "<span class='d-block invalid-feedback' role='alert'>" +
                "<strong>" + erros[i]['mensagem'] + "</strong>" +
                "</span>"
            );

        }

    }

}


class FormFilho {

    constructor(tipo) {

        this.tipo = tipo;

        this.formulario = $("form[tipo=" + tipo + "]");

        this.formulario_dados = null;

        this.tabela = $("table[tipo=" + tipo + "]");

        this.tabela_coluna = null;

        this.alimentarDados();

    }

    static pegarFilhos() {

        let filhos = new Object();

        $(".form-filho").each(function () {

            filhos[$(this).attr('tipo')] = new FormFilho($(this).attr('tipo'));

        });

        return filhos;

    }

    alimentarDados() {

        let formulario_dados = new Object;

        $("form[tipo=" + this.tipo + "]").find("input[coluna], select[coluna]").each(function () {

            formulario_dados[$(this).attr("coluna")] = $(this).val();

        });

        let tabela_coluna = new Object;

        this.formulario_dados = formulario_dados;

        $("table[tipo=" + this.tipo + "]").find("th").each(function () {

            tabela_coluna[$(this).attr("coluna")] = $(this).attr('class');

        });

        this.tabela_coluna = tabela_coluna;

    }


    inserirTabelaFilha() {

        this.alimentarDados();

        let pos = this.tipo.indexOf('_');

        let k1 = this.tipo.substring(pos + 1) + "_id";

        let k2 = this.tipo.substring(0, pos) + "_id";

        let v1 = $("input[tipo=" + this.tipo + "][coluna=" + k1 + "]").val();

        let v2 = $("input[tipo=" + this.tipo + "][coluna=" + k2 + "]").val();

        let l = (this.tabela.find("td[coluna=" + k1 + "][coluna-valor=" + v1 + "]").length > 0 && this.tabela.find("td[coluna=" + k2 + "][coluna-valor=" + v2 + "]").length > 0)

        if (pos != -1 && l) {

            alert('Esse registro já existe na tabela');

        } else {

            let fd = Object.entries(this.formulario_dados);

            let tc = Object.entries(this.tabela_coluna);

            let tck = Object.entries(this.tabela_coluna).map(function (v) {

                return v[0];

            });

            let c = null;

            for (let i = 0; i < fd.length; i++) {

                if (tck.indexOf(fd[i][0]) > -1) {

                    c = c + "<td class='new-row " + tc[i][1] + "' coluna=" + tc[i][0] + " coluna-valor='" + fd[i][1] + "'>" + fd[i][1] + "</td>";

                }

            }

            this.tabela.find("tbody").append(
                "<tr id=>" + c + "<td class='new-row'> <a type='button' class='btn btn-danger action-buttons remover-filho'><i class='fa fa-trash fa-sm'></i></a></td></tr>"
            );

        }

    }

    removerTabelaFilha(linha) {

        if (linha.closest('td').hasClass('new-row')) {

            linha.closest('tr').remove();

        } else {

            this.tabela.find("tr#" + linha.closest('tr').attr('id')).children().addClass('deleted-row');

        }
    }

    editarTabelaFilha(id) {

        this.tabela.find("td[coluna=id][coluna-valor=" + id + "]").parent("tr").children("td").each(function () {

            $("input[coluna=" + $(this).attr('coluna') + "], select[coluna=" + $(this).attr('coluna') + "]").val($(this).attr("coluna-valor"));

        });

        $(".incluir-filho").addClass('d-none');

        $(".atualizar-filho").removeClass('d-none');

    }

    atualizarTabelaFilha() {

        let cel_id = this.tabela.find("td[coluna=id][coluna-valor=" + $("input[coluna=id]").val() + "]");

        cel_id.addClass("new-row");

        cel_id.siblings("td").each(function () {

            let is = $("input[coluna=" + $(this).attr("coluna") + "], select[coluna=" + $(this).attr("coluna") + "]");

            $(this).attr("coluna-valor", is.val());

            $(this).html(is.val());

            $(this).addClass("new-row");

        });

        $(".incluir-filho").removeClass('d-none');

        $(".atualizar-filho").addClass('d-none');

    }

    criarObjetoFilhos() {

        let dados = new Object();

        let filhos_incluir = new Array();

        let filhos_deletar = new Array();

        this.tabela.find(".new-row").parents("tr").each(function () {

            let o = new Object();

            $(this).children().each(function () {

                o[$(this).attr('coluna')] = $(this).attr('coluna-valor');

            })

            filhos_incluir.push(o);


        });

        dados.filhos_incluir = filhos_incluir.reverse();

        this.tabela.find(".deleted-row").parents("tr").each(function () {

            let o = new Object();

            $(this).children().each(function () {

                o[$(this).attr('coluna')] = $(this).attr('coluna-valor');

            })

            filhos_deletar.push(o);

        });

        dados.filhos_deletar = filhos_deletar;

        dados.tipo = this.tipo;

        return dados;
    }

}

class ModalPesquisa {

    constructor(tipo, idx) {

        this.tipo = tipo;

        this.idx = idx;

        let tipo_principal = new Object();

        tipo_principal.tipo = tipo.split("_")[0];

        tipo_principal.valor = $("button[modal-tipo=" + tipo + "]").eq(idx).parent().siblings('input').val();

        this.tipo_principal = tipo_principal;

        let trt = tipo.split("_");

        trt.length > 1 ? trt.shift() : (trt = []);

        trt = (Array.isArray(trt) && trt !== []) ? trt : new Array(trt);

        let tr = new Array();

        if (trt !== []) {

            for (let i = 0; i < trt.length; i++) {

                let o = new Object();

                o.tipo = trt[i];

                o.valor = $("input[coluna=" + trt[i].slice(0, -1) + "_id], select[coluna=" + trt[i].slice(0, -1) + "_id]").eq(idx).val();

                tr.push(o);

            }

        }

        this.tipos_relacionados = tr;

        let dados = new Object();

        dados.tipo = this.tipo;

        dados.tipo_principal = this.tipo_principal;

        dados.tipos_relacionados = this.tipos_relacionados;

        this.dados = dados;


    }

    criarModal() {

        var r = ajaxRequest(this.dados, '/ajax/consultar');

        let tipo = this.tipo;

        let idx = this.idx;

        $.when(r).done(function (response) {

            if ($(".modal[tipo=" + tipo + "]").length === 0) {

                $("button[modal-tipo=" + tipo + "]").eq(idx).after(
                    "<div class='modal fade' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' tipo=" + tipo + ">" +
                    "<div class='modal-dialog' role='document'>" +
                    "<div class='modal-content'>" +
                    "<div class='modal-header'>" +
                    "<h5 class='modal-title' id='exampleModalLabel'>Escolha a opção</h5>" +
                    "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" +
                    "<span aria-hidden='true'>&times;</span>" +
                    "</button>" +
                    "</div>" +
                    "<div class='modal-body'>" +
                    "</div>" +
                    "<div class='modal-footer'>" +
                    "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

            }

            let modal = $(".modal[tipo=" + tipo + "]");

            let res = response.resultado;

            modal.find("#results-list").remove();

            modal.find(".modal-body").append("<ul id='results-list'> </ul>");

            let i;

            for (i = 0; i < res.length; i++) {

                modal.find("#results-list").append("<li id=" + res[i].id + ">" + res[i]['coluna'] + "</li>");

            }

            modal.modal('show');

            $("li").click(function () {

                let id_escolhida = $(this).attr('id');

                $(this).parents(".input-group").children("input").val(id_escolhida);

                modal.modal('hide');

            });


        });


    }

}

function ajaxRequest(dados, rota) {

    let _token = $('meta[name="csrf-token"]').attr('content');

    var objDiferido = $.Deferred();

    $.ajax({
        url: rota,
        type: "POST",
        dataType: 'JSON',
        data: {
            dados: dados,
            _token: _token
        },
        success: function (response) {

            objDiferido.resolve(response);

        },
    });

    return objDiferido.promise()

}

$(document).ready(function () {

    let regras = new Object();

    let r = new Object();

    r.descricao = 'required|string|max:100|min:3';

    r.competencia_id = 'required|number';

    r.atividade_codigo = 'required|unique|number';

    r.data_inicio_real = 'date';

    r.data_fim_real = 'date';

    regras['atividades'] = r;

    let r2 = new Object();

    r2.competencia_id = 'unique';

    regras['competencia_recurso'] = r2;

    let r3 = new Object();

    r3.equipe_id = 'unique';

    regras['equipe_recurso'] = r3;

    let filhos = FormFilho.pegarFilhos();

    $("button[form=form-principal]").on('click', function (event) {

        event.preventDefault();

        let f = Object.entries(filhos);

        let f_c = new Array();

        for (let i = 0; i < f.length; i++) {

            let o = f[i][1].criarObjetoFilhos();

            f_c.push(o);

        }

        let req = ajaxRequest(f_c, '/ajax/incluir');

        $.when(req).done(function () {

            $("form#form-principal").submit();

        });

    });


    $(".incluir-filho").on('click', function (event) {

        event.preventDefault();

        filhos[$(this).attr('tipo')].alimentarDados();

        let v = new Validador(regras[$(this).attr('tipo')]);

        let validacao = v.validar(filhos[$(this).attr('tipo')].formulario_dados);

        v.marcarErros(validacao);

        if (validacao === true) {

            filhos[$(this).attr('tipo')].inserirTabelaFilha();

        }

    });

    $(".editar-filho").on('click', function (event) {

        event.preventDefault();

        filhos[$(this).parents("table").attr('tipo')].editarTabelaFilha($(this).parents("tr").children("td[coluna=id]").attr("coluna-valor"));

    });

    $(".atualizar-filho").on('click', function (event) {

        event.preventDefault();

        filhos[$(this).attr('tipo')].alimentarDados();

        let v = new Validador(regras[$(this).attr('tipo')]);

        let validacao = v.validar(filhos[$(this).attr('tipo')].formulario_dados);

        v.marcarErros(validacao);

        if (validacao === true) {

            filhos[$(this).attr('tipo')].atualizarTabelaFilha();

        }

    });

    $("table").on('click', '.remover-filho', function () {

        filhos[$(this).parents("table").attr('tipo')].removerTabelaFilha($(this));

    });

    $("button[modal-tipo]").on('click', function (event) {

        event.preventDefault();

        let tipo = $(this).attr('modal-tipo');

        let idx = $("button[modal-tipo=" + tipo + "]").index($(this));

        let m = new ModalPesquisa(tipo, idx);


        m.criarModal();

    });

    $("button[sequencial-tipo]").on('click', function (event) {

        event.preventDefault();

        let tipo = $(this).parents("form").attr('tipo');

        let registros = $("table[tipo=" + tipo + "]").find("td[coluna=" + $(this).attr("sequencial-tipo") + "]");

        valor = 0;

        registros.each(function () {

            valor = Math.max($(this).attr('coluna-valor'), valor);

        });

        valor++;

        $("input[coluna=" + $(this).attr("sequencial-tipo") + "]").val(valor);

    });

});
