<?php

use App\Projeto;
use Illuminate\Database\Seeder;

class ProjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table projetos restart identity cascade'));

        Projeto::create(['descricao' => 'CARDIGITAL-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VIVARA-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NEGNTMSG-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CHAINTTS-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ALTCUPOMAO-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NUMSORTE-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTDEV-16', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PESQSATISF-25', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'LISTAEXT-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PRSGF-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ANGDEVOL-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'DOTZAPI-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CONTPEDIDO-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PRBVV-98', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ZANFISANGO-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NOTA2019-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'SELFDINAM-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'BL-6600', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'TROCASEMCP-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INFOCHEQUE-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PESQSATISF-42', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'TROCOSIMPL-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NEWETIQ-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'SUPERTROCO-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTTAXWEB-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PR-60', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ZANPOSTO-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VIAINTCRES-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'BL-6718 / 6719', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MOVTESLOJA-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CARDIGITI-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'IBOPEDTM-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CORRECPGT-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NEGCANCDE-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NEGENDMERC-1 ', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PROMOAPP-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTBOLETO-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MAKMASTSAF-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VNDAPRAZO-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MAKM40F1-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTM40CAD-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MAKREL-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MAKDEV-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'RESATOTCAR-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VCMEMORIA-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'GERABOLETO-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'RELVALECOM-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ZANBILLSAS-1', 'equipe_id' => 3, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PRFAMDPTO-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ETIQPREMB-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VIVARAPDV-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MODIFANGOL-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'DESCPMZ-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'DECRFIDVEN-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CANCRFID-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CASALOJIST-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTEZTECH-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MLCOMANDA-1', 'equipe_id' => 1, 'status' => 2, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MELHORIAVP-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'SCANNERJAD-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'TORVCCORTE-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ZANINTALOC-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTPINPAD-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'MAKESTACI-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NESPRESSO-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PR-21', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTRETAIL-1', 'equipe_id' => 2, 'status' => 2, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'SAASAUTO-1', 'equipe_id' => 3, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'COMZ-1', 'equipe_id' => 3, 'status' => 2, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTVORTICE-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NPSFASE5-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'SPACECARD-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VENDAEMB-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ATUALIZPDV-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PROMOQTDE-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NESPRESSOCOMPLEMENTO-1', 'equipe_id' => 4, 'status' => 0, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'PROSEGURCM-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'TOKENWPS-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VAANDROID-1', 'equipe_id' => 5, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ML-1288', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PAYFACE-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PROMOCONV-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CONSULPROD-1', 'equipe_id' => 4, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PROPZ-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'DESIMPTEF-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'UPLIFT-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PROMOAPP2-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTPDVSAP-1', 'equipe_id' => 1, 'status' => 2, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'PETINTKALU-1', 'equipe_id' => 1, 'status' => 2, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PARKPLUS-2', 'equipe_id' => 1, 'status' => 2, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'SENHADIA-1', 'equipe_id' => 2, 'status' => 1, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'TROCACPLJ-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'SAIDAOPER-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MELHORIASAPP-1', 'equipe_id' => 5, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PAYFACEAPP-1', 'equipe_id' => 5, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MZCANCANT-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ACRESCITEM-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'TROCASEMCV-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'PGSOROCRED-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'COBNEPOS-1', 'equipe_id' => 1, 'status' => 2, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'PETENTREGA-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'CRMONEID-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'TENDENCIA-1', 'equipe_id' => 6, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'FACTURAA4-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VALIDAEP-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'SORTEIOFIN-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'CADSORTEIO-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'AUDITTROCA-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PERTO-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'INTMELIUZ-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'WEDOO-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'NPSFASE6-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'VPTELAPDV-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'PROMOLISTA-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'LOGVOUCHER-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'APPDMCARD-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'STOPBANK-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CUSTSPICY-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'INTJOYA-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'ORDEMSERV-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'AJUSTNFCE-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 3]);
        Projeto::create(['descricao' => 'ARREDONDAR-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'CTRBLOCOX-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CRMSAC-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'CRMPONTOS-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTBOOME-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'PROTHEUS2-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'PETENTREGA2-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'INTADYENF1-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'CANCDEV-39', 'equipe_id' => 2, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'LOPNOVGISS-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'SINALSELF-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'DEVITEMPR-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'INTTODOCAR-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'LISTADESC-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'POMPEIA-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'PRODCOMB-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'POPUPMERC-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'DOTZLGPD-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'INTCATRACA-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'NFECOMPLE-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CONFTURNO-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MERCAFACIL-1A', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'MERCAFACIL-1B', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'TOTAUTOSER-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PRDESCRAT-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'TOTCONDUCT-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'NFCEMODULO-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'INTAPIPR-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'CONTPESO-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'DEVSEMCP-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'QRCODEGPOS-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'ZANVOUKERN-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'ALTENTNF-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'NEWBLOCOX-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ZANSATAJUS-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'PCF2-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'ZANINTDFIS-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'ZANPROMFAC-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'CANCDEV-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'BLOQCAMPO-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'CLOBLOJA-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 0]);
        Projeto::create(['descricao' => 'CANCDEV-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'VOXCRED-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MAKROVP-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MAKSAP4C-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTSITEMER-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'MAKLEAD-1', 'equipe_id' => 2, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CLICNPJLJ-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'LGPDZAN-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CONFATMP-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'GIVEX-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'GIVEXSERIE-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'SINALIZAOC-1', 'equipe_id' => 1, 'status' => 3, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'AMEDIGITAL-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'REDUC4DIG-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PRODCONSIG-1', 'equipe_id' => 1, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CASHBACKFP-1', 'equipe_id' => 9, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NT20200506-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'PAYFACEF2-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'NPSSERES-1', 'equipe_id' => 7, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'ENTREGAF2-1', 'equipe_id' => 7, 'status' => 1, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'HISTCRED-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'INTRMS-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'IMPVOUCHER-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'CANCNFCE-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'FILDOWNDOC-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'EMALOTE-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 2]);
        Projeto::create(['descricao' => 'SUBSTRIB-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'LOGINPDVAD-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'PAYLESS-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'LIMITECANC-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'MAPFRE-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'VNDSERVTOT-1', 'equipe_id' => 5, 'status' => 0, 'status_aprovacao' => 1]);
        Projeto::create(['descricao' => 'PAFPOSTO-1', 'equipe_id' => 1, 'status' => 0, 'status_aprovacao' => 1]);

    }
}
