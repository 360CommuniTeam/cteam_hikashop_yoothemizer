<?php
/**
 * @package	HikaShop for Joomla!
 * @version	4.7.4
 * @author	hikashop.com
 * @copyright	(C) 2010-2023 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
$type = $this->type;
$after = array();
foreach($this->extraFields[$type] as $fieldName => $oneExtraField) {

	$val = preg_replace('#[^a-z0-9]#i', '_', strtoupper($oneExtraField->field_realname));
	$app = JFactory::getApplication();
	if(hikashop_isClient('administrator') && strcmp(JText::_($val), strip_tags(JText::_($val))) !== 0)
		$realname = $val;
	else
		$realname = JText::_($val);
	if($val == $realname)
		$realname = $name;

	$onWhat='onchange';
	if($oneExtraField->field_type=='radio')
		$onWhat='onclick';
	$html = $this->fieldsClass->display(
		$oneExtraField,
		@$this->$type->$fieldName,
		'data['.$type.']['.$fieldName.']',
		false,
		'placeholder="'.$realname.'" class="'.HK_FORM_CONTROL_CLASS.' uk-input" '.$onWhat.'="window.hikashop.toggleField(this.value,\''.$fieldName.'\',\''.$type.'\',0);"',
		false,
		$this->extraFields[$type],
		$this->$type,
		false
	);
	if($oneExtraField->field_type=='hidden') {
		$after[] = $html;
		continue;
	}
?>
		<div class="uk-margin hkform-group control-group hikashop_registration_<?php echo $fieldName;?>_line" id="hikashop_<?php echo $type.'_'.$oneExtraField->field_namekey; ?>">
			<?php echo $this->fieldsClass->getFieldName($oneExtraField,true,'uk-form-label hkcontrol-label');?>
			<div class="uk-form-controls">
				<?php 
				echo $html; ?>
			</div>
		</div>
<?php 
}

if(count($after)) {
	echo implode("\r\n", $after);
}
?>
