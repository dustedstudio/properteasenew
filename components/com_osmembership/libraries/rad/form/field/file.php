<?php

class RADFormFieldFile extends RADFormField
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 *	 
	 */
	protected  $type = 'File';
	
	public function __construct($row, $value = null, $fieldSuffix = null)
	{
		parent::__construct($row, $value, $fieldSuffix);				
		if ($row->size)
		{
			$this->attributes['size'] = $row->size;
		}
	}

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *	 
	 */
	protected function getInput()
	{
		$attributes = $this->buildAttributes();
		
		if ($this->value && file_exists(JPATH_ROOT.'/media/com_osmembership/upload/'.$this->value))
		{
			return '<input type="file" name="' . $this->name . '" id="' . $this->name . '" value=""' . $attributes. $this->extraAttributes. ' />. '.JText::_('OSM_CURRENT_FILE').' <strong>'.OSMembershipHelper::getOriginalFilename($this->value).'</strong> <a href="index.php?option=com_osmembership&task=download_file&file_name='.$this->value.'">'.JText::_('OSM_DOWNLOAD').'</a>';
		}
		else 
		{
			return '<input type="file" name="' . $this->name . '" id="' . $this->name . '" value=""' . $attributes. $this->extraAttributes. ' />';
		}		
	}
}