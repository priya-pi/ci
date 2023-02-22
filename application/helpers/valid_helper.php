<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

    function alpha_check($str) // book ,register, server
    {
        if (!preg_match("/^[A-Za-z ]*$/", $str)) {
            $this->form_validation->set_message('alpha_check', 'The %s only character allowed');
            return false;
        } else {
            return true;
        }
    }

	 function regex_check($str) // login
	{
		if (!preg_match("/[A-Za-z]/", $str)) {
			$this->form_validation->set_message('regex_check', 'one capital and small character required.');
			return FALSE;
		} elseif(!preg_match("/[0-9]/", $str)){
			$this->form_validation->set_message('regex_check', 'one number required.');
			return FALSE;
		}elseif(!preg_match("/['@,$,!,%,#,?,&']/", $str)){
			$this->form_validation->set_message('regex_check', 'one special charater required.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

    function Password_regex_check($str) // register
	{
		if (!preg_match("/[A-Za-z]/", $str)) {
			$this->form_validation->set_message('Password_regex_check', 'one capital and small character required.');
			return FALSE;
		} elseif(!preg_match("/[0-9]/", $str)){
			$this->form_validation->set_message('Password_regex_check', 'one number required.');
			return FALSE;
		}elseif(!preg_match("/['@,$,!,%,#,?,&']/", $str)){
			$this->form_validation->set_message('Password_regex_check', 'one special charater required.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

	function hobby_check() //register
	{
		$hobby = $this->input->post('hobby');

		if ($hobby == null || count($hobby) < 0) {

			$this->form_validation->set_message('hobby_check', 'checkbox must be cheked');
			return FALSE;
		} else {
			return TRUE;
		}
	}

?>
