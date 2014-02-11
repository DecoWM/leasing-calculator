<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* Form Class for Admin */
class Back_Controller extends Base_Controller
{
	protected $view_list;
    protected $view_form;
    protected $instances;
    protected $entity_name;

	function __construct()
	{
		parent::__construct();
        
        if(!Admincontext::isLoggedIn()) 
        {
           redirect(base_url('admin/auth/login'));
        }
        
        $this->instances = array();
        
        $this->load->library('alert');
        $this->data['alerts'] = Alert::getAlerts();
	}

	/* Index */
	function index()
	{
		$this->list_all();
	}

	/* 
	 * Create register
	 */
	function create()
	{
        $this->data['form_action'] = 'save';
		$this->load->view('admin/common/header_view', $this->data);
        $this->load->view('admin/'.$this->view_form, $this->data);
        $this->load->view('admin/common/footer_view', $this->data);
	}
    
    /*
	 * Edit register
	 */
    function edit($id = NULL)
    {
        $this->data['form_action'] = 'update';
        if($id != null) $this->data['entity'] = $this->OBJ->get_entry($id, $this->instances);
        $this->load->view('admin/common/header_view', $this->data);
        $this->load->view('admin/'.$this->view_form, $this->data);
        $this->load->view('admin/common/footer_view', $this->data);
    }
    
    /**
     * Save a register, form submitted
     */
    function save()
    {
        $this->form_validation->set_rules($this->get_rules());

        if($this->form_validation->run())
        {
            $entity = $this->from_form();
            if($this->OBJ->insert_entry($entity))
                self::success('save');
            else
                self::error('save');
            redirect(base_url("admin/{$this->controller}"));
        }
        else 
        {
            $this->create();
        }
    }

    /**
	 * Update register
	 */
	function update()
	{
        $this->form_validation->set_rules($this->get_rules());

        if($this->form_validation->run())
        {
            $entity = $this->from_form();
            if($this->OBJ->update_entry($entity))
                self::success('update');
            else
                self::error('update');
            redirect(base_url("admin/{$this->controller}"));
        }
        else 
        {
            $this->post_data();
            $this->edit();
        }
	}

	/**
	 * Delete register
	 */
	function remove($id, $confirm = FALSE)
	{
        if(!$confirm)
        {
            if($this->OBJ->remove_entry($id))
                self::success('remove');
            else
                self::error('remove');
            redirect(base_url("admin/{$this->controller}"));
        }
        else 
        {
            $this->set_confirm_dialog($id);
            $this->load->view('admin/common/header_view', $this->data);
            $this->load->view('admin/common/confirmation_dialog', $this->data);
            $this->load->view('admin/common/footer_view', $this->data);
        }
	}

	/* default list */
	function list_all()
	{
		$this->data['list'] = $this->OBJ->list_entries($this->instances);
        $this->load->view('admin/common/header_view', $this->data);
        $this->load->view('admin/'.$this->view_list, $this->data);
        $this->load->view('admin/common/footer_view', $this->data);
	}

    function success($type)
    {
        switch($type)
        {
            case 'save': 
                Alert::success("{$this->entity_name} fue correctamente guardado(a)");
            break;
            
            case 'update': 
                Alert::success("{$this->entity_name} fue correctamente actualizado(a)");
            break;

            case 'remove': 
                Alert::success("{$this->entity_name} fue correctamente removido");
            break;
        }
    }

    function error($type)
    {
        switch($type)
        {
            case 'save': 
                Alert::error("{$this->entity_name} no pudo ser guardado(a)");
            break;

            case 'update': 
                Alert::error("{$this->entity_name} no pudo ser actualizado(a)");
            break;

            case 'remove': 
                Alert::error("{$this->entity_name} no pudo ser removido(a)");
            break;
        }
    }

    function set_confirm_dialog($id)
    {
        $this->data['entity_name'] = strtolower($this->entity_name);
        $this->data['back_url'] = base_url("admin/{$this->controller}/edit/$id");
        $this->data['remove_url'] = base_url("admin/{$this->controller}/remove/$id");
    }

    function post_data()
    {
        $this->data['id_'.$this->controller] = $this->input->post('id_'.$this->controller);
    }
}
