<section id="socialNetworks"> 
	<?php
	if($this->config->item('social_active'))
	{
		$social = $this->config->item('social');
		for($i = 0; $i < count($social); ++$i)
		{
			echo '<a href="'.$social[$i][0].'" target="'.$social[$i][1].'" title="'.$social[$i][2].'"><img src="'.base_url('assets/images/social/'.$social[$i][3].'.png').'" ></a><br>';
		}
	}		
	?>
</section>
