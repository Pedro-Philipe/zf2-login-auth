<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Users\Form;

use Zend\Form\Form;

class RegisterForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Register');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'required' => 'required',
				'placeholder' => 'Fulano de Tal Siqueira'
            ),
            'options' => array(
                'label' => 'Nome completo',
            ),
        ));


        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
                'required' => 'required',
				'placeholder' => 'exemplo@exemplo.com'
            ),
            'options' => array(
                'label' => 'E-mail',
            ),
        ));

		$this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'required' => 'required',
				'placeholder' => '*********'
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Registrar',
                'action'     => 'home'
            ),
        ));

    }
}
