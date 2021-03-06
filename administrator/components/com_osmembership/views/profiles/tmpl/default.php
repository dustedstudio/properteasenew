<?php
/**
 * @version		1.6.8
 * @package		Joomla
 * @subpackage	Membership Pro
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2012 - 2014 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;
$ordering = ($this->lists['order'] == 'a.ordering');
$cols = 6;
?>
<form action="index.php?option=com_osmembership&view=profiles" method="post" name="adminForm" id="adminForm">
<table width="100%">
<tr>
	<td align="left">
		<?php echo JText::_( 'OSM_FILTER' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo $this->state->search;?>" class="search-query" onchange="document.adminForm.submit();" />		
		<button onclick="this.form.submit();" class="btn"><?php echo JText::_( 'OSM_GO' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();" class="btn"><?php echo JText::_( 'OSM_RESET' ); ?></button>		
	</td>	
</tr>
</table>
<div id="editcell">
	<table class="adminlist table table-striped">
	<thead>
		<tr>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
			</th>			
			<th class="title" style="text-align: left;">
				<?php echo JHtml::_('grid.sort',  JText::_('OSM_FIRSTNAME'), 'a.first_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>				
			</th>											
			<th class="title" style="text-align: left;">
				<?php echo JHtml::_('grid.sort',  JText::_('OSM_LASTNAME'), 'a.last_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>	
			<th class="title" style="text-align: left;">
				<?php echo JHtml::_('grid.sort',  JText::_('OSM_EMAIL'), 'a.email', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>													
			<?php 
				if ($this->config->auto_generate_membership_id) 
				{
					$cols++ ;
				?>
					<th width="8%">
						<?php echo JHtml::_('grid.sort',  JText::_('OSM_MEMBERSHIP_ID'), 'a.membership_id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
				<?php	
				}				
			?>			
			<th class="title center">
				<?php echo JText::_('OSM_PLANS'); ?>
			</th>	
			<th width="2%">
				<?php echo JHtml::_('grid.sort',  JText::_('OSM_ID'), 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>													
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="<?php echo $cols ; ?>">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = $this->items[$i];		
		$link 	= JRoute::_( 'index.php?option=com_osmembership&task=profile.edit&cid[]='. $row->id);		
		$checked 	= JHtml::_('grid.id',   $i, $row->id );								
		$accountLink = 'index.php?option=com_users&task=user.edit&id='.$row->user_id ;
		$plans = $row->plans;
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $checked; ?>
			</td>				
			<td>																			
				<a href="<?php echo $link; ?>"><?php echo $row->first_name ; ?></a>
				<?php
				if ($row->username) 
				{
				?>
					[<a href="<?php echo $accountLink; ?>" title="View Profile"><strong><?php echo $row->username ; ?></strong></a>]
				<?php	
				} 
				?>				
			</td>
			<td>																			
				<?php echo $row->last_name ; ?>						
			</td>
			<td>
				<a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a>				
			</td>																									
			<?php 
				if ($this->config->auto_generate_membership_id) {
				?>
					<td>
						<?php echo $row->membership_id ; ?>
					</td>
				<?php	
				}				
			?>
			<td>				
				<ul class="osm-plans-container">
					<?php
						foreach($plans as $plan)
						{
						?>
							<li>
								<strong><?php echo $plan->title; ?></strong> - [
								
								
								<strong><?php echo JHtml::_('date', $plan->subscription_from_date, $this->config->date_format); ?></strong> To 				
								<strong>
									<?php 
										if ($plan->lifetime_membership)
										{
											echo JText::_('OSM_LIFETIME');	
										}
										else 
										{
											echo JHtml::_('date', $plan->subscription_to_date, $this->config->date_format);
										}
									?>					
								</strong>																
								] - 								
								<?php
									switch ($plan->subscription_status)
									{
										 case 0 :
			                                echo JText::_('OSM_PENDING');
			                                break ;
			                            case 1 :
			                                echo JText::_('OSM_ACTIVE');
			                                break ;
			                            case 2 :
			                                echo JText::_('OSM_EXPIRED');
			                                break ;
			                            default:
			                            	echo JText::_('OSM_CANCELLED');
			                            	break;
			                                
									}
								?>
							</li>
						<?php	
						}						 
					?>
				</ul>				
			</td>
			<td align="center">
				<?php echo $row->id; ?>
			</td>
		</tr>		
		<?php
		$k = 1 - $k;
	}
	?>
	</tbody>
	</table>
	</div>
	<input type="hidden" name="option" value="com_osmembership" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />	
	<?php echo JHtml::_( 'form.token' ); ?>			
</form>