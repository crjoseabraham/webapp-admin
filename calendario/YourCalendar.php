<?php
/**
  *	@author Michele Castellucci <castellucci@cottonbit.it>
  *
  * questo file contiene la classe YourCalendar
  */

/** 
 *		Laclasse YourCalendar permette di ottenere un calendario consultabile mese per mese, con la possibilit di caricare "eventi"
 *      da un database MYSQL ed associare visivamente il/gli eventi di un certo giorno alle celle del calendario, evidenziandoli in
 *      modo personalizzato tramite classi CSS. YourCalendar utilizza argomenti 2 parametri GET per tenere traccia del mese e dell'anno  
 *		del calendario, pi un aggiuntivo GET per tenere traccia del giorno selezionato da cui si visualizzano gli eventi associati.
 *
 */		

class YourCalendar
{


/** Contiene i nomi delle classi del foglio di stile CSS da applicare al calendario 
  * @see setCSSClasses
  * @var array */ 	
	var $CSS=array(
	"heading"=>"calendar_heading",
	"simple"=>"calendar_simple",
	"linked"=>"calendar_link",
	"today"=>"calendar_today",	
	"todayLinked"=>"calendar_todayLinked",
	"weekDays"=>"calendar_weekDays");
	
	
/** Contiene i dati della tabella da cui prendere dati ed associarli al calendario  
  * @var array */ 		
	var $tableInfo=array();
	
/** Contiene le informazioni relative al mese corrente(anno+mese) e del giorno corrente selezionato  
  * @var array */	
	var $curDate=array();

/** Contiene il nome della pagina a cui linkano i giorni del calendario con eventi.  
  * @var string */		
	var $linkedPage;
	
/** Contiene la lingua del calendario per le intestazioni dei giorni e dei mesi
  * @var string */
  	var $lang;	

/*
 *	Costruttore della classe: $table  la tabella degli "eventi" ,$dateField il campo data usato per suddividere i record nei vari giorni.
 *  $selectedFields sono i campi separati da virgola selezionati dalla query per la visualizzazione dei dati effettuata dalla funzione
 *  $viewingFunction. $queryWhereCond è una condizione SQL aggiuntiva per la query di selezionamento dei dati
 *  in quanto si potrebbe voler visualizzare solo gli eventi di un certo tipo. $startmonth e $startYear invece indicano da quale mese partire
 *  inizialmente nel calendario,e come valore di default hanno il mese corrente. Il mese  nel formato da 1 a 12 e l'anno in 4 cifre YYYYY 
*/	
	function YourCalendar($table,$dateField,$selectedFields,$viewingFunction,$queryWhereCond=false,$startmonth='now',$startYear='now',$startDay='now')
	{
		$this->tableInfo['name']=$table;
		$this->tableInfo['dateField']=$dateField;
		$this->tableInfo['selectedFields']=$selectedFields;
		$this->tableInfo['viewingFunction']=$viewingFunction;
		$this->tableInfo['queryWhereCond']=$queryWhereCond?$queryWhereCond:"1";
		
		if (!isset($_GET["cal_{$this->tableInfo['name']}_month"]))
			$this->curDate['month']=$startmonth=='now'?date("n"):$startmonth;			 
		else
			$this->curDate['month']=$_GET["cal_{$this->tableInfo['name']}_month"];

		if (!isset($_GET["cal_{$this->tableInfo['name']}_year"]))
			$this->curDate['year']=$startmonth=='now'?date("Y"):$startYear;			 
		else
			$this->curDate['year']=$_GET["cal_{$this->tableInfo['name']}_year"];

		if (!isset($_GET["cal_{$this->tableInfo['name']}_focus"]))
			$this->curDate['focus']=$startDay=='now'?
			"{$this->curDate['year']}-{$this->curDate['month']}-".date('j'):"{$this->curDate['year']}-{$this->curDate['month']}-".$startDay;
		else	
			$this->curDate['focus']=$_GET["cal_{$this->tableInfo['name']}_focus"];
		
			
		$this->linkedPage=$_SERVER['PHP_SELF'];	
		
		$this->setLanguage('spanish');
		
	}
	
