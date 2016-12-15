<?php


class Ghost{
	
	public static function PrintTrace($traceArray){

		if(GLOBAL_DEBUG){

			$string = "<br/>";

			foreach ($traceArray as $trace) {
				$string .= '<b>Called from: </b>' . $trace['file'] . ' on line: ' . $trace['line'] . ' in function: ' . $trace['function'] . '()<br/>';
			}

			return $string;
			
		}
	}

}