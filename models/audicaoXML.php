
<?php

class AudicaoXML{

    public function validateXML(){
      $xml = new DOMDocument();
      $xml->load('views/assets/uploads/audicao.xml');
      return @$xml->schemaValidate('views/assets/xsd/audicao.xsd');
    }

    public function importXML(){
      try {
        $audicao = simplexml_load_file('views/assets/uploads/audicao.xml');
        $last_id = Audicao::generateId();
        $id = "Au".($last_id+1);
        Audicao::insert($id, (string) $audicao->titulo, (string) $audicao->subtitulo, (string) $audicao->tema, (string) $audicao->data, (string) $audicao->hora, (string) $audicao->organizador);
        foreach($audicao->atuacao as $a){
          $last_id_atuacao = Atuacao::generateId();
          $id_atuacao = "At".($last_id_atuacao+1);
          $grupo = ($a->grupo) ? (string) $a->grupo : 'NULL';
          $alunos = [];
          $professores= [];
          $obras = [];
          foreach($a->alunos->aluno as $al){
              $alunos[] = (string) $al;
          }

          foreach($a->professores->professor as $p){
            $professores[] = (string) $p;
          }
          foreach($a->obras->obra as $o){
            $obras[] = (string) $o;
          }

          Atuacao::insert($id_atuacao, $grupo, $alunos, $professores, $obras, $id);
          $_GET['id'] = $id;
        }
        return true;
      } catch (Exception $e) {
        echo $e->getMessage();
        return false;
      }
    }

    public function exportXML($id){
      try {
        $aud = Audicao::find($id);
        $xml = new DOMDocument();
        $audicao = $xml->createElement("audicao");
        $audicao =  $xml->appendChild($audicao);
        $id = $xml->createAttribute('id');
        $id->value = $aud->id;
        $audicao->appendChild($id);
        $titulo = $xml->createElement("titulo", $aud->titulo);
        $audicao->appendChild($titulo);
        $subtitulo = $xml->createElement('subtitulo', $aud->subtitulo);
        $audicao->appendChild($subtitulo);
        $tema = $xml->createElement('tema', $aud->tema);
        $audicao->appendChild($tema);
        $data = $xml->createElement('data', $aud->hora);
        $audicao->appendChild($data);
        $hora = $xml->createElement('hora', $aud->hora);
        $audicao->appendChild($hora);
        $organizador = $xml->createElement('organizador', $aud->organizador->id);
        $audicao->appendChild($organizador);
        $duracao = $xml->createElement('duracao', $aud->duracao);
        $audicao->appendChild($duracao);
        foreach ($aud->atuacoes() as $a) {
          $atuacao = $xml->createElement('atuacao');
          $atuacao = $audicao->appendChild($atuacao);
          $id = $xml->createAttribute('id');
          $id->value = $a->id;
          $atuacao->appendChild($id);
          $grupo = $xml->createElement('grupo', $a->grupo->id);
          $atuacao->appendChild($grupo);
          $alunos = $xml->createElement('alunos');
          $alunos = $atuacao->appendChild($alunos);
          foreach ($a->alunos as $al) {
            $aluno = $xml->createElement('aluno', $al->id);
            $alunos->appendChild($aluno);
          }
          $professores = $xml->createElement('professores');
          $professores = $atuacao->appendChild($professores);
          foreach ($a->maestros as $m) {
            $professor = $xml->createElement('professor', $m->id);
            $professores->appendChild($professor);
          }
          $obras = $xml->createElement('obras');
          $obras = $atuacao->appendChild($obras);
          foreach ($a->obras as $o) {
            $obra = $xml->createElement('obra', $o->id);
            $obras->appendChild($obra);
          }
        }
        $xml->FormatOutput = true;
        $xml->save('audicao_export.xml');

      } catch (Exception $e) {

      }
    }

    public function exportXMLPDF($id){
      try {
        $aud = Audicao::find($id);
        $xml = new DOMDocument();
        $audicao = $xml->createElement("audicao");
        $audicao =  $xml->appendChild($audicao);
        $id = $xml->createAttribute('id');
        $id->value = $aud->id;
        $audicao->appendChild($id);
        $titulo = $xml->createElement("titulo", $aud->titulo);
        $audicao->appendChild($titulo);
        $subtitulo = $xml->createElement('subtitulo', $aud->subtitulo);
        $audicao->appendChild($subtitulo);
        $tema = $xml->createElement('tema', $aud->tema);
        $audicao->appendChild($tema);
        $data = $xml->createElement('data', $aud->hora);
        $audicao->appendChild($data);
        $hora = $xml->createElement('hora', $aud->hora);
        $audicao->appendChild($hora);
        $organizador = $xml->createElement('organizador', $aud->organizador->nome);
        $audicao->appendChild($organizador);
        $duracao = $xml->createElement('duracao', $aud->duracao);
        $audicao->appendChild($duracao);
        foreach ($aud->atuacoes() as $a) {
          $atuacao = $xml->createElement('atuacao');
          $atuacao = $audicao->appendChild($atuacao);
          $id = $xml->createAttribute('id');
          $id->value = $a->id;
          $atuacao->appendChild($id);
          $grupo_name = ($a->grupo) ? $a->grupo->nome : 'n/a';
          $grupo = $xml->createElement('grupo', $grupo_name);
          $atuacao->appendChild($grupo);
          $alunos = $xml->createElement('alunos', count($a->alunos));
          $alunos = $atuacao->appendChild($alunos);
          $maestros = $xml->createElement('maestros', count($a->maestros));
          $maestros = $atuacao->appendChild($maestros);
          $obras = $xml->createElement('obras', count($a->obras));
          $obras = $atuacao->appendChild($obras);
        }
        $xml->FormatOutput = true;
        $xml->save('audicao_pdf.xml');

      } catch (Exception $e) {

      }
    }

    public function exportPDF($id){
      try {
        self::exportXMLPDF($id);
        exec('fop -xml audicao_pdf.xml -xsl views/assets/xsl/audicao.xsl -pdf audicao.pdf');
      } catch (Exception $e) {

      }
    }


  }
?>