	function setLanguage($lang)
	{
		if ($lang=='spanish')
		$this->lang=$lang;
		else
		die ("Language not supported: only english and spanish");
	}	
	
	
	
/** Imposta la pagina a cui linkano i giorni del calendario con eventi.  
  */		
	function setLinkedPage($page)
	{
		$this->linkedPage="$page";
	}
/** 
  * Imposta i nomi delle classi del foglio di stile CSS da applicare al calendario.
  * $heading  lo stile applicato alla prima riga della tabella con il nome del mese e le frecce (link) per scorrere i mesi.
  * $simple  lo stile delle celle dei giorni senza eventi e $linked di quelle con eventi.
  * $today  lo stile della cella col giorno corrente e $todaylinked per il giorno corrente con evento.
  * Infine $weekdays riguarda le celle con le intestazioni di 3 lettere dei giorni della settimana.  
  */	
   function setCSSClasses($heading,$simple,$linked,$today,$todayLinked,$weekDays)
   {
   		$this->CSS['heading']=$heading;
		$this->CSS['simple']=$simple;
		$this->CSS['linked']=$linked;
		$this->CSS['today']=$today;
		$this->CSS['todayLinked']=$todayLinked;
		$this->CSS['weekDays']=$weekDays;
	}

	/** Ritorna una stringa contenente la lista degli eventi alla data selezionata nel calendario , separati da hr 
  	*/
	function getDayEvents()
	{

		if (!isset($this->curDate['focus'])) return false;		
		
		$exp=explode("-",$this->curDate['focus']);
		$giorno=$exp[2];
		$mese=$exp[1];
		$anno=$exp[0];	

		$result=mysql_query("
		SELECT {$this->tableInfo['selectedFields']}  
		FROM {$this->tableInfo['name']} 
		WHERE (
						DATE_FORMAT({$this->tableInfo['dateField']},'%e')='{$giorno}' 
					AND DATE_FORMAT({$this->tableInfo['dateField']},'%c')='{$mese}' 
					AND DATE_FORMAT({$this->tableInfo['dateField']},'%Y')='{$anno}'
			  ) 
			  AND 
			  (
				{$this->tableInfo['queryWhereCond']}
			  )
		ORDER BY {$this->tableInfo['dateField']} ASC	  ");

							  
		return $this->tableInfo['viewingFunction']($result);		  	
	
	}	

/** Ritorna il codice XHTML contenente il calendario intabellato  
  */
	function  getCalendar()
	{

		//mese corrente	
		$date_timestamp = mktime(0,0,0,$this->curDate['month'],1,$this->curDate['year']);
		
		//primo giorno del mese corrente (numerico da 0 a 6)
		$start_day = date("w",$date_timestamp);
		
		//numero di giorni del mese corrente
		$no_days_in_month = date("t",$date_timestamp);
		
		//If month's first day does not start with first Sunday, fill table cell with a space
		for ($i = 1; $i <= $start_day;$i++)
			$dates[1][$i] = " ";

		$row = 1;
		$col = $start_day+1;
		$num = 1;
		while($num<=31)
			{
				if ($num > $no_days_in_month)
					 break;
				else
					{
						$dates[$row][$col] = $num;
						if (($col + 1) > 7)
							{
								$row++;
								$col = 1;
							}
						else
							$col++;
						$num++;
					}//if-else
			}//while
			
		$mon_num = date("n",$date_timestamp);
		$temp_yr = $next_yr = $prev_yr = $this->curDate['year'];

		$prev = $mon_num  - 1;
		$next = $mon_num  + 1;

		//If January is currently displayed, month previous is December of previous year
		if ($mon_num  == 1)
			{
				$prev_yr = $this->curDate['year'] - 1;
				$prev = 12;
			}
    
		//If December is currently displayed, month next is January of next year
		if ($mon_num  == 12)
			{
				$next_yr = $this->curDate['year'] + 1;
				$next = 1;
			}

		$result= "<table summary=\"calendario\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\" class=\"calendario\" >";

		$result.= 	"\n<tr > ";
		
		$result.= "<td colspan=\"2\" class=\"{$this->CSS['heading']}\"><a href=\"{$_SERVER['PHP_SELF']}?cal_{$this->tableInfo['name']}_month=$prev&amp;cal_{$this->tableInfo['name']}_year=$prev_yr".buildQueryString("cal_{$this->tableInfo['name']}_month","cal_{$this->tableInfo['name']}_year")."\" >&laquo;</a></td>";
		
		$result.= "<td class=\"{$this->CSS['heading']}\" colspan=\"3\" >".($this->lang=='spanish'?mese_italiano(date("F",$date_timestamp)):date("F",$date_timestamp))." ".$temp_yr."</td>";
		
		$result.= "<td colspan=\"2\" class=\"{$this->CSS['heading']}\"><a href=\"{$_SERVER['PHP_SELF']}?cal_{$this->tableInfo['name']}_month=$next&amp;cal_{$this->tableInfo['name']}_year=$next_yr".buildQueryString("cal_{$this->tableInfo['name']}_month","cal_{$this->tableInfo['name']}_year")."\" >&raquo;</a></td>";
		
		
		$result.="</tr>";
		
		if ($this->lang=='spanish')
		{
			$dayName[]="Dom";
			$dayName[]="Lun";
			$dayName[]="Mar";
			$dayName[]="Mie";
			$dayName[]="Jue";
			$dayName[]="Vie";
			$dayName[]="Sab";
		}else
		{		
			$dayName[]="Sun";
			$dayName[]="Mon";
			$dayName[]="Tue";
			$dayName[]="Wed";
			$dayName[]="Thu";
			$dayName[]="Fri";
			$dayName[]="Sat";		
		}

		$result.= "\n<tr><td class=\"{$this->CSS['weekDays']}\"><span>{$dayName[0]}</span></td><td class=\"{$this->CSS['weekDays']}\"><span>{$dayName[1]}</span></td><td class=\"{$this->CSS['weekDays']}\"><span>{$dayName[2]}</span></td>";
		$result.= "<td class=\"{$this->CSS['weekDays']}\"><span>{$dayName[3]}</span></td><td class=\"{$this->CSS['weekDays']}\"><span>{$dayName[4]}</span></td><td class=\"{$this->CSS['weekDays']}\"><span>{$dayName[5]}</span></td><td class=\"{$this->CSS['weekDays']}\">
		<span>{$dayName[6]}</span></td></tr><tr>";
		//$result.= "<tr><td COLSPAN=7> </tr><tr ALIGN='center'>";
				
		$end = ($start_day > 4)? 6:5;

		for ($row=1;$row<=$end;$row++)
			{
				for ($col=1;$col<=7;$col++)
					{
						
						$t = isset($dates[$row][$col])?$dates[$row][$col]:"";	
						
						$result_=mysql_query("
						SELECT {$this->tableInfo['dateField']} 
						FROM {$this->tableInfo['name']} 
						WHERE (
										DATE_FORMAT({$this->tableInfo['dateField']},'%e')='$t' 
									AND DATE_FORMAT({$this->tableInfo['dateField']},'%c')='{$this->curDate['month']}' 
									AND DATE_FORMAT({$this->tableInfo['dateField']},'%Y')='{$this->curDate['year']}'
							  ) 
							  AND 
							  (
							  	{$this->tableInfo['queryWhereCond']}
							  )");
						
						if (mysql_num_rows($result_)>0 && ($t == date("j")) && ($this->curDate['month'] == date("n")) && ($this->curDate['year'] == date("Y"))) //alla data di oggi c' un evento
							$result.= "\n<td class=\"{$this->CSS['todayLinked']}\"><a href=\"cajadashboard.php?".buildQueryString("cal_{$this->tableInfo['name']}_focus")."&amp;cal_{$this->tableInfo['name']}_focus={$this->curDate['year']}-{$this->curDate['month']}-{$t}#tab3\">".$t."</a></td>";
						
						else if (mysql_num_rows($result_)>0)
							$result.= "\n<td class=\"{$this->CSS['linked']}\"><a href=\"cajadashboard.php?".buildQueryString("cal_{$this->tableInfo['name']}_focus")."&amp;cal_{$this->tableInfo['name']}_focus={$this->curDate['year']}-{$this->curDate['month']}-{$t}#tab3\" >".$t."</a></td>";
						
						else if (($t == date("j")) && ($this->curDate['month'] == date("n")) && ($this->curDate['year'] == date("Y")))
							$result.= "\n<td class=\"{$this->CSS['today']}\">".$t."</td>";
						else
							//If the date is absent ie after 31, print space
							$result.= "\n<td class=\"{$this->CSS['simple']}\">".(($t == "" )? "&nbsp;" :$t)."</td>";
					}// for -col
				
				if (($row + 1) != ($end+1))
					$result.= "</tr>\n<tr align=\"center\">";
				else
					$result.= "</tr></table>";
			}// for - row
			return $result;
	}

	
}	
	



?>