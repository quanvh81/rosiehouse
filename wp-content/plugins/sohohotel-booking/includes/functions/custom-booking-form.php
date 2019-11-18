<?php

function getLabelField($str){
	if(preg_match('/label="/', $str, $matches)){
		$e = explode('label="', $str);
		$param = explode('"', $e[1]);
		$param = $param[0];	
		$txtRequired = '';
		if(preg_match('/required/', $str, $matches2)){
			$txtRequired = ' *';
		}
		return '<label for="'.strtolower(str_replace(' ', '_', $param)).'">'.$param.$txtRequired.'</label>';
	}else{
		return '';
	}
}

function getIdField($str){
	if(preg_match('/id="/', $str, $matches)){
		$e = explode('id="', $str);
		$param = explode('"', $e[1]);
		$param = $param[0];	
		return $param;
	}else{
		return '';
	}	
}

function __check_required($str){
	if(preg_match('/label="/', $str, $matches)){
		$e = explode('label="', $str);
		$param = explode('"', $e[1]);
		$param = $param[0];	
		$txtRequired = '';
		if(preg_match('/required/', $str, $matches2)){
			return true;
		}		
	}else{
		return false;
	}
}

function getClassField($str){
	$__required = __check_required($str);
	if(preg_match('/class="/', $str, $matches)){
		$e = explode('class="', $str);
		$param = explode('"', $e[1]);
		$param = $param[0];	
		if($__required) return 'class="sh-required-field '.$param.'"';
		return 'class="'.$param.'"';
	}else{
		if($__required) return 'class="sh-required-field"';
		return '';

	}	
}

function verifyInputs($str, $data){
	
	// If text
	if(preg_match_all('/\[text /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[text ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = getLabelField($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$input = '<input type="text" name="_booking_meta['.$id.']" id="'.$id.'" value="'.$value.'" '.$class.' />';
			$str = str_replace('[text '.$param.']', $label.$input, $str);
		}	
	}
	
	// If Select
	if(preg_match_all('/\[select /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[select ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = getLabelField($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$input = '<select name="_booking_meta['.$id.']" id="'.$id.'" '.$class.'>
			<option value="">Choose a option</option>';
			
			$e = explode('choices="', $param);
			$choices = explode('"', $e[1]);
			if(@substr_count($choices[0], ',')){
				$eC = explode(',', $choices[0]);
				foreach($eC as $choice){
					$selected = '';
					if($value == $choice){ $selected = 'selected';}
					$input .= '<option value="'.$choice.'" '.$selected.'>'.$choice.'</option>';
				}
			}else{
				$input .= '<option value="'.$choice.'" '.$selected.'>'.$choice.'</option>';
			}
			
			$input .= '</select>';
			$str = str_replace('[select '.$param.']', $label.$input, $str);
		}	
	}
	
	// If Radio
	if(preg_match_all('/\[radio /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[radio ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = getLabelField($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$input = '';
			
			$e = explode('choices="', $param);
			$choices = explode('"', $e[1]);
			$txtChoices = '';
			if(@substr_count($choices[0], ',')){
				$eC = explode(',', $choices[0]);
				foreach($eC as $choice){
					$selected = '';
					if($value == $choice){ $selected = 'checked';}
					$input .= '<input type="radio" name="_booking_meta['.$id.']" value="'.$choice.'" '.$class.' '.$selected.'> ' . $choice;
				}
			}else{
				if($value == $choice){ $selected = 'checked';}
				$input = '<input type="radio" name="_booking_meta['.$id.']" value="'.$choice.'" '.$class.' '.$selected.'> ' . $choice;
			}
			$str = str_replace('[radio '.$param.']', $label.$input, $str);
		}	
	}	
	
	// If Checkbox
	if(preg_match_all('/\[checkbox /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[checkbox ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = getLabelField($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$input = '';
			
			$e = explode('choices="', $param);
			$choices = explode('"', $e[1]);
			$txtChoices = '';
			if(@substr_count($choices[0], ',')){
				$eC = explode(',', $choices[0]);
				foreach($eC as $choice){
					$selected = '';
					if($value == $choice){ $selected = 'checked';}
					$input .= '<input type="checkbox" name="_booking_meta['.$id.']" value="'.$choice.'" '.$class.' '.$selected.'> ' . $choice;
				}
			}else{
				if($value == $choice){ $selected = 'checked';}
				$input = '<input type="checkbox" name="_booking_meta['.$id.']" value="'.$choice.'" '.$class.' '.$selected.'> ' . $choice;
			}
			$str = str_replace('[checkbox '.$param.']', $label.$input, $str);
		}	
	}
	
	// If text
	if(preg_match_all('/\[textarea /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[textarea ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = getLabelField($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$input = '<textarea rows="15" cols="10" name="_booking_meta['.$id.']" id="'.$id.'" '.$class.'>'.$value.'</textarea>';
			$str = str_replace('[textarea '.$param.']', $label.$input, $str);
		}	
	}			
	
	return $str;
	
}

?>