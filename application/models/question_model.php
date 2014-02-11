<?php

class Question_Model extends Base_Model 
{
	function __construct()
    {
        parent::__construct();
        $this->table = 'question';
        $this->entity_class = 'Question';
        $this->id_name = 'id_question';
    }

    function create_instance(
        $id = NULL,
        $question = NULL
    )
    {
        $question_obj = new Question();
        $id = $id != null ? $id : $this->generate_uniqid('QUE');
        $question_obj->setIdQuestion($id);
        $question_obj->setQuestion($question);
        return $question_obj;
    }

    function add_relationships(&$questions, $relationships)
    {
    	if(empty($relationships))
			return;

    	if(!is_array($questions))
    	{
    		$questions = array($questions);
    		$singular = true;
    	}
    	else
    	{
    		$singular = false;
    	}

    	foreach($questions as &$question)
    	{
    		if(!empty($question))
	        {
	            if(in_array('options', $relationships))
	                $question->setOptions($this->get_options($question->getIdQuestion()));
	            if(in_array('answer', $relationships))
	                $question->setAnswer($this->get_answer($question->getIdQuestion()));
	        }
    	}

    	if($singular)
    	{
    		$questions = array_pop($questions);
    	}
    }

    function get_options($id_question)
    {
        $this->db->order_by('letter', 'asc');
        return $this->db->get_where('answer', array('id_question' => $id_question))->result('Answer');
    }

    function get_answer($id_question)
    {
    	return array_pop($this->db->get_where('answer', array('id_question' => $id_question, 'correct' => 1))->result('Answer'));
    }
}