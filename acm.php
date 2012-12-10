<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "phpQuery/phpQuery.php";

function obtenerDatos($urls, $query){

	$out = "";
	$out .= "\"busqueda :\"," . "\""  .  $query.  "\"" . "\n";
	$out .= "\"URLS:\"," ;

	foreach ($urls as $numKey => $url) {
	//	$out .= "\"" . $url . "\",";
	}
	$out .= "\n";
	$out .= "\"link\",\"titulo\",\"fuente\",\"autores\",\"año\"" . "\n";

	foreach ($urls as $numKey => $url) {

		$html = file_get_contents($url);
		//var_dump($http_response_header);
		//var_dump($url);


		$doc = phpQuery::newDocument($html);
		$a = 0;


		foreach( pq('div table tr table tr[valign=top] table tr[valign=top]') as $tab  ){
			$a++;

			$titulo = pq($tab)->find('a.medium-text');		
			if(!$titulo->html()){
				continue;		
			}	
		
			$bib = preg_replace('/\s+/', ' ',pq($tab)->find('.addinfo')->text());
			$autores = preg_replace('/\s+/', ' ',pq($tab)->find('.authors')->text());
			$anoText = pq($tab)->find('tr td.small-text')->text();
			$ano = filter_var($anoText, FILTER_SANITIZE_NUMBER_INT);

			$out .=  "\"http://dl.acm.org/" .  $titulo->attr("href")  . "\",";	
			$out .=  "\"" . $titulo->text() . "\" , ";
			$out .=  "\"" . trim($bib) . "\",";
			$out .=  "\"" . trim($autores) . "\",";		
			$out .=  "\"" .  trim($ano) . "\"";
			$out .=  "" . "\n";
		}

		//print $a;

	}

	return $out;
}

function imprimirEnPantalla($arr){

	//header('Content-Type: text/plain; charset=utf-8');

	//	header('Content-Type: text/csv; charset=utf-8');
	//	header('Content-Disposition: attachment; filename=Usuarios.csv');

	for ($i=0; $i < count($arr); $i++) { 
		print obtenerDatos($arr[$i][0],$arr[$i][1]);
	}
}


// (Abstract:mobile and Abstract:software and Abstract:engineering) and (Title:mobile)
$a1 = array(
	"http://dl.acm.org/results.cfm?query=%28%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Aengineering%29%29%20and%20%28Title%3Amobile%29%29&querydisp=%28%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Aengineering%29%29%20and%20%28Title%3Amobile%29%29&start=1&slide=1&srt=score%20dsc&short=1&coll=DL&dl=GUIDE&source_disp=Published%20since%20January%202007&source_query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Aengineering%29%29%20and%20%28Title%3Amobile%29&since_month=1&since_year=2007&before_month=&before_year=&termshow=matchboolean&range_query=PublicationJulianDate|GTEQ%202454102&zadv=1&CFID=152834088&CFTOKEN=11165524"
	,
	"http://dl.acm.org/results.cfm?query=%28%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Aengineering%29%29%20and%20%28Title%3Amobile%29%29&querydisp=%28%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Aengineering%29%29%20and%20%28Title%3Amobile%29%29&source_query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Aengineering%29%29%20and%20%28Title%3Amobile%29&start=51&slide=1&srt=score%20dsc&short=1&source_disp=Published%20since%20January%202007&since_month=1&since_year=2007&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=PublicationJulianDate|GTEQ%202454102&zadv=1&CFID=223591124&CFTOKEN=98884106"

);

// ((Abstract:mobile and Abstract:software and Abstract:requirements) and (Title:mobile)) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction)
$a2 = array(
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29&start=1&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
	,
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29&start=21&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
	,
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29&start=41&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
	,
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29&start=61&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
	,
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29&start=81&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
	,
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Abstract%3Arequirements%29%20and%20%28Title%3Amobile%29&start=101&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
);

// ((Abstract:mobile and Abstract:software and Title:mobile and (Title:architecture or Title:modeling or Title:design) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction))

$a3 = array(
	"http://dl.acm.org/results.cfm?query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&querydisp=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&start=1&slide=1&srt=CitedCount&short=1&coll=DL&dl=GUIDE&source_disp=Published%20since%20January%202007&source_query=Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&since_month=1&since_year=2007&before_month=&before_year=&termshow=matchboolean&range_query=PublicationJulianDate|GTEQ%202454102&zadv=1"
	,
	"http://dl.acm.org/results.cfm?query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&querydisp=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&source_query=Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&start=51&srt=CitedCount&short=1&source_disp=Published%20since%20January%202007&since_month=1&since_year=2007&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=PublicationJulianDate|GTEQ%202454102&zadv=1"
	,
	"http://dl.acm.org/results.cfm?query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&querydisp=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&source_query=Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20%28Title%3Aarchitecture%20or%20Title%3Amodeling%20or%20Title%3Adesign%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&start=101&srt=CitedCount&short=1&source_disp=Published%20since%20January%202007&since_month=1&since_year=2007&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=PublicationJulianDate|GTEQ%202454102&zadv=1"
);

//  (Abstract:mobile and Abstract:software and Title:mobile and Title:testing) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction)
$a4 = array(
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20Title%3Atesting%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20Title%3Atesting%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20Title%3Atesting%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&start=1&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
	,
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20Title%3Atesting%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20Title%3Atesting%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%20and%20Title%3Atesting%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&start=21&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
);


