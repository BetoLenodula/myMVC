<?php

namespace Classes;

class Calendar{

	private static $html;
	// Funcion que pinta el calendario
	public static function create($month, $year){
		$calendar = array(array());
		$cal_size = 0;
		$week = 0;
		$cell = 1;
		$month_name = "";
		
		//Creamos el arreglo Calendario
		$calendar = self::create_calendar($month,$year,$calendar);
	    // Longitud del Calendario incluyendo espacios en blanco, con llamada recursiva para que sea completo;
		// Al ser recursivo nos suma tambien los renglones que son los arrays padres de las celdas, entonces restamos
		$cal_size =	count($calendar,COUNT_RECURSIVE) - count($calendar); 
		//Imprime $month and $year
		switch ($month) {  // Obtenemos el nombre en castellano del mes
			case 1 :  $month_name = "ENERO";
				break;
			case 2 :  $month_name = "FEBRERO";
				break;
			case 3 :  $month_name = "MARZO";
				break;
			case 4 :  $month_name = "ABRIL";
				break;
			case 5 :  $month_name = "MAYO";
				break;
			case 6 :  $month_name = "JUNIO";
				break;
			case 7 :  $month_name = "JULIO";
				break;
			case 8 :  $month_name = "AGOSTO";
				break;
			case 9 :  $month_name = "SEPTIEMBRE";
				break;
			case 10 : $month_name = "OCTUBRE";
				break;
			case 11 : $month_name = "NOVIEMBRE";
				break;
			case 12 : $month_name = "DICIEMBRE";
			
		}
		//Creamos las celdas de los dias de la semana
		while ($cell <= $cal_size){
			self::$html .= "<tr>";
			for ($day=0;$day<7;$day++){
				if ($calendar[$week][$day]!=0){
					self::$html .= "<td>".$calendar[$week][$day]."</td>";
				} else { self::$html .= "<td></td>"; }
				$cell++;
			}
			$week++;
			self::$html .= "</tr>";
		}
		self::$html .= "<tr><th colspan='7'>".$month_name." ".$year."</th></tr>";

		return self::$html;
	}



	public static function create_calendar($month,$year,$calendar){
		// Declaramos variables de dias y semanas
		// usamos mktime para crear la fecha exacta que queremos para crear valor $time 
		$running_day = date('w',mktime(0,0,0,$month,1,$year)); // w devuelve el numero del dia de la semana
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year)); //t devuelve el numero de dias del mes
		$days_in_week = 0;
		$day = 1;
		$week = 0;
		
		// Mandamos datos de los dias de la semana al arreglo
		// Imprimimos dias en blanco hasta alcanzar el primero en la semana
		for ($days_in_week = 0; $days_in_week < $running_day; $days_in_week++){
			$calendar [$week][$days_in_week] = 0;
		}
		
		// Procedemos con los dias
		while ($day <= $days_in_month) {
		// Mientras no se llegue al numero de dias del mes llenamos el arreglo
			while($days_in_week < 7) { 
			// Asignamos los dias restantes mientras no lleguemos al tope de dias de semana 7.
			// Al terminar los dias del mes seguimos llenando el arreglo de vacio
				if ($day <= $days_in_month){
					$calendar [$week][$days_in_week] = $day;
				} else {
					$calendar [$week][$days_in_week] = 0;
				}

				$days_in_week++;
				$day++;
			}
			$days_in_week = 0;
			$week++;

		}
		return $calendar;
	}


}