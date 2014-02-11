<?php

class Flashcontext
{
	static function setQuizId($id_quiz)
	{
		$CI =& get_instance();
        $CI->session->set_flashdata('id_quiz', $id_quiz);
	}

	static function getQuizId()
	{
		$CI =& get_instance();
        return $CI->session->flashdata('id_quiz');	
	}
}