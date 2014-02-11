<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_front extends Front_Controller 
{
	public function home()
	{
		if(Context::isLoggedIn())
		{
			$this->load->model('ranking_model');
			$user_score = $this->ranking_model->get_entry(1, Context::getUserId());
			$this->data['total_score'] = $user_score->getTotalScore();
		}
		
		$this->load->model('message_model');
		$message = array_pop($this->message_model->list_entries());
		$this->data['message'] = $message->getMessage();

		$this->data['controller'] = 'home';
		$this->load->view('front/common/header_view', $this->data);
		$this->load->view('front/home_view', $this->data);
		$this->load->view('front/common/footer_view', $this->data);
	}

	public function season()
	{
		$this->load->model('game_model');

		$this->data['game'] = array(
			'quarter' => $this->game_model->get_games(1, 'quarter', array('teams')),
			'semifinal' => $this->game_model->get_games(1, 'semifinal', array('teams')),
			'final' => $this->game_model->get_games(1, 'final', array('teams')),
		);

		//die(print_r($this->data['game']));
		
		/*$this->load->model('award_model');

		$this->data['award'] = array(
			'mvp' => $this->award_model->get_mvp(1),
			'max_scorer' => $this->award_model->get_max_scorer(1),
			'max_rebounder' => $this->award_model->get_max_rebounder(1),
			'max_asistant' => $this->award_model->get_max_asistant(1)
		);*/
		
		$this->load->model('quiz_model');

		$quizzes = array();
		for($i = 1; $i <= 8; $i++)
		{
			//Get quiz by position
			$quiz = $this->quiz_model->get_quiz(1, $this->id_user, $i);
			
			if($quiz != NULL)
			{
				/*if(Context::isSeasonOpen())
				{*/
					$quizzes[] = array(
						'score' => $quiz->getScore(),
						'state' => $quiz->getState()
					);
				/*}
				else
				{
					$quizzes[] = array(
						'score' => $quiz->getScore(),
						'state' => 'disabled'
					);
				}*/	
			}
			else
			{
				if(Context::isSeasonOpen())
				{
					$quizzes[] = array(
						'score' => 0,
						'state' => 'unanswered',
						'url' => base_url('quiz/generate/'.$i)
					);
				}
				else
				{
					$quizzes[] = array(
						'score' => 0,
						'state' => 'disabled'
					);
				}
			}
		}

		$this->data['quizzes'] = $quizzes;

		$this->load->model('ranking_model');
		$user_score = $this->ranking_model->get_entry(1, $this->id_user);
		$ranking = $this->ranking_model->get_ranking(1, array('user'));

		$position = 0;
		if(!empty($ranking))
		{
			foreach($ranking as $pos => $rank)
			{
				if($this->id_user == $rank->getIdUser())
				{
					$position = $pos + 1;
					continue;
				}
			}
		}
		
		$this->data['forecast_score'] = $user_score->getForecastTeamScore() + $user_score->getForecastPlayerScore();
		$this->data['quiz_score'] = $user_score->getQuizScore();
		$this->data['ranking'] = $ranking;
		$this->data['total_score'] = $user_score->getTotalScore();
		$this->data['position'] = $position;
		$this->data['already_liked'] = ($user_score->getFacebookPoints() > 0) ? true : false;

		$this->data['controller'] = 'season';
		$this->load->view('front/common/header_view', $this->data);
		$this->load->view('front/season_view', $this->data);
		$this->load->view('front/common/footer_view', $this->data);
	}
}