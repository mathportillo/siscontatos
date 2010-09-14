<?php

class Util extends Controller
{
	public function muda_agenda()
	{
		$this->session->set_userdata('agenda', $this->input->post('agenda'));
		//redirect($this->input->post('redirect'));
		redirect('contatos');
	}
}

?>