//  ((Abstract:mobile and Abstract:software and Title:mobile) and (quality and assurance) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction)) 
$a5 = array(
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28quality%20and%20assurance%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28quality%20and%20assurance%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28quality%20and%20assurance%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&start=1&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"
	,
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28quality%20and%20assurance%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28quality%20and%20assurance%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28quality%20and%20assurance%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29&start=21&srt=score%20dsc&short=1&source_disp=&since_month=&since_year=&before_month=&before_year=&coll=DL&dl=GUIDE&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545%204294778065&CFID=223591124&CFTOKEN=98884106"	
);

//  (( (Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction))) and (Abstract:object and Abstract:oriented)
$a6 = array(
	"http://dl.acm.org/results.cfm?query=%28%28%20%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29%29%20and%20%28Abstract%3Aobject%20and%20Abstract%3Aoriented%29&querydisp=%28%28%20%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29%29%20and%20%28Abstract%3Aobject%20and%20Abstract%3Aoriented%29&start=1&slide=1&srt=score%20dsc&short=1&coll=DL&dl=GUIDE&source_disp=&source_query=%28%20%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%29&since_month=&since_year=&before_month=&before_year=&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294778065&CFID=155022476&CFTOKEN=17570332"
);

// ((Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction) and (Abstract:agent and Abstract:oriented))
$a7 = array(
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aagent%20and%20Abstract%3Aoriented%29%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aagent%20and%20Abstract%3Aoriented%29%29&start=1&slide=1&srt=score%20dsc&short=1&coll=DL&dl=GUIDE&source_disp=&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aagent%20and%20Abstract%3Aoriented%29&since_month=&since_year=&before_month=&before_year=&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294786989%204294778751%204294394545&CFID=155022476&CFTOKEN=17570332"
);

//  ( (Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction) and (Abstract:context and Abstract:oriented))
$a8 = array(
	"http://dl.acm.org/results.cfm?query=%28%20%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Acontext%20and%20Abstract%3Aoriented%29%29&querydisp=%28%20%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Acontext%20and%20Abstract%3Aoriented%29%29&start=1&slide=1&srt=score%20dsc&short=1&coll=DL&dl=GUIDE&source_disp=&source_query=%20%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Acontext%20and%20Abstract%3Aoriented%29&since_month=&since_year=&before_month=&before_year=&termshow=matchboolean&range_query=&zadv=1&dimval=4294824663%204294343688%204294778751%204294394545&CFID=155022476&CFTOKEN=17570332"
);

// (Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction) and (Abstract:aspect and Abstract:oriented)
$a9 = array(
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aaspect%20and%20Abstract%3Aoriented%29%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aaspect%20and%20Abstract%3Aoriented%29%29&start=1&slide=1&srt=score%20dsc&short=1&coll=DL&dl=GUIDE&source_disp=&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aaspect%20and%20Abstract%3Aoriented%29&since_month=&since_year=&before_month=&before_year=&termshow=matchboolean&range_query=&zadv=1&dimval=4294343688%204294778751%204294394545&CFID=155022476&CFTOKEN=17570332"
);

// ((Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction) and (Abstract:event and Abstract:oriented))
$a10 = array(
	"http://dl.acm.org/results.cfm?query=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aevent%20and%20Abstract%3Aoriented%29%29&querydisp=%28%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aevent%20and%20Abstract%3Aoriented%29%29&start=1&slide=1&srt=score%20dsc&short=1&coll=DL&dl=GUIDE&source_disp=&source_query=%28Abstract%3Amobile%20and%20Abstract%3Asoftware%20and%20Title%3Amobile%29%20and%20%28PublishedAs%3Ajournal%20OR%20PublishedAs%3Aproceeding%20OR%20PublishedAs%3Atransaction%29%20and%20%28Abstract%3Aevent%20and%20Abstract%3Aoriented%29%0D%0A&since_month=&since_year=&before_month=&before_year=&termshow=matchboolean&range_query=&zadv=1&dimval=4294343688%204294778751%204294394545&CFID=155022476&CFTOKEN=17570332"
);

$aa = array(
	array($a1, "(Abstract:mobile and Abstract:software and Abstract:engineering) and (Title:mobile)"),
	array($a2, "((Abstract:mobile and Abstract:software and Abstract:requirements) and (Title:mobile)) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction)" ),
	array($a3, "(Abstract:mobile and Abstract:software and Title:mobile and (Title:architecture or Title:modeling or Title:design) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction))" ),
	array($a4, "(Abstract:mobile and Abstract:software and Title:mobile and Title:testing) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction)" ),
	array($a5, "((Abstract:mobile and Abstract:software and Title:mobile) and (quality and assurance) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction)) " ),
	array($a6, "(((Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction))) and (Abstract:object and Abstract:oriented)" ),
	array($a7, "((Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction) and (Abstract:agent and Abstract:oriented))" ),
	array($a8, "((Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction) and (Abstract:context and Abstract:oriented))" ),
	array($a9, "(Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction) and (Abstract:aspect and Abstract:oriented)"),
	array($a10,"((Abstract:mobile and Abstract:software and Title:mobile) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction) and (Abstract:event and Abstract:oriented))"),

);

$ab = array(
	array($a3, "((Abstract:mobile and Abstract:software and Title:mobile and (Title:architecture or Title:modeling or Title:design)) and (PublishedAs:journal OR PublishedAs:proceeding OR PublishedAs:transaction))" ),

);

header('Content-Type: text/plain; charset=utf-8');

//imprimirEnPantalla($aa);
imprimirEnPantalla($aa);

?>
