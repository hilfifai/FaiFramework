<?php



function parse_button($page, $array, $row)
{
	//"a","View Profile","text",false
	//	print_r($array);
	if(isset($page['load']['page_database']))
	$id = $page['load']['page_database'];

	$i = 0;
	$type = isset($array[$i]) ? $array[$i] : null;
	$i++;
	$field = isset($array[$i]) ? $array[$i] : null;
	$i++;
	$dataset = isset($array[$i]) ? $array[$i] : null;
	$i++;
	$enkripsi = isset($array[$i]) ? $array[$i] : null;
	$i++;
	if (isset($array[$i])) {
		if (strpos($array[$i][3], '}}')) {
			$temp = $array[$i][3];
			$temp_ex = explode('}', $array[$i][3]);
			//print_r($temp_ex);
			$result_temp = "";
			for ($a = 0; $a < count($temp_ex); $a++) {

				if (strpos($temp_ex[$a], "{{") or substr($temp_ex[$a], 0, 2) == '{{') {
					$temp1_explode = explode('{{', $temp_ex[$a]);
					for ($b = 0; $b < count($temp1_explode); $b++) {
						if (substr($temp1_explode[$b], 0, strlen('row:')) == 'row:') {
							$name_row = substr($temp1_explode[$b], strlen('row:'));

							$result_temp .= $row->$name_row;
						} else {
							$result_temp .= $temp1_explode[$b];
						}
					}
				} else {
					$result_temp .= $temp_ex[$a];
				}
			}

			$array[$i][3] = $result_temp;
		}
	}
	$support = isset($array[$i]) ? Partial::link_direct($page, $page['load']['link_route'], $array[$i]) : null;
	$i++;
	$costum = isset($array[$i]) ? $array[$i] : null;

	if ($dataset == 'database') {
		$info = $row->$field;
	} else if ($dataset == 'database-costum') {
		$field_costum = $field;
		$prefix_costum = $field_costum[0];
		$field  = $field_costum[1];
		$suffix_costum = $field_costum[2];
		$info = $prefix_costum . ($row->$field) . $suffix_costum;
	} else if ($dataset == 'database-relation') {
		$field_relation = $field;
		$internal_field = $field[1];

		$info = $row->$field;
	} else {
		$info = $field;
	}

	if ($enkripsi) {
		$info = '<be3 text="' . $info . '" done="false"><span class="skeleton-box" style="width:80%;"></span></be3>';
	}

	$return = "";
	if ($type == 'Start Group') {
		if ($dataset == 'H') {
			$return .=  '<div class="btn-group margin">';
		} else if ($dataset == 'V') {
			$return .= '<div class="btn-group-vertical margin">';
		}
	} else if ($type == 'End Group') {
		$return .= '</div>';
	} else if ($type == 'dropdown') {
		$return .= '
		<div class="btn-group">
			<button type="button" class="' . (isset($costum['class']) ? $costum['class'] : "btn btn-primary") . '" data-toggle="dropdown">' . $info . '<span class="caret"></span></button>
	<ul class="dropdown-menu">
	<?php for($b=0;$b<count($info);$b++){?>
		<li><a href="<?= $info[$b][1] ?>"><?= $info[$b][0] ?></a></li>
		<?php }?>
	</ul>
	</div>
		';
	} else if (strtolower($type) == 'a') {
		$return .= ' <a class="' . (isset($costum['class']) ? $costum['class'] : "btn btn-primary") . '" ' . $support . '>' . $info . '</a>';
	} else {
		$return .= '<button type="' . $type . '" class="' . (isset($costum['class']) ? $costum['class'] : "btn btn-primary") . '" ' . $support . '>' . $info . '</button>';
	}
	return $return;
}
