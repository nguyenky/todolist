<?php 

namespace Test\Validation;

use App\Validation\Todo\UpdateTodoValidation;
use Exception;
use Tests\BaseTestCase;

class UpdateTodoValidationTest extends BaseTestCase
{
    public function testNameFailueRequired()
    {
        try
        {
            $params = [];

            (new UpdateTodoValidation($params))->handle();
        }
        catch(Exception $e )
        {
            $message = "Attribute name must required";
            $this->assertEquals($message, $e->getMessage());
        }
        
    }

    public function testNameFailueMin()
    {
        try {
            $params = [
                'name' => 'ky'
            ];

            (new UpdateTodoValidation($params))->handle();
        } catch (Exception $e) {
            $message = "Attribute name must min 10 characters";
            $this->assertEquals($message, $e->getMessage());
        }
    }

    public function testNameFailueMax()
    {
        try {
            $params = [
                'name' => 'PHP is a popular general-purpose scripting language that is especially suited to web development[5]. It was originally created by Rasmus Lerdorf in 1994;[6] the PHP reference implementation is now produced by The PHP Group.[7] PHP originally stood for Personal Home Page,[6] but it now stands for the recursive initialism PHP: Hypertext Preprocessor.[8]'
            ];

            (new UpdateTodoValidation($params))->handle();
        } catch (Exception $e) {
            $message = "Attribute name must max 100 characters";
            $this->assertEquals($message, $e->getMessage());
        }
    }

    public function testStartDateFailueRequired()
    {
        try {
            $params = [
                'name' => 'Le Nguyen Ky'
            ];

            (new UpdateTodoValidation($params))->handle();
        } catch (Exception $e) {
            $message = "Attribute start_date must required";
            $this->assertEquals($message, $e->getMessage());
        }
    }

    public function testStartDateFailueDate()
    {
        try {
            $params = [
                'name' => 'Le Nguyen Ky',
                'start_date' => 'asdasdasdas'
            ];

            (new UpdateTodoValidation($params))->handle();
        } catch (Exception $e) {
            $message = "Attribute start_date must be date";
            $this->assertEquals($message, $e->getMessage());
        }
    }

    public function testStatusFailueRequired()
    {
        try {
            $params = [
                'name' => 'Le Nguyen Ky',
                'start_date' => '2020-03-03',
                'end_date' => '2020-04-03',
            ];

            (new UpdateTodoValidation($params))->handle();
        } catch (Exception $e) {
            $message = "Attribute status must required";
            $this->assertEquals($message, $e->getMessage());
        }
    }

    public function testValidateSuccess()
    {
        $params = [
            'name' => 'Le Nguyen Ky',
            'start_date' => '2020-03-03',
            'end_date' => '2020-04-03',
            'status' => 'doing'
        ];
        $valiadte = (new UpdateTodoValidation($params))->handle();
        $this->assertTrue($valiadte);
    }
}