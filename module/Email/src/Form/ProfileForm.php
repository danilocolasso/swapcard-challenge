<?php

namespace Email\Form;

use Laminas\Form\Element\Email;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;

class ProfileForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'name',
            'type' => Text::class,
            'options' => [
                'label' => 'Name',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'required' => 'required',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'phone',
            'type' => Text::class,
            'options' => [
                'label' => 'Phone Number',
            ],
            'attributes' => [
                'required' => 'required',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'content',
            'type' => Textarea::class,
            'options' => [
                'label' => 'Content',
            ],
            'attributes' => [
                'required' => 'required',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-primary',
            ],
        ]);
    }
}