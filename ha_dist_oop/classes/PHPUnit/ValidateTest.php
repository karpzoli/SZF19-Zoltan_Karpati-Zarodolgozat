<?php
/**
 * Created by PhpStorm.
 * User: karpatzo
 * Date: 18/10/2017
 * Time: 12:39
 */

namespace PHPUnit;

use Validate;

//set_include_path('C:\xampp\htdocs\KZG\ha_dist_oop');

require_once ('core/init.php');

class ValidateTest extends \PHPUnit_Framework_TestCase
{
    /**
     *@dataProvider validateProvider
     */
    public function testUserNameTooShort($items){
        $validate = new Validate();
        $source=[
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'k',
            'password' => 'Password' , //password
            'password_again' => 'Password' , //password_again
        ];
        $validate->check($source,$items);
        $this->assertTrue($validate->passed());
    }

    public function testUserNameTooLong($items){
        $validate = new Validate();
        $source=[
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'doejo2015',
            'password' => 'Password' , //password
            'password_again' => 'Password' , //password_again
        ];
        $validate->check($source,$items);
        $this->assertTrue($validate->passed());
    }

    public function testPasswordDoesNotMach($items){
        $validate = new Validate();
        $source=[
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'doejo',
            'password' => 'Password' , //password
            'password_again' => 'password' , //password_again
        ];
        $validate->check($source,$items);
        $this->assertTrue($validate->passed());
    }

    public function testRequiredField($items){
        $validate = new Validate();
        $source=[
            'first_name' => '',
            'last_name' => 'Doe',
            'username' => 'doejo',
            'password' => 'Password' , //password
            'password_again' => 'password' , //password_again
        ];
        $validate->check($source,$items);
        $this->assertTrue($validate->passed());
    }

    /**
     * @return array with validation criterion     */
    public function validateProvider(){
        return [
            'first_name' => array(
                'name' => 'First Name',
                'required' => true,
                'min' => 2,
                'max' => 40
            ),
            'last_name' => array(
                'name' => 'Last Name',
                'required' => true,
                'min' => 2,
                'max' => 40
            ),
            'username' => array(
                'name' => 'Username',
                'required' => true,
                'min' => 2,
                'max' => 8,
                'unique' => 'users'
            ),
            'password' => array(
                'name' => 'Password',
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
        ];
    }
}
